@extends('layouts.layout_ahli_gizi')
@section('title', 'Chat Konsultasi')
<style>
.message-list { height: 420px; overflow-y: auto; padding: 16px; display: flex; flex-direction: column; gap: 12px; background: #f9f9f9; }
.bubble-ahli { align-self: flex-end; background: #90D2ED; color: #fff; padding: 10px 14px; border-radius: 16px 16px 4px 16px; max-width: 70%; font-size: 14px; white-space: pre-line; }
.bubble-user { align-self: flex-start; background: #fff; color: #333; padding: 10px 14px; border-radius: 16px 16px 16px 4px; max-width: 70%; font-size: 14px; border: 1.5px solid #e8f0f5; white-space: pre-line; }
.bubble-meta { font-size: 11px; color: #aaa; margin-top: 3px; }
</style>

@section('content')
<div style="max-width:860px;">
    <div style="margin-bottom:14px;">
        <a href="{{ route('ahligizi.konsultasi') }}" style="color:#888;text-decoration:none;font-size:13px;">← Kembali ke Daftar Konsultasi</a>
    </div>

    <div style="border-radius:12px;overflow:hidden;border:1.5px solid #e8f0f5;">
        <div style="background:#90D2ED;padding:14px 16px;display:flex;align-items:center;gap:12px;">
            <div style="width:40px;height:40px;border-radius:50%;background:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;color:#90D2ED;font-size:16px;">
                {{ substr($consultation->user->name, 0, 1) }}
            </div>
            <div>
                <div style="font-weight:600;color:#fff;">{{ $consultation->user->name }}</div>
                <div style="font-size:12px;color:rgba(255,255,255,0.8);">
                    Pengguna
                    @if($consultation->screening)
                        · IMT {{ $consultation->screening->imt }} ({{ $consultation->screening->status_imt }})
                    @endif
                </div>
            </div>
            <span style="margin-left:auto;font-size:12px;padding:4px 12px;border-radius:12px;background:rgba(255,255,255,0.2);color:#fff;">{{ ucfirst($consultation->status) }}</span>
        </div>

        @if($consultation->screening)
        <div style="background:#e8f4fd;padding:10px 16px;font-size:12px;color:#2980b9;border-bottom:1px solid #ddd;">
            📋 Data Skrining: BB {{ $consultation->screening->berat_badan }}kg | TB {{ $consultation->screening->tinggi_badan }}cm | IMT {{ $consultation->screening->imt }} | Status: {{ $consultation->screening->status_imt }}
        </div>
        @endif

        <div class="message-list" id="messageList">
            @foreach($consultation->messages as $msg)
                @if($msg->user_id == auth()->id())
                <div style="align-self:flex-end;display:flex;flex-direction:column;align-items:flex-end;">
                    <div class="bubble-ahli">{{ $msg->isi }}</div>
                    <div class="bubble-meta">{{$msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</div>
                </div>
                @else
                <div style="align-self:flex-start;display:flex;flex-direction:column;">
                    <div style="font-size:11px;color:#888;margin-bottom:2px;">{{ $msg->sender->name }}</div>
                    <div class="bubble-user">{{ $msg->isi }}</div>
                    <div class="bubble-meta">{{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}</div>
                </div>
                @endif
            @endforeach
        </div>

        @if($consultation->status === 'aktif')
        <div style="display:flex;gap:10px;padding:14px 16px;border-top:1.5px solid #eee;background:#fff;align-items:center;">
            <form action="{{ route('ahligizi.konsultasi.balas', $consultation->id) }}" method="POST" style="display:flex;gap:10px;flex:1;">
                @csrf
                <input type="text" name="isi" placeholder="Tulis balasan..." autocomplete="off" required style="flex:1;padding:10px 14px;border:1.5px solid #ddd;border-radius:8px;font-size:14px;">
                <button type="submit" style="padding:10px 18px;background:#90D2ED;color:#fff;border:none;border-radius:8px;cursor:pointer;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
                </button>
            </form>
            <a href="" style="padding:10px 12px;background:#f0f0f0;color:#666;border-radius:8px;font-size:12px;text-decoration:none;">🔄 Refresh</a>
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
