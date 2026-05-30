@extends('layouts.layout_pengguna')
@section('title', 'Profil')

<style>

/* ===== PAGE ===== */
.profil-page{
    width:100%;
    padding:20px;
    min-height:100vh;
    background:#f6f9fc;
    box-sizing:border-box;
}

/* ===== HEADER MIRIP DASHBOARD ===== */
.header-title{
    background:#fff;
    border-radius:30px;
    padding:30px 45px;
    margin-bottom:25px;
    box-shadow:0 2px 10px rgba(0,0,0,0.03);
}

.header-title h2{
    margin:0;
    font-size:28px;
    font-weight:800;
    color:#10213f;
}

.header-title p{
    margin-top:8px;
    color:#5d6b82;
    font-size:15px;
}

/* ===== ALERT ===== */
.alert-success{
    background:#e8f8e8;
    color:#27ae60;
    padding:12px 16px;
    border-radius:12px;
    margin-bottom:18px;
    font-size:14px;
}

.alert-error{
    background:#fde8e8;
    color:#c0392b;
    padding:12px 16px;
    border-radius:12px;
    margin-bottom:18px;
    font-size:14px;
}

/* ===== CARD ===== */
.profil-card{
    background:#fff;
    border-radius:20px;
    padding:24px;
    margin-bottom:20px;
    border:1px solid #e8eef5;
    box-shadow:0 3px 12px rgba(0,0,0,.04);
}

.profil-card h3{
    margin:0 0 20px;
    font-size:22px;
    font-weight:700;
    color:#10213f;
}

/* ===== GRID ===== */
.form-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
}

/* ===== FORM ===== */
.form-group{
    display:flex;
    flex-direction:column;
}

.form-group label{
    margin-bottom:6px;
    font-size:13px;
    font-weight:600;
    color:#4b5563;
}

.form-group input,
.form-group select{
    width:100%;
    padding:11px 14px;
    border:1.5px solid #d9e3ec;
    border-radius:10px;
    font-size:14px;
    background:#fff;
    transition:.2s;
}

.form-group input:focus,
.form-group select:focus{
    outline:none;
    border-color:#90D2ED;
    box-shadow:0 0 0 3px rgba(144,210,237,.15);
}

/* ===== BUTTON ===== */
.btn-save{
    margin-top:15px;
    background:#90D2ED;
    color:#fff;
    border:none;
    border-radius:10px;
    padding:10px 20px;
    font-size:14px;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
}

.btn-save:hover{
    transform:translateY(-1px);
}

.btn-danger{
    background:#e74c3c;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){

    .profil-page{
        padding:15px;
    }

    .header-title{
        padding:25px;
        border-radius:20px;
    }

    .header-title h2{
        font-size:24px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }

    .profil-card{
        padding:18px;
    }
}

</style>

@section('content')

<div class="profil-page">

    <!-- HEADER -->
    <div class="header-title">
        <h2>Profil Saya</h2>
        <p>Kelola informasi akun Anda</p>
    </div>

    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- INFORMASI AKUN -->
    <div class="profil-card">

        <h3>Informasi Akun</h3>

        <form action="{{ route('pengguna.profil.update') }}" method="POST">
            @csrf

            <div class="form-grid">

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input
                        type="text"
                        name="name"
                        value="{{ $user->name }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input
                        type="email"
                        name="email"
                        value="{{ $user->email }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Umur</label>
                    <input
                        type="number"
                        name="umur"
                        value="{{ $user->umur }}"
                    >
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>

                    <select name="jenis_kelamin">
                        <option value="L"
                            {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="P"
                            {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn-save">
                Simpan Perubahan
            </button>

        </form>

    </div>

    <!-- PASSWORD -->
    <div class="profil-card">

        <h3>Ubah Password</h3>

        <form action="{{ route('pengguna.profil.ubahPassword') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Password Lama</label>
                <input
                    type="password"
                    name="password_lama"
                    required
                >
            </div>

            <div class="form-grid">

                <div class="form-group">
                    <label>Password Baru</label>
                    <input
                        type="password"
                        name="password"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        required
                    >
                </div>

            </div>

            <button type="submit" class="btn-save btn-danger">
                Ubah Password
            </button>

        </form>

    </div>

</div>

@endsection