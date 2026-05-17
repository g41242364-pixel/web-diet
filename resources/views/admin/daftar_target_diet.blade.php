@extends('layouts.layout_admin')
@section('title', 'Target Diet - Admin')
<link rel="stylesheet" href="{{ asset('assets/css/admin/daftar_target_diet.css') }}">

@section('content')
    <div style="display:flex;align-items:center;gap:16px;margin-bottom:20px;">
        <svg width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
        <div><h2 style="font-size:28px;font-weight:800;">Target Diet</h2><p style="color:#666;">Pantau target diet seluruh pengguna</p></div>
    </div>

    <div style="font-size:13px;color:#888;margin-bottom:12px;">Total: {{ $targets->total() }} data</div>

    <div style="display:grid;gap:12px;">
        @forelse($targets as $target)
        @php
            $checkinTerbaru = $target->checkins->first();
            $progress = 0;
            if($target->berat_awal && $checkinTerbaru) {
                $diff = abs($target->berat_awal - $target->berat_target);
                $actual = abs($target->berat_awal - $checkinTerbaru->berat_sekarang);
                $progress = $diff > 0 ? min(100, round(($actual / $diff) * 100)) : 0;
            }
        @endphp
        <div style="background:#fff;border-radius:12px;padding:16px;border:1.5px solid #e8f0f5;">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                <div style="width:40px;height:40px;border-radius:50%;background:#90D2ED;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;">{{ substr($target->user->name,0,1) }}</div>
                <div>
                    <div style="font-weight:600;font-size:14px;">{{ $target->user->name }}</div>
                    <div style="font-size:12px;color:#888;">{{ $target->user->email }}</div>
                </div>
                <span style="margin-left:auto;font-size:12px;padding:3px 10px;border-radius:12px;background:#e8f4fd;color:#2980b9;">{{ ucfirst($target->tujuan) }} BB</span>
            </div>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-bottom:12px;">
                <div style="text-align:center;"><div style="font-size:11px;color:#888;">BB Awal</div><div style="font-weight:600;">{{ $target->berat_awal ?? '-' }} kg</div></div>
                <div style="text-align:center;"><div style="font-size:11px;color:#888;">Target</div><div style="font-weight:600;">{{ $target->berat_target }} kg</div></div>
                <div style="text-align:center;"><div style="font-size:11px;color:#888;">Per Minggu</div><div style="font-weight:600;">{{ $target->target_mingguan }} kg</div></div>
                <div style="text-align:center;"><div style="font-size:11px;color:#888;">BB Sekarang</div><div style="font-weight:600;">{{ $checkinTerbaru ? $checkinTerbaru->berat_sekarang.' kg' : '-' }}</div></div>
            </div>
            <div style="margin-bottom:4px;display:flex;justify-content:space-between;font-size:12px;"><span>Progres</span><span>{{ $progress }}%</span></div>
            <div style="background:#e8f0f5;border-radius:20px;height:8px;overflow:hidden;">
                <div style="background:#90D2ED;height:100%;width:{{ $progress }}%;border-radius:20px;"></div>
            </div>
            <div style="font-size:11px;color:#aaa;margin-top:6px;">Dibuat: {{ $target->created_at->format('d M Y') }} · Check-in: {{ $target->checkins->count() }}x</div>
        </div>
        @empty
        <div style="text-align:center;padding:40px;color:#aaa;">Belum ada data target diet.</div>
        @endforelse
    </div>
    <div style="margin-top:16px;">{{ $targets->links() }}</div>
@endsection
