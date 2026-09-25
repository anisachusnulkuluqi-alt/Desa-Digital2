<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Digital - Pemerintah Kabupaten Tuban</title>
    
    <!-- Google Fonts: Plus Jakarta Sans & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --header-bg: #0f172a;
            
            --primary-blue: #0284c7;
            --primary-blue-dark: #0369a1;
            --primary-blue-light: #e0f2fe;
            --accent-cyan: #06b6d4;
            --accent-cyan-glow: #38bdf8;
            
            --color-blue: #2563eb;
            --color-emerald: #10b981;
            --color-amber: #f59e0b;
            --color-rose: #f43f5e;
            --color-violet: #8b5cf6;
            --color-teal: #0d9488;
            --color-indigo: #4f46e5;
            
            --text-dark: #0f172a;
            --text-gray: #475569;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --border-card: #e5e7eb;
        }

        html { scroll-behavior: smooth; }
        section[id], footer[id] { scroll-margin-top: 80px; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        body { 
            background-color: var(--bg-body); 
            color: var(--text-dark); 
            overflow-x: hidden; 
        }

        /* 1. TOP NAVBAR */
        .main-navbar {
            background: #ffffff;
            padding: 14px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid var(--border-soft);
        }

        .navbar-brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 40px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
            display: block;
        }

        .brand-title-text {
            font-size: 1.28rem;
            font-weight: 800;
            color: var(--text-dark);
            letter-spacing: -0.02em;
        }
        .brand-title-text span {
            color: var(--primary-blue);
        }

        .navbar-nav-cluster {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links-menu {
            display: flex;
            list-style: none;
            gap: 24px;
            align-items: center;
        }

        .nav-links-menu a {
            color: var(--text-gray);
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            position: relative;
            padding: 6px 0;
            transition: color 0.2s ease;
        }
        .nav-links-menu a:hover, .nav-links-menu a.active {
            color: var(--primary-blue);
        }

        .search-pill-nav {
            display: flex;
            align-items: center;
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-radius: 40px;
            padding: 6px 14px;
            width: 220px;
            transition: all 0.25s ease;
        }
        .search-pill-nav:focus-within {
            width: 260px;
            background: #ffffff;
            border-color: var(--primary-blue);
            box-shadow: 0 0 12px rgba(2, 132, 199, 0.15);
        }
        .search-pill-nav input {
            background: transparent;
            border: none;
            outline: none;
            color: var(--text-dark);
            font-size: 0.82rem;
            width: 100%;
        }
        .search-pill-nav input::placeholder { color: var(--text-muted); }
        .search-pill-nav button {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            font-size: 0.85rem;
        }
        .search-pill-nav button:hover { color: var(--primary-blue); }

        /* 2. HERO BANNER */
        .hero-banner-clean {
            position: relative;
            min-height: 540px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 24px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-banner-clean::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.7) 0%, rgba(2, 132, 199, 0.5) 100%);
        }

        .hero-content-wrap {
            position: relative;
            z-index: 2;
            max-width: 880px;
        }

        .hero-badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.35);
            padding: 6px 20px;
            border-radius: 30px;
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }

        .hero-main-title {
            font-size: 3.8rem;
            font-weight: 900;
            letter-spacing: -0.025em;
            color: #ffffff;
            line-height: 1.15;
            margin-bottom: 12px;
            text-shadow: 0 4px 18px rgba(0, 0, 0, 0.6);
        }

        .hero-lead-text {
            font-size: 1.15rem;
            color: #f1f5f9;
            font-weight: 500;
            margin-bottom: 34px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.6);
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 13px 40px;
            border-radius: 50px;
            background: #ffffff;
            color: var(--primary-blue-dark);
            font-size: 0.92rem;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            transition: all 0.25s ease;
        }
        .btn-hero-primary:hover {
            background: var(--primary-blue-light);
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(2, 132, 199, 0.35);
        }

        /* 3. ACCORDION & VIDEO */
        .section-profil-accordion {
            padding: 90px 7%;
            background: #ffffff;
        }

        .section-header-clean {
            text-align: center;
            max-width: 720px;
            margin: 0 auto 46px auto;
        }
        .header-tag-pill {
            display: inline-block;
            background: var(--primary-blue-light);
            color: var(--primary-blue-dark);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        .section-header-clean h2 {
            font-size: 2.25rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            color: var(--text-dark);
        }

        .profil-dual-layout {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 36px;
            max-width: 1240px;
            margin: 0 auto;
            align-items: stretch;
        }

        .accordion-stack-clean {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .accordion-item-clean {
            border: 1.5px solid var(--border-soft);
            border-radius: 14px;
            background: #ffffff;
            overflow: hidden;
            transition: all 0.25s ease;
        }
        .accordion-item-clean.active {
            border-color: var(--primary-blue);
            box-shadow: 0 8px 24px -4px rgba(2, 132, 199, 0.12);
        }

        .accordion-header-btn {
            width: 100%;
            padding: 18px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #ffffff;
            border: none;
            cursor: pointer;
            text-align: left;
        }
        .accordion-item-clean.active .accordion-header-btn {
            background: #f0f9ff;
        }

        .accordion-title-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .accordion-title-wrap i {
            color: var(--primary-blue);
            font-size: 1.15rem;
        }

        .accordion-header-btn i.fa-chevron-down {
            color: var(--text-muted);
            font-size: 0.85rem;
            transition: transform 0.25s ease;
        }
        .accordion-item-clean.active i.fa-chevron-down {
            transform: rotate(180deg);
            color: var(--primary-blue);
        }

        .accordion-content-text {
            display: none;
            padding: 20px 24px;
            font-size: 0.88rem;
            color: var(--text-gray);
            line-height: 1.75;
            background: #ffffff;
            border-top: 1px solid #f1f5f9;
        }
        .accordion-item-clean.active .accordion-content-text {
            display: block;
        }

        .video-player-frame {
            border-radius: 16px;
            overflow: hidden;
            border: 1.5px solid var(--border-soft);
            box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            background: #0f172a;
        }
        .video-top-tag {
            background: #ffffff;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: var(--text-gray);
            font-weight: 700;
            border-bottom: 1px solid var(--border-soft);
        }
        .video-top-tag span i { color: #ef4444; margin-right: 8px; }
        .video-embed-box {
            position: relative;
            flex-grow: 1;
            min-height: 380px;
            background: #000000;
        }
        .video-embed-box iframe {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            border: none;
        }

        /* 4. SEKSI STATISTIK */
        .section-stats-bright {
            padding: 95px 7%;
            background: #f1f5f9;
            border-top: 1px solid var(--border-soft);
            border-bottom: 1px solid var(--border-soft);
        }

        .stats-cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 22px;
            max-width: 1240px;
            margin: 0 auto;
        }

        .stat-card-modern {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            border-radius: 16px;
            padding: 24px 20px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .stat-card-modern::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: var(--stat-accent, var(--primary-blue));
        }
        .stat-card-modern:hover {
            transform: translateY(-5px);
            border-color: var(--stat-accent, var(--primary-blue));
            box-shadow: 0 16px 30px -4px rgba(0, 0, 0, 0.08);
        }

        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
        }
        .stat-icon-wrap {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--stat-bg, #e0f2fe);
            color: var(--stat-accent, var(--primary-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .stat-badge-info {
            font-size: 0.68rem;
            font-weight: 800;
            color: var(--text-muted);
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .stat-main-number {
            font-size: 2.8rem;
            font-weight: 900;
            color: var(--text-dark);
            line-height: 1;
            letter-spacing: -0.03em;
            margin-bottom: 6px;
        }
        .stat-title-text {
            font-size: 0.94rem;
            font-weight: 800;
            color: var(--primary-blue-dark);
            margin-bottom: 14px;
        }

        .stat-progress-bar {
            height: 5px;
            width: 100%;
            background: #f1f5f9;
            border-radius: 6px;
            overflow: hidden;
            margin-bottom: 8px;
        }
        .stat-progress-val {
            height: 100%;
            border-radius: 6px;
            background: var(--stat-accent, var(--primary-blue));
        }

        .stat-footer-note {
            display: flex;
            justify-content: space-between;
            font-size: 0.72rem;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* 5. HUB LAYANAN DIGITAL */
        .section-services-clean {
            padding: 95px 7%;
            background: #ffffff;
            text-align: center;
        }

        .services-cards-cluster {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            max-width: 1240px;
            margin: 0 auto;
        }

        .service-card-clean {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            border-radius: 18px;
            padding: 32px 18px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.25s ease;
        }
        .service-card-clean:hover {
            transform: translateY(-6px);
            border-color: var(--primary-blue);
            box-shadow: 0 16px 30px -4px rgba(2, 132, 199, 0.12);
        }

        /* Highlight khusus untuk kartu Data Spasial */
        .service-card-clean.highlight-card {
            border: 2px solid var(--color-emerald);
            background: #f0fdf4;
        }

        .service-icon-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.45rem;
            color: #ffffff;
            margin-bottom: 18px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }

        .service-card-clean h4 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .service-card-clean p {
            font-size: 0.78rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* 6. LOKASI KEDINASAN */
        .section-location-clean {
            padding: 72px 0;
            background: #f8fafc;
            border-top: 1px solid var(--border-soft);
        }

        .location-grid-layout {
            display: grid;
            grid-template-columns: minmax(280px, 0.9fr) minmax(420px, 2fr) minmax(300px, 1.25fr);
            gap: 0;
            width: 100%;
            margin: 0;
            align-items: stretch;
        }

        .location-info-card {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            border-radius: 0;
            padding: 38px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.03);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .location-info-card h3 {
            font-size: 1.3rem;
            font-weight: 900;
            line-height: 1.4;
            color: var(--text-dark);
            margin-bottom: 24px;
        }

        .location-details-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-bottom: 28px;
        }

        .location-detail-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }
        .location-detail-item i {
            font-size: 1.2rem;
            color: var(--primary-blue);
            margin-top: 3px;
            min-width: 24px;
        }

        .detail-texts small {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            display: block;
            margin-bottom: 2px;
        }
        .detail-texts p, .detail-texts a {
            font-size: 0.88rem;
            color: var(--text-dark);
            text-decoration: none;
            line-height: 1.5;
            font-weight: 600;
        }
        .detail-texts a:hover { color: var(--primary-blue); }

        .btn-maps-route {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            background: var(--primary-blue);
            color: #ffffff;
            font-size: 0.88rem;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-maps-route:hover {
            background: var(--primary-blue-dark);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.3);
            color: #ffffff;
        }

        .map-viewport-frame {
            border-radius: 0;
            border: 1.5px solid var(--border-soft);
            border-left: 0;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            min-height: 500px;
        }
        .map-viewport-frame iframe {
            width: 100%;
            height: 100%;
            min-height: 500px;
            border: none;
        }

        /* 7. FOOTER */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 32px 7%;
            font-size: 0.84rem;
            text-align: center;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .profil-dual-layout { grid-template-columns: 1fr; }
            .stats-cards-grid { grid-template-columns: repeat(2, 1fr); }
            .services-cards-cluster { grid-template-columns: repeat(3, 1fr); }
            .location-grid-layout { grid-template-columns: 1fr; }
            .map-viewport-frame { border-left: 1.5px solid var(--border-soft); }
        }

        @media (max-width: 768px) {
            .navbar-nav-cluster { display: none; }
            .hero-main-title { font-size: 2.7rem; }
            .hero-lead-text { font-size: 1rem; }
            .stats-cards-grid { grid-template-columns: 1fr; }
            .services-cards-cluster { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- 1. TOP NAVBAR -->
    <nav class="main-navbar">
        <a href="{{ url('/') }}" class="navbar-brand-link">
            <img src="{{ asset('images/desa-digital.png') }}" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-img"
                 onerror="this.onerror=null; this.src='{{ asset('images/desa-digital.png') }}'; this.onerror=function(){ this.style.display='none'; document.getElementById('altLogoText').style.display='inline'; };">
            
            <span id="altLogoText" class="brand-title-text" style="display: none;">
                Desa<span>Digital</span>
            </span>
        </a>

        <div class="navbar-nav-cluster">
            <ul class="nav-links-menu">
                <li><a href="#hero-banner" class="active">Beranda</a></li>
                <li><a href="#tentang-kami">Tentang Kami</a></li>
                <li><a href="#statistik-wilayah">Statistik</a></li>
                <li><a href="#layanan-digital">Layanan</a></li>
                <li><a href="{{ url('/data-spasial') }}">Peta Spasial</a></li>
                <li><a href="#lokasi-kami">Hubungi Kami</a></li>
            </ul>

            <form class="search-pill-nav" action="{{ url('/desa') }}" method="GET">
                <input type="text" name="search" placeholder="Cari desa / modul...">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </nav>

    <!-- 2. HERO BANNER -->
    <section id="hero-banner" class="hero-banner-clean" style="background-image: url('{{ asset('images/alun-alun-tuban.jpg') }}');">
        <div class="hero-content-wrap">
            <div class="hero-badge-pill">
                <i class="fa-solid fa-circle-nodes"></i> PORTAL RESMI PEMERINTAH KABUPATEN TUBAN
            </div>
            <h1 class="hero-main-title">Desa Digital</h1>
            <p class="hero-lead-text">Digitalisasi Terpadu Pemerintahan Desa Menuju Pelayanan Publik yang Efisien & Transparan</p>
            <a href="{{ url('/data-spasial') }}" class="btn-hero-primary">
                <span>Eksplorasi Peta Spasial</span>
                <i class="fa-solid fa-map-location-dot"></i>
            </a>
        </div>
    </section>

    <!-- 3. ACCORDION & VIDEO -->
    <section id="tentang-kami" class="section-profil-accordion">
        <div class="section-header-clean">
            <span class="header-tag-pill">Pilar Transformasi Digital</span>
            <h2>Inovasi Ekosistem Desa</h2>
        </div>

        <div class="profil-dual-layout">
            <div class="accordion-stack-clean">
                
                <div class="accordion-item-clean active" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <i class="fa-solid fa-globe"></i>
                            Website Desa & Media Sosial Resmi
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Kanal informasi resmi milik pemerintah desa di Kabupaten Tuban yang memuat profil wilayah, transparansi APBDes, potensi desa, dan publikasi kegiatan aparatur secara real-time.
                    </div>
                </div>

                <div class="accordion-item-clean" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <i class="fa-solid fa-laptop-code"></i>
                            Layanan Digital & Administrasi Persuratan
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Integrasi sistem pelayanan kependudukan mandiri seperti SKU, Surat Domisili, dan Pengantar SKCK dengan tanda tangan barcode resmi untuk mempercepat urusan warga.
                    </div>
                </div>

                <div class="accordion-item-clean" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <i class="fa-solid fa-wifi"></i>
                            Akses Internet & WiFi Publik Desa
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Penyediaan akses internet pita lebar dan jaringan WiFi publik gratis di titik-titik kumpul masyarakat serta balai desa untuk pemerataan literasi digital.
                    </div>
                </div>

                <div class="accordion-item-clean" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <i class="fa-solid fa-desktop"></i>
                            Anjungan Pelayanan Mandiri (Kiosk)
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Mesin cetak dokumen mandiri berbasis digital yang ditempatkan di balai desa, memudahkan masyarakat mengajukan surat tanpa perlu antre lama di loket.
                    </div>
                </div>

            </div>

            <div class="video-player-frame">
                <div class="video-top-tag">
                    <span><i class="fa-brands fa-youtube"></i> Diskominfo-SP Tuban</span>
                    <span style="color: var(--primary-blue);"><i class="fa-solid fa-circle-check"></i> Siaran Resmi</span>
                </div>
                <div class="video-embed-box">
                    <iframe 
                        src="https://www.youtube.com/embed/gPCZo6dKDWM?rel=0" 
                        title="Profil Desa Digital Kabupaten Tuban" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. SEKSI STATISTIK (MENGHUBUNGKAN KE DATA SPASIAL & FILTER) -->
    <section id="statistik-wilayah" class="section-stats-bright">
        <div class="section-header-clean">
            <span class="header-tag-pill">Data Statistik Terintegrasi</span>
            <h2>Capaian Digitalisasi Kabupaten Tuban</h2>
        </div>

        <div class="stats-cards-grid">
            
            <!-- 1. WiFi Desa -> Langsung membuka peta dengan filter wifi -->
            <a href="{{ url('/data-spasial?filter=wifi') }}" class="stat-card-modern" style="--stat-accent: #0284c7; --stat-bg: #e0f2fe;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-wifi"></i></div>
                        <span class="stat-badge-info">Peta Spasial</span>
                    </div>
                    <div class="stat-main-number">448</div>
                    <div class="stat-title-text">Titik WiFi Desa</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 92%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>Klik untuk lihat di Peta</span>
                        <strong>92% Terpasang</strong>
                    </div>
                </div>
            </a>

            <!-- 2. Website Desa -->
            <a href="{{ url('/desa') }}" class="stat-card-modern" style="--stat-accent: #2563eb; --stat-bg: #dbeafe;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-globe"></i></div>
                        <span class="stat-badge-info">Portal Resmi</span>
                    </div>
                    <div class="stat-main-number">328</div>
                    <div class="stat-title-text">Website Desa Aktif</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 100%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>328 Desa & Kelurahan</span>
                        <strong>100% Online</strong>
                    </div>
                </div>
            </a>

            <!-- 3. Wisata Desa -> Buka data spasial dengan filter wisata -->
            <a href="{{ url('/data-spasial?filter=wisata') }}" class="stat-card-modern" style="--stat-accent: #10b981; --stat-bg: #d1fae5;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-mountain-sun"></i></div>
                        <span class="stat-badge-info">Peta Spasial</span>
                    </div>
                    <div class="stat-main-number">35</div>
                    <div class="stat-title-text">Wisata Desa Terdata</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 80%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>Klik untuk lihat di Peta</span>
                        <strong>Aktif Terpetakan</strong>
                    </div>
                </div>
            </a>

            <!-- 4. Kantor Desa -> Buka data spasial dengan filter kantor -->
            <a href="{{ url('/data-spasial?filter=kantor') }}" class="stat-card-modern" style="--stat-accent: #4f46e5; --stat-bg: #e0e7ff;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-building-columns"></i></div>
                        <span class="stat-badge-info">Peta Spasial</span>
                    </div>
                    <div class="stat-main-number">328</div>
                    <div class="stat-title-text">Kantor Pelayanan Desa</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 100%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>20 Kecamatan</span>
                        <strong>Terverifikasi</strong>
                    </div>
                </div>
            </a>

            <!-- 5. Pasar Desa -> Buka data spasial dengan filter pasar -->
            <a href="{{ url('/data-spasial?filter=pasar') }}" class="stat-card-modern" style="--stat-accent: #f59e0b; --stat-bg: #fef3c7;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-store"></i></div>
                        <span class="stat-badge-info">Peta Spasial</span>
                    </div>
                    <div class="stat-main-number">38</div>
                    <div class="stat-title-text">Pasar Rakyat Desa</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 70%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>Klik untuk lihat di Peta</span>
                        <strong>Digitalisasi Non-Tunai</strong>
                    </div>
                </div>
            </a>

            <!-- 6. BUMDes -->
            <a href="{{ url('/data-spasial?filter=bumdes') }}" class="stat-card-modern" style="--stat-accent: #8b5cf6; --stat-bg: #ede9fe;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-briefcase"></i></div>
                        <span class="stat-badge-info">Peta Spasial</span>
                    </div>
                    <div class="stat-main-number">309</div>
                    <div class="stat-title-text">Unit BUMDes Berjalan</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 88%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>Klik untuk lihat di Peta</span>
                        <strong>Aktif Beroperasi</strong>
                    </div>
                </div>
            </a>

            <!-- 7. KKDMP -->
            <a href="{{ url('/desa') }}" class="stat-card-modern" style="--stat-accent: #f43f5e; --stat-bg: #ffe4e6;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-chart-pie"></i></div>
                        <span class="stat-badge-info">Perencanaan</span>
                    </div>
                    <div class="stat-main-number">83</div>
                    <div class="stat-title-text">Dokumen KKDMP</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 83%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>Pembangunan Desa</span>
                        <strong>Tersinkronisasi</strong>
                    </div>
                </div>
            </a>

            <!-- 8. Distrik Kecamatan -->
            <a href="{{ url('/kecamatan') }}" class="stat-card-modern" style="--stat-accent: #0d9488; --stat-bg: #ccfbf1;">
                <div>
                    <div class="stat-card-header">
                        <div class="stat-icon-wrap"><i class="fa-solid fa-sitemap"></i></div>
                        <span class="stat-badge-info">Wilayah Distrik</span>
                    </div>
                    <div class="stat-main-number">20</div>
                    <div class="stat-title-text">Kecamatan Penyelenggara</div>
                </div>
                <div>
                    <div class="stat-progress-bar">
                        <div class="stat-progress-val" style="width: 100%;"></div>
                    </div>
                    <div class="stat-footer-note">
                        <span>Koordinasi Distrik</span>
                        <strong>100% Terintegrasi</strong>
                    </div>
                </div>
            </a>

        </div>
    </section>

    <!-- 5. HUB LAYANAN DIGITAL (OPSI DAN ATRIBUT DATA SPASIAL DIHUBUNGKAN KE GAMBAR 1) -->
    <section id="layanan-digital" class="section-services-clean">
        <div class="section-header-clean">
            <span class="header-tag-pill">Pusat Layanan Terpadu</span>
            <h2>Gerbang Layanan Publik Digital</h2>
        </div>

        <div class="services-cards-cluster">
            
            <!-- 1. Website Desa -->
        <a href="{{ url('/website') }}" class="service-card-clean" title="Buka Direktori Website Desa">
    <div class="service-icon-circle" style="background: linear-gradient(135deg, #2563eb, #3b82f6);">
        <i class="fa-solid fa-globe"></i>
    </div>
    <h4>Website Desa</h4>
    <p>Katalog profil kelurahan dan informasi publik desa.</p>
        </a>

            <!-- 2. Data Spasial (Membuka Peta Gambar 1) -->
            <a href="{{ url('/data-spasial') }}" class="service-card-clean highlight-card" title="Klik untuk membuka Geoportal Peta Spasial">
                <div class="service-icon-circle" style="background: linear-gradient(135deg, #059669, #10b981);">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h4>Data Spasial</h4>
                <p>Peta geospasial sebaran WiFi, pasar, dan BUMDes.</p>
            </a>

            <!-- 3. Surat Desa -->
<a href="{{ url('/surat') }}" class="service-card-clean" title="Pengajuan Surat Mandiri Desa">
    <div class="service-icon-circle" style="background: linear-gradient(135deg, #d97706, #f59e0b);">
        <i class="fa-solid fa-envelope-open-text"></i>
    </div>
    <h4>Surat Desa</h4>
    <p>Permohonan SKU, domisili, dan surat mandiri.</p>
</a>

           <!-- 4. CCTV -->
<a href="{{ url('/cctv') }}" class="service-card-clean" title="Pantauan Live CCTV Wilayah">
    <div class="service-icon-circle" style="background: linear-gradient(135deg, #e11d48, #f43f5e);">
        <i class="fa-solid fa-video"></i>
    </div>
    <h4>CCTV</h4>
    <p>Pantau titik keramaian dan keamanan wilayah Tuban.</p>
</a>

          <!-- 5. e-PBB -->
<a href="{{ url('/epbb') }}" class="service-card-clean" title="Layanan Pajak PBB-P2 Online">
    <div class="service-icon-circle" style="background: linear-gradient(135deg, #7c3aed, #8b5cf6);">
        <i class="fa-solid fa-qrcode"></i>
    </div>
    <h4>e-PBB</h4>
    <p>Cek tagihan & pembayaran pajak PBB online.</p>
</a>

        </div>
    </section>

    <!-- 6. LOKASI KEDINASAN -->
    <section id="lokasi-kami" class="section-location-clean">
        <div class="location-grid-layout">
            
            <div class="location-info-card">
                <div>
                    <h3>Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Tuban</h3>
                    
                    <div class="location-details-list">
                        <div class="location-detail-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <div class="detail-texts">
                                <small>Alamat Kantor</small>
                                <p>Jalan Mastrip Nomor 5 A, Tuban, Jawa Timur 62315</p>
                            </div>
                        </div>

                        <div class="location-detail-item">
                            <i class="fa-solid fa-phone"></i>
                            <div class="detail-texts">
                                <small>Telepon Kedinasan</small>
                                <p>(0356) 8832697</p>
                            </div>
                        </div>

                        <div class="location-detail-item">
                            <i class="fa-solid fa-globe"></i>
                            <div class="detail-texts">
                                <small>Website Resmi</small>
                                <p><a href="https://diskominfo.tubankab.go.id" target="_blank">diskominfo.tubankab.go.id</a></p>
                            </div>
                        </div>

                        <div class="location-detail-item">
                            <i class="fa-solid fa-envelope"></i>
                            <div class="detail-texts">
                                <small>Email Layanan</small>
                                <p><a href="mailto:diskominfo@tubankab.go.id">diskominfo@tubankab.go.id</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="https://maps.google.com/?q=Dinas+Komunikasi+dan+Informatika+Kabupaten+Tuban" target="_blank" class="btn-maps-route">
                    <i class="fa-solid fa-diamond-turn-right"></i>
                    <span>Buka Rute di Google Maps</span>
                </a>
            </div>

            <div class="map-viewport-frame">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!4v1790305660366!6m8!1m7!1szab-FoOpFkmJVJ79X0G0Pw!2m2!1d-6.901873934235668!2d112.0440727763729!3f119.96725389059543!4f-2.7866853560054636!5f0.7820865974627469"
                    width="800"
                    height="600"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="strict-origin-when-cross-origin">
                </iframe>
            </div>

            <div class="map-viewport-frame">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2783857500585!2d112.06014457499708!3d-6.893196993106037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e779a528e57929d%3A0x6bce98799bb52f75!2sDinas%20Komunikasi%20dan%20Informatika%20Kabupaten%20Tuban!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid"
                    title="Google Maps Dinas Komunikasi dan Informatika Kabupaten Tuban"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

        </div>
    </section>

    <!-- 7. FOOTER -->
    <footer>
        <p>&copy; 2026 Pemerintah Kabupaten Tuban • Dinas Komunikasi, Informatika, Statistik dan Persandian. Seluruh hak cipta dilindungi.</p>
    </footer>

    <!-- SCRIPT ACCORDION INTERAKTIF -->
    <script>
        function switchCleanAccordion(element) {
            const allItems = document.querySelectorAll('.accordion-item-clean');
            const isCurrentlyActive = element.classList.contains('active');

            allItems.forEach(item => item.classList.remove('active'));

            if (!isCurrentlyActive) {
                element.classList.add('active');
            }
        }
    </script>
</body>
</html>