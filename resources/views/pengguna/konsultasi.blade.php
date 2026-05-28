<div class="chat-list">
    @foreach($consultations as $konsultasi)

    <div class="chat-card">

        <div class="chat-card-top">

            <div class="avatar-chat">
                {{ substr($konsultasi->ahliGizi->name, 0, 1) }}
            </div>

            <div class="chat-user-info">
                <h4>{{ $konsultasi->ahliGizi->name }}</h4>
                <p>Ahli Gizi · {{ $konsultasi->messages->count() }} pesan</p>
            </div>

            <span class="status-chat {{ $konsultasi->status === 'aktif' ? 'active' : 'closed' }}">
                {{ ucfirst($konsultasi->status) }}
            </span>

        </div>

        @if($konsultasi->messages->last())
        <div class="last-message">
            <p>
                {{ Str::limit($konsultasi->messages->last()->isi, 100) }}
            </p>

            <span>
                {{ $konsultasi->messages->last()->created_at->format('H:i') }}
            </span>
        </div>
        @endif

        <a href="{{ route('pengguna.konsultasi.chat', $konsultasi->id) }}"
           class="btn-chat">
            Buka Chat →
        </a>

    </div>

    @endforeach
</div>