@extends('layouts.layout_pengguna')
@section('title', 'Skrining Diet - Langkah 3')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/skrining_langkah_2.css') }}">

@section('content')

<div class="skrining-container">

    {{-- HEADER --}}
    <div class="skrining-header-top">

        <div style="display:flex;align-items:center;gap:15px;">

            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
                <circle cx="4" cy="6" r="1"/>
                <circle cx="4" cy="12" r="1"/>
                <circle cx="4" cy="18" r="1"/>
            </svg>

            <div style="display:flex;flex-direction:column;justify-content:center;">

                <h2 style="
                    color:#0F172A !important;
                    font-size:36px !important;
                    font-weight:800 !important;
                    margin:0 !important;
                    line-height:1.1 !important;
                ">
                    Skrining IMT
                </h2>

                <p style="
                    color:#64748B !important;
                    font-size:16px !important;
                    margin-top:4px !important;
                ">
                    Skrining Bertahap : Fase 1 → Fase 2 → Input IMT → Hasil.
                </p>

            </div>

        </div>

    </div>

    {{-- STEP --}}
    <div class="step-info">
        Langkah 3 dari 4
    </div>

    {{-- PROGRESS --}}
    <div class="progress-container">
        <div class="progress-fill" style="width:50%"></div>
    </div>

    {{-- NAVIGATION --}}
    <div class="nav-steps">

        <div class="nav-step-item">
            Fase 1
        </div>

        <div class="nav-arrow">
            →
        </div>

        <div class="nav-step-item">
            Fase 2
        </div>

        <div class="nav-arrow">
            →
        </div>

        <div class="nav-step-item active">
            Input IMT
        </div>

        <div class="nav-arrow">
            →
        </div>

        <div class="nav-step-item">
            Hasil
        </div>

    </div>

    {{-- ERROR --}}
    @if($errors->any())
        <div style="
            background:#fde8e8;
            color:#c0392b;
            padding:12px 16px;
            border-radius:8px;
            margin-bottom:16px;
        ">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="skrining-box">

        <div class="imt-form-container">

            {{-- TITLE --}}
            <div class="input-imt-header">

                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>

                <span>
                    Input IMT — Berat & Tinggi Badan
                </span>

            </div>

            {{-- FORM --}}
            <form action="{{ route('skrining.langkah3.simpan') }}" method="POST">

                @csrf

                <div class="imt-input-group">

                    <label>
                        Berat Badan (kg)
                    </label>

                    <input
                        type="number"
                        name="berat_badan"
                        step="0.1"
                        placeholder="58"
                        value="{{ old('berat_badan') }}"
                        required
                    >

                </div>

                <div class="imt-input-group">

                    <label>
                        Tinggi Badan (cm)
                    </label>

                    <input
                        type="number"
                        name="tinggi_badan"
                        step="0.1"
                        placeholder="158"
                        value="{{ old('tinggi_badan') }}"
                        required
                    >

                </div>

                {{-- BUTTON --}}
                <div class="footer-nav">

                    <a href="{{ route('skrining.langkah2') }}" class="btn-nav">
                        ← Kembali
                    </a>

                    <button type="submit" class="btn-nav">
                        Lihat Hasil →
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection