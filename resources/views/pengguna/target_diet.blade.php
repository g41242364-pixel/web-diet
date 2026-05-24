@extends('layouts.layout_pengguna')
@section('title', 'Target Diet')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/target_diet.css') }}">

<style>

/* =========================
   PILIHAN TUJUAN
========================= */

.tujuan-container{
    display:flex;
    gap:12px;
    flex-wrap:wrap;
}

.tujuan-item{
    flex:1;
    min-width:140px;

    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    gap:8px;

    padding:14px 10px;

    background:#f5f7f9;
    border:1.5px solid #d6dce2;
    border-radius:12px;

    font-size:14px;
    font-weight:500;
    color:#555;

    transition:all 0.2s ease;

    cursor:pointer;
}

/* hover pilihan */
.tujuan-item:hover{
    border-color:#7db9d8;
    background:#eef7fc;
}

/* saat dipilih */
.tujuan-item.active{
    background:#d8ebf3;
    border:2px solid #5ba6cc;
    color:#156ea8;

    transform:scale(1.02);
}

/* icon */
.tujuan-item svg{
    width:22px;
    height:22px;
}

/* =========================
   BUTTON SIMPAN
========================= */

.btn-save-target{
    width:100%;
    margin-top:16px;

    background:#7db9d8;
    color:white;

    border:none;
    border-radius:12px;

    padding:14px;

    font-size:15px;
    font-weight:600;

    cursor:pointer;

    transition:all 0.2s ease;
}

/* hover */
.btn-save-target:hover{
    background:#63aacd;
}

/* saat ditekan */
.btn-save-target:active{
    transform:scale(0.97);
}

/* disabled */
.btn-save-target:disabled{
    background:#bfc7cd;
    cursor:not-allowed;
    transform:none;
}

/* =========================
   BUTTON CATAT
========================= */

.btn-catat{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:6px;

    padding:10px 16px;

    border:none;
    border-radius:10px;

    background:#4caf50;
    color:white;

    font-weight:600;

    cursor:pointer;

    transition:all 0.2s ease;
}

/* hover */
.btn-catat:hover{
    background:#43a047;
}

/* klik */
.btn-catat:active{
    transform:scale(0.95);
}

</style>

@section('content')

<div class="header-section">
    <div style="display:flex;align-items:center;gap:15px;">
        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
            <circle cx="12" cy="12" r="10"/>
            <circle cx="12" cy="12" r="6"/>
            <circle cx="12" cy="12" r="2"/>
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
            <div class="pill-tag">
                IMT {{ $skriningTerakhir->imt }} · {{ $skriningTerakhir->status_imt }}
            </div>

            <span class="date-text">
                {{ $skriningTerakhir->created_at->format('d M Y') }}
            </span>
        </div>
    </div>
</div>
@endif

<div class="diet-grid">

    <!-- KIRI -->
    <div class="diet-card">

        <div class="card-title-row">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="4" y="2" width="16" height="20" rx="2"/>
                <line x1="8" y1="6" x2="16" y2="6"/>
                <line x1="8" y1="10" x2="16" y2="10"/>
                <line x1="8" y1="14" x2="16" y2="14"/>
            </svg>

            <span>Hitung Kategori & Tetapkan Target</span>
        </div>

        @if($targetDiet && !$targetTercapai)
        <div style="background:#fff3cd;color:#856404;padding:12px 16px;border-radius:8px;margin-bottom:14px;font-size:13px;">
            ⚠ Target diet aktif belum tercapai
            (progres <strong>{{ $progressAktif }}%</strong>).
            Selesaikan target saat ini sebelum mengatur target baru.
        </div>
        @endif

        <form action="{{ route('pengguna.targetDiet.simpan') }}" method="POST">
            @csrf

            <div class="form-row">

                <div class="input-group">
                    <label>Target Berat Badan (kg)</label>

                    <input type="number"
                           name="berat_target"
                           step="0.1"
                           placeholder="55"
                           value="{{ $targetDiet ? $targetDiet->berat_target : '' }}"
                           {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}
                           required>
                </div>

                <div class="input-group">
                    <label>Berat Awal (kg)</label>

                    <input type="number"
                           name="berat_awal"
                           step="0.1"
                           placeholder="60"
                           value="{{ $targetDiet ? $targetDiet->berat_awal : ($skriningTerakhir ? $skriningTerakhir->berat_badan : '') }}"
                           {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}>
                </div>

            </div>

            <!-- TUJUAN -->
            <div class="input-group" style="margin-bottom:10px;">
                <label>Tujuan</label>
            </div>

            <div class="tujuan-container">

                <label class="tujuan-item {{ ($targetDiet && $targetDiet->tujuan=='turun') ? 'active' : '' }}">

                    <input type="radio"
                           name="tujuan"
                           value="turun"
                           style="display:none;"
                           {{ ($targetDiet && $targetDiet->tujuan=='turun') ? 'checked' : '' }}>

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <polyline points="23 18 13.5 8.5 8.5 13.5 1 6"/>
                        <polyline points="17 18 23 18 23 12"/>
                    </svg>

                    Menurunkan BB
                </label>

                <label class="tujuan-item {{ ($targetDiet && $targetDiet->tujuan=='jaga') ? 'active' : '' }}">

                    <input type="radio"
                           name="tujuan"
                           value="jaga"
                           style="display:none;"
                           {{ ($targetDiet && $targetDiet->tujuan=='jaga') ? 'checked' : '' }}>

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>

                    Menjaga BB
                </label>

                <label class="tujuan-item {{ (!$targetDiet || $targetDiet->tujuan=='naik') ? 'active' : '' }}">

                    <input type="radio"
                           name="tujuan"
                           value="naik"
                           style="display:none;"
                           {{ (!$targetDiet || $targetDiet->tujuan=='naik') ? 'checked' : '' }}>

                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
                        <polyline points="17 6 23 6 23 12"/>
                    </svg>

                    Menambah BB
                </label>

            </div>

            <!-- TARGET MINGGUAN -->
            <div class="form-row" style="margin-top:12px;">

                <div class="input-group">
                    <label>Target Mingguan (kg/minggu)</label>

                    <input type="number"
                           name="target_mingguan"
                           step="0.1"
                           placeholder="0.5"
                           value="{{ $targetDiet ? $targetDiet->target_mingguan : '' }}"
                           {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}
                           required>
                </div>

            </div>

            <!-- BUTTON -->
            <button type="submit"
                    class="btn-save-target"
                    {{ $targetDiet && !$targetTercapai ? 'disabled' : '' }}>

                Simpan Target Diet
            </button>

        </form>

    </div>

</div>

@endsection