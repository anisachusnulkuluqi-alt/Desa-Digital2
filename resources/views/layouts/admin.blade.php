<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal Desa Digital')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }
        
        body {
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }
        
        /* Header */
        .admin-header {
            background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
        }
        
        .header-logo-icon {
            width: 45px;
            height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .header-logo-text h4 {
            margin: 0;
            font-weight: 800;
            font-size: 18px;
            color: white;
        }
        
        .header-logo-text small {
            color: rgba(255,255,255,0.8);
            font-size: 12px;
        }
        
        .header-search {
            flex: 1;
            max-width: 500px;
            margin: 0 30px;
        }
        
        .header-search input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            background: white;
        }
        
        .header-search-wrapper {
            position: relative;
        }
        
        .header-search-wrapper i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        
        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
            color: white;
            cursor: pointer;
            position: relative;
        }
        
        .header-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
        }
        
        .header-user-info {
            text-align: right;
        }
        
        .header-user-info strong {
            display: block;
            font-size: 14px;
        }
        
        .header-user-info small {
            font-size: 11px;
            opacity: 0.8;
        }
        
        /* User Dropdown */
        .user-dropdown {
            position: absolute;
            top: 55px;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            min-width: 280px;
            display: none;
            overflow: hidden;
        }
        
        .user-dropdown.show {
            display: block;
        }
        
        .user-dropdown-header {
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        
        .user-dropdown-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .user-dropdown-header strong {
            display: block;
            color: #0f1e3d;
            font-size: 15px;
        }
        
        .user-dropdown-header small {
            color: #6b7280;
            font-size: 12px;
        }
        
        .user-dropdown-menu {
            padding: 10px 0;
        }
        
        .user-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #1f2937;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
        }
        
        .user-dropdown-menu a:hover {
            background: #f3f4f6;
        }
        
        .user-dropdown-menu a i {
            color: #6b7280;
            width: 20px;
        }
        
        .user-dropdown-menu .logout {
            color: #ef4444;
            border-top: 1px solid #e5e7eb;
            margin-top: 5px;
            padding-top: 12px;
        }
        
        .user-dropdown-menu .logout i {
            color: #ef4444;
        }
        
        /* Main Content */
        .main-content {
            padding: 40px 30px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Welcome Section */
        .welcome-section {
            text-align: center;
            margin-bottom: 50px;
        }
        
        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(0, 137, 123, 0.1);
            color: #00897b;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .welcome-section h1 {
            font-size: 2.5rem;
            font-weight: 800;
            color: #0f1e3d;
            margin-bottom: 15px;
        }
        
        .welcome-section p {
            color: #6b7280;
            font-size: 16px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* Menu Cards */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .menu-card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
            border: 1px solid #e5e7eb;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border-color: #1e88e5;
        }
        
        .menu-card.active {
            border-color: #1e88e5;
            background: linear-gradient(135deg, rgba(30, 136, 229, 0.05), rgba(0, 137, 123, 0.05));
        }
        
        .menu-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(30, 136, 229, 0.1), rgba(0, 137, 123, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .menu-icon i {
            font-size: 24px;
            color: #00897b;
        }
        
        .menu-card.active .menu-icon {
            background: linear-gradient(135deg, #1e88e5, #00897b);
        }
        
        .menu-card.active .menu-icon i {
            color: white;
        }
        
        .menu-info h5 {
            font-size: 15px;
            font-weight: 700;
            color: #0f1e3d;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .menu-info p {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
            line-height: 1.5;
        }
        
        .badge-utama {
            background: #1e88e5;
            color: white;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }
        
        /* Footer */
        .admin-footer {
            background: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e5e7eb;
            margin-top: 50px;
        }
        
        .admin-footer small {
            color: #6b7280;
        }
        
        .admin-footer-links a {
            color: #00897b;
            text-decoration: none;
            margin-left: 20px;
            font-size: 14px;
        }
        
        /* Floating Buttons */
        .floating-buttons {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            z-index: 999;
        }
        
        .floating-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            color: #6b7280;
            font-size: 20px;
        }
        
        .floating-btn:hover {
            transform: scale(1.1);
            color: #1e88e5;
        }
        
        .floating-btn.primary {
            background: #1e88e5;
            color: white;
        }
        
        .floating-btn.primary:hover {
            background: #1565c0;
        }
        
        @media (max-width: 992px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }
            
            .header-search {
                display: none;
            }
            
            .welcome-section h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="admin-header">
        <div class="header-logo">
            <div class="header-logo-icon">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <div class="header-logo-text">
                <h4>PORTAL DESA DIGITAL</h4>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        
        <div class="header-search">
            <div class="header-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari data cepat...">
            </div>
        </div>
        
        <div class="header-user" onclick="toggleUserDropdown()">
            <div class="header-user-info">
                <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <i class="bi bi-chevron-down"></i>
            
            <!-- User Dropdown -->
            <div class="user-dropdown" id="userDropdown">
                <div class="user-dropdown-header">
                    <img src="https://via.placeholder.com/50" alt="Avatar">
                    <div>
                        <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                        <small>{{ auth()->user()->email ?? 'admin@tuban.go.id' }}</small>
                    </div>
                </div>
                <div class="user-dropdown-menu">
                    <a href="{{ route('profile.edit') ?? '#' }}">
                        <i class="bi bi-person"></i> Profil Saya
                    </a>
                    <a href="#">
                        <i class="bi bi-lock"></i> Ubah Password
                    </a>
                    <a href="{{ route('logout') }}" class="logout"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Keluar Sesi (Logout)
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="admin-footer">
        <small>© 2026 Pemerintah Kabupaten Tuban. Hak Cipta Dilindungi.</small>
        <div class="admin-footer-links">
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </footer>
    
    <!-- Floating Buttons -->
    <div class="floating-buttons">
        <button class="floating-btn primary" title="Tambah Data Baru">
            <i class="bi bi-plus"></i>
        </button>
        <button class="floating-btn" title="Pengaturan">
            <i class="bi bi-gear"></i>
        </button>
        <button class="floating-btn" title="Bantuan">
            <i class="bi bi-question-circle"></i>
        </button>
    </div>
    
    <script>
        function toggleUserDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.header-user')) {
                document.getElementById('userDropdown').classList.remove('show');
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>