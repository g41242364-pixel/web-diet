<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Sign In</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --sidebar-dark:   #0D2B5E;
            --sidebar-mid:    #1A4F9C;
            --accent-blue:    #2B7FD4;
            --accent-light:   #5BA8E8;
            --highlight:      #90C8F5;
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
            height: 100vh;
            display: flex;
            background: var(--bg-page);
        }

        /* ===================== BRANDING PANEL (kiri) ===================== */
        .branding-panel {
            width: 380px;
            flex-shrink: 0;
            background: linear-gradient(160deg, var(--sidebar-dark) 0%, var(--sidebar-mid) 55%, var(--accent-blue) 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
            text-align: center;
            padding: 48px 40px;
            position: relative;
            overflow: hidden;
        }

        .branding-panel::before {
            content: '';
            position: absolute;
            width: 340px;
            height: 340px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.07);
            top: -80px;
            right: -80px;
        }
        .branding-panel::after {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.06);
            bottom: -60px;
            left: -60px;
        }

        .brand-logo {
            font-size: 88px;
            font-weight: 800;
            letter-spacing: 6px;
            line-height: 1;
            color: var(--white);
            text-shadow: 0 4px 24px rgba(0,0,0,0.25);
            position: relative;
            z-index: 1;
        }

        .brand-tagline {
            font-size: 16px;
            font-weight: 300;
            line-height: 1.5;
            margin-top: 12px;
            color: rgba(255,255,255,0.85);
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .divider-line {
            width: 50px;
            height: 2px;
            background: rgba(255,255,255,0.35);
            border-radius: 2px;
            margin: 24px auto;
            position: relative;
            z-index: 1;
        }

        .btn-signup-link {
            margin-top: 8px;
            background: rgba(255,255,255,0.12);
            border: 1.5px solid rgba(255,255,255,0.35);
            color: var(--white);
            padding: 11px 48px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 1.5px;
            display: inline-block;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(6px);
        }

        .btn-signup-link:hover {
            background: rgba(255,255,255,0.22);
            transform: translateY(-2px);
        }

        /* ===================== FORM PANEL (kanan) ===================== */
        .form-panel {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 60px 48px 40px 48px;
            overflow-y: auto;
            background: var(--bg-page);
        }

        .login-box {
            width: 100%;
            max-width: 480px;
        }

        .login-box h2 {
            color: var(--text-label);
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .login-box .subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 13.5px;
            margin-bottom: 28px;
        }

        /* ===================== ERROR / SUCCESS ===================== */
        .error-box {
            background: var(--error-bg);
            color: var(--sidebar-mid);
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            border-left: 4px solid var(--error-border);
        }

        .success-box {
            background: #e8f8e8;
            color: #1e7e34;
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            border-left: 4px solid #4CAF50;
        }

        /* ===================== FORM FIELDS ===================== */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            color: var(--text-label);
            font-size: 13.5px;
            margin-bottom: 6px;
            font-weight: 600;
            letter-spacing: 0.2px;
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

        /* ===================== FORM FOOTER ===================== */
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0 20px 0;
            font-size: 13px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 7px;
            color: var(--text-label);
            font-weight: 500;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            appearance: none;
            width: 17px;
            height: 17px;
            border: 1.5px solid var(--accent-light);
            border-radius: 4px;
            background: var(--input-bg);
            cursor: pointer;
            position: relative;
            transition: border-color 0.2s;
            flex-shrink: 0;
        }

        .remember-me input[type="checkbox"]:checked {
            background: var(--accent-blue);
            border-color: var(--accent-blue);
        }

        .remember-me input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            left: 3px;
            top: 0px;
            width: 5px;
            height: 9px;
            border: 2px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
        }

        .reset-link {
            color: var(--accent-blue);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.2s;
        }

        .reset-link:hover {
            color: var(--sidebar-mid);
            text-decoration: underline;
        }

        /* ===================== SUBMIT BUTTON ===================== */
        .btn-signin-container {
            text-align: center;
            margin-top: 8px;
        }

        .btn-signin {
            background: linear-gradient(135deg, var(--sidebar-mid) 0%, var(--accent-blue) 100%);
            color: var(--white);
            border: none;
            padding: 13px 64px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 2px;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(26, 79, 156, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-signin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 79, 156, 0.45);
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 820px) {
            body {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }

            .branding-panel {
                width: 100%;
                height: auto;
                padding: 40px 24px;
            }

            .brand-logo {
                font-size: 60px;
            }

            .form-panel {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>

    <!-- ===== BRANDING PANEL (kiri) ===== -->
    <div class="branding-panel">
        <div class="brand-logo">SISD</div>
        <div class="divider-line"></div>
        <p class="brand-tagline">Sistem Informasi Skrining Diet</p>
        <a href="/register" class="btn-signup-link">SIGN UP</a>
    </div>

    <!-- ===== FORM PANEL (kanan) ===== -->
    <div class="form-panel">
        <div class="login-box">
            <h2>Sign In</h2>
            <p class="subtitle">Selamat datang kembali di SISD</p>

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="error-box">{{ $errors->first() }}</div>
                @endif
                @if (session('success'))
                    <div class="success-box">{{ session('success') }}</div>
                @endif

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@contoh.com" required>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24">
                            <path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                        </svg>
                        <input type="password" name="password" placeholder="Masukkan password Anda" required>
                    </div>
                </div>

                <!-- Remember Me & Lupa Password -->
                <div class="form-footer">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                    <a href="{{ route('lupa.password') }}" class="reset-link">Lupa Password?</a>
                </div>

                <div class="btn-signin-container">
                    <button type="submit" class="btn-signin">SIGN IN</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>