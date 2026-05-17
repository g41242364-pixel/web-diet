@extends('layouts.layout_pengguna')
@section('title', 'Profil')
<style>
.profil-container { max-width: 700px; }
.profil-card { background: #fff; border-radius: 12px; padding: 28px; margin-bottom: 20px; border: 1.5px solid #e8f0f5; }
.profil-card h3 { font-size: 16px; font-weight: 700; margin-bottom: 18px; color: #2c3e50; }
.form-group { margin-bottom: 16px; }
.form-group label { display: block; font-size: 13px; font-weight: 500; color: #555; margin-bottom: 6px; }
.form-group input, .form-group select { width: 100%; padding: 10px 14px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 14px; }
.form-group input:focus { outline: none; border-color: #90D2ED; }
.btn-save { padding: 10px 24px; background: #90D2ED; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; }
.avatar { width: 80px; height: 80px; border-radius: 50%; background: #90D2ED; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 32px; font-weight: 700; margin-bottom: 16px; }
</style>

@section('content')
<div class="header-title"><h2>Profil Saya</h2><p>Kelola informasi akun Anda</p></div>

@if(session('success'))<div style="background:#e8f8e8;color:#27ae60;padding:12px 16px;border-radius:8px;margin-bottom:16px;">✓ {{ session('success') }}</div>@endif
@if($errors->any())<div style="background:#fde8e8;color:#c0392b;padding:12px 16px;border-radius:8px;margin-bottom:16px;">{{ $errors->first() }}</div>@endif

<div class="profil-container">
    <div class="profil-card">
        <h3>Informasi Akun</h3>
        <form action="{{ route('pengguna.profil.update') }}" method="POST">
            @csrf
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
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
                    <input type="number" name="umur" value="{{ $user->umur }}" min="1" max="120">
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

    <div class="profil-card">
        <h3>Ubah Password</h3>
        <form action="{{ route('pengguna.profil.ubahPassword') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Password Lama</label>
                <input type="password" name="password_lama" required>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="password" required>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>
            <button type="submit" class="btn-save" style="background:#e74c3c;">Ubah Password</button>
        </form>
    </div>
</div>
@endsection
