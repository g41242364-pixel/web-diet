@extends('layouts.layout_pengguna')

@section('title', $artikel->judul)

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/pengguna/detail_artikel.css') }}">

    <div class="article-header">
        <div class="header-info">
            <div class="header-icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="#4285F4">
                    <path
                        d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z" />
                </svg>
            </div>
            <div class="header-text">
                <h2>Artikel Edukasi</h2>
                <p>Bacaan ringkas seputar nutrisi & gaya hidup sehat</p>
            </div>
        </div>
        <a href="{{ route('pengguna.artikel') }}" class="btn-back">Kembali ke Artikel</a>
    </div>

    <div class="detail-wrapper">
        <div class="main-content2">
            <div class="article-card">
                <div class="card-header-meta">
                    <span class="category-pill">{{ $artikel->rekomendasi_imt }}</span>
                </div>

                <h1 class="article-title">{{ $artikel->judul }}</h1>

                <div class="article-meta">
                    Oleh {{ $artikel->penulis->name ?? 'Admin' }} · {{ $artikel->created_at->format('d M Y') }}
                </div>

                <div class="main-image-container">
                    @if ($artikel->gambar)
                        <img src="{{ asset('assets/images/artikel/' . $artikel->gambar) }}" class="main-image"
                            alt="{{ $artikel->judul }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=1000"
                            class="main-image" alt="Default Image">
                    @endif
                </div>

                <div class="article-text">
                    {!! nl2br(e($artikel->isi)) !!}
                </div>
            </div>
        </div>

        <div class="sidebar-content">
            <div class="related-articles-card">
                <h3>Artikel Terkait</h3>
                <div class="related-list">
                    @forelse($artikelTerkait as $terkait)
                        <a href="{{ route('pengguna.artikel.detail', $terkait->id) }}" class="related-item">
                            <div class="related-thumb">
                                @if ($terkait->gambar)
                                    <img src="{{ asset('assets/images/artikel/' . $terkait->gambar) }}"
                                        alt="{{ $terkait->judul }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&q=80&w=200"
                                        alt="Thumb">
                                @endif
                            </div>
                            <div class="related-info">
                                <span>{{ $terkait->judul }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="empty-related">
                            <p>Tidak ada artikel terkait lainnya.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
