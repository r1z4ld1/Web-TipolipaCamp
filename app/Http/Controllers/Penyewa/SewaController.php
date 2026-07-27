<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\DetailPenyewaan;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SewaController extends Controller
{
    public function create(Barang $barang)
    {
        if ($barang->status !== 'tersedia' || $barang->stok <= 0) {
            return redirect()
                ->route('penyewa.alat.index')
                ->with('error', 'Alat camping tidak tersedia untuk disewa.');
        }

        return view('penyewa.sewa.create', compact('barang'));
    }

    public function store(Request $request, Barang $barang)
    {
        if ($barang->status !== 'tersedia' || $barang->stok <= 0) {
            return redirect()
                ->route('penyewa.alat.index')
                ->with('error', 'Alat camping tidak tersedia untuk disewa.');
        }


        $validated = $request->validate([
            'tanggal_sewa' => ['required', 'date', 'after_or_equal:today'],
            'tanggal_kembali' => ['required', 'date', 'after:tanggal_sewa'],
            'jumlah' => ['required', 'integer', 'min:1', 'max:' . $barang->stok],
            'bukti_identitas' => ['required', 'in:KTP,SIM,Kartu Pelajar,Kartu Mahasiswa,Paspor,Lainnya'],
            'catatan' => ['nullable', 'string'],
        ], [
            'tanggal_sewa.required' => 'Tanggal sewa wajib diisi.',
            'tanggal_sewa.after_or_equal' => 'Tanggal sewa tidak boleh sebelum hari ini.',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal sewa.',
            'jumlah.required' => 'Jumlah alat wajib diisi.',
            'jumlah.integer' => 'Jumlah alat harus berupa angka.',
            'jumlah.min' => 'Jumlah alat minimal 1.',
            'jumlah.max' => 'Jumlah alat tidak boleh melebihi stok tersedia.',
            'bukti_identitas.required' => 'Bukti identitas wajib dipilih.',
            'bukti_identitas.in' => 'Bukti identitas tidak valid.',
        ]);

        $tanggalSewa = \Carbon\Carbon::parse($validated['tanggal_sewa']);
        $tanggalKembali = \Carbon\Carbon::parse($validated['tanggal_kembali']);
        $lamaSewa = $tanggalSewa->diffInDays($tanggalKembali);

        $hargaSewa = $barang->harga_sewa;
        $jumlah = $validated['jumlah'];
        $subtotal = $hargaSewa * $jumlah * $lamaSewa;

        $penyewaan = DB::transaction(function () use ($validated, $barang, $lamaSewa, $hargaSewa, $jumlah, $subtotal) {
            $penyewaan = Penyewaan::create([
                'user_id' => auth()->id(),
                'kode_penyewaan' => 'SW-' . now()->format('YmdHis') . '-' . auth()->id(),
                'tanggal_sewa' => $validated['tanggal_sewa'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'lama_sewa' => $lamaSewa,
                'total_harga' => $subtotal,
                'bukti_identitas' => $validated['bukti_identitas'],
                'status' => 'pending',
                'catatan' => $validated['catatan'] ?? null,
            ]);

            DetailPenyewaan::create([
                'penyewaan_id' => $penyewaan->id,
                'barang_id' => $barang->id,
                'jumlah' => $jumlah,
                'harga_sewa' => $hargaSewa,
                'subtotal' => $subtotal,
            ]);

            return $penyewaan;
        });

        return redirect()
            ->route('penyewa.pembayaran.checkout', $penyewaan)
            ->with('success', 'Pengajuan berhasil dibuat. Silakan selesaikan pembayaran.');
    }

public function riwayat()
{
    $penyewaans = \App\Models\Penyewaan::with(['details.barang', 'pembayaranAktif'])
        ->where('user_id', auth()->id())
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('penyewa.sewa.riwayat', compact('penyewaans'));
}
}
