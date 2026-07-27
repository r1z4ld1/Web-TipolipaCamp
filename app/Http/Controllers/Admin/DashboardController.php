<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Penyewaan;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function admin()
    {
        abort_unless(auth()->user()->hasRole('Admin'), 403);

        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPermissions = Permission::count();
        $totalKategori = Kategori::count();
        $totalBarang = Barang::count();
        $totalPenyewaan = Penyewaan::count();
        $totalPengembalian = Penyewaan::where('status', 'selesai')->count();

        return view('admin.dashboard.admin', compact(
            'totalUsers',
            'totalRoles',
            'totalPermissions',
            'totalKategori',
            'totalBarang',
            'totalPenyewaan',
            'totalPengembalian'
        ));
    }

    public function petugas()
    {
        abort_unless(auth()->user()->hasRole('Petugas'), 403);

        $totalKategori = Kategori::count();
        $totalBarang = Barang::count();
        $totalPenyewaanAktif = Penyewaan::whereIn('status', ['pending', 'disetujui', 'ditolak'])->count();
        $totalPengembalian = Penyewaan::where('status', 'selesai')->count();

        return view('admin.dashboard.petugas', compact(
            'totalKategori',
            'totalBarang',
            'totalPenyewaanAktif',
            'totalPengembalian'
        ));
    }

    public function penyewa()
    {
        abort_unless(auth()->user()->hasRole('Penyewa'), 403);

        $totalAlatTersedia = Barang::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->count();

        $totalRiwayat = Penyewaan::where('user_id', auth()->id())->count();

        $totalPending = Penyewaan::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        $totalDisetujui = Penyewaan::where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->count();

        return view('admin.dashboard.penyewa', compact(
            'totalAlatTersedia',
            'totalRiwayat',
            'totalPending',
            'totalDisetujui'
        ));
    }

    public function owner()
    {
        abort_unless(auth()->user()->hasRole('Owner'), 403);

        $totalPenyewaan = Penyewaan::count();
        $totalSelesai = Penyewaan::where('status', 'selesai')->count();
        $totalPending = Penyewaan::where('status', 'pending')->count();
        $totalPendapatan = Penyewaan::whereIn('status', ['disetujui', 'selesai'])->sum('total_harga');

        return view('admin.dashboard.owner', compact(
            'totalPenyewaan',
            'totalSelesai',
            'totalPending',
            'totalPendapatan'
        ));
    }
}