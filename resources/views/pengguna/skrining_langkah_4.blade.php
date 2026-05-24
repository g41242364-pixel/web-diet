@extends('layouts.layout_pengguna')
@section('title', 'Skrining Diet - Hasil')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/skrining_langkah_3.css') }}">

@section('content')

    @php
        $warna_diet = match ($status_diet) {
            'Pola Diet Baik' => '#2563EB',
            'Pola Diet Cukup' => '#3B82F6',
            'Pola Diet Kurang Baik' => '#1D4ED8',
            'Pola Diet Buruk' => '#1E3A5F',
            default => '#64748B',
        };

        $warna_kebiasaan = match ($status_kebiasaan) {
            'Hidup Sehat' => '#2563EB',
            'Cukup Sehat' => '#3B82F6',
            'Kurang Sehat' => '#1D4ED8',
            'Tidak Sehat' => '#1E3A5F',
            default => '#64748B',
        };

        $pesan_diet = match ($status_diet) {
            'Pola Diet Baik' => 'Pola makan Anda sudah baik dan seimbang. Pertahankan kebiasaan sehat ini.',
            'Pola Diet Cukup' => 'Pola makan cukup baik, namun masih perlu peningkatan pada beberapa aspek konsumsi.',
            'Pola Diet Kurang Baik' => 'Pola makan kurang baik. Kurangi makanan tinggi gula, garam, dan lemak.',
            'Pola Diet Buruk' => 'Pola makan tidak sehat. Disarankan melakukan konsultasi dengan ahli gizi.',
            default => '',
        };
    @endphp

    <div class="skrining-container">

        <div class="skrining-header-top">
            <div style="display:flex;align-items:flex-start;gap:15px;">

                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5">
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                    <circle cx="4" cy="6" r="1" />
                    <circle cx="4" cy="12" r="1" />
                    <circle cx="4" cy="18" r="1" />
                </svg>

                <div>
                    <h2 style="color:#FFFFFF;">Skrining Diet</h2>
                    <p style="color:#EFF6FF;">Skrining pola makan dan kebiasaan diet secara bertahap.</p>
                </div>

            </div>
        </div>

        <div class="step-info" style="color:#EFF6FF;">Langkah 4 dari 4</div>

        <div class="progress-container">
            <div class="progress-fill" style="width:100%;background:#2563EB;"></div>
        </div>

        <div class="nav-steps">
            <div class="nav-step-item" style="background:#EFF6FF;color:#1E3A5F;border:1px solid #2563EB;">Fase 1</div>
            <div class="nav-arrow" style="color:#FFFFFF;">→</div>

            <div class="nav-step-item" style="background:#EFF6FF;color:#1E3A5F;border:1px solid #2563EB;">Fase 2</div>
            <div class="nav-arrow" style="color:#FFFFFF;">→</div>

            <div class="nav-step-item" style="background:#EFF6FF;color:#1E3A5F;border:1px solid #2563EB;">Input IMT</div>
            <div class="nav-arrow" style="color:#FFFFFF;">→</div>

            <div class="nav-step-item active" style="background:#DBEAFE;color:#1D4ED8;border:1px solid #1D4ED8;">Hasil</div>
        </div>

        @if (session('success'))
            <div style="background:#DBEAFE;color:#1D4ED8;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (isset($error))
            <div style="background:#FEE2E2;color:#B91C1C;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                ⚠ {{ $error }}
            </div>
        @endif

        <div class="skrining-box" style="background:#FFFFFF;box-shadow:0 6px 18px rgba(0,0,0,0.08);border-radius:18px;">

            <div class="result-section">

                <div class="section-header" style="color:#1E3A5F;">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#1E3A5F"
                        stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>

                    <span>Hasil Skrining Diet</span>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:16px 0;">

                    <div style="background:#EFF6FF;border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:12px;color:#64748B;margin-bottom:4px;">
                            Frekuensi Makan
                        </div>

                        <div style="font-size:22px;font-weight:700;color:#1E3A5F;">
                            {{ $screening->frekuensi_makan }}
                        </div>

                        <div style="font-size:12px;color:#64748B;">
                            kali/hari
                        </div>
                    </div>

                    <div style="background:#EFF6FF;border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:12px;color:#64748B;margin-bottom:4px;">
                            Konsumsi Air
                        </div>

                        <div style="font-size:22px;font-weight:700;color:#1E3A5F;">
                            {{ $screening->konsumsi_air }}
                        </div>

                        <div style="font-size:12px;color:#64748B;">
                            gelas/hari
                        </div>
                    </div>

                </div>
            </div>

            <div class="result-section">

                <span class="label-text" style="color:#1E3A5F;">
                    Status Pola Diet Anda
                </span>

                <div class="status-pill" style="background:{{ $warna_diet }};color:#fff;margin-top:12px;border:none;">
                    {{ $status_diet }}
                </div>

                <p class="advice-text" style="margin-top:12px;color:#475569;">
                    {{ $pesan_diet }}
                </p>

                <div
                    style="margin-top:14px;font-size:12px;color:#475569;background:#EFF6FF;border-radius:8px;padding:10px 14px;line-height:1.8;">

                    <strong>Referensi Status Diet:</strong><br>

                    Pola Diet Baik → Konsumsi makanan seimbang &nbsp;|&nbsp;
                    Pola Diet Cukup → Perlu sedikit perbaikan &nbsp;|&nbsp;
                    Pola Diet Kurang Baik → Kurangi makanan tidak sehat &nbsp;|&nbsp;
                    Pola Diet Buruk → Konsultasi dengan ahli gizi

                </div>

            </div>

            <div class="result-section" style="margin-top:16px;">

                <span class="label-text" style="color:#1E3A5F;">
                    Skor Kebiasaan Diet (10 Pertanyaan)
                </span>

                <div style="font-size:36px;font-weight:800;color:#1E3A5F;margin:8px 0;">
                    {{ $total_skor }}
                    <span style="font-size:16px;font-weight:400;color:#64748B;">/ 40</span>
                </div>

                <div class="status-pill" style="background:{{ $warna_kebiasaan }};color:#fff;border:none;">
                    {{ $status_kebiasaan }}
                </div>

                <div
                    style="margin-top:14px;font-size:12px;color:#475569;background:#EFF6FF;border-radius:8px;padding:10px 14px;line-height:1.8;">

                    <strong>Referensi Skor:</strong><br>

                    10 – 17 → Hidup Sehat &nbsp;|&nbsp;
                    18 – 25 → Cukup Sehat &nbsp;|&nbsp;
                    26 – 32 → Kurang Sehat &nbsp;|&nbsp;
                    33 – 40 → Tidak Sehat

                </div>

            </div>

            <div style="margin-top:20px;display:flex;gap:12px;flex-wrap:wrap;">

                <form action="{{ route('skrining.lanjutKonsultasi', $screening->id) }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="btn-konsultasi"
                            style="background:#2563EB;color:#FFFFFF;border:none;">
                        💬 Lanjut Konsultasi
                    </button>
                </form>

                <a href="{{ route('pengguna.dashboard') }}"
                   class="btn-konsultasi"
                   style="background:#1E3A5F;text-decoration:none;color:#FFFFFF;border:none;">

                    ← Ke Dashboard

                </a>

            </div>

        </div>
    </div>
@endsection