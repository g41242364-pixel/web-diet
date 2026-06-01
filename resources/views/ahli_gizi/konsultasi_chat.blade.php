@extends('layouts.layout_ahli_gizi')
@section('title', 'Chat Konsultasi')

@section('content')

<style>
.chat-page{
    max-width:900px;
    margin:0 auto;
}

.btn-back-chat{
    display:inline-flex;
    align-items:center;
    gap:6px;
    margin-bottom:16px;
    text-decoration:none;
    color:#64748B;
    font-size:14px;
    font-weight:500;
}

.btn-back-chat:hover{
    color:#2563EB;
}

.chat-container{
    background:#EFF6FF;
    border:1.5px solid #BFDBFE;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 8px 24px rgba(37,99,235,.08);
}

.chat-header{
    background:#2563EB;
    padding:16px 20px;
    display:flex;
    align-items:center;
    gap:12px;
}

.avatar-chat{
    width:44px;
    height:44px;
    border-radius:50%;
    background:#DBEAFE;
    color:#2563EB;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:16px;
    flex-shrink:0;
}

.chat-info h4{
    margin:0;
    color:#fff;
    font-size:15px;
}

.chat-info p{
    margin:2px 0 0;
    color:rgba(255,255,255,.85);
    font-size:12px;
}

.chat-status{
    margin-left:auto;
    padding:5px 12px;
    border-radius:20px;
    background:rgba(255,255,255,.15);
    color:#fff;
    font-size:12px;
}

.screening-info{
    background:#DBEAFE;
    border-bottom:1px solid #BFDBFE;
    padding:12px 16px;
    font-size:13px;
    color:#1E40AF;
}

.message-list{
    height:500px;
    overflow-y:auto;
    padding:18px;
    display:flex;
    flex-direction:column;
    gap:14px;
    background:#F8FAFC;
}

.message-right{
    display:flex;
    flex-direction:column;
    align-items:flex-end;
}

.message-left{
    display:flex;
    flex-direction:column;
    align-items:flex-start;
}

.sender-name{
    font-size:11px;
    color:#64748B;
    margin-bottom:4px;
}

.bubble-ahli{
    background:#2563EB;
    color:#fff;
    padding:12px 15px;
    border-radius:18px 18px 4px 18px;
    max-width:70%;
    line-height:1.6;
}

.bubble-user{
    background:#fff;
    color:#334155;
    padding:12px 15px;
    border-radius:18px 18px 18px 4px;
    max-width:70%;
    line-height:1.6;
    border:1px solid #E2E8F0;
}

.bubble-meta{
    font-size:11px;
    color:#94A3B8;
    margin-top:4px;
}

.chat-input-area{
    display:flex;
    gap:10px;
    padding:16px;
    background:#fff;
    border-top:1px solid #E2E8F0;
    align-items:center;
}

.chat-form{
    display:flex;
    gap:10px;
    flex:1;
}

.chat-input{
    flex:1;
    padding:12px 16px;
    border:1.5px solid #BFDBFE;
    border-radius:24px;
    font-size:14px;
    outline:none;
}

.chat-input:focus{
    border-color:#2563EB;
}

.send-btn{
    width:48px;
    height:48px;
    border:none;
    border-radius:50%;
    background:#2563EB;
    color:#fff;
    cursor:pointer;
}

.refresh-btn{
    padding:12px 14px;
    background:#F1F5F9;
    color:#64748B;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
}

.chat-finished{
    padding:16px;
    text-align:center;
    background:#F8FAFC;
    color:#64748B;
}

.message-list::-webkit-scrollbar{
    width:8px;
}

.message-list::-webkit-scrollbar-thumb{
    background:#CBD5E1;
    border-radius:20px;
}
</style>

<div class="chat-page">

    <a href="{{ route('ahligizi.konsultasi') }}" class="btn-back-chat">
        ← Kembali ke Daftar Konsultasi
    </a>

    <div class="chat-container">

        <div class="chat-header">

            <div class="avatar-chat">
                {{ substr($consultation->user->name,0,1) }}
            </div>

            <div class="chat-info">
                <h4>{{ $consultation->user->name }}</h4>

                <p>
                    Pengguna
                    @if($consultation->screening)
                        · IMT {{ $consultation->screening->imt }}
                        ({{ $consultation->screening->status_imt }})
                    @endif
                </p>
            </div>

            <span class="chat-status">
                {{ ucfirst($consultation->status) }}
            </span>

        </div>

        @if($consultation->screening)
        <div class="screening-info">
            📋 Data Skrining :
            BB {{ $consultation->screening->berat_badan }} kg |
            TB {{ $consultation->screening->tinggi_badan }} cm |
            IMT {{ $consultation->screening->imt }} |
            Status {{ $consultation->screening->status_imt }}
        </div>
        @endif

        <div class="message-list" id="messageList">

            @foreach($consultation->messages as $msg)

                @if($msg->user_id == auth()->id())

                    <div class="message-right">

                        <div class="bubble-ahli">
                            {{ $msg->isi }}
                        </div>

                        <div class="bubble-meta">
                            {{ $msg->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                        </div>

                    </div>

                @else

                    <div class="message-left">

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

        @if($consultation->status === 'aktif')

        <div class="chat-input-area">

            <form action="{{ route('ahligizi.konsultasi.balas',$consultation->id) }}"
                  method="POST"
                  class="chat-form">

                @csrf

                <input type="text"
                       name="isi"
                       class="chat-input"
                       placeholder="Tulis balasan..."
                       autocomplete="off"
                       required>

                <button type="submit" class="send-btn">
                    ➤
                </button>

            </form>

            <a href="{{ route('ahligizi.konsultasi.chat',$consultation->id) }}"
               class="refresh-btn">
                🔄 Refresh
            </a>

        </div>

        @else

        <div class="chat-finished">
            Konsultasi telah selesai.
        </div>

        @endif

    </div>

</div>

<script>
window.addEventListener('load', function(){
    const ml = document.getElementById('messageList');
    if(ml){
        ml.scrollTop = ml.scrollHeight;
    }
});
</script>

@endsection