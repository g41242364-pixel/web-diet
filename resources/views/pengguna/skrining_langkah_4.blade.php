@extends('layouts.layout_pengguna')
@section('title', 'Skrining IMT - Hasil')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/skrining_langkah_3.css') }}">

@section('content')

    @php
        $warna_imt = match ($status_imt) {
            'Underweight' => '#e67e22',
            'Normal' => '#27ae60',
            'Overweight' => '#f39c12',
            'Obesitas 1' => '#e74c3c',
            'Obesitas 2' => '#c0392b',
            default => '#95a5a6',
        };

        $warna_kebiasaan = match ($status_kebiasaan) {
            'Hidup Sehat' => '#27ae60',
            'Cukup Sehat' => '#2980b9',
            'Kurang Sehat' => '#e67e22',
            'Tidak Sehat' => '#c0392b',
            default => '#95a5a6',
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
        <div class="skrining-header-top">
            <div style="display:flex;align-items:flex-start;gap:15px;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                    <line x1="3" y1="12" x2="21" y2="12" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <line x1="3" y1="18" x2="21" y2="18" />
                    <circle cx="4" cy="6" r="1" />
                    <circle cx="4" cy="12" r="1" />
                    <circle cx="4" cy="18" r="1" />
                </svg>
                <div>
                    <h2>Skrining IMT</h2>
                    <p>Skrining Bertahap : Fase 1 → Fase 2 → IMT → Hasil.</p>
                </div>
            </div>
        </div>

        <div class="step-info">Langkah 4 dari 4</div>
        <div class="progress-container">
            <div class="progress-fill" style="width:100%"></div>
        </div>

        <div class="nav-steps">
            <div class="nav-step-item">Fase 1</div>
            <div class="nav-arrow">→</div>
            <div class="nav-step-item">Fase 2</div>
            <div class="nav-arrow">→</div>
            <div class="nav-step-item">IMT</div>
            <div class="nav-arrow">→</div>
            <div class="nav-step-item active">Hasil</div>
        </div>

        @if (session('success'))
            <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (isset($error))
            <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
                ⚠ {{ $error }}
            </div>
        @endif

        <div class="skrining-box">

            <div class="result-section">
                <div class="section-header">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    <span>Hasil Skrining</span>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:16px 0;">
                    <div style="background:#f0f8ff;border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:12px;color:#888;margin-bottom:4px;">Berat Badan</div>
                        <div style="font-size:22px;font-weight:700;color:#2c3e50;">{{ $screening->berat_badan }}</div>
                        <div style="font-size:12px;color:#888;">kg</div>
                    </div>
                    <div style="background:#f0f8ff;border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:12px;color:#888;margin-bottom:4px;">Tinggi Badan</div>
                        <div style="font-size:22px;font-weight:700;color:#2c3e50;">{{ $screening->tinggi_badan }}</div>
                        <div style="font-size:12px;color:#888;">cm</div>
                    </div>
                </div>
            </div>

            <div class="result-section">
                <span class="label-text">Indeks Massa Tubuh (IMT) Anda</span>
                <div style="font-size:40px;font-weight:800;color:#2c3e50;margin:8px 0;">{{ $screening->imt }}</div>
                <div class="status-pill" style="background:{{ $warna_imt }};color:#fff;">
                    {{ $status_imt }}
                </div>
                <p class="advice-text" style="margin-top:12px;">{{ $pesan_imt }}</p>

                <div
                    style="margin-top:14px;font-size:12px;color:#555;background:#f9f9f9;border-radius:8px;padding:10px 14px;line-height:1.8;">
                    <strong>Referensi IMT:</strong><br>
                    &lt; 18.5 → Underweight &nbsp;|&nbsp;
                    18.5 – 22.9 → Normal &nbsp;|&nbsp;
                    23 – 24.9 → Overweight &nbsp;|&nbsp;
                    25 – 29.9 → Obesitas 1 &nbsp;|&nbsp;
                    ≥ 30 → Obesitas 2
                </div>
            </div>

            <div class="result-section" style="margin-top:16px;">
                <span class="label-text">Skor Kebiasaan Hidup (10 Pertanyaan)</span>
                <div style="font-size:36px;font-weight:800;color:#2c3e50;margin:8px 0;">
                    {{ $total_skor }} <span style="font-size:16px;font-weight:400;color:#888;">/ 40</span>
                </div>
                <div class="status-pill" style="background:{{ $warna_kebiasaan }};color:#fff;">
                    {{ $status_kebiasaan }}
                </div>

                <div
                    style="margin-top:14px;font-size:12px;color:#555;background:#f9f9f9;border-radius:8px;padding:10px 14px;line-height:1.8;">
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
                    <button type="submit" class="btn-konsultasi">💬 Lanjut Konsultasi</button>
                </form>
                <a href="{{ route('pengguna.dashboard') }}" class="btn-konsultasi"
                    style="background:#6c757d;text-decoration:none;">← Ke Dashboard</a>
            </div>

        </div>
    </div>
@endsection
