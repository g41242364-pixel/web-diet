@extends('layouts.layout_pengguna')

@section('title', 'Daftar Makanan Lainnya')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/jurnal_makanan.css') }}">

<div class="main-wrapper">

    <!-- BUTTON KEMBALI -->
    <a href="{{ route('pengguna.jurnalMakanan') }}" class="btn-back">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round">
            <line x1="19" y1="12" x2="5" y2="12"></line>
            <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
        <span>Kembali ke Rekomendasi</span>
    </a>

    <!-- HEADER -->
    <div class="nutrition-header-card">
        <h1>Daftar Nutrisi Makanan Sehat</h1>
        <p>Pilihan alternatif makanan bergizi penunjang diet seimbangmu</p>
    </div>

    <!-- CONTENT -->
    <div class="content-container">

        <div class="foods-grid">

            @forelse ($foods as $food)

                <div class="food-card">

                    <div class="food-card-header">
                        {{ $food->nama }}
                    </div>

                    <div class="food-card-body">

                        <div class="image-wrapper">
                            <img src="{{ $food->gambar ? asset('assets/images/makanan/' . $food->gambar) : asset('assets/images/Cemilan.png') }}"
                                alt="{{ $food->nama }}"
                                class="food-image">
                        </div>

                        <div class="food-nutrition-info">

                            <h5 class="nutrition-title">
                                Kandungan Gizi
                            </h5>

                            <ul class="nutrition-list">
                                <li>
                                    <span class="label">Energi / Kalori</span>
                                    <span class="value">{{ $food->kalori ?? 0 }} kkal</span>
                                </li>

                                <li>
                                    <span class="label">Protein</span>
                                    <span class="value">{{ $food->protein ?? 0 }} g</span>
                                </li>

                                <li>
                                    <span class="label">Karbohidrat</span>
                                    <span class="value">{{ $food->karbohidrat ?? 0 }} g</span>
                                </li>

                                <li>
                                    <span class="label">Lemak</span>
                                    <span class="value">{{ $food->lemak ?? 0 }} g</span>
                                </li>
                            </ul>

                        </div>

                    </div>

                </div>

            @empty

                <div class="empty-state">
                    Belum ada alternatif makanan tambahan yang tersedia saat ini.
                </div>

            @endforelse

        </div>

        @if ($foods->hasPages())
            <div class="pagination-wrapper">
                {{ $foods->links('pagination::bootstrap-5') }}
            </div>
        @endif

    </div>

</div>

@endsection
