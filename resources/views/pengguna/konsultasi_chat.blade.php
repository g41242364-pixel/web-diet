@extends('layouts.layout_pengguna')
@section('title', 'Chat Konsultasi')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/konsultasi.css') }}">
<style>
.message-list { height: 420px; overflow-y: auto; padding: 16px; display: flex; flex-direction: column; gap: 12px; }
.bubble-user { align-self: flex-end; background: #E2F0D2; color: #000000; padding: 10px 14px; border-radius: 16px 16px 4px 16px; max-width: 70%; font-size: 14px; }
.bubble-ahli { align-self: flex-start; background: #E5EFF6; color: #333; padding: 10px 14px; border-radius: 16px 16px 16px 4px; max-width: 70%; font-size: 14px; }
.bubble-meta { font-size: 11px; color: #aaa; margin-top: 3px; }
.chat-input-area { display: flex; gap: 10px; padding: 14px 16px; background: #ffffff00; }
.chat-input-area input { flex: 1; padding: 10px 14px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 14px; }
.chat-input-area button { padding: 10px 18px; background: #90D2ED; color: #fff; border: none; border-radius: 8px; cursor: pointer; }
</style>

@section('content')
<div class="consul-container">
    <div class="consul-header" style="margin-bottom:14px;">
        <div class="header-top">
            <a href="{{ route('pengguna.konsultasi') }}" style="color:#888;text-decoration:none;font-size:13px;">← Kembali</a>
        </div>
    </div>

    <div class="chat-container" style="border-radius:12px;overflow:hidden;border:1.5px solid #e8f0f5;">
        <div class="chat-header" style="background:#90D2ED;padding:14px 16px;display:flex;align-items:center;gap:12px;">
            <div style="width:40px;height:40px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#90D2ED;font-size:16px;">
                {{ substr($consultation->ahliGizi->name, 0, 1) }}
            </div>
            <div>
                <div style="font-weight:600;color:#fff;">{{ $consultation->ahliGizi->name }}</div>
                <div style="font-size:12px;color:rgba(255,255,255,0.8);">
                    Ahli Gizi ·
                    @if($consultation->ahliGizi->is_online)
                        <span style="color:#90ff90;">● Online</span>
                    @else
                        <span style="color:rgba(255,255,255,0.6);">● Offline</span>
                    @endif
                </div>
            </div>
            <span style="margin-left:auto;font-size:12px;padding:4px 12px;border-radius:12px;background:rgba(255,255,255,0.2);color:#fff;">{{ ucfirst($consultation->status) }}</span>
        </div>

        <div class="message-list" id="messageList">
            @foreach($consultation->messages as $msg)
                @if($msg->user_id == auth()->id())
                <div style="align-self:flex-end;display:flex;flex-direction:column;align-items:flex-end;">
                    <div class="bubble-user" style="white-space:pre-line;">{{ $msg->isi }}</div>
                    <div class="bubble-meta">{{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</div>
                </div>
                @else
                <div style="align-self:flex-start;display:flex;flex-direction:column;">
                    <div style="font-size:11px;color:#888;margin-bottom:2px;">{{ $msg->sender->name }}</div>
                    <div class="bubble-ahli" style="white-space:pre-line;">{{ $msg->isi }}</div>
                    <div class="bubble-meta">{{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</div>
                </div>
                @endif
            @endforeach
        </div>

        @if($consultation->status === 'aktif')
        <div class="chat-input-area">
            <form action="{{ route('pengguna.konsultasi.kirimPesan', $consultation->id) }}" method="POST" style="display:flex;gap:10px;width:100%;">
                @csrf
                <input type="text" name="isi" placeholder="Tulis pesan..." autocomplete="off" required style="flex:1;background-color:#90D2ED;:10px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;">
                <button type="submit" style="padding:10px 18px;background:#90D2ED;color:#fff;border:none;border-radius:8px;cursor:pointer;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </form>
            <form action="" method="GET" style="flex-shrink:0;">
                <button type="submit" style="padding:10px 12px;background:#f0f0f0;color:#666;border:none;border-radius:8px;cursor:pointer;font-size:12px;">Refresh</button>
            </form>
        </div>
        @else
        <div style="padding:14px 16px;text-align:center;background:#f5f5f5;color:#888;font-size:13px;">Konsultasi telah selesai.</div>
        @endif
    </div>
</div>
<script>
    const ml = document.getElementById('messageList');
    if(ml) ml.scrollTop = ml.scrollHeight;
</script>
@endsection
