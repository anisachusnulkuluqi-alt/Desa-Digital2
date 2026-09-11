<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun - Desa Digital Tuban</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0284c7;
            --primary-hover: #0369a1;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-ui: #cbd5e1;
            --bg-body: #f1f5f9;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--bg-body);
            padding: 24px 16px;
        }

        .reg-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.07);
            padding: 32px 28px;
        }

        .reg-header {
            text-align: center;
            margin-bottom: 22px;
        }

        .logo-icon {
            width: 46px;
            height: 46px;
            background: var(--primary);
            color: #ffffff;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 12px;
        }

        .reg-header h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 4px;
        }

        .reg-header p {
            font-size: 0.84rem;
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 14px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 5px;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper input,
        .input-wrapper select {
            width: 100%;
            padding: 10px 38px 10px 12px;
            font-size: 0.88rem;
            border: 1px solid var(--border-ui);
            border-radius: 8px;
            outline: none;
            color: var(--text-dark);
            background: #ffffff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input-wrapper select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 14px;
        }

        .input-wrapper input:focus,
        .input-wrapper select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .toggle-password {
            position: absolute;
            right: 12px;
            color: #94a3b8;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .toggle-password:hover {
            color: var(--text-dark);
        }

        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 11px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: var(--primary-hover);
        }

        .reg-footer {
            margin-top: 20px;
            padding-top: 14px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .reg-footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        .reg-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="reg-card">
        <div class="reg-header">
            <div class="logo-icon">
                <i class="fa-solid fa-id-card"></i>
            </div>
            <h2>Pendaftaran Akun</h2>
            <p>Portal Registrasi Layanan Terpadu</p>
        </div>

        <form onsubmit="event.preventDefault(); alert('Pratinjau Front-End Selesai!');">
            
            <!-- Nama Lengkap -->
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <div class="input-wrapper">
                    <input type="text" id="nama" placeholder="Masukkan nama lengkap" required>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" placeholder="nama@email.com" required>
                </div>
            </div>

            <!-- Tingkat Wilayah -->
            <div class="form-group">
                <label for="wilayah">Tingkat Wilayah</label>
                <div class="input-wrapper">
                    <select id="wilayah" required>
                        <option value="" disabled selected>Pilih Tingkat Wilayah</option>
                        <option value="kabupaten">Kabupaten (Diskominfo SP)</option>
                        <option value="kecamatan">Kecamatan</option>
                        <option value="desa">Desa / Kelurahan</option>
                    </select>
                </div>
            </div>

            <!-- Kata Sandi -->
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password" placeholder="Minimal 8 karakter" required>
                    <i class="fa-regular fa-eye-slash toggle-password" onclick="togglePass('password', this)"></i>
                </div>
            </div>

            <!-- Konfirmasi Sandi -->
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" placeholder="Ulangi kata sandi" required>
                    <i class="fa-regular fa-eye-slash toggle-password" onclick="togglePass('password_confirmation', this)"></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">Daftar Akun</button>
        </form>

        <div class="reg-footer">
            Sudah memiliki akun? <a href="/login">Masuk di sini</a>
        </div>
    </div>

    <script>
        function togglePass(id, el) {
            const input = document.getElementById(id);
            if (input.type === 'password') {
                input.type = 'text';
                el.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = 'password';
                el.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>
</html>