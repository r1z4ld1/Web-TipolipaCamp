<x-guest-layout>
    <div class="auth-card-logo">
        <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="TipoLipaCamp Logo">
    </div>

    <h2>Lupa Password?</h2>

    <p class="auth-card-description">
        Masukkan email Anda dan kami akan mengirimkan link untuk mengatur ulang password Anda.
    </p>

    @if (session('status'))
        <div class="auth-status">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="auth-alert">
            <strong>Gagal mengirim link reset password.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control"
                   placeholder="Masukkan email terdaftar"
                   required
                   autofocus>
        </div>

        <button type="submit" class="btn-auth">
            <i class="bi bi-send-fill"></i>
            Kirim Link Reset Password
        </button>
    </form>

    <div class="auth-switch">
        Ingat password Anda?
        <a href="{{ route('login') }}" class="auth-link">Kembali ke Login</a>
    </div>
</x-guest-layout>