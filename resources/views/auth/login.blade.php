<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Petugas - Desa Digital Kabupaten Tuban</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0b1325;
            padding: 30px 16px;
        }
        .login-card {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 440px;
            padding: 36px 32px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }
        .brand-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .brand-header img {
            width: 44px;
            height: 52px;
            object-fit: contain;
            margin-bottom: 12px;
            filter: drop-shadow(0 2px 6px rgba(14, 165, 233, 0.3));
        }
        .brand-header h2 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #0f172a;
        }
        .brand-header p {
            font-size: 0.82rem;
            color: #64748b;
            margin-top: 4px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        .form-group label {
            display: block;
            font-size: 0.82rem;
            font-weight: 700;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.88rem;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus {
            border-color: #0284c7;
        }
        
        .password-input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .password-input-wrap input {
            padding-right: 42px;
        }
        .btn-toggle-eye {
            position: absolute;
            right: 12px;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 0.95rem;
            cursor: pointer;
            padding: 4px 6px;
            transition: color 0.2s;
        }
        .btn-toggle-eye:hover {
            color: #0284c7;
        }

        .error-msg {
            color: #ef4444;
            font-size: 0.76rem;
            margin-top: 4px;
            display: block;
            font-weight: 600;
        }
        .btn-submit {
            width: 100%;
            background: #0284c7;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.9rem;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-submit:hover {
            background: #0369a1;
        }
        .footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 0.84rem;
            color: #64748b;
        }
        .footer-link a {
            color: #0284c7;
            text-decoration: none;
            font-weight: 700;
        }
        .footer-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="brand-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Lambang_Kabupaten_Tuban.png/300px-Lambang_Kabupaten_Tuban.png" 
                 alt="Logo Kabupaten Tuban"
                 onerror="this.onerror=null; this.src='https://tubankab.go.id/images/logo.png';">
            <h2>Masuk Petugas</h2>
            <p>Portal Pelayanan Ekosistem Desa Digital Kabupaten Tuban</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                @error('email')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="password-input-wrap">
                    <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required autocomplete="current-password">
                    <button type="button" class="btn-toggle-eye" onclick="togglePasswordVisibility('password', 'eyeIconLogin')" title="Lihat/Sembunyikan Sandi">
                        <i class="fa-solid fa-eye-slash" id="eyeIconLogin"></i>
                    </button>
                </div>
                @error('password')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                Masuk
            </button>
        </form>

        <div class="footer-link">
            Belum memiliki akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconId) {
            const inputField = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (inputField.type === 'password') {
                inputField.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                inputField.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>