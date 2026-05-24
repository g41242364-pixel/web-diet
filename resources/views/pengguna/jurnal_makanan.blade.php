@extends('layouts.layout_pengguna')

@section('title', 'Daftar Makanan Lainnya')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/pengguna/jurnal_makanan.css') }}">

<style>
/* ===== HEADER ===== */

.jurnal-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 30px;
    background:#fff;
    border-radius:20px;
    margin-bottom:25px;
    box-shadow:0 4px 12px rgba(0,0,0,.06);
}

.header-left{
    flex:1;
}

.header-center{
    display:flex;
    align-items:center;
    gap:16px;
}

.header-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:#eaf3ff;

    display:flex;
    align-items:center;
    justify-content:center;
}

.header-text{
    display:flex;
    flex-direction:column;
}

/* UBAH UKURAN JUDUL SAJA */
.header-text h1{
    font-size:32px;
    font-weight:700;
    margin:0;
    color:#1e293b;
    line-height:1.2;
}

.header-text p{
    margin-top:5px;
    margin-bottom:0;
    color:#64748b;
    font-size:14px;
}

.btn-back{
    display:flex;
    align-items:center;
    gap:8px;

    text-decoration:none;
    background:#f8fafc;

    padding:10px 15px;
    border-radius:12px;

    color:#334155;
    font-size:14px;
    font-weight:600;

    transition:.3s;
}

.btn-back:hover{
    background:#dbeafe;
    color:#2563eb;
}

/* RESPONSIVE */

@media(max-width:768px){

    .jurnal-header{
        flex-direction:column;
        gap:15px;
        text-align:center;
    }

    .header-text h1{
        font-size:26px;
    }

}
</style>

<div class="main-wrapper">

    <header class="jurnal-header">

        <a href="{{ route('pengguna.jurnalMakanan') }}" class="btn-back">

            <svg width="20" height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2.5"
                stroke-linecap="round"
                stroke-linejoin="round">

                <line x1="19" y1="12" x2="5" y2="12"></line>

                <polyline points="12 19 5 12 12 5"></polyline>

            </svg>

            <span>Kembali ke Rekomendasi</span>

        </a>

        <div class="skrining-header-top">

            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="2.5">
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
                <circle cx="4" cy="6" r="1"/>
                <circle cx="4" cy="12" r="1"/>
                <circle cx="4" cy="18" r="1"/>
            </svg>

            <div class="header-content">

                <h2>Daftar Nutrisi Makanan Sehat</h2>

                <p>
                    Pilihan alternatif makanan bergizi
                    penunjang diet seimbangmu.
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

                        <img src="{{ $food->gambar ? asset('assets/images/makanan/' . $food->gambar) : asset('assets/images/Cemilan.png') }}"
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