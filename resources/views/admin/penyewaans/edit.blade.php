@extends('layouts.admin.app')

@section('title', 'Edit Penyewaan')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Edit Penyewaan</h1>
            <p>Perbarui status penyewaan alat camping.</p>
        </div>

        <a href="{{ route('petugas.penyewaan.index') }}" class="btn-outline-navy">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert-error-modern">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>
                <strong>Data belum valid.</strong>
                <ul style="margin: 8px 0 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-weight: 500;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="content-card">
        <div class="edit-sewa-grid">
            <div class="edit-sewa-info">
                <h2>Detail Penyewaan</h2>

                <div class="info-list">
                    <div>
                        <span>Nama Penyewa</span>
                        <strong>{{ $penyewaan->user->name ?? '-' }}</strong>
                    </div>

                    <div>
                        <span>Email</span>
                        <strong>{{ $penyewaan->user->email ?? '-' }}</strong>
                    </div>

                    <div>
                        <span>Tanggal Sewa</span>
                        <strong>{{ \Carbon\Carbon::parse($penyewaan->tanggal_sewa)->format('d M Y') }}</strong>
                    </div>

                    <div>
                        <span>Tanggal Kembali</span>
                        <strong>{{ \Carbon\Carbon::parse($penyewaan->tanggal_kembali)->format('d M Y') }}</strong>
                    </div>

                    <div>
                        <span>Lama Sewa</span>
                        <strong>{{ $penyewaan->lama_sewa }} hari</strong>
                    </div>

                    <div>
                        <span>Bukti Identitas</span>
                        <strong>{{ $penyewaan->bukti_identitas ?? '-' }}</strong>
                    </div>

                    <div>
                        <span>Total Harga</span>
                        <strong>Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</strong>
                    </div>

                    <div>
                        <span>Status Saat Ini</span>
                        <strong>
                            @if ($penyewaan->status === 'pending')
                                <span class="badge badge-gold">Pending</span>
                            @elseif ($penyewaan->status === 'disetujui')
                                <span class="badge badge-blue">Disetujui</span>
                            @elseif ($penyewaan->status === 'ditolak')
                                <span class="badge badge-pink">Ditolak</span>
                            @else
                                <span class="badge badge-green">Selesai</span>
                            @endif
                        </strong>
                    </div>

                   <div>
    <span>Status Pembayaran</span>
    <strong>
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
    </strong>
