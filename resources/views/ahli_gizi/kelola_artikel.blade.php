@extends('layouts.layout_ahli_gizi')
@section('title', 'Kelola Artikel')

<style>
.art-wrap{
    max-width:900px;
}

.artikel-action{
    display:flex;
    justify-content:flex-end;
    margin-bottom:20px;
}

.btn-tambah-artikel{
    display:inline-flex;
    align-items:center;
    justify-content:center;

    padding:12px 24px;
    background:#2563EB;
    color:#fff;

    border-radius:999px;
    text-decoration:none;

    font-size:14px;
    font-weight:600;

    transition:.25s;
}

.btn-tambah-artikel:hover{
    background:#1D4ED8;
    transform:translateY(-2px);
}
</style>

@section('content')
<div class="page-header">

    <div class="page-header-content">
    
        <div class="page-header-icon">
            <svg width="28" height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2">

                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5V4.5z"></path>

            </svg>
        </div>

        <div>
            <h2>Kelola Artikel</h2>
            <p>Tulis dan kelola artikel edukasi untuk pengguna.</p>
        </div>

    </div>

</div>

<div class="artikel-action">
    <a href="{{ route('ahligizi.artikel.tambah') }}"
        class="btn-tambah-artikel">
        + Tambah Artikel
    </a>
</div>

    @if(session('success'))
        <div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">✓ {{ session('success') }}</div>
    @endif

    @if($artikels->count() == 0)
        <div style="text-align:center;padding:40px;background:#fff;border-radius:12px;border:1.5px solid #e8f0f5;color:#aaa;">
            Belum ada artikel. Klik <a href="{{ route('ahligizi.artikel.tambah') }}" style="color:#90D2ED;">Tambah Artikel</a> untuk memulai.
        </div>
    @else
        <div style="display:grid;gap:14px;">
            @foreach($artikels as $artikel)
            <div style="background:#fff;border-radius:12px;padding:16px;border:1.5px solid #e8f0f5;display:flex;gap:16px;align-items:flex-start;">
                @if($artikel->gambar)
                    <img src="{{ asset('assets/images/artikel/' . $artikel->gambar) }}" style="width:80px;height:70px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                @else
                    <div style="width:80px;height:70px;background:#e8f0f5;border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;">
                        <svg width="28" height="28" viewBox="0 0 24 24" fill="#aaa"><path d="M4 6H2v14c0 1.1.9 2 2 2h14v-2H4V6zm16-4H8c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-1 9H9V9h10v2zm-4 4H9v-2h6v2zm4-8H9V5h10v2z"/></svg>
                    </div>
                @endif
                <div style="flex:1;">
                    <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
                        <span style="font-weight:600;font-size:15px;">{{ $artikel->judul }}</span>
                        <span style="font-size:11px;padding:2px 8px;background:#e8f4fd;border-radius:12px;color:#2980b9;">{{ $artikel->rekomendasi_imt }}</span>
                    </div>
                    <p style="font-size:13px;color:#666;margin-bottom:8px;">{{ Str::limit(strip_tags($artikel->isi), 100) }}</p>
                    <div style="font-size:11px;color:#aaa;">{{ $artikel->created_at->format('d M Y') }}</div>
                </div>
                <div style="display:flex;gap:8px;flex-shrink:0;">
                    <a href="{{ route('ahligizi.artikel.edit', $artikel->id) }}" style="padding:6px 14px;background:#f39c12;color:#fff;border-radius:6px;text-decoration:none;font-size:13px;">Edit</a>
                    <form action="{{ route('ahligizi.artikel.hapus', $artikel->id) }}" method="POST" onsubmit="return confirm('Hapus artikel ini?')">
                        @csrf
                        <button type="submit" style="padding:6px 14px;background:#e74c3c;color:#fff;border:none;border-radius:6px;cursor:pointer;font-size:13px;">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
