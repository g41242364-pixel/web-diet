<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Create Account</title>
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

        /* ===================== BRANDING PANEL ===================== */
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

        .btn-signin-link {
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

        .btn-signin-link:hover {
            background: rgba(255,255,255,0.22);
            transform: translateY(-2px);
        }

        /* ===================== FORM PANEL ===================== */
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

        .register-box {
            width: 100%;
            max-width: 480px;
        }

        .register-box h2 {
            color: var(--text-label);
            font-size: 32px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .register-box .subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 13.5px;
            margin-bottom: 28px;
        }

        /* ===================== ERROR ===================== */
        .error-box {
            background: var(--error-bg);
            color: var(--sidebar-mid);
            padding: 10px 14px;
            border-radius: 8px;
            margin-bottom: 18px;
            font-size: 13px;
            border-left: 4px solid var(--error-border);
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

        /* ===================== FLEX ROW (Umur + Gender) ===================== */
        .flex-row {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .umur-group {
            flex: 1;
        }

        .umur-group label,
        .gender-group label {
            display: block;
            color: var(--text-label);
            font-size: 13.5px;
            margin-bottom: 6px;
            font-weight: 600;
        }

        .umur-input {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            background: var(--input-bg);
            text-align: center;
            font-size: 14px;
            color: var(--text-label);
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .umur-input::placeholder {
            color: #7BAFD4;
            font-weight: 300;
        }

        .umur-input:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(43, 127, 212, 0.15);
            background: var(--white);
        }

        /* ===================== GENDER as SELECT ===================== */
        .gender-group {
            flex: 1;
        }

        .gender-select {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            background: var(--input-bg);
            font-size: 14px;
            color: var(--text-label);
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%235BA8E8' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .gender-select:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(43, 127, 212, 0.15);
            background-color: var(--white);
        }

        /* ===================== SUBMIT BUTTON ===================== */
        .btn-signup-container {
            text-align: center;
            margin-top: 8px;
        }

        .btn-signup {
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

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(26, 79, 156, 0.45);
        }

        /* ===================== RESPONSIVE ===================== */
        @media (max-width: 820px) {
            .branding-panel {
                width: 100%;
                height: auto;
                padding: 40px 24px;
            }

            .brand-logo {
                font-size: 60px;
            }

            body {
                flex-direction: column-reverse;
                height: auto;
                min-height: 100vh;
            }

            .form-panel {
                padding: 32px 24px;
            }
        }
    </style>
</head>

<body>

    <!-- ===== FORM PANEL (kiri) ===== -->
    <div class="form-panel">
        <div class="register-box">
            <h2>Create Account</h2>
            <p class="subtitle">Daftarkan diri Anda untuk mulai menggunakan SISD</p>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="error-box">{{ $errors->first() }}</div>
                @endif

                <!-- Nama Lengkap -->
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" required>
                    </div>
                </div>

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
                        <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <div class="input-wrapper">
                        <svg viewBox="0 0 24 24">
                            <path d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                        </svg>
                        <input type="password" name="password_confirmation" placeholder="Ulangi password Anda" required>
                    </div>
                </div>

                <!-- Umur + Jenis Kelamin -->
                <div class="flex-row">
                    <div class="umur-group">
                        <label>Umur</label>
                        <input type="number" name="umur" class="umur-input"
                            value="{{ old('umur') }}" placeholder="20" min="1" max="120" required>
                    </div>
                    <div class="gender-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="gender-select" required>
                            <option value="L" {{ old('jenis_kelamin', 'L') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="btn-signup-container">
                    <button type="submit" class="btn-signup">SIGN UP</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== BRANDING PANEL (kanan) ===== -->
    <div class="branding-panel">
        <div class="brand-logo">SISD</div>
        <div class="divider-line"></div>
        <p class="brand-tagline">Sistem Informasi Skrining Diet</p>
        <a href="/" class="btn-signin-link">SIGN IN</a>
    </div>

</body>

</html>