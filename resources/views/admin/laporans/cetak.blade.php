<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Penyewaan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            color: #111827;
            margin: 24px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 24px;
        }

        .header h1 {
            margin: 0 0 6px;
            font-size: 22px;
        }

        .header p {
            margin: 0;
            color: #4b5563;
        }

        .info {
            margin-bottom: 16px;
            font-size: 12px;
        }

        .summary {
            width: 100%;
            margin-bottom: 16px;
            border-collapse: collapse;
        }

        .summary td {
            border: 1px solid #d1d5db;
            padding: 10px;
            vertical-align: top;
        }

        .summary-title {
            color: #4b5563;
            font-size: 11px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .summary-value {
            font-size: 16px;
            font-weight: bold;
            color: #111827;
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
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 999px;
            background: #e5e7eb;
            font-size: 11px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
        }

        .ttd {
            text-align: center;
            width: 220px;
        }

        .ttd-space {
            height: 70px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                margin: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 16px;">
        <button onclick="window.print()" style="padding: 10px 16px; cursor: pointer;">
            Cetak Laporan
        </button>
    </div>

    <div class="header">
        <h1>Laporan Penyewaan Alat Camping</h1>
        <p>TipolipaCamp - Sistem Penyewaan Alat Camping</p>
    </div>

    <div class="info">
        Tanggal Cetak: {{ now()->format('d M Y H:i') }}
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
                <th>No</th>
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
                        Kembali: {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}<br>

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

                    <td>{{ $penyewaan->bukti_identitas ?? '-' }}</td>

                    <td>
                        <span class="badge">
                            {{ ucfirst($penyewaan->status) }}
                        </span>

                        @if ($penyewaan->kondisi_pengembalian)
                            <br><br>
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

    <script>
        window.onload = function () {
            window.print();
        };
    </script>
</body>
</html>
