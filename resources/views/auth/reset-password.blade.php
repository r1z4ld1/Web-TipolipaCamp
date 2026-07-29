<x-guest-layout>
    <div class="auth-card-logo">
        <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="TipoLipaCamp Logo">
    </div>

    <h2>Atur Ulang Password</h2>

    <p class="auth-card-description">
        Buat password baru untuk akun Anda.
    </p>

    @if ($errors->any())
        <div class="auth-alert">
            <strong>Gagal mengatur ulang password.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email', $request->email) }}"
                   class="form-control"
                   placeholder="Masukkan email"
                   required
                   autofocus
                   autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password Baru</label>

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
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>

            <div class="password-wrapper">
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       class="form-control"
                       placeholder="Ulangi password baru"
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
            <i class="bi bi-check-circle-fill"></i>
            Simpan Password Baru
        </button>
    </form>
</x-guest-layout>