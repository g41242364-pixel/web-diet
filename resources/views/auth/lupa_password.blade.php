<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Lupa Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        body { height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #90D2ED 0%, #E0F4FB 100%); }
        .card { background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); width: 100%; max-width: 420px; }
        h2 { font-size: 24px; font-weight: 700; color: #2c3e50; margin-bottom: 8px; }
        p { color: #666; font-size: 14px; margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; font-weight: 500; }
        input { width: 100%; padding: 12px 14px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 14px; transition: border-color .2s; }
        input:focus { outline: none; border-color: #90D2ED; }
        .btn { width: 100%; padding: 13px; background: #90D2ED; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; margin-top: 8px; }
        .btn:hover { background: #6bbce0; }
        .back-link { display: block; text-align: center; margin-top: 16px; color: #90D2ED; font-size: 13px; text-decoration: none; }
        .alert { padding: 12px 14px; border-radius: 8px; margin-bottom: 16px; font-size: 13px; }
        .alert-danger { background: #fde8e8; color: #c0392b; }
        .alert-success { background: #e8f8e8; color: #27ae60; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Lupa Password</h2>
        <p>Masukkan email Anda untuk mereset password.</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->has('email'))
            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
        @endif

        <form action="{{ route('lupa.password.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="email@contoh.com" value="{{ old('email') }}" required>
            </div>
            <button type="submit" class="btn">Cari Akun</button>
        </form>
        <a href="{{ route('login') }}" class="back-link">← Kembali ke Login</a>
    </div>
</body>
</html>
