<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penyewaan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #111827;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header h1 {
            margin: 0 0 5px;
            font-size: 18px;
        }

        .header p {
            margin: 0;
            color: #4b5563;
            font-size: 11px;
        }

        .info {
            margin-bottom: 12px;
            font-size: 10px;
        }

        .summary {
            width: 100%;
            margin-bottom: 14px;
        }

        .summary td {
            border: 1px solid #d1d5db;
            padding: 8px;
            font-size: 11px;
        }

        .summary-title {
            color: #4b5563;
            font-size: 10px;
            margin-bottom: 4px;
        }

        .summary-value {
            font-size: 13px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f3f4f6;
            font-weight: bold;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 6px;
            text-align: left;
            vertical-align: top;
        }

        .status {
            font-weight: bold;
            text-transform: capitalize;
        }

        .footer {
            margin-top: 28px;
            width: 100%;
        }

        .ttd {
            width: 220px;
            text-align: center;
            float: right;
        }

        .ttd-space {
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Laporan Penyewaan Alat Camping</h1>
        <p>CampRent - Sistem Penyewaan Alat Camping</p>
    </div>

    <div class="info">
        Tanggal Export: {{ now()->format('d M Y H:i') }}
        <br>
Periode Laporan:
{{ $tanggalMulai ? \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') : 'Awal' }}
sampai
{{ $tanggalSelesai ? \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') : 'Akhir' }}
    </div>

    <table class="summary">
        <tr>
            <td>
                <div class="summary-title">Total Sewa</div>
                <div class="summary-value">
                    Rp {{ number_format($totalSewa ?? 0, 0, ',', '.') }}
                </div>
            </td>

            <td>
                <div class="summary-title">Total Denda</div>
                <div class="summary-value">
                    Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}
                </div>
            </td>

            <td>
                <div class="summary-title">Total Pendapatan</div>
                <div class="summary-value">
                    Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th style="width: 28px;">No</th>
                <th>Penyewa</th>
                <th>Alat Camping</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Identitas</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($penyewaans as $penyewaan)
                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $penyewaan->user->name ?? '-' }}</strong><br>
                        {{ $penyewaan->user->email ?? '-' }}
                    </td>

                    <td>
                        @foreach ($penyewaan->details as $detail)
                            <strong>{{ $detail->barang->nama_barang ?? 'Alat tidak ditemukan' }}</strong><br>
                            Jumlah: {{ $detail->jumlah }} unit<br>
                            Harga: Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }} / hari
                            @if (!$loop->last)
                                <br><br>
                            @endif
                        @endforeach
                    </td>

                    <td>
                        Sewa: {{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}<br>
                        Rencana Kembali: {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}<br>

                        @if ($penyewaan->tanggal_dikembalikan)
                            Dikembalikan: {{ \Carbon\Carbon::parse($penyewaan->tanggal_dikembalikan)->format('d M Y') }}<br>

                            @if (($penyewaan->terlambat_hari ?? 0) > 0)
                                Terlambat: {{ $penyewaan->terlambat_hari }} hari
                            @else
                                Tepat waktu
                            @endif
                        @else
                            Dikembalikan: -
                        @endif
                    </td>

                    <td>
                        Sewa: Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}<br>
                        Lama: {{ $penyewaan->lama_sewa }} hari<br>

                        @if (($penyewaan->total_denda ?? 0) > 0)
                            Denda: Rp {{ number_format($penyewaan->total_denda, 0, ',', '.') }}<br>
                        @else
                            Denda: Rp 0<br>
                        @endif

                        <strong>
                            Total Bayar:
                            Rp {{ number_format(($penyewaan->total_harga + ($penyewaan->total_denda ?? 0)), 0, ',', '.') }}
                        </strong>
                    </td>

                    <td>
                        {{ $penyewaan->bukti_identitas ?? '-' }}
                    </td>

                    <td>
                        <span class="status">{{ $penyewaan->status }}</span>

                        @if ($penyewaan->kondisi_pengembalian)
                            <br>
                            Kondisi kembali:
                            @if ($penyewaan->kondisi_pengembalian === 'baik')
                                Baik
                            @elseif ($penyewaan->kondisi_pengembalian === 'rusak_ringan')
                                Rusak Ringan
                            @else
                                Rusak Berat
                            @endif
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">
                        Belum ada data laporan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div class="ttd">
            <p>Mengetahui,</p>
            <div class="ttd-space"></div>
            <strong>Owner / Admin</strong>
        </div>
    </div>
</body>
</html>