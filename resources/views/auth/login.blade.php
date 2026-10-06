<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#e9edf5">
    <title>Masuk - Desa Digital Kabupaten Tuban</title>
    <style>
        :root {
            color-scheme: light;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            color: #20283a;
            background: #e9edf5;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
        }
        * { box-sizing: border-box; }
        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 28px 18px;
            background:
                radial-gradient(ellipse at 12% 8%, rgba(90, 112, 168, .13), transparent 36%),
                radial-gradient(ellipse at 92% 90%, rgba(130, 104, 181, .12), transparent 36%),
                linear-gradient(145deg, #f6f6f8, #e7ebf3);
        }
        .auth-card {
            width: min(100%, 460px);
            padding: 38px 42px;
            border: 1px solid rgba(255, 255, 255, .85);
            border-radius: 26px;
            background: rgba(255, 255, 255, .94);
            box-shadow: 0 24px 60px rgba(32, 42, 63, .14);
        }
        .brand {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 7px;
            margin-bottom: 30px;
            text-align: center;
        }
        .brand img {
            width: 58px;
            height: 70px;
            object-fit: contain;
            filter: drop-shadow(0 4px 5px rgba(26, 39, 68, .12));
        }
        .brand-name {
            color: #202b43;
            font-size: 19px;
            font-weight: 750;
            letter-spacing: -.4px;
            line-height: 1.35;
            text-transform: none;
        }
        .brand-name span {
            display: block;
            margin-top: 3px;
            color: #727b8e;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .heading { margin-bottom: 26px; text-align: center; }
        .heading h1 {
            margin: 0 0 8px;
            color: #222c43;
            font-size: 24px;
            letter-spacing: -.6px;
        }
        .heading p {
            margin: 0;
            color: #737d90;
            font-size: 13px;
            line-height: 1.6;
        }
        .form-group { margin-bottom: 18px; }
        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #535d70;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .55px;
            text-transform: uppercase;
        }
        .form-group input {
            display: block;
            width: 100%;
            min-height: 46px;
            padding: 11px 13px;
            border: 1px solid #d7ddea;
            border-radius: 12px;
            outline: none;
            background: #eaf0fb;
            color: #242d42;
            font: inherit;
            font-size: 13px;
            transition: border-color .18s, box-shadow .18s, background .18s;
        }
        .form-group input::placeholder { color: #8a94a8; }
        .form-group input:focus {
            border-color: #7776bc;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(119, 118, 188, .15);
        }
        .password-wrap { position: relative; }
        .password-wrap input { padding-right: 70px; }
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            padding: 7px 5px;
            border: 0;
            background: transparent;
            color: #596d9f;
            cursor: pointer;
            font: inherit;
            font-size: 11px;
            font-weight: 700;
        }
        .password-toggle:hover { color: #705da7; }
        .password-toggle:focus-visible, .submit-button:focus-visible, a:focus-visible {
            outline: 3px solid rgba(113, 103, 173, .32);
            outline-offset: 3px;
        }
        .error-msg {
            display: block;
            margin-top: 6px;
            color: #b42318;
            font-size: 12px;
        }
        .submit-button {
            width: 100%;
            min-height: 47px;
            margin-top: 4px;
            border: 0;
            border-radius: 10px;
            background: linear-gradient(110deg, #30394d, #283c65 65%, #65548c);
            box-shadow: 0 9px 20px rgba(42, 53, 80, .23);
            color: #fff;
            cursor: pointer;
            font: inherit;
            font-size: 13px;
            font-weight: 750;
            transition: transform .18s, box-shadow .18s;
        }
        .submit-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 12px 24px rgba(42, 53, 80, .29);
        }
        .auth-footer {
            margin: 22px 0 0;
            color: #737d90;
            font-size: 12px;
            text-align: center;
        }
        .auth-footer a {
            color: #514f91;
            font-weight: 750;
            text-decoration: none;
        }
        .auth-footer a:hover { text-decoration: underline; }
        @media (max-width: 480px) {
            .auth-card { padding: 30px 24px; border-radius: 20px; }
            .brand { margin-bottom: 25px; }
        }
    </style>
</head>
<body>
    <main class="auth-card">
        <div class="brand">
            <img src="{{ asset('images/logo-tuban.png') }}" alt="Logo Kabupaten Tuban">
            <div class="brand-name">
                Desa Digital
                <span>Portal Kabupaten Tuban</span>
            </div>
        </div>

        <header class="heading">
            <h1>Selamat datang</h1>
        </header>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Alamat email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus autocomplete="username">
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata sandi</label>
                <div class="password-wrap">
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                    <button type="button" class="password-toggle" data-password-toggle="password" aria-label="Lihat kata sandi" aria-pressed="false">Lihat</button>
                </div>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="submit-button">Masuk ke akun</button>
        </form>

        <p class="auth-footer">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </main>

    <script>
        document.querySelectorAll('[data-password-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.passwordToggle);
                const showPassword = input.type === 'password';

                input.type = showPassword ? 'text' : 'password';
                button.textContent = showPassword ? 'Sembunyi' : 'Lihat';
                button.setAttribute('aria-label', showPassword ? 'Sembunyikan kata sandi' : 'Lihat kata sandi');
                button.setAttribute('aria-pressed', String(showPassword));
            });
        });
    </script>
</body>
</html>
