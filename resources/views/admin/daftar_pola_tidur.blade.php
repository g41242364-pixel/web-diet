@extends('layouts.layout_admin')
@section('title', 'Admin - Daftar Pola Tidur')

<link rel="stylesheet" href="{{ asset('assets/css/admin/daftar_pola_tidur.css') }}">

@section('content')

<div class="page-title-section">
    <h2>Daftar Pola Tidur Pengguna</h2>
    <p>Kelola dan pantau seluruh data pola tidur pengguna yang tercatat pada sistem.</p>
</div>

<div class="table-top">
    Total Catatan Tidur: {{ $sleepLogs->total() }}
</div>

<div class="table-container">

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pengguna</th>
                <th>Tanggal</th>
                <th>Jam Tidur</th>
                <th>Jam Bangun</th>
                <th>Durasi</th>
                <th>Status</th>
                <th>Catatan</th>
            </tr>
        </thead>

        <tbody>

            @forelse($sleepLogs as $i => $log)

            <tr>
                <td>{{ $sleepLogs->firstItem() + $i }}</td>
                <td>{{ $log->user->name }}</td>
                <td>{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $log->jam_tidur }}</td>
                <td>{{ $log->jam_bangun }}</td>
                <td>{{ $log->durasi_jam }} jam</td>

                <td>
                    <span
                        style="
                        font-size:12px;
                        padding:6px 12px;
                        border-radius:999px;
                        font-weight:600;
                        background:{{ $log->status_tidur=='Baik' ? '#DBEAFE' : ($log->status_tidur=='Kurang' ? '#FEE2E2' : '#FEF3C7') }};
                        color:{{ $log->status_tidur=='Baik' ? '#2563EB' : ($log->status_tidur=='Kurang' ? '#DC2626' : '#D97706') }};
                    ">
                        {{ $log->status_tidur }}
                    </span>
                </td>

                <td>{{ $log->catatan ?? '-' }}</td>
            </tr>

            @empty

            <tr>
                <td colspan="8" class="empty-data">
                    Belum ada data pola tidur.
                </td>
            </tr>

            @endforelse

        </tbody>
    </table>

</div>

<div class="pagination-wrapper">
    {{ $sleepLogs->links() }}
</div>

@endsection