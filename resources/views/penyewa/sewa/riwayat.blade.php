@extends('layouts.admin.app')

@section('title', 'Riwayat Sewa')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Riwayat Sewa</h1>
            <p>Lihat daftar pengajuan penyewaan alat camping kamu.</p>
        </div>

        <a href="{{ route('penyewa.alat.index') }}" class="btn-primary-top">
            <i class="bi bi-plus-lg"></i>
            Sewa Alat Lagi
        </a>
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
                        <th>Alat Camping</th>
                        <th>Tanggal Sewa</th>
                        <th>Tanggal Kembali</th>
                        <th>Lama</th>
                        <th>Total</th>
                        <th>Bukti Identitas</th>
                        <th>Status Bayar</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($penyewaans as $penyewaan)
                        <tr>
                            <td>{{ $penyewaans->firstItem() + $loop->index }}</td>

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
                                {{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}
                            </td>

                            <td>
                                {{ $penyewaan->lama_sewa }} hari
                            </td>

                            <td>
    <div class="item-name">
        Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}
    </div>

    <div class="item-desc">
        Sewa: {{ $penyewaan->lama_sewa }} hari
    </div>

    @if ($penyewaan->status === 'selesai')
        @if (($penyewaan->terlambat_hari ?? 0) > 0)
            <div style="margin-top: 8px;">
                <span class="badge badge-pink">
                    Denda Rp {{ number_format($penyewaan->total_denda, 0, ',', '.') }}
                </span>
            </div>

            <div class="item-desc" style="margin-top: 6px;">
                Terlambat {{ $penyewaan->terlambat_hari }} hari
            </div>

            <div class="item-name" style="margin-top: 6px;">
                Total Bayar Rp {{ number_format(($penyewaan->total_harga + ($penyewaan->total_denda ?? 0)), 0, ',', '.') }}
            </div>
        @else
            <div style="margin-top: 8px;">
                <span class="badge badge-green">
                    Tidak Ada Denda
                </span>
            </div>

            <div class="item-name" style="margin-top: 6px;">
                Total Bayar Rp {{ number_format(($penyewaan->total_harga + ($penyewaan->total_denda ?? 0)), 0, ',', '.') }}
            </div>
        @endif
    @else
        <div class="item-desc" style="margin-top: 6px;">
            Denda dihitung setelah pengembalian selesai.
        </div>
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
    @php
        $statusBayar = $penyewaan->pembayaranAktif->status ?? null;
    @endphp

    @if ($statusBayar === 'paid')
        <span class="badge badge-green">Lunas</span>
    @elseif ($statusBayar === 'failed')
        <span class="badge badge-pink">Gagal</span>
    @elseif ($statusBayar === 'expired')
        <span class="badge badge-gray">Kedaluwarsa</span>
    @elseif ($statusBayar === 'cancelled')
        <span class="badge badge-gray">Dibatalkan</span>
    @elseif ($statusBayar === 'pending')
        <span class="badge badge-gold">Menunggu Bayar</span>
    @else
        <span class="badge badge-gray">Belum Ada Pembayaran</span>
    @endif

    @if (in_array($statusBayar, ['pending', 'failed', 'expired', 'cancelled']) || is_null($statusBayar))
        <div style="margin-top: 6px;">
            <a href="{{ route('penyewa.pembayaran.checkout', $penyewaan) }}" class="badge badge-blue" style="text-decoration: none;">
                <i class="bi bi-credit-card"></i> Lanjutkan Pembayaran
            </a>
        </div>
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="padding: 36px; text-align: center; color: #64748b;">
                                Belum ada riwayat penyewaan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <x-custom-pagination :paginator="$penyewaans" />

    </div>
@endsection
