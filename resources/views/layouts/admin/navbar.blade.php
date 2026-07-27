<nav class="admin-navbar">
    <div>
        <button type="button" id="sidebarToggle" class="navbar-menu-button" onclick="toggleSidebar()" title="Menu">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <div class="navbar-right">
        <div class="navbar-profile-wrapper">
            <button type="button" class="navbar-profile-button" onclick="toggleProfileDropdown()">
                <div class="profile-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>

                <div class="profile-info">
                    <p class="profile-name">{{ auth()->user()->name ?? 'Admin Camping' }}</p>
                    <p class="profile-role">{{ auth()->user()->getRoleNames()->first() ?? 'Admin' }}</p>
                </div>

                <div class="profile-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </button>

            <div id="profileDropdown" class="profile-dropdown">
                <div class="profile-dropdown-header">
                    <div class="profile-dropdown-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>

                    <div>
                        <div class="profile-dropdown-name">
                            {{ auth()->user()->name ?? 'Admin Camping' }}
                        </div>
                        <div class="profile-dropdown-role">
                            {{ auth()->user()->getRoleNames()->first() ?? 'Admin' }}
                        </div>
                    </div>
                </div>

                <div class="profile-dropdown-divider"></div>

                @role('Admin|Owner')
    <a href="{{ route('dashboard') }}" class="profile-dropdown-link">
        <i class="bi bi-speedometer2"></i>
        <span>Dashboard</span>
    </a>
@endrole

                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                    @csrf
                    <button type="submit" class="profile-dropdown-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>