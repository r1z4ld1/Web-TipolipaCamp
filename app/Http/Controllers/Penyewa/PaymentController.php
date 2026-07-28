<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function __construct()
    {
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;
    }

    public function checkout(Penyewaan $penyewaan)
    {
        abort_if($penyewaan->user_id !== auth()->id(), 403);

         if ($penyewaan->status === 'ditolak') {
        return redirect()
            ->route('penyewa.sewa.riwayat')
            ->with('error', 'Pengajuan sewa ini sudah ditolak admin/petugas dan tidak dapat dibayar.');
    }

        $penyewaan->load('details.barang');

        $pembayaran = $penyewaan->pembayaranAktif;

        if (!$pembayaran || in_array($pembayaran->status, ['failed', 'expired', 'cancelled'])) {
            $pembayaran = Pembayaran::create([
                'penyewaan_id' => $penyewaan->id,
                'order_id' => 'PAY-' . $penyewaan->kode_penyewaan . '-' . now()->format('His'),
                'jumlah' => $penyewaan->total_harga,
                'status' => 'pending',
            ]);
        }

        if (!$pembayaran->snap_token) {
            $itemDetails = $penyewaan->details->map(function ($detail) {
         return [
                'id' => 'BRG-' . $detail->barang_id,
                'price' => (int) $detail->subtotal,
                'quantity' => (int) $detail->jumlah,
                'name' => Str::limit($detail->barang->nama_barang ?? 'Alat Camping', 50),
              ];
                })->toArray();

            $snapToken = Snap::getSnapToken([
                'transaction_details' => [
                    'order_id' => $pembayaran->order_id,
                    'gross_amount' => (int) $pembayaran->jumlah,
                ],
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
                'item_details' => $itemDetails,
            ]);

            $pembayaran->update(['snap_token' => $snapToken]);
        }

        return view('penyewa.pembayaran.checkout', compact('penyewaan', 'pembayaran'));
    }

    public function callback(Request $request)
    {
        $payload = $request->all();

        $signatureKey = hash('sha512',
            ($payload['order_id'] ?? '') .
            ($payload['status_code'] ?? '') .
            ($payload['gross_amount'] ?? '') .
            config('midtrans.server_key')
        );

        if (!isset($payload['signature_key']) || $signatureKey !== $payload['signature_key']) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $pembayaran = Pembayaran::where('order_id', $payload['order_id'] ?? null)->first();

        if (!$pembayaran) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $transactionStatus = $payload['transaction_status'] ?? null;
        $fraudStatus = $payload['fraud_status'] ?? null;

        $status = match (true) {
            $transactionStatus === 'capture' && $fraudStatus === 'accept' => 'paid',
            $transactionStatus === 'settlement' => 'paid',
            $transactionStatus === 'pending' => 'pending',
            in_array($transactionStatus, ['deny', 'cancel']) => 'failed',
            $transactionStatus === 'expire' => 'expired',
            default => $pembayaran->status,
        };

        $pembayaran->update([
            'status' => $status,
            'metode_pembayaran' => $payload['payment_type'] ?? $pembayaran->metode_pembayaran,
            'transaction_id' => $payload['transaction_id'] ?? $pembayaran->transaction_id,
            'paid_at' => $status === 'paid' ? now() : $pembayaran->paid_at,
            'raw_response' => $payload,
        ]);

        return response()->json(['message' => 'OK']);
    }
}
