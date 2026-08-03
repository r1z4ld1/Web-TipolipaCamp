@extends('layouts.admin.app')

@section('title', 'Data Penyewaan')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Data Penyewaan</h1>
            <p>Kelola data penyewaan alat camping dari penyewa.</p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form id="penyewaanSearchForm" action="{{ route('petugas.penyewaan.index') }}" method="GET" style="margin: 0;">
                <div style="position: relative;">
                    <input type="text"
                           id="penyewaanSearchInput"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari penyewaan..."
                           autocomplete="off"
                           style="width: 260px; padding: 12px {{ request('search') ? '76px' : '42px' }} 12px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; font-size: 14px;">

                    @if (request('search'))
                        <a href="{{ route('petugas.penyewaan.index') }}"
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

    @if (session('success'))
        <div class="alert-success-modern">
            <div class="left">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-error-modern">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="content-card">
        <div class="table-wrap">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Lama</th>
                        <th>Total</th>
                        <th>Bukti Identitas</th>
                       <th>Status Bayar</th>
                        <th>Status Sewa</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($penyewaans as $penyewaan)
                        <tr>
                            <td>{{ $penyewaans->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="item-name">
                                    {{ $penyewaan->user->name ?? '-' }}
                                </div>

                                <div class="item-desc">
                                    {{ $penyewaan->user->email ?? '-' }}
                                </div>
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}
                            </td>

                            <td>
                                {{ $penyewaan->lama_sewa }} hari
                            </td>

                            <td>
                                Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                            </td>

                            <td>
                                @if ($penyewaan->bukti_identitas)
                                    <span class="badge badge-purple">
                                        {{ $penyewaan->bukti_identitas }}
                                    </span>
                                @else
                                    <span class="badge badge-gray">
                                        Belum Diisi
                                    </span>
                                @endif
                            </td>

                           <td>
    @php $statusBayar = $penyewaan->pembayaranAktif->status ?? null; @endphp

    @if ($statusBayar === 'paid')
        <span class="badge badge-green">Lunas</span>
    @elseif ($statusBayar === 'pending')
        <span class="badge badge-gold">Menunggu Bayar</span>
    @elseif (in_array($statusBayar, ['failed', 'expired', 'cancelled']))
        <span class="badge badge-pink">Belum Lunas</span>
    @else
        <span class="badge badge-gray">Belum Ada Pembayaran</span>
    @endif
</td>

                            <td>
                                @if ($penyewaan->status === 'pending')
                                    <span class="badge badge-gold">Pending</span>
                                @elseif ($penyewaan->status === 'disetujui')
                                    <span class="badge badge-blue">Disetujui</span>
                                @elseif ($penyewaan->status === 'ditolak')
                                    <span class="badge badge-pink">Ditolak</span>
                                @else
                                    <span class="badge badge-green">Selesai</span>
                                @endif
                            </td>

                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('petugas.penyewaan.edit', $penyewaan->id) }}"
                                    class="btn-icon-action btn-edit"
                                    title="Edit Penyewaan">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="padding: 36px; text-align: center; color: #64748b;">
                                @if (request('search'))
                                    Data penyewaan dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada data penyewaan.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$penyewaans" />
    </div>

    <script>
        const penyewaanSearchInput = document.getElementById('penyewaanSearchInput');
        const penyewaanSearchForm = document.getElementById('penyewaanSearchForm');

        if (penyewaanSearchInput && penyewaanSearchForm) {
            let penyewaanTypingTimer;
            let lastPenyewaanSearchValue = penyewaanSearchInput.value;

            penyewaanSearchInput.addEventListener('input', function () {
                clearTimeout(penyewaanTypingTimer);

                penyewaanTypingTimer = setTimeout(function () {
                    const currentValue = penyewaanSearchInput.value.trim();

                    if (currentValue === lastPenyewaanSearchValue.trim()) {
                        return;
                    }

                    if (currentValue.length === 0 || currentValue.length >= 2) {
                        penyewaanSearchForm.submit();
                    }
                }, 1000);
            });
        }
    </script>
@endsection
