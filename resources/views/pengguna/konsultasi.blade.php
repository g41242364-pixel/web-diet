@extends('layouts.layout_pengguna')
@section('title', 'Konsultasi')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">

@section('content')

<div class="consul-container">

    <div class="consul-header">
        <div class="header-top">

            <div style="flex-shrink:0;">
                <svg width="60" height="60" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5">

                    <rect x="2" y="2" width="20" height="20"
                          rx="4" ry="4" stroke="#FBBC05"/>

                    <circle cx="9" cy="9" r="2" fill="#E2F0D9"/>
                    <circle cx="15" cy="15" r="2" fill="#F8CECC"/>
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

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    {{-- EMPTY --}}
    @if($consultations->count() == 0)

        <div class="empty-card">

            <svg width="64" height="64" viewBox="0 0 24 24"
                 fill="none" stroke="#90D2ED" stroke-width="1.5"
                 style="margin-bottom:16px;">

                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5
                         a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>

            <h3>Belum ada konsultasi</h3>

            <p>
                Lakukan skrining terlebih dahulu untuk memulai
                konsultasi dengan ahli gizi.
            </p>

            <a href="{{ route('skrining.langkah1') }}"
               class="btn-skrining">

                Mulai Skrining
            </a>

        </div>

    @else

        <div class="konsultasi-list">

            @foreach($consultations as $konsultasi)

            <div class="konsultasi-card">

                {{-- HEADER --}}
                <div class="konsultasi-header">

                    <div class="avatar-ahli">
                        {{ substr($konsultasi->ahliGizi->name, 0, 1) }}
                    </div>

                    <div class="info-ahli">
                        <h4>{{ $konsultasi->ahliGizi->name }}</h4>

                        <p>
                            Ahli Gizi ·
                            {{ $konsultasi->messages->count() }} pesan
                        </p>
                    </div>

                    <span class="status-konsultasi {{ $konsultasi->status }}">
                        {{ ucfirst($konsultasi->status) }}
                    </span>

                </div>

                {{-- PESAN TERAKHIR --}}
                @if($konsultasi->messages->last())

                <div class="last-message">

                    <div class="message-text">
                        {{ Str::limit($konsultasi->messages->last()->isi, 100) }}
                    </div>

                    <div class="message-time">
                        {{ $konsultasi->messages->last()->created_at->format('H:i') }}
                    </div>

                </div>

                @endif

                {{-- BUTTON --}}
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