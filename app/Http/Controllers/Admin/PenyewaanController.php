<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyewaanController extends Controller
{
    public function index()
    {
        $search = request('search');

        $penyewaans = Penyewaan::with(['user', 'details.barang'])
            ->where('status', '!=', 'selesai')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('status', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_sewa', 'like', '%' . $search . '%')
                        ->orWhere('tanggal_kembali', 'like', '%' . $search . '%')
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

        return view('admin.penyewaans.index', compact('penyewaans', 'search'));
    }

    public function edit(Penyewaan $penyewaan)
    {
        $penyewaan->load(['user', 'details.barang']);

        return view('admin.penyewaans.edit', compact('penyewaan'));
    }

    public function update(Request $request, Penyewaan $penyewaan)
    {
        $rules = [
            'status' => ['required', 'in:pending,disetujui,ditolak,selesai'],
            'catatan' => ['nullable', 'string'],
        ];

        if ($request->status === 'selesai') {
            $rules['tanggal_dikembalikan'] = ['required', 'date', 'after_or_equal:tanggal_sewa'];
            $rules['kondisi_pengembalian'] = ['required', 'in:baik,rusak_ringan,rusak_berat'];
            $rules['catatan_pengembalian'] = ['nullable', 'string'];
        }

        $validated = $request->validate($rules, [
            'status.required' => 'Status penyewaan wajib dipilih.',
            'status.in' => 'Status penyewaan tidak valid.',
            'tanggal_dikembalikan.required' => 'Tanggal dikembalikan wajib diisi saat status selesai.',
            'tanggal_dikembalikan.date' => 'Tanggal dikembalikan tidak valid.',
            'tanggal_dikembalikan.after_or_equal' => 'Tanggal dikembalikan tidak boleh sebelum tanggal sewa.',
            'kondisi_pengembalian.required' => 'Kondisi saat kembali wajib dipilih.',
            'kondisi_pengembalian.in' => 'Kondisi saat kembali tidak valid.',
        ]);

        DB::transaction(function () use ($penyewaan, $validated) {
            $statusLama = $penyewaan->status;
            $statusBaru = $validated['status'];

            $penyewaan->load('details.barang');

            if ($statusLama !== 'disetujui' && $statusBaru === 'disetujui') {
                foreach ($penyewaan->details as $detail) {
                    $barang = $detail->barang;

                    if ($barang && $barang->stok < $detail->jumlah) {
                        abort(422, 'Stok alat ' . $barang->nama_barang . ' tidak mencukupi.');
                    }

                    if ($barang) {
                        $barang->decrement('stok', $detail->jumlah);
                        $barang->refresh();

                        if ($barang->stok <= 0) {
                            $barang->update([
                                'status' => 'tidak_tersedia',
                            ]);
                        }
                    }
                }
            }

            if ($statusLama === 'disetujui' && in_array($statusBaru, ['pending', 'ditolak', 'selesai'])) {
                foreach ($penyewaan->details as $detail) {
                    $barang = $detail->barang;

                    if ($barang) {
                        $barang->increment('stok', $detail->jumlah);

                        $barang->update([
                            'status' => 'tersedia',
                        ]);
                    }
                }
            }

            $dataUpdate = [
                'status' => $statusBaru,
                'catatan' => $validated['catatan'] ?? null,
            ];

            if ($statusBaru === 'selesai') {
                $tanggalRencanaKembali = \Carbon\Carbon::parse($penyewaan->tanggal_kembali);
                $tanggalDikembalikan = \Carbon\Carbon::parse($validated['tanggal_dikembalikan']);

                $terlambatHari = $tanggalRencanaKembali->diffInDays($tanggalDikembalikan, false);
                $terlambatHari = $terlambatHari > 0 ? $terlambatHari : 0;

                $dendaPerHari = 10000;
                $totalDenda = $terlambatHari * $dendaPerHari;
                $totalBayar = $penyewaan->total_harga + $totalDenda;

                $dataUpdate['tanggal_dikembalikan'] = $validated['tanggal_dikembalikan'];
                $dataUpdate['kondisi_pengembalian'] = $validated['kondisi_pengembalian'];
                $dataUpdate['catatan_pengembalian'] = $validated['catatan_pengembalian'] ?? null;
                $dataUpdate['terlambat_hari'] = $terlambatHari;
                $dataUpdate['denda_per_hari'] = $dendaPerHari;
                $dataUpdate['total_denda'] = $totalDenda;
                $dataUpdate['total_bayar'] = $totalBayar;
            } else {
                $dataUpdate['tanggal_dikembalikan'] = null;
                $dataUpdate['kondisi_pengembalian'] = null;
                $dataUpdate['catatan_pengembalian'] = null;
                $dataUpdate['terlambat_hari'] = 0;
                $dataUpdate['denda_per_hari'] = 0;
                $dataUpdate['total_denda'] = 0;
                $dataUpdate['total_bayar'] = $penyewaan->total_harga;
            }

            $penyewaan->update($dataUpdate);
        });

        return redirect()
            ->route('petugas.penyewaan.index')
            ->with('success', 'Status penyewaan berhasil diperbarui.');
    }
}