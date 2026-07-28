<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CampRent - Sewa Alat Camping</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700,800,900" rel="stylesheet" />

    <style>
        :root {
            --navy: #0a2f63;
            --navy-dark: #061f42;
            --deep: #06131f;
            --gold: #f0b83a;
            --green: #2f7b70;
            --white: #ffffff;
            --muted: #64748b;
            --soft: #f6f8fc;
            --text: #111827;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            font-family: 'Instrument Sans', system-ui, sans-serif;
            background: var(--deep);
            color: var(--white);
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .landing {
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(circle at 15% 15%, rgba(47, 123, 112, 0.35), transparent 32%),
                radial-gradient(circle at 80% 20%, rgba(240, 184, 58, 0.18), transparent 26%),
                linear-gradient(135deg, #06131f 0%, #0a2f63 52%, #071827 100%);
        }

        .landing::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                linear-gradient(rgba(6, 19, 31, 0.18), rgba(6, 19, 31, 0.72)),
                url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1900&q=85');
            background-size: cover;
            background-position: center;
            opacity: 0.28;
            pointer-events: none;
        }

        .container {
            width: min(1180px, calc(100% - 42px));
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .navbar {
            min-height: 96px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            animation: navDown 0.8s ease both;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand-logo {
          width: 60px;
          height: 60px;
          border-radius: 18px;
          background: rgba(255, 255, 255, 0.08);
          border: 1px solid rgba(255, 255, 255, 0.15);
          backdrop-filter: blur(8px);
          display: flex;
          align-items: center;
          justify-content: center;
          box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28);
        }

        .brand-logo img {
            width: 48px;
            height: 48px;
            object-fit: contain;
        }

        .brand-text strong {
            display: block;
            font-size: 25px;
            font-weight: 900;
            letter-spacing: -0.7px;
        }

        .brand-text span {
            display: block;
            margin-top: 3px;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.72);
            font-weight: 700;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-btn {
            height: 48px;
            padding: 0 22px;
            border-radius: 15px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 900;
            transition: 0.25s ease;
        }

        .nav-btn.outline {
            color: var(--white);
            border: 1px solid rgba(255, 255, 255, 0.32);
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
        }

        .nav-btn.outline:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.16);
        }

        .nav-btn.solid {
            color: var(--navy);
            background: var(--white);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.22);
        }

        .nav-btn.solid:hover {
            transform: translateY(-2px);
            background: #f8fafc;
        }

        .hero {
            min-height: calc(100vh - 96px);
            display: grid;
            grid-template-columns: 1.02fr 0.98fr;
            align-items: center;
            gap: 50px;
            padding: 42px 0 86px;
        }

        .hero-content {
            animation: fadeUp 0.9s ease both;
        }

        .hero-badge {
            width: fit-content;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 11px 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.11);
            border: 1px solid rgba(255, 255, 255, 0.24);
            backdrop-filter: blur(14px);
            font-size: 13px;
            font-weight: 900;
            color: rgba(255, 255, 255, 0.92);
            margin-bottom: 22px;
        }

        .badge-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: #45c486;
            box-shadow: 0 0 0 7px rgba(69, 196, 134, 0.18);
            animation: pulse 1.8s ease-in-out infinite;
        }

        .hero h1 {
            margin: 0;
            max-width: 750px;
            font-size: clamp(46px, 5.8vw, 82px);
            line-height: 0.96;
            letter-spacing: -3.2px;
            font-weight: 900;
        }

        .hero h1 span {
            color: var(--gold);
        }

        .hero-desc {
            max-width: 650px;
            margin: 24px 0 0;
            font-size: 18px;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.80);
            font-weight: 600;
        }

        .hero-address {
            margin-top: 22px;
            display: inline-flex;
            align-items: center;
            gap: 11px;
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.20);
            backdrop-filter: blur(14px);
            color: rgba(255, 255, 255, 0.90);
            font-size: 14px;
            font-weight: 800;
        }

        .address-mark {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--gold);
            box-shadow: 0 0 0 7px rgba(240, 184, 58, 0.16);
        }

        .hero-actions {
            margin-top: 34px;
            display: flex;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary,
        .btn-secondary {
            min-height: 56px;
            padding: 0 26px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 16px;
            font-weight: 900;
            transition: 0.25s ease;
        }

        .btn-primary {
            color: #172033;
            background: linear-gradient(135deg, #f3c452, var(--gold));
            box-shadow: 0 20px 42px rgba(240, 184, 58, 0.30);
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 52px rgba(240, 184, 58, 0.40);
        }

        .btn-secondary {
            color: var(--white);
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.24);
            backdrop-filter: blur(14px);
        }

        .btn-secondary:hover {
            transform: translateY(-4px);
            background: rgba(255, 255, 255, 0.16);
        }

        .arrow-line {
            width: 22px;
            height: 2px;
            border-radius: 99px;
            background: currentColor;
            position: relative;
        }

        .arrow-line::after {
            content: "";
            position: absolute;
            right: 0;
            top: -4px;
            width: 9px;
            height: 9px;
            border-top: 2px solid currentColor;
            border-right: 2px solid currentColor;
            transform: rotate(45deg);
        }

        .hero-stats {
            margin-top: 38px;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            max-width: 680px;
        }

        .hero-stat {
            padding: 18px;
            border-radius: 22px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.20);
            backdrop-filter: blur(16px);
            box-shadow: 0 18px 46px rgba(0, 0, 0, 0.14);
            transition: 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .hero-stat::before {
            content: "";
            position: absolute;
            width: 88px;
            height: 88px;
            border-radius: 50%;
            right: -36px;
            top: -36px;
            background: rgba(240, 184, 58, 0.14);
        }

        .hero-stat:hover {
            transform: translateY(-6px);
            background: rgba(255, 255, 255, 0.14);
        }

        .hero-stat strong {
            display: block;
            color: var(--gold);
            font-size: 27px;
            font-weight: 900;
            line-height: 1;
            margin-bottom: 8px;
            position: relative;
        }

        .hero-stat span {
            color: rgba(255, 255, 255, 0.74);
            font-size: 13px;
            font-weight: 700;
            position: relative;
        }

        .camp-scene-wrap {
            position: relative;
            min-height: 610px;
            animation: fadeUp 1s ease 0.18s both;
        }

        .camp-scene {
            position: relative;
            width: min(520px, 100%);
            height: 560px;
            margin-left: auto;
            border-radius: 42px;
            background:
                linear-gradient(180deg, rgba(12, 35, 60, 0.35), rgba(6, 19, 31, 0.90)),
                linear-gradient(135deg, rgba(255, 255, 255, 0.20), rgba(255, 255, 255, 0.05));
            border: 1px solid rgba(255, 255, 255, 0.24);
            box-shadow: 0 34px 100px rgba(0, 0, 0, 0.40);
            overflow: hidden;
            backdrop-filter: blur(12px);
        }

        .scene-sky {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 65% 22%, rgba(240, 184, 58, 0.20), transparent 17%),
                radial-gradient(circle at 22% 18%, rgba(47, 123, 112, 0.28), transparent 20%);
        }

        .moon {
            position: absolute;
            right: 58px;
            top: 48px;
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.92);
            box-shadow: 0 0 55px rgba(255, 255, 255, 0.35);
            animation: moonFloat 6s ease-in-out infinite;
        }

        .moon::after {
            content: "";
            position: absolute;
            right: -8px;
            top: -4px;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background: #0b2239;
        }

        .stars span {
            position: absolute;
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.85);
            animation: twinkle 2.8s ease-in-out infinite;
        }

        .stars span:nth-child(1) { top: 74px; left: 74px; animation-delay: 0.1s; }
        .stars span:nth-child(2) { top: 132px; left: 145px; animation-delay: 0.6s; }
        .stars span:nth-child(3) { top: 90px; left: 268px; animation-delay: 1s; }
        .stars span:nth-child(4) { top: 174px; right: 70px; animation-delay: 1.4s; }
        .stars span:nth-child(5) { top: 232px; left: 80px; animation-delay: 1.8s; }

        .wind-line {
            position: absolute;
            height: 2px;
            border-radius: 99px;
            background: rgba(255, 255, 255, 0.22);
            animation: windMove 7s linear infinite;
        }

        .wind-line.one {
            width: 170px;
            top: 150px;
            left: -180px;
        }

        .wind-line.two {
            width: 120px;
            top: 230px;
            left: -140px;
            animation-delay: 2s;
        }

        .wind-line.three {
            width: 210px;
            top: 310px;
            left: -220px;
            animation-delay: 4s;
        }

        .mountain {
            position: absolute;
            left: -30px;
            right: -30px;
            bottom: 78px;
            height: 245px;
            background: linear-gradient(135deg, rgba(47, 123, 112, 0.80), rgba(10, 47, 99, 0.98));
            clip-path: polygon(0 100%, 20% 35%, 34% 70%, 52% 18%, 70% 68%, 86% 30%, 100% 100%);
            opacity: 0.82;
        }

        .ground {
            position: absolute;
            left: -40px;
            right: -40px;
            bottom: -42px;
            height: 172px;
            border-radius: 50% 50% 0 0;
            background:
                radial-gradient(circle at 50% 0%, rgba(240, 184, 58, 0.15), transparent 38%),
                linear-gradient(180deg, #123b37, #071827);
        }

        .tent-area {
            position: absolute;
            left: 50%;
            bottom: 93px;
            width: 300px;
            height: 205px;
            transform: translateX(-50%);
            animation: tentFloat 5.2s ease-in-out infinite;
            z-index: 3;
        }

        .tent-shadow {
            position: absolute;
            left: 31px;
            right: 31px;
            bottom: -18px;
            height: 28px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.30);
            filter: blur(3px);
            animation: shadowPulse 5.2s ease-in-out infinite;
        }

        .tent-main {
            position: absolute;
            left: 20px;
            bottom: 0;
            width: 260px;
            height: 174px;
            background: linear-gradient(135deg, #f4c95d, #d99524);
            clip-path: polygon(50% 0%, 100% 100%, 0% 100%);
            filter: drop-shadow(0 24px 30px rgba(0, 0, 0, 0.26));
        }

        .tent-main::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.18), transparent 45%, rgba(0, 0, 0, 0.12));
        }

        .tent-side {
            position: absolute;
            right: 20px;
            bottom: 0;
            width: 130px;
            height: 174px;
            background: linear-gradient(135deg, rgba(47, 123, 112, 0.90), rgba(10, 47, 99, 0.92));
            clip-path: polygon(0 0, 100% 100%, 0 100%);
            opacity: 0.92;
        }

        .tent-door {
            position: absolute;
            left: 108px;
            bottom: 0;
            width: 84px;
            height: 105px;
            background: rgba(6, 19, 31, 0.82);
            clip-path: polygon(50% 0%, 100% 100%, 0% 100%);
            animation: doorGlow 2.6s ease-in-out infinite;
        }

        .tent-line {
            position: absolute;
            left: 150px;
            bottom: 0;
            width: 2px;
            height: 174px;
            background: rgba(255, 255, 255, 0.42);
            transform: rotate(24deg);
            transform-origin: bottom;
        }

        .tent-rope {
            position: absolute;
            bottom: 0;
            width: 105px;
            height: 2px;
            background: rgba(255, 255, 255, 0.55);
        }

        .tent-rope.left {
            left: -46px;
            transform: rotate(-20deg);
        }

        .tent-rope.right {
            right: -46px;
            transform: rotate(20deg);
        }

        .campfire {
            position: absolute;
            left: 84px;
            bottom: 92px;
            width: 70px;
            height: 70px;
            z-index: 4;
            animation: fireFloat 3s ease-in-out infinite;
        }

        .fire-glow {
            position: absolute;
            left: 50%;
            bottom: -8px;
            width: 82px;
            height: 38px;
            border-radius: 50%;
            background: rgba(240, 184, 58, 0.22);
            transform: translateX(-50%);
            filter: blur(4px);
            animation: glowPulse 1.5s ease-in-out infinite;
        }

        .flame {
            position: absolute;
            left: 50%;
            bottom: 17px;
            width: 24px;
            height: 42px;
            border-radius: 50% 50% 50% 50%;
            background: linear-gradient(180deg, #fff2a8, #f0b83a 45%, #df6b24);
            transform: translateX(-50%) rotate(45deg);
            animation: flameMove 0.9s ease-in-out infinite;
        }

        .flame.small {
            width: 16px;
            height: 30px;
            left: 42%;
            bottom: 18px;
            background: linear-gradient(180deg, #fff7c2, #f0b83a, #e76f2a);
            animation-delay: 0.22s;
        }

        .wood {
            position: absolute;
            left: 17px;
            bottom: 11px;
            width: 38px;
            height: 6px;
            border-radius: 99px;
            background: #6b3f20;
        }

        .wood.one {
            transform: rotate(22deg);
        }

        .wood.two {
            transform: rotate(-22deg);
        }

        .scene-card {
            position: absolute;
            left: 34px;
            right: 34px;
            bottom: 28px;
            min-height: 90px;
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.72);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.24);
            backdrop-filter: blur(16px);
            z-index: 5;
            padding: 18px 20px;
            color: var(--text);
            display: grid;
            grid-template-columns: 48px 1fr;
            gap: 14px;
            align-items: center;
        }

        .scene-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 17px;
            background: linear-gradient(135deg, var(--navy), var(--green));
            position: relative;
            box-shadow: 0 14px 30px rgba(10, 47, 99, 0.22);
        }

        .scene-card-icon::before {
            content: "";
            position: absolute;
            left: 11px;
            bottom: 12px;
            width: 26px;
            height: 18px;
            border: 2px solid var(--gold);
            border-bottom: 0;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .scene-card-icon::after {
            content: "";
            position: absolute;
            left: 10px;
            bottom: 11px;
            width: 28px;
            height: 2px;
            background: var(--white);
            border-radius: 99px;
        }

        .scene-card strong {
            display: block;
            font-size: 16px;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 3px;
        }

        .scene-card span {
            display: block;
            font-size: 13px;
            line-height: 1.45;
            color: var(--muted);
            font-weight: 700;
        }

        .section {
            position: relative;
            background: var(--soft);
            color: var(--text);
            padding: 90px 0;
        }

        .section-title {
            text-align: center;
            max-width: 790px;
            margin: 0 auto 42px;
        }

        .section-label {
            display: inline-flex;
            padding: 9px 15px;
            border-radius: 999px;
            background: #e8f1ff;
            color: #2f61c7;
            font-size: 13px;
            font-weight: 900;
            margin-bottom: 14px;
        }

        .section-title h2 {
            margin: 0;
            font-size: clamp(31px, 4vw, 46px);
            line-height: 1.1;
            letter-spacing: -1.5px;
            font-weight: 900;
        }

        .section-title p {
            margin: 14px auto 0;
            color: var(--muted);
            line-height: 1.75;
            font-size: 16px;
            font-weight: 600;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .feature-card {
            min-height: 270px;
            padding: 30px;
            border-radius: 30px;
            background: var(--white);
            border: 1px solid #e2e8f0;
            box-shadow: 0 22px 58px rgba(15, 23, 42, 0.07);
            transition: 0.28s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            right: -70px;
            top: -70px;
            background: rgba(47, 123, 112, 0.08);
            transition: 0.28s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 30px 75px rgba(15, 23, 42, 0.12);
        }

        .feature-card:hover::before {
            transform: scale(1.2);
            background: rgba(240, 184, 58, 0.13);
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--navy), var(--green));
            border: 1px solid rgba(16, 36, 63, 0.12);
            margin-bottom: 18px;
            position: relative;
            box-shadow: 0 16px 34px rgba(16, 36, 63, 0.18);
        }

        .feature-icon::before {
            content: "";
            position: absolute;
            left: 14px;
            bottom: 15px;
            width: 28px;
            height: 18px;
            border: 2px solid var(--gold);
            border-bottom: 0;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
        }

        .feature-icon::after {
            content: "";
            position: absolute;
            left: 13px;
            bottom: 14px;
            width: 30px;
            height: 2px;
            background: var(--white);
            border-radius: 99px;
        }

        .feature-card h3 {
            margin: 0;
            font-size: 21px;
            font-weight: 900;
            letter-spacing: -0.4px;
            position: relative;
        }

        .feature-card p {
            margin: 11px 0 0;
            color: var(--muted);
            line-height: 1.75;
            font-size: 15px;
            font-weight: 600;
            position: relative;
        }

        .process-section {
            background: #ffffff;
            color: var(--text);
            padding: 90px 0;
        }

        .process-grid {
            display: grid;
            grid-template-columns: 0.92fr 1.08fr;
            gap: 42px;
            align-items: center;
        }

        .photo-panel {
            min-height: 430px;
            border-radius: 34px;
            background:
                linear-gradient(rgba(16, 36, 63, 0.12), rgba(16, 36, 63, 0.28)),
                url('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?auto=format&fit=crop&w=1200&q=85');
            background-size: cover;
            background-position: center;
            box-shadow: 0 30px 80px rgba(15, 23, 42, 0.14);
            position: relative;
            overflow: hidden;
        }

        .photo-panel::after {
            content: "";
            position: absolute;
            inset: auto 28px 28px 28px;
            height: 112px;
            border-radius: 26px;
            background: rgba(255, 255, 255, 0.88);
            border: 1px solid rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(16px);
        }

        .photo-info {
            position: absolute;
            z-index: 2;
            left: 52px;
            bottom: 58px;
            color: #0f172a;
        }

        .photo-info strong {
            display: block;
            font-size: 19px;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .photo-info span {
            color: var(--muted);
            font-size: 13px;
            font-weight: 700;
        }

        .process-content .section-label {
            margin-bottom: 14px;
        }

        .process-content h2 {
            margin: 0;
            font-size: clamp(31px, 4vw, 48px);
            line-height: 1.1;
            letter-spacing: -1.5px;
            font-weight: 900;
        }

        .process-content p {
            margin: 16px 0 0;
            color: var(--muted);
            line-height: 1.8;
            font-size: 16px;
            font-weight: 600;
        }

        .process-list {
            margin-top: 26px;
            display: grid;
            gap: 13px;
        }

        .process-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 16px;
            border-radius: 20px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            transition: 0.25s ease;
        }

        .process-item:hover {
            transform: translateX(7px);
            border-color: #bfdbfe;
            background: #f9fbff;
        }

        .process-number {
            width: 34px;
            height: 34px;
            border-radius: 12px;
            background: var(--navy);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 900;
            flex: 0 0 auto;
        }

        .process-item strong {
            display: block;
            color: #0f172a;
            font-weight: 900;
            margin-bottom: 4px;
        }

        .process-item span {
            color: var(--muted);
            font-size: 14px;
            line-height: 1.5;
            font-weight: 600;
        }

        .cta {
            background: linear-gradient(135deg, rgba(6, 19, 31, 0.98), rgba(10, 47, 99, 0.96));
            padding: 78px 0;
            overflow: hidden;
            position: relative;
        }

        .cta::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            right: -110px;
            top: -150px;
            border-radius: 999px;
            background: rgba(47, 123, 112, 0.28);
            filter: blur(6px);
        }

        .cta-box {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 28px;
            padding: 38px;
            border-radius: 32px;
            background: rgba(255, 255, 255, 0.09);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(16px);
        }

        .cta h2 {
            margin: 0;
            font-size: clamp(30px, 4vw, 44px);
            line-height: 1.12;
            letter-spacing: -1.3px;
            font-weight: 900;
        }

        .cta p {
            margin: 12px 0 0;
            max-width: 650px;
            color: rgba(255, 255, 255, 0.76);
            line-height: 1.75;
            font-weight: 600;
        }

        .footer {
            background: #06131f;
            color: rgba(255, 255, 255, 0.72);
            padding: 24px 0;
            font-size: 14px;
            font-weight: 700;
        }

        .footer-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            flex-wrap: wrap;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes navDown {
            from {
                opacity: 0;
                transform: translateY(-18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 7px rgba(69, 196, 134, 0.18);
            }

            50% {
                box-shadow: 0 0 0 12px rgba(69, 196, 134, 0.07);
            }
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.35;
                transform: scale(0.8);
            }

            50% {
                opacity: 1;
                transform: scale(1.4);
            }
        }

        @keyframes windMove {
            from {
                transform: translateX(0);
                opacity: 0;
            }

            15% {
                opacity: 1;
            }

            85% {
                opacity: 1;
            }

            to {
                transform: translateX(760px);
                opacity: 0;
            }
        }

        @keyframes moonFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        @keyframes tentFloat {
            0%, 100% {
                transform: translateX(-50%) translateY(0) rotate(0deg);
            }

            50% {
                transform: translateX(-50%) translateY(-10px) rotate(-1deg);
            }
        }

        @keyframes shadowPulse {
            0%, 100% {
                transform: scale(1);
                opacity: 0.28;
            }

            50% {
                transform: scale(0.88);
                opacity: 0.18;
            }
        }

        @keyframes doorGlow {
            0%, 100% {
                box-shadow: inset 0 0 20px rgba(240, 184, 58, 0.14);
            }

            50% {
                box-shadow: inset 0 0 36px rgba(240, 184, 58, 0.34);
            }
        }

        @keyframes fireFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        @keyframes glowPulse {
            0%, 100% {
                opacity: 0.65;
                transform: translateX(-50%) scale(1);
            }

            50% {
                opacity: 1;
                transform: translateX(-50%) scale(1.16);
            }
        }

        @keyframes flameMove {
            0%, 100% {
                transform: translateX(-50%) rotate(43deg) scale(1);
            }

            50% {
                transform: translateX(-50%) rotate(47deg) scale(1.08);
            }
        }

        @media (max-width: 1060px) {
            .hero {
                grid-template-columns: 1fr;
                gap: 34px;
            }

            .camp-scene-wrap {
                min-height: auto;
            }

            .camp-scene {
                margin: 0 auto;
            }

            .feature-grid,
            .process-grid {
                grid-template-columns: 1fr;
            }

            .cta-box {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        @media (max-width: 650px) {
            .container {
                width: min(100% - 28px, 1180px);
            }

            .navbar {
                align-items: flex-start;
                flex-direction: column;
                padding: 18px 0;
            }

            .nav-actions {
                width: 100%;
            }

            .nav-btn {
                flex: 1;
            }

            .hero {
                padding-top: 18px;
            }

            .hero h1 {
                letter-spacing: -1.7px;
            }

            .hero-desc {
                font-size: 16px;
            }

            .hero-stats {
                grid-template-columns: 1fr;
            }

            .camp-scene {
                height: 500px;
                border-radius: 30px;
            }

            .tent-area {
                transform: translateX(-50%) scale(0.82);
                bottom: 92px;
            }

            .scene-card {
                left: 18px;
                right: 18px;
                bottom: 22px;
            }

            .moon {
                right: 35px;
                top: 38px;
            }

            .photo-panel {
                min-height: 340px;
            }

            .photo-info {
                left: 36px;
                bottom: 54px;
            }

            .cta-box {
                padding: 28px;
            }

            .footer-inner {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <main class="landing">
        <div class="container">
            <nav class="navbar">
                <a href="{{ route('home') }}" class="brand">
                    <div class="brand-logo">
                        <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo">
                    </div>

                    <div class="brand-text">
                        <strong>TipolipaCamp
                        <span>Camping Equipment Rental</span>
                    </div>
                </a>

                <div class="nav-actions">
                    @auth
                        <a href="{{ route('dashboard') }}" class="nav-btn solid">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-btn outline">
                            Login
                        </a>

                       {{-- @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-btn solid">
                                Daftar
                            </a>
                        @endif--}}
                    @endauth
                </div>
            </nav>

            <section class="hero">
                <div class="hero-content">
                    <div class="hero-badge">
                        <span class="badge-dot"></span>
                        Rental perlengkapan camping terpercaya di Palu
                    </div>

                    <h1>
    Perlengkapan camping untuk <span>petualanganmu.</span>
</h1>

                    <p class="hero-desc">
                        CampRent menyediakan berbagai perlengkapan camping untuk kebutuhan liburan,
                        pendakian, kegiatan alam, dan perjalanan outdoor. Pilih alat yang kamu butuhkan,
                        tentukan jadwal sewa, lalu nikmati perjalanan dengan lebih nyaman.
                    </p>

                    <div class="hero-address">
                        <span class="address-mark"></span>
                        Jl.Malonda, Tipo, kec.Ulujadi, Kota Palu, Sulawesi Tengah 94228
                    </div>

                    <div class="hero-actions">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary">
                                Buka Akun Saya
                                <span class="arrow-line"></span>
                            </a>
                        @else
                            <a {{--href="{{ route('#') }}"--}} class="btn-primary">
                                Belum Punya Akun? daftar untuk mulai sewa
                                <span class="arrow-line"></span>
                            </a>

                            <a href="{{ route('register') }}" class="btn-secondary">
                               Daftar
                            </a>
                        @endauth
                    </div>

                    <div class="hero-stats">
                        <div class="hero-stat">
                            <strong>10++</strong>
                            <span>Jenis pilihan alat camping</span>
                        </div>

                        <div class="hero-stat">
                            <strong>24 Jam</strong>
                            <span>Pemesanan lebih mudah</span>
                        </div>

                        <div class="hero-stat">
                            <strong>Real Time</strong>
                            <span>Informasi sewa transparan</span>
                        </div>
                    </div>
                </div>

                <div class="camp-scene-wrap">
                    <div class="camp-scene">
                        <div class="scene-sky"></div>

                        <div class="moon"></div>

                        <div class="stars">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                        <div class="wind-line one"></div>
                        <div class="wind-line two"></div>
                        <div class="wind-line three"></div>

                        <div class="mountain"></div>
                        <div class="ground"></div>

                        <div class="tent-area">
                            <div class="tent-shadow"></div>
                            <div class="tent-main"></div>
                            <div class="tent-side"></div>
                            <div class="tent-door"></div>
                            <div class="tent-line"></div>
                            <div class="tent-rope left"></div>
                            <div class="tent-rope right"></div>
                        </div>

                        <div class="campfire">
                            <div class="fire-glow"></div>
                            <div class="flame"></div>
                            <div class="flame small"></div>
                            <div class="wood one"></div>
                            <div class="wood two"></div>
                        </div>

                        <div class="scene-card">
                            <div class="scene-card-icon"></div>
                            <div>
                                <strong>Perlengkapan siap untuk perjalananmu</strong>
                                <span>Tenda, carrier, matras, dan perlengkapan outdoor tersedia untuk kebutuhan camping.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <section class="section">
        <div class="container">
            <div class="section-title">
                <div class="section-label">Layanan CampRent</div>
                <h2>Semua kebutuhan camping tersedia dalam satu tempat.</h2>
                <p>
                    CampRent hadir untuk membantu kamu mendapatkan perlengkapan camping
dengan cara yang lebih mudah, rapi, dan nyaman sebelum memulai perjalanan.
                </p>
            </div>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon"></div>
                    <h3>Lihat Daftar Alat</h3>
                    <p>
                        Penyewa dapat melihat alat camping yang tersedia lengkap dengan kategori,
                        harga sewa, stok, kondisi barang, dan status ketersediaan.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"></div>
                    <h3>Ajukan Penyewaan</h3>
                    <p>
                        Pengajuan sewa dapat dilakukan langsung melalui akun penyewa dengan
                        memilih alat, tanggal sewa, dan data identitas yang dibutuhkan.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon"></div>
                    <h3>Pantau Riwayat Sewa</h3>
                    <p>
                        Penyewa dapat memantau status pengajuan, penyewaan yang selesai,
                        informasi pengembalian, serta denda jika terjadi keterlambatan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="container">
            <div class="process-grid">
                <div class="photo-panel">
                    <div class="photo-info">
                        <strong>Petualangan lebih siap</strong>
                        <span>Perlengkapan camping dapat dipilih sesuai kebutuhan.</span>
                    </div>
                </div>

                <div class="process-content">
                    <div class="section-label">Alur Penyewaan</div>
                    <h2>Mulai dari memilih alat sampai melihat riwayat sewa.</h2>
                    <p>
                        Sistem penyewa dibuat sederhana agar proses sewa mudah dipahami.
                        Setelah pengajuan dikirim, penyewa cukup memantau statusnya dari
                        halaman riwayat sewa.
                    </p>

                    <div class="process-list">
                        <div class="process-item">
                            <div class="process-number">1</div>
                            <div>
                                <strong>Daftar atau login akun</strong>
                                <span>Penyewa masuk ke sistem untuk mengakses daftar alat camping.</span>
                            </div>
                        </div>

                        <div class="process-item">
                            <div class="process-number">2</div>
                            <div>
                                <strong>Pilih alat dan ajukan sewa</strong>
                                <span>Penyewa menentukan alat, tanggal sewa, dan identitas yang digunakan.</span>
                            </div>
                        </div>

                        <div class="process-item">
                            <div class="process-number">3</div>
                            <div>
                                <strong>Cek status dan total tagihan</strong>
                                <span>Riwayat sewa menampilkan status, total sewa, dan denda bila terlambat.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="container">
            <div class="cta-box">
                <div>
                    <h2>Siap menyewa alat camping untuk perjalananmu?</h2>
                    <p>
                        Buat akun penyewa CampRent untuk melihat alat camping yang tersedia,
                        mengajukan sewa, dan memantau status penyewaan dengan mudah.
                    </p>
                </div>

                @auth
                    <a href="{{ route('dashboard') }}" class="btn-primary">
                        Buka Akun Saya
                        <span class="arrow-line"></span>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary">
                        Daftar Penyewa
                        <span class="arrow-line"></span>
                    </a>
                @endauth
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container footer-inner">
            <div>© {{ date('Y') }} CampRent. Camping Equipment Rental.</div>
            <div>Jl.Malonda, Tipo, kec.Ulujadi, Kota Palu, Sulawesi Tengah 94228</div>
        </div>
    </footer>
</body>
</html>
