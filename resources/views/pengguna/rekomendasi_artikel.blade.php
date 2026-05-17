@extends('layouts.layout_pengguna')

@section('title', 'Rekomendasi Artikel')

@section('content')

    @if ($statusImt)
        @php
            $statusLower = strtolower($statusImt ?? '');

            if (str_contains($statusLower, 'underweight')) {
                $statusClass = 'status-kurus';
                $statusIconColor = 'var(--kurus-accent)';
            } elseif (str_contains($statusLower, 'normal')) {
                $statusClass = 'status-normal';
                $statusIconColor = 'var(--normal-accent)';
            } elseif (str_contains($statusLower, 'overweight')) {
                $statusClass = 'status-gemuk';
                $statusIconColor = 'var(--gemuk-accent)';
            } elseif (str_contains($statusLower, 'obesitas 1')) {
                $statusClass = 'status-obesitas';
                $statusIconColor = 'var(--obesitas-accent)';
            } elseif (str_contains($statusLower, 'obesitas 2')) {
                $statusClass = 'status-obesitas';
                $statusIconColor = 'var(--obesitas-accent2)';
            } else {
                $statusClass = 'status-default';
                $statusIconColor = 'var(--default-accent)';
            }
        @endphp
    @endif

    <style>
        :root {
            --kurus-bg: #FFF9E6;
            --kurus-border: #FFE082;
            --kurus-accent: #FFB300;
            --kurus-text: #5D4037;

            --normal-bg: #E8F5E9;
            --normal-border: #C8E6C9;
            --normal-accent: #2ECC71;
            --normal-text: #1B5E20;

            --gemuk-bg: #FFF3E0;
            --gemuk-border: #FFE0B2;
            --gemuk-accent: #FF9800;
            --gemuk-text: #E65100;

            --obesitas-bg: #FFEBEE;
            --obesitas-border: #FFCDD2;
            --obesitas-accent: #E74C3C;
            --obesitas-accent2: #e74d3c9a;
            --obesitas-text: #C62828;

            --default-bg: #ffffff;
            --default-border: #E1E8ED;
            --default-accent: #7BB9D8;
            --default-text: #262626;

            --primary-blue: #90D2ED;
            --dark-blue: #5BA4C4;
            --bg-light: #F0F7FA;
            --white: #ffffff;
        }

        .main-wrapper {
            padding: 20px 40px 40px;
            background-color: var(--bg-light);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 10px 0;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .header-icon-wrapper {
            background: #E8F0F5;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .header-text h2 {
            font-size: 42px;
            font-weight: 800;
            margin: 0;
            color: #000000;
            letter-spacing: -0.5px;
        }

        .header-text p {
            font-size: 16px;
            color: #555555;
            margin: 6px 0 0;
        }

        .btn-others {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #7BB9D8;
            color: #ffffff !important;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(123, 185, 216, 0.25);
            border: none;
            flex-shrink: 0;
        }

        .btn-others:hover {
            background-color: #5BA4C4;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(91, 164, 196, 0.35);
        }

        .btn-others svg {
            transition: transform 0.2s ease;
        }

        .btn-others:hover svg {
            transform: translateX(3px);
        }

        .screening-banner {
            display: flex;
            align-items: center;
            padding: 20px 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            gap: 20px;
            border: 1px solid var(--default-border);
            border-left: 5px solid var(--default-accent);
            background-color: var(--default-bg);
            transition: all 0.3s ease;
        }

        .banner-main-content {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .check-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #ffffff;
            border: 1px solid var(--default-border);
            transition: all 0.3s ease;
        }

        .banner-text h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 800;
            color: var(--default-text);
            letter-spacing: 0.5px;
            transition: color 0.3s ease;
        }

        .banner-text p {
            margin: 5px 0 0;
            font-size: 13px;
            color: #595959;
        }

        .screening-banner.status-kurus {
            background-color: var(--kurus-bg);
            border-color: var(--kurus-border);
            border-left-color: var(--kurus-accent);
        }

        .screening-banner.status-kurus .banner-text h3 {
            color: var(--kurus-text);
        }

        .screening-banner.status-kurus .check-icon {
            background: #ffffff;
            border-color: var(--kurus-border);
        }

        .screening-banner.status-normal {
            background-color: var(--normal-bg);
            border-color: var(--normal-border);
            border-left-color: var(--normal-accent);
        }

        .screening-banner.status-normal .banner-text h3 {
            color: var(--normal-text);
        }

        .screening-banner.status-normal .check-icon {
            background: #ffffff;
            border-color: var(--normal-border);
        }

        .screening-banner.status-gemuk {
            background-color: var(--gemuk-bg);
            border-color: var(--gemuk-border);
            border-left-color: var(--gemuk-accent);
        }

        .screening-banner.status-gemuk .banner-text h3 {
            color: var(--gemuk-text);
        }

        .screening-banner.status-gemuk .check-icon {
            background: #ffffff;
            border-color: var(--gemuk-border);
        }

        .screening-banner.status-obesitas {
            background-color: var(--obesitas-bg);
            border-color: var(--obesitas-border);
            border-left-color: var(--obesitas-accent);
        }

        .screening-banner.status-obesitas .banner-text h3 {
            color: var(--obesitas-text);
        }

        .screening-banner.status-obesitas .check-icon {
            background: #ffffff;
            border-color: var(--obesitas-border);
        }

        .article-container-box {
            background: #D8EBF3;
            border-radius: 32px;
            padding: 40px;
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .article-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
        }

        .article-card {
            background: var(--white);
            border-radius: 28px;
            overflow: hidden;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.08);
        }

        .card-banner {
            background-color: #5D99C6;
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .card-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            padding: 25px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .category-tag {
            background: #5D99C6;
            color: white;
            padding: 5px 14px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 12px;
            align-self: flex-start;
        }

        .article-card h4 {
            font-size: 18px;
            font-weight: 800;
            margin: 0 0 10px 0;
            color: #000000;
            line-height: 1.4;
        }

        .article-card p {
            font-size: 13px;
            color: #555555;
            margin: 0 0 20px 0;
            line-height: 1.5;
            flex-grow: 1;
        }

        .read-more {
            font-size: 13px;
            font-weight: 700;
            color: #000;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: gap 0.2s ease;
        }

        .article-card:hover .read-more {
            gap: 8px;
        }

        @media (max-width: 1200px) {
            .article-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column-reverse;
                align-items: stretch;
                gap: 20px;
                padding: 10px 0;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .header-text h2 {
                font-size: 32px;
            }

            .screening-banner {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
                padding: 20px;
            }

            .banner-main-content {
                flex-direction: column;
                text-align: center;
            }

            .article-grid {
                grid-template-columns: 1fr;
            }

            .article-container-box {
                padding: 20px;
            }

            .btn-others {
                width: 100%;
                justify-content: center;
            }

            .main-wrapper {
                padding: 15px;
            }
        }
    </style>

    <div class="main-wrapper">

        <div class="page-header">
            <div class="header-content">
                <div class="header-icon-wrapper">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="#5BA4C4">
                        <path
                            d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z" />
                    </svg>
                </div>
                <div class="header-text">
                    <h2>Artikel Edukasi</h2>
                    <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
                </div>
            </div>

            <a href="{{ route('pengguna.artikel.all') }}" class="btn-others">
                <span>Artikel Lainnya</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

        @if ($statusImt)
            <div class="screening-banner {{ $statusClass }}">
                <div class="banner-main-content">
                    <div class="check-icon">
                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none"
                            stroke="{{ $statusIconColor }}" stroke-width="3">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <div class="banner-text">
                        <h3>HASIL SKRINING : {{ strtoupper($statusImt) }}</h3>
                        <p>Artikel berikut direkomendasikan berdasarkan status IMT Anda.</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="article-container-box">
            <div class="article-grid">
                @forelse($artikels as $artikel)
                    <a href="{{ route('pengguna.artikel.detail', $artikel->id) }}" class="article-card">
                        <div class="card-banner">
                            @if ($artikel->gambar)
                                <img src="{{ asset('assets/images/artikel/' . $artikel->gambar) }}"
                                    alt="{{ $artikel->judul }}">
                            @else
                                
                                <img src="{{ asset('assets/images/mangkok.png') }}" alt="Artikel"
                                    onerror="this.src='https://cdn-icons-png.flaticon.com/512/1046/1046857.png'">
                            @endif
                        </div>
                        <div class="card-content">
                            <span class="category-tag">{{ $artikel->rekomendasi_imt }}</span>
                            <h4>{{ $artikel->judul }}</h4>
                            <p>{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                            <div class="read-more">Baca selengkapnya →</div>
                        </div>
                    </a>
                @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #aaa;">
                        <p>Belum ada artikel. Kunjungi kembali nanti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
