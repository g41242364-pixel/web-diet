@extends('layouts.layout_admin')
@section('title', 'Admin - Daftar Pola Tidur')
<link rel="stylesheet" href="{{ asset('assets/css/admin/daftar_pola_tidur.css') }}">

@section('content')
<div class="admin-sleep-container">
    <h2 class="page-title">Daftar Pola Tidur Pengguna</h2>

    <div style="font-size:13px;color:#888;margin-bottom:12px;">Total: {{ $sleepLogs->total() }} catatan tidur</div>

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
                        <span style="font-size:11px;padding:3px 10px;border-radius:12px;
                            background:{{ $log->status_tidur=='Baik'?'#e8f8e8':($log->status_tidur=='Kurang'?'#fde8e8':'#fff3cd') }};
                            color:{{ $log->status_tidur=='Baik'?'#27ae60':($log->status_tidur=='Kurang'?'#c0392b':'#856404') }};">
                            {{ $log->status_tidur }}
                        </span>
                    </td>
                    <td>{{ $log->catatan ?? '-' }}</td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center;color:#aaa;padding:24px;">Belum ada data pola tidur.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $sleepLogs->links() }}</div>
    </div>
</div>
@endsection
