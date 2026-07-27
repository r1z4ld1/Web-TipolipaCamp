<x-guest-layout>
    <div class="auth-card-logo">
        <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo">
    </div>

    <h2>Masuk ke CampRent</h2>

    <p class="auth-card-description">
        Masuk untuk mulai menyewa perlengkapan camping favoritmu.
    </p>

    @if (session('status'))
        <div class="auth-status">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="auth-alert">
            <strong>Login gagal.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control"
                   placeholder="Masukkan email"
                   required
                   autofocus
                   autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>

            <div class="password-wrapper">
                <input id="password"
                       type="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       required
                       autocomplete="current-password">

                <button type="button"
                        class="password-toggle"
                        onclick="togglePassword('password', this)">
                    <i class="bi bi-eye-fill"></i>
                </button>
            </div>
        </div>

        <div class="form-row-between">
            <label class="remember-box">
                <input type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
        </button>
    </form>

    <div class="auth-switch">
        Belum punya akun?
        <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
    </div>
</x-guest-layout>
