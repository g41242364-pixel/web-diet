@extends('layouts.layout_pengguna')

@section('title', 'Daftar Makanan Lainnya')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/pengguna/jurnal_makanan.css') }}">

<style>
/* HEADER */
.jurnal-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:20px;
    margin-bottom:25px;
    background:#fff;
    border-radius:18px;
    box-shadow:0 4px 15px rgba(0,0,0,.05);
}

.header-left{
    flex:1;
}

.header-center{
    flex:2;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:14px;
}

/* ICON */
.header-icon{
    width:55px;
    height:55px;
    border-radius:15px;
    background:#EAF4FF;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* BAGIAN TEXT */
.header-text h1{
    font-size:28px !important;
    font-weight:700;
    margin:0;
    line-height:1.2;
    color:#1E293B;
}

.header-text p{
    font-size:14px;
    color:#64748B;
    margin-top:4px;
}

/* tombol kembali */
.btn-back{
    display:flex;
    align-items:center;
    gap:8px;
    text-decoration:none;
    color:#2563EB;
    font-weight:600;
}

/* RESPONSIVE */
@media(max-width:768px){

    .jurnal-header{
        flex-direction:column;
        gap:15px;
        text-align:center;
    }

    .header-center{
        flex-direction:column;
    }

    .header-text h1{
        font-size:22px !important;
    }
}
</style>

<div class="main-wrapper">

    <header class="jurnal-header">

        <div class="header-left">
            <a href="{{ route('pengguna.jurnalMakanan') }}" class="btn-back">

                <svg width="20" height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5">

                    <line x1="19" y1="12" x2="5" y2="12"></line>

                    <polyline points="12 19 5 12 12 5"></polyline>

                </svg>

                <span>Kembali ke Rekomendasi</span>

            </a>
        </div>

        <div class="header-center">

            <div class="header-icon">
                🍎
            </div>

            <div class="header-text">
                <h1>Daftar Nutrisi Makanan Sehat</h1>

                <p>
                    Pilihan alternatif makanan bergizi
                    penunjang diet seimbangmu
                </p>
            </div>

        </div>

    </header>


    <div class="content-container">

        <div class="foods-grid">

            @forelse ($foods as $food)

            <div class="food-card">

                <div class="food-card-header">
                    {{ $food->nama }}
                </div>

                <div class="food-card-body">

                    <div class="image-wrapper">

                        <img src="{{ $food->gambar
                            ? asset('assets/images/makanan/'.$food->gambar)
                            : asset('assets/images/Cemilan.png') }}"

                            alt="{{ $food->nama }}"
                            class="food-image">

                    </div>

                    <div class="food-nutrition-info">

                        <h5 class="nutrition-title">
                            Kandungan Gizi:
                        </h5>

                        <ul class="nutrition-list">

                            <li>
                                <span class="label">
                                    Energi / Kalori:
                                </span>

                                <span class="value">
                                    {{ $food->kalori ?? 0 }} kkal
                                </span>
                            </li>

                            <li>
                                <span class="label">
                                    Protein:
                                </span>

                                <span class="value">
                                    {{ $food->protein ?? 0 }} g
                                </span>
                            </li>

                            <li>
                                <span class="label">
                                    Karbohidrat:
                                </span>

                                <span class="value">
                                    {{ $food->karbohidrat ?? 0 }} g
                                </span>
                            </li>

                            <li>
                                <span class="label">
                                    Lemak:
                                </span>

                                <span class="value">
                                    {{ $food->lemak ?? 0 }} g
                                </span>
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            @empty

            <div class="empty-state">
                <p>
                    Belum ada alternatif makanan tambahan
                    yang tersedia saat ini.
                </p>
            </div>

            @endforelse

        </div>


        @if ($foods->hasPages())

        <div class="pagination-wrapper">
            {{ $foods->links('pagination::bootstrap-5') }}
        </div>

        @endif

    </div>

</div>

@endsection
