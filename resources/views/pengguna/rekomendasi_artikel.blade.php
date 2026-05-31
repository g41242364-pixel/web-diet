@extends('layouts.layout_pengguna')

@section('title', 'Rekomendasi Artikel')

@section('content')

@php
    $statusClass = 'status-default';
    $statusIconColor = 'var(--default-accent)';

    if ($statusImt) {
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
        }
    }
@endphp

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

        --bg-light: #F0F7FA;
        --white: #ffffff;
    }

    .main-wrapper {
        padding: 20px 40px 40px;
        background-color: var(--bg-light);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
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
    }

    .header-text h2 {
        font-size: 42px;
        font-weight: 800;
        margin: 0;
    }

    .btn-others {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #7BB9D8;
        color: #fff;
        padding: 12px 24px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
    }

    .screening-banner {
        display: flex;
        align-items: center;
        padding: 20px 30px;
        border-radius: 16px;
        margin-bottom: 30px;
        border: 1px solid var(--default-border);
        border-left: 5px solid var(--default-accent);
        background: var(--default-bg);
    }

    .article-container-box {
        background: #D8EBF3;
        border-radius: 32px;
        padding: 40px;
    }

    .article-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .article-card {
        background: #fff;
        border-radius: 28px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
    }

    .card-banner {
        height: 160px;
        overflow: hidden;
    }

    .card-banner img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-content {
        padding: 25px;
    }

    .category-tag {
        background: #5D99C6;
        color: #fff;
        padding: 5px 14px;
        border-radius: 12px;
        font-size: 11px;
        display: inline-block;
        margin-bottom: 12px;
    }
</style>

<div class="main-wrapper">

    <div class="page-header">
        <div class="header-content">
            <div class="header-icon-wrapper">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="#5BA4C4">
                    <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6z"/>
                </svg>
            </div>

            <div class="header-text">
                <h2>Artikel Edukasi</h2>
                <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
            </div>
        </div>

        <a href="{{ route('pengguna.artikel.all') }}" class="btn-others">
            Artikel Lainnya
        </a>
    </div>

    @if ($statusImt)
        <div class="screening-banner {{ $statusClass }}">
            <div>
                <svg width="30" height="30" stroke="{{ $statusIconColor }}">
                    <polyline points="20 6 9 17 4 12" />
                </svg>
            </div>

            <div>
                <h3>HASIL SKRINING : {{ strtoupper($statusImt) }}</h3>
                <p>Artikel direkomendasikan berdasarkan status IMT Anda.</p>
            </div>
        </div>
    @endif

    <div class="article-container-box">

        <div class="article-grid">

            @forelse ($artikels as $artikel)
                <a href="{{ route('pengguna.artikel.detail', $artikel->id) }}" class="article-card">

                    <div class="card-banner">
                        @if ($artikel->gambar)
                            <img src="{{ asset('assets/images/artikel/' . $artikel->gambar) }}"
                                alt="{{ $artikel->judul }}">
                        @else
                            <img src="{{ asset('assets/images/mangkok.png') }}" alt="Artikel">
                        @endif
                    </div>

                    <div class="card-content">
                        <span class="category-tag">{{ $artikel->rekomendasi_imt }}</span>
                        <h4>{{ $artikel->judul }}</h4>
                        <p>{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                        <div>Baca selengkapnya →</div>
                    </div>

                </a>
            @empty
                <div style="grid-column:1/-1; text-align:center; padding:40px; color:#aaa;">
                    Belum ada artikel
                </div>
            @endforelse

        </div>

    </div>

</div>

@endsection