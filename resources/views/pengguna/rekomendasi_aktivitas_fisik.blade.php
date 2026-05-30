@extends('layouts.layout_pengguna')

@section('title', 'Rekomendasi Aktivitas Fisik')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/rekomendasi_aktivitas_fisik.css') }}">

<div class="main-wrapper">

    <div class="page-header">
        <div class="header-content">
            <img src="{{ asset('assets/images/fisik.png') }}" alt="Fisik Icon"
                onerror="this.src='https://cdn-icons-png.flaticon.com/512/3048/3048398.png'">
            <div class="header-text">
                <h2>Aktivitas Fisik</h2>
                <p>Panduan aktivitas fisik untuk mendukung gaya hidup sehat Anda.</p>
            </div>
        </div>
    </div>

    @if ($skriningTerakhir)
        @php
            $statusLower = strtolower($skriningTerakhir->status_kebiasaan ?? '');

            if (str_contains($statusLower, 'hidup sehat')) {
                $statusClass = 'status-normal';
                $statusIconColor = 'var(--normal-accent)';
            } elseif (str_contains($statusLower, 'cukup sehat')) {
                $statusClass = 'status-gemuk';
                $statusIconColor = 'var(--gemuk-accent)';
            } elseif (str_contains($statusLower, 'kurang sehat')) {
                $statusClass = 'status-obesitas';
                $statusIconColor = 'var(--obesitas-accent)';
            } elseif (str_contains($statusLower, 'tidak sehat')) {
                $statusClass = 'status-kurus';
                $statusIconColor = 'var(--kurus-accent)';
            } else {
                $statusClass = 'status-default';
                $statusIconColor = 'var(--default-accent)';
            }
        @endphp

        <div class="result-banner {{ $statusClass }}">
    <div class="banner-main-content">
        <div class="check-icon">
            <svg width="35" height="35" viewBox="0 0 24 24" fill="none"
                stroke="{{ $statusIconColor }}" stroke-width="3">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </div>

        <div class="banner-text">
            <h3>Status Kebiasaan: {{ $skriningTerakhir->status_kebiasaan }}</h3>
            <p>Berikut rekomendasi aktivitas fisik berdasarkan status kebiasaan Anda.</p>
        </div>
    </div>
</div>
    @else
        <div style="background:#fff3cd;color:#856404;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            Lakukan skrining untuk mendapat rekomendasi aktivitas yang personal.
            <a href="{{ route('skrining.langkah1') }}" style="color:#856404;font-weight:600;">Skrining →</a>
        </div>
    @endif

    <div class="activity-container">
        <div class="activity-grid">
            @forelse($aktivitas as $i => $act)
                <a href="{{ route('aktivitas.detail', $act->id) }}" class="activity-card-link"
                    style="text-decoration: none; color: inherit;">
                    <div class="activity-card">

                        <div class="card-number">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>

                        @if ($act->gambar)
                            <img src="{{ asset('assets/images/aktivitas/' . $act->gambar) }}"
                                class="activity-img" alt="{{ $act->nama }}">
                        @else
                            <img src="https://img.freepik.com/free-vector/fast-walking-concept-illustration_114360-1567.jpg"
                                class="activity-img" alt="{{ $act->nama }}">
                        @endif

                        <h4>{{ $act->nama }}</h4>

                        <p class="desc">{{ $act->deskripsi }}</p>

                        <div class="benefit-row">
                            <svg class="benefit-icon" viewBox="0 0 24 24" fill="#FF5C5C"
                                width="18" height="18">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>

                            <p>
                                {{ $act->manfaat ?? 'Meningkatkan kebugaran dan kesehatan tubuh secara keseluruhan.' }}
                            </p>
                        </div>

                        <div class="tags-container">
                            <div class="tag-pill">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>

                                <span>{{ $act->durasi ?? '30-45 Menit' }}</span>
                            </div>

                            <div class="tag-pill">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                </svg>

                                <span>{{ $act->intensitas ?? 'Sedang' }}</span>
                            </div>

                            <div class="tag-pill">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2.5">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>

                                <span>{{ $act->lokasi ?? 'Luar Ruangan' }}</span>
                            </div>
                        </div>

                        <div class="category-tag-wrapper">
                            <span class="category-tag">
                                Status: {{ $act->status_kebiasaan }}
                            </span>
                        </div>

                    </div>
                </a>
            @empty
                <div style="grid-column:1/-1;text-align:center;padding:40px;color:#aaa;">
                    <p>Belum ada data aktivitas fisik. Hubungi admin untuk menambahkan data.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-container">
            {{ $aktivitas->links() }}
        </div>

        <div class="action-container">
    <a href="{{ route('aktivitas.all') }}" class="btn-others">
        <span>Aktivitas Lainnya</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
        </svg>
    </a>
</div>
    </div>

</div>

@endsection
