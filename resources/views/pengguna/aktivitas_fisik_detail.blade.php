@extends('layouts.layout_pengguna')

@section('title', 'Detail Aktivitas Fisik')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/pengguna/detail_aktivitas.css') }}">

    <div class="page-header">
        <div class="header-content">
            <img src="{{ asset('assets/images/fisik.png') }}" alt="Fisik Icon"
                onerror="this.src='https://cdn-icons-png.flaticon.com/512/3048/3048398.png'">
            <div class="header-text">
                <h2>Aktivitas Fisik</h2>
                <p>Panduan aktivitas fisik untuk mendukung gaya hidup sehat Anda.</p>
            </div>
        </div>
        <a href="{{ route('pengguna.aktivitasFisik') }}" class="btn-back">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali Ke Daftar
        </a>
    </div>

    <div class="detail-container">
        <div class="detail-card">
            <div class="detail-content">
                <h1 class="activity-title">{{ $act->nama }}</h1>
                <p class="activity-short-desc">{{ $act->deskripsi }}</p>

                <div class="activity-illustration">
                    @if ($act->link_youtube)
                        @php
                            preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $act->link_youtube, $matches);
                            $videoId = $matches[1] ?? null;
                        @endphp
                        @if ($videoId)
                            <iframe src="https://www.youtube.com/embed/{{ $videoId }}"
                                frameborder="0" allowfullscreen
                                style="width:100%; height:350px; border-radius:12px;">
                            </iframe>
                        @endif
                    @else
                        <img src="https://img.freepik.com/free-vector/fast-walking-concept-illustration_114360-1567.jpg"
                            alt="Default Illustration">
                    @endif
                </div>

                <div class="info-bar">
                    <h4 class="info-label">Informasi Aktifitas</h4>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon duration">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#52C41A" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </div>
                            <div class="info-text">
                                <span class="label">Durasi</span>
                                <span class="value">{{ $act->durasi ?? '30-45 Menit' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon intensity">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#52C41A" stroke-width="2">
                                    <path d="M18 20V10"></path>
                                    <path d="M12 20V4"></path>
                                    <path d="M6 20v-6"></path>
                                </svg>
                            </div>
                            <div class="info-text">
                                <span class="label">Intensitas</span>
                                <span class="value">{{ $act->intensitas ?? 'Sedang' }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon location">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#52C41A" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div class="info-text">
                                <span class="label">Lokasi</span>
                                <span class="value">{{ $act->lokasi ?? 'Luar Ruangan' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection