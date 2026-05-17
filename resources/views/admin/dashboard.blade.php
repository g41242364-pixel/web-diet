@extends('layouts.layout_admin')
@section('title', 'Admin Dashboard')
<link rel="stylesheet" href="{{ asset('assets/css/admin/dashboard.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')
    <div class="admin-header">
        <h2>Dashboard SISD</h2>
        <p>Sistem Informasi Skrining Diet</p>
    </div>

    <section class="admin-welcome-banner">
        <div class="banner-info">
            <h3>SELAMAT DATANG, ADMIN</h3>
            <p>Pantau data pengguna dan skrining hari ini</p>
        </div>
        <div class="admin-logo-wrapper">
            <img src="{{ asset('assets/images/logo_admin.png') }}" alt="Logo Admin" onerror="this.src='https://cdn-icons-png.flaticon.com/512/2206/2206368.png'">
        </div>
    </section>

    <div class="admin-stats-grid">
        <div class="stat-box">
            <div class="stat-info"><span class="label">Total Pengguna</span><span class="number">{{ $totalPengguna }}</span></div>
            <div class="stat-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
        </div>
        <div class="stat-box">
            <div class="stat-info"><span class="label">Total Ahli Gizi</span><span class="number">{{ $totalAhliGizi }}</span></div>
            <div class="stat-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 12.5c0 0 1 0 2 2s3 6 3 6 4-13 10-13"/></svg></div>
        </div>
        <div class="stat-box">
            <div class="stat-info"><span class="label">Total Skrining</span><span class="number">{{ $totalSkrining }}</span></div>
            <div class="stat-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div>
        </div>
        <div class="stat-box">
            <div class="stat-info"><span class="label">Total Konsultasi</span><span class="number">{{ $totalKonsultasi }}</span></div>
            <div class="stat-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        </div>
    </div>

    <div class="chart-grid">
        <div class="chart-card">
            <h4>Distribusi IMT Pengguna</h4>
            <div class="chart-content">
                <canvas id="bmiChart"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
const ctx = document.getElementById('bmiChart').getContext('2d');
new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($distribusiImt->keys()) !!},
        datasets: [{
            data: {!! json_encode($distribusiImt->values()) !!},
            backgroundColor: ['#f39c12','#27ae60','#e74c3c','#8e44ad'],
        }]
    },
    options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
});
</script>
@endpush
