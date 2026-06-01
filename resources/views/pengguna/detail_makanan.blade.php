@extends('layouts.layout_pengguna')

@section('title', 'Detail Menu')

@section('content')

    @php
        $gambarKategori = [
            'sarapan' => 'Sarapan.jpg',
            'makan_siang' => 'Makan Siang.jpg',
            'makan_malam' => 'Makan Malam.jpeg',
            'camilan' => 'Cemilan.jpg',
        ];

        $gambar = asset('assets/images/' . ($gambarKategori[$plan->kategori] ?? 'default.png'));
    @endphp

    <link rel="stylesheet" href="{{ asset('assets/css/pengguna/detail_makanan.css') }}">

    <div class="detail-container">

        <a href="{{ route('pengguna.jurnalMakanan') }}" class="btn-back">
            <svg width="20"
                 height="20"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar
        </a>

        <div class="detail-card">

            <div class="category-banner">
                {{ ucfirst(str_replace('_', ' ', $plan->kategori)) }}
            </div>

            <div class="hero-section">

                <img src="{{ $gambar }}"
                     alt="{{ $plan->kategori }}">

                <h1>
                    @foreach ($plan->items as $item)
                        {{ $item->food->nama ?? '-' }}{{ !$loop->last ? ' + ' : '' }}
                    @endforeach
                </h1>

            </div>

            <div class="nutritional-grid">

                @foreach ($plan->items as $item)

                    <div class="nut-box">

                        <h5>{{ $item->food->nama ?? '-' }}</h5>

                        <ul class="nut-list">

                            <li>
                                <span class="nut-icon">🔥</span>
                                {{ $item->food->kalori ?? 0 }} kkal
                            </li>

                            <li>
                                <span class="nut-icon">🥩</span>
                                Protein {{ $item->food->protein ?? 0 }}g
                            </li>

                            <li>
                                <span class="nut-icon">🥑</span>
                                Lemak {{ $item->food->lemak ?? 0 }}g
                            </li>

                            <li>
                                <span class="nut-icon">🍞</span>
                                Karbo {{ $item->food->karbohidrat ?? 0 }}g
                            </li>

                        </ul>

                    </div>

                @endforeach

                <div class="nut-box total-box">

                    <h5>TOTAL NUTRISI</h5>

                    <ul class="nut-list">

                        <li>
                            <span class="nut-icon">🔥</span>
                            <strong>{{ $plan->total_kalori }} kkal</strong>
                        </li>

                        <li>
                            <span class="nut-icon">🥩</span>
                            <strong>Protein {{ $plan->total_protein }}g</strong>
                        </li>

                        <li>
                            <span class="nut-icon">🥑</span>
                            <strong>Lemak {{ $plan->total_lemak }}g</strong>
                        </li>

                        <li>
                            <span class="nut-icon">🍞</span>
                            <strong>Karbo {{ $plan->total_karbohidrat }}g</strong>
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

@endsection