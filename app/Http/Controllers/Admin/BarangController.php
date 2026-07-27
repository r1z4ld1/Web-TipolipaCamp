<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BarangController extends Controller
{
    public function index()
    {
        $search = request('search');

        $barangs = Barang::with('kategori')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_barang', 'like', '%' . $search . '%')
                      ->orWhereHas('kategori', function ($kategoriQuery) use ($search) {
                          $kategoriQuery->where('nama_kategori', 'like', '%' . $search . '%');
                      });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.barangs.index', compact('barangs', 'search'));
    }

    public function create()
    {
        $kategoris = Kategori::where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.barangs.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'nama_barang' => ['required', 'string', 'max:150', 'unique:barangs,nama_barang'],
            'deskripsi' => ['nullable', 'string'],
            'harga_sewa' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', 'in:baik,rusak_ringan,rusak_berat'],
            'status' => ['required', 'in:tersedia,tidak_tersedia'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.unique' => 'Nama barang sudah digunakan.',
            'harga_sewa.required' => 'Harga sewa wajib diisi.',
            'harga_sewa.numeric' => 'Harga sewa harus berupa angka.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'kondisi.required' => 'Kondisi wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 5MB.',
            'foto.uploaded' => 'Foto gagal diupload. Periksa ukuran file, format gambar, atau pengaturan upload PHP/Laragon.',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('barangs', 'public');
        }

        $barang = Barang::create([
            'kategori_id' => $validated['kategori_id'],
            'nama_barang' => $validated['nama_barang'],
            'slug' => Str::slug($validated['nama_barang']),
            'deskripsi' => $validated['deskripsi'] ?? null,
            'harga_sewa' => $validated['harga_sewa'],
            'stok' => $validated['stok'],
            'kondisi' => $validated['kondisi'],
            'status' => $validated['status'],
            'foto' => $fotoPath,
        ]);

        $barang->load('kategori');

        $this->catatAktivitas(
            'barang',
            'tambah',
            'Alat camping baru ditambahkan',
            'Menambahkan alat camping: ' . $barang->nama_barang . ' dengan stok awal ' . $barang->stok . ' unit.',
            Barang::class,
            $barang->id,
            null,
            $barang->toArray()
        );

        return redirect()
            ->route('admin.barangs.index')
            ->with('success', 'Data alat camping berhasil ditambahkan.');
    }

    public function edit(Barang $barang)
    {
        $kategoris = Kategori::where('status', 'aktif')
            ->orderBy('nama_kategori')
            ->get();

        return view('admin.barangs.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, Barang $barang)
    {
        $dataLama = $barang->toArray();
        $stokLama = $barang->stok;
        $namaBarangLama = $barang->nama_barang;

        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'nama_barang' => [
                'required',
                'string',
                'max:150',
                Rule::unique('barangs', 'nama_barang')->ignore($barang->id),
            ],
            'deskripsi' => ['nullable', 'string'],
            'harga_sewa' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'kondisi' => ['required', 'in:baik,rusak_ringan,rusak_berat'],
            'status' => ['required', 'in:tersedia,tidak_tersedia'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.unique' => 'Nama barang sudah digunakan.',
            'harga_sewa.required' => 'Harga sewa wajib diisi.',
            'harga_sewa.numeric' => 'Harga sewa harus berupa angka.',
            'stok.required' => 'Stok wajib diisi.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
            'kondisi.required' => 'Kondisi wajib dipilih.',
            'status.required' => 'Status wajib dipilih.',
            'foto.image' => 'File harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, png, atau webp.',
            'foto.max' => 'Ukuran foto maksimal 5MB.',
            'foto.uploaded' => 'Foto gagal diupload. Periksa ukuran file, format gambar, atau pengaturan upload PHP/Laragon.',
        ]);

        $fotoPath = $barang->foto;

        if ($request->hasFile('foto')) {
            if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
                Storage::disk('public')->delete($barang->foto);
            }

            $fotoPath = $request->file('foto')->store('barangs', 'public');
        }

        $barang->update([
            'kategori_id' => $validated['kategori_id'],
            'nama_barang' => $validated['nama_barang'],
            'slug' => Str::slug($validated['nama_barang']),
            'deskripsi' => $validated['deskripsi'] ?? null,
            'harga_sewa' => $validated['harga_sewa'],
            'stok' => $validated['stok'],
            'kondisi' => $validated['kondisi'],
            'status' => $validated['status'],
            'foto' => $fotoPath,
        ]);

        $barang->refresh();
        $barang->load('kategori');

        $this->catatAktivitas(
            'barang',
            'edit',
            'Alat camping diperbarui',
            'Memperbarui data alat camping: ' . $barang->nama_barang . '.',
            Barang::class,
            $barang->id,
            $dataLama,
            $barang->toArray()
        );

        if ((int) $stokLama !== (int) $barang->stok) {
    $stokBaru = (int) $barang->stok;
    $selisihStok = $stokBaru - (int) $stokLama;

    if ($selisihStok > 0) {
        $keteranganSelisih = 'Bertambah +' . $selisihStok . ' unit';
    } else {
        $keteranganSelisih = 'Berkurang ' . $selisihStok . ' unit';
    }

    $this->catatAktivitas(
        'stok',
        'edit',
        'Stok alat camping berubah',
        'Mengubah stok ' . $namaBarangLama . ' dari ' . $stokLama . ' unit menjadi ' . $stokBaru . ' unit. Selisih stok: ' . $keteranganSelisih . '.',
        Barang::class,
        $barang->id,
        [
            'stok' => $stokLama,
            'nama_barang' => $namaBarangLama,
        ],
        [
            'stok' => $stokBaru,
            'nama_barang' => $barang->nama_barang,
            'selisih' => $selisihStok,
        ]
    );
}

        return redirect()
            ->route('admin.barangs.index')
            ->with('success', 'Data alat camping berhasil diperbarui.');
    }

    public function destroy(Request $request, Barang $barang)
    {
        $dataLama = $barang->toArray();
        $namaBarang = $barang->nama_barang;
        $stokBarang = $barang->stok;
        $alasan = $request->input('alasan_penghapusan') ?: 'Tidak ada alasan penghapusan yang diisi.';

        if ($barang->foto && Storage::disk('public')->exists($barang->foto)) {
            Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        $this->catatAktivitas(
            'barang',
            'hapus',
            'Alat camping dihapus',
            'Menghapus alat camping: ' . $namaBarang . ' dengan stok terakhir ' . $stokBarang . ' unit. Alasan: ' . $alasan,
            Barang::class,
            $dataLama['id'] ?? null,
            $dataLama,
            null
        );

        return redirect()
            ->route('admin.barangs.index')
            ->with('success', 'Data alat camping berhasil dihapus.');
    }

    private function catatAktivitas($jenis, $aksi, $judul, $deskripsi, $modelType = null, $modelId = null, $dataLama = null, $dataBaru = null): void
    {
        $user = Auth()->user();

        Aktivitas::create([
            'user_id' => $user?->id,
            'aktor_nama' => $user?->name,
            'aktor_role' => $user && method_exists($user, 'getRoleNames') ? $user->getRoleNames()->first() : null,
            'jenis' => $jenis,
            'aksi' => $aksi,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'data_lama' => $dataLama,
            'data_baru' => $dataBaru,
        ]);
    }
}
