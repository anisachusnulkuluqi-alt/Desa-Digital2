<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            background: #f1f5f9;
            background-image: 
                radial-gradient(at 0% 0%, rgba(14, 165, 233, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(20, 184, 166, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(99, 102, 241, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(6, 182, 212, 0.08) 0px, transparent 50%);
            background-attachment: fixed;
            color: #0f172a; 
            min-height: 100vh;
        }
        
        /* ===== HEADER ===== */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 14px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 20px;
        }
        .header-logo-text h5 { margin: 0; font-weight: 800; font-size: 15px; color: #0f172a; letter-spacing: -0.02em; }
        .header-logo-text small { color: #64748b; font-size: 11px; font-weight: 500; }
        
        .header-search { flex: 1; max-width: 400px; margin: 0 30px; }
        .header-search input {
            width: 100%; padding: 10px 16px 10px 40px;
            border: 1px solid #e2e8f0; border-radius: 8px;
            font-size: 13px; background: #f8fafc;
            transition: all 0.2s;
        }
        .header-search input:focus {
            outline: none;
            border-color: #0ea5e9;
            background: white;
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }
        .header-search-wrapper { position: relative; }
        .header-search-wrapper i {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); color: #94a3b8;
            font-size: 14px;
        }
        
        .header-user { display: flex; align-items: center; gap: 12px; }
        .header-user-dropdown { position: relative; }
        .header-user-trigger {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            background: transparent;
            border: none;
        }
        .header-user-trigger:hover { background: #f1f5f9; }
        .header-user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: white; font-size: 13px;
        }
        .header-user-info { text-align: right; }
        .header-user-info strong { display: block; font-size: 13px; font-weight: 600; color: #0f172a; }
        .header-user-info small { font-size: 11px; color: #64748b; font-weight: 500; }
        
        /* Dropdown Menu */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            min-width: 220px;
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s;
            z-index: 1000;
        }
        .user-dropdown.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .dropdown-header {
            padding: 12px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 8px;
        }
        .dropdown-header strong {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .dropdown-header small { font-size: 11px; color: #64748b; }
        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: #475569;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 4px;
        }
        .dropdown-item:hover { background: #f8fafc; color: #0f172a; }
        .dropdown-item i { font-size: 16px; width: 20px; }
        .dropdown-divider { height: 1px; background: #f1f5f9; margin: 8px 0; }
        .dropdown-item.logout { color: #ef4444; }
        .dropdown-item.logout:hover { background: #fef2f2; }
        
        /* ===== MAIN ===== */
        .main-content { padding: 40px 30px; max-width: 1400px; margin: 0 auto; }
        
        /* ===== WELCOME ===== */
        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 28px;
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }
        .welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(14, 165, 233, 0.1);
            color: #0284c7;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 18px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .welcome-section h1 {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 12px;
            letter-spacing: -0.03em;
            line-height: 1.2;
        }
        .welcome-section p {
            color: #64748b;
            font-size: 15px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }
        
        /* ===== SECTION TITLE ===== */
        .section-label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 18px;
            padding-left: 4px;
        }
        
        /* ===== MENU GRID ===== */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .menu-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #0ea5e9;
            transition: all 0.25s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
        }
        .menu-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(14, 165, 233, 0.03), rgba(20, 184, 166, 0.03));
            opacity: 0;
            transition: opacity 0.25s;
        }
        .menu-card:hover::before { opacity: 1; }
        .menu-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(14, 165, 233, 0.15);
            border-color: #0ea5e9;
        }
        
        /* Icon Box */
        .menu-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            font-size: 22px;
            color: white;
            position: relative;
            z-index: 1;
        }
        .menu-icon.blue { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
        .menu-icon.teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }
        .menu-icon.sky { background: linear-gradient(135deg, #38bdf8, #0ea5e9); }
        .menu-icon.cyan { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        .menu-icon.indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .menu-icon.slate { background: linear-gradient(135deg, #64748b, #475569); }
        .menu-icon.orange { background: linear-gradient(135deg, #f97316, #ea580c); }
        .menu-icon.rose { background: linear-gradient(135deg, #f43f5e, #e11d48); }
        
        .menu-info { flex: 1; min-width: 0; position: relative; z-index: 1; }
        .menu-category {
            font-size: 10px;
            font-weight: 700;
            color: #0ea5e9;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 4px;
        }
        .menu-info h5 {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
            letter-spacing: -0.01em;
        }
        .menu-info p {
            font-size: 12.5px;
            color: #64748b;
            margin: 0;
            line-height: 1.5;
        }
        .menu-arrow {
            color: #cbd5e1;
            font-size: 18px;
            transition: all 0.2s;
            margin-top: 12px;
            position: relative;
            z-index: 1;
        }
        .menu-card:hover .menu-arrow {
            color: #0ea5e9;
            transform: translateX(3px);
        }
        
        /* ===== FOOTER ===== */
        .footer {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e2e8f0;
            margin-top: 40px;
        }
        .footer small { color: #94a3b8; font-size: 12px; }
        .footer a { color: #64748b; text-decoration: none; margin-left: 20px; font-size: 12px; }
        .footer a:hover { color: #0ea5e9; }
        
        @media (max-width: 992px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 576px) {
            .menu-grid { grid-template-columns: 1fr; }
            .header-search { display: none; }
            .welcome-section h1 { font-size: 1.6rem; }
            .main-content { padding: 24px 20px; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-logo">
            <div class="header-logo-icon">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <div class="header-logo-text">
                <h5>PORTAL DESA DIGITAL</h5>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        
        <div class="header-search">
            <div class="header-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari data...">
            </div>
        </div>
        
        <div class="header-user">
            <div class="header-user-dropdown">
                <button class="header-user-trigger" onclick="toggleDropdown()">
                    <div class="header-user-info">
                        <strong><?php echo e(auth()->user()->name ?? 'Admin Tuban'); ?></strong>
                        <small>Operator Kabupaten</small>
                    </div>
                    <div class="header-user-avatar">
                        <?php echo e(substr(auth()->user()->name ?? 'A', 0, 1)); ?>

                    </div>
                    <i class="bi bi-chevron-down" style="font-size: 12px; color: #94a3b8;"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div class="user-dropdown" id="userDropdown">
                    <div class="dropdown-header">
                        <strong><?php echo e(auth()->user()->name ?? 'Admin Tuban'); ?></strong>
                        <small><?php echo e(auth()->user()->email ?? 'admin@desadigital.tuban.go.id'); ?></small>
                    </div>
                    
                    <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                        <i class="bi bi-person"></i>
                        Profil Saya
                    </a>
                    <a href="<?php echo e(route('admin.settings.index')); ?>" class="dropdown-item">
                        <i class="bi bi-gear"></i>
                        Pengaturan
                    </a>
                    
                    <div class="dropdown-divider"></div>
                    
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item logout" style="width: 100%; border: none; background: none; cursor: pointer; text-align: left; font-family: inherit;">
                            <i class="bi bi-box-arrow-right"></i>
                            Keluar / Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="welcome-badge">
                <i class="bi bi-circle-fill" style="font-size: 6px;"></i>
                LAYANAN ADMINISTRASI DESA
            </div>
            <h1>Selamat Datang di Portal Desa Digital</h1>
            <p>Satu wadah digitalisasi data, potensi, dan administrasi kemasyarakatan Kabupaten Tuban</p>
        </div>
        
        <!-- BARIS 1: Wilayah & Data Utama -->
        <div class="section-label">Wilayah & Data Utama</div>
        <div class="menu-grid">
            <!-- 1. KECAMATAN -->
            <a href="<?php echo e(route('admin.kecamatan.index')); ?>" class="menu-card">
                <div class="menu-icon indigo">
                    <i class="bi bi-building"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Distrik</div>
                    <h5>Kecamatan</h5>
                    <p>Informasi terintegrasi dengan distrik wilayah administratif Tuban.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 2. DESA -->
            <a href="<?php echo e(route('admin.desa.index')); ?>" class="menu-card">
                <div class="menu-icon blue">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Master Data</div>
                    <h5>Desa</h5>
                    <p>Profil umum, data geografis, sejarah, dan struktur kepengurusan desa.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 3. DUSUN -->
            <a href="<?php echo e(route('admin.dusun.index')); ?>" class="menu-card">
                <div class="menu-icon teal">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Kewilayahan</div>
                    <h5>Dusun</h5>
                    <p>Data kewilayahan dusun, rukun tetangga (RT), dan data demografi lokal.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
        </div>
        
        <!-- BARIS 2: Layanan & Potensi -->
        <div class="section-label">Layanan & Potensi Desa</div>
        <div class="menu-grid">
            <!-- 4. KANTOR DESA -->
            <a href="<?php echo e(route('admin.kantor.index')); ?>" class="menu-card">
                <div class="menu-icon sky">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Administrasi</div>
                    <h5>Kantor Desa</h5>
                    <p>Sistem layanan administrasi surat menyurat dan perizinan terpadu.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 5. WISATA DESA -->
            <a href="<?php echo e(route('admin.wisata.index')); ?>" class="menu-card">
                <div class="menu-icon teal">
                    <i class="bi bi-map"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Potensi Alam</div>
                    <h5>Wisata Desa</h5>
                    <p>Eksplorasi potensi pariwisata daerah, kebudayaan, dan cagar alam.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 6. PASAR DESA -->
            <a href="<?php echo e(route('admin.pasar.index')); ?>" class="menu-card">
                <div class="menu-icon cyan">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Perekonomian</div>
                    <h5>Pasar Desa</h5>
                    <p>Daftar pasar rakyat, komoditas utama, pelaku usaha mikro (UMKM).</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
        </div>
        
        <!-- BARIS 3: Infrastruktur & Perencanaan -->
        <div class="section-label">Infrastruktur & Perencanaan</div>
        <div class="menu-grid">
            <!-- 7. WIFI DESA -->
            <a href="<?php echo e(route('admin.wifi.index')); ?>" class="menu-card">
                <div class="menu-icon blue">
                    <i class="bi bi-wifi"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Infrastruktur</div>
                    <h5>WiFi Desa</h5>
                    <p>Pemantauan akses internet publik gratis dan jaringan desa digital.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 8. BUMDES -->
            <a href="<?php echo e(route('admin.bumdes.index')); ?>" class="menu-card">
                <div class="menu-icon slate">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Badan Usaha</div>
                    <h5>BUMDes</h5>
                    <p>Manajemen unit usaha bersama, keuangan, dan aset milik desa.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 9. KKDMP -->
            <a href="<?php echo e(route('admin.kkdmp.index')); ?>" class="menu-card">
                <div class="menu-icon indigo">
                    <i class="bi bi-clipboard-data"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Perencanaan</div>
                    <h5>KKDMP</h5>
                    <p>Rencana Pembangunan Jangka Menengah desa dan dokumen strategis.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
        </div>
        
        <!-- BARIS 4: Informasi & Pengaturan -->
        <div class="section-label">Informasi & Sistem</div>
        <div class="menu-grid">
            <!-- 10. BERITA -->
            <a href="<?php echo e(route('admin.berita.index')); ?>" class="menu-card">
                <div class="menu-icon orange">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Informasi</div>
                    <h5>Kelola Berita</h5>
                    <p>Kelola berita, pengumuman, dan informasi terkini seputar desa dan kecamatan.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
            
            <!-- 11. PENGATURAN -->
            <a href="<?php echo e(route('admin.settings.index')); ?>" class="menu-card">
                <div class="menu-icon slate">
                    <i class="bi bi-gear-fill"></i>
                </div>
                <div class="menu-info">
                    <div class="menu-category">Sistem</div>
                    <h5>Pengaturan</h5>
                    <p>Konfigurasi sistem, manajemen pengguna, dan preferensi aplikasi.</p>
                </div>
                <i class="bi bi-chevron-right menu-arrow"></i>
            </a>
        </div>
    </main>
    
    <!-- Footer -->
    <footer class="footer">
        <small>© 2026 Pemerintah Kabupaten Tuban. Hak Cipta Dilindungi.</small>
        <div>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }
        
        window.onclick = function(event) {
            if (!event.target.closest('.header-user-dropdown')) {
                var dropdowns = document.getElementsByClassName('user-dropdown');
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>