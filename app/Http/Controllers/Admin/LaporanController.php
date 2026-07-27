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

        $query = Penyewaan::with(['user', 'details.barang']);
        $this->terapkanFilterLaporan($query, $request);

        $totalSewa = (clone $query)->sum('total_harga');
        $totalDenda = (clone $query)->sum('total_denda');
        $totalPendapatan = $totalSewa + $totalDenda;

        $penyewaans = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.laporans.index', compact(
            'penyewaans',
            'totalSewa',
            'totalDenda',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ));
    }

    public function cetak(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $periode = $request->periode ?? 'semua';

        $query = Penyewaan::with(['user', 'details.barang']);
        $this->terapkanFilterLaporan($query, $request);

        $totalSewa = (clone $query)->sum('total_harga');
        $totalDenda = (clone $query)->sum('total_denda');
        $totalPendapatan = $totalSewa + $totalDenda;

        $penyewaans = $query
            ->latest()
            ->get();

        return view('admin.laporans.cetak', compact(
            'penyewaans',
            'totalSewa',
            'totalDenda',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ));
    }

    public function exportPdf(Request $request)
    {
        $tanggalMulai = $request->tanggal_mulai;
        $tanggalSelesai = $request->tanggal_selesai;
        $periode = $request->periode ?? 'semua';

        $query = Penyewaan::with(['user', 'details.barang']);
        $this->terapkanFilterLaporan($query, $request);

        $totalSewa = (clone $query)->sum('total_harga');
        $totalDenda = (clone $query)->sum('total_denda');
        $totalPendapatan = $totalSewa + $totalDenda;

        $penyewaans = $query
            ->latest()
            ->get();

        $pdf = Pdf::loadView('admin.laporans.pdf', compact(
            'penyewaans',
            'totalSewa',
            'totalDenda',
            'totalPendapatan',
            'tanggalMulai',
            'tanggalSelesai',
            'periode'
        ))->setPaper('a4', 'landscape');

        return $pdf->download('laporan-penyewaan-alat-camping.pdf');
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