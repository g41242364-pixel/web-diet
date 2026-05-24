<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - @yield('title', 'Dashboard')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&family=Playfair+Display:wght@700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/layout/layout_pengguna.css') }}">
    <style>
        /* Fix: pastikan button tidak kena reset global */
        button {
            font-family: 'Poppins', sans-serif;
        }
    </style>
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
                    <span>Dashboard Pengguna</span>
                </div>
            </div>
        </div>

        <ul class="nav-menu">
            <li>
                <a href="{{ route('pengguna.dashboard') }}" class="nav-item {{ request()->routeIs('pengguna.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ route('skrining.langkah1') }}" class="nav-item {{ request()->routeIs('skrining.*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2" />
                        <line x1="8" y1="6" x2="16" y2="6" />
                        <line x1="8" y1="10" x2="16" y2="10" />
                        <line x1="8" y1="14" x2="16" y2="14" />
                        <line x1="8" y1="18" x2="16" y2="18" />
                    </svg>
                    <span>Skrining IMT</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengguna.targetDiet') }}" class="nav-item {{ request()->routeIs('pengguna.targetDiet*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="12" r="6" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>
                    <span>Target Diet</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengguna.jurnalMakanan') }}" class="nav-item {{ request()->routeIs('pengguna.jurnalMakanan*') ? 'active' : '' }}">
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
                <a href="{{ route('pengguna.polaTidur') }}" class="nav-item {{ request()->routeIs('pengguna.polaTidur*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z" />
                    </svg>
                    <span>Pola Tidur</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengguna.aktivitasFisik') }}" class="nav-item {{ request()->routeIs('pengguna.aktivitasFisik') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M13 4v16M17 4v16M9 4v16M5 4v16M21 4v16M1 4h22M1 20h22" />
                    </svg>
                    <span style="font-size: 14px;">Aktivitas Fisik</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengguna.konsultasi') }}" class="nav-item {{ request()->routeIs('pengguna.konsultasi*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                    </svg>
                    <span>Konsultasi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengguna.artikel') }}" class="nav-item {{ request()->routeIs('pengguna.artikel*') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                        <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5V4.5z" />
                    </svg>
                    <span>Artikel</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pengguna.profil') }}" class="nav-item {{ request()->is('profil') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    <span>Profil</span>
                </a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            {{-- DIUBAH: pakai class logout-btn tersendiri, tidak pakai nav-item --}}
            <button type="submit" class="logout-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="24" height="24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
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