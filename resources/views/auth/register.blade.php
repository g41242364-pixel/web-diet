<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Create Account</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary-blue: #90D2ED;
            --text-color: #7BB9D8;
            --input-bg: #B5E2F4;
            --white: #ffffff;
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
            align-items: center;
            justify-content: center;
            background-color: #f0f2f5;
        }

        .main-container {
            display: flex;
            width: 100%;
            height: 100vh;
            background: var(--white);
            overflow: hidden;
        }

        .form-panel {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .branding-panel {
            flex: 1;
            background: linear-gradient(to bottom, #90D2ED 0%, #E0F4FB 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: var(--white);
            text-align: center;
            padding: 40px;
        }

        .branding-panel h1 {
            font-size: 100px;
            font-weight: 800;
            letter-spacing: 5px;
            margin-bottom: 0;
            line-height: 1;
        }

        .branding-panel p {
            font-size: 28px;
            max-width: 300px;
            line-height: 1.2;
            margin-top: 10px;
            font-weight: 300;
        }

        .btn-signin-link {
            margin-top: 40px;
            background: var(--white);
            color: var(--text-color);
            border: none;
            padding: 12px 60px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 400;
            font-size: 22px;
            display: inline-block;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        .btn-signin-link:hover {
            transform: scale(1.05);
        }

        .register-box {
            width: 100%;
            max-width: 500px;
        }

        .register-box h2 {
            color: var(--text-color);
            font-size: 42px;
            text-align: center;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            color: var(--text-color);
            font-size: 18px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 12px 12px 45px;
            background-color: var(--input-bg);
            border: none;
            border-radius: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #555;
            font-size: 16px;
        }

        .input-wrapper svg {
            position: absolute;
            left: 12px;
            width: 20px;
            height: 20px;
            fill: var(--white);
        }

        .flex-row {
            display: flex;
            gap: 20px;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .umur-group {
            width: 100px;
        }

        .umur-input {
            width: 100%;
            padding: 2px;
            border: 2px solid #ccc;
            border-radius: 4px;
            background: white;
            text-align: center;
            font-size: 14px;
            color: #999;
        }

        .gender-group label {
            margin-bottom: 10px;
        }

        .gender-options {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .gender-option {
            display: flex;
            align-items: center;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
        }

        .gender-option input {
            appearance: none;
            width: 22px;
            height: 22px;
            border: 2px solid var(--text-color);
            border-radius: 50%;
            margin-right: 8px;
            position: relative;
            cursor: pointer;
        }

        .gender-option input:checked::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 12px;
            height: 12px;
            background-color: var(--text-color);
            border-radius: 50%;
        }

        .btn-signup-container {
            text-align: center;
            margin: 25px 0;
        }

        .btn-signup {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 10px 60px;
            border-radius: 20px;
            font-size: 20px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin-bottom: 20px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #333;
        }

        .divider span {
            padding: 0 10px;
            font-weight: bold;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .social-icon {
            width: 35px;
            height: 35px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column-reverse;
            }

            .branding-panel {
                flex: none;
                height: 35vh;
            }

            .branding-panel h1 {
                font-size: 60px;
            }

            .form-panel {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="main-container">

        <div class="form-panel">
            <div class="register-box">
                <h2>Create Account</h2>

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div
                            style="background:#fde8e8;color:#c0392b;padding:10px 14px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap Anda" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="email@contoh.com" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                            </svg>
                            <input type="password" name="password" placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                            </svg>
                            <input type="password" name="password_confirmation" placeholder="Ulangi password Anda" required>
                        </div>
                    </div>

                    <div class="flex-row">
                        <div class="umur-group">
                            <label style="color: var(--text-color);">Umur</label>
                            <input type="number" name="umur" class="umur-input" placeholder="0"
                                value="{{ old('umur') }}" required>
                        </div>
                        <div class="gender-group">
                            <label style="color: var(--text-color);">Jenis Kelamin</label>
                            <div class="gender-options">
                                <label class="gender-option">
                                    <input type="radio" name="jenis_kelamin" value="L"
                                        {{ old('jenis_kelamin') == 'L' ? 'checked' : 'checked' }}> Laki-laki
                                </label>
                                <label class="gender-option">
                                    <input type="radio" name="jenis_kelamin" value="P"
                                        {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}> Perempuan
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

        <div class="branding-panel">
            <h1>SISD</h1>
            <p>Sistem Informasi Skrining Diet</p>
            <a href="/" class="btn-signin-link">SIGN IN</a>
        </div>
    </div>

</body>

</html>