</div>
                </div>

                <h3 style="margin: 22px 0 12px; color: #1f2937;">Alat yang Disewa</h3>

                <div class="detail-alat-list">
                    @foreach ($penyewaan->details as $detail)
                        <div class="detail-alat-item">
                            <div class="detail-alat-image">
                                @if ($detail->barang && $detail->barang->foto)
                                    <img src="{{ asset('storage/' . $detail->barang->foto) }}" alt="{{ $detail->barang->nama_barang }}">
                                @else
                                    <i class="bi bi-image"></i>
                                @endif
                            </div>

                            <div class="detail-alat-content">
                                <h4>{{ $detail->barang->nama_barang ?? 'Alat tidak ditemukan' }}</h4>
                                <p>
                                    Jumlah: {{ $detail->jumlah }} unit |
                                    Harga: Rp {{ number_format($detail->harga_sewa, 0, ',', '.') }} / hari
                                </p>
                                <strong>
                                    Subtotal: Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </strong>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="edit-sewa-form">
                <h2>Ubah Status</h2>
                <p>Pilih status penyewaan sesuai kondisi transaksi.</p>

                <form action="{{ route('petugas.penyewaan.update', $penyewaan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group-modern">
                        <label for="status">Status Penyewaan</label>
                        <select id="status" name="status">
                            <option value="pending" {{ old('status', $penyewaan->status) === 'pending' ? 'selected' : '' }}>
                                Pending
                            </option>
                            <option value="disetujui" {{ old('status', $penyewaan->status) === 'disetujui' ? 'selected' : '' }}>
                                Disetujui
                            </option>
                            <option value="ditolak" {{ old('status', $penyewaan->status) === 'ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>
                            <option value="selesai" {{ old('status', $penyewaan->status) === 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>
                        </select>
                    </div>

                    <div class="form-group-modern">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan"
                                  name="catatan"
                                  rows="5"
                                  placeholder="Contoh: Identitas sudah dicek, barang siap diambil.">{{ old('catatan', $penyewaan->catatan) }}</textarea>
                    </div>

                    <div id="pengembalianFields" style="display: none;">
    <div class="form-group-modern">
        <label for="tanggal_dikembalikan">Tanggal Dikembalikan</label>
        <input type="date"
               id="tanggal_dikembalikan"
               name="tanggal_dikembalikan"
               value="{{ old('tanggal_dikembalikan', $penyewaan->tanggal_dikembalikan) }}">
    </div>

    <div class="form-group-modern">
        <label for="kondisi_pengembalian">Kondisi Saat Kembali</label>
        <select id="kondisi_pengembalian" name="kondisi_pengembalian">
            <option value="">-- Pilih Kondisi --</option>
            <option value="baik" {{ old('kondisi_pengembalian', $penyewaan->kondisi_pengembalian) === 'baik' ? 'selected' : '' }}>
                Baik
            </option>
            <option value="rusak_ringan" {{ old('kondisi_pengembalian', $penyewaan->kondisi_pengembalian) === 'rusak_ringan' ? 'selected' : '' }}>
                Rusak Ringan
            </option>
            <option value="rusak_berat" {{ old('kondisi_pengembalian', $penyewaan->kondisi_pengembalian) === 'rusak_berat' ? 'selected' : '' }}>
                Rusak Berat
            </option>
        </select>
    </div>

   {{-- <div class="form-group-modern">
        <label for="catatan_pengembalian">Catatan Pengembalian</label>
        <textarea id="catatan_pengembalian"
                  name="catatan_pengembalian"
                  rows="4"
                  placeholder="Contoh: Barang kembali tepat waktu dan kondisi baik.">{{ old('catatan_pengembalian', $penyewaan->catatan_pengembalian) }}</textarea>
    </div>--}}
</div>

                    <div class="status-note">
                        <i class="bi bi-info-circle-fill"></i>
                        <div>
                            <strong>Catatan Status</strong>
                            <p>
                                Jika status diubah menjadi <b>Disetujui</b>, stok alat akan berkurang otomatis.
                                Jika status Disetujui dikembalikan ke Pending/Ditolak, stok akan dikembalikan.
                            </p>
                        </div>
                    </div>
    @if (($penyewaan->pembayaranAktif->status ?? null) !== 'paid')
    <div class="status-note" style="background: #fff4e5; color: #92400e; margin-top: 12px;">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <strong>Pembayaran belum tercatat lunas</strong>
            <p style="color: #92400e;">
                Pastikan penyewa benar-benar sudah membayar sebelum menyetujui pengajuan ini.
            </p>
        </div>
    </div>
@endif
                    <button type="submit" class="btn-primary-top" style="width: 100%; justify-content: center; margin-top: 18px;">
                        <i class="bi bi-save-fill"></i>
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .edit-sewa-grid {
            display: grid;
            grid-template-columns: 1.4fr 0.8fr;
            gap: 22px;
        }

        .edit-sewa-info,
        .edit-sewa-form {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: #ffffff;
            padding: 22px;
        }

        .edit-sewa-info h2,
        .edit-sewa-form h2 {
            margin: 0 0 8px;
            color: #1f2937;
            font-size: 22px;
            font-weight: 900;
        }

        .edit-sewa-form p {
            margin: 0 0 18px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .info-list {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .info-list div {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
        }

        .info-list span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .info-list strong {
            color: #1f2937;
            font-size: 14px;
            font-weight: 900;
        }

        .detail-alat-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .detail-alat-item {
            display: flex;
            gap: 14px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            border-radius: 16px;
            padding: 14px;
        }

        .detail-alat-image {
            width: 90px;
            height: 74px;
            border-radius: 12px;
            overflow: hidden;
            background: #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            flex-shrink: 0;
        }

        .detail-alat-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-alat-content h4 {
            margin: 0 0 6px;
            color: #1f2937;
            font-size: 15px;
            font-weight: 900;
        }

        .detail-alat-content p {
            margin: 0 0 6px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .detail-alat-content strong {
            color: #092a56;
            font-size: 13px;
            font-weight: 900;
        }

        .form-group-modern {
            margin-bottom: 16px;
        }

        .form-group-modern label {
            display: block;
            font-size: 14px;
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 8px;
        }

        .form-group-modern input,
        .form-group-modern select,
        .form-group-modern textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            padding: 13px 14px;
            outline: none;
            font-size: 14px;
            font-family: inherit;
            background: #ffffff;
        }

        .form-group-modern input:focus,
        .form-group-modern select:focus,
        .form-group-modern textarea:focus {
            border-color: #93c5fd;
            box-shadow: 0 0 0 4px rgba(147, 197, 253, 0.22);
        }

        .status-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #e8f1ff;
            color: #1d5fd0;
            border-radius: 14px;
            padding: 14px;
            font-size: 13px;
            line-height: 1.5;
        }

        .status-note strong {
            display: block;
            margin-bottom: 4px;
        }

        .status-note p {
            margin: 0;
            color: #1d5fd0;
            font-size: 13px;
        }

        @media (max-width: 991.98px) {
            .edit-sewa-grid {
                grid-template-columns: 1fr;
            }

            .info-list {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .detail-alat-item {
                flex-direction: column;
            }

            .detail-alat-image {
                width: 100%;
                height: 180px;
            }
        }
    </style>
@endpush
    @push('scripts')
    <script>
        function togglePengembalianFields() {
            const status = document.getElementById('status').value;
            const fields = document.getElementById('pengembalianFields');

            if (status === 'selesai') {
                fields.style.display = 'block';
            } else {
                fields.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const statusSelect = document.getElementById('status');

            if (statusSelect) {
                togglePengembalianFields();
                statusSelect.addEventListener('change', togglePengembalianFields);
            }
        });
       //bagian script yang ditambah baru
        document.querySelector('form[action="{{ route('petugas.penyewaan.update', $penyewaan->id) }}"]')
    .addEventListener('submit', function (e) {
        const status = document.getElementById('status').value;
        const statusBayar = '{{ $penyewaan->pembayaranAktif->status ?? "" }}';

        if (status === 'disetujui' && statusBayar !== 'paid') {
            const lanjut = confirm('Pembayaran penyewa ini belum tercatat lunas. Tetap setujui pengajuan?');

            if (!lanjut) {
                e.preventDefault();
            }
        }
    });
    </script>
@endpush
