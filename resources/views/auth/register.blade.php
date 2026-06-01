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
            /* Senada dengan layout pengguna — biru teal yang lebih dalam */
            --sidebar-dark:   #1A3C4E;
            --sidebar-mid:    #2A5F7A;
            --accent-teal:    #3A8CA8;
            --accent-light:   #5BB8D4;
            --highlight:      #7DD3EC;
            --input-bg:       #EAF6FB;
            --input-border:   #A8DCF0;
            --text-label:     #1E4D64;
            --text-muted:     #5A8EA3;
            --white:          #ffffff;
            --bg-page:        #F0F8FC;
            --error-bg:       #D6EEF8;
            --error-border:   #5BB8D4;
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
            background: linear-gradient(160deg, var(--sidebar-dark) 0%, var(--sidebar-mid) 50%, var(--accent-teal) 100%);
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

        /* Dekoratif lingkaran di background */
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
            justify-content: center;
            align-items: center;
            padding: 40px 48px;
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
            color: #9BCAD9;
            font-weight: 300;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--accent-teal);
            box-shadow: 0 0 0 3px rgba(58, 140, 168, 0.15);
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
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .umur-group {
            flex: 0 0 110px;
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
            padding: 11px 10px;
            border: 1.5px solid var(--input-border);
            border-radius: 10px;
            background: var(--input-bg);
            text-align: center;
            font-size: 14px;
            color: var(--text-label);
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .umur-input::placeholder {
            color: #9BCAD9;
            font-weight: 300;
        }

        .umur-input:focus {
            outline: none;
            border-color: var(--accent-teal);
            box-shadow: 0 0 0 3px rgba(58, 140, 168, 0.15);
            background: var(--white);
        }

        /* ===================== GENDER ===================== */
        .gender-group {
            flex: 1;
        }

        .gender-options {
            display: flex;
            gap: 12px;
            align-items: center;
            padding-top: 2px;
        }

        .gender-option {
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-label);
        }

        .gender-option input {
            appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid var(--accent-light);
            border-radius: 50%;
            position: relative;
            cursor: pointer;
            flex-shrink: 0;
            background: var(--input-bg);
            transition: border-color 0.2s;
        }

        .gender-option input:checked {
            border-color: var(--accent-teal);
        }

        .gender-option input:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            background: var(--accent-teal);
            border-radius: 50%;
        }

        /* ===================== SUBMIT BUTTON ===================== */
        .btn-signup-container {
            text-align: center;
            margin-top: 8px;
        }

        .btn-signup {
            background: linear-gradient(135deg, var(--sidebar-mid) 0%, var(--accent-teal) 100%);
            color: var(--white);
            border: none;
            padding: 13px 64px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 2px;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(42, 95, 122, 0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-signup:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(42, 95, 122, 0.45);
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
                        <input type="number" name="umur" class="umur-input" placeholder="Contoh: 20"
                            value="{{ old('umur') }}" required>
                    </div>
                    <div class="gender-group">
                        <label>Jenis Kelamin</label>
                        <div class="gender-options">
                            <label class="gender-option">
                                <input type="radio" name="jenis_kelamin" value="L"
                                    {{ old('jenis_kelamin', 'L') == 'L' ? 'checked' : '' }}>
                                Laki-laki
                            </label>
                            <label class="gender-option">
                                <input type="radio" name="jenis_kelamin" value="P"
                                    {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>
                                Perempuan
                            </label>
                        </div>
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
