@extends('layouts.layout_pengguna')

@section('title', 'Detail Aktivitas Fisik')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/detail_aktivitas.css') }}">

<div class="detail-container">

    {{-- HEADER --}}
    <div class="page-header">

        <div class="header-content">

            <img src="{{ asset('assets/images/fisik.png') }}"
                alt="Fisik Icon"
                onerror="this.src='https://cdn-icons-png.flaticon.com/512/3048/3048398.png'">

            <div class="header-text">
                <h2>Aktivitas Fisik</h2>
                <p>
                    Panduan aktivitas fisik untuk mendukung gaya hidup sehat Anda.
                </p>
            </div>

        </div>

    </div>

    /* ==========================
   BUTTON KEMBALI
========================== */

.back-nav {
    margin: 24px 0;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 10px;

    background: #2563EB;
    color: #FFFFFF;

    padding: 12px 22px;
    border-radius: 30px;

    text-decoration: none;
    font-size: 14px;
    font-weight: 600;

    transition: all .25s ease;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.18);
}

.btn-back:hover {
    background: #1D4ED8;
    color: #FFFFFF;
    transform: translateY(-2px);
}

.btn-back svg {
    flex-shrink: 0;
}
    {{-- DETAIL CARD --}}
    <div class="detail-card">

        <div class="detail-content">

            <h1 class="activity-title">
                {{ $act->nama }}
            </h1>

            <div class="activity-illustration">

                @if ($act->link_youtube)

                    @php
                        preg_match(
                            '/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/',
                            $act->link_youtube,
                            $matches,
                        );

                        $videoId = $matches[1] ?? null;
                    @endphp

                    @if ($videoId)

                        <iframe
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0"
                            allowfullscreen>
                        </iframe>

                    @endif

                @else

                    <img
                        src="https://img.freepik.com/free-vector/fast-walking-concept-illustration_114360-1567.jpg"
                        alt="Default Illustration">

                @endif

            </div>

            <p class="activity-short-desc">
                {{ $act->deskripsi }}
            </p>

            <div class="info-bar">

                <h4 class="info-label">
                    Informasi Aktivitas
                </h4>

                <div class="info-grid">

                    {{-- DURASI --}}
                    <div class="info-item">

                        <div class="info-icon duration">

                            <svg width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#52C41A"
                                stroke-width="2">

                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>

                            </svg>

                        </div>

                        <div class="info-text">

                            <span class="label">
                                Durasi
                            </span>

                            <span class="value">
                                {{ $act->durasi ?? '30-45 Menit' }}
                            </span>

                        </div>

                    </div>

                    {{-- INTENSITAS --}}
                    <div class="info-item">

                        <div class="info-icon intensity">

                            <svg width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#52C41A"
                                stroke-width="2">

                                <path d="M18 20V10"></path>
                                <path d="M12 20V4"></path>
                                <path d="M6 20v-6"></path>

                            </svg>

                        </div>

                        <div class="info-text">

                            <span class="label">
                                Intensitas
                            </span>

                            <span class="value">
                                {{ $act->intensitas ?? 'Sedang' }}
                            </span>

                        </div>

                    </div>

                    {{-- LOKASI --}}
                    <div class="info-item">

                        <div class="info-icon location">

                            <svg width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="#52C41A"
                                stroke-width="2">

                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>

                            </svg>

                        </div>

                        <div class="info-text">

                            <span class="label">
                                Lokasi
                            </span>

                            <span class="value">
                                {{ $act->lokasi ?? 'Luar Ruangan' }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection