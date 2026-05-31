@extends('layouts.layout_pengguna')

@section('title', 'Rekomendasi Artikel')

@section('content')

@php
    $statusLower = strtolower($statusImt ?? '');

    if (str_contains($statusLower, 'underweight')) {
        $statusClass = 'status-kurus';
        $statusIcon = 'i';
        $statusIconColor = 'var(--kurus-accent)';
    } elseif (str_contains($statusLower, 'normal')) {
        $statusClass = 'status-normal';
        $statusIcon = '✓';
        $statusIconColor = 'var(--normal-accent)';
    } elseif (str_contains($statusLower, 'overweight')) {
        $statusClass = 'status-gemuk';
        $statusIcon = '!';
        $statusIconColor = 'var(--gemuk-accent)';
    } elseif (str_contains($statusLower, 'obesitas 1')) {
        $statusClass = 'status-obesitas';
        $statusIcon = '⚠';
        $statusIconColor = 'var(--obesitas-accent)';
    } elseif (str_contains($statusLower, 'obesitas 2')) {
        $statusClass = 'status-obesitas';
        $statusIcon = '⚠';
        $statusIconColor = 'var(--obesitas-accent2)';
    } else {
        $statusClass = 'status-default';
        $statusIcon = '!';
        $statusIconColor = 'var(--default-accent)';
    }
@endphp

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/rekomendasi_artikel.css') }}">

<div class="main-wrapper">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="header-content">
            <img src="{{ asset('assets/images/sendok.png') }}" alt="Artikel">

            <div class="header-text">
                <h2>Artikel Edukasi</h2>
                <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
            </div>
        </div>

        <a href="{{ route('pengguna.artikel.all') }}" class="btn-others">
            Artikel Lainnya
        </a>

    </div>

    {{-- STATUS BANNER --}}
    @if ($statusImt)
        <div class="status-banner {{ $statusClass }}">

            <div class="banner-info">

                <div class="warning-icon">
                    {{ $statusIcon }}
                </div>

                <div class="banner-text">
                    <h3>Hasil Skrining : {{ $statusImt }}</h3>
                    <p>Artikel berikut direkomendasikan berdasarkan status IMT Anda.</p>
                </div>

            </div>

            <div class="status-badge">
                {{ $statusImt }}
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

                        <p>
                            {{ Str::limit(strip_tags($artikel->isi), 100) }}
                        </p>

                        <div class="read-more">
                            Baca selengkapnya →
                        </div>

                    </div>

                </a>
            @empty
                <div style="grid-column:1/-1; text-align:center; padding:40px; color:#999;">
                    Belum ada artikel tersedia
                </div>
            @endforelse

        </div>

    </div>

</div>

@endsection