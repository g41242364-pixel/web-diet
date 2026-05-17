<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Reset Password</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Poppins', sans-serif; }
        body { height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #90D2ED 0%, #E0F4FB 100%); }
        .card { background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); width: 100%; max-width: 420px; }
        h2 { font-size: 24px; font-weight: 700; color: #2c3e50; margin-bottom: 8px; }
        p { color: #666; font-size: 14px; margin-bottom: 24px; }
        .form-group { margin-bottom: 16px; }
        label { display: block; font-size: 13px; color: #555; margin-bottom: 6px; font-weight: 500; }
        input { width: 100%; padding: 12px 14px; border: 1.5px solid #ddd; border-radius: 8px; font-size: 14px; }
        input:focus { outline: none; border-color: #90D2ED; }
        .btn { width: 100%; padding: 13px; background: #90D2ED; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 600; cursor: pointer; margin-top: 8px; }
        .btn:hover { background: #6bbce0; }
        .alert { padding: 12px 14px; border-radius: 8px; margin-bottom: 16px; font-size: 13px; }
        .alert-danger { background: #fde8e8; color: #c0392b; }
        .alert-info { background: #e8f4fd; color: #2980b9; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Reset Password</h2>
        <p>Buat password baru untuk akun: <strong>{{ session('reset_email') }}</strong></p>

        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('reset.password.post') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required>
            </div>
            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password baru" required>
            </div>
            <button type="submit" class="btn">Simpan Password Baru</button>
        </form>
    </div>
</body>
</html>
