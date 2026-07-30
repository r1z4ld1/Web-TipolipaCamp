<style>
    /* Memaksa teks input menjadi hitam dan tidak buram */
    input[type="email"],
    input[type="password"],
    input[type="text"] {
        color: #000000 !important;
        opacity: 1 !important;
    }
</style>
<x-guest-layout>
    <div class="auth-card-logo">
        <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo">
    </div>

    <h2>Masuk ke TipoLipaCamp</h2>

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


            <!-- Tambahan: Area teks penghitung waktu (hanya muncul saat dilimit) -->
            @if(session('lockout_seconds'))
                <div id="countdown-message" style="margin-top: 10px; font-weight: 600; color: #d9534f;">
                    Silakan coba lagi dalam <span id="timer">{{ session('lockout_seconds') }}</span> detik.
                </div>
            @endif
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
                       placeholder="Masukkan password (minimal 8 karakter)"
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

        <!-- Tambahan: ID "login-btn" agar bisa dikontrol oleh JavaScript -->
        <button type="submit" class="btn-auth" id="login-btn">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
        </button>
    </form>

    <div class="auth-switch">
        Belum punya akun?
        <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
    </div>

    <!-- Tambahan: Script JavaScript Penghitung Mundur -->
    @if(session('lockout_seconds'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let timeLeft = {{ session('lockout_seconds') }};
                const timerSpan = document.getElementById('timer');
                const loginBtn = document.getElementById('login-btn');

                // Matikan tombol login saat limit aktif
                if (loginBtn) {
                    loginBtn.disabled = true;
                    loginBtn.style.opacity = '0.5';
                    loginBtn.style.cursor = 'not-allowed';
                }

                // Hitung mundur tiap 1 detik
                const countdown = setInterval(function () {
                    timeLeft--;
                    if (timerSpan) {
                        timerSpan.textContent = timeLeft;
                    }

                    // Jika waktu habis
                    if (timeLeft <= 0) {
                        clearInterval(countdown);
                        document.getElementById('countdown-message').innerHTML = '<span style="color: #28a745;">Anda sudah bisa mencoba login kembali.</span>';

                        // Aktifkan kembali tombol login
                        if (loginBtn) {
                            loginBtn.disabled = false;
                            loginBtn.style.opacity = '1';
                            loginBtn.style.cursor = 'pointer';
                        }
                    }
                }, 1000); // 1000ms = 1 detik
            });
        </script>
    @endif
</x-guest-layout>
