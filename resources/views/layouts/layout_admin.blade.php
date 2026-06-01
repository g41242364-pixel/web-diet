<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - @yield('title', 'Dashboard')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/layout/layout_admin.css') }}">


</head>

<body>

    <nav class="sidebar">
        <div class="sidebar-header">
            <div class="brand-section">
                <h1>SISD</h1>
            </div>
            <div class="sidebar-user-info">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <span>Dashboard Admin</span>
                </div>
            </div>
        </div>

        <ul class="nav-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.skrining') }}"
                    class="nav-item {{ request()->routeIs('admin.skrining') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2" />
                        <line x1="8" y1="6" x2="16" y2="6" />
                        <line x1="8" y1="10" x2="16" y2="10" />
                        <line x1="8" y1="14" x2="16" y2="14" />
                        <line x1="8" y1="18" x2="16" y2="18" />
                    </svg>
                    <span>Skrining Diet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.targetDiet') }}"
                    class="nav-item {{ request()->routeIs('admin.targetDiet') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="12" r="6" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>
                    <span>Target Diet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.jurnalMakanan') }}"
                    class="nav-item {{ request()->routeIs('admin.jurnalMakanan') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1" />
                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z" />
                        <line x1="6" y1="1" x2="6" y2="4" />
                        <line x1="10" y1="1" x2="10" y2="4" />
                        <line x1="14" y1="1" x2="14" y2="4" />
                    </svg>
                    <span>Jurnal Makanan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.polaTidur') }}"
                    class="nav-item {{ request()->routeIs('admin.polaTidur') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                    <span>Pola Tidur</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.aktivitasFisik') }}"
                    class="nav-item {{ request()->routeIs('admin.aktivitasFisik') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 4v16M17 4v16M9 4v16M5 4v16M21 4v16M1 4h22M1 20h22" />
                    </svg>
                    <span style="font-size: 14px;">Aktivitas Fisik</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/kelola-pengguna') }}" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                    </svg>
                    <span style="font-size: 14px;">Kelola Akun Pengguna</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/admin/kelola-ahli-gizi') }}" class="nav-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="8.5" cy="7" r="4" />
                    </svg>
                    <span style="font-size: 14px;">Kelola Akun Ahli Gizi</span>
                </a>
            </li>

        </ul>

        <form action="{{ route('logout') }}" method="POST" style="margin-top:auto;">
    @csrf
    <button type="submit" class="logout-btn">
        <svg width="20" height="20"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
        <span>Log Out</span>
    </button>
</form>
    </nav>

    <main class="main-content">
        @yield('content')
    </main>

    @stack('scripts')
</body>

</html>
