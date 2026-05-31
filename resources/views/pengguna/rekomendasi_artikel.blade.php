@extends('layouts.layout_pengguna')

@section('title', 'Rekomendasi Artikel')

@section('content')

@php
    $statusLower = strtolower($statusImt ?? '');

    if (str_contains($statusLower, 'underweight')) {
        $statusClass = 'status-kurus';
        $statusIcon = 'i';
    } elseif (str_contains($statusLower, 'normal')) {
        $statusClass = 'status-normal';
        $statusIcon = '✓';
    } elseif (str_contains($statusLower, 'overweight')) {
        $statusClass = 'status-gemuk';
        $statusIcon = '!';
    } elseif (str_contains($statusLower, 'obesitas 1')) {
        $statusClass = 'status-obesitas';
        $statusIcon = '⚠';
    } elseif (str_contains($statusLower, 'obesitas 2')) {
        $statusClass = 'status-obesitas';
        $statusIcon = '⚠';
    } else {
        $statusClass = 'status-default';
        $statusIcon = '!';
    }
@endphp

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/rekomendasi_artikel.css') }}">

<div class="main-wrapper">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="header-content">
            <img src="{{ asset('assets/images/sendok.png') }}" alt="icon">

            <div class="header-text">
                <h2>Artikel Edukasi</h2>
                <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
            </div>
        </div>

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
                    <p>Artikel direkomendasikan berdasarkan status IMT Anda.</p>
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
                            : asset('assets/images/mangkok.png') }}">
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
                <div style="grid-column:1/-1;text-align:center;padding:40px;color:#999;">
                    Belum ada artikel
                </div>
            @endforelse

        </div>

        {{-- BUTTON PINDAH KE BAWAH (SEPERTI JURNAL MAKANAN) --}}
        <div class="action-container">
            <a href="{{ route('pengguna.artikel.all') }}" class="btn-others">
                <span>Artikel Lainnya</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

    </div>

</div>

@endsection