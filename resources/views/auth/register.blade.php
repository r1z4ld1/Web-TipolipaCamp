<x-guest-layout>
    <div class="auth-card-logo">
        <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo">
    </div>

    <h2>Daftar Akun CampRent</h2>

    <p class="auth-card-description">
        Buat akun baru untuk menggunakan layanan penyewaan alat camping.
    </p>

    @if ($errors->any())
        <div class="auth-alert">
            <strong>Registrasi gagal.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control"
                   placeholder="Masukkan nama lengkap"
                   required
                   autofocus
                   autocomplete="name">
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control"
                   placeholder="Masukkan email aktif"
                   required
                   autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>

            <div class="password-wrapper">
                <input id="password"
                       type="password"
                       name="password"
                       class="form-control"
                       placeholder="Minimal 8 karakter"
                       required
                       autocomplete="new-password">

                <button type="button"
                        class="password-toggle"
                        onclick="togglePassword('password', this)">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>

            <div class="password-wrapper">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password"
                       required
                       autocomplete="new-password">

                <button type="button"
                        class="password-toggle"
                        onclick="togglePassword('password_confirmation', this)">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-person-plus"></i>
            Daftar Akun
        </button>
    </form>

    <div class="auth-switch">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="auth-link">Login di sini</a>
    </div>
</x-guest-layout>