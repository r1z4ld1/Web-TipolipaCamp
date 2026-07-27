@extends('layouts.admin.app')

@section('title', 'Pembayaran')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Pembayaran</h1>
            <p>Selesaikan pembayaran untuk pengajuan sewa {{ $penyewaan->kode_penyewaan }}.</p>
        </div>
    </div>

    <div class="content-card">
        <div class="sewa-info-grid">
            <div>
                <span>Kode Penyewaan</span>
                <strong>{{ $penyewaan->kode_penyewaan }}</strong>
            </div>

            <div>
                <span>Total Tagihan</span>
                <strong>Rp {{ number_format($pembayaran->jumlah, 0, ',', '.') }}</strong>
            </div>
        </div>

        <button id="pay-button" class="btn-primary-top" style="margin-top: 24px;">
            <i class="bi bi-credit-card"></i>
            Bayar Sekarang
        </button>
    </div>

    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $pembayaran->snap_token }}', {
                onSuccess: function () {
                    window.location.href = "{{ route('penyewa.sewa.riwayat') }}";
                },
                onPending: function () {
                    window.location.href = "{{ route('penyewa.sewa.riwayat') }}";
                },
                onError: function () {
                    alert('Pembayaran gagal, silakan coba lagi.');
                },
                onClose: function () {
                    alert('Kamu menutup jendela pembayaran sebelum selesai.');
                }
            });
        });
    </script>
@endsection
