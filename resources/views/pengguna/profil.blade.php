@extends('layouts.layout_pengguna')
@section('title', 'Profil')

<style>

/* ===== FORCE FULL SCREEN ===== */
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
}

/* ===== PAGE ===== */
.profil-page {
    width: 100vw;   /* 🔥 penting: paksa full viewport */
    min-height: 100vh;
    background: #f6f9fc;

    padding: 25px 12px;
    box-sizing: border-box;
}

/* ===== WRAPPER ===== */
.profil-wrapper {
    width: 100%;
}

/* ===== HEADER ===== */
.header-title {
    margin-bottom: 18px;
    padding-left: 12px;
    margin-top: -18px;
}

.header-title h2 {
    font-size: 34px;
    font-weight: 800;
    color: #1f2d3d;
    margin-bottom: 4px;
}

.header-title p {
    color: #666;
    font-size: 14px;
}

/* ===== CARD ===== */
.profil-card {
    width: 100%;
    background: #fff;
    border-radius: 14px;
    padding: 32px;
    margin-bottom: 18px;
    border: 1px solid #e8f0f5;
    box-shadow: 0 4px 14px rgba(0,0,0,0.05);
}

/* ===== GRID ===== */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
}

/* ===== FORM ===== */
.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
}

.form-group label {
    font-size: 13px;
    font-weight: 600;
    color: #555;
    margin-bottom: 6px;
}

.form-group input,
.form-group select {
    padding: 13px 14px;
    border: 1.5px solid #ddd;
    border-radius: 9px;
    font-size: 14px;
    width: 100%;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #90D2ED;
    outline: none;
    box-shadow: 0 0 0 3px rgba(144,210,237,0.2);
}

/* ===== BUTTON ===== */
.btn-save {
    margin-top: 14px;
    padding: 11px 22px;
    background: #90D2ED;
    color: white;
    border: none;
    border-radius: 9px;
    font-weight: 600;
    cursor: pointer;
}

.btn-danger {
    background: #e74c3c !important;
}

/* ===== ALERT ===== */
.alert-success {
    background:#e8f8e8;
    color:#27ae60;
    padding:12px 16px;
    border-radius:8px;
    margin-bottom:16px;
}

.alert-error {
    background:#fde8e8;
    color:#c0392b;
    padding:12px 16px;
    border-radius:8px;
    margin-bottom:16px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .header-title {
        padding-left: 0;
    }
}

</style>

@section('content')

<div class="profil-page">
    <div class="profil-wrapper">

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
                            <option value="L" {{ $user->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ $user->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn-save">Simpan Perubahan</button>
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

    </div>
</div>

@endsection