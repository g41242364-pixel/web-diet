@extends('layouts.layout_pengguna')
@section('title', 'Profil')

<style>

/* =========================
   HEADER
========================= */

.header-title{
    background:#FFFFFF;
    border-radius:30px;
    padding:35px 50px;
    margin-bottom:25px;
}

.header-title h2{
    margin:0;
    font-size:52px;
    font-weight:800;
    color:#1E293B;
    line-height:1.1;
}

.header-title p{
    margin-top:10px;
    font-size:16px;
    color:#64748B;
}

/* =========================
   ALERT
========================= */

.alert-success{
    background:#E8F8E8;
    color:#27AE60;
    padding:12px 16px;
    border-radius:12px;
    margin-bottom:16px;
    font-size:14px;
}

.alert-error{
    background:#FDE8E8;
    color:#C0392B;
    padding:12px 16px;
    border-radius:12px;
    margin-bottom:16px;
    font-size:14px;
}

/* =========================
   CARD
========================= */

.profil-card{
    background:#FFFFFF;
    border:1.5px solid #DBEAFE;
    border-radius:24px;
    padding:30px;
    margin-bottom:25px;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
}

.profil-card h3{
    margin:0 0 22px;
    font-size:20px;
    font-weight:800;
    color:#000000;
}

/* =========================
   GRID
========================= */

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

/* =========================
   FORM
========================= */

.form-group{
    display:flex;
    flex-direction:column;
    margin-bottom:16px;
}

.form-group label{
    display:block;
    font-size:14px;
    margin-bottom:7px;
    color:#1E3A5F;
    font-weight:600;
}

.form-group input,
.form-group select{
    width:100%;
    padding:12px;
    border:1.5px solid #BFDBFE;
    border-radius:12px;
    background:#FFFFFF;
    font-size:14px;
    color:#0F172A;
    transition:all .3s ease;
}

.form-group input:focus,
.form-group select:focus{
    outline:none;
    border-color:#2563EB;
    box-shadow:0 0 0 4px rgba(37,99,235,0.12);
}

/* =========================
   BUTTON
========================= */

.btn-save{
    background:#2563EB;
    color:#FFFFFF;
    border:none;
    border-radius:999px;
    padding:13px 24px;
    font-size:15px;
    font-weight:700;
    cursor:pointer;
    transition:all .3s ease;
    box-shadow:0 4px 10px rgba(37,99,235,0.25);
}

.btn-save:hover{
    background:#1D4ED8;
}

.btn-danger{
    background:#E74C3C !important;
    box-shadow:0 4px 10px rgba(231,76,60,0.25);
}

.btn-danger:hover{
    background:#C0392B !important;
}

/* =========================
   RESPONSIVE
========================= */

@media (max-width:1024px){

    .header-title h2{
        font-size:42px;
    }

    .form-grid{
        grid-template-columns:1fr;
    }
}

@media (max-width:768px){

    .header-title{
        padding:25px;
    }

    .header-title h2{
        font-size:34px;
    }

    .profil-card{
        padding:20px;
    }
}

</style>

@section('content')

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
                <input type="text" name="name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label>Umur</label>
                <input type="number" name="umur" value="{{ $user->umur }}">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin">
                    <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>
                        Laki-laki
                    </option>
                    <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>
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
            <input type="password" name="password_lama" required>
        </div>

        <div class="form-grid">

            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" required>
            </div>

        </div>

        <button type="submit" class="btn-save btn-danger">
            Ubah Password
        </button>

    </form>

</div>

@endsection