@extends('layouts.admin.app')

@section('title', 'Data Pengembalian')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Data Pengembalian</h1>
            <p>Data alat camping yang sudah dikembalikan oleh penyewa.</p>
        </div>

        <div class="d-flex align-items-center gap-2 flex-wrap">
            <form id="pengembalianSearchForm" action="{{ route('petugas.pengembalian.index') }}" method="GET" style="margin: 0;">
                <div style="position: relative;">
                    <input type="text"
                           id="pengembalianSearchInput"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari pengembalian..."
                           autocomplete="off"
                           style="width: 260px; padding: 12px {{ request('search') ? '76px' : '42px' }} 12px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; font-size: 14px;">

                    @if (request('search'))
                        <a href="{{ route('petugas.pengembalian.index') }}"
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
            <table class="data-table table-pengembalian">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Penyewa</th>
                        <th>Alat Camping</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($pengembalians as $pengembalian)
                        <tr>
                            <td>{{ $pengembalians->firstItem() + $loop->index }}</td>

                            <td>
                                <div class="item-name">
                                    {{ $pengembalian->user->name ?? '-' }}
                                </div>

                                <div class="item-desc">
                                    {{ $pengembalian->user->email ?? '-' }}
                                </div>

                                <div style="margin-top: 8px;">
                                    @if ($pengembalian->bukti_identitas)
                                        <span class="badge badge-purple">
                                            {{ $pengembalian->bukti_identitas }}
                                        </span>
                                    @else
                                        <span class="badge badge-gray">
                                            Identitas belum diisi
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td>
                                @foreach ($pengembalian->details as $detail)
                                    <div class="item-name">
                                        {{ $detail->barang->nama_barang ?? 'Alat tidak ditemukan' }}
                                    </div>

                                    <div class="item-desc">
                                        Jumlah: {{ $detail->jumlah }} unit
                                    </div>

                                    <div class="item-desc">
                                        Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }} / hari
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                <div class="tanggal-list">
                                    <div>
                                        <span>Sewa</span>
                                        <strong>{{ \Carbon\Carbon::parse($pengembalian->tanggal_sewa)->format('d M Y') }}</strong>
                                    </div>

                                    <div>
                                        <span>Rencana Kembali</span>
                                        <strong>{{ \Carbon\Carbon::parse($pengembalian->tanggal_kembali)->format('d M Y') }}</strong>
                                    </div>

                                    <div>
                                        <span>Dikembalikan</span>

                                        @if ($pengembalian->tanggal_dikembalikan)
                                            <strong>{{ \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan)->format('d M Y') }}</strong>

                                            @php
                                                $tanggalRencana = \Carbon\Carbon::parse($pengembalian->tanggal_kembali);
                                                $tanggalDikembalikan = \Carbon\Carbon::parse($pengembalian->tanggal_dikembalikan);
                                                $terlambat = $tanggalRencana->diffInDays($tanggalDikembalikan, false);
                                            @endphp

                                            @if ($terlambat > 0)
                                                <small class="text-danger-custom">
                                                    Terlambat {{ $terlambat }} hari
                                                </small>
                                            @else
                                                <small class="text-success-custom">
                                                    Tepat waktu
                                                </small>
                                            @endif
                                        @else
                                            <strong>-</strong>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <td>
    <div class="item-name">
        Rp {{ number_format($pengembalian->total_harga, 0, ',', '.') }}
    </div>

    <div class="item-desc">
        Sewa: {{ $pengembalian->lama_sewa }} hari
    </div>

    @if (($pengembalian->terlambat_hari ?? 0) > 0)
        <div style="margin-top: 8px;">
            <span class="badge badge-pink">
                Denda Rp {{ number_format($pengembalian->total_denda, 0, ',', '.') }}
            </span>
        </div>

        <div class="item-desc" style="margin-top: 6px;">
            Terlambat {{ $pengembalian->terlambat_hari }} hari
        </div>

        <div class="item-name" style="margin-top: 6px;">
            Total Bayar Rp {{ number_format($pengembalian->total_bayar, 0, ',', '.') }}
        </div>
    @else
        <div style="margin-top: 8px;">
            <span class="badge badge-green">
                Tidak Ada Denda
            </span>
        </div>

        <div class="item-name" style="margin-top: 6px;">
            Total Bayar Rp {{ number_format($pengembalian->total_bayar ?: $pengembalian->total_harga, 0, ',', '.') }}
        </div>
    @endif
