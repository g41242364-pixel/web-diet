@extends('layouts.layout_pengguna')

@section('title', 'Aktivitas Fisik')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/aktivitas_fisik.css') }}">

@section('content')

{{-- TOMBOL KEMBALI (di atas, gaya jurnal makanan) --}}
<a href="{{ route('pengguna.aktivitasFisik') }}" class="btn-recommendation">
    ← Kembali
</a>

{{-- PAGE HEADER --}}
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

{{-- ACTIVITY CONTAINER --}}
<div class="activity-container">
    <div class="activity-grid">

        @forelse($aktivitas as $i => $act)

        <a href="{{ route('aktivitas.detail', $act->id) }}" class="activity-card-link">
            <div class="activity-card">

                {{-- THUMBNAIL / YOUTUBE --}}
                @if ($act->link_youtube)
                    @php
                        preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $act->link_youtube, $matches);
                        $videoId = $matches[1] ?? null;
                    @endphp
                    @if ($videoId)
                        <iframe
                            src="https://www.youtube.com/embed/{{ $videoId }}"
                            frameborder="0"
                            allowfullscreen
                            style="width:100%; height:160px; border-radius:12px; margin-top:15px;">
                        </iframe>
                    @endif
                @else
                    <img
                        src="https://img.freepik.com/free-vector/fast-walking-concept-illustration_114360-1567.jpg"
                        class="activity-img"
                        alt="{{ $act->nama }}">
                @endif

                {{-- JUDUL --}}
                <h4>{{ $act->nama }}</h4>

                {{-- DESKRIPSI --}}
                <p class="desc">{{ Str::limit($act->deskripsi, 100) }}</p>

                {{-- MANFAAT --}}
                <div class="benefit-row">
                    <svg viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C7 2 7 6.5 7 6.5C7 9.5 8.5 11 8.5 11C8.5 11 6 10 4.5 13C3 16 4.5 21 12 22C19.5 21 21 16 19.5 13C18 10 15.5 11 15.5 11C15.5 11 17 9.5 17 6.5C17 6.5 17 2 12 2Z" />
                    </svg>
                    <p>{{ $act->manfaat ?? 'Meningkatkan kebugaran dan kesehatan tubuh secara keseluruhan.' }}</p>
                </div>

                {{-- TAGS --}}
                <div class="tags-container">
                    <div class="tag-pill">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                        {{ $act->durasi ?? '20-30 Menit' }}
                    </div>
                    <div class="tag-pill">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 20V10M12 20V4M6 20v-6"/>
                        </svg>
                        {{ $act->intensitas ?? 'Sedang' }}
                    </div>
                    <div class="tag-pill">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                        </svg>
                        {{ $act->lokasi ?? 'Fleksibel' }}
                    </div>
                </div>

                {{-- STATUS IMT --}}
                <div class="category-tag-wrapper">
                    <span class="category-tag">
                        Status: {{ $act->kategori_imt }}
                    </span>
                </div>

            </div>
        </a>

        @empty

        <div style="grid-column:1/-1; text-align:center; padding:60px; color:#94a3b8;">
            <p>Tidak ada aktivitas fisik yang ditemukan.</p>
        </div>

        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="pagination-container">
        {{ $aktivitas->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection