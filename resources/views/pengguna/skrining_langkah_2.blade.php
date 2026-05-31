@extends('layouts.layout_pengguna')
@section('title', 'Skrining Input - Langkah 2')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/skrining_langkah_1.css') }}">

@section('content')
<div class="skrining-container">
    <div class="skrining-header-top">
        <div style="display:flex;align-items:flex-start;gap:15px;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                <line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
                <circle cx="4" cy="6" r="1"/><circle cx="4" cy="12" r="1"/><circle cx="4" cy="18" r="1"/>
            </svg>
            <div>
                <h2>Skrining Diet</h2>
                <p>Lengkapi skrining untuk mengetahui kondisi dan pola hidup Anda.</p>
            </div>
        </div>
    </div>

    <div class="step-info">Langkah 2 dari 4</div>
    <div class="progress-container"><div class="progress-fill" style="width:50%"></div></div>

    <div class="nav-steps">
        <div class="nav-step-item">Fase 1</div>
        <div class="nav-arrow">→</div>
        <div class="nav-step-item active">Fase 2</div>
        <div class="nav-arrow">→</div>
        <div class="nav-step-item">Input IMT</div>
        <div class="nav-arrow">→</div>
        <div class="nav-step-item">Hasil</div>
    </div>

    @if(session('error'))
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="skrining-box">
        <h4 class="fase-title">Fase 2 — Pola Makan & Istirahat</h4>

        <form action="{{ route('skrining.langkah2.simpan') }}" method="POST">
            @csrf

            @foreach($questions as $question)
            <div class="question-item">
                <span class="question-text">{{ $loop->iteration + 5 }}. {{ $question->pertanyaan }}</span>
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
                <a href="{{ route('skrining.langkah1') }}" class="btn-nav">← Kembali</a>
                <button type="submit" class="btn-nav">Lanjut Input IMT →</button>
            </div>
        </form>
    </div>
</div>
@endsection
