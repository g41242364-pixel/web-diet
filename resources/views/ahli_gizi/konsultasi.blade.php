@extends('layouts.layout_ahli_gizi')
@section('title', 'Konsultasi Ahli Gizi')

<style>
    .consul-layout {
        display: grid;
        grid-template-columns: 340px 1fr;
        height: calc(100vh - 60px);
        background: #d6dde1;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #6f6f6f;
    }

    .consul-sidebar {
        border-right: 1px solid #6f6f6f;
        background: #c7d9e3;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .consul-chat {
        display: flex;
        flex-direction: column;
        background: #d6dde1;
        height: 100%;
        overflow: hidden;
    }

    .sidebar-header1 {
        padding: 18px;
        border-bottom: 1px solid #6f6f6f;
        background: #c7d9e3;
        flex-shrink: 0;
    }

    .search-box {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1px solid #999;
        background: #f2f2f2;
        font-size: 14px;
        outline: none;
        color: #333;
    }

    .search-box:focus {
        border-color: #5aa2d6;
    }

    .sidebar-list {
        flex: 1;
        overflow-y: auto;
    }

    .chat-user {
        padding: 16px 18px;
        border-bottom: 1px solid #6f6f6f;
        display: flex;
        gap: 12px;
        text-decoration: none;
        color: #222;
        transition: .2s;
        background: #c7d9e3;
    }

    .chat-user:hover {
        background: #bdd3de;
    }

    .chat-user.active {
        background: #b4ccd8;
    }

    .avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: #4fc3e8;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-weight: 700;
        font-size: 17px;
        flex-shrink: 0;
    }

    .chat-content {
        flex: 1;
        min-width: 0;
    }

    .chat-name {
        font-weight: 700;
        margin-bottom: 4px;
        font-size: 14px;
        color: #111;
    }

    .chat-last {
        font-size: 12px;
        color: #555;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chat-time {
        font-size: 11px;
        color: #666;
        flex-shrink: 0;
    }

    .chat-header {
        padding: 16px 20px;
        border-bottom: 1px solid #6f6f6f;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #c7d9e3;
        flex-shrink: 0;
    }

    .chat-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-header-name {
        font-weight: 700;
        font-size: 15px;
        color: #111;
    }

    .chat-header-status {
        font-size: 12px;
        color: #555;
        margin-top: 2px;
    }

    .header-action {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .finish-btn {
        padding: 5px 8px;
        border-radius: 5px;
        border: none;
        background: #d9534f;
        color: #fff;
        cursor: pointer;
        font-size: 10px;
        font-weight: 600;
    }

    .delete-btn {
        padding: 5px 8px;
        border-radius: 5px;
        border: none;
        background: #222;
        color: #fff;
        cursor: pointer;
        font-size: 10px;
        font-weight: 600;
    }

    .message-wrapper {
        flex: 1;
        overflow: hidden;
        position: relative;
    }

    .message-list {
        position: absolute;
        inset: 0;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: #d6dde1;
    }

    .message-item-right {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .message-item-left {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .sender-name {
        font-size: 12px;
        color: #555;
        margin-bottom: 4px;
    }

    .bubble-ahli {
        background: #d9e5bf;
        color: #3a3a3a;
        padding: 12px 14px;
        border-radius: 18px 18px 4px 18px;
        max-width: 70%;
        font-size: 14px;
        line-height: 1.5;
        word-break: break-word;
        border: 1px solid #bcc79f;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }

    .bubble-user {
        background: #e7ecef;
        border: 1px solid #c8d0d5;
        padding: 12px 14px;
        border-radius: 18px 18px 18px 4px;
        max-width: 70%;
        font-size: 14px;
        line-height: 1.5;
        word-break: break-word;
        color: #3a3a3a;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
    }

    .bubble-meta {
        font-size: 11px;
        color: #777;
        margin-top: 5px;
    }

    .chat-input {
        padding: 14px 16px;
        border-top: 1px solid #b9c2c7;
        background: #d6dde1;
        flex-shrink: 0;
    }

    .chat-form {
        display: flex;
        gap: 10px;
        align-items: center;
    }

    .chat-form input {
        flex: 1;
        padding: 12px 14px;
        border-radius: 14px;
        border: none;
        outline: none;
        font-size: 14px;
        background: #5aa2d6;
        color: #fff;
    }

    .chat-form input::placeholder {
        color: rgba(255,255,255,0.85);
    }

    .send-btn {
        width: 48px;
        height: 48px;
        border: none;
        border-radius: 14px;
        background: #5aa2d6;
        color: #000;
        cursor: pointer;
        font-size: 20px;
        flex-shrink: 0;
    }

    .refresh-btn {
        padding: 0 16px;
        height: 48px;
        border-radius: 14px;
        background: #5aa2d6;
        color: #fff;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .empty-chat {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #666;
        font-size: 15px;
        background: #d6dde1;
    }

    .sidebar-list::-webkit-scrollbar,
    .message-list::-webkit-scrollbar {
        width: 8px;
    }

    .sidebar-list::-webkit-scrollbar-thumb,
    .message-list::-webkit-scrollbar-thumb {
        background: #9fb7c3;
        border-radius: 20px;
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
