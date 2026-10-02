<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Desa & Kelurahan - Kabupaten Tuban</title>
    <link rel="icon" type="image/png" href="<?= asset('images/desa-digital.png'); ?>">

    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-canvas: #f8fafc;
            --bg-card: #ffffff;
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --border-hover: #7dd3fc;
            --emerald: #10b981;
            
            /* WARNA HEADER & LOGO PERSIS GAMBAR */
            --header-dark-slate: #283548;
            --digital-cyan: #28b2fc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-canvas); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }

        /* 1. Header Navbar Persis Gambar Referensi */
        .site-header {
            background-color: var(--header-dark-slate);
            padding: 14px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.18);
        }

        .brand-link-clean {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            background: transparent;
            padding: 0;
            border: none;
        }

        /* Ikon Logo: Murni dari file gambar asli */
        .brand-logo-icon {
            height: 36px;
            width: auto;
            max-width: 48px;
            object-fit: contain;
            display: block;
        }

        /* Teks Logo: "Desa Digital" Persis Gambar */
        .brand-text-logo {
            font-size: 1.6rem;
            letter-spacing: -0.02em;
            line-height: 1;
            display: flex;
            align-items: baseline;
            gap: 6px;
            font-weight: 800;
        }
        .brand-text-logo .text-desa {
            color: #ffffff;
            font-weight: 800;
        }
        .brand-text-logo .text-digital {
            color: var(--digital-cyan);
            font-weight: 800;
        }

        .nav-menu { 
            display: flex; 
            align-items: center; 
            gap: 28px; 
            list-style: none; 
        }
        .nav-menu a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 800;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            position: relative;
            padding: 4px 0;
            transition: color 0.2s ease;
        }
        .nav-menu a:hover,
        .nav-menu a.active { 
            color: var(--digital-cyan); 
        }
        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            right: 0;
            height: 2.5px;
            background: var(--digital-cyan);
            border-radius: 2px;
        }

        /* 2. Hero Ringkas & Minimalis */
        .hero-compact {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            padding: 45px 7% 65px 7%;
            text-align: center;
            position: relative;
        }
        .hero-compact h1 {
            font-size: 2.2rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        }
        .hero-compact p {
            font-size: 0.95rem;
            color: #94a3b8;
            max-width: 600px;
            margin: 0 auto;
        }

        /* 3. Container & Filter Floating Bar */
        .content-wrap {
            max-width: 1240px;
            margin: -30px auto 70px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .filter-bar-minimal {
            background: #ffffff;
            border-radius: 14px;
            padding: 12px 20px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            border: 1.5px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .search-input-wrap {
            position: relative;
            flex: 1;
            max-width: 480px;
        }
        .search-input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            font-size: 0.85rem;
        }
        .search-input-wrap input {
            width: 100%;
            border: 1.5px solid var(--border-soft);
            border-radius: 30px;
            padding: 9px 14px 9px 38px;
            font-size: 0.85rem;
            outline: none;
            transition: all 0.25s ease;
        }
        .search-input-wrap input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 12px rgba(2, 132, 199, 0.15);
        }

        .total-distrik-pill {
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--primary-dark);
            background: var(--primary-light);
            padding: 6px 16px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* 4. Grid Kartu Kecamatan Modern */
        .district-grid-clean {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .district-item-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1.5px solid var(--border-soft);
            padding: 20px 22px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
        }
        .district-item-card::before {
            content: '';
            position: absolute;
            left: 0; top: 12px; bottom: 12px;
            width: 4px;
            border-radius: 0 4px 4px 0;
            background: var(--card-color, #0284c7);
        }
        .district-item-card:hover {
            transform: translateY(-4px);
            border-color: var(--border-hover);
            box-shadow: 0 12px 24px -4px rgba(2, 132, 199, 0.15);
        }

        .card-identity {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* Wadah Gambar Logo Tuban */
        .card-icon-round {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            flex-shrink: 0;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease;
        }
        .district-item-card:hover .card-icon-round {
            transform: scale(1.1) rotate(4deg);
            border-color: var(--border-hover);
        }

        .card-icon-round img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
        }

        .card-text h3 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-dark);
            line-height: 1.2;
        }
        .card-text small {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            display: inline-block;
            margin-top: 3px;
        }

        .card-action-cue {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 4px;
        }
        .badge-count {
            background: #f1f5f9;
            color: var(--text-dark);
            font-size: 0.72rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 8px;
            border: 1px solid var(--border-soft);
        }
        .btn-arrow-cue {
            color: var(--primary);
            font-size: 0.85rem;
            margin-top: 4px;
            transition: transform 0.2s ease;
        }
        .district-item-card:hover .btn-arrow-cue {
            transform: translateX(4px);
        }

        /* 5. Modal Drawer Data Desa */
        .modal-drawer-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(8px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-drawer-card {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 900px;
            max-height: 88vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            animation: popUp 0.25s ease-out;
        }
        @keyframes popUp {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-top-bar {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e293b 100%);
            padding: 18px 24px;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-top-bar h3 {
            font-size: 1.2rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-top-bar h3 span { color: #38bdf8; }
        .btn-close-modal {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #ffffff;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.2s;
        }
        .btn-close-modal:hover { background: rgba(255, 255, 255, 0.25); transform: rotate(90deg); }

        .modal-body-scroll {
            padding: 22px 24px;
            overflow-y: auto;
            flex: 1;
        }

        .summary-stats-box {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            background: #f8fafc;
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            padding: 12px 18px;
            margin-bottom: 20px;
        }
        .summary-stats-box div small {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            display: block;
        }
        .summary-stats-box div strong {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .village-column-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }

        .village-row-card {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            padding: 14px 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 12px;
            transition: all 0.2s ease;
        }
        .village-row-card:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.1);
        }

        .row-meta-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .row-meta-top h4 {
            font-size: 0.98rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .row-meta-top span.code-tag {
            font-size: 0.68rem;
            font-weight: 800;
            color: #0369a1;
            background: #e0f2fe;
            padding: 2px 6px;
            border-radius: 4px;
        }

        .location-info {
            font-size: 0.78rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .location-info i { color: #f43f5e; font-size: 0.82rem; }

        .row-actions-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f1f5f9;
            padding-top: 10px;
        }

        .link-web-desa {
            font-size: 0.78rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #f0f9ff;
            padding: 5px 10px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .link-web-desa:hover { background: #e0f2fe; color: var(--primary-dark); }

        .sosmed-pill-cluster {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .btn-sosmed-mini {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #475569;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-sosmed-mini:hover {
            color: #ffffff;
            transform: scale(1.15);
        }
        .btn-sosmed-mini.ig:hover { background: #e1306c; }
        .btn-sosmed-mini.fb:hover { background: #1877f2; }
        .btn-sosmed-mini.yt:hover { background: #ff0000; }

        @media (max-width: 960px) {
            .district-grid-clean { grid-template-columns: repeat(2, 1fr); }
            .village-column-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 640px) {
            .district-grid-clean { grid-template-columns: 1fr; }
            .nav-menu { display: none; }
            .summary-stats-box { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- 1. Header Navbar Persis Gambar Referensi -->
    <header class="site-header">
        <a href="<?= url('/'); ?>" class="brand-link-clean">
            <!-- Gambar Logo Ikon Murni Dari Public -->
            <img src="<?= asset('images/desa-digital.png'); ?>" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-icon"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/300px-Lambang_Kabupaten_Tuban.png';">
            
            <!-- Font Tipografi: "Desa Digital" Persis Sesuai Gambar -->
            <div class="brand-text-logo">
                <span class="text-desa">Desa</span>
                <span class="text-digital">Digital</span>
            </div>
        </a>

        <ul class="nav-menu">
            <li><a href="<?= url('/'); ?>">BERANDA</a></li>
            <li><a href="<?= url('/website'); ?>" class="active">WEBSITE DESA</a></li>
            <li><a href="<?= url('/data-spasial'); ?>">PETA SPASIAL</a></li>
            <li><a href="<?= url('/cctv'); ?>">CCTV TUBAN</a></li>
            <li><a href="<?= url('/epbb'); ?>">E-PBB</a></li>
        </ul>
    </header>

    <!-- 2. Hero Ringkas & Minimalis -->
    <section class="hero-compact">
        <h1>Direktori Website Desa & Kelurahan</h1>
        <p>Akses cepat portal resmi dan data kewilayahan 20 distrik kecamatan Kabupaten Tuban.</p>
    </section>

    <!-- 3. Main Container -->
    <main class="content-wrap">
        
        <?php
            // Data 20 Kecamatan dan Sampel Detail Desa/Kelurahan
            $distrikList = [
                ['nama' => 'Bancar', 'kode' => '35.23.01', 'total' => 24, 'color' => '#0284c7', 'villages' => [
                    ['nama' => 'Desa Bancar', 'tipe' => 'Desa', 'kode' => '35.23.01.2001', 'lokasi' => 'Pesisir Utara Bancar', 'web' => 'https://bancar.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Boncong', 'tipe' => 'Desa', 'kode' => '35.23.01.2002', 'lokasi' => 'Jl. Pantura Boncong', 'web' => 'https://boncong.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Bulu', 'tipe' => 'Desa', 'kode' => '35.23.01.2003', 'lokasi' => 'Bulu Selatan', 'web' => 'https://bulu-tuban.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Bogorejo', 'tipe' => 'Desa', 'kode' => '35.23.01.2004', 'lokasi' => 'Bogorejo Bancar', 'web' => 'https://bogorejo.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Bangilan', 'kode' => '35.23.02', 'total' => 14, 'color' => '#2563eb', 'villages' => [
                    ['nama' => 'Desa Bangilan', 'tipe' => 'Desa', 'kode' => '35.23.02.2001', 'lokasi' => 'Sentra Bangilan', 'web' => 'https://bangilan.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Kedungjambangan', 'tipe' => 'Desa', 'kode' => '35.23.02.2002', 'lokasi' => 'Kedungjambangan', 'web' => 'https://kedungjambangan.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Klampok', 'tipe' => 'Desa', 'kode' => '35.23.02.2003', 'lokasi' => 'Klampok Barat', 'web' => 'https://klampok.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Grabagan', 'kode' => '35.23.03', 'total' => 11, 'color' => '#0d9488', 'villages' => [
                    ['nama' => 'Desa Grabagan', 'tipe' => 'Desa', 'kode' => '35.23.03.2001', 'lokasi' => 'Perbukitan Grabagan', 'web' => 'https://grabagan.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Dahor', 'tipe' => 'Desa', 'kode' => '35.23.03.2002', 'lokasi' => 'Dahor Lembah', 'web' => 'https://dahor.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Jatirogo', 'kode' => '35.23.04', 'total' => 18, 'color' => '#8b5cf6', 'villages' => [
                    ['nama' => 'Desa Wotsogo', 'tipe' => 'Desa', 'kode' => '35.23.04.2001', 'lokasi' => 'Wotsogo Raya', 'web' => 'https://wotsogo.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Paseyan', 'tipe' => 'Desa', 'kode' => '35.23.04.2002', 'lokasi' => 'Paseyan Timur', 'web' => 'https://paseyan.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Jenu', 'kode' => '35.23.05', 'total' => 17, 'color' => '#0284c7', 'villages' => [
                    ['nama' => 'Desa Sugihwaras', 'tipe' => 'Desa', 'kode' => '35.23.05.2001', 'lokasi' => 'Pantai Sugihwaras', 'web' => 'https://sugihwaras.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Tasikharjo', 'tipe' => 'Desa', 'kode' => '35.23.05.2002', 'lokasi' => 'Wisata Pasir Putih', 'web' => 'https://tasikharjo.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Socorejo', 'tipe' => 'Desa', 'kode' => '35.23.05.2003', 'lokasi' => 'Kawasan Pesisir', 'web' => 'https://socorejo.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Remen', 'tipe' => 'Desa', 'kode' => '35.23.05.2004', 'lokasi' => 'Danau Remen', 'web' => 'https://remen.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Kenduruan', 'kode' => '35.23.06', 'total' => 9, 'color' => '#f43f5e', 'villages' => [
                    ['nama' => 'Desa Sidohasri', 'tipe' => 'Desa', 'kode' => '35.23.06.2001', 'lokasi' => 'Sidohasri', 'web' => 'https://sidohasri.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Kerek', 'kode' => '35.23.07', 'total' => 16, 'color' => '#d97706', 'villages' => [
                    ['nama' => 'Desa Gaji', 'tipe' => 'Desa', 'kode' => '35.23.07.2001', 'lokasi' => 'Sentra Batik Kerek', 'web' => 'https://gaji.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Merakurak', 'kode' => '35.23.08', 'total' => 19, 'color' => '#0284c7', 'villages' => [
                    ['nama' => 'Desa Bogorejo', 'tipe' => 'Desa', 'kode' => '35.23.08.2001', 'lokasi' => 'Kawasan Merakurak', 'web' => 'https://bogorejo-merakurak.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Sambonggede', 'tipe' => 'Desa', 'kode' => '35.23.08.2002', 'lokasi' => 'Lembah Hijau', 'web' => 'https://sambonggede.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Montong', 'kode' => '35.23.09', 'total' => 13, 'color' => '#10b981', 'villages' => [
                    ['nama' => 'Desa Guwoterus', 'tipe' => 'Desa', 'kode' => '35.23.09.2001', 'lokasi' => 'Kawasan Gua & Hutan', 'web' => 'https://guwoterus.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Palang', 'kode' => '35.23.10', 'total' => 19, 'color' => '#4f46e5', 'villages' => [
                    ['nama' => 'Desa Panyuran', 'tipe' => 'Desa', 'kode' => '35.23.10.2001', 'lokasi' => 'Pesisir Palang', 'web' => 'https://panyuran.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Gesikharjo', 'tipe' => 'Desa', 'kode' => '35.23.10.2002', 'lokasi' => 'Religi Asmoroqondi', 'web' => 'https://gesikharjo.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Parengan', 'kode' => '35.23.11', 'total' => 18, 'color' => '#f59e0b', 'villages' => [
                    ['nama' => 'Desa Parangbatu', 'tipe' => 'Desa', 'kode' => '35.23.11.2001', 'lokasi' => 'Lembah Parengan', 'web' => 'https://parangbatu.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Plumpang', 'kode' => '35.23.12', 'total' => 18, 'color' => '#0284c7', 'villages' => [
                    ['nama' => 'Desa Plumpang', 'tipe' => 'Desa', 'kode' => '35.23.12.2001', 'lokasi' => 'Pusat Plumpang', 'web' => 'https://plumpang.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Rengel', 'kode' => '35.23.13', 'total' => 16, 'color' => '#10b981', 'villages' => [
                    ['nama' => 'Desa Rengel', 'tipe' => 'Desa', 'kode' => '35.23.13.2001', 'lokasi' => 'Sendang Beron', 'web' => 'https://rengel.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Semanding', 'kode' => '35.23.14', 'total' => 17, 'color' => '#e11d48', 'villages' => [
                    ['nama' => 'Kelurahan Gedongombo', 'tipe' => 'Kelurahan', 'kode' => '35.23.14.1001', 'lokasi' => 'Gedongombo Kota', 'web' => 'https://gedongombo.tubankab.go.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Prunggahan Kulon', 'tipe' => 'Desa', 'kode' => '35.23.14.2002', 'lokasi' => 'Wisata Bektiharjo', 'web' => 'https://prunggahan-kulon.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Senori', 'kode' => '35.23.15', 'total' => 12, 'color' => '#8b5cf6', 'villages' => [
                    ['nama' => 'Desa Rayung', 'tipe' => 'Desa', 'kode' => '35.23.15.2001', 'lokasi' => 'Rayung Senori', 'web' => 'https://rayung.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Singgahan', 'kode' => '35.23.16', 'total' => 12, 'color' => '#0ea5e9', 'villages' => [
                    ['nama' => 'Desa Mulyoagung', 'tipe' => 'Desa', 'kode' => '35.23.16.2001', 'lokasi' => 'Air Terjun Nglirip', 'web' => 'https://mulyoagung.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Soko', 'kode' => '35.23.17', 'total' => 23, 'color' => '#f59e0b', 'villages' => [
                    ['nama' => 'Desa Sokosari', 'tipe' => 'Desa', 'kode' => '35.23.17.2001', 'lokasi' => 'Sokosari Bengawan', 'web' => 'https://sokosari.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Tambakboyo', 'kode' => '35.23.18', 'total' => 18, 'color' => '#0284c7', 'villages' => [
                    ['nama' => 'Desa Dasin', 'tipe' => 'Desa', 'kode' => '35.23.18.2001', 'lokasi' => 'Pesisir Tambakboyo', 'web' => 'https://dasin.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Tuban', 'kode' => '35.23.19', 'total' => 17, 'color' => '#10b981', 'villages' => [
                    ['nama' => 'Kelurahan Kutorejo', 'tipe' => 'Kelurahan', 'kode' => '35.23.19.1001', 'lokasi' => 'Pusat Alun-Alun Tuban', 'web' => 'https://kutorejo.tubankab.go.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Kelurahan Latsari', 'tipe' => 'Kelurahan', 'kode' => '35.23.19.1002', 'lokasi' => 'Kawasan Perkotaan', 'web' => 'https://latsari.tubankab.go.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Kelurahan Sidomulyo', 'tipe' => 'Kelurahan', 'kode' => '35.23.19.1003', 'lokasi' => 'Pusat Niaga Tuban', 'web' => 'https://sidomulyo.tubankab.go.id', 'ig' => '#', 'fb' => '#', 'yt' => '#'],
                    ['nama' => 'Desa Sugiharjo', 'tipe' => 'Desa', 'kode' => '35.23.19.2004', 'lokasi' => 'Tuban Selatan', 'web' => 'https://sugiharjo.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]],
                ['nama' => 'Widang', 'kode' => '35.23.20', 'total' => 16, 'color' => '#475569', 'villages' => [
                    ['nama' => 'Desa Compreng', 'tipe' => 'Desa', 'kode' => '35.23.20.2001', 'lokasi' => 'Lembah Bengawan Widang', 'web' => 'https://compreng.desa.id', 'ig' => '#', 'fb' => '#', 'yt' => '#']
                ]]
            ];
        ?>

        <!-- Filter Bar Bersih -->
        <div class="filter-bar-minimal">
            <div class="search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Cari nama distrik kecamatan..." oninput="handleSearch(this.value)">
            </div>
            <div class="total-distrik-pill" id="counterBadge">
                <i class="fa-solid fa-circle-check" style="color: var(--emerald);"></i>
                <span>20 Distrik Kecamatan Aktif</span>
            </div>
        </div>

        <!-- Grid Kartu dengan Logo Murni Kabupaten Tuban -->
        <div class="district-grid-clean" id="gridDistrik">
            <?php foreach ($distrikList as $item): ?>
                <div class="district-item-card" 
                     style="--card-color: <?= $item['color']; ?>;"
                     data-name="<?= strtolower($item['nama']); ?>"
                     onclick="showVillageDrawer('<?= $item['nama']; ?>', '<?= $item['kode']; ?>', <?= $item['total']; ?>, <?= htmlspecialchars(json_encode($item['villages'])); ?>)">
                    
                    <div class="card-identity">
                        <!-- Murni Memanggil Gambar Logo Asli Kabupaten Tuban -->
                        <div class="card-icon-round">
                            <img src="<?= asset('images/logo-tuban.png'); ?>" 
                                 alt="Logo Kabupaten Tuban"
                                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/300px-Lambang_Kabupaten_Tuban.png';">
                        </div>
                        <div class="card-text">
                            <h3>Kecamatan <?= $item['nama']; ?></h3>
                            <small>Kode: <?= $item['kode']; ?></small>
                        </div>
                    </div>

                    <div class="card-action-cue">
                        <span class="badge-count"><?= $item['total']; ?> Wilayah</span>
                        <i class="fa-solid fa-arrow-right btn-arrow-cue"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- 4. Modal Kolom Data Desa / Kelurahan Saat Kartu Diklik -->
    <div class="modal-drawer-overlay" id="villageModal" onclick="checkCloseOutside(event)">
        <div class="modal-drawer-card">
            
            <div class="modal-top-bar">
                <h3 id="modalKecamatanTitle">
                    <i class="fa-solid fa-layer-group"></i> 
                    Kecamatan <span>-</span>
                </h3>
                <button type="button" class="btn-close-modal" onclick="closeVillageModal()">&times;</button>
            </div>

            <div class="modal-body-scroll">
                
                <!-- Ringkasan Statistik -->
                <div class="summary-stats-box">
                    <div>
                        <small>Kode Distrik</small>
                        <strong id="modalKecKode">-</strong>
                    </div>
                    <div>
                        <small>Total Wilayah</small>
                        <strong id="modalKecTotal">-</strong>
                    </div>
                    <div>
                        <small>Status Integrasi</small>
                        <strong style="color: var(--emerald);"><i class="fa-solid fa-circle-check"></i> Siaga Terpadu</strong>
                    </div>
                </div>

                <!-- Kolom Daftar Desa/Kelurahan -->
                <div class="village-column-grid" id="villageRowsGrid">
                    <!-- Data Baris Render Otomatis -->
                </div>

            </div>
        </div>
    </div>

    <!-- Script Filter & Interaksi Klik Kolom -->
    <script>
        const searchFromUrl = new URLSearchParams(window.location.search).get('search') || '';

        function handleSearch(val) {
            const query = val.toLowerCase().trim();
            const cards = document.querySelectorAll('.district-item-card');
            let count = 0;

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                if (name.includes(query)) {
                    card.style.display = 'flex';
                    count++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('counterBadge').innerHTML = `
                <i class="fa-solid fa-circle-check" style="color: var(--emerald);"></i>
                <span>${count} Distrik Terpilih</span>
            `;
        }

        if (searchFromUrl) {
            document.getElementById('searchInput').value = searchFromUrl;
            handleSearch(searchFromUrl);
        }

        function showVillageDrawer(namaKec, kodeKec, totalDesa, villageList) {
            document.getElementById('modalKecamatanTitle').innerHTML = `
                <i class="fa-solid fa-layer-group"></i> 
                Kecamatan <span>${namaKec}</span>
            `;
            document.getElementById('modalKecKode').innerText = kodeKec;
            document.getElementById('modalKecTotal').innerText = `${totalDesa} Desa & Kelurahan`;

            const grid = document.getElementById('villageRowsGrid');
            grid.innerHTML = '';

            villageList.forEach(item => {
                const card = document.createElement('div');
                card.className = 'village-row-card';
                card.innerHTML = `
                    <div class="row-meta-top">
                        <div>
                            <h4>${item.nama}</h4>
                            <div class="location-info">
                                <i class="fa-solid fa-location-dot"></i>
                                <span>${item.lokasi}</span>
                            </div>
                        </div>
                        <span class="code-tag">${item.kode}</span>
                    </div>

                    <div class="row-actions-bottom">
                        <a href="${item.web}" target="_blank" rel="noopener" class="link-web-desa">
                            <i class="fa-solid fa-globe"></i>
                            <span>Buka Website</span>
                            <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 0.7rem;"></i>
                        </a>

                        <div class="sosmed-pill-cluster">
                            <a href="${item.ig}" target="_blank" class="btn-sosmed-mini ig" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                            <a href="${item.fb}" target="_blank" class="btn-sosmed-mini fb" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="${item.yt}" target="_blank" class="btn-sosmed-mini yt" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });

            document.getElementById('villageModal').style.display = 'flex';
        }

        function closeVillageModal() {
            document.getElementById('villageModal').style.display = 'none';
        }

        function checkCloseOutside(e) {
            if (e.target.id === 'villageModal') {
                closeVillageModal();
            }
        }
    </script>
</body>
</html>