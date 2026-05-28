@extends('layouts.layout_pengguna')
@section('title', 'Chat Konsultasi')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/chat-konsultasi.css') }}">

@section('content')

<div class="chat-container">

    {{-- BUTTON KEMBALI --}}
    <div class="back-area">
        <a href="{{ route('pengguna.konsultasi') }}" class="btn-back-chat">
            <span>←</span> Kembali
        </a>
    </div>

    {{-- CHAT BOX --}}
    <div class="chat-card">

        {{-- HEADER --}}
        <div class="chat-header">

            <div class="chat-user">

                <div class="chat-avatar">
                    {{ substr($consultation->ahliGizi->name,0,1) }}
                </div>

                <div class="chat-user-info">
                    <h3>{{ $consultation->ahliGizi->name }}</h3>

                    <p>
                        Ahli Gizi
                        <span class="dot-online"></span>
                        Online
                    </p>
                </div>

            </div>

            <div class="chat-status">
                Aktif
            </div>

        </div>

        {{-- BODY --}}
        <div class="chat-body">

            @foreach($consultation->messages as $message)

                @if($message->sender == 'pengguna')

                    <div class="message-wrapper user">

                        <div class="message-bubble user-bubble">
                            {!! nl2br(e($message->isi)) !!}
                        </div>

                        <span class="message-time">
                            {{ $message->created_at->format('d M Y H:i') }}
                        </span>

                    </div>

                @else

                    <div class="message-wrapper admin">

                        <div class="message-bubble admin-bubble">
                            {!! nl2br(e($message->isi)) !!}
                        </div>

                        <span class="message-time">
                            {{ $message->created_at->format('d M Y H:i') }}
                        </span>

                    </div>

                @endif

            @endforeach

        </div>

    </div>

</div>

@endsection