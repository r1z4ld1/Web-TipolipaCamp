@extends('layouts.admin.app')

@section('title', 'Edit Role')
@section('page-title', 'Edit Role')
@section('page-subtitle', 'Perbarui role dan permission yang diberikan')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Form Edit Role</h2>
                <p class="text-muted mb-0">
                    Perbarui nama role dan centang permission yang boleh diakses oleh role ini.
                </p>
            </div>

            <a href="{{ route('admin.roles.index') }}" class="btn-outline-navy" style="text-decoration: none;">
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

        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 24px;">
                <label for="name" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Nama Role
                </label>

                <select id="name"
                        name="name"
                        style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                    <option value="">-- Pilih Role --</option>
                    <option value="Admin" {{ old('name', $role->name) === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Petugas" {{ old('name', $role->name) === 'Petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="Penyewa" {{ old('name', $role->name) === 'Penyewa' ? 'selected' : '' }}>Penyewa</option>
                    <option value="Owner" {{ old('name', $role->name) === 'Owner' ? 'selected' : '' }}>Owner</option>
                </select>

                <p class="text-muted small" style="margin-top: 8px;">
                    Role yang digunakan pada sistem hanya Admin, Petugas, Penyewa, dan Owner.
                </p>
            </div>

            <div style="margin-bottom: 18px;">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                    <div>
                        <h3 class="fw-bold mb-1" style="font-size: 18px;">Daftar Permission</h3>
                        <p class="text-muted mb-0">
                            Centang permission yang ingin diberikan pada role ini.
                        </p>
                    </div>

                    <button type="button" onclick="toggleAllPermissions()" class="btn-outline-navy">
                        <i class="bi bi-check2-square"></i>
                        Pilih Semua / Hapus Semua
                    </button>
                </div>

                <div class="row">
                    @foreach ($permissions as $group => $items)
                        <div class="col-12 col-md-6 col-xl-4">
                            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 18px; padding: 18px; height: 100%;">
                                <div class="fw-bold mb-3" style="text-transform: capitalize; color: #0f172a;">
                                    <i class="bi bi-folder2-open"></i>
                                    {{ $group }}
                                </div>

                                @foreach ($items as $permission)
                                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 12px; cursor: pointer;">
                                        <input type="checkbox"
                                               name="permissions[]"
                                               value="{{ $permission->name }}"
                                               class="permission-checkbox"
                                               {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}
                                               style="width: 17px; height: 17px; cursor: pointer;">

                                        <span style="font-size: 14px; color: #334155;">
                                            {{ $permission->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 16px; padding: 16px; margin-bottom: 24px;">
                <div class="fw-bold mb-1" style="color: #1e40af;">
                    <i class="bi bi-info-circle"></i>
                    Catatan
                </div>
                <p class="text-muted small mb-0">
                    Setelah permission role diperbarui, semua user yang memakai role ini akan mengikuti hak akses terbaru.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-navy">
                    <i class="bi bi-save"></i>
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.roles.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        function toggleAllPermissions() {
            const checkboxes = document.querySelectorAll('.permission-checkbox');
            const totalChecked = document.querySelectorAll('.permission-checkbox:checked').length;
            const shouldCheck = totalChecked !== checkboxes.length;

            checkboxes.forEach(function(checkbox) {
                checkbox.checked = shouldCheck;
            });
        }
    </script>
@endsection