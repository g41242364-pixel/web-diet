@extends('layouts.layout_pengguna')
@section('title', 'Konsultasi')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">

@section('content')

<div class="consul-container">

    <div class="consul-header">
        <div class="header-top">

            <div class="header-icon">
                <svg width="52" height="52" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.7">
                    <rect x="2" y="2" width="20" height="20"
                          rx="4" ry="4" stroke="#2563EB"/>
                    <circle cx="9" cy="9" r="2" fill="#DBEAFE"/>
                    <circle cx="15" cy="15" r="2" fill="#BFDBFE"/>
                </svg>
            </div>

            <div class="header-text">
                <h2>Konsultasi</h2>
                <p>
                    Tanya langsung ke ahli gizi dan diskusikan hasil skrining
                    untuk mendapatkan saran yang lebih personal.
                </p>
            </div>

        </div>
    </div>

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

    @if($consultations->count() == 0)

        <div class="empty-card">

            <svg width="70" height="70" viewBox="0 0 24 24"
                 fill="none" stroke="#2563EB" stroke-width="1.6">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5
                         a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
            </svg>

            <h3>Belum Ada Konsultasi</h3>

            <p>
                Lakukan skrining terlebih dahulu untuk memulai
                konsultasi dengan ahli gizi.
            </p>

            <a href="{{ route('skrining.langkah1') }}"
               class="btn-mulai">
                Mulai Skrining
            </a>

        </div>

    @else

        <div class="konsultasi-list">

            @foreach($consultations as $konsultasi)

                <div class="konsultasi-card">

                    <div class="card-top">

                        <div class="avatar-ahli">
                            {{ substr($konsultasi->ahliGizi->name, 0, 1) }}
                        </div>

                        <div class="card-info">
                            <h4>{{ $konsultasi->ahliGizi->name }}</h4>

                            <span>
                                Ahli Gizi ·
                                {{ $konsultasi->messages->count() }} pesan
                            </span>
                        </div>

                        <div class="status-konsultasi
                            {{ $konsultasi->status === 'aktif'
                                ? 'aktif'
                                : 'selesai' }}">
                            {{ ucfirst($konsultasi->status) }}
                        </div>

                    </div>

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

                    <div class="card-action">

                        <a href="{{ route('pengguna.konsultasi.chat', $konsultasi->id) }}"
                           class="btn-chat">

                            <svg width="16" height="16" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor"
                                 stroke-width="2">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5
                                         a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                            </svg>

                            Buka Chat

                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    @endif

</div>

@endsection