</td>

                            <td>
                                <div style="margin-bottom: 8px;">
                                    @if ($pengembalian->kondisi_pengembalian === 'baik')
                                        <span class="badge badge-green">Baik</span>
                                    @elseif ($pengembalian->kondisi_pengembalian === 'rusak_ringan')
                                        <span class="badge badge-gold">Rusak Ringan</span>
                                    @elseif ($pengembalian->kondisi_pengembalian === 'rusak_berat')
                                        <span class="badge badge-pink">Rusak Berat</span>
                                    @else
                                        <span class="badge badge-gray">Belum Diisi</span>
                                    @endif
                                </div>

                                <div class="item-desc pengembalian-catatan">
                                    {{ $pengembalian->catatan_pengembalian ?: '-' }}
                                </div>
                            </td>

                            <td>
                                <span class="badge badge-green">Selesai</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="padding: 36px; text-align: center; color: #64748b;">
                                @if (request('search'))
                                    Data pengembalian dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                                @else
                                    Belum ada data pengembalian.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$pengembalians" />

    </div>

    <script>
        const pengembalianSearchInput = document.getElementById('pengembalianSearchInput');
        const pengembalianSearchForm = document.getElementById('pengembalianSearchForm');

        if (pengembalianSearchInput && pengembalianSearchForm) {
            let pengembalianTypingTimer;
            let lastPengembalianSearchValue = pengembalianSearchInput.value;

            pengembalianSearchInput.addEventListener('input', function () {
                clearTimeout(pengembalianTypingTimer);

                pengembalianTypingTimer = setTimeout(function () {
                    const currentValue = pengembalianSearchInput.value.trim();

                    if (currentValue === lastPengembalianSearchValue.trim()) {
                        return;
                    }

                    if (currentValue.length === 0 || currentValue.length >= 2) {
                        pengembalianSearchForm.submit();
                    }
                }, 1000);
            });
        }
    </script>
@endsection

@push('styles')
    <style>
        .table-pengembalian {
            min-width: 0 !important;
            width: 100%;
        }

        .table-pengembalian th,
        .table-pengembalian td {
            vertical-align: top;
        }

        .table-pengembalian th:nth-child(1),
        .table-pengembalian td:nth-child(1) {
            width: 55px;
        }

        .table-pengembalian th:nth-child(2),
        .table-pengembalian td:nth-child(2) {
            width: 20%;
        }

        .table-pengembalian th:nth-child(3),
        .table-pengembalian td:nth-child(3) {
            width: 21%;
        }

        .table-pengembalian th:nth-child(4),
        .table-pengembalian td:nth-child(4) {
            width: 24%;
        }

        .table-pengembalian th:nth-child(5),
        .table-pengembalian td:nth-child(5) {
            width: 12%;
        }

        .table-pengembalian th:nth-child(6),
        .table-pengembalian td:nth-child(6) {
            width: 18%;
        }

        .table-pengembalian th:nth-child(7),
        .table-pengembalian td:nth-child(7) {
            width: 10%;
        }

        .tanggal-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .tanggal-list span {
            display: block;
            font-size: 11px;
            color: #64748b;
            font-weight: 800;
            margin-bottom: 2px;
        }

        .tanggal-list strong {
            display: block;
            color: #1f2937;
            font-size: 13px;
            font-weight: 900;
        }

        .tanggal-list small {
            display: block;
            margin-top: 2px;
            font-size: 11px;
            font-weight: 900;
        }

        .text-success-custom {
            color: #229954;
        }

        .text-danger-custom {
            color: #be3144;
        }

        .pengembalian-catatan {
            max-width: 230px;
            line-height: 1.5;
        }

        @media (max-width: 1199.98px) {
            .table-wrap {
                overflow-x: auto;
            }

            .table-pengembalian {
                min-width: 950px !important;
            }
        }
    </style>
@endpush