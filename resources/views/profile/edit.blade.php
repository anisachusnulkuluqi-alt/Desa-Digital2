<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profile - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; }
        
        /* Sidebar - sama dengan halaman lain */
        .sidebar { width: 260px; background: #0f172a; min-height: 100vh; position: fixed; left: 0; top: 0; padding: 20px 14px; z-index: 100; }
        .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
        .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; }
        .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
        .sidebar-brand-text small { color: #64748b; font-size: 10px; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: #2563eb; color: white; }
        .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
        
        .main-content { margin-left: 260px; }
        
        /* Top Header */
        .top-header { background: white; border-bottom: 1px solid #e2e8f0; padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 99; }
        .breadcrumb { margin: 0; font-size: 13px; }
        .breadcrumb a { color: #64748b; text-decoration: none; }
        .breadcrumb a:hover { color: #1e3a8a; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        
        .header-user { display: flex; align-items: center; gap: 10px; padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; }
        .header-user-avatar { width: 32px; height: 32px; border-radius: 8px; background: #1e3a8a; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px; }
        .header-user-name { font-size: 12px; font-weight: 600; color: #1e293b; }
        
        /* Page Body */
        .page-body { padding: 28px; max-width: 1200px; }
        
        .page-header { margin-bottom: 24px; }
        .page-label { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
        .page-title { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 6px; }
        .page-subtitle { font-size: 13px; color: #64748b; }
        
        /* Profile Layout */
        .profile-layout { display: grid; grid-template-columns: 320px 1fr; gap: 24px; }
        
        /* Profile Card */
        .profile-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
        .profile-card-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); padding: 30px 20px; text-align: center; position: relative; }
        .profile-avatar { width: 100px; height: 100px; border-radius: 50%; background: white; display: flex; align-items: center; justify-content: center; color: #1e3a8a; font-size: 40px; font-weight: 800; margin: 0 auto 12px; border: 4px solid rgba(255,255,255,0.3); }
        .profile-name { color: white; font-size: 18px; font-weight: 700; margin-bottom: 4px; }
        .profile-email { color: rgba(255,255,255,0.8); font-size: 12px; }
        .profile-role { display: inline-block; margin-top: 12px; padding: 4px 12px; background: rgba(255,255,255,0.2); color: white; border-radius: 20px; font-size: 11px; font-weight: 600; }
        
        .profile-info { padding: 20px; }
        .profile-info-item { display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f1f5f9; }
        .profile-info-item:last-child { border-bottom: none; }
        .profile-info-icon { width: 36px; height: 36px; border-radius: 8px; background: #dbeafe; display: flex; align-items: center; justify-content: center; color: #1e40af; font-size: 16px; flex-shrink: 0; }
        .profile-info-label { font-size: 11px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.3px; }
        .profile-info-value { font-size: 13px; color: #1e293b; font-weight: 600; }
        
        /* Form Card */
        .form-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 24px; margin-bottom: 20px; }
        .form-card-title { font-size: 16px; font-weight: 700; color: #1e293b; margin-bottom: 4px; display: flex; align-items: center; gap: 10px; }
        .form-card-title i { color: #1e3a8a; font-size: 18px; }
        .form-card-subtitle { font-size: 13px; color: #64748b; margin-bottom: 20px; }
        
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-input { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; }
        .form-input:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        
        .btn-save { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 600; }
        .alert-success i { font-size: 16px; color: #16a34a; }
        
        @media (max-width: 992px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } .profile-layout { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon"><i class="bi bi-house-heart-fill"></i></div>
            <div class="sidebar-brand-text">
                <h5>Desa Digital</h5>
                <small>Admin pengelola data</small>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="bi bi-house-fill"></i><span>Beranda</span></a></li>
            <li><a href="{{ route('admin.kecamatan.index') }}"><i class="bi bi-geo-alt-fill"></i><span>Kecamatan</span></a></li>
            <li><a href="{{ route('admin.desa.index') }}"><i class="bi bi-houses-fill"></i><span>Desa</span></a></li>
            <li><a href="{{ route('admin.wisata.index') }}"><i class="bi bi-image-fill"></i><span>Wisata Desa</span></a></li>
            <li><a href="{{ route('admin.pasar.index') }}"><i class="bi bi-shop"></i><span>Pasar Desa</span></a></li>
            <li><a href="{{ route('admin.kantor.index') }}"><i class="bi bi-building"></i><span>Kantor Desa</span></a></li>
            <li><a href="{{ route('admin.wifi.index') }}"><i class="bi bi-wifi"></i><span>WiFi Desa</span></a></li>
            <li><a href="{{ route('admin.bumdes.index') }}"><i class="bi bi-briefcase-fill"></i><span>BUMDes</span></a></li>
            <li><a href="{{ route('admin.kkdmp.index') }}"><i class="bi bi-people-fill"></i><span>KKDMP</span></a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="top-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Admin</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
            <div class="header-user">
                <div class="header-user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                <div class="header-user-name">{{ Auth::user()->name ?? 'Admin Desa Digital' }}</div>
            </div>
        </header>

        <div class="page-body">
            <div class="page-header">
                <div class="page-label">AKUN SAYA</div>
                <h1 class="page-title">Profile</h1>
                <p class="page-subtitle">Kelola informasi profil dan keamanan akun Anda</p>
            </div>

            @if(session('status') === 'profile-updated')
            <div class="alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>Profile berhasil diperbarui!</span>
            </div>
            @endif

            <div class="profile-layout">
                <!-- Profile Card Kiri -->
                <div class="profile-card">
                    <div class="profile-card-header">
                        <div class="profile-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                        <div class="profile-name">{{ Auth::user()->name }}</div>
                        <div class="profile-email">{{ Auth::user()->email }}</div>
                        <div class="profile-role">
                            <i class="bi bi-shield-check"></i> Administrator
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-info-item">
                            <div class="profile-info-icon"><i class="bi bi-calendar-check"></i></div>
                            <div>
                                <div class="profile-info-label">Member Sejak</div>
                                <div class="profile-info-value">{{ Auth::user()->created_at->format('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-icon"><i class="bi bi-envelope-check"></i></div>
                            <div>
                                <div class="profile-info-label">Status Email</div>
                                <div class="profile-info-value">
                                    @if(Auth::user()->email_verified_at)
                                        <span style="color: #16a34a;">✓ Terverifikasi</span>
                                    @else
                                        <span style="color: #f59e0b;">⚠ Belum Verifikasi</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="profile-info-item">
                            <div class="profile-info-icon"><i class="bi bi-clock"></i></div>
                            <div>
                                <div class="profile-info-label">Terakhir Aktif</div>
                                <div class="profile-info-value">Baru saja</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Kanan -->
                <div>
                    <!-- Update Profile -->
                    <div class="form-card">
                        <h2 class="form-card-title">
                            <i class="bi bi-person-circle"></i>
                            Informasi Profile
                        </h2>
                        <p class="form-card-subtitle">Perbarui nama dan alamat email akun Anda.</p>
                        
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')
                            
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" name="name" class="form-input" value="{{ old('name', Auth::user()->name) }}" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-input" value="{{ old('email', Auth::user()->email) }}" required>
                            </div>
                            
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-lg"></i>
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>

                    <!-- Update Password -->
                    <div class="form-card">
                        <h2 class="form-card-title">
                            <i class="bi bi-lock"></i>
                            Ubah Password
                        </h2>
                        <p class="form-card-subtitle">Pastikan akun Anda menggunakan password yang kuat dan aman.</p>
                        
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            
                            <div class="form-group">
                                <label class="form-label">Password Saat Ini</label>
                                <input type="password" name="current_password" class="form-input" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Password Baru</label>
                                <input type="password" name="password" class="form-input" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-input" required>
                            </div>
                            
                            <button type="submit" class="btn-save">
                                <i class="bi bi-shield-check"></i>
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>