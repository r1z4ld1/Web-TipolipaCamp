@extends('layouts.admin.app')

@section('title', 'Dashboard Owner')

@section('content')
    @php
        $roleName = auth()->user()->getRoleNames()->first() ?? 'Owner';
    @endphp

    <div class="dashboard-page">
        <div class="page-header">
            <div class="page-title-wrap">
                <h1>Dashboard Owner</h1>
                <p>Ringkasan laporan dan performa penyewaan alat camping CampRent.</p>
            </div>

            <a href="{{ route('laporan.index') }}" class="btn-primary-top">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                Lihat Laporan
            </a>
        </div>

        <div class="dashboard-stats">
            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon blue">
                    <i class="bi bi-calendar2-check-fill"></i>
                </div>

                <div>
                    <p>Total Penyewaan</p>
                    <h3>{{ $totalPenyewaan }}</h3>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon green">
                    <i class="bi bi-check-circle-fill"></i>
                </div>

                <div>
                    <p>Penyewaan Selesai</p>
                    <h3>{{ $totalSelesai }}</h3>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon gold">
                    <i class="bi bi-hourglass-split"></i>
                </div>

                <div>
                    <p>Masih Pending</p>
                    <h3>{{ $totalPending }}</h3>
                </div>
            </div>

            <div class="dashboard-stat-card">
                <div class="dashboard-stat-icon purple">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <div>
                    <p>Total Nilai Sewa</p>
                    <h3>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-welcome-card">
                <div class="welcome-content">
                    <span class="welcome-badge">
                        <i class="bi bi-graph-up-arrow"></i>
                        CampRent Owner Panel
                    </span>

                    <h2>Selamat Datang, {{ auth()->user()->name }}</h2>

                    <p>
                        Anda login sebagai <strong>{{ $roleName }}</strong>. Dashboard ini digunakan untuk
                        memantau laporan penyewaan, total transaksi, status penyewaan, dan nilai sewa
                        dari sistem CampRent.
                    </p>

                    <div class="welcome-date">
                        <i class="bi bi-calendar2-check-fill"></i>
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </div>

                <div class="welcome-logo">
                    <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo">
                </div>
            </div>

            <div class="dashboard-role-card">
                <div class="role-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>

                <h3>Akses Role Saat Ini</h3>
                <p class="role-name">{{ $roleName }}</p>
                <span>Owner dapat melihat laporan, mencetak, dan export PDF.</span>
            </div>
        </div>

        <div class="dashboard-module-card">
            <div class="module-header">
                <div>
                    <h3>Menu Laporan Owner</h3>
                    <p>Akses cepat untuk melihat dan mengunduh laporan penyewaan.</p>
                </div>
            </div>

            <div class="module-grid owner-module-grid">
                @can('laporan.index')
                    <a href="{{ route('laporan.index') }}" class="module-item">
                        <div class="module-icon blue">
                            <i class="bi bi-file-earmark-bar-graph-fill"></i>
                        </div>
                        <div>
                            <h4>Lihat Laporan</h4>
                            <p>Melihat rekap data penyewaan.</p>
                        </div>
                    </a>
                @endcan

                @can('laporan.cetak')
                    <a href="{{ route('laporan.cetak') }}" target="_blank" class="module-item">
                        <div class="module-icon green">
                            <i class="bi bi-printer-fill"></i>
                        </div>
                        <div>
                            <h4>Cetak Laporan</h4>
                            <p>Mencetak laporan fisik.</p>
                        </div>
                    </a>
                @endcan

                @can('laporan.export')
                    <a href="{{ route('laporan.export') }}" class="module-item">
                        <div class="module-icon gold">
                            <i class="bi bi-file-earmark-pdf-fill"></i>
                        </div>
                        <div>
                            <h4>Export PDF</h4>
                            <p>Mengunduh laporan dalam PDF.</p>
                        </div>
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dashboard-page {
            width: 100%;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 22px;
        }

        .dashboard-stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
        }

        .dashboard-stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 24px;
        }

        .dashboard-stat-icon.blue {
            background: #e8f1ff;
            color: #1d5fd0;
        }

        .dashboard-stat-icon.purple {
            background: #efe8ff;
            color: #6242bd;
        }

        .dashboard-stat-icon.gold {
            background: #fff1c7;
            color: #a16207;
        }

        .dashboard-stat-icon.green {
            background: #e6f7eb;
            color: #229954;
        }

        .dashboard-stat-card p {
            margin: 0 0 6px;
            color: #64748b;
            font-size: 14px;
            font-weight: 600;
        }

        .dashboard-stat-card h3 {
            margin: 0;
            color: #1f2937;
            font-size: 25px;
            font-weight: 900;
            line-height: 1.2;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1.7fr 0.8fr;
            gap: 20px;
            margin-bottom: 22px;
        }

        .dashboard-welcome-card,
        .dashboard-role-card,
        .dashboard-module-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
        }

        .dashboard-welcome-card {
            padding: 26px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
            overflow: hidden;
            position: relative;
        }

        .dashboard-welcome-card::after {
            content: "";
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 999px;
            background: rgba(10, 59, 122, 0.06);
            right: -90px;
            bottom: -120px;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
        }

        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #e8f1ff;
            color: #1d5fd0;
            border-radius: 999px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .dashboard-welcome-card h2 {
            margin: 0 0 12px;
            color: #1f2937;
            font-size: 26px;
            font-weight: 900;
        }

        .dashboard-welcome-card p {
            margin: 0;
            color: #475569;
            font-size: 15px;
            line-height: 1.7;
            max-width: 720px;
        }

        .welcome-date {
            margin-top: 18px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #0a3b7a;
            font-weight: 800;
            font-size: 14px;
        }

        .welcome-logo {
            position: relative;
            z-index: 2;
            width: 180px;
            flex-shrink: 0;
        }

        .welcome-logo img {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
        }

        .dashboard-role-card {
            padding: 24px;
        }

        .role-icon {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: #e8f1ff;
            color: #1d5fd0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 16px;
        }

        .dashboard-role-card h3 {
            margin: 0 0 10px;
            color: #1f2937;
            font-size: 20px;
            font-weight: 900;
        }

        .role-name {
            margin: 0 0 6px;
            color: #0a3b7a;
            font-size: 24px;
            font-weight: 900;
        }

        .dashboard-role-card span {
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .dashboard-module-card {
            padding: 24px;
        }

        .module-header {
            margin-bottom: 18px;
        }

        .module-header h3 {
            margin: 0 0 6px;
            color: #1f2937;
            font-size: 22px;
            font-weight: 900;
        }

        .module-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .module-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
        }

        .owner-module-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .module-item {
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 18px;
            display: flex;
            align-items: center;
            gap: 14px;
            color: inherit;
            transition: 0.2s ease;
            background: #ffffff;
        }

        .module-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(15, 23, 42, 0.08);
        }

        .module-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
        }

        .module-icon.blue {
            background: #e8f1ff;
            color: #1d5fd0;
        }

        .module-icon.gold {
            background: #fff1c7;
            color: #a16207;
        }

        .module-icon.green {
            background: #e6f7eb;
            color: #229954;
        }

        .module-item h4 {
            margin: 0 0 5px;
            color: #1f2937;
            font-size: 15px;
            font-weight: 900;
        }

        .module-item p {
            margin: 0;
            color: #64748b;
            font-size: 13px;
        }

        @media (max-width: 1199.98px) {
            .dashboard-stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .module-grid,
            .owner-module-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 767.98px) {
            .dashboard-stats {
                grid-template-columns: 1fr;
            }

            .dashboard-welcome-card {
                flex-direction: column;
                align-items: flex-start;
            }

            .welcome-logo {
                width: 140px;
            }

            .module-grid,
            .owner-module-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush