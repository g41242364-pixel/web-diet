@extends('layouts.layout_pengguna')

@section('title', 'Daftar Makanan Lainnya')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/jurnal_makanan.css') }}">

    <div class="main-wrapper">

        <header class="jurnal-header">
            <div class="header-left">
                <a href="{{ route('pengguna.jurnalMakanan') }}" class="btn-back">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Kembali ke Rekomendasi</span>
                </a>
            </div>

            <div class="header-center">
                <div class="header-icon">
                    <img src="" alt="">
                </div>
                <div class="header-text">
                    <h1>Daftar Nutrisi Makanan Sehat</h1>
                    <p>Pilihan alternatif makanan bergizi penunjang diet seimbangmu</p>
                </div>
            </div>
        </header>

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
                                    alt="{{ $food->nama }}" class="food-image">
                            </div>

                            <div class="food-nutrition-info">
                                <h5 class="nutrition-title">Kandungan Gizi:</h5>
                                <ul class="nutrition-list">
                                    <li>
                                        <span class="label">Energi / Kalori:</span>
                                        <span class="value">{{ $food->kalori ?? 0 }} kkal</span>
                                    </li>
                                    <li>
                                        <span class="label">Protein:</span>
                                        <span class="value">{{ $food->protein ?? 0 }} g</span>
                                    </li>
                                    <li>
                                        <span class="label">Karbohidrat:</span>
                                        <span class="value">{{ $food->karbohidrat ?? 0 }} g</span>
                                    </li>
                                    <li>
                                        <span class="label">Lemak:</span>
                                        <span class="value">{{ $food->lemak ?? 0 }} g</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>Belum ada alternatif makanan tambahan yang tersedia saat ini.</p>
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

@endsection pada kode ini aku ingin mengubah judulnya terlalu besar 

ini contoh dari fitur lain
@extends('layouts.layout_pengguna')
@section('title', 'Skrining Diet - Langkah 1')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/skrining_langkah_1.css') }}">

@section('content')
<div class="skrining-container">
    <div class="skrining-header-top">
        <div style="display:flex;align-items:flex-start;gap:15px;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
                <circle cx="4" cy="6" r="1"/>
                <circle cx="4" cy="12" r="1"/>
                <circle cx="4" cy="18" r="1"/>
            </svg>

            <div>
                <h2>Skrining Diet</h2>
                <p>Skrining pola makan dan kebiasaan diet secara bertahap.</p>
            </div>
        </div>
    </div>

    <div class="step-info">Langkah 1 dari 4</div>

    <div class="progress-container">
        <div class="progress-fill" style="width:25%"></div>
    </div>

    <div class="nav-steps">
        <div class="nav-step-item active">Fase 1</div>
        <div class="nav-arrow">→</div>

        <div class="nav-step-item">Fase 2</div>
        <div class="nav-arrow">→</div>

        <div class="nav-step-item">Analisis Diet</div>
        <div class="nav-arrow">→</div>

        <div class="nav-step-item">Hasil</div>
    </div>

    @if(session('error'))
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="skrining-box">
        <h4 class="fase-title">Fase 1 — Kebiasaan Pola Makan</h4>

        <form action="{{ route('skrining.langkah1.simpan') }}" method="POST">
            @csrf

            @foreach($questions as $question)
            <div class="question-item">

                <span class="question-text">
                    {{ $loop->iteration }}. {{ $question->pertanyaan }}
                </span>

                <div class="options-grid">
                    @foreach($question->options as $option)
                    <label class="option-item">

                        <input type="radio"
                               name="q_{{ $question->id }}"
                               value="{{ $option->id }}"
                               {{ old('q_'.$question->id) == $option->id ? 'checked' : '' }}
                               required>

                        {{ $option->jawaban }}

                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="footer-nav">
                <a href="{{ route('pengguna.dashboard') }}" class="btn-nav">
                    ← Kembali
                </a>

                <button type="submit" class="btn-nav">
                    Lanjut Fase 2 →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection