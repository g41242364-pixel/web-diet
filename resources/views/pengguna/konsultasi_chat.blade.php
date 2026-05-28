```blade
@extends('layouts.layout_pengguna')
@section('title', 'Chat Konsultasi')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">

<style>

.message-list{
    height:420px;
    overflow-y:auto;
    padding:18px;
    display:flex;
    flex-direction:column;
    gap:14px;
    background:#EFF6FF;
}

/* ===============================
   BACK BUTTON
================================= */

.back-header{
    margin-bottom:18px;
}

.btn-back-chat{
    display:inline-flex;
    align-items:center;
    gap:8px;

    background:#2563EB;
    color:#FFFFFF !important;

    padding:10px 18px;

    border-radius:999px;

    text-decoration:none;

    font-size:14px;
    font-weight:600;

    box-shadow:0 4px 10px rgba(37,99,235,0.25);

    transition:all .3s ease;
}

.btn-back-chat:hover{
    background:#1D4ED8;
    transform:translateY(-1px);
}

/* ===============================
   CHAT BUBBLE
================================= */

.bubble-user{
    align-self:flex-end;

    background:#2563EB;
    color:#FFFFFF;

    padding:12px 16px;

    border-radius:18px 18px 6px 18px;

    max-width:70%;

    font-size:14px;
    line-height:1.5;

    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.bubble-ahli{
    align-self:flex-start;

    background:#FFFFFF;
    color:#1E3A5F;

    border:1.5px solid #BFDBFE;

    padding:12px 16px;

    border-radius:18px 18px 18px 6px;

    max-width:70%;

    font-size:14px;
    line-height:1.5;

    box-shadow:0 3px 10px rgba(0,0,0,0.04);
}

.bubble-meta{
    font-size:11px;
    color:#94A3B8;
    margin-top:4px;
}

/* ===============================
   INPUT AREA
================================= */

.chat-input-area{
    display:flex;
    gap:10px;
    padding:16px;
    background:#FFFFFF;
    border-top:1.5px solid #BFDBFE;
}

.chat-input-area input{
    flex:1;

    padding:12px 16px;

    border:1.5px solid #BFDBFE;
    border-radius:24px;

    font-size:14px;

    outline:none;

    background:#EFF6FF;

    color:#0F172A;
}

.chat-input-area input:focus{
    border-color:#2563EB;
    box-shadow:0 0 0 4px rgba(37,99,235,0.12);
}

.chat-input-area button{
    border:none;
    cursor:pointer;
    transition:.3s ease;
}

/* SEND BUTTON */

.btn-send-chat{
    width:48px;
    height:48px;

    border-radius:50%;

    background:#2563EB;
    color:#FFFFFF;

    display:flex;
    align-items:center;
    justify-content:center;

    box-shadow:0 4px 10px rgba(37,99,235,0.25);
}

.btn-send-chat:hover{
    background:#1D4ED8;
}

/* REFRESH BUTTON */

.btn-refresh{
    padding:0 18px;

    border-radius:24px;

    background:#DBEAFE;
    color:#1E3A5F;

    font-size:13px;
    font-weight:600;
}

.btn-refresh:hover{
    background:#BFDBFE;
}

/* ===============================
   RESPONSIVE
================================= */

@media(max-width:768px){

    .bubble-user,
    .bubble-ahli{
        max-width:90%;
    }

    .chat-input-area{
        flex-wrap:wrap;
    }

    .btn-refresh{
        width:100%;
        height:46px;
    }
}

</style>

@section('content')

<div class="consul-container">

    <!-- BACK BUTTON -->

    <div class="consul-header back-header">

        <a href="{{ route('pengguna.konsultasi') }}"
           class="btn-back-chat">

            <svg width="18" height="18"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2">

                <path d="M15 18l-6-6 6-6"/>

            </svg>

            <span>Kembali</span>

        </a>

    </div>

    <!-- CHAT CONTAINER -->

    <div class="chat-container"
         style="
            border-radius:24px;
            overflow:hidden;
            border:1.5px solid #BFDBFE;
            background:#FFFFFF;
            box-shadow:0 6px 18px rgba(0,0,0,0.08);
         ">

        <!-- HEADER -->

        <div class="chat-header"
             style="
                background:#2563EB;
                padding:18px 20px;
                display:flex;
                align-items:center;
                gap:14px;
             ">

            <div style="
                width:46px;
                height:46px;
                border-radius:50%;
                background:#FFFFFF;
                display:flex;
                align-items:center;
                justify-content:center;
                font-weight:700;
                color:#2563EB;
                font-size:17px;
            ">
                {{ substr($consultation->ahliGizi->name, 0, 1) }}
            </div>

            <div>

                <div style="
                    font-weight:700;
                    color:#FFFFFF;
                    font-size:15px;
                ">
                    {{ $consultation->ahliGizi->name }}
                </div>

                <div style="
                    font-size:12px;
                    color:rgba(255,255,255,0.8);
                ">

                    Ahli Gizi ·

                    @if($consultation->ahliGizi->is_online)
                        <span style="color:#BBF7D0;">● Online</span>
                    @else
                        <span style="color:rgba(255,255,255,0.7);">● Offline</span>
                    @endif

                </div>

            </div>

            <span style="
                margin-left:auto;
                font-size:12px;
                padding:6px 14px;
                border-radius:20px;
                background:rgba(255,255,255,0.18);
                color:#FFFFFF;
                font-weight:600;
            ">
                {{ ucfirst($consultation->status) }}
            </span>

        </div>

        <!-- MESSAGE AREA -->

        <div class="message-list" id="messageList">

            @foreach($consultation->messages as $msg)

                @if($msg->user_id == auth()->id())

                    <div style="
                        align-self:flex-end;
                        display:flex;
                        flex-direction:column;
                        align-items:flex-end;
                    ">

                        <div class="bubble-user"
                             style="white-space:pre-line;">

                            {{ $msg->isi }}

                        </div>

                        <div class="bubble-meta">
                            {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </div>

                    </div>

                @else

                    <div style="
                        align-self:flex-start;
                        display:flex;
                        flex-direction:column;
                    ">

                        <div style="
                            font-size:11px;
                            color:#64748B;
                            margin-bottom:3px;
                            margin-left:4px;
                        ">
                            {{ $msg->sender->name }}
                        </div>

                        <div class="bubble-ahli"
                             style="white-space:pre-line;">

                            {{ $msg->isi }}

                        </div>

                        <div class="bubble-meta">
                            {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </div>

                    </div>

                @endif

            @endforeach

        </div>

        <!-- INPUT -->

        @if($consultation->status === 'aktif')

        <div class="chat-input-area">

            <form action="{{ route('pengguna.konsultasi.kirimPesan', $consultation->id) }}"
                  method="POST"
                  style="
                    display:flex;
                    gap:10px;
                    width:100%;
                  ">

                @csrf

                <input type="text"
                       name="isi"
                       placeholder="Tulis pesan..."
                       autocomplete="off"
                       required>

                <button type="submit"
                        class="btn-send-chat">

                    <svg width="20"
                         height="20"
                         viewBox="0 0 24 24"
                         fill="currentColor">

                        <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>

                    </svg>

                </button>

            </form>

            <form action=""
                  method="GET"
                  style="flex-shrink:0;">

                <button type="submit"
                        class="btn-refresh">

                    Refresh

                </button>

            </form>

        </div>

        @else

        <div style="
            padding:16px;
            text-align:center;
            background:#F8FAFC;
            color:#64748B;
            font-size:13px;
            border-top:1px solid #E2E8F0;
        ">
            Konsultasi telah selesai.
        </div>

        @endif

    </div>

</div>

<script>

    const ml = document.getElementById('messageList');

    if(ml){
        ml.scrollTop = ml.scrollHeight;
    }

</script>

@endsection
```
