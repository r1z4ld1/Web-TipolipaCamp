@extends('layouts.admin.app')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('page-subtitle', 'Tambahkan kategori perlengkapan camping baru')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Form Tambah Kategori</h2>
                <p class="text-muted mb-0">
                    Isi data kategori alat camping dengan lengkap.
                </p>
            </div>

            <a href="{{ route('admin.kategoris.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #991b1b; padding: 14px 16px; border-radius: 14px; margin-bottom: 18px; font-weight: 600;">
                <div style="margin-bottom: 6px;">
                    <i class="bi bi-exclamation-circle"></i>
                    Data belum valid:
                </div>

                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-weight: 500;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.kategoris.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 18px;">
                <label for="nama_kategori" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Nama Kategori
                </label>

                <input type="text"
                       id="nama_kategori"
                       name="nama_kategori"
                       value="{{ old('nama_kategori') }}"
                       placeholder="Contoh: Tenda, Carrier, Peralatan Masak"
                       style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 18px;">
                <label for="deskripsi" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Deskripsi
                </label>

                <textarea id="deskripsi"
                          name="deskripsi"
                          rows="4"
                          placeholder="Masukkan deskripsi kategori"
                          style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; resize: vertical;">{{ old('deskripsi') }}</textarea>
            </div>

            <div style="margin-bottom: 24px;">
                <label for="status" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Status
                </label>

                <select id="status"
                        name="status"
                        style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 16px; padding: 16px; margin-bottom: 24px;">
                <div class="fw-bold mb-1" style="color: #1e40af;">
                    <i class="bi bi-info-circle"></i>
                    Catatan
                </div>
                <p class="text-muted small mb-0">
                    Slug kategori akan dibuat otomatis dari nama kategori. Contoh: Peralatan Masak menjadi peralatan-masak.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-navy">
                    <i class="bi bi-save"></i>
                    Simpan Kategori
                </button>

                <a href="{{ route('admin.kategoris.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection