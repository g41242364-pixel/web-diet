@extends('layouts.layout_pengguna')
@section('title', 'Konsultasi')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">

@section('content')
<div class="consul-container">

    <div class="consul-header">
        <div class="header-top">

            <div style="flex-shrink:0;">
                <svg width="60" height="60" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="2" y="2" width="20" height="20"
                          rx="4" ry="4" stroke="#2563EB"/>
                    <circle cx="9" cy="9" r="2" fill="#DBEAFE"/>
                    <circle cx="15" cy="15" r="2" fill="#BFDBFE"/>
                </svg>
            </div>

            <div>
                <h2>Konsultasi</h2>
                <p>
                    Tanya langsung ke ahli gizi.
                    Lampirkan hasil skrining untuk saran yang lebih personal.
                </p>
            </div>

        </div>
    </div>

    @if(session('success'))
        <div style="
            background:#DCFCE7;
            color:#15803D;
            padding:12px 16px;
            border-radius:14px;
            margin-bottom:16px;
            font-size:14px;
            font-weight:600;
        ">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="
            background:#FEE2E2;
            color:#B91C1C;
            padding:12px 16px;
            border-radius:14px;
            margin-bottom:16px;
            font-size:14px;
            font-weight:600;
        ">
            {{ session('error') }}
        </div>
    @endif

    @if($consultations->count() == 0)

        <div class="empty-consultation">

            <svg width="70" height="70" viewBox="0 0 24 24"
                 fill="none" stroke="#2563EB" stroke-width="1.5"
                 style="margin-bottom:18px;">

                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5
                         a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>

            <h3>Belum Ada Konsultasi</h3>

            <p>
                Lakukan skrining terlebih dahulu untuk memulai
                konsultasi dengan ahli gizi.
            </p>

            <a href="{{ route('skrining.langkah1') }}"
               class="btn-start">

                Mulai Skrining

            </a>

        </div>

    @else

        <div class="chat-list">

            @foreach($consultations as $konsultasi)

                <div class="chat-card">

                    <div class="chat-card-top">

                        <div class="avatar-chat">
                            {{ substr($konsultasi->ahliGizi->name, 0, 1) }}
                        </div>

                        <div class="chat-user-info">

                            <h4>
                                {{ $konsultasi->ahliGizi->name }}
                            </h4>

                            <p>
                                Ahli Gizi ·
                                {{ $konsultasi->messages->count() }} pesan
                            </p>

                        </div>

                        <span class="status-chat {{ $konsultasi->status === 'aktif' ? 'active' : 'closed' }}">
                            {{ ucfirst($konsultasi->status) }}
                        </span>

                    </div>

                    @if($konsultasi->messages->last())

                        <div class="last-message">

                            <p>
                                {{ Str::limit($konsultasi->messages->last()->isi, 100) }}
                            </p>

                            <span>
                                {{ $konsultasi->messages->last()->created_at->format('H:i') }}
                            </span>

                        </div>

                    @endif

                    <a href="{{ route('pengguna.konsultasi.chat', $konsultasi->id) }}"
                       class="btn-chat">

                        Buka Chat →

                    </a>

                </div>

            @endforeach

        </div>

    @endif

</div>
@endsection