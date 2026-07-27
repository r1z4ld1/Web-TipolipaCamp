<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aktivitas;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class KategoriController extends Controller
{
    public function index()
{
    $kategoris = Kategori::latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.kategoris.index', compact('kategoris'));
}

    public function create()
    {
        return view('admin.kategoris.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => ['required', 'string', 'max:100', 'unique:kategoris,nama_kategori'],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
            'status.required' => 'Status kategori wajib dipilih.',
            'status.in' => 'Status kategori tidak valid.',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => Str::slug($validated['nama_kategori']),
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'],
        ]);

        $this->catatAktivitas(
            'kategori',
            'tambah',
            'Kategori baru ditambahkan',
            'Menambahkan kategori: ' . $kategori->nama_kategori . '.',
            Kategori::class,
            $kategori->id,
            null,
            $kategori->toArray()
        );

        return redirect()
            ->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $dataLama = $kategori->toArray();

        $validated = $request->validate([
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategoris', 'nama_kategori')->ignore($kategori->id),
            ],
            'deskripsi' => ['nullable', 'string'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
            'status.required' => 'Status kategori wajib dipilih.',
            'status.in' => 'Status kategori tidak valid.',
        ]);

        $kategori->update([
            'nama_kategori' => $validated['nama_kategori'],
            'slug' => Str::slug($validated['nama_kategori']),
            'deskripsi' => $validated['deskripsi'],
            'status' => $validated['status'],
        ]);

        $kategori->refresh();

        $perubahan = [];

if (($dataLama['nama_kategori'] ?? null) !== $kategori->nama_kategori) {
    $perubahan[] = 'nama kategori dari "' . ($dataLama['nama_kategori'] ?? '-') . '" menjadi "' . $kategori->nama_kategori . '"';
}

if (($dataLama['status'] ?? null) !== $kategori->status) {
    $perubahan[] = 'status dari "' . ($dataLama['status'] ?? '-') . '" menjadi "' . $kategori->status . '"';
}

if (($dataLama['deskripsi'] ?? null) !== $kategori->deskripsi) {
    $perubahan[] = 'deskripsi kategori diperbarui';
}

$deskripsiAktivitas = count($perubahan)
    ? 'Memperbarui kategori: ' . implode(', ', $perubahan) . '.'
    : 'Menyimpan ulang kategori: ' . $kategori->nama_kategori . ' tanpa perubahan data utama.';

$this->catatAktivitas(
    'kategori',
    'edit',
    'Kategori diperbarui',
    $deskripsiAktivitas,
    Kategori::class,
    $kategori->id,
    $dataLama,
    $kategori->toArray()
);

        return redirect()
            ->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Request $request, Kategori $kategori)
    {
        $dataLama = $kategori->toArray();
        $namaKategori = $kategori->nama_kategori;
        $alasan = $request->input('alasan_penghapusan') ?: 'Tidak ada alasan penghapusan yang diisi.';

        $kategori->delete();

        $this->catatAktivitas(
            'kategori',
            'hapus',
            'Kategori dihapus',
            'Menghapus kategori: ' . $namaKategori . '. Alasan: ' . $alasan,
            Kategori::class,
            $dataLama['id'] ?? null,
            $dataLama,
            null
        );

        return redirect()
            ->route('admin.kategoris.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    private function catatAktivitas($jenis, $aksi, $judul, $deskripsi, $modelType = null, $modelId = null, $dataLama = null, $dataBaru = null): void
    {
        $user = auth()->user();

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