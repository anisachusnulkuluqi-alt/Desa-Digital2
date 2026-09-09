<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Digital - Kabupaten Tuban</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #38bdf8;
            --dark-navy: #0b1325;
            --dark-card: #0f172a;
            --light-bg: #f8fafc;
            --text-dark: #0f172a;
            --text-gray: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #ffffff;
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* --- SECTION 1: HEADER & HERO TUBAN --- */
        .top-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 5%;
            background: #080d1a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 38px;
            height: 38px;
            background: var(--primary);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
        }

        .logo-text h2 {
            font-size: 1.15rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.1;
        }

        .logo-text p {
            font-size: 0.65rem;
            color: var(--primary-light);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-login {
            background: #334155;
            color: #ffffff;
            text-decoration: none;
            padding: 7px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 6px;
            transition: 0.3s;
        }

        .btn-daftar {
            background: var(--primary);
            color: white;
            text-decoration: none;
            padding: 7px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 6px;
            transition: 0.3s;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 5%;
            background: #0f172a;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 24px;
        }

        .nav-links a {
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .nav-links a.active, .nav-links a:hover {
            color: #ffffff;
        }

        .status-badge {
            font-size: 0.75rem;
            color: var(--primary-light);
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            background: #22c55e;
            border-radius: 50%;
        }

        .hero-tuban {
            position: relative;
            min-height: 520px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 60px 20px;
            background: linear-gradient(rgba(15, 23, 42, 0.45), rgba(2, 132, 199, 0.25)),
                        url('{{ asset("images/alun-alun-tuban.jpg") }}') center/cover no-repeat;
            background-attachment: fixed;
            color: #ffffff;
        }

        .hero-subtitle {
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
            margin-bottom: 8px;
        }

        .hero-title {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 12px;
            text-shadow: 0 3px 12px rgba(0, 0, 0, 0.9);
        }

        .hero-desc {
            font-size: 1rem;
            color: #f8fafc;
            max-width: 650px;
            line-height: 1.6;
            margin-bottom: 30px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.8);
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 50px;
            padding: 6px 8px 6px 20px;
            width: 100%;
            max-width: 580px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            margin-bottom: 20px;
        }

        .search-box i {
            color: #64748b;
            margin-right: 12px;
        }

        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 0.9rem;
            color: #1e293b;
        }

        .search-box button {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
        }

        .popular-tags {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .popular-tags span {
            font-size: 0.85rem;
            color: #ffffff;
            font-weight: 700;
            text-shadow: 0 2px 6px rgba(0, 0, 0, 0.9);
        }

        .tag {
            background: rgba(15, 23, 42, 0.75);
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.8rem;
            padding: 6px 16px;
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            backdrop-filter: blur(6px);
        }

        .stats-strip {
            background: #060a14;
            padding: 30px 5%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            text-align: center;
            color: white;
        }

        .stat-item h3 {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-item p {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* --- SECTION 2: HERO DIGITAL PELOSOK DESA (BLUE HERO) --- */
        .blue-hero {
            background: linear-gradient(135deg, #002b66 0%, #0056b3 100%);
            padding: 80px 5%;
            color: white;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .badge-pill {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            color: #7dd3fc;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 16px;
        }

        .blue-hero h2 {
            font-size: 2.6rem;
            line-height: 1.2;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .blue-hero h2 span {
            color: #38bdf8;
        }

        .blue-hero p {
            font-size: 1rem;
            color: #e0f2fe;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-group {
            display: flex;
            gap: 15px;
        }

        .btn-white {
            background: #0ea5e9;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.4);
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
        }

        .mockup-img {
            width: 100%;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            border: 4px solid rgba(255, 255, 255, 0.1);
        }

        /* --- SECTION 3: SOLUSI TERINTEGRASI (CARDS) --- */
        .section-padding {
            padding: 80px 5%;
            text-align: center;
        }

        .section-label {
            color: var(--primary);
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .section-subtitle {
            font-size: 0.95rem;
            color: var(--text-gray);
            max-width: 650px;
            margin: 0 auto 50px auto;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            text-align: left;
        }

        .feature-card {
            background: #ffffff;
            padding: 30px 24px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: #e0f2fe;
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .feature-card h4 {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feature-card p {
            font-size: 0.85rem;
            color: var(--text-gray);
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .feature-card a {
            color: var(--primary);
            font-size: 0.85rem;
            font-weight: 700;
            text-decoration: none;
        }

        /* --- SECTION 4: INFRASTRUKTUR & TESTIMONIAL --- */
        .infra-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 40px;
            align-items: center;
            text-align: left;
            background: #f8fafc;
            padding: 80px 5%;
        }

        .stats-badge-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .stat-card-clean {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .stat-card-clean i {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .stat-card-clean h4 {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--primary);
        }

        .stat-card-clean p {
            font-size: 0.75rem;
            color: var(--text-gray);
        }

        .testi-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 40px;
            text-align: left;
        }

        .testi-card {
            border: 1px solid #e2e8f0;
            padding: 24px;
            border-radius: 12px;
            background: white;
        }

        .testi-card p {
            font-size: 0.85rem;
            color: #475569;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .user-meta {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-meta img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-meta h5 {
            font-size: 0.85rem;
            font-weight: 700;
        }

        .user-meta span {
            font-size: 0.75rem;
            color: var(--text-gray);
        }

        /* --- SECTION 5: BERITA & FOOTER --- */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            margin-top: 40px;
            text-align: left;
        }

        .news-card {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            background: white;
        }

        .news-card img {
            width: 100%;
            height: 190px;
            object-fit: cover;
        }

        .news-body {
            padding: 20px;
        }

        .news-tag {
            font-size: 0.7rem;
            background: #e0f2fe;
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 12px;
            font-weight: 700;
        }

        .news-card h4 {
            font-size: 1rem;
            margin: 12px 0 8px 0;
            font-weight: 700;
        }

        .news-card p {
            font-size: 0.8rem;
            color: var(--text-gray);
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .cta-banner {
            background: linear-gradient(135deg, #0284c7 0%, #0f766e 100%);
            padding: 60px 20px;
            text-align: center;
            color: white;
        }

        .cta-banner h2 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .cta-banner p {
            font-size: 0.95rem;
            margin-bottom: 25px;
            opacity: 0.9;
        }

        footer {
            background: #0b1325;
            color: #94a3b8;
            padding: 60px 5% 30px 5%;
            font-size: 0.85rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1.5fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h5 {
            color: white;
            font-size: 0.95rem;
            margin-bottom: 16px;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: #94a3b8;
            text-decoration: none;
        }

        /* ============================================================ */
        /* MEDIA QUERIES (OPTIMASI VERSI ANDROID & LAYAR MOBILE)         */
        /* ============================================================ */
        @media (max-width: 992px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .blue-hero, .infra-grid {
                grid-template-columns: 1fr;
            }
            .testi-grid, .news-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 600px) {
            .top-header, .navbar {
                padding: 12px 16px;
            }
            .navbar {
                display: none; /* Menu navigasi disembunyikan di HP agar ringkas */
            }
            .hero-title {
                font-size: 1.8rem;
            }
            .hero-desc {
                font-size: 0.85rem;
            }
            .search-box {
                flex-direction: column;
                border-radius: 12px;
                padding: 10px;
            }
            .search-box input {
                padding: 8px;
                text-align: center;
            }
            .search-box button {
                width: 100%;
                margin-top: 8px;
            }
            .stats-strip {
                grid-template-columns: repeat(2, 1fr);
                gap: 20px;
            }
            .stat-item h3 {
                font-size: 1.8rem;
            }
            .blue-hero {
                padding: 40px 16px;
            }
            .blue-hero h2 {
                font-size: 1.8rem;
            }
            .btn-group {
                flex-direction: column;
            }
            .cards-grid, .stats-badge-grid, .testi-grid, .news-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- SECTION 1: HEADER & HERO TUBAN -->
    <header class="top-header">
        <div class="logo-area">
            <div class="logo-icon">
                <i class="fa-solid fa-globe"></i>
            </div>
            <div class="logo-text">
                <h2>Desa Digital</h2>
                <p>KABUPATEN TUBAN - JAWA TIMUR</p>
            </div>
        </div>
        <div class="auth-buttons">
            <a href="#" class="btn-login">Login</a>
            <a href="#" class="btn-daftar">Daftar</a>
        </div>
    </header>

    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="#" class="active">Dashboard <i class="fa-solid fa-chevron-down" style="font-size: 10px;"></i></a></li>
            <li><a href="#">Layanan</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Hubungi Kami</a></li>
            <li><a href="#">Berita Acara</a></li>
        </ul>
        <div class="status-badge">
            <span class="status-dot"></span>
            SISTEM INFORMASI DESA AKTIF
        </div>
    </nav>

    <section class="hero-tuban">
        <p class="hero-subtitle">Selamat Datang di</p>
        <h1 class="hero-title">Desa Digital Kabupaten Tuban</h1>
        <p class="hero-desc">Digitalisasi Pemerintahan Desa di Kabupaten Tuban untuk pelayanan publik yang cepat, transparan, dan mandiri</p>

        <form class="search-box" action="#" method="GET">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari layanan, informasi, regulasi desa...">
            <button type="submit">Cari</button>
        </form>

        <div class="popular-tags">
            <span>Layanan Terpopuler:</span>
            <a href="#" class="tag">Surat Keterangan</a>
            <a href="#" class="tag">Portal UMKM</a>
            <a href="#" class="tag">Pengaduan Warga</a>
            <a href="#" class="tag">Bantuan Sosial</a>
        </div>
    </section>

    <section class="stats-strip">
        <div class="stat-item">
            <h3>448</h3>
            <p>WiFi Desa</p>
        </div>
        <div class="stat-item">
            <h3>328</h3>
            <p>Website Desa</p>
        </div>
        <div class="stat-item">
            <h3>35</h3>
            <p>Wisata Desa</p>
        </div>
        <div class="stat-item">
            <h3>328</h3>
            <p>Kantor Desa</p>
        </div>
    </section>

    <!-- SECTION 2: HERO DIGITALISASI PELOSOK DESA -->
    <section class="blue-hero">
        <div>
            <span class="badge-pill"><i class="fa-solid fa-bolt"></i> Akselerasi Desa Menuju Cerdas</span>
            <h2>Mewujudkan Indonesia melalui <span>Pemerataan Digital</span> di Pelosok Desa</h2>
            <p>Desa Digital hadir untuk membangun ekosistem cerdas, mulai dari transparansi administrasi, perluasan akses internet publik, hingga promosi potensi ekonomi mandiri.</p>
            <div class="btn-group">
                <button class="btn-white">Mulai Jelajahi</button>
                <button class="btn-outline">Pelajari Lebih Lanjut</button>
            </div>
        </div>
        <div>
            <img src="https://images.unsplash.com/photo-1577495508048-b635879837f1?q=80&w=800&auto=format&fit=crop" class="mockup-img" alt="Digitalisasi Desa">
        </div>
    </section>

    <!-- SECTION 3: SOLUSI TERINTEGRASI -->
    <section class="section-padding">
        <p class="section-label">Layanan Unggulan</p>
        <h3 class="section-title">Solusi Terintegrasi Untuk Kemajuan Ekosistem Desa</h3>
        <p class="section-subtitle">Portal terlengkap dalam melayani kebutuhan administrasi warga dan memajukan potensi desa secara daring.</p>

        <div class="cards-grid">
            <div class="feature-card">
                <div class="icon-box"><i class="fa-solid fa-globe"></i></div>
                <h4>Website Desa & Media Sosial</h4>
                <p>Publikasi kegiatan, profil kepala desa, transparansi anggaran, serta potensi lokal desa.</p>
                <a href="#">Selengkapnya &rarr;</a>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fa-solid fa-mobile-screen-button"></i></div>
                <h4>Layanan Digital Desa</h4>
                <p>Permohonan surat keterangan domisili, SKCK, dan pengantar nikah langsung via handphone.</p>
                <a href="#">Selengkapnya &rarr;</a>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fa-solid fa-wifi"></i></div>
                <h4>Akses Internet Publik</h4>
                <p>Penyediaan jaringan internet desa gratis untuk sarana edukasi balai desa dan UMKM.</p>
                <a href="#">Selengkapnya &rarr;</a>
            </div>
            <div class="feature-card">
                <div class="icon-box"><i class="fa-solid fa-desktop"></i></div>
                <h4>Anjungan Mandiri</h4>
                <p>Mesin cetak surat pintar di kantor kelurahan tanpa perlu menunggu antrean panjang petugas.</p>
                <a href="#">Selengkapnya &rarr;</a>
            </div>
        </div>
    </section>

    <!-- SECTION 4: INFRASTRUKTUR & TESTIMONIAL -->
    <section class="infra-grid">
        <div>
            <p class="section-label">Pemerataan Fasilitas</p>
            <h3 class="section-title">Infrastruktur Desa Digital di Seluruh Wilayah</h3>
            <p style="color: var(--text-gray); font-size: 0.95rem; line-height: 1.6; margin-top: 15px;">
                Terwujudnya percepatan transformasi digital berkat sinergi pemerintah daerah dengan aparatur desa dalam pemerataan fasilitas teknologi.
            </p>
        </div>
        <div class="stats-badge-grid">
            <div class="stat-card-clean">
                <i class="fa-solid fa-wifi"></i>
                <div>
                    <h4>448</h4>
                    <p>Titik WiFi Aktif</p>
                </div>
            </div>
            <div class="stat-card-clean">
                <i class="fa-solid fa-window-maximize"></i>
                <div>
                    <h4>328</h4>
                    <p>Web Desa Terhubung</p>
                </div>
            </div>
            <div class="stat-card-clean">
                <i class="fa-solid fa-map-location-dot"></i>
                <div>
                    <h4>35</h4>
                    <p>Destinasi Wisata</p>
                </div>
            </div>
            <div class="stat-card-clean">
                <i class="fa-solid fa-building-columns"></i>
                <div>
                    <h4>328</h4>
                    <p>Kantor Desa Online</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding">
        <p class="section-label">Aspirasi Masyarakat</p>
        <h3 class="section-title">Apa Kata Mereka Tentang Desa Digital?</h3>

        <div class="testi-grid">
            <div class="testi-card">
                <p>"Pengurusan surat domisili usaha saya jadi selesai hitungan menit tanpa harus antre berjam-jam di balai desa."</p>
                <div class="user-meta">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=100&auto=format&fit=crop" alt="User">
                    <div>
                        <h5>H. Dwi Santoso</h5>
                        <span>Pelaku UMKM Kerajinan</span>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <p>"Portal web ini sangat transparan dalam menampilkan rincian realisasi dana desa dan progres jalan paving."</p>
                <div class="user-meta">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?q=80&w=100&auto=format&fit=crop" alt="User">
                    <div>
                        <h5>Eko Susanto</h5>
                        <span>Warga Masyarakat</span>
                    </div>
                </div>
            </div>
            <div class="testi-card">
                <p>"Anak-anak sekolah sekarang bisa memanfaatkan WiFi desa di balai warga untuk belajar dan riset pelajaran daring."</p>
                <div class="user-meta">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=100&auto=format&fit=crop" alt="User">
                    <div>
                        <h5>Siti Rahmawati</h5>
                        <span>Tenaga Pendidik Desa</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: BERITA DESA -->
    <section class="section-padding" style="background: #f8fafc;">
        <p class="section-label">Kabar Terkini</p>
        <h3 class="section-title">Berita Terbaru Seputar Desa Digital</h3>

        <div class="news-grid">
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1518457607834-6e8d80c183c5?q=80&w=500&auto=format&fit=crop" alt="Berita 1">
                <div class="news-body">
                    <span class="news-tag">Infrastruktur</span>
                    <h4>Perluasan Jaringan Fiber Optik ke Wilayah Pesisir</h4>
                    <p>Pemerintah daerah mempercepat pemasangan kabel broadband untuk menunjang transaksi pelelangan ikan.</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=500&auto=format&fit=crop" alt="Berita 2">
                <div class="news-body">
                    <span class="news-tag">Pelatihan SDM</span>
                    <h4>Bimtek Literasi Digital untuk Seluruh Perangkat Desa</h4>
                    <p>Peningkatan kecakapan operasional sistem persuratan daring bagi seluruh operator balai desa.</p>
                </div>
            </div>
            <div class="news-card">
                <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=500&auto=format&fit=crop" alt="Berita 3">
                <div class="news-body">
                    <span class="news-tag">Perekonomian</span>
                    <h4>Wisata Alam Terpadu Manfaatkan Tiket Masuk QRIS</h4>
                    <p>Integrasi dompet digital mendongkrak pendapatan asli desa dari kunjungan destinasi wisata lokal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- BANNER CTA AKHIR -->
    <section class="cta-banner">
        <h2>Siap Membawa Desa Anda Menuju Era Digital Cerdas?</h2>
        <p>Gabungkan layanan administrasi kependudukan dan transparansi publik dalam satu genggaman tangan.</p>
        <div class="btn-group" style="justify-content: center;">
            <button class="btn-white" style="background: white; color: var(--primary); font-weight: 700;">Hubungi Tim Desa</button>
            <button class="btn-outline">Panduan Layanan</button>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="footer-grid">
            <div>
                <h5 style="font-size: 1.2rem; margin-bottom: 12px; color: white;">Desa Digital</h5>
                <p>Inisiatif terpadu menuju tata kelola pemerintahan desa yang akuntabel, efisien, dan melayani masyarakat seutuhnya.</p>
            </div>
            <div class="footer-col">
                <h5>Menu Pintas</h5>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Profil Desa</a></li>
                    <li><a href="#">Layanan KTP/KK</a></li>
                    <li><a href="#">Transparansi APBDes</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h5>Informasi Publik</h5>
                <ul>
                    <li><a href="#">Regulasi & Perdes</a></li>
                    <li><a href="#">Maklumat Pelayanan</a></li>
                    <li><a href="#">Pengaduan Online</a></li>
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

</body>
</html>