@extends('layouts.layout_pengguna')
@section('title', 'Skrining IMT - Hasil')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/skrining_langkah_3.css') }}">

@section('content')

@php
    $warna_imt = match ($status_imt) {
        'Underweight' => '#F59E0B',
        'Normal' => '#22C55E',
        'Overweight' => '#F97316',
        'Obesitas 1' => '#EF4444',
        'Obesitas 2' => '#B91C1C',
        default => '#64748B',
    };

    $warna_kebiasaan = match ($status_kebiasaan) {
        'Hidup Sehat' => '#22C55E',
        'Cukup Sehat' => '#3B82F6',
        'Kurang Sehat' => '#F97316',
        'Tidak Sehat' => '#B91C1C',
        default => '#64748B',
    };

    $pesan_imt = match ($status_imt) {
        'Underweight' => 'IMT di bawah 18.5. Tingkatkan asupan kalori bergizi dan konsultasikan dengan ahli gizi.',
        'Normal' => 'IMT 18.5–22.9. Pertahankan pola hidup sehat saat ini!',
        'Overweight' => 'IMT 23–24.9. Perhatikan pola makan dan tingkatkan aktivitas fisik.',
        'Obesitas 1' => 'IMT 25–29.9. Kurangi kalori dan tingkatkan aktivitas fisik secara teratur.',
        'Obesitas 2' => 'IMT di atas 30. Segera konsultasikan dengan ahli gizi untuk program diet yang tepat.',
        default => '',
    };
@endphp

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
            <div>
                <h2>Skrining Diet</h2>
                <p>Lengkapi skrining untuk mengetahui kondisi dan pola hidup Anda.</p>
            </div>

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
                    Skrining Bertahap : Fase 1 → Fase 2 → IMT → Hasil.
                </p>

            </div>

        </div>

    </div>

    {{-- STEP --}}
    <div class="step-info">
        Langkah 4 dari 4
    </div>

    {{-- PROGRESS --}}
    <div class="progress-container">
        <div class="progress-fill" style="width:100%"></div>
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

        <div class="nav-step-item">
            IMT
        </div>

        <div class="nav-arrow">
            →
        </div>

        <div class="nav-step-item active">
            Hasil
        </div>

    </div>

    {{-- SUCCESS --}}
    @if (session('success'))
        <div style="
            background:#DCFCE7;
            color:#15803D;
            padding:12px 16px;
            border-radius:8px;
            margin-bottom:16px;
        ">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- ERROR --}}
    @if (isset($error))
        <div style="
            background:#FEE2E2;
            color:#B91C1C;
            padding:12px 16px;
            border-radius:8px;
            margin-bottom:16px;
        ">
            ⚠ {{ $error }}
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="skrining-box">

        <h4 class="fase-title">
            Hasil Skrining IMT
        </h4>

        {{-- BERAT & TINGGI --}}
        <div class="result-section">

            <div style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:12px;
                margin:16px 0;
            ">

                {{-- BERAT --}}
                <div style="
                    background:#EFF6FF;
                    border:1px solid #BFDBFE;
                    border-radius:14px;
                    padding:18px;
                    text-align:center;
                ">

                    <div style="
                        font-size:13px;
                        color:#64748B;
                        margin-bottom:6px;
                    ">
                        Berat Badan
                    </div>

                    <div style="
                        font-size:26px;
                        font-weight:800;
                        color:#0F172A;
                    ">
                        {{ $screening->berat_badan }}
                    </div>

                    <div style="
                        font-size:13px;
                        color:#64748B;
                    ">
                        kg
                    </div>

                </div>

                {{-- TINGGI --}}
                <div style="
                    background:#EFF6FF;
                    border:1px solid #BFDBFE;
                    border-radius:14px;
                    padding:18px;
                    text-align:center;
                ">

                    <div style="
                        font-size:13px;
                        color:#64748B;
                        margin-bottom:6px;
                    ">
                        Tinggi Badan
                    </div>

                    <div style="
                        font-size:26px;
                        font-weight:800;
                        color:#0F172A;
                    ">
                        {{ $screening->tinggi_badan }}
                    </div>

                    <div style="
                        font-size:13px;
                        color:#64748B;
                    ">
                        cm
                    </div>

                </div>

            </div>

        </div>

        {{-- IMT --}}
        <div class="result-section" style="margin-top:20px;text-align:center;">

            <span class="question-text">
                Indeks Massa Tubuh (IMT) Anda
            </span>

            <div style="
                font-size:42px;
                font-weight:800;
                color:#0F172A;
                margin:10px 0;
                text-align:center;
            ">
                {{ $screening->imt }}
            </div>

            <div style="
                background:{{ $warna_imt }}15;
                border:2px solid {{ $warna_imt }};
                color:{{ $warna_imt }};
                border-radius:14px;
                padding:16px 20px;
                font-size:22px;
                font-weight:700;
                text-align:center;
                margin-top:12px;
            ">
                {{ $status_imt }}
            </div>

            <p style="
                margin-top:14px;
                text-align:center;
            ">
                {{ $pesan_imt }}
            </p>

        </div>

        {{-- KEBIASAAN --}}
        <div class="result-section" style="margin-top:20px;text-align:center;">

            <span class="question-text">
                Skor Kebiasaan Hidup (10 Pertanyaan)
            </span>

            <div style="
                font-size:38px;
                font-weight:800;
                color:#0F172A;
                margin:8px 0;
                text-align:center;
            ">
                {{ $total_skor }}

                <span style="
                    font-size:16px;
                    font-weight:400;
                    color:#64748B;
                ">
                    / 40
                </span>
            </div>

            <div style="
                background:{{ $warna_kebiasaan }}15;
                border:2px solid {{ $warna_kebiasaan }};
                color:{{ $warna_kebiasaan }};
                border-radius:14px;
                padding:16px 20px;
                font-size:22px;
                font-weight:700;
                text-align:center;
                margin-top:12px;
            ">
                {{ $status_kebiasaan }}
            </div>
        </div>

        {{-- BUTTON --}}
        <div style="
            display:flex;
            gap:15px;
            align-items:center;
            justify-content:center;
            margin-top:30px;
            flex-wrap:wrap;
        ">

            <form action="{{ route('skrining.lanjutKonsultasi', $screening->id) }}" method="POST">

                @csrf
                <button type="submit"
                    style="
                        background:#7C3AED;
                        color:white;
                        border:none;
                        padding:12px 22px;
                        border-radius:999px;
                        font-size:15px;
                        font-weight:600;
                        cursor:pointer;
                        box-shadow:0 4px 10px rgba(124,58,237,0.2);
                    ">
                    💬 Lanjut Konsultasi
                </button>

            </form>
            <a href="{{ route('pengguna.dashboard') }}"
                style="
                    background:#E2E8F0;
                    color:#1E293B;
                    padding:12px 22px;
                    border-radius:999px;
                    font-size:15px;
                    font-weight:600;
                    text-decoration:none;
                    display:inline-flex;
                    align-items:center;
                    justify-content:center;
                ">
                ← Ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection