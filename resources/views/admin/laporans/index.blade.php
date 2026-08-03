@extends('layouts.admin.app')

@section('title', 'Laporan Penyewaan')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Laporan Penyewaan</h1>
            <p>Rekap data penyewaan dan pengembalian alat camping.</p>
        </div>
    </div>

    <div class="laporan-toolbar">
        <form action="{{ route('laporan.index') }}" method="GET" class="laporan-filter-form">
            <select name="periode" id="periodeLaporan" class="laporan-filter-select">
                <option value="semua" {{ request('periode', 'semua') === 'semua' ? 'selected' : '' }}>
                    Semua Data
                </option>

                <option value="hari_ini" {{ request('periode') === 'hari_ini' ? 'selected' : '' }}>
                    Hari Ini
                </option>

                <option value="minggu_ini" {{ request('periode') === 'minggu_ini' ? 'selected' : '' }}>
                    Minggu Ini
                </option>

                <option value="bulan_ini" {{ request('periode') === 'bulan_ini' ? 'selected' : '' }}>
                    Bulan Ini
                </option>

                <option value="custom" {{ request('periode') === 'custom' ? 'selected' : '' }}>
                    Tanggal Tertentu
                </option>
            </select>

            <div id="tanggalCustomWrapper" class="laporan-custom-date-wrap">
                <input type="date"
                       name="tanggal"
                       value="{{ request('tanggal') }}"
                       class="laporan-filter-input">
            </div>

            <button type="submit" class="btn-laporan btn-laporan-primary">
                <i class="bi bi-funnel-fill"></i>
                Filter
            </button>

            @if (request('periode') && request('periode') !== 'semua')
                <a href="{{ route('laporan.index') }}" class="btn-laporan btn-laporan-outline">
                    Reset
                </a>
            @endif
        </form>

        <div class="laporan-action-buttons">
            @can('laporan.cetak')
                <a href="{{ route('laporan.cetak', request()->only(['periode', 'tanggal'])) }}"
                   target="_blank"
                   class="btn-laporan btn-laporan-outline">
                    <i class="bi bi-printer"></i>
                    Cetak
                </a>
            @endcan

            @can('laporan.export')
                <a href="{{ route('laporan.export', request()->only(['periode', 'tanggal'])) }}"
                   class="btn-laporan btn-laporan-primary">
                    <i class="bi bi-file-earmark-pdf-fill"></i>
                    Export PDF
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

    @if (session('error'))
        <div class="alert-error-modern">
            <i class="bi bi-exclamation-circle-fill"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if (request('periode') && request('periode') !== 'semua')
        @php
            $labelPeriode = match(request('periode')) {
                'hari_ini' => 'Hari Ini',
                'minggu_ini' => 'Minggu Ini',
                'bulan_ini' => 'Bulan Ini',
                'custom' => 'Tanggal Tertentu',
                default => 'Semua Data',
            };
        @endphp

        <div class="laporan-periode">
            Periode laporan: {{ $labelPeriode }}

            @if (request('periode') === 'custom' && request('tanggal'))
                —
                {{ \Carbon\Carbon::parse(request('tanggal'))->format('d M Y') }}
            @endif
        </div>
    @endif

   <div class="row g-4 mb-4">
    <!-- Card 1 -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="laporan-summary-card card h-100 border-0 shadow-sm p-3">
            <div class="small text-muted fw-bold mb-1">Total Sewa (Lunas)</div>
            <h3 class="fw-bold mb-0 laporan-total-sewa">
                Rp {{ number_format($totalSewa ?? 0, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="laporan-summary-card card h-100 border-0 shadow-sm p-3">
            <div class="small text-muted fw-bold mb-1">Total Denda</div>
            <h3 class="fw-bold mb-0 laporan-total-denda">
                Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="laporan-summary-card card h-100 border-0 shadow-sm p-3">
            <div class="small text-muted fw-bold mb-1">Total Pendapatan</div>
            <h3 class="fw-bold mb-0 laporan-total-pendapatan">
                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
            </h3>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="laporan-summary-card card h-100 border-0 shadow-sm p-3">
            <div class="small text-muted fw-bold mb-1">Menunggu Dibayar</div>
            <h3 class="fw-bold mb-0">
                Rp {{ number_format($totalMenungguBayar ?? 0, 0, ',', '.') }}
            </h3>
        </div>
    </div>
</div>

    <div class="content-card">
        <div class="table-wrap">
            <table class="data-table table-laporan">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Penyewa</th>
                        <th>Alat Camping</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status Bayar</th>
                        <th>Bukti Identitas</th>
                        <th>Status Sewa</th>
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
                                @foreach ($penyewaan->details as $detail)
                                    <div class="item-name">
                                        {{ $detail->barang->nama_barang ?? 'Alat tidak ditemukan' }}
                                    </div>

                                    <div class="item-desc">
                                        Jumlah: {{ $detail->jumlah }} unit |
                                        Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }} / hari
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                <div class="tanggal-list">
                                    <div>
                                        <span>Sewa</span>
                                        <strong>{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}</strong>
                                    </div>

                                    <div>
                                        <span>Rencana Kembali</span>
                                        <strong>{{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}</strong>
                                    </div>

                                    @if ($penyewaan->tanggal_dikembalikan)
                                        <div>
                                            <span>Dikembalikan</span>
                                            <strong>{{ \Carbon\Carbon::parse($penyewaan->tanggal_dikembalikan)->format('d M Y') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div class="item-name">
                                    Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
                                </div>

                                <div class="item-desc">
                                    Sewa: {{ $penyewaan->lama_sewa }} hari
                                </div>

                                @if (($penyewaan->total_denda ?? 0) > 0)
                                    <div style="margin-top: 8px;">
                                        <span class="badge badge-pink">
                                            Denda Rp {{ number_format($penyewaan->total_denda, 0, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="item-desc" style="margin-top: 6px;">
                                        Terlambat {{ $penyewaan->terlambat_hari }} hari
                                    </div>
                                @else
                                    <div style="margin-top: 8px;">
                                        <span class="badge badge-green">
                                            Tidak Ada Denda
                                        </span>
                                    </div>
                                @endif

                                <div class="item-name" style="margin-top: 6px;">
                                    Total Bayar Rp {{ number_format(($penyewaan->total_harga + ($penyewaan->total_denda ?? 0)), 0, ',', '.') }}
                                </div>
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
                                @if ($penyewaan->status === 'pending')
                                    <span class="badge badge-gold">Pending</span>
                                @elseif ($penyewaan->status === 'disetujui')
                                    <span class="badge badge-blue">Disetujui</span>
                                @elseif ($penyewaan->status === 'ditolak')
                                    <span class="badge badge-pink">Ditolak</span>
                                @else
                                    <span class="badge badge-green">Selesai</span>
                                @endif

                                @if ($penyewaan->kondisi_pengembalian)
                                    <div style="margin-top: 8px;">
                                        @if ($penyewaan->kondisi_pengembalian === 'baik')
                                            <span class="badge badge-green">Kembali Baik</span>
                                        @elseif ($penyewaan->kondisi_pengembalian === 'rusak_ringan')
                                            <span class="badge badge-gold">Rusak Ringan</span>
                                        @else
                                            <span class="badge badge-pink">Rusak Berat</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="padding: 36px; text-align: center; color: #64748b;">
                                Belum ada data laporan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$penyewaans" />
    </div>

    <script>
        const periodeLaporan = document.getElementById('periodeLaporan');
        const tanggalCustomWrapper = document.getElementById('tanggalCustomWrapper');

        function aturTanggalCustom() {
            if (!periodeLaporan || !tanggalCustomWrapper) {
                return;
            }

            if (periodeLaporan.value === 'custom') {
                tanggalCustomWrapper.style.display = 'flex';
            } else {
                tanggalCustomWrapper.style.display = 'none';
            }
        }

        aturTanggalCustom();

        if (periodeLaporan) {
            periodeLaporan.addEventListener('change', aturTanggalCustom);
        }
    </script>
@endsection

@push('styles')
    <style>
        .laporan-toolbar {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .laporan-filter-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            min-width: 0;
        }

        .laporan-action-buttons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
            margin-left: auto;
        }

        .laporan-filter-select,
        .laporan-filter-input {
            height: 46px;
            border-radius: 14px;
            border: 1px solid #cbd5e1;
            padding: 0 14px;
            font-size: 14px;
            font-weight: 800;
            color: #1f2937;
            outline: none;
            background: #ffffff;
        }

        .laporan-filter-select {
            width: 200px;
            cursor: pointer;
        }

        .laporan-filter-input {
            width: 170px;
        }

        .laporan-filter-select:focus,
        .laporan-filter-input:focus {
            border-color: #092a56;
            box-shadow: 0 0 0 3px rgba(9, 42, 86, 0.12);
        }

        .laporan-custom-date-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-laporan {
            width: 150px;
            height: 46px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 9px;
            font-size: 14px;
            font-weight: 900;
            text-decoration: none;
            border: 1px solid #092a56;
            flex-shrink: 0;
        }

        .btn-laporan i {
            font-size: 17px;
        }

        .btn-laporan-outline {
            background: #ffffff;
            color: #092a56;
        }

        .btn-laporan-outline:hover {
            background: #f1f5f9;
            color: #092a56;
        }

        .btn-laporan-primary {
            background: #092a56;
            color: #ffffff;
        }

        .btn-laporan-primary:hover {
            background: #061f42;
            color: #ffffff;
        }

        .laporan-periode {
            margin: 0 0 16px;
            color: #64748b;
            font-size: 14px;
            font-weight: 800;
        }

        .laporan-summary-grid {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin: 0 0 18px;
        }

        .laporan-summary-card {
            min-width: 0;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 22px;
            padding: 22px;
            box-shadow: 0 14px 36px rgba(15, 23, 42, 0.06);
        }

        .laporan-total-sewa {
            color: #1f2937;
        }

        .laporan-total-denda {
            color: #be3144;
        }

        .laporan-total-pendapatan {
            color: #166534;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        .table-laporan {
            width: 100%;
            min-width: 950px !important;
        }

        .table-laporan th,
        .table-laporan td {
            vertical-align: top;
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

        @media (max-width: 992px) {
            .laporan-toolbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .laporan-action-buttons {
                margin-left: 0;
                justify-content: flex-start;
            }

            .laporan-summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .laporan-filter-form,
            .laporan-action-buttons,
            .laporan-filter-select,
            .laporan-filter-input,
            .btn-laporan,
            .laporan-custom-date-wrap {
                width: 100%;
            }
        }
    </style>
@endpush
