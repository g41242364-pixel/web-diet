@extends('layouts.layout_ahli_gizi')
@section('title', 'Konsultasi Ahli Gizi')

<style>
    :root{
    --primary: #2563EB;
    --primary-light: #DBEAFE;
    --primary-soft: #EFF6FF;

    --bg-page: #F8FAFC;
    --bg-card: #FFFFFF;

    --border: #E2E8F0;

    --text-dark: #1E293B;
    --text-muted: #64748B;

    --success-soft: #DCFCE7;
    --success-border: #BBF7D0;

    --danger: #EF4444;
    --danger-dark: #DC2626;
}

    .consul-layout{
    display:grid;
    grid-template-columns:340px 1fr;
    height:calc(100vh - 60px);
    background:var(--bg-card);
    border-radius:20px;
    overflow:hidden;
    border:1px solid var(--border);
    box-shadow:0 10px 30px rgba(15,23,42,.08);
}

.consul-sidebar{
    background:var(--bg-card);
    border-right:1px solid var(--border);
    display:flex;
    flex-direction:column;
}

.consul-chat{
    background:var(--bg-page);
    display:flex;
    flex-direction:column;
}

.sidebar-header1{
    padding:18px;
    background:var(--bg-card);
    border-bottom:1px solid var(--border);
}

.search-box{
    width:100%;
    padding:12px 14px;
    border-radius:12px;
    border:1px solid var(--border);
    background:#fff;
    color:var(--text-dark);
    font-size:14px;
    transition:.2s;
}

.search-box:focus{
    border-color:var(--primary);
    box-shadow:0 0 0 4px rgba(37,99,235,.12);
}

.chat-user{
    padding:16px;
    display:flex;
    gap:12px;
    text-decoration:none;
    border-bottom:1px solid #F1F5F9;
    background:#fff;
    transition:.2s;
}

.chat-user:hover{
    background:var(--primary-soft);
}

.chat-user.active{
    background:var(--primary-light);
}

.avatar{
    width:48px;
    height:48px;
    border-radius:50%;
    background:var(--primary);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    flex-shrink:0;
}

.chat-name{
    font-size:14px;
    font-weight:600;
    color:var(--text-dark);
}

.chat-last{
    font-size:12px;
    color:var(--text-muted);
}

.chat-time{
    font-size:11px;
    color:var(--text-muted);
}

