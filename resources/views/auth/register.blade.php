<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Portal Desa Digital</title>
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .auth-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(30, 136, 229, 0.1);
            border: 1px solid #e2e8f0;
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-header .icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #1e88e5, #00897b);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: white;
            font-size: 28px;
        }
        .auth-header h2 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .auth-header p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }
        .form-group { margin-bottom: 18px; }
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .form-control {
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            background-color: #f8fafc;
        }
        .form-control:focus {
            border-color: #1e88e5;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.1);
        }
        .btn-register {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #1e88e5, #00897b);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(30, 136, 229, 0.3);
            color: white;
        }
        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 14px;
            color: #64748b;
        }
        .auth-footer a {
            color: #1e88e5;
            text-decoration: none;
            font-weight: 600;
        }
        .auth-footer a:hover { text-decoration: underline; }
        
        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .alert-danger ul { margin-bottom: 0; padding-left: 20px; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <div class="icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h2>Daftar Akun Baru</h2>
            <p>Bergabung dengan Portal Desa Digital Kabupaten Tuban</p>
        </div>

        {{-- Tampilkan Error Validasi --}}
        @if ($errors->any())
        <div class="alert-danger">
            <strong><i class="bi bi-exclamation-triangle-fill"></i> Terjadi kesalahan:</strong>
            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form Register --}}
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" 
                       class="form-control" 
                       id="name" 
                       name="name" 
                       value="{{ old('name') }}" 
                       placeholder="Masukkan nama lengkap"
                       required 
                       autofocus>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       placeholder="nama@contoh.com"
                       required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password" 
                       name="password" 
                       placeholder="Minimal 8 karakter"
                       required>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" 
                       class="form-control" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       placeholder="Ulangi password"
                       required>
            </div>

            <button type="submit" class="btn-register">
                <i class="bi bi-check-circle"></i> Daftar Sekarang
            </button>
        </form>

        <div class="auth-footer">
            Sudah memiliki akun? <a href="{{ route('login') }}">Masuk di sini</a>
            <br>
            <a href="{{ route('home') }}" class="text-muted" style="font-size: 12px; margin-top: 10px; display: inline-block;">
                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>