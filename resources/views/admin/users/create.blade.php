@extends('layouts.admin.app')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')
@section('page-subtitle', 'Tambahkan user baru dan pilih role pengguna')

@section('content')
    <div class="card-modern p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h2 class="fw-bold mb-1">Form Tambah User</h2>
                <p class="text-muted mb-0">
                    Lengkapi data user dan tentukan role yang akan digunakan.
                </p>
            </div>

            <a href="{{ route('admin.users.index') }}" class="btn-outline-navy" style="text-decoration: none;">
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

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 18px;">
                <label for="name" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Nama User
                </label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Masukkan nama user"
                       style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 18px;">
                <label for="email" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Email
                </label>
                <input type="email"
                       id="email"
                       name="email"
                       value="{{ old('email') }}"
                       placeholder="Masukkan email user"
                       style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">
            </div>

            <div class="row">
                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 18px;">
                        <label for="password" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Password
                        </label>
                        <div style="position: relative;">
    <input type="password"
           id="password"
           name="password"
           placeholder="Minimal 8 karakter"
           style="width: 100%; padding: 13px 46px 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">

    <button type="button"
            onclick="togglePassword('password', 'passwordIcon')"
            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #64748b; font-size: 18px; cursor: pointer;">
        <i id="passwordIcon" class="bi bi-eye"></i>
    </button>
</div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div style="margin-bottom: 18px;">
                        <label for="password_confirmation" style="display: block; font-weight: 700; margin-bottom: 8px;">
                            Konfirmasi Password
                        </label>
                        <div style="position: relative;">
    <input type="password"
           id="password_confirmation"
           name="password_confirmation"
           placeholder="Ulangi password"
           style="width: 100%; padding: 13px 46px 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none;">

    <button type="button"
            onclick="togglePassword('password_confirmation', 'passwordConfirmationIcon')"
            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); border: none; background: transparent; color: #64748b; font-size: 18px; cursor: pointer;">
        <i id="passwordConfirmationIcon" class="bi bi-eye"></i>
    </button>
</div>
                    </div>
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label for="role" style="display: block; font-weight: 700; margin-bottom: 8px;">
                    Role User
                </label>
                <select id="role"
                        name="role"
                        style="width: 100%; padding: 13px 15px; border: 1px solid #cbd5e1; border-radius: 14px; outline: none; background: white;">
                    <option value="">-- Pilih Role --</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex align-items-center gap-3">
                <button type="submit" class="btn-navy">
                    <i class="bi bi-save"></i>
                    Simpan User
                </button>

                <a href="{{ route('admin.users.index') }}" class="btn-outline-navy" style="text-decoration: none;">
                    Batal
                </a>
            </div>
        </form>
    </div>
    <script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endsection