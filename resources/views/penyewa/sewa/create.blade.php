@extends('layouts.admin.app')

@section('title', 'Sewa Alat')

@section('content')
    <div class="page-header">
        <div class="page-title-wrap">
            <h1>Sewa Alat Camping</h1>
            <p>Isi data penyewaan alat camping yang ingin kamu ajukan.</p>
        </div>

        <a href="{{ route('penyewa.alat.index') }}" class="btn-outline-navy">
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
        <div class="sewa-layout">
            <div class="sewa-preview-card">
                <div class="sewa-image-wrap">
                    @if ($barang->foto)
                        <img src="{{ asset('storage/' . $barang->foto) }}"
                             alt="{{ $barang->nama_barang }}"
                             class="sewa-image">
                    @else
                        <div class="sewa-image-empty">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                </div>

                <div class="sewa-preview-body">
                    <span class="badge badge-blue">
                        {{ $barang->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                    </span>

                    <h2>{{ $barang->nama_barang }}</h2>

                    <p>
                        {{ $barang->deskripsi ?: 'Tidak ada deskripsi.' }}
                    </p>

                    <div class="sewa-info-grid">
                        <div>
                            <span>Harga / Hari</span>
                            <strong id="hargaText">Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}</strong>
                        </div>

                        <div>
                            <span>Stok Tersedia</span>
                            <strong>{{ $barang->stok }} unit</strong>
                        </div>

                        <div>
                            <span>Kondisi</span>
                            <strong>
                                @if ($barang->kondisi === 'baik')
                                    Baik
                                @elseif ($barang->kondisi === 'rusak_ringan')
                                    Rusak Ringan
                                @else
                                    Rusak Berat
                                @endif
                            </strong>
                        </div>

                        <div>
                            <span>Status</span>
                            <strong>Tersedia</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sewa-form-card">
                <h2>Form Penyewaan</h2>
                <p>Pengajuan sewa akan masuk dengan status pending.</p>

                <form action="{{ route('penyewa.sewa.store', $barang->id) }}" method="POST">
                    @csrf

                    <input type="hidden" id="harga_sewa" value="{{ $barang->harga_sewa }}">
                    <input type="hidden" id="stok_barang" value="{{ $barang->stok }}">

                    <div class="form-group-modern">
                        <label for="tanggal_sewa">Tanggal Sewa</label>
                        <input type="date"
                               id="tanggal_sewa"
                               name="tanggal_sewa"
                               value="{{ old('tanggal_sewa') }}"
                               min="{{ date('Y-m-d') }}"
                               onchange="hitungTotal()">
                    </div>

                    <div class="form-group-modern">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date"
                               id="tanggal_kembali"
                               name="tanggal_kembali"
                               value="{{ old('tanggal_kembali') }}"
                               min="{{ date('Y-m-d') }}"
                               onchange="hitungTotal()">
                    </div>

                    <div class="form-group-modern">
                        <label for="jumlah">Jumlah Alat</label>
                        <input type="number"
                               id="jumlah"
                               name="jumlah"
                               value="{{ old('jumlah', 1) }}"
                               min="1"
                               max="{{ $barang->stok }}"
                               oninput="hitungTotal()">
                    </div>

                    <div class="form-group-modern">
                        <label for="bukti_identitas">Bukti Identitas</label>
                        <select id="bukti_identitas" name="bukti_identitas">
                            <option value="">-- Pilih Bukti Identitas --</option>
                            <option value="KTP" {{ old('bukti_identitas') === 'KTP' ? 'selected' : '' }}>KTP</option>
                            <option value="SIM" {{ old('bukti_identitas') === 'SIM' ? 'selected' : '' }}>SIM</option>
                            <option value="Kartu Pelajar" {{ old('bukti_identitas') === 'Kartu Pelajar' ? 'selected' : '' }}>Kartu Pelajar</option>
                            <option value="Kartu Mahasiswa" {{ old('bukti_identitas') === 'Kartu Mahasiswa' ? 'selected' : '' }}>Kartu Mahasiswa</option>
                            <option value="Paspor" {{ old('bukti_identitas') === 'Paspor' ? 'selected' : '' }}>Paspor</option>
                            <option value="Lainnya" {{ old('bukti_identitas') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="form-group-modern">
                        <label for="catatan">Catatan</label>
                        <textarea id="catatan"
                                  name="catatan"
                                  rows="3"
                                  placeholder="Contoh: Akan digunakan untuk camping keluarga.">{{ old('catatan') }}</textarea>
                    </div>

                    <div class="sewa-total-box">
                        <div>
                            <span>Lama Sewa</span>
                            <strong id="lamaSewaText">0 hari</strong>
                        </div>

                        <div>
                            <span>Total Harga</span>
                            <strong id="totalHargaText">Rp 0</strong>
                        </div>
                    </div>

                    <div class="sewa-note">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>
                            Setelah diajukan, penyewaan akan menunggu persetujuan petugas/admin.
                        </span>
                    </div>

                    <button type="submit" class="btn-primary-top" style="width: 100%; justify-content: center; margin-top: 18px;">
                        <i class="bi bi-send-fill"></i>
                        Ajukan Penyewaan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .sewa-layout {
            display: grid;
            grid-template-columns: 0.95fr 1.05fr;
            gap: 22px;
        }

        .sewa-preview-card,
        .sewa-form-card {
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            background: #ffffff;
            overflow: hidden;
        }

        .sewa-image-wrap {
            height: 280px;
            background: #f8fafc;
            border-bottom: 1px solid #e5e7eb;
        }

        .sewa-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .sewa-image-empty {
            width: 100%;
            height: 100%;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 44px;
        }

        .sewa-preview-body,
        .sewa-form-card {
            padding: 22px;
        }

        .sewa-preview-body h2,
        .sewa-form-card h2 {
            margin: 14px 0 8px;
            color: #1f2937;
            font-size: 22px;
            font-weight: 900;
        }

        .sewa-preview-body p,
        .sewa-form-card p {
            margin: 0 0 18px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
        }

        .sewa-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .sewa-info-grid div,
        .sewa-total-box {
            background: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 14px;
        }

        .sewa-info-grid span,
        .sewa-total-box span {
            display: block;
            color: #64748b;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 6px;
        }

        .sewa-info-grid strong,
        .sewa-total-box strong {
            color: #1f2937;
            font-size: 14px;
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

        .sewa-total-box {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-top: 4px;
        }

        .sewa-total-box div {
            padding: 0;
        }

        .sewa-total-box strong {
            font-size: 17px;
        }

        .sewa-note {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            background: #e8f1ff;
            color: #1d5fd0;
            border-radius: 14px;
            padding: 14px;
            margin-top: 16px;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
        }

        @media (max-width: 991.98px) {
            .sewa-layout {
                grid-template-columns: 1fr;
            }

            .sewa-image-wrap {
                height: 230px;
            }
        }

        @media (max-width: 576px) {
            .sewa-info-grid,
            .sewa-total-box {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function hitungTotal() {
            const tanggalSewa = document.getElementById('tanggal_sewa').value;
            const tanggalKembali = document.getElementById('tanggal_kembali').value;
            const jumlah = parseInt(document.getElementById('jumlah').value || 1);
            const harga = parseInt(document.getElementById('harga_sewa').value || 0);

            let lama = 0;
            let total = 0;

            if (tanggalSewa && tanggalKembali) {
                const start = new Date(tanggalSewa);
                const end = new Date(tanggalKembali);
                const diffTime = end - start;
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays > 0) {
                    lama = diffDays;
                    total = harga * jumlah * lama;
                }
            }

            document.getElementById('lamaSewaText').innerText = lama + ' hari';
            document.getElementById('totalHargaText').innerText = 'Rp ' + formatRupiah(total);
        }

        document.addEventListener('DOMContentLoaded', hitungTotal);
    </script>
@endpush