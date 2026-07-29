<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Transaksi</title>

    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #111827; }
        .header { text-align: center; margin-bottom: 18px; }
        .header h1 { margin: 0 0 5px; font-size: 18px; }
        .header p { margin: 0; color: #4b5563; font-size: 11px; }
        .status-box {
            text-align: center; margin-bottom: 16px; padding: 10px;
            border: 1px solid #16a34a; color: #16a34a; font-weight: bold; font-size: 14px;
        }
        table.info { width: 100%; margin-bottom: 16px; }
        table.info td { padding: 4px 0; font-size: 11px; vertical-align: top; }
        table.info td.label { color: #4b5563; width: 160px; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        table.items th, table.items td { border: 1px solid #d1d5db; padding: 6px; text-align: left; }
        table.items th { background: #f3f4f6; }
        .total { text-align: right; font-size: 14px; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 9px; color: #6b7280; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bukti Transaksi Pembayaran</h1>
        <p>TipolipaCamp - Sistem Penyewaan Alat Camping</p>
    </div>

    <div class="status-box">LUNAS</div>

    <table class="info">
        <tr>
            <td class="label">Kode Penyewaan</td>
            <td>: {{ $penyewaan->kode_penyewaan }}</td>
            <td class="label">Order ID</td>
            <td>: {{ $pembayaran->order_id }}</td>
        </tr>
        <tr>
            <td class="label">Nama Penyewa</td>
            <td>: {{ $penyewaan->user->name ?? '-' }}</td>
            <td class="label">Metode Pembayaran</td>
            <td>: {{ strtoupper($pembayaran->metode_pembayaran ?? '-') }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Sewa</td>
            <td>: {{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}</td>
            <td class="label">Waktu Pembayaran</td>
            <td>: {{ optional($pembayaran->paid_at)->format('d M Y H:i') ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Kembali</td>
            <td>: {{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}</td>
            <td class="label">Transaction ID</td>
            <td>: {{ $pembayaran->transaction_id ?? '-' }}</td>
        </tr>
    </table>

    <table class="items">
        <thead>
            <tr><th>Alat</th><th>Jumlah</th><th>Lama Sewa</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
            @foreach ($penyewaan->details as $detail)
                <tr>
                    <td>{{ $detail->barang->nama_barang ?? 'Alat tidak ditemukan' }}</td>
                    <td>{{ $detail->jumlah }} unit</td>
                    <td>{{ $penyewaan->lama_sewa }} hari</td>
                    <td>Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">Total Dibayar: Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</div>

    <div class="footer">Dicetak otomatis oleh sistem pada {{ now()->format('d M Y H:i') }}</div>
</body>
</html>
