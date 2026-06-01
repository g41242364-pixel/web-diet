@extends('layouts.layout_admin')
@section('title', 'Target Diet - Admin')

<link rel="stylesheet" href="{{ asset('assets/css/admin/daftar_target_diet.css') }}">

@section('content')

<div class="page-title-section">
    <h2>Target Diet Pengguna</h2>
    <p>Pantau target diet seluruh pengguna yang terdaftar</p>
</div>

<div class="table-top">
    Total: {{ $targets->total() }} data target diet
</div>

<div class="target-grid">

    @forelse($targets as $target)

    @php
        $checkinTerbaru = $target->checkins->first();

        $progress = 0;

        if($target->berat_awal && $checkinTerbaru){
            $diff = abs($target->berat_awal - $target->berat_target);
            $actual = abs($target->berat_awal - $checkinTerbaru->berat_sekarang);

            $progress = $diff > 0
                ? min(100, round(($actual / $diff) * 100))
                : 0;
        }
    @endphp

    <div class="user-target-card">

        <div class="card-header-user">
            <h4>{{ $target->user->name }}</h4>
            <span>{{ $target->user->email }}</span>
        </div>

        <div class="card-content-inner">

            <div class="goal-tag">
                {{ ucfirst($target->tujuan) }} Berat Badan
            </div>

            <div class="target-stats">

                <div class="stat-item">
                    <span class="label">BB Awal</span>
                    <span class="value">
                        {{ $target->berat_awal ?? '-' }} kg
                    </span>
                </div>

                <div class="stat-item">
                    <span class="label">Target</span>
                    <span class="value">
                        {{ $target->berat_target }} kg
                    </span>
                </div>

                <div class="stat-item">
                    <span class="label">Per Minggu</span>
                    <span class="value">
                        {{ $target->target_mingguan }} kg
                    </span>
                </div>

                <div class="stat-item">
                    <span class="label">BB Sekarang</span>
                    <span class="value">
                        {{ $checkinTerbaru ? $checkinTerbaru->berat_sekarang.' kg' : '-' }}
                    </span>
                </div>

            </div>

            <div class="progress-container">

                <div class="progress-info">
                    <span>Progress Target</span>
                    <span>{{ $progress }}%</span>
                </div>

                <div class="progress-bar-rail">
                    <div
                        class="progress-bar-fill"
                        style="width: {{ $progress }}%;">
                    </div>
                </div>

                <div class="current-bb-text">
                    Dibuat:
                    {{ $target->created_at->format('d M Y') }}
                    •
                    Check-in:
                    {{ $target->checkins->count() }}x
                </div>

            </div>

        </div>

    </div>

    @empty

    <div class="empty-card">
        Belum ada data target diet.
    </div>

    @endforelse

</div>

<div class="pagination-wrapper">
    {{ $targets->links() }}
</div>

@endsection