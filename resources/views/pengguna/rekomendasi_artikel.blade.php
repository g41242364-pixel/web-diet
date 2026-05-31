@extends('layouts.layout_pengguna')

@section('title', 'Rekomendasi Artikel')

@section('content')

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

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/rekomendasi_artikel.css') }}">

<div class="main-wrapper">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="header-content">

            <div class="header-icon-wrapper">
                <img src="{{ asset('assets/images/book.png') }}"
                     alt="Article Icon"
                     onerror="this.src='https://cdn-icons-png.flaticon.com/512/29/29302.png'">
            </div>

            <div class="header-text">
                <h2>Artikel Edukasi</h2>
                <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
            </div>

        </div>

    </div>

    {{-- STATUS --}}
    @if ($statusImt)
        <div class="status-banner {{ $statusClass }}">

            <div class="banner-info">

                <div class="warning-icon">
                    <svg width="18" height="18" fill="none" stroke="{{ $statusIconColor }}" stroke-width="3">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>

                <div class="banner-text">
                    <h3>HASIL SKRINING : {{ strtoupper($statusImt) }}</h3>
                    <p>Artikel direkomendasikan berdasarkan status IMT Anda.</p>
                </div>

            </div>

        </div>
    @endif

    {{-- ARTIKEL --}}
    <div class="article-container-box">

        <div class="article-grid">

            @forelse ($artikels as $artikel)

                <a href="{{ route('pengguna.artikel.detail', $artikel->id) }}" class="article-card">

                    <div class="card-banner">
                        <img src="{{ $artikel->gambar 
                            ? asset('assets/images/artikel/'.$artikel->gambar)
                            : asset('assets/images/mangkok.png') }}"
                            alt="{{ $artikel->judul }}">
                    </div>

                    <div class="card-content">

                        <span class="category-tag">
                            {{ $artikel->rekomendasi_imt }}
                        </span>

                        <h4>{{ $artikel->judul }}</h4>

                        <p>{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>

                        <div class="read-more">
                            Baca selengkapnya →
                        </div>

                    </div>

                </a>

            @empty
                <div style="grid-column:1/-1;text-align:center;padding:40px;color:#aaa;">
                    Belum ada artikel
                </div>
            @endforelse

        </div>

        {{-- BUTTON ONLY BOTTOM (SESUAI PERMINTAAN) --}}
        <div class="action-container">
            <a href="{{ route('pengguna.artikel.all') }}" class="btn-others">
                Artikel Lainnya →
            </a>
        </div>

    </div>

</div>

@endsection