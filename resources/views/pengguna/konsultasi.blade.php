@extends('layouts.layout_pengguna')
@section('title', 'Konsultasi')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">

@section('content')
<div class="consul-container">
    <div class="consul-header">
        <div class="header-top">
            <div style="flex-shrink:0;">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20" rx="4" ry="4" stroke="#FBBC05"/>
                    <circle cx="9" cy="9" r="2" fill="#E2F0D9"/><circle cx="15" cy="15" r="2" fill="#F8CECC"/>
                </svg>
            </div>
            <div>
                <h2>Konsultasi</h2>
                <p>Tanya langsung ke ahli gizi. Lampirkan hasil skrining untuk saran yang lebih personal.</p>
            </div>
        </div>
    </div>

    @if(session('success'))<div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">✓ {{ session('success') }}</div>@endif
    @if(session('error'))<div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">{{ session('error') }}</div>@endif

    @if($consultations->count() == 0)
    <div style="text-align:center;padding:40px;background:#fff;border-radius:12px;">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#90D2ED" stroke-width="1.5" style="margin-bottom:16px;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <h3 style="color:#2c3e50;margin-bottom:8px;">Belum ada konsultasi</h3>
        <p style="color:#888;margin-bottom:20px;">Lakukan skrining terlebih dahulu untuk memulai konsultasi dengan ahli gizi.</p>
        <a href="{{ route('skrining.langkah1') }}" style="display:inline-block;padding:10px 24px;background:#90D2ED;color:#fff;border-radius:8px;text-decoration:none;font-weight:600;">Mulai Skrining</a>
    </div>
    @else
    <div style="display:grid;gap:12px;">
        @foreach($consultations as $konsultasi)
        <div style="background:#fff;border-radius:12px;padding:16px;border:1.5px solid #e8f0f5;">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:10px;">
                <div style="width:44px;height:44px;border-radius:50%;background:#90D2ED;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:18px;flex-shrink:0;">
                    {{ substr($konsultasi->ahliGizi->name, 0, 1) }}
                </div>
                <div style="flex:1;">
                    <div style="font-weight:600;font-size:14px;">{{ $konsultasi->ahliGizi->name }}</div>
                    <div style="font-size:12px;color:#888;">Ahli Gizi · {{ $konsultasi->messages->count() }} pesan</div>
                </div>
                <span style="font-size:11px;padding:3px 10px;border-radius:12px;background:{{ $konsultasi->status==='aktif'?'#e8f8e8':'#f0f0f0' }};color:{{ $konsultasi->status==='aktif'?'#27ae60':'#888' }};">
                    {{ ucfirst($konsultasi->status) }}
                </span>
            </div>
            @if($konsultasi->messages->last())
            <div style="font-size:13px;color:#666;background:#f5f5f5;border-radius:8px;padding:8px 12px;margin-bottom:10px;">
                {{ Str::limit($konsultasi->messages->last()->isi, 100) }}
                <span style="font-size:11px;color:#aaa;float:right;">{{ $konsultasi->messages->last()->created_at->format('H:i') }}</span>
            </div>
            @endif
            <a href="{{ route('pengguna.konsultasi.chat', $konsultasi->id) }}" class="btn-buka-chat">
    Buka Chat →
</a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
