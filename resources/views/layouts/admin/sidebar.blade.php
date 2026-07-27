<aside id="adminSidebar" class="admin-sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="sidebar-brand-link">
            <div class="sidebar-logo-pill">
                <img src="{{ asset('assets/images/logo-camprent.png') }}" alt="CampRent Logo" class="sidebar-logo">
            </div>
        </a>
    </div>

    <div class="sidebar-menu">

        {{-- ================= MENU UTAMA ================= --}}
        @can('dashboard.index')
            <div class="sidebar-label">Menu Utama</div>

            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        @endcan


        {{-- ================= MANAJEMEN PENGGUNA ================= --}}
        @canany(['user.index', 'role.index', 'permission.index'])
            <div class="sidebar-label">Manajemen Pengguna</div>

            @can('user.index')
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i>
                    <span>Data Users</span>
                </a>
            @endcan

            @can('role.index')
                <a href="{{ route('admin.roles.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <i class="bi bi-shield-fill-check"></i>
                    <span>Data Roles</span>
                </a>
            @endcan

            @can('permission.index')
                <a href="{{ route('admin.permissions.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                    <i class="bi bi-key-fill"></i>
                    <span>Data Permissions</span>
                </a>
            @endcan
        @endcanany


        {{-- ================= MANAJEMEN MASTER ================= --}}
        @canany(['kategori.index', 'barang.index'])
            <div class="sidebar-label">Manajemen Master</div>

            @can('kategori.index')
                <a href="{{ route('admin.kategoris.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.kategoris.*') ? 'active' : '' }}">
                    <i class="bi bi-tag-fill"></i>
                    <span>Kategori Alat</span>
                </a>
            @endcan

            @can('barang.index')
                <a href="{{ route('admin.barangs.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.barangs.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Alat Camping</span>
                </a>
            @endcan
        @endcanany


        {{-- ================= TRANSAKSI ================= --}}
        @canany(['penyewaan.index', 'pengembalian.index'])
            <div class="sidebar-label">Transaksi</div>

            @can('penyewaan.index')
                <a href="{{ route('petugas.penyewaan.index') }}"
                   class="sidebar-link {{ request()->routeIs('petugas.penyewaan.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar2-check-fill"></i>
                    <span>Penyewaan</span>
                </a>
            @endcan

            @can('pengembalian.index')
                <a href="{{ route('petugas.pengembalian.index') }}"
                   class="sidebar-link {{ request()->routeIs('petugas.pengembalian.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-counterclockwise"></i>
                    <span>Pengembalian</span>
                </a>
            @endcan
        @endcanany


        {{-- ================= LAPORAN ================= --}}
        @can('laporan.index')
            <div class="sidebar-label">Laporan</div>

            <a href="{{ route('laporan.index') }}"
               class="sidebar-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                <span>Laporan</span>
            </a>
        @endcan


        {{-- ================= AKTIVITAS SISTEM ================= --}}
        @can('aktivitas.index')
            <div class="sidebar-label">Aktivitas</div>

            <a href="{{ route('aktivitas.index') }}"
               class="sidebar-link {{ request()->routeIs('aktivitas.*') ? 'active' : '' }}">
                <i class="bi bi-activity"></i>
                <span>Aktivitas Sistem</span>
            </a>
        @endcan


        {{-- ================= MENU PENYEWA ================= --}}
        @canany(['alat.index', 'sewa.riwayat'])
            <div class="sidebar-label">Menu Penyewa</div>

            @can('alat.index')
                <a href="{{ route('penyewa.alat.index') }}"
                   class="sidebar-link {{ request()->routeIs('penyewa.alat.*') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i>
                    <span>Daftar Alat</span>
                </a>
            @endcan

            @can('sewa.riwayat')
                <a href="{{ route('penyewa.sewa.riwayat') }}"
                   class="sidebar-link {{ request()->routeIs('penyewa.sewa.riwayat') ? 'active' : '' }}">
                    <i class="bi bi-clock-history"></i>
                    <span>Riwayat Sewa</span>
                </a>
            @endcan
        @endcanany

    </div>
</aside>