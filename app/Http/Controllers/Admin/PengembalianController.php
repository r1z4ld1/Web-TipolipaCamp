<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;

class PengembalianController extends Controller
{
    public function index()
    {
        $search = request('search');

        $pengembalians = Penyewaan::with(['user', 'details.barang'])
            ->where('status', 'selesai')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('tanggal_sewa', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_kembali', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_dikembalikan', 'like', '%' . $search . '%')
                        ->orWhere('kondisi_pengembalian', 'like', '%' . $search . '%')
                        ->orWhere('bukti_identitas', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('details.barang', function ($barangQuery) use ($search) {
                            $barangQuery->where('nama_barang', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.pengembalians.index', compact('pengembalians', 'search'));
    }
}