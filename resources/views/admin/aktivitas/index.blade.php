@extends('layouts.admin.app')

@section('title', 'Aktivitas Sistem')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Aktivitas Sistem</h1>
            <p>Riwayat aktivitas admin dan petugas pada data kategori, alat camping, dan stok barang.</p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form id="aktivitasSearchForm" action="{{ route('aktivitas.index') }}" method="GET" style="margin: 0;">
                <div style="position: relative;">
                    <input type="text"
                           id="aktivitasSearchInput"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari aktivitas..."
                           autocomplete="off"
                           style="width: 260px; padding: 12px {{ request('search') ? '76px' : '42px' }} 12px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; font-size: 14px;">

                    @if (request('search'))
                        <a href="{{ route('aktivitas.index') }}"
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
        </div>
    </div>

    <div class="content-card">
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th style="width: 180px;">Waktu</th>
                        <th style="width: 180px;">Aktor</th>
                        <th style="width: 140px;">Jenis</th>
                        <th style="width: 140px;">Aksi</th>
                        <th>Aktivitas</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($aktivitas as $item)
                        <tr>
                            <td>{{ $aktivitas->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="item-name">
                                    {{ $item->created_at->timezone('Asia/Makassar')->format('d M Y') }}
                                </div>
                                <div class="item-desc">
                                    {{ $item->created_at->timezone('Asia/Makassar')->format('H:i') }} WITA
                                </div>
                            </td>

                            <td>
                                <div class="item-name">
                                    {{ $item->aktor_nama ?? '-' }}
                                </div>
                                <div class="item-desc">
                                    {{ $item->aktor_role ?? '-' }}
                                </div>
                            </td>

                            <td>
                                @if ($item->jenis === 'barang')
                                    <span class="badge badge-blue">Barang</span>
                                @elseif ($item->jenis === 'kategori')
                                    <span class="badge badge-purple">Kategori</span>
                                @elseif ($item->jenis === 'stok')
                                    <span class="badge badge-gold">Stok</span>
                                @else
                                    <span class="badge badge-gray">{{ ucfirst($item->jenis) }}</span>
                                @endif
                            </td>

                            <td>
                                @if ($item->aksi === 'tambah')
                                    <span class="badge badge-green">Tambah</span>
                                @elseif ($item->aksi === 'edit')
                                    <span class="badge badge-blue">Edit</span>
                                @elseif ($item->aksi === 'hapus')
                                    <span class="badge badge-pink">Hapus</span>
                                @else
                                    <span class="badge badge-gray">{{ ucfirst($item->aksi) }}</span>
                                @endif
                            </td>

                            <td>
                                <div class="item-name">
                                    {{ $item->judul }}
                                </div>

                                <div class="item-desc">
                                    {{ $item->deskripsi ?: '-' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="padding: 36px; text-align: center; color: #64748b;">
                                @if (request('search'))
                                    Aktivitas dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada aktivitas sistem.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$aktivitas" />
        
    </div>

    <script>
        const aktivitasSearchInput = document.getElementById('aktivitasSearchInput');
        const aktivitasSearchForm = document.getElementById('aktivitasSearchForm');

        if (aktivitasSearchInput && aktivitasSearchForm) {
            let aktivitasTypingTimer;
            let lastAktivitasSearchValue = aktivitasSearchInput.value;

            aktivitasSearchInput.addEventListener('input', function () {
                clearTimeout(aktivitasTypingTimer);

                aktivitasTypingTimer = setTimeout(function () {
                    const currentValue = aktivitasSearchInput.value.trim();

                    if (currentValue === lastAktivitasSearchValue.trim()) {
                        return;
                    }

                    if (currentValue.length === 0 || currentValue.length >= 2) {
                        aktivitasSearchForm.submit();
                    }
                }, 1000);
            });
        }
    </script>
@endsection