<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Camping Rental') }} - @yield('title', 'Dashboard')</title>

    @vite(['resources/js/app.js'])

    <style>
        :root {
            --sidebar-blue-1: #071827;
            --sidebar-blue-2: #10243f;
            --sidebar-blue-3: #0a2f63;
            --sidebar-active: rgba(255, 255, 255, 0.13);

            --navy: #10243f;
            --navy-dark: #071827;
            --teal: #2f7b70;
            --gold: #f0b83a;

            --page-bg: #eef3f8;
            --white: #ffffff;
            --border: #dfe7ef;
            --text-dark: #111827;
            --text-muted: #64748b;

            --green-bg: #e7f7ef;
            --green-text: #1f8a5b;
            --green-border: #b9ead2;

            --blue-bg: #e8f1ff;
            --blue-text: #245fc7;

            --purple-bg: #efe8ff;
            --purple-text: #6242bd;

            --yellow-bg: #fff2c8;
            --yellow-text: #9a6508;

            --pink-bg: #ffe4e8;
            --pink-text: #be3144;

            --gray-bg: #eef2f6;
            --gray-text: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            max-width: 100%;
            margin: 0;
            overflow-x: hidden;
        }

        body {
            min-height: 100vh;
            color: var(--text-dark);
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background:
                radial-gradient(circle at 15% 8%, rgba(47, 123, 112, 0.16), transparent 30%),
                radial-gradient(circle at 85% 12%, rgba(240, 184, 58, 0.14), transparent 26%),
                linear-gradient(135deg, #eef3f8 0%, #f7fafc 42%, #eef4fb 100%);
        }

        a {
            text-decoration: none;
        }

        button {
            font-family: inherit;
        }

        .admin-wrapper {
            width: 100%;
            max-width: 100%;
            min-height: 100vh;
            overflow-x: hidden;
            background:
                radial-gradient(circle at 18% 10%, rgba(47, 123, 112, 0.12), transparent 28%),
                radial-gradient(circle at 88% 18%, rgba(240, 184, 58, 0.11), transparent 26%),
                linear-gradient(135deg, #eef3f8 0%, #f7fafc 48%, #eef4fb 100%);
        }

        .admin-sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            overflow-x: hidden;
            color: #ffffff;
            background:
                radial-gradient(circle at 30% 0%, rgba(47, 123, 112, 0.32), transparent 34%),
                linear-gradient(180deg, var(--sidebar-blue-1) 0%, var(--sidebar-blue-2) 52%, var(--sidebar-blue-3) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 18px 0 55px rgba(7, 24, 39, 0.22);
            transition: transform 0.25s ease;
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.25);
            border-radius: 999px;
        }

        .sidebar-brand {
            padding: 18px 16px 16px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.11);
        }

        .sidebar-brand-link {
            display: block;
            width: 100%;
        }

        .sidebar-logo {
            width: 145px;
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            object-fit: contain;
            padding: 8px;
            background: rgba(255, 255, 255, 0.96);
            border-radius: 20px;
            box-shadow: 0 18px 44px rgba(0, 0, 0, 0.22);
        }

        .sidebar-menu {
            padding: 14px 10px 18px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .sidebar-label {
            color: rgba(255, 255, 255, 0.66);
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin: 18px 10px 9px;
        }

        .sidebar-link {
            position: relative;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 14px 15px;
            border-radius: 16px;
            color: rgba(255, 255, 255, 0.88);
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 7px;
            transition: all 0.22s ease;
        }

        .sidebar-link i {
            width: 26px;
            font-size: 22px;
            text-align: center;
            flex-shrink: 0;
            color: rgba(255, 255, 255, 0.95);
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.10);
            color: #ffffff;
            transform: translateX(4px);
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.18), rgba(255, 255, 255, 0.08));
            color: #ffffff;
            box-shadow:
                inset 0 0 0 1px rgba(255, 255, 255, 0.14),
                0 14px 30px rgba(0, 0, 0, 0.16);
        }

        .sidebar-link.active::before {
            content: "";
            position: absolute;
            left: -10px;
            top: 14px;
            bottom: 14px;
            width: 4px;
            border-radius: 999px;
            background: var(--gold);
        }

        .sidebar-logout-form {
            margin-top: auto;
            padding-top: 14px;
        }

        .sidebar-logout-button {
            width: 100%;
            border: none;
            border-radius: 16px;
            background: linear-gradient(135deg, #be3144, #7f1d1d);
            color: #ffffff;
            padding: 13px 14px;
            display: flex;
            align-items: center;
            gap: 13px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 14px 34px rgba(190, 49, 68, 0.20);
        }

        .sidebar-logout-button i {
            width: 26px;
            font-size: 22px;
            text-align: center;
        }

        .admin-main {
            margin-left: 240px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            min-width: 0;
            overflow-x: hidden;
            background: transparent;
            transition: margin-left 0.25s ease;
        }

        .admin-sidebar.sidebar-hidden {
            transform: translateX(-100%);
        }

        .admin-main.sidebar-expanded {
            margin-left: 0;
        }

        .admin-navbar {
            height: 72px;
            background: rgba(255, 255, 255, 0.82);
            border-bottom: 1px solid rgba(223, 231, 239, 0.82);
            box-shadow: 0 10px 35px rgba(15, 23, 42, 0.06);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 26px;
            position: sticky;
            top: 0;
            z-index: 1030;
        }

        .navbar-menu-button {
            width: 42px;
            height: 42px;
            border: none;
            background: #f4f7fb;
            color: var(--navy);
            border-radius: 15px;
            font-size: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            pointer-events: auto;
            transition: all 0.22s ease;
        }

        .navbar-menu-button:hover {
            background: #e8f1ff;
            color: #245fc7;
            transform: translateY(-2px);
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .navbar-bell {
            width: 42px;
            height: 42px;
            border: none;
            background: transparent;
            color: #475569;
            border-radius: 12px;
            font-size: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .navbar-bell:hover {
            background: #f1f5f9;
        }

        .navbar-profile-wrapper {
            position: relative;
        }

        .navbar-profile-button {
            border: 1px solid #e5edf5;
            background: rgba(255, 255, 255, 0.72);
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 8px 10px;
            border-radius: 18px;
            transition: 0.2s ease;
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
        }

        .navbar-profile-button:hover {
            background: #ffffff;
            transform: translateY(-2px);
        }

        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-avatar,
        .profile-dropdown-avatar {
            border-radius: 999px;
            background: linear-gradient(135deg, #e8f1ff, #e7f7ef);
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .profile-avatar {
            width: 42px;
            height: 42px;
        }

        .profile-avatar i {
            font-size: 24px;
        }

        .profile-name,
        .profile-dropdown-name {
            margin: 0;
            font-size: 14px;
            font-weight: 900;
            color: var(--text-dark);
        }

        .profile-role,
        .profile-dropdown-role {
            margin: 3px 0 0;
            font-size: 12px;
            color: var(--text-muted);
        }

        .profile-arrow {
            color: #64748b;
            font-size: 14px;
        }

        .profile-dropdown {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            width: 260px;
            background: #ffffff;
            border: 1px solid #e4ebf3;
            border-radius: 22px;
            box-shadow: 0 24px 65px rgba(15, 23, 42, 0.16);
            padding: 12px;
            z-index: 2000;
            display: none;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profile-dropdown-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
        }

        .profile-dropdown-avatar {
            width: 44px;
            height: 44px;
            font-size: 22px;
            flex-shrink: 0;
        }

        .profile-dropdown-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 8px 0;
        }

        .profile-dropdown-link,
        .profile-dropdown-logout {
            width: 100%;
            border: none;
            background: transparent;
            color: #1f2937;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 10px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            text-align: left;
        }

        .profile-dropdown-link:hover {
            background: #f1f5f9;
            color: #092a56;
        }

        .profile-dropdown-logout {
            color: #b91c1c;
        }

        .profile-dropdown-logout:hover {
            background: #fee2e2;
            color: #991b1b;
        }

        .profile-dropdown-link i,
        .profile-dropdown-logout i {
            width: 20px;
            font-size: 18px;
        }

        .admin-content {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            padding: 28px 30px;
            flex: 1;
            overflow-x: hidden;
        }

        .admin-footer {
            padding: 16px 28px 22px;
            color: #94a3b8;
            font-size: 13px;
        }

        .page-header {
            width: 100%;
            max-width: 100%;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 22px;
            flex-wrap: wrap;
        }

        .page-title-wrap h1,
        h1,
        h2.fw-bold {
            margin: 0 0 8px;
            font-size: 30px;
            line-height: 1.1;
            font-weight: 900;
            color: #111827;
            letter-spacing: -0.8px;
        }

        .page-title-wrap p,
        .text-muted {
            margin: 0;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        .content-card,
        .card-modern,
        .dashboard-stat-card,
        .dashboard-welcome-card,
        .dashboard-role-card,
        .dashboard-module-card {
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(255, 255, 255, 0.92));
            border: 1px solid rgba(223, 231, 239, 0.92);
            border-radius: 24px;
            box-shadow:
                0 22px 60px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        .content-card,
        .card-modern {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            padding: 20px;
            overflow: hidden;
            position: relative;
        }

        .admin-content > .card-modern,
        .admin-content > .content-card,
        .admin-wide-card {
            width: 100%;
            max-width: 100%;
            min-width: 0;
            margin-left: 0;
            margin-right: 0;
            display: block;
        }

        .dashboard-stat-card,
        .dashboard-welcome-card,
        .dashboard-role-card,
        .dashboard-module-card {
            position: relative;
            overflow: hidden;
        }

        .dashboard-stat-card::after,
        .dashboard-welcome-card::after,
        .dashboard-role-card::after,
        .dashboard-module-card::after,
        .card-modern::after,
        .content-card::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            right: -85px;
            top: -95px;
            border-radius: 999px;
            background: rgba(47, 123, 112, 0.08);
            pointer-events: none;
        }

        .dashboard-stat-card:hover,
        .dashboard-module-card:hover,
        .module-item:hover {
            transform: translateY(-2px);
            transition: 0.22s ease;
        }

        .btn-primary-top,
        .btn-navy {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #10243f, #0a2f63);
            color: #ffffff;
            border: 1px solid rgba(16, 36, 63, 0.12);
            border-radius: 14px;
            padding: 12px 20px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 16px 34px rgba(10, 47, 99, 0.18);
        }

        .btn-primary-top:hover,
        .btn-navy:hover {
            background: linear-gradient(135deg, #071827, #10243f);
            color: #ffffff;
            transform: translateY(-2px);
        }

        .btn-primary-top i {
            font-size: 20px;
        }

        .btn-outline-navy {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid #10243f;
            color: #10243f;
            background: transparent;
            border-radius: 14px;
            padding: 10px 16px;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-outline-navy:hover {
            background: #10243f;
            color: #ffffff;
        }

        .alert-success-modern {
            background: #e7f7ef;
            color: var(--green-text);
            border: 1px solid #b9ead2;
            border-radius: 18px;
            padding: 14px 16px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 14px 32px rgba(31, 138, 91, 0.08);
        }

        .alert-success-modern .left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success-modern i {
            font-size: 20px;
        }

        .alert-error-modern {
            background: #ffe4e8;
            color: #b42318;
            border: 1px solid #ffc7d0;
            border-radius: 18px;
            padding: 14px 16px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 700;
            font-size: 14px;
            box-shadow: 0 14px 32px rgba(190, 49, 68, 0.08);
        }

        .table-wrap,
        .admin-table-scroll,
        .user-table-scroll,
        .card-modern > div[style*="overflow-x"],
        .content-card > div[style*="overflow-x"] {
            width: 100%;
            max-width: 100%;
            overflow-x: auto;
            overflow-y: hidden;
            -webkit-overflow-scrolling: touch;
        }

        .table-wrap {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #dfe7ef;
            border-radius: 18px;
            box-shadow: 0 14px 42px rgba(15, 23, 42, 0.05);
        }

        .data-table,
        .card-modern table,
        .content-card table,
        .admin-table-scroll table,
        .user-table-scroll table,
        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }

        .data-table {
            min-width: 0;
            table-layout: auto;
        }

        .table-wrap .data-table {
            min-width: 920px;
        }

        .data-table thead th,
        .card-modern th {
            background: linear-gradient(180deg, #f8fbff, #eef4fb);
            color: #111827;
            font-size: 13px;
            font-weight: 900;
            border-bottom: 1px solid #dfe7ef;
            padding: 14px 16px;
            text-align: left;
            white-space: nowrap;
        }

        .data-table tbody td,
        .card-modern td {
            color: #1f2937;
            font-size: 13px;
            border-bottom: 1px solid #edf2f7;
            padding: 15px 16px;
            vertical-align: middle;
        }

        .data-table tbody tr:last-child td,
        .card-modern tbody tr:last-child td {
            border-bottom: none;
        }

        .data-table tbody tr:hover,
        .card-modern tbody tr:hover {
            background: #f9fcff;
        }

        .item-photo {
            width: 105px;
            height: 78px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .item-photo-empty {
            width: 105px;
            height: 78px;
            background: #f3f4f6;
            border-radius: 12px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 23px;
            margin: 0 auto;
        }

        .item-name {
            font-size: 14px;
            font-weight: 900;
            color: #1f2937;
            margin-bottom: 6px;
            line-height: 1.35;
        }

        .item-desc {
            color: #4b5563;
            font-size: 12.5px;
            line-height: 1.5;
            max-width: 250px;
        }

        .badge,
        .badge-blue,
        .badge-purple,
        .badge-gold,
        .badge-pink,
        .badge-green,
        .badge-gray {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            padding: 7px 12px;
            font-size: 12.5px;
            font-weight: 900;
            white-space: nowrap;
            line-height: 1;
        }

        .badge-blue {
            background: #e8f1ff;
            color: #245fc7;
        }

        .badge-purple {
            background: #efe8ff;
            color: #6242bd;
        }

        .badge-gold {
            background: #fff2c8;
            color: #9a6508;
        }

        .badge-pink {
            background: #ffe4e8;
            color: #be3144;
        }

        .badge-green {
            background: #e7f7ef;
            color: #1f8a5b;
        }

        .badge-gray {
            background: #eef2f6;
            color: #64748b;
        }

        .action-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-icon-action {
            width: 32px;
            height: 32px;
            border-radius: 12px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-icon-action i {
            font-size: 15px;
        }

        .btn-action-edit,
        .btn-action-delete {
            min-width: 76px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 0 12px;
            font-size: 13px;
            font-weight: 800;
            transition: all 0.2s ease;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-action-edit i,
        .btn-action-delete i {
            font-size: 15px;
        }

        .btn-action-edit,
        .btn-edit {
            background: linear-gradient(135deg, #f4c452, #f0b83a);
            color: #172033;
            border: 1px solid #e4a91e;
        }

        .btn-action-edit:hover,
        .btn-edit:hover {
            background: linear-gradient(135deg, #e4a91e, #c98d11);
            color: #ffffff;
        }

        .btn-action-delete,
        .btn-delete {
            background: linear-gradient(135deg, #ef4444, #be3144);
            color: #ffffff;
            border: 1px solid #dc2626;
        }

        .btn-delete:hover,
        .btn-action-delete:hover {
            background: #dc2626;
            color: #ffffff;
        }

        .btn-action-delete:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .table-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 18px;
            flex-wrap: wrap;
        }

        .table-info {
            color: #64748b;
            font-size: 14px;
        }

        .pagination-custom {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pagination-btn,
        .pagination-page {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            border: 1px solid #dbe2ea;
            background: #ffffff;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }

        .pagination-page.active {
            background: var(--navy);
            border-color: var(--navy);
            color: #ffffff;
        }

        .custom-pagination-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 22px;
        }

        .custom-pagination-info {
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            flex: 1 1 auto;
        }

        .custom-pagination-nav {
            margin-left: auto;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        .custom-pagination-btn,
        .custom-pagination-page {
            min-width: 38px;
            height: 38px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #0f172a;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .custom-pagination-btn:hover,
        .custom-pagination-page:hover {
            background: #e8f1ff;
            color: #1d5fd0;
            border-color: #bfdbfe;
        }

        .custom-pagination-page.active {
            background: #0a2f63;
            color: #ffffff;
            border-color: #0a2f63;
        }

        .custom-pagination-btn.disabled {
            opacity: 0.45;
            cursor: not-allowed;
            background: #f8fafc;
        }

        input,
        select,
        textarea,
        .card-modern input,
        .card-modern select,
        .card-modern textarea {
            font-family: inherit;
            border: 1px solid #cfd9e6;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.96);
            color: #111827;
            transition: all 0.22s ease;
        }

        input:focus,
        select:focus,
        textarea:focus,
        .card-modern input:focus,
        .card-modern select:focus,
        .card-modern textarea:focus {
            border-color: #2f7b70;
            box-shadow: 0 0 0 4px rgba(47, 123, 112, 0.16);
            outline: none;
        }

        nav[role="navigation"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            flex-wrap: wrap;
        }

        nav[role="navigation"] svg {
            width: 18px;
            height: 18px;
        }

        nav[role="navigation"] a,
        nav[role="navigation"] span {
            font-size: 13px;
        }

        .p-4 {
            padding: 20px !important;
        }

        .mb-4 {
            margin-bottom: 24px !important;
        }

        .mb-3 {
            margin-bottom: 16px !important;
        }

        .mb-1 {
            margin-bottom: 4px !important;
        }

        .mb-0 {
            margin-bottom: 0 !important;
        }

        .mt-3 {
            margin-top: 16px !important;
        }

        .fw-bold {
            font-weight: 800 !important;
        }

        .small {
            font-size: 13px !important;
        }

        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .justify-content-between {
            justify-content: space-between !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .flex-wrap {
            flex-wrap: wrap !important;
        }

        .gap-3 {
            gap: 16px !important;
        }

        .gap-2 {
            gap: 8px !important;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-12,
        .col-md-4,
        .col-md-6,
        .col-xl-3,
        .col-xl-4,
        .col-xl-8 {
            padding: 10px;
            width: 100%;
        }

        .mobile-overlay {
            display: none;
        }

        @media (min-width: 768px) {
            .col-md-4 {
                width: 33.333333%;
            }

            .col-md-6 {
                width: 50%;
            }
        }

        @media (min-width: 1200px) {
            .col-xl-3 {
                width: 25%;
            }

            .col-xl-4 {
                width: 33.333333%;
            }

            .col-xl-8 {
                width: 66.666667%;
            }
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
                box-shadow: 22px 0 70px rgba(7, 24, 39, 0.28);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .mobile-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(7, 24, 39, 0.55);
                backdrop-filter: blur(3px);
                z-index: 1035;
            }

            .admin-main {
                margin-left: 0;
            }

            .admin-navbar {
                padding: 0 18px;
            }

            .admin-content {
                padding: 20px;
            }

            .profile-info,
            .profile-arrow {
                display: none;
            }
        }

        @media (max-width: 767.98px) {
            .admin-content {
                padding: 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: stretch;
            }

            .page-title-wrap h1 {
                font-size: 26px;
            }

            .btn-primary-top,
            .btn-navy {
                justify-content: center;
                width: 100%;
            }

            .content-card,
            .card-modern {
                border-radius: 20px;
                padding: 16px;
            }

            .table-wrap .data-table {
                min-width: 860px;
            }

            .card-modern > div[style*="overflow-x"] table,
            .admin-table-scroll table,
            .user-table-scroll table {
                min-width: 720px;
            }
        }

        @media (max-width: 576px) {
            .custom-pagination-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .custom-pagination-nav {
                margin-left: 0;
                justify-content: flex-start;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        @include('layouts.admin.sidebar')

        <div id="mobileOverlay" class="mobile-overlay" onclick="closeSidebar()"></div>

        <main class="admin-main">
            @include('layouts.admin.navbar')

            <section class="admin-content">
                @yield('content')
            </section>

            @include('layouts.admin.footer')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('mobileOverlay');
            const main = document.querySelector('.admin-main');

            if (!sidebar || !main) {
                return;
            }

            if (window.innerWidth <= 991) {
                sidebar.classList.toggle('show');

                if (overlay) {
                    overlay.classList.toggle('show');
                }
            } else {
                sidebar.classList.toggle('sidebar-hidden');
                main.classList.toggle('sidebar-expanded');
            }
        }

        function closeSidebar() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('mobileOverlay');

            if (sidebar) {
                sidebar.classList.remove('show');
            }

            if (overlay) {
                overlay.classList.remove('show');
            }
        }

        function toggleProfileDropdown() {
            const dropdown = document.getElementById('profileDropdown');

            if (dropdown) {
                dropdown.classList.toggle('show');
            }
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('profileDropdown');
            const profileWrapper = document.querySelector('.navbar-profile-wrapper');

            if (dropdown && profileWrapper && !profileWrapper.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const dropdown = document.getElementById('profileDropdown');

                if (dropdown) {
                    dropdown.classList.remove('show');
                }

                closeSidebar();
            }
        });

        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('mobileOverlay');

            if (window.innerWidth > 991) {
                if (sidebar) {
                    sidebar.classList.remove('show');
                }

                if (overlay) {
                    overlay.classList.remove('show');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>