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
        body { background: #f8fafc; }
        
        /* ===== HEADER ===== */
        .header {
            background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon {
            width: 45px; height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 24px;
        }
        .header-logo-text h5 { margin: 0; font-weight: 800; font-size: 18px; color: white; }
        .header-logo-text small { color: rgba(255,255,255,0.9); font-size: 11px; }
        
        .header-search { flex: 1; max-width: 500px; margin: 0 30px; }
        .header-search input {
            width: 100%; padding: 12px 20px 12px 45px;
            border: none; border-radius: 25px;
            font-size: 14px; background: white;
        }
        .header-search-wrapper { position: relative; }
        .header-search-wrapper i {
            position: absolute; left: 18px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
        }
        
        .header-user { display: flex; align-items: center; gap: 12px; color: white; cursor: pointer; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        
        /* ===== MAIN ===== */
        .main-content { padding: 40px 30px; max-width: 1400px; margin: 0 auto; }
        
        /* ===== WELCOME ===== */
        .welcome-section {
            text-align: center;
            margin-bottom: 40px;
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
        
        /* ===== MENU GRID ===== */
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
            border: 2px solid #e5e7eb;
            transition: all 0.3s;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
        }
        
        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        /* ===== WARNA CARD - SETIAP CARD BERWARNA ===== */
        
        /* KECAMATAN - Biru */
        .menu-card.kecamatan {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            border-color: #1e88e5;
        }
        .menu-card.kecamatan .menu-icon {
            background: linear-gradient(135deg, #1e88e5, #0ea5e9);
        }
        .menu-card.kecamatan .menu-icon i { color: white; }
        .menu-card.kecamatan h5 { color: #0c4a6e; }
        .menu-card.kecamatan p { color: #0369a1; }
        
        /* DESA - Teal (seperti yang ada) */
        .menu-card.desa {
            background: linear-gradient(135deg, #e0f2f1 0%, #b2dfdb 100%);
            border-color: #00897b;
        }
        .menu-card.desa .menu-icon {
            background: linear-gradient(135deg, #00897b, #00695c);
        }
        .menu-card.desa .menu-icon i { color: white; }
        .menu-card.desa h5 { color: #004d40; }
        .menu-card.desa p { color: #00695c; }
        
        /* DUSUN - Ungu */
        .menu-card.dusun {
            background: linear-gradient(135deg, #ede9fe 0%, #ddd6fe 100%);
            border-color: #8b5cf6;
        }
        .menu-card.dusun .menu-icon {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
        }
        .menu-card.dusun .menu-icon i { color: white; }
        .menu-card.dusun h5 { color: #4c1d95; }
        .menu-card.dusun p { color: #5b21b6; }
        
        /* BERITA - Orange */
        .menu-card.berita {
            background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
            border-color: #f59e0b;
        }
        .menu-card.berita .menu-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        .menu-card.berita .menu-icon i { color: white; }
        .menu-card.berita h5 { color: #78350f; }
        .menu-card.berita p { color: #92400e; }
        
        /* WISATA - Pink */
        .menu-card.wisata {
            background: linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%);
            border-color: #ec4899;
        }
        .menu-card.wisata .menu-icon {
            background: linear-gradient(135deg, #ec4899, #db2777);
        }
        .menu-card.wisata .menu-icon i { color: white; }
        .menu-card.wisata h5 { color: #831843; }
        .menu-card.wisata p { color: #9d174d; }
        
        /* PASAR - Hijau */
        .menu-card.pasar {
            background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
            border-color: #10b981;
        }
        .menu-card.pasar .menu-icon {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        .menu-card.pasar .menu-icon i { color: white; }
        .menu-card.pasar h5 { color: #064e3b; }
        .menu-card.pasar p { color: #065f46; }
        
        /* KANTOR - Biru Tua */
        .menu-card.kantor {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #3b82f6;
        }
        .menu-card.kantor .menu-icon {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }
        .menu-card.kantor .menu-icon i { color: white; }
        .menu-card.kantor h5 { color: #1e3a8a; }
        .menu-card.kantor p { color: #1e40af; }
        
        /* WIFI - Cyan */
        .menu-card.wifi {
            background: linear-gradient(135deg, #cffafe 0%, #a5f3fc 100%);
            border-color: #06b6d4;
        }
        .menu-card.wifi .menu-icon {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
        }
        .menu-card.wifi .menu-icon i { color: white; }
        .menu-card.wifi h5 { color: #164e63; }
        .menu-card.wifi p { color: #155e75; }
        
        /* BUMDES - Lime */
        .menu-card.bumdes {
            background: linear-gradient(135deg, #ecfccb 0%, #d9f99d 100%);
            border-color: #84cc16;
        }
        .menu-card.bumdes .menu-icon {
            background: linear-gradient(135deg, #84cc16, #65a30d);
        }
        .menu-card.bumdes .menu-icon i { color: white; }
        .menu-card.bumdes h5 { color: #365314; }
        .menu-card.bumdes p { color: #3f6212; }
        
        /* KKDMP - Indigo */
        .menu-card.kkdmp {
            background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%);
            border-color: #6366f1;
        }
        .menu-card.kkdmp .menu-icon {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
        }
        .menu-card.kkdmp .menu-icon i { color: white; }
        .menu-card.kkdmp h5 { color: #312e81; }
        .menu-card.kkdmp p { color: #3730a3; }
        
        /* Icon Box */
        .menu-icon {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        
        .menu-icon i {
            font-size: 24px;
        }
        
        .menu-info { flex: 1; }
        
        .menu-info h5 {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }
        
        .menu-info p {
            font-size: 13px;
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
        
        .badge-new {
            background: #ef4444;
            color: white;
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }
        
        /* ===== FLOATING TOOLBAR - TENGAH KANAN ===== */
        .floating-toolbar {
            position: fixed;
            right: 30px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 999;
        }
        
        .toolbar-btn {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: white;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #6b7280;
            font-size: 22px;
            transition: all 0.3s;
            text-decoration: none;
            position: relative;
        }
        
        .toolbar-btn:hover {
            transform: translateX(-5px);
            color: #1e88e5;
            border-color: #1e88e5;
            box-shadow: 0 6px 20px rgba(30,136,229,0.2);
        }
        
        .toolbar-btn.primary {
            background: linear-gradient(135deg, #1e88e5, #00897b);
            color: white;
            border: none;
        }
        
        .toolbar-btn.primary:hover {
            transform: translateX(-5px) scale(1.05);
            box-shadow: 0 8px 25px rgba(30,136,229,0.3);
            color: white;
        }
        
        .toolbar-btn .tooltip-text {
            position: absolute;
            right: 70px;
            background: #1e3a8a;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s;
        }
        
        .toolbar-btn:hover .tooltip-text {
            opacity: 1;
            visibility: visible;
            right: 65px;
        }
        
        /* ===== FOOTER ===== */
        .footer {
            background: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e5e7eb;
            margin-top: 40px;
        }
        .footer small { color: #6b7280; font-size: 13px; }
        .footer a { color: #00897b; text-decoration: none; margin-left: 20px; font-size: 13px; }
        
        @media (max-width: 992px) {
            .menu-grid { grid-template-columns: repeat(2, 1fr); }
            .floating-toolbar { display: none; }
        }
        
        @media (max-width: 576px) {
            .menu-grid { grid-template-columns: 1fr; }
            .header-search { display: none; }
            .welcome-section h1 { font-size: 1.8rem; }
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
                <input type="text" placeholder="Cari data cepat...">
            </div>
        </div>
        
        <div class="header-user">
            <div class="header-user-info">
                <strong>{{ auth()->user()->name ?? 'Admin Desa' }}</strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
            <i class="bi bi-chevron-down"></i>
        </div>
    </header>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Selamat Datang di Portal Desa Digital</h1>
            <p>Satu wadah digitalisasi data, potensi, dan administrasi kemasyarakatan Kabupaten Tuban</p>
        </div>
        
        <!-- Menu Grid - URUTAN BARU -->
        <div class="menu-grid">
            <!-- BARIS 1: KECAMATAN, DESA, DUSUN -->
            <a href="{{ route('admin.kecamatan.index') }}" class="menu-card kecamatan">
                <div class="menu-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div class="menu-info">
                    <h5>KECAMATAN</h5>
                    <p>Informasi terintegrasi dengan distrik wilayah administratif Tuban.</p>
                </div>
            </a>
            
            <a href="{{ route('admin.desa.index') }}" class="menu-card desa">
                <div class="menu-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="menu-info">
                    <h5>DESA <span class="badge-utama">UTAMA</span></h5>
                    <p>Profil umum, data geografis, sejarah, dan struktur kepengurusan desa.</p>
                </div>
            </a>
            
            <a href="#" class="menu-card dusun">
                <div class="menu-icon">
                    <i class="bi bi-house-door"></i>
                </div>
                <div class="menu-info">
                    <h5>DUSUN</h5>
                    <p>Data kewilayahan dusun, rukun tetangga (RT), dan data demografi lokal.</p>
                </div>
            </a>
            
            <!-- BARIS 2: BERITA, WISATA, PASAR -->
            <a href="{{ route('admin.berita.index') }}" class="menu-card berita">
                <div class="menu-icon">
                    <i class="bi bi-newspaper"></i>
                </div>
                <div class="menu-info">
                    <h5>BERITA <span class="badge-new">BARU</span></h5>
                    <p>Kelola berita, pengumuman, dan informasi terkini seputar desa dan kecamatan.</p>
                </div>
            </a>
            
            <a href="#" class="menu-card wisata">
                <div class="menu-icon">
                    <i class="bi bi-map"></i>
                </div>
                <div class="menu-info">
                    <h5>WISATA DESA</h5>
                    <p>Eksplorasi potensi pariwisata daerah, kebudayaan, dan cagar alam.</p>
                </div>
            </a>
            
            <a href="#" class="menu-card pasar">
                <div class="menu-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="menu-info">
                    <h5>PASAR DESA</h5>
                    <p>Daftar pasar rakyat, komoditas utama, pelaku usaha mikro (UMKM).</p>
                </div>
            </a>
            
            <!-- BARIS 3: KANTOR, WIFI, BUMDES -->
            <a href="#" class="menu-card kantor">
                <div class="menu-icon">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div class="menu-info">
                    <h5>KANTOR DESA</h5>
                    <p>Sistem layanan administrasi surat menyurat dan perizinan terpadu.</p>
                </div>
            </a>
            
            <a href="#" class="menu-card wifi">
                <div class="menu-icon">
                    <i class="bi bi-wifi"></i>
                </div>
                <div class="menu-info">
                    <h5>WIFI DESA</h5>
                    <p>Pemantauan akses internet publik gratis dan jaringan desa digital.</p>
                </div>
            </a>
            
            <a href="#" class="menu-card bumdes">
                <div class="menu-icon">
                    <i class="bi bi-briefcase-fill"></i>
                </div>
                <div class="menu-info">
                    <h5>BUMDES</h5>
                    <p>Manajemen unit usaha bersama, keuangan, dan aset milik desa.</p>
                </div>
            </a>
            
            <!-- BARIS 4: KKDMP -->
            <a href="#" class="menu-card kkdmp">
                <div class="menu-icon">
                    <i class="bi bi-clipboard-data"></i>
                </div>
                <div class="menu-info">
                    <h5>KKDMP</h5>
                    <p>Rencana Pembangunan Jangka Menengah dan dokumen strategis desa.</p>
                </div>
            </a>
        </div>
    </main>
    
    <!-- Floating Toolbar - TENGAH KANAN -->
    <div class="floating-toolbar">
        <a href="#" class="toolbar-btn primary" title="Tambah Data Baru">
            <i class="bi bi-plus-lg"></i>
            <span class="tooltip-text">Tambah Data Baru</span>
        </a>
        <a href="{{ route('admin.berita.index') }}" class="toolbar-btn" title="Edit Berita">
            <i class="bi bi-newspaper"></i>
            <span class="tooltip-text">Edit Berita</span>
        </a>
        <a href="#" class="toolbar-btn" title="Pengaturan">
            <i class="bi bi-gear"></i>
            <span class="tooltip-text">Pengaturan</span>
        </a>
        <a href="#" class="toolbar-btn" title="Bantuan">
            <i class="bi bi-question-circle"></i>
            <span class="tooltip-text">Bantuan</span>
        </a>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <small>© 2026 Pemerintah Kabupaten Tuban. Hak Cipta Dilindungi.</small>
        <div>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>