<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $periode = $request->periode ?? 'semua';

        $query = Penyewaan::with(['user', 'details.barang', 'pembayaranAktif']);
        $this->terapkanFilterLaporan($query, $request);

        $totals = $this->hitungTotalLaporan($query);

        $penyewaans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.laporans.index', array_merge(compact(
            'penyewaans',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ), $totals));
    }

    public function cetak(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $periode = $request->periode ?? 'semua';

        $query = Penyewaan::with(['user', 'details.barang', 'pembayaranAktif']);
        $this->terapkanFilterLaporan($query, $request);

        $totals = $this->hitungTotalLaporan($query);

        $penyewaans = $query
            ->latest()
            ->get();

        return view('admin.laporans.cetak', array_merge(compact(
            'penyewaans',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ), $totals));
    }

    public function exportPdf(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $periode = $request->periode ?? 'semua';

        $query = Penyewaan::with(['user', 'details.barang', 'pembayaranAktif']);
        $this->terapkanFilterLaporan($query, $request);

        $totals = $this->hitungTotalLaporan($query);

        $penyewaans = $query
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.laporans.pdf', array_merge(compact(
            'penyewaans',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ), $totals))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-penyewaan-alat-camping.pdf');
    }

    /**
     * Total Sewa cuma dihitung dari transaksi yang statusnya benar-benar "paid" di Midtrans —
     * bukan seluruh total_harga tanpa syarat (dulu ikut menghitung pengajuan yang belum/tidak dibayar).
     * Total Denda tetap dihitung apa adanya (bukan lewat payment gateway, dicatat manual saat pengembalian).
     */
    private function hitungTotalLaporan($query): array
    {
        $totalSewa = (clone $query)
            ->whereHas('pembayaranAktif', fn ($q) => $q->where('status', 'paid'))
            ->sum('total_harga');

        $totalDenda = (clone $query)->sum('total_denda');

        $totalMenungguBayar = (clone $query)
            ->where(function ($q) {
                $q->whereDoesntHave('pembayaranAktif')
                    ->orWhereHas('pembayaranAktif', fn ($qq) => $qq->where('status', '!=', 'paid'));
            })
            ->sum('total_harga');

        return [
            'totalSewa' => $totalSewa,
            'totalDenda' => $totalDenda,
            'totalPendapatan' => $totalSewa + $totalDenda,
            'totalMenungguBayar' => $totalMenungguBayar,
        ];
    }

    private function terapkanFilterLaporan($query, Request $request): void
    {
        $periode = $request->periode ?? 'semua';

        if ($periode === 'hari_ini') {
            $query->whereDate('tanggal_sewa', Carbon::today());
        }

        if ($periode === 'minggu_ini') {
            $query->whereBetween('tanggal_sewa', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ]);
        }

        if ($periode === 'bulan_ini') {
            $query->whereBetween('tanggal_sewa', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth(),
            ]);
        }

        if ($periode === 'custom' && $request->tanggal) {
            $query->whereDate('tanggal_sewa', $request->tanggal);
        }
    }
}
