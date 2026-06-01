@extends('layouts.layout_ahli_gizi')
@section('title', 'Dashboard Ahli Gizi')
<link rel="stylesheet" href="{{ asset('assets/css/ahli_gizi/dashboard.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="header-section">
    <h2>Dashboard Ahli Gizi</h2>
    <p>Pantau pasien, skrining, konsultasi, dan progres diet dalam satu halaman.</p>
</div>

    <section class="welcome-banner-gizi">
        <div class="banner-text-content">
            <h3>SELAMAT DATANG, {{ strtoupper(auth()->user()->name) }}</h3>
            <p>Pantau Pasien dan Konsultasi Hari ini</p>
            <form action="{{ route('ahligizi.toggleStatus') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" style="
    margin-top:15px;
    padding:12px 22px;
    border:none;
    border-radius:12px;
    font-size:14px;
    font-weight:700;
    cursor:pointer;
    background:{{ auth()->user()->is_online ? '#DC2626' : '#16A34A' }};
    color:#FFFFFF;
    box-shadow:0 4px 12px rgba(0,0,0,.1);
">
                    {{ auth()->user()->is_online ? '🔴 Set Offline' : '🟢 Set Online' }}
                </button>
            </form>
            <div style="
    margin-top:12px;
    display:inline-block;
    padding:8px 16px;
    border-radius:12px;
    font-size:13px;
    font-weight:600;
    background:{{ auth()->user()->is_online ? '#DCFCE7' : '#FEE2E2' }};
    color:{{ auth()->user()->is_online ? '#166534' : '#991B1B' }};
">
    {{ auth()->user()->is_online
        ? '🟢 Online - Tersedia untuk konsultasi'
        : '🔴 Offline - Tidak tersedia untuk konsultasi' }}
</div>
        </div>
        <div class="doctor-img-wrapper">
            <img src="{{ asset('assets/images/dokter.png') }}" alt="Dokter Ahli Gizi"
                onerror="this.src='https://img.freepik.com/free-photo/female-doctor-pointing-fruit-bowl_23-2148443834.jpg'">
        </div>
    </section>

    @if(session('success'))
        <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">✓ {{ session('success') }}</div>
    @endif

    <div class="gizi-stats-grid">
        <div class="gizi-stat-card">
            <div class="label-row">
                <span>Total Pasien</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="value">{{ $totalPasien }}</div>
        </div>
        <div class="gizi-stat-card">
            <div class="label-row">
                <span>Total Skrining</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div class="value">{{ $totalSkrining }}</div>
        </div>
        <div class="gizi-stat-card">
            <div class="label-row">
                <span>Konsultasi Aktif</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div class="value">{{ $konsultasiAktif }}</div>
        </div>
        <div class="gizi-stat-card">
            <div class="label-row">
                <span>Pasien Dipantau</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="3"/></svg>
            </div>
            <div class="value">{{ $progressDiet->count() }}</div>
        </div>
    </div>

    <div class="panel-card">
    <h4>📊 Progres Berat Badan Pasien</h4>
    <p class="panel-subtitle">
        Persentase kategori indeks massa tubuh pasien yang ditangani.
    </p>

        <div class="panel-card">
    <h4>🎯 Progres Target Diet Pasien</h4>
    <p class="panel-subtitle">
        Monitoring perkembangan pencapaian target berat badan pasien.
    </p>
                @forelse($progressDiet as $target)
                @php
                    $checkinTerbaru = $target->checkins->first();
                    $progress = 0;
                    if($target->berat_awal && $checkinTerbaru) {
                        $diff = abs($target->berat_awal - $target->berat_target);
                        $actual = abs($target->berat_awal - $checkinTerbaru->berat_sekarang);
                        $progress = $diff > 0 ? min(100, round(($actual/$diff)*100)) : 0;
                    }
                @endphp
                <div class="progress-item">
                    <div class="progress-label-row">
                        <span>{{ $target->user->name }}</span>
                        <span>{{ $progress }}%</span>
                    </div>
                    <div class="bar-bg">
                        <div class="bar-fill" style="width:{{ $progress }}%;"></div>
                    </div>
                </div>
                @empty
                <p style="color:#aaa;font-size:13px;text-align:center;padding:20px;">Belum ada data progress diet pasien.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('bmiGiziChart').getContext('2d');
new Chart(ctx, {
    type: 'pie',
    data: {
        labels: {!! json_encode($distribusiImt->keys()) !!},
        datasets: [{
            data: {!! json_encode($distribusiImt->values()) !!},
            backgroundColor: ['#6A5ACD','#FF6B6B','#4285F4','#FF9F40'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { position: 'right', labels: { usePointStyle: true, padding: 20 } } }
    }
});
</script>
@endpush
