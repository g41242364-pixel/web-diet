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
        <img src="{{ asset('assets/images/logo_admin.png') }}"
             alt="Logo Admin"
             onerror="this.src='https://cdn-icons-png.flaticon.com/512/2206/2206368.png'">
    </div>
</section>

<div class="admin-stats-grid">

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Pengguna</span>
            <span class="number">{{ $totalPengguna }}</span>
        </div>

        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
            </svg>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Ahli Gizi</span>
            <span class="number">{{ $totalAhliGizi }}</span>
        </div>

        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4.5 12.5c0 0 1 0 2 2s3 6 3 6 4-13 10-13"/>
            </svg>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Skrining</span>
            <span class="number">{{ $totalSkrining }}</span>
        </div>

        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="4" width="18" height="18" rx="2"/>
            </svg>
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Konsultasi</span>
            <span class="number">{{ $totalKonsultasi }}</span>
        </div>

        <div class="stat-icon">
            <svg width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>
        </div>
    </div>

</div>

<div class="chart-grid">

    <div class="chart-card">

        <h4>📊 Distribusi Pengguna Berdasarkan IMT</h4>

        <p class="chart-subtitle">
            Persentase kategori indeks massa tubuh pengguna SISD
        </p>

        <div class="chart-wrapper">

            <div class="chart-left">
                <canvas id="bmiChart"></canvas>
            </div>

            <div class="chart-right">

                <h5>Kategori IMT</h5>

                @foreach($distribusiImt as $kategori => $jumlah)

                    @php
                        $class = '';

                        if(stripos($kategori,'kurus') !== false)
                            $class = 'kurus';

                        elseif(stripos($kategori,'normal') !== false)
                            $class = 'normal';

                        elseif(stripos($kategori,'gemuk') !== false)
                            $class = 'gemuk';

                        else
                            $class = 'obesitas';
                    @endphp

                    <div class="legend-item">
                        <span class="legend-color {{ $class }}"></span>
                        <span>{{ $kategori }} ({{ $jumlah }})</span>
                    </div>

                @endforeach

            </div>

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

            backgroundColor: [
                '#90D2ED',
                '#2FA4D8',
                '#72C4E6',
                '#B7E4F7'
            ],

            borderWidth:0
        }]
    },

    options:{

        responsive:true,
        maintainAspectRatio:false,
        cutout:'60%',

        plugins:{
            legend:{
                display:false
            }
        }

    }

});

</script>
@endpush