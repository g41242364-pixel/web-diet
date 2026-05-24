@extends('layouts.layout_pengguna')

@section('title', 'Jurnal Makanan')

@section('content')

    @php
        $statusLower = strtolower($statusImt ?? '');

        if (str_contains($statusLower, 'Underweight')) {
            $statusClass = 'status-kurus';
            $statusIcon = 'i';
            $statusIconColor = 'var(--kurus-accent)';
        } elseif (str_contains($statusLower, 'normal')) {
            $statusClass = 'status-normal';
            $statusIcon = '✓';
            $statusIconColor = 'var(--normal-accent)';
        } elseif (str_contains($statusLower, 'Overweight')) {
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

    <link rel="stylesheet" href="{{ asset('assets/css/pengguna/rekomendasi_jurnal_makanan.css') }}">

    <div class="main-wrapper">

        <div class="page-header">
            <div class="header-content">
                <img src="{{ asset('assets/images/sendok.png') }}" alt="Food Icon"
                    onerror="this.src='https://cdn-icons-png.flaticon.com/512/3048/3048398.png'">
                <div class="header-text">
                    <h2>Jurnal Makanan</h2>
                    <p>Catat makanan harianmu, pahami manfaatnya, hidup lebih sehat</p>
                </div>
            </div>
        </div>

        @php
            $sudahSkrining = !empty($statusImt);
        @endphp

        <div class="status-banner {{ $sudahSkrining ? $statusClass : 'status-default' }}">

            <div class="banner-info">

                <div class="warning-icon">
                    {{ $sudahSkrining ? $statusIcon : '?' }}
                </div>

                <div class="banner-text">

                    @if ($sudahSkrining)
                        <h3>Hasil Skrining : {{ $statusImt }}</h3>

                        <p>
                            Berdasarkan data yang kamu input, hasil skrining menunjukkan
                            bahwa status berat badanmu berada pada kategori ini.
                        </p>
                    @else
                        <h3>Belum Melakukan Skrining</h3>

                        <p>
                            Kamu belum melakukan skrining kesehatan.
                            Silakan lakukan skrining terlebih dahulu untuk mendapatkan
                            rekomendasi makanan dan aktivitas yang sesuai.
                        </p>
                    @endif

                </div>

            </div>

            <div class="status-badge">
                {{ $sudahSkrining ? $statusImt : 'Belum Skrining' }}
            </div>

        </div>

        <div class="meals-container">

            <div class="meals-grid">

                @php
                    $categories = [
                        'sarapan' => 'Sarapan',
                        'makan_siang' => 'Makan Siang',
                        'makan_malam' => 'Makan Malam',
                        'camilan' => 'Camilan',
                    ];

                    $gambarKategori = [
                        'sarapan' => 'Sarapan.jpg',
                        'makan_siang' => 'Makan Siang.jpg',
                        'makan_malam' => 'Makan Malam.jpeg',
                        'camilan' => 'Cemilan.jpg',
                    ];
                @endphp

                @foreach ($categories as $key => $label)
                    @php
                        $plan = $mealPlans->get($key)?->first();
                    @endphp

                    @if ($plan)
                        <a href="{{ route('pengguna.jurnalMakanan.detail', $plan->id) }}" class="meal-card">

                            <div class="meal-card-header">
                                {{ $label }}
                            </div>

                            <div class="meal-card-body">

                                <img src="{{ asset('assets/images/' . ($gambarKategori[$key] ?? 'default.png')) }}"
                                    alt="{{ $label }}" class="meal-image">

                                <div class="meal-info">

                                    <h4>
                                        @foreach ($plan->items as $item)
                                            {{ $item->food->nama ?? '-' }}{{ !$loop->last ? ' + ' : '' }}
                                        @endforeach
                                    </h4>

                                    <p>
                                        Menu seimbang dengan nutrisi yang disesuaikan
                                        untuk kebutuhan energi harianmu.
                                    </p>

                                </div>

                            </div>

                        </a>
                    @else
                        <div class="meal-card" style="opacity: 0.6; cursor: default;">

                            <div class="meal-card-header">
                                {{ $label }}
                            </div>

                            <div class="meal-card-body">

                                <img src="{{ asset('assets/images/' . ($gambarKategori[$key] ?? 'default.png')) }}"
                                    alt="{{ $label }}" class="meal-image">

                                <div class="meal-info">
                                    <p>
                                        Belum ada rekomendasi dari dokter untuk sesi ini.
                                    </p>
                                </div>

                            </div>

                        </div>
                    @endif
                @endforeach

            </div>

            <div class="action-container">
                <a href="{{ route('pengguna.jurnalMakanan.lainnya') }}" class="btn-lihat-lainnya">
                    <span>Lihat Makanan Lainnya</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>

    </div>

@endsection

