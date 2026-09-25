<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Website Desa / Kelurahan - Desa Digital Kabupaten Tuban</title>
    <link rel="icon" type="image/png" href="<?= asset('images/desa-digital.png'); ?>">

    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --amber: #f59e0b;
            --amber-dark: #d97706;
            --emerald: #10b981;
            --rose: #e11d48;
            --dark-header: #475569;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --bg-body: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }

        /* 1. Header Navbar */
        .site-header {
            background: rgba(51, 65, 85, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 12px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .brand-link { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo-img { height: 38px; width: auto; max-width: 140px; object-fit: contain; display: block; }
        .brand-text-logo { font-size: 1.35rem; font-weight: 800; color: #ffffff; letter-spacing: -0.01em; display: flex; align-items: center; }
        .brand-text-logo span { color: #38bdf8; margin-left: 2px; }
        .nav-menu { display: flex; align-items: center; gap: 22px; list-style: none; }
        .nav-menu a {
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            position: relative;
            padding: 6px 0;
            transition: color 0.2s ease;
        }
        .nav-menu a:hover { color: #ffffff; }
        .nav-menu a.active { color: #38bdf8; }
        .nav-menu a.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: #38bdf8; border-radius: 2px; }
        .search-pill-nav { display: flex; align-items: center; background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 30px; padding: 5px 14px; width: 190px; transition: all 0.25s ease; }
        .search-pill-nav:focus-within { width: 230px; background: rgba(255, 255, 255, 0.2); border-color: #38bdf8; }
        .search-pill-nav input { background: transparent; border: none; outline: none; color: #ffffff; font-size: 0.8rem; width: 100%; }
        .search-pill-nav input::placeholder { color: rgba(255, 255, 255, 0.6); }
        .search-pill-nav button { background: transparent; border: none; color: rgba(255, 255, 255, 0.7); cursor: pointer; font-size: 0.8rem; }

        /* 2. Hero Banner Sesuai Halaman Surat */
        .website-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0369a1 100%);
            color: #ffffff;
            padding: 60px 7% 75px 7%;
            text-align: center;
            position: relative;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(245, 158, 11, 0.2);
            border: 1px solid rgba(245, 158, 11, 0.4);
            color: #fbbf24;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .website-hero h1 {
            font-size: 2.6rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
        }
        .website-hero p {
            font-size: 1.05rem;
            color: #cbd5e1;
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* 3. Main Container */
        .content-wrap {
            max-width: 1240px;
            margin: -35px auto 60px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        /* Bilah Pencarian Melayang */
        .filter-bar {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 22px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .filter-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .filter-title i {
            font-size: 1.4rem;
            color: var(--primary);
        }
        .filter-title div h4 {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .filter-title div p {
            font-size: 0.78rem;
            color: var(--text-muted);
        }
        .filter-actions {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 520px;
        }
        .filter-search-box {
            position: relative;
            flex: 1;
        }
        .filter-search-box input {
            width: 100%;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            padding: 10px 14px 10px 36px;
            font-size: 0.84rem;
            font-weight: 600;
            outline: none;
            transition: border-color 0.2s;
        }
        .filter-search-box input:focus { border-color: var(--primary); }
        .filter-search-box i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .counter-pill {
            background: var(--primary-light);
            color: var(--primary-dark);
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 0.8rem;
            font-weight: 800;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* 4. Grid Katalog Distrik Kecamatan */
        .section-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .district-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-bottom: 50px;
        }

        .district-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1.5px solid var(--border-soft);
            padding: 24px 22px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .district-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: var(--card-accent, #0284c7);
        }
        .district-card:hover {
            transform: translateY(-5px);
            border-color: var(--card-accent, #0284c7);
            box-shadow: 0 16px 30px rgba(0,0,0,0.08);
        }

        .card-top {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }
        .card-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--icon-bg, #e0f2fe);
            color: var(--card-accent, #0284c7);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid var(--border-soft);
            overflow: hidden;
        }
        .card-icon-box img {
            width: 26px;
            height: 32px;
            object-fit: contain;
        }
        .card-top-info h3 {
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
        }
        .badge-code {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 800;
            color: var(--primary);
            background: var(--primary-light);
            padding: 2px 8px;
            border-radius: 6px;
            margin-top: 4px;
        }

        .district-card p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 18px;
        }

        .meta-stats-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            padding: 10px 12px;
            border-radius: 10px;
            margin-bottom: 18px;
        }
        .meta-stat-item small {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            display: block;
        }
        .meta-stat-item strong {
            font-size: 0.88rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .btn-action-view {
            width: 100%;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            color: var(--text-dark);
            padding: 11px;
            border-radius: 10px;
            font-size: 0.84rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .district-card:hover .btn-action-view {
            background: var(--card-accent, #0284c7);
            color: #ffffff;
            border-color: transparent;
        }

        /* 5. Modal Modern Multi-Kolom & Efisiensi Form */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(5px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-container {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 860px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0,0,0,0.25);
            animation: zoomIn 0.2s ease-out;
        }
        @keyframes zoomIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .modal-header-bar {
            background: #f8fafc;
            padding: 18px 24px;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header-bar h3 { font-size: 1.15rem; font-weight: 800; color: var(--text-dark); display: flex; align-items: center; gap: 8px; }
        .btn-modal-close {
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: #94a3b8;
            cursor: pointer;
        }
        .modal-body-content {
            padding: 24px;
            max-height: 80vh;
            overflow-y: auto;
        }

        /* Tab Switcher di dalam Modal */
        .modal-nav-tabs {
            display: flex;
            gap: 8px;
            border-bottom: 2px solid var(--border-soft);
            margin-bottom: 20px;
        }
        .tab-btn {
            background: transparent;
            border: none;
            padding: 10px 16px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-muted);
            cursor: pointer;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .tab-btn.active {
            color: var(--primary);
            border-bottom-color: var(--primary);
        }

        .detail-summary-strip {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            background: #f1f5f9;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .search-mini-bar {
            margin-bottom: 16px;
            position: relative;
        }
        .search-mini-bar input {
            width: 100%;
            border: 1.5px solid var(--border-soft);
            border-radius: 8px;
            padding: 8px 12px 8px 34px;
            font-size: 0.82rem;
            outline: none;
        }
        .search-mini-bar i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.8rem;
        }

        .village-list-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .village-chip-item {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            padding: 12px 14px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.2s;
        }
        .village-chip-item:hover {
            border-color: var(--primary);
            background: #f0f9ff;
            transform: translateX(3px);
        }
        .village-chip-item a {
            color: var(--primary);
            font-size: 0.78rem;
            font-weight: 800;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Form Multi-Kolom untuk Integrasi Baru */
        .form-grid-columns {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .form-group-custom {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .form-group-custom.full-span {
            grid-column: 1 / -1;
        }
        .form-group-custom label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        .form-group-custom input, .form-group-custom select, .form-group-custom textarea {
            border: 1.5px solid var(--border-soft);
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 0.82rem;
            outline: none;
        }
        .form-group-custom input:focus, .form-group-custom select:focus, .form-group-custom textarea:focus {
            border-color: var(--primary);
        }
        .btn-submit-portal {
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 11px;
            border-radius: 8px;
            font-size: 0.84rem;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 10px;
        }
        .btn-submit-portal:hover { background: var(--primary-dark); }

        @media (max-width: 960px) { .district-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .district-grid { grid-template-columns: 1fr; }
            .filter-bar { flex-direction: column; align-items: stretch; }
            .filter-actions { max-width: 100%; }
            .village-list-grid { grid-template-columns: 1fr; }
            .form-grid-columns { grid-template-columns: 1fr; }
            .nav-menu { display: none; }
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="site-header">
        <a href="<?= url('/'); ?>" class="brand-link">
            <img src="<?= asset('images/desa-digital.png'); ?>" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-img"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png'">
            <div class="brand-text-logo">Desa<span>Digital</span></div>
        </a>

        <ul class="nav-menu">
            <li><a href="<?= url('/'); ?>">BERANDA</a></li>
            <li><a href="<?= url('/website'); ?>" class="active">WEBSITE DESA</a></li>
            <li><a href="<?= url('/data-spasial'); ?>">DATA SPASIAL</a></li>
            <li><a href="<?= url('/cctv'); ?>">CCTV TUBAN</a></li>
            <li><a href="<?= url('/surat'); ?>">SURAT MANDIRI</a></li>
            <li><a href="<?= url('/epbb'); ?>">E-PBB</a></li>
        </ul>

        <form class="search-pill-nav" action="<?= url('/website'); ?>" method="GET">
            <input type="text" name="search" placeholder="Cari kecamatan...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </header>

    <!-- Hero Banner -->
    <section class="website-hero">
        <div class="hero-badge">
            <i class="fa-solid fa-globe"></i> Direktori Resmi 20 Wilayah Distrik Tuban
        </div>
        <h1>Data Website Desa / Kelurahan</h1>
        <p>Akses cepat portal resmi pemerintahan desa dan kelurahan di seluruh kecamatan se-Kabupaten Tuban secara terpadu dan transparan.</p>
    </section>

    <!-- Main Content -->
    <main class="content-wrap">
        
        <?php
            // Data 20 Kecamatan Resmi Kabupaten Tuban beserta sebaran desa representatif
            $kecamatanTuban = [
                ['nama' => 'Bancar', 'kode' => '35.23.01', 'desa_count' => 24, 'accent' => '#f59e0b', 'bg' => '#fef3c7', 'sample' => ['Bancar', 'Boncong', 'Bogorejo', 'Bulu', 'Jatisari', 'Ngujuran', 'Margosuko', 'Sukoharjo', 'Sumberan']],
                ['nama' => 'Bangilan', 'kode' => '35.23.02', 'desa_count' => 14, 'accent' => '#0284c7', 'bg' => '#e0f2fe', 'sample' => ['Bangilan', 'Banjarkerep', 'Kedungjambangan', 'Klampok', 'Kumpulrejo', 'Sidokumpul']],
                ['nama' => 'Grabagan', 'kode' => '35.23.03', 'desa_count' => 11, 'accent' => '#10b981', 'bg' => '#d1fae5', 'sample' => ['Grabagan', 'Banyubang', 'Dahor', 'Dermawuharjo', 'Gesikan', 'Menyunyur', 'Ngandong', 'Ngarum']],
                ['nama' => 'Jatirogo', 'kode' => '35.23.04', 'desa_count' => 18, 'accent' => '#8b5cf6', 'bg' => '#ede9fe', 'sample' => ['Jatirogo', 'Bader', 'Besowo', 'Dingil', 'Karangtengah', 'Kebonharjo', 'Paseyan', 'Wotsogo']],
                ['nama' => 'Jenu', 'kode' => '35.23.05', 'desa_count' => 17, 'accent' => '#0ea5e9', 'bg' => '#e0f2fe', 'sample' => ['Beji', 'Jenu', 'Kalianyar', 'Mentoso', 'Rawasan', 'Remen', 'Socorejo', 'Sugihwaras', 'Tasikharjo']],
                ['nama' => 'Kenduruan', 'kode' => '35.23.06', 'desa_count' => 9, 'accent' => '#f43f5e', 'bg' => '#ffe4e6', 'sample' => ['Sidohasri', 'Sokogunung', 'Jamprong', 'Jombok', 'Tawaran', 'Sidomukti', 'Bendonglateng']],
                ['nama' => 'Kerek', 'kode' => '35.23.07', 'desa_count' => 16, 'accent' => '#d97706', 'bg' => '#fef3c7', 'sample' => ['Gaji', 'Jarorejo', 'Karanglo', 'Margomulyo', 'Padasan', 'Trantang', 'Wolutengah', 'Kasiman']],
                ['nama' => 'Merakurak', 'kode' => '35.23.08', 'desa_count' => 19, 'accent' => '#0284c7', 'bg' => '#e0f2fe', 'sample' => ['Bogorejo', 'Kapu', 'Mandirejo', 'Sambonggede', 'Sumberejo', 'Tahulu', 'Tuwiri Wetan', 'Tuwiri Kulon']],
                ['nama' => 'Montong', 'kode' => '35.23.09', 'desa_count' => 13, 'accent' => '#10b981', 'bg' => '#d1fae5', 'sample' => ['Montongsekar', 'Guwoterus', 'Maindu', 'Manjung', 'Pakel', 'Pucangan', 'Talangkembar']],
                ['nama' => 'Palang', 'kode' => '35.23.10', 'desa_count' => 19, 'accent' => '#6366f1', 'bg' => '#ede9fe', 'sample' => ['Palang', 'Cepokorejo', 'Karangagung', 'Kradenan', 'Leran Kulon', 'Tasikmadu', 'Gesikharjo', 'Panyuran']],
                ['nama' => 'Parengan', 'kode' => '35.23.11', 'desa_count' => 18, 'accent' => '#f59e0b', 'bg' => '#fef3c7', 'sample' => ['Parangbatu', 'Cengkong', 'Kemlaten', 'Mergoasri', 'Ngawun', 'Sendangrejo', 'Dagangan']],
                ['nama' => 'Plumpang', 'kode' => '35.23.12', 'desa_count' => 18, 'accent' => '#0284c7', 'bg' => '#e0f2fe', 'sample' => ['Plumpang', 'Cangkring', 'Kedungrojo', 'Klazan', 'Magersari', 'Sembungrejo', 'Bandungrejo']],
                ['nama' => 'Rengel', 'kode' => '35.23.13', 'desa_count' => 16, 'accent' => '#10b981', 'bg' => '#d1fae5', 'sample' => ['Rengel', 'Banjaragung', 'Campurejo', 'Kanorejo', 'Maibit', 'Pekuwon', 'Sumberejo', 'Sawahan']],
                ['nama' => 'Semanding', 'kode' => '35.23.14', 'desa_count' => 17, 'accent' => '#e11d48', 'bg' => '#ffe4e6', 'sample' => ['Semanding', 'Bejagung', 'Genaharjo', 'Gedongombo', 'Kowang', 'Penambangan', 'Prunggahan Kulon', 'Prunggahan Wetan']],
                ['nama' => 'Senori', 'kode' => '35.23.15', 'desa_count' => 12, 'accent' => '#8b5cf6', 'bg' => '#ede9fe', 'sample' => ['Sendang', 'Jatisari', 'Kaligede', 'Meduri', 'Rayung', 'Wanglu Kulon', 'Wonorejo']],
                ['nama' => 'Singgahan', 'kode' => '35.23.16', 'desa_count' => 12, 'accent' => '#0ea5e9', 'bg' => '#e0f2fe', 'sample' => ['Mulyoagung', 'Binangun', 'Kedungjambe', 'Laju Kidul', 'Laju Lor', 'Tingkis', 'Tunggulrejo']],
                ['nama' => 'Soko', 'kode' => '35.23.17', 'desa_count' => 23, 'accent' => '#f59e0b', 'bg' => '#fef3c7', 'sample' => ['Soko', 'Bangunrejo', 'Kendaldoyong', 'Menilo', 'Pandanagung', 'Sokosari', 'Wadung', 'Gladsari']],
                ['nama' => 'Tambakboyo', 'kode' => '35.23.18', 'desa_count' => 18, 'accent' => '#0284c7', 'bg' => '#e0f2fe', 'sample' => ['Tambakboyo', 'Belikanget', 'Cokrowati', 'Dasin', 'Kenanti', 'Mabul', 'Sotang', 'Dikir']],
                ['nama' => 'Tuban', 'kode' => '35.23.19', 'desa_count' => 17, 'accent' => '#10b981', 'bg' => '#d1fae5', 'sample' => ['Baturetno', 'Kebonsari', 'Kutorejo', 'Latsari', 'Ronggomulyo', 'Sidomulyo', 'Sukolilo', 'Kingking', 'Sugiharjo']],
                ['nama' => 'Widang', 'kode' => '35.23.20', 'desa_count' => 16, 'accent' => '#475569', 'bg' => '#f1f5f9', 'sample' => ['Widang', 'Bunut', 'Compreng', 'Kedungharjo', 'Minohorejo', 'Ngadirejo', 'Panyuran', 'Mrutuk']]
            ];
        ?>

        <!-- Filter & Search Bar Sesuai Format Halaman Surat -->
        <div class="filter-bar">
            <div class="filter-title">
                <i class="fa-solid fa-network-wired"></i>
                <div>
                    <h4>Eksplorasi Portal Distrik</h4>
                    <p>Ketikkan nama kecamatan atau kode wilayah untuk mempercepat penelusuran.</p>
                </div>
            </div>
            
            <div class="filter-actions">
                <div class="filter-search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="districtSearch" placeholder="Cari nama kecamatan (cth: Jenu, Rengel)..." oninput="filterDistricts(this.value)">
                </div>
                <div class="counter-pill" id="counterPill">
                    <i class="fa-solid fa-building-columns"></i>
                    <span><?= count($kecamatanTuban); ?> Distrik Terdaftar</span>
                </div>
            </div>
        </div>

        <!-- Section Grid Katalog Distrik -->
        <h2 class="section-title">
            <i class="fa-solid fa-folder-tree" style="color: var(--amber);"></i>
            Katalog Website Kecamatan & Desa Terpadu
        </h2>

        <div class="district-grid" id="districtGrid">
            <?php foreach ($kecamatanTuban as $kec): ?>
                <div class="district-card" 
                     style="--card-accent: <?= $kec['accent']; ?>; --icon-bg: <?= $kec['bg']; ?>;"
                     data-name="<?= strtolower($kec['nama']); ?>">
                    <div>
                        <div class="card-top">
                            <div class="card-icon-box">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" 
                                     alt="Tuban"
                                     onerror="this.onerror=null; this.parentElement.innerHTML='<i class=\'fa-solid fa-building-columns\'></i>';">
                            </div>
                            <div class="card-top-info">
                                <h3>Kecamatan <?= $kec['nama']; ?></h3>
                                <span class="badge-code"><?= $kec['kode']; ?></span>
                            </div>
                        </div>

                        <p>Pusat koordinasi pelayanan publik dan keterbukaan informasi desa di wilayah Kecamatan <?= $kec['nama']; ?>.</p>

                        <div class="meta-stats-row">
                            <div class="meta-stat-item">
                                <small>Cakupan Wilayah</small>
                                <strong><?= $kec['desa_count']; ?> Desa / Kel</strong>
                            </div>
                            <div class="meta-stat-item">
                                <small>Koneksi SIM</small>
                                <strong style="color: var(--emerald);"><i class="fa-solid fa-circle-check"></i> Siaga</strong>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-action-view" onclick="openDistrictModal('<?= $kec['nama']; ?>', '<?= $kec['kode']; ?>', <?= $kec['desa_count']; ?>, <?= htmlspecialchars(json_encode($kec['sample'])); ?>)">
                        <span>Buka Direktori Desa</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>

    </main>

    <!-- Modal Modern Multi-Kolom Direktori & Pendaftaran Portal Desa -->
    <div class="modal-overlay" id="districtModal" onclick="closeModalOutside(event)">
        <div class="modal-container">
            <div class="modal-header-bar">
                <h3 id="modalKecTitle"><i class="fa-solid fa-landmark" style="color: var(--primary);"></i> Direktori Desa</h3>
                <button type="button" class="btn-modal-close" onclick="closeDistrictModal()">&times;</button>
            </div>
            
            <div class="modal-body-content">
                <!-- Nav Tabs Modal -->
                <div class="modal-nav-tabs">
                    <button type="button" class="tab-btn active" id="tabBtnList" onclick="switchModalTab('list')">
                        <i class="fa-solid fa-list-check"></i> Daftar Portal Desa
                    </button>
                    <button type="button" class="tab-btn" id="tabBtnForm" onclick="switchModalTab('form')">
                        <i class="fa-solid fa-paper-plane"></i> Ajukan Integrasi Web Baru
                    </button>
                </div>

                <!-- Tab Content 1: Direktori Desa -->
                <div id="tabContentList">
                    <div class="detail-summary-strip">
                        <div>
                            <small style="color: var(--text-muted); font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Kode Wilayah</small>
                            <div id="modalKecCode" style="font-size: 0.95rem; font-weight: 800; color: var(--text-dark);">-</div>
                        </div>
                        <div>
                            <small style="color: var(--text-muted); font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Jumlah Balai Desa</small>
                            <div id="modalKecCount" style="font-size: 0.95rem; font-weight: 800; color: var(--primary);">-</div>
                        </div>
                        <div>
                            <small style="color: var(--text-muted); font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">Status Portal</small>
                            <div style="font-size: 0.95rem; font-weight: 800; color: var(--emerald);"><i class="fa-solid fa-signal"></i> Terintegrasi</div>
                        </div>
                    </div>

                    <div class="search-mini-bar">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="villageMiniSearch" placeholder="Cari nama desa di kecamatan ini..." oninput="filterVillageMini(this.value)">
                    </div>

                    <div class="village-list-grid" id="villageListGrid">
                        <!-- Item Desa dirender dinamis -->
                    </div>
                </div>

                <!-- Tab Content 2: Form Pengajuan Portal Baru (Multi-Kolom) -->
                <div id="tabContentForm" style="display: none;">
                    <form onsubmit="handlePortalSubmit(event)">
                        <div class="form-grid-columns">
                            <div class="form-group-custom">
                                <label>Kecamatan Wilayah</label>
                                <input type="text" id="formInputKec" readonly style="background: #f8fafc; font-weight: 700; color: var(--primary);">
                            </div>
                            <div class="form-group-custom">
                                <label>Nama Desa / Kelurahan</label>
                                <input type="text" required placeholder="Contoh: Desa Sugiharjo">
                            </div>
                            <div class="form-group-custom">
                                <label>Nama Operator / Aparatur Pemohon</label>
                                <input type="text" required placeholder="Nama lengkap petugas">
                            </div>
                            <div class="form-group-custom">
                                <label>Nomor WhatsApp Resmi Desa</label>
                                <input type="text" required placeholder="08xxxxxxxxxx" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="form-group-custom full-span">
                                <label>Alamat Domain Web Desa (.desa.id / domain kustom)</label>
                                <input type="url" required placeholder="https://namadesa.desa.id">
                            </div>
                            <div class="form-group-custom full-span">
                                <label>Catatan Integrasi / Keterangan</label>
                                <textarea rows="3" placeholder="Tuliskan catatan tambahan mengenai portal desa..."></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn-submit-portal" style="width: 100%;">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan Integrasi
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Script Filter & Interaktif Modal -->
    <script>
        let currentVillageData = [];

        function filterDistricts(val) {
            const query = val.toLowerCase().trim();
            const cards = document.querySelectorAll('.district-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(query)) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('counterPill').innerHTML = `
                <i class="fa-solid fa-building-columns"></i>
                <span>${visibleCount} Distrik Ditemukan</span>
            `;
        }

        function openDistrictModal(namaKec, kode, jumlahDesa, listDesa) {
            document.getElementById('modalKecTitle').innerHTML = `<i class="fa-solid fa-landmark" style="color: var(--primary);"></i> Wilayah Kecamatan ${namaKec}`;
            document.getElementById('modalKecCode').innerText = kode;
            document.getElementById('modalKecCount').innerText = `${jumlahDesa} Desa / Kelurahan`;
            document.getElementById('formInputKec').value = `Kecamatan ${namaKec}`;

            currentVillageData = listDesa;
            renderVillageList(listDesa);

            switchModalTab('list');
            document.getElementById('districtModal').style.display = 'flex';
        }

        function renderVillageList(list) {
            const grid = document.getElementById('villageListGrid');
            grid.innerHTML = '';

            if (list.length === 0) {
                grid.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 20px; color: var(--text-muted); font-size: 0.85rem;">Tidak ada desa yang cocok dengan pencarian.</div>';
                return;
            }

            list.forEach(desa => {
                const slug = desa.toLowerCase().replace(/\s+/g, '');
                const chip = document.createElement('div');
                chip.className = 'village-chip-item';
                chip.setAttribute('data-village', desa.toLowerCase());
                chip.innerHTML = `
                    <div>
                        <strong style="font-size: 0.84rem; display: block; color: var(--text-dark);">${desa}</strong>
                        <small style="color: var(--text-muted); font-size: 0.7rem;">Portal Web Resmi Aktif</small>
                    </div>
                    <a href="https://${slug}.desa.id" target="_blank" rel="noopener noreferrer">
                        <span>Kunjungi</span>
                        <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    </a>
                `;
                grid.appendChild(chip);
            });
        }

        function filterVillageMini(val) {
            const q = val.toLowerCase().trim();
            const filtered = currentVillageData.filter(d => d.toLowerCase().includes(q));
            renderVillageList(filtered);
        }

        function switchModalTab(tab) {
            const btnList = document.getElementById('tabBtnList');
            const btnForm = document.getElementById('tabBtnForm');
            const contentList = document.getElementById('tabContentList');
            const contentForm = document.getElementById('tabContentForm');

            if (tab === 'list') {
                btnList.classList.add('active');
                btnForm.classList.remove('active');
                contentList.style.display = 'block';
                contentForm.style.display = 'none';
            } else {
                btnForm.classList.add('active');
                btnList.classList.remove('active');
                contentList.style.display = 'none';
                contentForm.style.display = 'block';
            }
        }

        function handlePortalSubmit(e) {
            e.preventDefault();
            alert('Pengajuan integrasi portal desa telah dikirimkan ke Dinas Kominfo Kabupaten Tuban untuk verifikasi.');
            closeDistrictModal();
        }

        function closeDistrictModal() {
            document.getElementById('districtModal').style.display = 'none';
            document.getElementById('villageMiniSearch').value = '';
        }

        function closeModalOutside(e) {
            if (e.target.id === 'districtModal') {
                closeDistrictModal();
            }
        }
    </script>
</body>
</html>