.chat-header{
    padding:16px 20px;
    background:#fff;
    border-bottom:1px solid var(--border);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.chat-header-name{
    font-size:15px;
    font-weight:700;
    color:var(--text-dark);
}

.chat-header-status{
    font-size:12px;
    color:var(--text-muted);
}

.finish-btn{
    padding:8px 14px;
    border:none;
    border-radius:10px;
    background:#22C55E;
    color:#fff;
    font-size:12px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.finish-btn:hover{
    background:#16A34A;
}

.delete-btn{
    padding:8px 14px;
    border:none;
    border-radius:10px;
    background:var(--danger);
    color:#fff;
    font-size:12px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.delete-btn:hover{
    background:var(--danger-dark);
}

.message-list{
    position:absolute;
    inset:0;
    overflow-y:auto;
    padding:24px;
    display:flex;
    flex-direction:column;
    gap:16px;
    background:var(--bg-page);
}

.sender-name{
    font-size:12px;
    color:var(--text-muted);
    margin-bottom:5px;
}

.bubble-ahli{
    background:var(--primary);
    color:#fff;
    padding:12px 16px;
    border-radius:18px 18px 4px 18px;
    max-width:70%;
    line-height:1.6;
    font-size:14px;
    box-shadow:0 4px 12px rgba(37,99,235,.18);
}

.bubble-user{
    background:#fff;
    color:var(--text-dark);
    padding:12px 16px;
    border-radius:18px 18px 18px 4px;
    max-width:70%;
    border:1px solid var(--border);
    line-height:1.6;
    font-size:14px;
    box-shadow:0 2px 8px rgba(15,23,42,.05);
}

.bubble-meta{
    font-size:11px;
    color:#94A3B8;
    margin-top:5px;
}

.chat-input{
    padding:16px;
    background:#fff;
    border-top:1px solid var(--border);
}

.chat-form{
    display:flex;
    gap:10px;
    align-items:center;
}

.chat-form input{
    flex:1;
    padding:13px 16px;
    border-radius:14px;
    border:1px solid var(--border);
    background:#fff;
    color:var(--text-dark);
    font-size:14px;
    outline:none;
}

.chat-form input:focus{
    border-color:var(--primary);
}

.send-btn{
    width:48px;
    height:48px;
    border:none;
    border-radius:14px;
    background:var(--primary);
    color:#fff;
    font-size:18px;
    cursor:pointer;
}

.refresh-btn{
    height:48px;
    padding:0 16px;
    border-radius:14px;
    background:var(--primary-light);
    color:var(--primary);
    text-decoration:none;
    font-weight:600;
    display:flex;
    align-items:center;
}

.empty-chat{
    flex:1;
    display:flex;
    align-items:center;
    justify-content:center;
    color:var(--text-muted);
    background:var(--bg-page);
    font-size:15px;
}

.sidebar-list::-webkit-scrollbar,
.message-list::-webkit-scrollbar{
    width:8px;
}

.sidebar-list::-webkit-scrollbar-thumb,
.message-list::-webkit-scrollbar-thumb{
    background:#CBD5E1;
    border-radius:20px;
}

    .sidebar-list::-webkit-scrollbar-track,
    .message-list::-webkit-scrollbar-track {
        background: transparent;
    }
</style>

@section('content')

    <div class="consul-layout">

        <div class="consul-sidebar">

            <div class="sidebar-header1">
                <form method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pengguna..."
                        class="search-box">
                </form>
            </div>

            <div class="sidebar-list">

                @foreach ($consultations as $konsultasi)
                    <a href="{{ route('ahligizi.konsultasi.chat', $konsultasi->id) }}"
                        class="chat-user {{ request('chat') == $konsultasi->id ? 'active' : '' }}">

                        <div class="avatar">
                            {{ substr($konsultasi->user->name, 0, 1) }}
                        </div>

                        <div class="chat-content">

                            <div style="display:flex;justify-content:space-between;gap:10px;">
                                <div class="chat-name">
                                    {{ $konsultasi->user->name }}
                                </div>

                                @if ($konsultasi->messages->last())
                                    <div class="chat-time">
                                        {{ $konsultasi->messages->last()->created_at->timezone('Asia/Jakarta')->format('H:i') }}
                                    </div>
                                @endif
                            </div>

                            <div class="chat-last">
                                @if ($konsultasi->messages->last())
                                    {{ Str::limit($konsultasi->messages->last()->isi, 40) }}
                                @endif
                            </div>

                        </div>

                    </a>
                @endforeach

            </div>

        </div>

        <div class="consul-chat">

            @if ($activeConsultation)

                <div class="chat-header">

                    <div class="chat-header-left">

                        <div class="avatar">
                            {{ substr($activeConsultation->user->name, 0, 1) }}
                        </div>

                        <div>
                            <div class="chat-header-name">
                                {{ $activeConsultation->user->name }}
                            </div>

                            <div class="chat-header-status">
                                @if ($activeConsultation->screening)
                                    IMT {{ $activeConsultation->screening->imt }}
                                    ({{ $activeConsultation->screening->status_imt }})
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="header-action">

                        @if ($activeConsultation->status === 'aktif')
                            <form action="{{ route('ahligizi.konsultasi.selesaikan', $activeConsultation->id) }}"
                                method="POST"
                                onsubmit="return confirm('Selesaikan konsultasi ini?')">

                                @csrf

                                <button type="submit" class="finish-btn">
                                    Selesaikan Chat
                                </button>

                            </form>
                        @endif

                        <form action="{{ route('ahligizi.konsultasi.hapus', $activeConsultation->id) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus chat ini? Semua pesan akan ikut terhapus.')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete-btn">
                                Hapus Chat
                            </button>

                        </form>

                    </div>

                </div>

                <div class="message-wrapper">

                    <div class="message-list" id="messageList">

                        @foreach ($activeConsultation->messages as $msg)
                            @if ($msg->user_id == auth()->id())
                                <div class="message-item-right">

                                    <div class="bubble-ahli">
                                        {{ $msg->isi }}
                                    </div>

                                    <div class="bubble-meta">
                                        {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </div>

                                </div>
                            @else
                                <div class="message-item-left">

                                    <div class="sender-name">
                                        {{ $msg->sender->name }}
                                    </div>

                                    <div class="bubble-user">
                                        {{ $msg->isi }}
                                    </div>

                                    <div class="bubble-meta">
                                        {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </div>

                                </div>
                            @endif
                        @endforeach

                    </div>

                </div>

                @if ($activeConsultation->status === 'aktif')
                    <div class="chat-input">

                        <form action="{{ route('ahligizi.konsultasi.balas', $activeConsultation->id) }}" method="POST"
                            class="chat-form">

                            @csrf

                            <input type="text" name="isi" placeholder="Tulis balasan..." required autocomplete="off">

                            <button type="submit" class="send-btn">
                                ➤
                            </button>

                            <a href="{{ route('ahligizi.konsultasi.chat', $activeConsultation->id) }}"
                                class="refresh-btn">
                                Refresh
                            </a>

                        </form>

                    </div>
                @endif
            @else
                <div class="empty-chat">
                    Pilih konsultasi untuk membuka chat.
                </div>

            @endif

        </div>

    </div>

    <script>
        window.addEventListener('load', function() {
            const ml = document.getElementById('messageList');

            if (ml) {
                ml.scrollTop = ml.scrollHeight;
            }
        });
    </script>

@endsection
