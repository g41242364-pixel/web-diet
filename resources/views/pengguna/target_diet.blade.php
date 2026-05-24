@extends('layouts.layout_pengguna')
@section('title', 'Target Diet')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/target_diet.css') }}">

@section('content')
    <div class="header-section">
        <div style="display:flex;align-items:center;gap:15px;">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>
            </svg>
            <h2>Target Diet</h2>
        </div>
        <p>Hitung Kategori, Tetapkan Target, dan Pantau Progres Mingguan.</p>
    </div>

    @if(session('success'))
        <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            ✓ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            ⚠ {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">
            {{ $errors->first() }}
        </div>
    @endif

    @if($skriningTerakhir)
    <div class="skrining-banner">
        <div class="icon-check">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </div>
        <div class="banner-content">
            <h4>Catatan dari Skrining Terakhir</h4>
            <div class="tags-container">
                <div class="pill-tag">IMT {{ $skriningTerakhir->imt }} · {{ $skriningTerakhir->status_imt }}</div>
                <span class="date-text">{{ $skriningTerakhir->created_at->format('d M Y') }}</span>
            </div>
        </div>
    </div>
    @endif

    <div class="diet-grid">
        <div class="diet-card">
            <div class="card-title-row">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="4" y="2" width="16" height="20" rx="2"/>
                    <line x1="8" y1="6" x2="16" y2="6"/>
                    <line x1="8" y1="10" x2="16" y2="10"/>
                    <line x1="8" y1="14" x2="16" y2="14"/>
                </svg>
                <span>Hitung Kategori &amp; Tetapkan Target</span>
            </div>

            @if($targetDiet && !$targetTercapai)
                <div style="background:#fff3cd;color:#856404;padding:12px 16px;border-radius:8px;margin-bottom:14px;font-size:13px;">
                    ⚠ Target diet aktif belum tercapai (progres <strong>{{ $progressAktif }}%</strong>).
                    Selesaikan target saat ini sebelum mengatur target baru. Lakukan Check In Hari Ini Jika Belum.
                </div>
            @endif

            <form action="{{ route('pengguna.targetDiet.simpan') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="input-group">
                        <label>Target Berat Badan (kg)</label>
                        <input type="number" name="berat_target" step="0.1" placeholder="55"
                               value="{{ $targetDiet ? $targetDiet->berat_target : '' }}"
                               {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}
                               required>
                    </div>
                    <div class="input-group">
                        <label>Berat Awal (kg)</label>
                        <input type="number" name="berat_awal" step="0.1" placeholder="60"
                               value="{{ $targetDiet ? $targetDiet->berat_awal : ($skriningTerakhir ? $skriningTerakhir->berat_badan : '') }}"
                               {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}>
                    </div>
                </div>

                <div class="input-group" style="margin-bottom:10px;"><label>Tujuan</label></div>
                <div class="tujuan-container"
                     style="{{ $targetDiet && !$targetTercapai ? 'pointer-events:none;opacity:0.5;' : '' }}">
                    <label class="tujuan-item {{ ($targetDiet && $targetDiet->tujuan=='turun') ? 'active' : '' }}" style="cursor:pointer;">
                        <input type="radio" name="tujuan" value="turun"
                               {{ ($targetDiet && $targetDiet->tujuan=='turun') ? 'checked' : '' }}
                               style="display:none;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/>
                            <polyline points="17 18 23 18 23 12"/>
                        </svg>
                        Menurunkan BB
                    </label>
                    <label class="tujuan-item {{ ($targetDiet && $targetDiet->tujuan=='jaga') ? 'active' : '' }}" style="cursor:pointer;">
                        <input type="radio" name="tujuan" value="jaga"
                               {{ ($targetDiet && $targetDiet->tujuan=='jaga') ? 'checked' : '' }}
                               style="display:none;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                        Menjaga BB
                    </label>
                    <label class="tujuan-item {{ (!$targetDiet || $targetDiet->tujuan=='naik') ? 'active' : '' }}" style="cursor:pointer;">
                        <input type="radio" name="tujuan" value="naik"
                               {{ (!$targetDiet || $targetDiet->tujuan=='naik') ? 'checked' : '' }}
                               style="display:none;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                            <polyline points="17 6 23 6 23 12"/>
                        </svg>
                        Menambah BB
                    </label>
                </div>

                <div class="form-row" style="margin-top:12px;">
                    <div class="input-group">
                        <label>Target Mingguan (kg/minggu)</label>
                        <input type="number" name="target_mingguan" step="0.1" placeholder="0.5"
                               value="{{ $targetDiet ? $targetDiet->target_mingguan : '' }}"
                               {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}
                               required>
                    </div>
                </div>

                <button type="submit" class="btn-save-target"
                        {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}
                        style="{{ $targetDiet && !$targetTercapai ? 'opacity:0.5;cursor:not-allowed;' : '' }}">
                    Simpan Target Diet
                </button>
            </form>
        </div>

        <div class="right-column">
            @if($targetDiet)
            <div class="diet-card">
                <div class="card-title-row" style="justify-content:space-between;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>
                        </svg>
                        <span>Target Aktif &amp; Progres</span>
                    </div>
                </div>

                <div class="pill-tag" style="display:inline-block;margin-bottom:10px;">
                    {{ ucfirst($targetDiet->tujuan) }} BB
                </div>

                @if($targetTercapai)
                    <div style="background:#e8f8e8;color:#27ae60;padding:10px 12px;border-radius:8px;font-size:13px;margin-bottom:10px;">
                        🎉 Target berhasil tercapai! Silakan tetapkan target baru.
                    </div>
                @endif

                <div class="target-active-info">
                    Target {{ $targetDiet->berat_target }} kg · {{ $targetDiet->target_mingguan }} kg/minggu<br>
                    Mulai {{ $targetDiet->created_at->format('d M Y') }}
                    @if($targetDiet->berat_awal) · BB awal {{ $targetDiet->berat_awal }} kg @endif
                </div>

                @php
                    $checkinTerbaru = $targetDiet->checkins->first();
                    $progress = $progressAktif;
                @endphp

                <div class="progress-section">
                    <div class="progress-header">
                        <span>Progres</span><span>{{ $progress }}%</span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-fill" style="width:{{ $progress }}%"></div>
                    </div>
                    @if($checkinTerbaru)
                        <p style="font-size:11px;color:#666;margin-top:5px;">
                            Saat ini {{ $checkinTerbaru->berat_sekarang }} kg
                            ({{ $checkinTerbaru->created_at->format('d M Y') }})
                        </p>
                    @endif
                </div>
            </div>
            @endif

            <div class="diet-card" style="background-color:#D8EBF3;">
                <div class="card-title-row">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                    <span>Check-in Mingguan</span>
                </div>

                @if($targetDiet)
                    @if($bolehCheckin && !$targetTercapai)
                    <form action="{{ route('pengguna.targetDiet.checkin') }}" method="POST">
                        @csrf
                        <div class="checkin-form">
                            <div class="input-group" style="flex:0.4;">
                                <label style="font-size:11px;">Berat saat ini (kg)</label>
                                <input type="number" name="berat_sekarang" step="0.1" placeholder="55.8"
                                       style="padding:5px;" required>
                            </div>
                            <div class="input-group">
                                <label style="font-size:11px;">Catatan</label>
                                <input type="text" name="catatan" placeholder="Konsisten Olahraga"
                                       style="padding:5px;text-align:left;">
                            </div>
                            <button type="submit" class="btn-catat">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                    <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                </svg>
                                Catat
                            </button>
                        </div>
                    </form>
                    @elseif($targetTercapai)
                        <div style="background:#e8f8e8;color:#27ae60;padding:10px 12px;border-radius:8px;font-size:13px;margin-bottom:12px;">
                            🎉 Target sudah tercapai! Tetapkan target baru untuk melanjutkan check-in.
                        </div>
                    @else
                        <div style="background:#fff3cd;color:#856404;padding:10px 12px;border-radius:8px;font-size:13px;margin-bottom:12px;">
                            ⏳ Check-in berikutnya tersedia 7 hari setelah check-in terakhir
                            @if($checkinTerakhir)
                                ({{ \Carbon\Carbon::parse($checkinTerakhir->tanggal_checkin)->addDays(7)->format('d M Y') }})
                            @endif
                        </div>
                    @endif

                    <table class="checkin-table">
                        <thead>
                            <tr><th>Berat (kg)</th><th>Tanggal</th><th>Catatan</th></tr>
                        </thead>
                        <tbody>
                            @forelse($checkins as $ci)
                            <tr>
                                <td>{{ $ci->berat_sekarang }}</td>
                                <td>{{ \Carbon\Carbon::parse($ci->tanggal_checkin)->format('d/m/Y') }}</td>
                                <td>{{ $ci->catatan ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="text-align:center;color:#aaa;">Belum ada check-in</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <p style="color:#888;font-size:13px;">Silakan buat target diet terlebih dahulu.</p>
                @endif
            </div>
        </div>
    </div>
@endsection  