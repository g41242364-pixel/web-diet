<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Reset Password</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --sidebar-dark:   #0D2B5E;
            --sidebar-mid:    #1A4F9C;
            --accent-blue:    #2B7FD4;
            --accent-light:   #5BA8E8;
            --input-bg:       #D6EAFA;
            --input-border:   #90C8F5;
            --text-label:     #0D2B5E;
            --text-muted:     #4A7BAF;
            --white:          #ffffff;
            --bg-page:        #EAF4FD;
            --error-bg:       #D0E8F8;
            --error-border:   #5BA8E8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg, var(--sidebar-dark) 0%, var(--sidebar-mid) 55%, var(--accent-blue) 100%);
            padding: 24px;
        }

        .card {
            background: var(--bg-page);
            padding: 40px 44px;
            border-radius: 20px;
            box-shadow: 0 16px 48px rgba(13, 43, 94, 0.25);
            width: 100%;
            max-width: 440px;
        }

        .card-brand {
            text-align: center;
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 4px;
            color: var(--sidebar-mid);
            margin-bottom: 4px;
        }

        .card-brand-sub {
            text-align: center;
            font-size: 11px;
            font-weight: 300;
            color: var(--text-muted);
            letter-spacing: 0.5px;
            margin-bottom: 28px;
        }

        .divider-line {
            width: 40px;
            height: 2px;
            background: var(--input-border);
            border-radius: 2px;
            margin: 0 auto 28px auto;
        }

        h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-label);
            margin-bottom: 6px;
        }

        .subtitle {
            color: var(--text-muted);
            font-size: 13px;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .subtitle strong {
            color: var(--text-label);
            font-weight: 600;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .alert-danger {
            background: var(--error-bg);
            color: var(--sidebar-mid);
            border-left: 4px solid var(--error-border);
        }

        .alert-info {
            background: #D6EAFA;
            color: var(--sidebar-mid);
            border-left: 4px solid var(--accent-light);
        }

        /* ===== FORM ===== */
        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 13.5px;
            color: var(--text-label);
            margin-bottom: 6px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            padding: 11px 14px 11px 42px;
            background: var(--input-bg);
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            color: var(--text-label);
            font-size: 14px;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .input-wrapper input::placeholder {
            color: #7BAFD4;
            font-weight: 300;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(43, 127, 212, 0.15);
            background: var(--white);
        }

        .input-wrapper svg {
            position: absolute;
            left: 13px;
            width: 18px;
            height: 18px;
            fill: var(--accent-light);
            pointer-events: none;
        }

        /* ===== BUTTON ===== */
        .btn {
            width: 100%;
            padding: 13px;
            background: linear-gradient(135deg, var(--sidebar-mid) 0%, var(--accent-blue) 100%);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 1.5px;
            cursor: pointer;
            margin-top: 8px;
            box-shadow: 0 4px 16px rgba(26, 79, 156, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 79, 156, 0.45);
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-brand">SISD</div>
        <div class="card-brand-sub">Sistem Informasi Skrining Diet</div>
        <div class="divider-line"></div>

        <h2>Reset Password</h2>
        <p class="subtitle">Buat password baru untuk akun: <strong>{{ session('reset_email') }}</strong></p>

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
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24">
                        <path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                    </svg>
                    <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                </div>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <div class="input-wrapper">
                    <svg viewBox="0 0 24 24">
                        <path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                    </svg>
                    <input type="password" name="password_confirmation" placeholder="Ulangi password baru" required>
                </div>
            </div>

            <button type="submit" class="btn">Simpan Password Baru</button>
        </form>
    </div>
</body>

</html>