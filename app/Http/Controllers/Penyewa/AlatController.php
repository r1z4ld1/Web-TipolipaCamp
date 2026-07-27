<?php

namespace App\Http\Controllers\Penyewa;

use App\Http\Controllers\Controller;
use App\Models\Barang;

class AlatController extends Controller
{
    public function index()
    {
        $search = request('search');

        $barangs = Barang::with('kategori')
            ->where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', '%' . $search . '%')
                      ->orWhereHas('kategori', function ($kategoriQuery) use ($search) {
                          $kategoriQuery->where('nama_kategori', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('penyewa.alat.index', compact('barangs', 'search'));
    }
}