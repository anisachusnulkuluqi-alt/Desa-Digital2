<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Digital - Kabupaten Tuban</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #38bdf8;
            --secondary: #0d9488;
            --dark-navy: #080d1a;
            --dark-card: #0f172a;
            --light-bg: #f8fafc;
            --text-dark: #0f172a;
            --text-gray: #64748b;
        }

        html { scroll-behavior: smooth; }
        section[id], footer[id] { scroll-margin-top: 75px; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); overflow-x: hidden; }

        /* TOP HEADER */
        .top-header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 12px 5%; background: #080d1a; border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .logo-area { display: flex; align-items: center; gap: 12px; }
        .logo-icon {
            width: 38px; height: 38px; background: var(--primary); border-radius: 8px;
            display: flex; align-items: center; justify-content: center; font-size: 20px; color: white;
        }
        .logo-text h2 { font-size: 1.15rem; font-weight: 700; color: #ffffff; line-height: 1.1; }
        .logo-text p { font-size: 0.65rem; color: var(--primary-light); font-weight: 600; letter-spacing: 0.5px; }

        .auth-buttons { display: flex; gap: 10px; align-items: center; }
        .btn-login {
            background: #334155; color: #ffffff; text-decoration: none; padding: 7px 18px;
            font-size: 0.85rem; font-weight: 500; border-radius: 6px; transition: 0.3s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-login:hover { background: #475569; }

        .btn-daftar {
            background: var(--primary); color: white; text-decoration: none; padding: 7px 18px;
            font-size: 0.85rem; font-weight: 500; border-radius: 6px; transition: 0.3s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-daftar:hover { background: var(--primary-dark); }

        /* NAVBAR */
        .navbar {
            display: flex; justify-content: space-between; align-items: center;
            padding: 12px 5%; background: #0f172a; border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky; top: 0; z-index: 100;
        }
        .nav-links { display: flex; list-style: none; gap: 20px; align-items: center; }
        .nav-links a { color: #94a3b8; text-decoration: none; font-size: 0.84rem; font-weight: 600; transition: 0.3s; }
        .nav-links a.active, .nav-links a:hover { color: #ffffff; }

        .status-badge {
            font-size: 0.75rem; color: var(--primary-light); display: flex; align-items: center; gap: 6px; font-weight: 500;
        }
        .status-dot { width: 7px; height: 7px; background: #22c55e; border-radius: 50%; }

        /* 1. HERO UTAMA */
        .hero-tuban {
            position: relative; min-height: 560px; display: flex; flex-direction: column;
            align-items: center; justify-content: center; text-align: center; padding: 80px 20px;
            background: linear-gradient(rgba(15, 23, 42, 0.55), rgba(2, 132, 199, 0.32)),
                        url('{{ asset("images/alun-alun-tuban.jpg") }}'),
                        url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Alun_Alun_Tuban.jpg/1200px-Alun_Alun_Tuban.jpg') center/cover no-repeat;
            background-size: cover; background-position: center; background-attachment: fixed; color: #ffffff;
        }
        .hero-subtitle {
            font-size: 0.95rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.85); margin-bottom: 10px;
        }
        .hero-title {
            font-size: 3rem; font-weight: 800; margin-bottom: 14px; line-height: 1.2;
            text-shadow: 0 4px 16px rgba(0, 0, 0, 0.95);
        }
        .hero-desc {
            font-size: 1.05rem; color: #f8fafc; max-width: 680px; margin: 0 auto 30px auto; line-height: 1.6;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.85);
        }

        .search-box {
            display: flex; align-items: center; background: #ffffff; border-radius: 50px;
            padding: 6px 8px 6px 20px; width: 100%; max-width: 580px; margin: 0 auto 20px auto;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        }
        .search-box i { color: #64748b; margin-right: 12px; }
        .search-box input { border: none; outline: none; width: 100%; font-size: 0.9rem; color: #1e293b; }
        .search-box button {
            background: var(--primary); color: white; border: none; padding: 10px 26px;
            border-radius: 50px; font-weight: 600; cursor: pointer; transition: 0.3s;
        }
        .search-box button:hover { background: var(--primary-dark); }

        .popular-tags { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center; }
        .popular-tags span { font-size: 0.85rem; color: #ffffff; font-weight: 700; text-shadow: 0 2px 6px rgba(0,0,0,0.8); }
        .tag {
            background: rgba(15, 23, 42, 0.75); color: #ffffff; font-weight: 600; text-decoration: none;
            font-size: 0.8rem; padding: 6px 16px; border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(6px); transition: 0.3s;
        }
        .tag:hover { background: var(--primary); border-color: var(--primary); }

        /* 2. PROFIL GEOGRAFIS & VIDEO TUBAN */
        .blue-hero {
            background: linear-gradient(135deg, #00224f 0%, #004b99 100%);
            padding: 80px 5%; color: white; display: grid; grid-template-columns: 1.15fr 1fr;
            gap: 40px; align-items: center;
        }
        .badge-pill {
            display: inline-flex; align-items: center; gap: 6px; background: rgba(255, 255, 255, 0.15);
            color: #7dd3fc; padding: 6px 16px; border-radius: 20px; font-size: 0.8rem; font-weight: 700; margin-bottom: 16px;
        }
        .blue-hero h2 { font-size: 2.5rem; line-height: 1.2; font-weight: 800; margin-bottom: 18px; }
        .blue-hero h2 span { color: #38bdf8; }
        .blue-hero p { font-size: 0.95rem; color: #e0f2fe; line-height: 1.65; margin-bottom: 24px; }

        .btn-group { display: flex; gap: 14px; }
        .btn-white {
            background: #0ea5e9; color: white; text-decoration: none; padding: 11px 22px;
            border-radius: 8px; font-weight: 700; font-size: 0.85rem; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s;
        }
        .btn-white:hover { background: #0284c7; }
        .btn-outline {
            background: transparent; color: white; border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 11px 22px; border-radius: 8px; font-weight: 600; font-size: 0.85rem; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-outline:hover { background: rgba(255, 255, 255, 0.1); }

        /* 3. RUANG PELAYANAN UNGGULAN */
        .section-padding { padding: 80px 5%; text-align: center; }
        .section-label {
            color: var(--primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.5px; margin-bottom: 10px;
        }
        .section-title { font-size: 2rem; font-weight: 800; margin-bottom: 12px; color: var(--text-dark); }
        .section-subtitle { font-size: 0.95rem; color: var(--text-gray); max-width: 650px; margin: 0 auto 50px auto; }
        
        .cards-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; text-align: left;
        }
        .feature-card {
            background: #ffffff; padding: 30px 24px; border-radius: 12px; border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); transition: 0.2s; display: flex; flex-direction: column; justify-content: space-between;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.08); }
        .icon-box {
            width: 48px; height: 48px; border-radius: 10px; background: #e0f2fe; color: var(--primary);
            display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 20px;
        }
        .feature-card h4 { font-size: 1.05rem; font-weight: 700; margin-bottom: 10px; }
        .feature-card p { font-size: 0.85rem; color: var(--text-gray); line-height: 1.5; margin-bottom: 20px; }
        .feature-card a { color: var(--primary); font-size: 0.85rem; font-weight: 700; text-decoration: none; }
        .feature-card a:hover { text-decoration: underline; }

        /* 4. STRIP STATISTIK HITAM DI BAWAH LAYANAN */
        .stats-strip {
            background: #060a14; padding: 40px 5%; display: grid; grid-template-columns: repeat(4, 1fr);
            text-align: center; color: white; border-top: 1px solid rgba(255, 255, 255, 0.08);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .stat-item { text-decoration: none; color: inherit; display: block; transition: 0.2s; }
        .stat-item:hover { transform: translateY(-3px); }
        .stat-item h3 { font-size: 2.8rem; font-weight: 800; color: var(--primary-light); }
        .stat-item p { font-size: 0.88rem; color: #94a3b8; margin-top: 6px; font-weight: 600; }

        /* 5. ALUR PANDUAN PELAYANAN */
        .alur-layanan-section { background: #f8fafc; padding: 75px 5%; text-align: center; }
        .alur-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-top: 40px; text-align: left; }
        .alur-card {
            background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 26px 20px;
            position: relative; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); transition: 0.2s;
        }
        .alur-card:hover { transform: translateY(-4px); border-color: var(--primary); }
        .step-num {
            position: absolute; top: -14px; left: 20px; background: var(--primary); color: white;
            font-size: 0.75rem; font-weight: 800; padding: 4px 12px; border-radius: 20px;
        }
        .alur-card h5 { font-size: 1.05rem; font-weight: 800; margin: 12px 0 8px 0; color: var(--text-dark); }
        .alur-card p { font-size: 0.82rem; color: var(--text-gray); line-height: 1.5; }

        /* 6. BERITA TERKINI MODERN */
        .news-grid-modern {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 36px; text-align: left;
        }
        .news-card-modern {
            background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04); transition: all 0.3s ease;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .news-card-modern:hover {
            transform: translateY(-6px); box-shadow: 0 16px 30px -6px rgba(0, 0, 0, 0.1); border-color: #cbd5e1;
        }
        .news-thumb-wrap { position: relative; height: 200px; overflow: hidden; }
        .news-thumb-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
        .news-card-modern:hover .news-thumb-wrap img { transform: scale(1.06); }
        .news-date-badge {
            position: absolute; bottom: 12px; right: 12px; background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(6px); color: #f8fafc; font-size: 0.72rem; font-weight: 700;
            padding: 4px 10px; border-radius: 20px;
        }
        .news-body-modern { padding: 22px; flex-grow: 1; display: flex; flex-direction: column; }
        .news-tag-badge {
            font-size: 0.72rem; font-weight: 700; padding: 4px 10px; border-radius: 6px;
            display: inline-block; width: fit-content; margin-bottom: 12px;
        }
        .news-card-modern h4 {
            font-size: 1.08rem; font-weight: 800; color: #0f172a; line-height: 1.4; margin-bottom: 10px; transition: color 0.2s;
        }
        .news-card-modern:hover h4 { color: var(--primary); }
        .news-card-modern p {
            font-size: 0.84rem; color: var(--text-gray); line-height: 1.6; margin-bottom: 18px; flex-grow: 1;
        }
        .news-link-btn {
            font-size: 0.84rem; font-weight: 700; color: var(--primary); text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .news-link-btn:hover { text-decoration: underline; }

        /* 7. ASPIRASI MASYARAKAT */
        .testi-grid-modern {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 36px; text-align: left;
        }
        .testi-card-modern {
            background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 28px 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); position: relative; transition: all 0.3s ease;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .testi-card-modern:hover {
            transform: translateY(-4px); box-shadow: 0 14px 25px -4px rgba(0, 0, 0, 0.08); border-color: #38bdf8;
        }
        .quote-icon-bg {
            position: absolute; top: 20px; right: 20px; font-size: 2.2rem; color: #e2e8f0; opacity: 0.5;
        }
        .stars-row { color: #f59e0b; font-size: 0.8rem; margin-bottom: 14px; display: flex; gap: 3px; }
        .testi-card-modern p {
            font-size: 0.88rem; color: #334155; line-height: 1.6; font-style: italic; position: relative; z-index: 1; margin-bottom: 22px;
        }
        .user-meta-modern {
            display: flex; align-items: center; gap: 14px; border-top: 1px solid #f1f5f9; padding-top: 16px;
        }
        .user-meta-modern img {
            width: 44px; height: 44px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary-light);
        }
        .user-meta-modern h5 { font-size: 0.9rem; font-weight: 800; color: #0f172a; line-height: 1.2; }
        .user-meta-modern span { font-size: 0.74rem; color: var(--text-gray); margin-top: 2px; display: block; }

        /* CTA & FOOTER */
        .cta-banner {
            background: linear-gradient(135deg, #0284c7 0%, #0f766e 100%);
            padding: 60px 20px; text-align: center; color: white;
        }
        .cta-banner h2 { font-size: 2.2rem; font-weight: 800; margin-bottom: 12px; }
        .cta-banner p { font-size: 0.95rem; margin-bottom: 25px; opacity: 0.9; }

        footer { background: #0b1325; color: #94a3b8; padding: 60px 5% 30px 5%; font-size: 0.85rem; }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 40px; margin-bottom: 40px; }
        .footer-col h5 { color: white; font-size: 0.95rem; margin-bottom: 16px; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 10px; }
        .footer-col ul li a { color: #94a3b8; text-decoration: none; }
        .footer-col ul li a:hover { color: #ffffff; }

        @media (max-width: 992px) {
            .blue-hero { grid-template-columns: 1fr; }
            .cards-grid, .alur-grid, .testi-grid-modern, .news-grid-modern { grid-template-columns: repeat(2, 1fr); }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 640px) {
            .navbar { display: none; }
            .hero-title { font-size: 2rem; }
            .cards-grid, .alur-grid, .stats-strip, .testi-grid-modern, .news-grid-modern, .footer-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- TOP HEADER -->
    <header class="top-header">
        <div class="logo-area">
            <div class="logo-icon"><i class="fa-solid fa-globe"></i></div>
            <div class="logo-text">
                <h2>Desa Digital</h2>
                <p>KABUPATEN TUBAN - JAWA TIMUR</p>
            </div>
        </div>
        <div class="auth-buttons">
            <a href="{{ url('/login') }}" class="btn-login">Login</a>
            <a href="{{ url('/register') }}" class="btn-daftar">Daftar</a>
        </div>
    </header>

    <!-- NAVBAR DENGAN TAUTAN PRESISI -->
    <nav class="navbar">
        <ul class="nav-links">
            <li>
                <a href="#hero-tuban" class="active">
                    <i class="fa-solid fa-house" style="font-size: 0.8rem; margin-right: 4px;"></i> Home
                </a>
            </li>
            <li><a href="#profil-wilayah">Profil Tuban</a></li>
            <li><a href="#layanan-unggulan">Layanan</a></li>
            <li><a href="#alur-layanan">Alur Warga</a></li>
            <li><a href="#tentang-kami">Tentang Kami</a></li>
            <li><a href="#berita-acara">Berita Terkini</a></li>
            <li><a href="#aspirasi-warga">Aspirasi</a></li>
            <li>
                <a href="{{ url('/webgis') }}" style="color: #38bdf8; font-weight: 700;">
                    <i class="fa-solid fa-map-location-dot"></i> Peta Spasial (GIS)
                </a>
            </li>
            <li>
                <a href="{{ url('/desa') }}">
                    <i class="fa-solid fa-table-list" style="font-size: 0.8rem; margin-right: 4px;"></i> Katalog Desa
                </a>
            </li>
        </ul>
        <div class="status-badge">
            <span class="status-dot"></span> SISTEM INFORMASI DESA AKTIF
        </div>
    </nav>

    <!-- 1. HERO UTAMA -->
    <section id="hero-tuban" class="hero-tuban">
        <p class="hero-subtitle">SELAMAT DATANG DI</p>
        <h1 class="hero-title">Desa Digital Kabupaten Tuban</h1>
        <p class="hero-desc">Digitalisasi Pemerintahan Desa di Kabupaten Tuban untuk pelayanan publik yang cepat, transparan, dan mandiri hingga ke tingkat dusun</p>

        <form class="search-box" action="{{ url('/desa') }}" method="GET">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Cari layanan, informasi dusun, regulasi desa...">
            <button type="submit">Cari</button>
        </form>

        <div class="popular-tags">
            <span>Layanan Terpopuler:</span>
            <a href="javascript:void(0)" onclick="openLayananModal()" class="tag">Surat Keterangan</a>
            <a href="{{ url('/webgis') }}" class="tag">Peta Dusun</a>
            <a href="#layanan-unggulan" class="tag">Portal UMKM</a>
            <a href="#hubungi-kami" class="tag">Pengaduan Warga</a>
            <a href="#layanan-unggulan" class="tag">Bantuan Sosial</a>
        </div>
    </section>

    <!-- 2. PROFIL GEOGRAFIS & VIDEO PROFIL TUBAN -->
    <section id="profil-wilayah" class="blue-hero">
        <div>
            <span class="badge-pill">
                <i class="fa-solid fa-map-location-dot"></i> PROFIL GEOGRAFIS DAERAH
            </span>
            <h2>
                Mengenal Kabupaten Tuban: <span>Bumi Ronggolawe</span> di Gerbang Pesisir Jawa Timur
            </h2>
            <p>
                Secara geografis, Kabupaten Tuban terletak di pantai utara Jawa Timur pada koordinat 6°40′ - 7°18′ LS dan 111°30′ - 112°00′ BT dengan bentang garis pantai sepanjang 65 km. Wilayah ini menghubungkan sentra ekonomi pesisir pantura, perbukitan kapur karst, hingga kawasan agraris subur di lembah Bengawan Solo yang menaungi 20 kecamatan dan 328 desa/kelurahan.
            </p>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 28px;">
                <div style="background: rgba(255, 255, 255, 0.08); padding: 12px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.12);">
                    <small style="color: #7dd3fc; font-weight: 700; font-size: 0.7rem; text-transform: uppercase;">Luas Daratan</small>
                    <h5 style="font-size: 1.05rem; font-weight: 800; margin-top: 2px;">1.839,94 km²</h5>
                </div>
                <div style="background: rgba(255, 255, 255, 0.08); padding: 12px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.12);">
                    <small style="color: #7dd3fc; font-weight: 700; font-size: 0.7rem; text-transform: uppercase;">Panjang Pantai</small>
                    <h5 style="font-size: 1.05rem; font-weight: 800; margin-top: 2px;">65 Km Laut</h5>
                </div>
                <div style="background: rgba(255, 255, 255, 0.08); padding: 12px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.12);">
                    <small style="color: #7dd3fc; font-weight: 700; font-size: 0.7rem; text-transform: uppercase;">Batas Wilayah</small>
                    <h5 style="font-size: 0.95rem; font-weight: 800; margin-top: 2px;">Laut Jawa & Jateng</h5>
                </div>
            </div>

            <div class="btn-group">
                <a href="{{ url('/webgis') }}" class="btn-white">
                    <i class="fa-solid fa-map"></i> Buka Peta Spasial Tuban
                </a>
                <a href="https://tubankab.go.id" target="_blank" class="btn-outline">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> Portal Pemkab Tuban
                </a>
            </div>
        </div>

        <!-- VIDEO EMBED RESMI KABUPATEN TUBAN -->
        <div style="position: relative; width: 100%;">
            <div style="background: rgba(255, 255, 255, 0.08); padding: 12px; border-radius: 18px; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; padding: 0 4px;">
                    <span style="font-size: 0.75rem; color: #7dd3fc; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                        <i class="fa-brands fa-youtube" style="color: #ef4444; font-size: 0.95rem;"></i> Diskominfo-SP Tuban Official
                    </span>
                    <span style="font-size: 0.7rem; color: rgba(255,255,255,0.8); background: rgba(0,0,0,0.3); padding: 2px 8px; border-radius: 6px;">
                        Video Profil Daerah
                    </span>
                </div>

                <div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000;">
                    <iframe 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                        src="https://www.youtube.com/embed/gPCZo6dKDWM?rel=0" 
                        title="Video Profil Resmi Kabupaten Tuban - Diskominfo SP Tuban" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>

                <div style="margin-top: 10px; display: flex; justify-content: space-between; align-items: center; font-size: 0.75rem; color: rgba(255,255,255,0.85); padding: 0 4px;">
                    <span><i class="fa-solid fa-play-circle" style="color: #38bdf8;"></i> Putar langsung profil Bumi Ronggolawe</span>
                    <a href="https://www.youtube.com/@diskominfotuban865" target="_blank" style="color: #7dd3fc; text-decoration: none; font-weight: 700;">
                        Kanal Diskominfo &rarr;
                    </a>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. RUANG PELAYANAN UNGGULAN -->
    <section id="layanan-unggulan" class="section-padding">
        <p class="section-label">LAYANAN UNGGULAN</p>
        <h3 class="section-title">Solusi Terintegrasi – Untuk Kemajuan Ekosistem Desa</h3>
        <p class="section-subtitle">Portal terlengkap dalam melayani kebutuhan administrasi warga dan memajukan potensi desa sampai tingkat dusun secara terpadu.</p>

        <div class="cards-grid">
            <div class="feature-card">
                <div>
                    <div class="icon-box"><i class="fa-solid fa-network-wired"></i></div>
                    <h4>Website Desa & Dusun</h4>
                    <p>Kanal informasi resmi profil kelurahan, data rukun tetangga/dusun, transparansi anggaran, serta potensi lokal warga.</p>
                </div>
                <a href="{{ url('/desa') }}">Buka Katalog Desa &rarr;</a>
            </div>

            <div class="feature-card">
                <div>
                    <div class="icon-box"><i class="fa-solid fa-mobile-screen-button"></i></div>
                    <h4>Layanan Digital Warga</h4>
                    <p>Permohonan surat domisili, SKU, dan pengantar nikah langsung dari rumah warga tingkat RT/RW tanpa perlu antre lama.</p>
                </div>
                <a href="javascript:void(0)" onclick="openLayananModal()">Pilih Layanan &rarr;</a>
            </div>

            <div class="feature-card">
                <div>
                    <div class="icon-box"><i class="fa-solid fa-wifi"></i></div>
                    <h4>Akses Internet Balai Dusun</h4>
                    <p>Penyediaan jaringan internet gratis di balai warga dan pos dusun untuk menunjang sarana belajar serta UMKM pedesaan.</p>
                </div>
                <a href="{{ url('/webgis') }}">Cek Sebaran Hotspot &rarr;</a>
            </div>

            <div class="feature-card">
                <div>
                    <div class="icon-box"><i class="fa-solid fa-desktop"></i></div>
                    <h4>Anjungan Mandiri (Kiosk)</h4>
                    <p>Mesin pencetak surat pintar di balai desa berbasis NIK untuk kemudahan warga yang belum memiliki ponsel cerdas.</p>
                </div>
                <a href="#tentang-kami">Informasi Fasilitas &rarr;</a>
            </div>
        </div>
    </section>

    <!-- 4. STRIP STATISTIK HITAM DI BAWAH LAYANAN -->
    <section class="stats-strip">
        <div class="stat-item">
            <h3>{{ $totalWifi ?? 448 }}</h3>
            <p>WiFi Desa & Dusun</p>
        </div>
        <a href="{{ url('/desa') }}" class="stat-item">
            <h3>{{ $totalWebDesa ?? 328 }}</h3>
            <p>Website Desa</p>
        </a>
        <div class="stat-item">
            <h3>{{ $totalWisata ?? 35 }}</h3>
            <p>Wisata Desa</p>
        </div>
        <div class="stat-item">
            <h3>{{ $totalDesaTerdaftar ?? 328 }}</h3>
            <p>Kantor Desa Terhubung</p>
        </div>
    </section>

    <!-- 5. ALUR PANDUAN PELAYANAN DESA & DUSUN -->
    <section id="alur-layanan" class="alur-layanan-section">
        <p class="section-label">PANDUAN PRAKTIS WARGA</p>
        <h3 class="section-title">Alur Pengurusan Dokumen Cepat Dari Rumah</h3>
        <p class="section-subtitle">Empat tahapan mudah mengurus administrasi kependudukan tanpa harus berulang kali datang ke balai desa.</p>

        <div class="alur-grid">
            <div class="alur-card">
                <span class="step-num">Langkah 1</span>
                <i class="fa-solid fa-fingerprint" style="font-size: 1.8rem; color: #0284c7;"></i>
                <h5>Pilih Format Dokumen</h5>
                <p>Buka portal Desa Digital dan pilih jenis permohonan surat (SKU, Domisili, SKCK, atau SKTM).</p>
            </div>
            <div class="alur-card">
                <span class="step-num">Langkah 2</span>
                <i class="fa-solid fa-file-circle-check" style="font-size: 1.8rem; color: #0d9488;"></i>
                <h5>Lengkapi Persyaratan</h5>
                <p>Siapkan berkas fotokopi KTP, KK, dan pengantar RT/RW setempat sesuai instruksi panduan.</p>
            </div>
            <div class="alur-card">
                <span class="step-num">Langkah 3</span>
                <i class="fa-solid fa-user-check" style="font-size: 1.8rem; color: #f59e0b;"></i>
                <h5>Validasi Operator</h5>
                <p>Petugas balai desa memeriksa kelengkapan data secara terpadu melalui sistem satu pintu.</p>
            </div>
            <div class="alur-card">
                <span class="step-num">Langkah 4</span>
                <i class="fa-solid fa-print" style="font-size: 1.8rem; color: #10b981;"></i>
                <h5>Ambil / Cetak Mandiri</h5>
                <p>Dokumen bertanda barcode resmi siap diambil di balai desa atau dicetak langsung lewat Kiosk mesin pintar.</p>
            </div>
        </div>
    </section>

    <!-- 6. SECTION TENTANG KAMI -->
    <section id="tentang-kami" class="about-section-wrap" style="padding: 85px 5%; background: #ffffff;">
        <div style="text-align: center; max-width: 750px; margin: 0 auto 50px auto;">
            <p class="section-label">PROFIL & TATA KELOLA WILAYAH</p>
            <h3 class="section-title">Pemerataan Digital Bumi Ronggolawe</h3>
            <p style="font-size: 0.95rem; color: #64748b; line-height: 1.6;">
                Inisiatif terpadu Pemerintah Kabupaten Tuban dalam menyatukan sebaran geografis pesisir utara, perbukitan kapur, hingga bantaran Bengawan Solo dalam satu integrasi data kependudukan dan pelayanan publik.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: 1.1fr 1fr 1fr; gap: 24px; text-align: left; align-items: stretch;">
            
            <!-- KARTU 1: FUNGSI DISKOMINFO SP KABUPATEN TUBAN -->
            <div style="background: #0f172a; color: white; border-radius: 16px; padding: 32px 26px; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);">
                <div>
                    <div style="width: 48px; height: 48px; background: rgba(2, 132, 199, 0.2); border: 1px solid rgba(56, 189, 248, 0.4); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: #38bdf8; margin-bottom: 20px;">
                        <i class="fa-solid fa-server"></i>
                    </div>
                    <span style="font-size: 0.72rem; color: #38bdf8; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Peran & Otoritas</span>
                    <h4 style="font-size: 1.25rem; font-weight: 800; margin: 6px 0 14px 0; line-height: 1.3;">Diskominfo SP Kabupaten Tuban</h4>
                    <p style="font-size: 0.84rem; color: #94a3b8; line-height: 1.6; margin-bottom: 18px;">
                        Dinas Komunikasi dan Informatika, Statistik dan Persandian berperan sebagai tulang punggung arsitektur SPBE, pengelola integrasi satu data daerah, keamanan siber persandian, serta penyedia infrastruktur jaringan fiber optic dan WiFi gratis hingga balai warga.
                    </p>
                    <ul style="list-style: none; padding: 0; font-size: 0.8rem; color: #cbd5e1; display: flex; flex-direction: column; gap: 8px;">
                        <li><i class="fa-solid fa-circle-check" style="color: #22c55e; margin-right: 8px;"></i> Tata Kelola Satu Data Tuban Terpadu</li>
                        <li><i class="fa-solid fa-circle-check" style="color: #22c55e; margin-right: 8px;"></i> Jaringan Internet & WiFi Publik Pelosok</li>
                        <li><i class="fa-solid fa-circle-check" style="color: #22c55e; margin-right: 8px;"></i> Keamanan Data Kependudukan & Siber</li>
                    </ul>
                </div>

                <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 18px; margin-top: 24px; font-size: 0.78rem; color: #94a3b8;">
                    <i class="fa-solid fa-location-dot" style="color: #38bdf8; margin-right: 6px;"></i> Kantor: Jl. Kartini No. 2, Kabupaten Tuban
                </div>
            </div>

            <!-- KARTU 2: GEOGRAFIS & CAKUPAN LOKASI -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 30px 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 20px;">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <span style="font-size: 0.72rem; color: #0284c7; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Geospasial Wilayah</span>
                    <h4 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 6px 0 12px 0;">Cakupan Administrasi</h4>
                    <p style="font-size: 0.84rem; color: #64748b; line-height: 1.6; margin-bottom: 18px;">
                        Kabupaten Tuban memiliki bentang geografis pesisir sepanjang 65 km di utara Jawa serta kawasan agraris subur, menaungi ratusan titik pemerintahan lokal.
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div style="background: #f8fafc; padding: 10px 14px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.8rem; color: #475569; font-weight: 600;">Luas Wilayah Daratan</span>
                            <strong style="font-size: 0.88rem; color: #0f172a;">1.839,94 km²</strong>
                        </div>
                        <div style="background: #f8fafc; padding: 10px 14px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.8rem; color: #475569; font-weight: 600;">Jumlah Kecamatan</span>
                            <strong style="font-size: 0.88rem; color: #0f172a;">20 Kecamatan</strong>
                        </div>
                        <div style="background: #f8fafc; padding: 10px 14px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.8rem; color: #475569; font-weight: 600;">Desa & Kelurahan</span>
                            <strong style="font-size: 0.88rem; color: #0f172a;">311 Desa / 17 Kelurahan</strong>
                        </div>
                        <div style="background: #f8fafc; padding: 10px 14px; border-radius: 10px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.8rem; color: #475569; font-weight: 600;">Sebaran Wilayah Dusun</span>
                            <strong style="font-size: 0.88rem; color: #0284c7;">1.142 Dusun</strong>
                        </div>
                    </div>
                </div>

                <a href="{{ url('/webgis') }}" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.84rem; font-weight: 700; color: #0284c7; text-decoration: none; margin-top: 20px;">
                    Jelajahi Peta Spasial Tuban &rarr;
                </a>
            </div>

            <!-- KARTU 3: STATISTIK POPULASI & STATUS DOMISILI WARGA -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 30px 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04); display: flex; flex-direction: column; justify-content: space-between;">
                <div>
                    <div style="width: 48px; height: 48px; background: #ccfbf1; color: #0d9488; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; margin-bottom: 20px;">
                        <i class="fa-solid fa-users-rectangle"></i>
                    </div>
                    <span style="font-size: 0.72rem; color: #0d9488; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Demografi Penduduk</span>
                    <h4 style="font-size: 1.2rem; font-weight: 800; color: #0f172a; margin: 6px 0 12px 0;">Populasi & Domisili</h4>
                    <p style="font-size: 0.84rem; color: #64748b; line-height: 1.6; margin-bottom: 18px;">
                        Monitoring kepadatan penduduk dan kepemilikan dokumen administrasi kependudukan (KTP-el/KK) warga Kabupaten Tuban.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; text-align: center;">
                            <span style="font-size: 0.7rem; color: #64748b; font-weight: 700;">Total Populasi</span>
                            <h5 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-top: 4px;">1,25 Juta</h5>
                            <span style="font-size: 0.65rem; color: #0d9488;">Jiwa Penduduk</span>
                        </div>
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 12px; text-align: center;">
                            <span style="font-size: 0.7rem; color: #64748b; font-weight: 700;">Kepala Keluarga</span>
                            <h5 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-top: 4px;">412.000+</h5>
                            <span style="font-size: 0.65rem; color: #0d9488;">Kartu Keluarga (KK)</span>
                        </div>
                    </div>

                    <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px; padding: 12px 14px; font-size: 0.78rem; color: #065f46; line-height: 1.5;">
                        <i class="fa-solid fa-id-card" style="margin-right: 6px;"></i>
                        <strong>Layanan Domisili Cepat:</strong> Pengurusan surat pindah domisili, permohonan akta, dan keterangan kependudukan terhubung dengan Disdukcapil Tuban secara daring.
                    </div>
                </div>

                <a href="javascript:void(0)" onclick="openLayananModal()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.84rem; font-weight: 700; color: #0d9488; text-decoration: none; margin-top: 20px;">
                    Cek Persyaratan Surat Domisili &rarr;
                </a>
            </div>

        </div>
    </section>

    <!-- 7. SECTION BERITA TERKINI MODERN -->
    <section id="berita-acara" class="section-padding" style="background: #f8fafc;">
        <p class="section-label">KABAR TERKINI</p>
        <h3 class="section-title">Berita & Informasi Seputar Desa Digital</h3>
        <p class="section-subtitle">Kilas perkembangan transformasi pelayanan digital, penguatan jaringan, serta potensi komoditas wilayah Kabupaten Tuban.</p>

        <div class="news-grid-modern">
            <div class="news-card-modern">
                <div class="news-thumb-wrap">
                    <img src="https://images.unsplash.com/photo-1518457607834-6e8d80c183c5?q=80&w=600&auto=format&fit=crop" alt="Perluasan Fiber Optik">
                    <span class="news-date-badge"><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 07 Sep 2026</span>
                </div>
                <div class="news-body-modern">
                    <span class="news-tag-badge" style="background: #e0f2fe; color: #0284c7;">
                        <i class="fa-solid fa-tower-broadcast"></i> Infrastruktur
                    </span>
                    <h4>Perluasan Jaringan Fiber Optik ke Wilayah Pesisir Pantura</h4>
                    <p>Pemerintah daerah mempercepat integrasi koneksi pita lebar untuk mendukung digitalisasi transaksi nelayan dan kantor pelayanan desa pesisir.</p>
                    <a href="{{ url('/desa') }}" class="news-link-btn">Baca Selengkapnya &rarr;</a>
                </div>
            </div>

            <div class="news-card-modern">
                <div class="news-thumb-wrap">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=600&auto=format&fit=crop" alt="Bimtek Literasi Digital">
                    <span class="news-date-badge"><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 04 Sep 2026</span>
                </div>
                <div class="news-body-modern">
                    <span class="news-tag-badge" style="background: #ccfbf1; color: #0d9488;">
                        <i class="fa-solid fa-chalkboard-user"></i> Pelatihan SDM
                    </span>
                    <h4>Bimtek Literasi Digital untuk Seluruh Operator Balai Desa</h4>
                    <p>Peningkatan kecakapan operasional sistem administrasi persuratan mandiri guna memastikan efisiensi pelayanan tanpa hambatan teknis.</p>
                    <a href="{{ url('/desa') }}" class="news-link-btn">Baca Selengkapnya &rarr;</a>
                </div>
            </div>

            <div class="news-card-modern">
                <div class="news-thumb-wrap">
                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=600&auto=format&fit=crop" alt="Wisata dan QRIS">
                    <span class="news-date-badge"><i class="fa-regular fa-clock" style="margin-right: 4px;"></i> 01 Sep 2026</span>
                </div>
                <div class="news-body-modern">
                    <span class="news-tag-badge" style="background: #fef3c7; color: #d97706;">
                        <i class="fa-solid fa-qrcode"></i> Perekonomian
                    </span>
                    <h4>Wisata Alam Terpadu Manfaatkan Tiket Masuk Berbasis QRIS</h4>
                    <p>Penerapan pembayaran nontunai sukses meningkatkan transparansi pendapatan asli desa dari destinasi wisata unggulan masyarakat.</p>
                    <a href="{{ url('/desa') }}" class="news-link-btn">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. SECTION ASPIRASI MASYARAKAT MODERN -->
    <section id="aspirasi-warga" class="section-padding" style="background: #ffffff;">
        <p class="section-label">ASPIRASI MASYARAKAT</p>
        <h3 class="section-title">Apa Kata Mereka Tentang Desa Digital?</h3>
        <p class="section-subtitle">Kepuasan masyarakat desa atas keterbukaan informasi dan kecepatan pengurusan dokumen mandiri.</p>

        <div class="testi-grid-modern">
            <div class="testi-card-modern">
                <i class="fa-solid fa-quote-right quote-icon-bg"></i>
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>"Pengurusan surat keterangan domisili usaha UMKM saya selesai dalam hitungan menit tanpa perlu izin meninggalkan pekerjaan seharian ke balai desa."</p>
                <div class="user-meta-modern">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=120&auto=format&fit=crop" alt="H. Dwi Santoso">
                    <div>
                        <h5>H. Dwi Santoso</h5>
                        <span>Pelaku UMKM Kerajinan Pesisir</span>
                    </div>
                </div>
            </div>

            <div class="testi-card-modern">
                <i class="fa-solid fa-quote-right quote-icon-bg"></i>
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>"Portal website ini sangat transparan dalam menampilkan rincian realisasi dana desa dan progres pengerjaan jalan paving antar dusun secara gamblang."</p>
                <div class="user-meta-modern">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?q=80&w=120&auto=format&fit=crop" alt="Eko Susanto">
                    <div>
                        <h5>Eko Susanto</h5>
                        <span>Tokoh Warga Dusun Krajan</span>
                    </div>
                </div>
            </div>

            <div class="testi-card-modern">
                <i class="fa-solid fa-quote-right quote-icon-bg"></i>
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
                <p>"Anak-anak sekolah di pelosok dusun kini dapat menikmati akses WiFi gratis di balai warga untuk mengerjakan tugas dan belajar pelajaran daring."</p>
                <div class="user-meta-modern">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=120&auto=format&fit=crop" alt="Siti Rahmawati">
                    <div>
                        <h5>Siti Rahmawati</h5>
                        <span>Tenaga Pendidik Pedesaan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. BANNER CTA -->
    <section class="cta-banner">
        <h2>Siap Membawa Desa Anda Menuju Era Digital Cerdas?</h2>
        <p>Gabungkan layanan administrasi kependudukan dan transparansi publik dalam satu genggaman tangan.</p>
        <div class="btn-group" style="justify-content: center;">
            <a href="{{ url('/desa') }}" class="btn-white" style="background: white; color: var(--primary); font-weight: 700;">Lihat Katalog Desa</a>
            <a href="#tentang-kami" class="btn-outline">Panduan Layanan</a>
        </div>
    </section>

    <!-- 10. FOOTER -->
    <footer id="hubungi-kami">
        <div class="footer-grid">
            <div>
                <h5 style="font-size: 1.2rem; margin-bottom: 12px; color: white;">Desa Digital Kabupaten Tuban</h5>
                <p>Inisiatif terpadu menuju tata kelola pemerintahan desa yang akuntabel, efisien, dan melayani masyarakat seutuhnya.</p>
            </div>
            <div class="footer-col">
                <h5>Menu Pintas</h5>
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/desa') }}">Data Desa</a></li>
                    <li><a href="{{ url('/webgis') }}">Peta WebGIS</a></li>
                    <li><a href="#layanan-unggulan">Layanan Administrasi</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Informasi Publik</h5>
                <ul>
                    <li><a href="#">Regulasi & Perdes</a></li>
                    <li><a href="#">Maklumat Pelayanan</a></li>
                    <li><a href="#hubungi-kami">Pengaduan Online</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Kontak Resmi</h5>
                <p><i class="fa-solid fa-phone" style="margin-right: 8px;"></i> (0356) 123456</p>
                <p style="margin-top: 8px;"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> halo@tubankab.go.id</p>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 20px; text-align: center;">
            <p>&copy; 2026 Pemerintah Desa Digital Kabupaten Tuban. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- MODAL LAYANAN PERSURATAN RAMAH WARGA (BEBAS LOGIN) -->
    <div id="layananModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(6px); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: white; border-radius: 20px; max-width: 600px; width: 100%; padding: 26px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35); position: relative; max-height: 90vh; overflow-y: auto;">
            <button onclick="closeLayananModal()" style="position: absolute; top: 18px; right: 18px; background: #f1f5f9; border: none; width: 34px; height: 34px; border-radius: 50%; cursor: pointer; color: #64748b; font-size: 1.1rem;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div style="text-align: center; margin-bottom: 20px;">
                <div style="width: 52px; height: 52px; background: #e0f2fe; color: var(--primary); border-radius: 14px; display: inline-flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-bottom: 10px;">
                    <i class="fa-solid fa-file-pen"></i>
                </div>
                <h3 style="font-size: 1.3rem; font-weight: 800; color: #0f172a;">Layanan Surat Desa Mandiri</h3>
                <p style="font-size: 0.85rem; color: #64748b;">Pilih jenis surat di bawah untuk menyiapkan persyaratan:</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                <!-- SKU -->
                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Surat Keterangan Usaha (SKU)</h4>
                        <p style="font-size: 0.78rem; color: #64748b;">Syarat: KTP, KK, & Bukti Usaha UMKM</p>
                    </div>
                    <button onclick="pilihSurat('Surat Keterangan Usaha (SKU)')" style="background: #0284c7; color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 0.8rem; cursor: pointer;">Pilih Layanan</button>
                </div>

                <!-- Domisili -->
                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Surat Keterangan Domisili</h4>
                        <p style="font-size: 0.78rem; color: #64748b;">Syarat: Pengantar RT/RW Dusun & Fotokopi KTP</p>
                    </div>
                    <button onclick="pilihSurat('Surat Keterangan Domisili')" style="background: #0d9488; color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 0.8rem; cursor: pointer;">Pilih Layanan</button>
                </div>

                <!-- SKCK -->
                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">Pengantar SKCK Desa</h4>
                        <p style="font-size: 0.78rem; color: #64748b;">Syarat: Fotokopi KK, KTP, & Pas Foto 4x6</p>
                    </div>
                    <button onclick="pilihSurat('Pengantar SKCK Desa')" style="background: #d97706; color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 0.8rem; cursor: pointer;">Pilih Layanan</button>
                </div>
            </div>

            <!-- Bantuan WA Petugas Desa -->
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h5 style="font-size: 0.88rem; font-weight: 700; color: #065f46;">Butuh Bantuan Operator Balai Desa?</h5>
                    <p style="font-size: 0.75rem; color: #047857;">Tanyakan syarat surat langsung ke petugas pelayanan via WhatsApp.</p>
                </div>
                <a href="https://wa.me/6281234567890?text=Halo%20Petugas%20Desa,%20saya%20warga%20ingin%20menanyakan%20pengurusan%20surat..." target="_blank" style="background: #10b981; color: white; text-decoration: none; padding: 8px 14px; border-radius: 8px; font-size: 0.8rem; font-weight: 700; white-space: nowrap;">Tanya Petugas</a>
            </div>

            <div id="feedbackPilih" style="display: none; margin-top: 14px; padding: 10px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; font-size: 0.8rem; color: #1e40af; text-align: center;">
                <span id="txtFeedback"></span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT MODAL -->
    <script>
        function openLayananModal() {
            document.getElementById('layananModal').style.display = 'flex';
            document.getElementById('feedbackPilih').style.display = 'none';
        }
        function closeLayananModal() {
            document.getElementById('layananModal').style.display = 'none';
        }
        function pilihSurat(nama) {
            const fb = document.getElementById('feedbackPilih');
            document.getElementById('txtFeedback').innerHTML = `Format <strong>${nama}</strong> siap diurus. Silakan bawa berkas persyaratan ke Balai Desa Anda.`;
            fb.style.display = 'block';
        }
    </script>
</body>
</html>