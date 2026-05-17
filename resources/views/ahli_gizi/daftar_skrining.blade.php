@extends('layouts.layout_ahli_gizi')
@section('title', 'Skrining Pasien')
<link rel="stylesheet" href="{{ asset('assets/css/ahli_gizi/daftar_skrining.css') }}">

@section('content')
    <div class="skrining-header">
        <div class="icon-wrapper">
            <svg width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                <path d="M9 12h6"></path><path d="M9 16h6"></path><path d="M9 8h6"></path>
            </svg>
        </div>
        <h2>Skrining Pasien</h2>
    </div>

    <div class="table-container">
        <div style="margin-bottom:12px;font-size:13px;color:#888;">
            Total: {{ $screenings->total() }} data skrining pasien Anda
        </div>
        <table class="skrining-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>BB (kg)</th>
                    <th>TB (cm)</th>
                    <th>IMT</th>
                    <th>Status IMT</th>
                    <th>Status Kebiasaan</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($screenings as $i => $s)
                <tr>
                    <td>{{ $screenings->firstItem() + $i }}</td>
                    <td>{{ $s->user->name }}</td>
                    <td>{{ $s->berat_badan }}</td>
                    <td>{{ $s->tinggi_badan }}</td>
                    <td>{{ $s->imt }}</td>
                    <td>
                        <span style="font-size:11px;padding:3px 10px;border-radius:12px;
                            background:{{ $s->status_imt=='Normal'?'#e8f8e8':($s->status_imt=='Kurus'?'#fff3cd':($s->status_imt=='Gemuk'?'#fde8e8':'#f8d7da')) }};
                            color:{{ $s->status_imt=='Normal'?'#27ae60':($s->status_imt=='Kurus'?'#856404':($s->status_imt=='Gemuk'?'#c0392b':'#721c24')) }};">
                            {{ $s->status_imt }}
                        </span>
                    </td>
                    <td>{{ $s->status_kebiasaan }}</td>
                    <td>{{ $s->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center;color:#aaa;padding:24px;">Belum ada data skrining dari pasien Anda.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $screenings->links() }}</div>
    </div>
@endsection
