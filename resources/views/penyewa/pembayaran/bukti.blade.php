@extends('layouts.admin.app')

@section('title', 'Bukti Transaksi')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Bukti Transaksi</h1>
            <p>Pembayaran untuk pengajuan sewa {{ $penyewaan->kode_penyewaan }}.</p>
        </div>

        <a href="{{ route('penyewa.pembayaran.buktiPdf', $penyewaan) }}" class="btn-primary-top">
            <i class="bi bi-download"></i>
            Download PDF
        </a>
    </div>

    <style>
        .invoice-card {
            max-width: 720px;
            margin: 0 auto;
        }

        .invoice-status {
            text-align: center;
            padding: 28px 24px 24px;
            border-bottom: 1px dashed #e2e8f0;
            margin-bottom: 24px;
        }

        .invoice-status .badge {
            font-size: 14px;
            padding: 10px 22px;
            letter-spacing: 0.5px;
        }

        .invoice-status p {
            margin: 12px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .invoice-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 32px;
            padding: 0 4px 24px;
        }

        .invoice-info-item span {
            display: block;
            font-size: 12px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 4px;
        }

        .invoice-info-item strong {
            display: block;
            font-size: 15px;
            color: #0f172a;
            word-break: break-word;
        }

        .invoice-divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 0 0 24px;
        }

        .invoice-section-title {
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin: 0 0 12px;
        }

        .invoice-total {
            margin-top: 20px;
            padding: 18px 20px;
            background: #f8fafc;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .invoice-total span {
            font-size: 13px;
            color: #64748b;
        }

        .invoice-total strong {
            font-size: 20px;
            color: #0f172a;
        }

        @media (max-width: 640px) {
            .invoice-info {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="content-card invoice-card">
        <div class="invoice-status">
            <span class="badge badge-green">
                <i class="bi bi-check-circle-fill"></i> LUNAS
            </span>
            <p>Pembayaran telah dikonfirmasi oleh Midtrans</p>
        </div>

        <div class="invoice-info">
            <div class="invoice-info-item">
                <span>Kode Penyewaan</span>
                <strong>{{ $penyewaan->kode_penyewaan }}</strong>
            </div>
            <div class="invoice-info-item">
                <span>Order ID</span>
                <strong>{{ $pembayaran->order_id }}</strong>
            </div>
            <div class="invoice-info-item">
                <span>Metode Pembayaran</span>
                <strong>{{ strtoupper($pembayaran->metode_pembayaran ?? '-') }}</strong>
            </div>
            <div class="invoice-info-item">
                <span>Waktu Pembayaran</span>
                <strong>{{ optional($pembayaran->paid_at)->format('d M Y, H:i') ?? '-' }}</strong>
            </div>
        </div>

        <hr class="invoice-divider">

        <p class="invoice-section-title">Rincian Alat</p>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Lama Sewa</th>
                    <th>Subtotal</th>
                </tr>
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

        <div class="invoice-total">
            <span>Total Dibayar</span>
            <strong>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</strong>
        </div>
    </div>
@endsection
