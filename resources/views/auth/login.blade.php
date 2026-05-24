<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISD - Sign In</title>

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

        .left-panel {
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

        .left-panel h1 {
            font-size: 100px;
            font-weight: 800;
            letter-spacing: 5px;
            margin-bottom: 0;
            line-height: 1;
        }

        .left-panel p {
            font-size: 28px;
            max-width: 300px;
            line-height: 1.2;
            margin-top: 10px;
            font-weight: 300;
        }

        .btn-signup {
            margin-top: 40px;
            background: var(--white);
            color: var(--text-color);
            border : none;
            padding: 12px 60px;
            border-radius: 15px;
            text-decoration: none;
            font-weight: 400;
            font-size: 22px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: background 0.3s, transform 0.2s;
        }

        .btn-signup:hover {
            transform: scale(1.05);
        }

        .right-panel {
            flex: 1.2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }

        .login-box {
            width: 100%;
            max-width: 450px;
        }

        .login-box h2 {
            color: var(--text-color);
            font-size: 42px;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            color: var(--text-color);
            font-size: 18px;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input {
            width: 100%;
            padding: 15px 15px 15px 50px;
            background-color: var(--input-bg);
            border: none;
            border-radius: 4px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #555;
            font-size: 16px;
        }

        .input-wrapper svg {
            position: absolute;
            left: 15px;
            width: 20px;
            height: 20px;
            fill: var(--white);
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            color: var(--text-color);
        }

        .remember-me input {
            margin-right: 8px;
            width: 18px;
            height: 18px;
            border: 2px solid var(--text-color);
            border-radius: 50%;
            cursor: pointer;
        }

        .reset-link {
            color: var(--text-color);
            text-decoration: none;
        }

        .btn-signin-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-signin {
            background-color: var(--primary-blue);
            color: var(--white);
            border: none;
            padding: 12px 60px;
            border-radius: 15px;
            font-size: 22px;
            font-weight: 400;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background 0.3s;
        }

        .btn-signin:hover {
            background-color: #79c5e4;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin-bottom: 30px;
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
            color: #333;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 40px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .social-icon:hover {
            opacity: 0.7;
        }

        .social-icon img {
            width: 100%;
            height: auto;
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .left-panel {
                flex: none;
                height: 40vh;
                padding: 20px;
            }

            .left-panel h1 {
                font-size: 60px;
            }

            .left-panel p {
                font-size: 18px;
            }

            .right-panel {
                padding: 20px;
            }

            .login-box h2 {
                font-size: 32px;
            }
        }
    </style>
</head>

<body>

    <div class="main-container">

        <div class="left-panel">
            <h1>SISD</h1>
            <p>Sistem Informasi Skrining Diet</p>
            <a href="/register" class="btn-signup">SIGN UP</a>
        </div>


        <div class="right-panel">
            <div class="login-box">
                <h2>SIGN IN TO SISD</h2>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf

                    @if ($errors->any())
                        <div
                            style="background:#fde8e8;color:#c0392b;padding:10px 14px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div
                            style="background:#e8f8e8;color:#27ae60;padding:10px 14px;border-radius:8px;margin-bottom:16px;font-size:13px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label>Your Email</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
                            </svg>
                            <input type="password" name="password" required>
                        </div>
                    </div>

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
    </div>

</body>

</html>
