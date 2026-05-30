@extends('layouts.layout_pengguna')
@section('title', 'Chat Konsultasi')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">

<style>
.message-list{
    height:420px;
    overflow-y:auto;
    padding:16px;
    display:flex;
    flex-direction:column;
    gap:12px;
}

.bubble-user{
    align-self:flex-end;
    background:#E2F0D2;
    color:#000;
    padding:10px 14px;
    border-radius:16px 16px 4px 16px;
    max-width:70%;
    font-size:14px;
}

.bubble-ahli{
    align-self:flex-start;
    background:#FFFFFF;
    color:#1E3A5F;
    padding:10px 14px;
    border-radius:16px 16px 16px 4px;
    max-width:70%;
    font-size:14px;
    border:1.5px solid #BFDBFE;
}

.bubble-meta{
    font-size:11px;
    color:#94A3B8;
    margin-top:3px;
}

.chat-input-area{
    display:flex;
    gap:10px;
    padding:14px 16px;
    background:transparent;
}
</style>

@section('content')

<div class="consul-container">

    {{-- TOMBOL KEMBALI TANPA CARD PUTIH --}}
    <a href="{{ route('pengguna.konsultasi') }}"
       class="btn-back-chat"
       style="margin-bottom:16px;display:inline-flex;">
        ← Kembali
    </a>

    <div class="chat-wrapper">

        <div class="chat-header">

            <div class="chat-header-avatar">
                {{ substr($consultation->ahliGizi->name, 0, 1) }}
            </div>

            <div class="chat-header-info">
                <h3>{{ $consultation->ahliGizi->name }}</h3>

                <p>
                    Ahli Gizi ·
                    @if($consultation->ahliGizi->is_online)
                        <span style="color:#22C55E;">● Online</span>
                    @else
                        <span>● Offline</span>
                    @endif
                </p>
            </div>

            <span class="status-chat active" style="margin-left:auto;">
                {{ ucfirst($consultation->status) }}
            </span>

        </div>

        <div class="message-list" id="messageList">

            @foreach($consultation->messages as $msg)

                @if($msg->user_id == auth()->id())

                    <div style="align-self:flex-end;display:flex;flex-direction:column;align-items:flex-end;">

                        <div class="bubble-user" style="white-space:pre-line;">
                            {{ $msg->isi }}
                        </div>

                        <div class="bubble-meta">
                            {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </div>

                    </div>

                @else

                    <div style="align-self:flex-start;display:flex;flex-direction:column;">

                        <div style="font-size:11px;color:#64748B;margin-bottom:2px;">
                            {{ $msg->sender->name }}
                        </div>

                        <div class="bubble-ahli" style="white-space:pre-line;">
                            {{ $msg->isi }}
                        </div>

                        <div class="bubble-meta">
                            {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </div>

                    </div>

                @endif

            @endforeach

        </div>

        @if($consultation->status === 'aktif')

            <div class="chat-input-area">

                <form action="{{ route('pengguna.konsultasi.kirimPesan', $consultation->id) }}"
                      method="POST"
                      style="display:flex;gap:10px;width:100%;">

                    @csrf

                    <input
                        type="text"
                        name="isi"
                        placeholder="Tulis pesan..."
                        autocomplete="off"
                        required
                        style="
                            flex:1;
                            padding:12px 16px;
                            background:#FFFFFF;
                            border:1.5px solid #BFDBFE;
                            border-radius:24px;
                            font-size:14px;
                        "
                    >

                    <button
                        type="submit"
                        class="btn-send"
                        style="width:50px;height:50px;border-radius:50%;">

                        <svg width="20"
                             height="20"
                             viewBox="0 0 24 24"
                             fill="currentColor">

                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>

                        </svg>

                    </button>

                </form>

            </div>

        @else

            <div style="
                padding:14px;
                text-align:center;
                color:#64748B;
                font-size:13px;
            ">
                Konsultasi telah selesai.
            </div>

        @endif

    </div>

</div>

<script>
const ml = document.getElementById('messageList');
if (ml) {
    ml.scrollTop = ml.scrollHeight;
}
</script>

@endsection