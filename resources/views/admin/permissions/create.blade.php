@extends('layouts.admin.app')

@section('title', 'Tambah Permission')
@section('page-title', 'Tambah Permission')
@section('page-subtitle', 'Tambahkan permission baru untuk kebutuhan hak akses sistem')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Form Tambah Permission</h2>
                <p class="text-muted mb-0">
                    Permission dibuat dengan format group.aksi, contoh: barang.index.
                </p>
            </div>

            <a href="{{ route('admin.permissions.index') }}" class="btn-outline-navy" style="text-decoration: none;">
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

        <form action="{{ route('admin.permissions.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 18px;">
                        <label for="group" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Group Permission
                        </label>

                        <select id="group"
                                name="group"
                                style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                            <option value="">-- Pilih Group --</option>
                            <option value="dashboard" {{ old('group') === 'dashboard' ? 'selected' : '' }}>dashboard</option>
                            <option value="user" {{ old('group') === 'user' ? 'selected' : '' }}>user</option>
                            <option value="role" {{ old('group') === 'role' ? 'selected' : '' }}>role</option>
                            <option value="permission" {{ old('group') === 'permission' ? 'selected' : '' }}>permission</option>
                            <option value="kategori" {{ old('group') === 'kategori' ? 'selected' : '' }}>kategori</option>
                            <option value="barang" {{ old('group') === 'barang' ? 'selected' : '' }}>barang</option>
                            <option value="penyewaan" {{ old('group') === 'penyewaan' ? 'selected' : '' }}>penyewaan</option>
                            <option value="pengembalian" {{ old('group') === 'pengembalian' ? 'selected' : '' }}>pengembalian</option>
                            <option value="laporan" {{ old('group') === 'laporan' ? 'selected' : '' }}>laporan</option>
                            <option value="alat" {{ old('group') === 'alat' ? 'selected' : '' }}>alat</option>
                            <option value="sewa" {{ old('group') === 'sewa' ? 'selected' : '' }}>sewa</option>
                            <option value="aktivitas" {{ old('group') === 'aktivitas' ? 'selected' : '' }}>aktivitas</option>
                        </select>

                        <p class="text-muted small" style="margin-top: 8px;">
                            Group adalah nama modul, misalnya barang, user, role, atau laporan.
                        </p>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 18px;">
                        <label for="action" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Aksi Permission
                        </label>

                        <select id="action"
        name="action"
        style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
    <option value="">-- Pilih Aksi --</option>
    <option value="index" {{ old('action') === 'index' ? 'selected' : '' }}>index</option>
    <option value="create" {{ old('action') === 'create' ? 'selected' : '' }}>create</option>
    <option value="edit" {{ old('action') === 'edit' ? 'selected' : '' }}>edit</option>
    <option value="delete" {{ old('action') === 'delete' ? 'selected' : '' }}>delete</option>
    <option value="status" {{ old('action') === 'status' ? 'selected' : '' }}>status</option>
    <option value="riwayat" {{ old('action') === 'riwayat' ? 'selected' : '' }}>riwayat</option>
    <option value="export" {{ old('action') === 'export' ? 'selected' : '' }}>export</option>
    <option value="cetak" {{ old('action') === 'cetak' ? 'selected' : '' }}>cetak</option>
</select>

                        <p class="text-muted small" style="margin-top: 8px;">
                            Aksi adalah hak akses detail, misalnya index, create, edit, delete.
                        </p>
                    </div>
                </div>
            </div>

            <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 16px; padding: 16px; margin-bottom: 24px;">
                <div class="fw-bold mb-1" style="color: #1e40af;">
                    <i class="bi bi-info-circle"></i>
                    Preview Nama Permission
                </div>

                <p class="text-muted small mb-0">
                    Jika memilih group <strong>barang</strong> dan aksi <strong>index</strong>,
                    maka permission yang dibuat adalah <strong>barang.index</strong>.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-navy">
                    <i class="bi bi-save"></i>
                    Simpan Permission
                </button>

                <a href="{{ route('admin.permissions.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection