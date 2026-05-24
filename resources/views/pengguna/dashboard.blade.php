@extends('layouts.layout_pengguna')
@section('title', 'Dashboard')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/dashboard.css') }}">

@section('content')
    <div class="header-title">
        <h2>DASHBOARD SISD</h2>
        <p>Selamat datang, {{ auth()->user()->name }}</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;font-size:14px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <section class="welcome-card">
        <h3>SELAMAT DATANG DI SISD 👋</h3>
        <p>
            Mulai perjalanan hidup sehatmu dengan melakukan Skrining IMT,
            Memantau pola hidup, dan mendapatkan rekomendasi kesehatan secara digital
        </p>

        <button class="btn-mulai" onclick="window.location.href='{{ route('skrining.langkah1') }}'">
            {{ $skriningTerakhir ? 'Skrining Ulang' : 'Mulai Sekarang' }}
        </button>
    </section>

    <div class="stats-grid">
        <div class="stat-card">
            <h4>Hasil IMT</h4>

            @if($skriningTerakhir)
                <p style="font-size:20px;font-weight:700;color:#000000;">
                    {{ $skriningTerakhir->status_imt }}
                </p>

                <small style="color:#888;font-size:11px;">
                    {{ $skriningTerakhir->created_at->format('d M Y') }}
                </small>
            @else
                <p style="color:#aaa;">Belum ada data</p>
            @endif
        </div>

        {{-- <div class="stat-card">
            <h4>IMT Saat Ini</h4>

            @if($skriningTerakhir)
                <p style="font-size:20px;font-weight:700;color:#000000;">
                    {{ $skriningTerakhir->imt }}
                </p>

                <small style="color:#888;font-size:11px;">kg/m²</small>
            @else
                <p style="color:#aaa;">Belum ada data</p>
            @endif
        </div> --}}

        <div class="stat-card">
            <h4>Target Berat</h4>

            @if($targetDiet)
                <p style="font-size:20px;font-weight:700;color:#000000;">
                    {{ $targetDiet->berat_target }} kg
                </p>

                <small style="color:#888;font-size:11px;">
                    {{ ucfirst($targetDiet->tujuan) }} berat
                </small>
            @else
                <p style="color:#aaa;">Belum diset</p>
            @endif
        </div>

        <div class="stat-card">
            <h4>Hasil Skrining</h4>

            @if($statusKebiasaan)
                <p style="font-size:20px;font-weight:700;color:#000000;">
                    {{ ucfirst($statusKebiasaan) }}
                </p>
            @else
                <p style="color:#aaa;">Belum diset</p>
            @endif
        </div>

    </div>

    <div class="bottom-grid">
        <div class="summary-container">
            <div class="summary-header">
                <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                </svg>

                <span>Ringkasan Pola Tidur</span>
            </div>

            <div class="summary-content-white">
                <img
                    src="{{ asset('assets/images/Rectangle 145.png') }}"
                    class="sleep-image"
                    alt="Ilustrasi Tidur"
                    onerror="this.src='https://img.freepik.com/free-vector/boy-sleeping-bed-night_1308-41071.jpg'"
                >

                <div class="sleep-stats">
                    <div class="stat-item">
                        <div class="stat-label">
                            <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12 6 12 12 16 14"/>
                            </svg>

                            <span>Durasi Tidur</span>
                        </div>

                        <span class="stat-value">
                            {{ $sleepLogTerakhir
                                ? floor($sleepLogTerakhir->durasi_jam) . ' jam ' . round(($sleepLogTerakhir->durasi_jam - floor($sleepLogTerakhir->durasi_jam)) * 60) . ' menit'
                                : '-- Jam -- menit'
                            }}
                        </span>
                    </div>

                    <div class="stat-item">
                        <div class="stat-label">
                            <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 6L9 17l-5-5"/>
                            </svg>

                            <span>Kualitas Tidur</span>
                        </div>

                        <span class="stat-value">
                            {{ $sleepLogTerakhir ? $sleepLogTerakhir->status_tidur : '-' }}
                        </span>
                    </div>

                    <div class="stat-item">
                        <div class="stat-label">
                            <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 20h20"/>
                                <path d="M5 20v-5a2 2 0 0 1 2-2h14v7"/>
                            </svg>

                            <span>Jam Tidur</span>
                        </div>

                        <span class="stat-value">
                            {{ $sleepLogTerakhir ? $sleepLogTerakhir->jam_tidur : '-- : --' }}
                        </span>
                    </div>

                    <div class="stat-item">
                        <div class="stat-label">
                            <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2"/>
                                <line x1="16" y1="2" x2="16" y2="6"/>
                                <line x1="8" y1="2" x2="8" y2="6"/>
                                <line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>

                            <span>Jam Bangun</span>
                        </div>

                        <span class="stat-value">
                            {{ $sleepLogTerakhir ? $sleepLogTerakhir->jam_bangun : '-- : --' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="summary-container">
            <div class="summary-header">
                <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5V4.5z"/>
                </svg>

                <span>Catatan Konsultasi</span>
            </div>

            <div class="summary-content-white">
                @if($konsultasiTerakhir && $konsultasiTerakhir->messages->count() > 0)

                    @php
                        $pesanTerakhir = $konsultasiTerakhir->messages->last();
                    @endphp

                    <div style="padding:12px 0;">
                        <div style="display:flex;align-items:center;gap:8px;margin-bottom:12px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:#90D2ED;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;">
                                {{ substr($konsultasiTerakhir->ahliGizi->name,0,1) }}
                            </div>

                            <div>
                                <div style="font-weight:600;font-size:13px;">
                                    {{ $konsultasiTerakhir->ahliGizi->name }}
                                </div>

                                <div style="font-size:11px;color:#888;">
                                    Ahli Gizi
                                </div>
                            </div>

                            <span
                                style="
                                    margin-left:auto;
                                    font-size:11px;
                                    padding:2px 8px;
                                    border-radius:12px;
                                    background:{{ $konsultasiTerakhir->status === 'aktif' ? '#e8f8e8' : '#f0f0f0' }};
                                    color:{{ $konsultasiTerakhir->status === 'aktif' ? '#27ae60' : '#888' }};
                                "
                            >
                                {{ ucfirst($konsultasiTerakhir->status) }}
                            </span>
                        </div>

                        <div style="background:#f5f5f5;border-radius:8px;padding:10px 12px;font-size:13px;color:#555;">
                            {{ Str::limit($pesanTerakhir->isi, 120) }}
                        </div>

                        <div style="font-size:11px;color:#aaa;margin-top:6px;">
                            {{ $pesanTerakhir->created_at->diffForHumans() }}
                        </div>

                        <a
                            href="{{ route('pengguna.konsultasi.chat', $konsultasiTerakhir->id) }}"
                            style="display:inline-block;margin-top:12px;padding:8px 16px;background:#90D2ED;color:#fff;border-radius:8px;font-size:13px;text-decoration:none;"
                        >
                            Buka Chat →
                        </a>
                    </div>

                @else

                    <div class="consultation-illustrations" style="display:flex;justify-content:space-around;width:100%;margin-bottom:20px;">
                        <img
                            src="{{ asset('assets/images/Group.png') }}"
                            style="width:80px;"
                            onerror="this.src='https://cdn-icons-png.flaticon.com/512/2991/2991108.png'"
                        >

                        <img
                            src="{{ asset('assets/images/Rectangle 150.png') }}"
                            style="width:80px;"
                            onerror="this.src='https://cdn-icons-png.flaticon.com/512/3304/3304567.png'"
                        >
                    </div>

                    <div class="empty-state-box">
                        <h5>Belum ada catatan konsultasi</h5>
                        <p>Lakukan konsultasi untuk mendapatkan saran dari ahli gizi</p>
                    </div>

                @endif
            </div>
        </div>
    </div>
@endsection
