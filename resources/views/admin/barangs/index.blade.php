@extends('layouts.admin.app')

@section('title', 'Alat Camping')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Alat Camping</h1>
            <p>Kelola data alat camping, stok, harga sewa, dan foto barang</p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form id="barangSearchForm" action="{{ route('admin.barangs.index') }}" method="GET" style="margin: 0;">
                <div style="position: relative;">
                    <input type="text"
                           id="barangSearchInput"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari alat camping..."
                           autocomplete="off"
                           style="width: 260px; padding: 12px {{ request('search') ? '76px' : '42px' }} 12px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; font-size: 14px;">

                    @if (request('search'))
                        <a href="{{ route('admin.barangs.index') }}"
                           title="Reset pencarian"
                           style="position: absolute; right: 43px; top: 50%; transform: translateY(-50%); border: none; background: #ffffff; color: #0a2f63; width: 28px; height: 28px; border-radius: 9px; display: flex; align-items: center; justify-content: center; text-decoration: none; font-size: 16px;">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    @endif

                    <button type="submit"
                            style="position: absolute; right: 8px; top: 50%; transform: translateY(-50%); border: none; background: #0a2f63; color: #ffffff; width: 30px; height: 30px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            @can('barang.create')
                <a href="{{ route('admin.barangs.create') }}" class="btn-primary-top">
                    <i class="bi bi-plus-lg"></i>
                    <span>Tambah Alat</span>
                </a>
            @endcan
        </div>
    </div>

    @if (session('success'))
        <div class="alert-success-modern">
            <div class="left">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    <div class="content-card">
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th style="width: 150px;">Foto</th>
                        <th style="min-width: 260px;">Nama Alat</th>
                        <th style="width: 150px;">Kategori</th>
                        <th style="width: 150px;">Harga / Hari</th>
                        <th style="width: 90px;">Stok</th>
                        <th style="width: 140px;">Kondisi</th>
                        <th style="width: 150px;">Status</th>
                        <th style="width: 110px; text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($barangs as $barang)
                        @php
                            $kategoriNama = $barang->kategori->nama_kategori ?? '-';
                            $kategoriLower = strtolower($kategoriNama);

                            $kategoriClass = 'badge-blue';

                            if ($kategoriLower === 'carrier') {
                                $kategoriClass = 'badge-purple';
                            } elseif ($kategoriLower === 'sleeping bag') {
                                $kategoriClass = 'badge-gold';
                            } elseif ($kategoriLower === 'peralatan masak') {
                                $kategoriClass = 'badge-pink';
                            } elseif ($kategoriLower === 'tenda') {
                                $kategoriClass = 'badge-blue';
                            }
                        @endphp

                        <tr>
                            <td>{{ $barangs->firstItem() + $loop->index }}</td>

                            <td>
                                @if ($barang->foto)
                                    <img src="{{ asset('storage/' . $barang->foto) }}"
                                         alt="{{ $barang->nama_barang }}"
                                         class="item-photo">
                                @else
                                    <div class="item-photo-empty">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>

                            <td>
                                <div class="item-name">
                                    {{ $barang->nama_barang }}
                                </div>

                                <div class="item-desc">
                                    {{ $barang->deskripsi ? \Illuminate\Support\Str::limit($barang->deskripsi, 95) : $barang->slug }}
                                </div>
                            </td>

                            <td>
                                <span class="badge {{ $kategoriClass }}">
                                    {{ $kategoriNama }}
                                </span>
                            </td>

                            <td>
                                Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}
                            </td>

                            <td>
                                {{ $barang->stok }}
                            </td>

                            <td>
                                @if ($barang->kondisi === 'baik')
                                    <span class="badge badge-green">Baik</span>
                                @elseif ($barang->kondisi === 'rusak_ringan')
                                    <span class="badge badge-gold">Rusak Ringan</span>
                                @else
                                    <span class="badge badge-pink">Rusak Berat</span>
                                @endif
                            </td>

                            <td>
                                @if ($barang->status === 'tersedia')
                                    <span class="badge badge-blue">Tersedia</span>
                                @else
                                    <span class="badge badge-gray">Tidak Tersedia</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">
                                    @can('barang.edit')
                                        <a href="{{ route('admin.barangs.edit', $barang->id) }}"
                                           class="btn-icon-action btn-edit"
                                           title="Edit">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    @endcan

                                    @can('barang.delete')
                                        <form action="{{ route('admin.barangs.destroy', $barang->id) }}"
                                              method="POST"
                                              onsubmit="return isiAlasanHapusBarang(this)"
                                              style="margin: 0;">
                                            @csrf
                                            @method('DELETE')

                                            <input type="hidden" name="alasan_penghapusan" class="alasan-penghapusan">

                                            <button type="submit"
                                                    class="btn-icon-action btn-delete"
                                                    title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="padding: 36px; text-align: center; color: #64748b;">
                                @if (request('search'))
                                    Data alat camping dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada data alat camping.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$barangs" />
    </div>

    <script>
        const barangSearchInput = document.getElementById('barangSearchInput');
        const barangSearchForm = document.getElementById('barangSearchForm');

        if (barangSearchInput && barangSearchForm) {
            let barangTypingTimer;
            let lastSearchValue = barangSearchInput.value;

            barangSearchInput.addEventListener('input', function () {
                clearTimeout(barangTypingTimer);

                barangTypingTimer = setTimeout(function () {
                    const currentValue = barangSearchInput.value.trim();

                    if (currentValue === lastSearchValue.trim()) {
                        return;
                    }

                    if (currentValue.length === 0 || currentValue.length >= 2) {
                        barangSearchForm.submit();
                    }
                }, 1000);
            });
        }

        function isiAlasanHapusBarang(form) {
            const alasan = prompt('Masukkan alasan penghapusan alat camping ini:');

            if (alasan === null) {
                return false;
            }

            if (alasan.trim() === '') {
                alert('Alasan penghapusan wajib diisi.');
                return false;
            }

            form.querySelector('.alasan-penghapusan').value = alasan.trim();

            return confirm('Yakin ingin menghapus alat camping ini? Foto juga akan ikut terhapus.');
        }
    </script>
@endsection