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
            👤
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Ahli Gizi</span>
            <span class="number">{{ $totalAhliGizi }}</span>
        </div>

        <div class="stat-icon">
            🩺
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Skrining</span>
            <span class="number">{{ $totalSkrining }}</span>
        </div>

        <div class="stat-icon">
            📋
        </div>
    </div>

    <div class="stat-box">
        <div class="stat-info">
            <span class="label">Total Konsultasi</span>
            <span class="number">{{ $totalKonsultasi }}</span>
        </div>

        <div class="stat-icon">
            💬
        </div>
    </div>

</div>

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

                    $class = 'obesitas';

                    if(stripos($kategori,'underweight') !== false){
                        $class = 'underweight';
                    }
                    elseif(stripos($kategori,'normal') !== false){
                        $class = 'normal';
                    }
                    elseif(stripos($kategori,'overweight') !== false){
                        $class = 'overweight';
                    }

                @endphp

                <div class="legend-item">
                    <span class="legend-color {{ $class }}"></span>
                    <span>{{ $kategori }} ({{ $jumlah }})</span>
                </div>

            @endforeach

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function(){

    const canvas = document.getElementById('bmiChart');

    if(!canvas) return;

    new Chart(canvas, {

        type: 'doughnut',

        data: {

            labels: {!! json_encode($distribusiImt->keys()) !!},

            datasets: [{

                data: {!! json_encode($distribusiImt->values()) !!},

                backgroundColor: [
                    '#FBBF24',
                    '#22C55E',
                    '#F97316',
                    '#EF4444'
                ],

                borderWidth: 4,
                borderColor: '#FFFFFF'

            }]
        },

        options: {

            responsive: true,
            maintainAspectRatio: false,

            cutout: '65%',

            plugins: {
                legend: {
                    display: false
                }
            }

        }

    });

});

</script>
@endpush