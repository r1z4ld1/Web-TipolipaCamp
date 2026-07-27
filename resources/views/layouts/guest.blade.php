<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Camping Rental') }}</title>

    @vite(['resources/js/app.js'])

    <style>
        :root {
            --navy: #0f172a;
            --navy-soft: #1e293b;
            --teal: #0f766e;
            --teal-soft: #14b8a6;
            --gold: #f59e0b;
            --light: #f8fafc;
            --muted: #64748b;
            --border: #e2e8f0;
            --danger: #b91c1c;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--navy);
            background: var(--light);
        }

        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.70), rgba(15, 118, 110, 0.38)),
                url('{{ asset('assets/images/auth-camping-bg.png') }}');
            background-size: cover;
            background-position: center;
        }

        .auth-hero {
            padding: 56px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .auth-hero::after {
            content: "";
            position: absolute;
            width: 380px;
            height: 380px;
            border-radius: 999px;
            background: rgba(245, 158, 11, 0.16);
            right: -120px;
            bottom: -120px;
            filter: blur(2px);
        }

        .auth-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative;
            z-index: 2;
        }

        .auth-brand-logo {
            width: 64px;
            height: 64px;
            background: white;
            border-radius: 20px;
            padding: 7px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.22);
        }

        .auth-brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .auth-brand-title {
            font-size: 28px;
            font-weight: 900;
            line-height: 1;
        }

        .auth-brand-subtitle {
            color: #cbd5e1;
            font-size: 14px;
            margin-top: 5px;
        }

        .auth-hero-content {
            max-width: 620px;
            position: relative;
            z-index: 2;
        }

        .auth-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            color: #fef3c7;
            border-radius: 999px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 22px;
        }

        .auth-hero h1 {
            font-size: 48px;
            line-height: 1.08;
            margin: 0 0 18px;
            font-weight: 900;
            letter-spacing: -1.5px;
        }

        .auth-hero p {
            font-size: 17px;
            line-height: 1.7;
            color: #dbeafe;
            margin: 0;
            max-width: 560px;
        }

        .auth-features {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 34px;
            position: relative;
            z-index: 2;
        }

        .auth-feature {
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(255, 255, 255, 0.16);
            border-radius: 18px;
            padding: 18px;
            backdrop-filter: blur(8px);
        }

        .auth-feature i {
            color: var(--gold);
            font-size: 24px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .auth-feature strong {
            display: block;
            font-size: 14px;
            margin-bottom: 4px;
        }

        .auth-feature span {
            font-size: 12px;
            color: #cbd5e1;
        }

        .auth-footer-text {
            color: #cbd5e1;
            font-size: 13px;
            position: relative;
            z-index: 2;
        }

        .auth-form-side {
            background: rgba(248, 250, 252, 0.94);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 36px;
            min-height: 100vh;
        }

        .auth-card {
            width: 100%;
            max-width: 470px;
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 28px;
            padding: 34px;
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.16);
        }

        .auth-card-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 22px;
        }

        .auth-card-logo img {
            width: 170px;
            height: auto;
            object-fit: contain;
        }

        .auth-card h2 {
            text-align: center;
            font-size: 28px;
            font-weight: 900;
            margin: 0 0 8px;
            color: var(--navy);
        }

        .auth-card-description {
            text-align: center;
            color: var(--muted);
            font-size: 14px;
            margin: 0 0 26px;
            line-height: 1.6;
        }

        .auth-alert {
            background: #fee2e2;
            color: var(--danger);
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 18px;
            font-size: 14px;
            line-height: 1.5;
            border: 1px solid #fecaca;
        }

        .auth-alert ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .auth-status {
            background: #dcfce7;
            color: #166534;
            padding: 14px 16px;
            border-radius: 16px;
            margin-bottom: 18px;
            font-size: 14px;
            border: 1px solid #bbf7d0;
        }

        .form-group {
            margin-bottom: 17px;
        }

        .form-label {
            display: block;
            font-weight: 800;
            font-size: 14px;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
            padding: 14px 16px;
            font-size: 15px;
            outline: none;
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--teal-soft);
            box-shadow: 0 0 0 4px rgba(20, 184, 166, 0.14);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: var(--teal);
        }

        .form-row-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin: 6px 0 22px;
        }

        .remember-box {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            font-size: 14px;
        }

        .remember-box input {
            width: 16px;
            height: 16px;
            accent-color: var(--teal);
        }

        .auth-link {
            color: var(--teal);
            text-decoration: none;
            font-weight: 800;
            font-size: 14px;
        }

        .auth-link:hover {
            color: var(--navy);
            text-decoration: underline;
        }

        .btn-auth {
            width: 100%;
            border: none;
            border-radius: 16px;
            padding: 14px 18px;
            font-weight: 900;
            font-size: 15px;
            cursor: pointer;
            color: white;
            background: linear-gradient(135deg, var(--navy), var(--teal));
            box-shadow: 0 16px 30px rgba(15, 118, 110, 0.24);
            transition: all 0.2s ease;
        }

        .btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 36px rgba(15, 118, 110, 0.32);
        }

        .auth-switch {
            text-align: center;
            margin-top: 22px;
            color: var(--muted);
            font-size: 14px;
        }

        .auth-demo-box {
            margin-top: 22px;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 18px;
            padding: 14px;
            font-size: 13px;
            color: var(--muted);
        }

        .auth-demo-box strong {
            color: var(--navy);
        }

        @media (max-width: 992px) {
            .auth-page {
                grid-template-columns: 1fr;
            }

            .auth-hero {
                display: none;
            }

            .auth-form-side {
                min-height: 100vh;
                padding: 22px;
                background:
                    linear-gradient(135deg, rgba(15, 23, 42, 0.76), rgba(15, 118, 110, 0.50)),
                    url('{{ asset('assets/images/auth-camping-bg.png') }}');
                background-size: cover;
                background-position: center;
            }

            .auth-card {
                padding: 28px 22px;
            }
        }

        @media (max-width: 480px) {
            .auth-card-logo img {
                width: 145px;
            }

            .auth-card h2 {
                font-size: 24px;
            }

            .auth-form-side {
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-page">
        <section class="auth-hero">
            <div class="auth-brand">
                <div class="auth-brand-logo">
                    <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo">
                </div>

                <div>
                    <div class="auth-brand-title">CampRent</div>
                    <div class="auth-brand-subtitle">Camping Equipment Rental</div>
                </div>
            </div>

            <div class="auth-hero-content">
                <div class="auth-badge">
                    <i class="bi bi-compass"></i>
                    Sistem Penyewaan Alat Camping
                </div>

                <h1>Temukan perlengkapan camping terbaik untuk petualanganmu.</h1>

                <p>
                    CampRent menyediakan berbagai alat camping yang siap disewa untuk kebutuhan liburan,
                    pendakian, kegiatan alam, dan perjalanan outdoor bersama teman maupun keluarga.
                </p>

                <div class="auth-features">
                    <div class="auth-feature">
                        <i class="bi bi-box-seam"></i>
                        <strong>Alat Lengkap</strong>
                        <span>Tenda, carrier, kompor, dan perlengkapan outdoor.</span>
                    </div>

                    <div class="auth-feature">
                        <i class="bi bi-calendar-check"></i>
                        <strong>Sewa Mudah</strong>
                        <span>Pilih alat dan tentukan jadwal penyewaan.</span>
                    </div>

                    <div class="auth-feature">
                        <i class="bi bi-stars"></i>
                        <strong>Siap Petualangan</strong>
                        <span>Perlengkapan nyaman untuk kegiatan alam.</span>
                    </div>
                </div>
            </div>

            <div class="auth-footer-text">
                &copy; {{ date('Y') }} CampRent. Make your adventure fun.
            </div>
        </section>

        <section class="auth-form-side">
            <div class="auth-card">
                {{ $slot }}
            </div>
        </section>
    </div>

    <script>
        function togglePassword(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye-slash-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash-fill');
                icon.classList.add('bi-eye-fill');
            }
        }
    </script>
</body>
</html>