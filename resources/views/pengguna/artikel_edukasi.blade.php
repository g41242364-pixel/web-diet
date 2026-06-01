@extends('layouts.layout_pengguna')

@section('title', 'Artikel Edukasi')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/artikel_edukasi.css') }}">

<div class="main-wrapper">

    {{-- BUTTON KEMBALI --}}
    <a href="{{ url('/rekomendasi-artikel') }}" class="btn-back">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        Kembali
    </a>

    {{-- HEADER --}}
    <div class="article-header">
        <div class="header-info">
            <div class="icon-box">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/>
                </svg>
            </div>

            <div class="header-text">
                <h2>Artikel Edukasi</h2>
                <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
            </div>
        </div>
    </div>

    <div class="article-container-box">
        <div class="article-grid">

            @forelse($artikels as $artikel)
                <a href="{{ route('pengguna.artikel.detail', $artikel->id) }}" class="article-card">

                    <div class="card-banner">
                        @if ($artikel->gambar)
                            <img src="{{ asset('assets/images/artikel/' . $artikel->gambar) }}"
                                alt="{{ $artikel->judul }}">
                        @else
                            <img src="{{ asset('assets/images/mangkok.png') }}"
                                alt="Artikel">
                        @endif
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
                <div style="grid-column:1/-1;text-align:center;padding:40px;color:#aaa;">
                    <p>Belum ada artikel. Kunjungi kembali nanti.</p>
                </div>
            @endforelse

        </div>
    </div>

</div>
@endsection