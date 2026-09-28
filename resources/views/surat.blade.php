<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Surat Mandiri - Anjungan Pelayanan Mandiri Desa Tuban</title>
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
            --primary-apmd: #5b67e8;
            --primary-apmd-hover: #4a54d1;
            --text-title: #1e293b;
            --text-subtitle: #475569;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --header-slate: #283548;
            --digital-cyan: #28b2fc;
            --emerald: #10b981;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-canvas); color: var(--text-title); min-height: 100vh; overflow-x: hidden; }

        /* 1. Header Navbar */
        .site-header {
            background-color: var(--header-slate);
            padding: 12px 6%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
        }

        .brand-link-clean {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-icon {
            height: 36px;
            width: auto;
            max-width: 48px;
            object-fit: contain;
            display: block;
        }

        .brand-text-logo {
            font-size: 1.55rem;
            letter-spacing: -0.02em;
            line-height: 1;
            display: flex;
            align-items: baseline;
            gap: 6px;
            font-weight: 800;
        }
        .brand-text-logo .text-desa { color: #ffffff; font-weight: 800; }
        .brand-text-logo .text-digital { color: var(--digital-cyan); font-weight: 800; }

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

        .btn-apmd-nav {
            background: var(--primary-apmd);
            color: #ffffff !important;
            padding: 7px 18px !important;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.25s ease !important;
        }
        .btn-apmd-nav:hover {
            background: var(--primary-apmd-hover) !important;
            transform: translateY(-1px);
        }
        .btn-apmd-nav::after { display: none !important; }

        /* 2. Hero Section Bersih & Cerah Ala APMD */
        .hero-apmd {
            background: #ffffff;
            padding: 70px 7% 90px 7%;
            border-bottom: 1.5px solid var(--border-soft);
            position: relative;
            overflow: hidden;
        }

        .hero-apmd-grid {
            max-width: 1240px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            gap: 50px;
            align-items: center;
        }

        .hero-text-wrap {
            max-width: 580px;
        }

        .greeting-tag {
            font-size: 1.35rem;
            font-weight: 600;
            color: #6366f1;
            margin-bottom: 12px;
            display: block;
            letter-spacing: -0.01em;
        }

        .apmd-main-title {
            font-size: 3.3rem;
            font-weight: 900;
            color: #1e293b;
            line-height: 1.15;
            letter-spacing: -0.03em;
            margin-bottom: 20px;
        }

        .apmd-description {
            font-size: 1.05rem;
            color: var(--text-subtitle);
            line-height: 1.7;
            margin-bottom: 34px;
            font-weight: 500;
        }

        .btn-buat-surat {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: var(--primary-apmd);
            color: #ffffff;
            font-size: 1rem;
            font-weight: 700;
            padding: 14px 38px;
            border-radius: 10px;
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(91, 103, 232, 0.35);
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .btn-buat-surat:hover {
            background: var(--primary-apmd-hover);
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(91, 103, 232, 0.45);
        }

        /* Ilustrasi Grafis Kanan (SVG Presisi Sesuai Gambar APMD) */
        .apmd-graphic-container {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .apmd-illustration-svg {
            width: 100%;
            max-width: 460px;
            height: auto;
            filter: drop-shadow(0 15px 35px rgba(99, 102, 241, 0.15));
        }

        /* 3. Floating Bar Lacak Pengajuan Surat */
        .content-body-wrap {
            max-width: 1240px;
            margin: -35px auto 80px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .tracking-box-bar {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            border-radius: 16px;
            padding: 20px 26px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 45px;
            flex-wrap: wrap;
        }

        .tracking-title-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .tracking-icon-circle {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eef2ff;
            color: #6366f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }
        .tracking-title-info h4 {
            font-size: 0.98rem;
            font-weight: 800;
            color: var(--text-title);
        }
        .tracking-title-info p {
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-top: 2px;
        }

        .tracking-input-form {
            display: flex;
            gap: 10px;
            flex: 1;
            max-width: 520px;
        }
        .tracking-input-form input {
            flex: 1;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            padding: 10px 16px;
            font-size: 0.86rem;
            outline: none;
            transition: all 0.2s ease;
        }
        .tracking-input-form input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 12px rgba(99, 102, 241, 0.15);
        }
        .btn-cek-resi {
            background: #1e293b;
            color: #ffffff;
            border: none;
            padding: 10px 22px;
            border-radius: 10px;
            font-size: 0.86rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .btn-cek-resi:hover {
            background: #0f172a;
        }

        /* 4. Katalog Cepat Permohonan Surat Online */
        .section-headline {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--text-title);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .section-headline i { color: #f59e0b; }

        .letter-options-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .letter-card-item {
            background: #ffffff;
            border: 1.5px solid var(--border-soft);
            border-radius: 16px;
            padding: 26px 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
        }
        .letter-card-item::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: var(--card-accent, #6366f1);
        }
        .letter-card-item:hover {
            transform: translateY(-5px);
            border-color: var(--card-accent, #6366f1);
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.08);
        }

        .card-header-flex {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }
        .card-icon-pill {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: var(--card-soft-bg, #eef2ff);
            color: var(--card-accent, #6366f1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }
        .card-header-flex h4 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-title);
            line-height: 1.3;
        }

        .letter-card-item p {
            font-size: 0.84rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 20px;
            flex-grow: 1;
        }

        .btn-card-apmd {
            font-size: 0.84rem;
            font-weight: 800;
            color: var(--card-accent, #6366f1);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .btn-card-apmd i { transition: transform 0.2s ease; }
        .letter-card-item:hover .btn-card-apmd i { transform: translateX(5px); }

        /* 5. Footer Sederhana */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 30px 6%;
            font-size: 0.85rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }
        footer a { color: var(--digital-cyan); text-decoration: none; }

        @media (max-width: 1024px) {
            .hero-apmd-grid { grid-template-columns: 1fr; text-align: center; }
            .hero-text-wrap { max-width: 100%; margin: 0 auto; }
            .letter-options-grid { grid-template-columns: repeat(2, 1fr); }
            .tracking-box-bar { flex-direction: column; align-items: stretch; }
            .tracking-input-form { max-width: 100%; }
        }

        @media (max-width: 640px) {
            .apmd-main-title { font-size: 2.3rem; }
            .letter-options-grid { grid-template-columns: 1fr; }
            .nav-menu { display: none; }
        }
    </style>
</head>
<body>

    <!-- 1. Header Navbar Persis Gambar Referensi -->
    <header class="site-header">
        <a href="<?= url('/'); ?>" class="brand-link-clean">
            <img src="<?= asset('images/desa-digital.png'); ?>" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-icon"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/300px-Lambang_Kabupaten_Tuban.png';">
            
            <div class="brand-text-logo">
                <span class="text-desa">Desa</span>
                <span class="text-digital">Digital</span>
            </div>
        </a>

        <ul class="nav-menu">
            <li><a href="<?= url('/'); ?>">BERANDA</a></li>
            <li><a href="<?= url('/website'); ?>">WEBSITE DESA</a></li>
            <li><a href="<?= url('/data-spasial'); ?>">PETA SPASIAL</a></li>
            <li><a href="<?= url('/cctv'); ?>">CCTV TUBAN</a></li>
            <li><a href="<?= url('/surat'); ?>" class="active">SURAT MANDIRI</a></li>
            <li><a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener" class="btn-apmd-nav"><i class="fa-solid fa-arrow-right-to-bracket"></i> Portal APMD</a></li>
        </ul>
    </header>

    <!-- 2. Hero Section Meniru Desain APMD Tuban (Gambar 1) -->
    <section class="hero-apmd">
        <div class="hero-apmd-grid">
            
            <!-- Sisi Kiri: Teks & Aksi Tautan Resmi -->
            <div class="hero-text-wrap">
                <span class="greeting-tag">Selamat datang di</span>
                <h1 class="apmd-main-title">Anjungan Pelayanan Mandiri Desa</h1>
                <p class="apmd-description">
                    Layanan mandiri warga Desa untuk pengurusan surat desa dengan memanfaatkan KTP-el atau NIK.
                </p>
                <a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener" class="btn-buat-surat">
                    <i class="fa-solid fa-file-circle-plus"></i>
                    <span>Buat Surat</span>
                </a>
            </div>

            <!-- Sisi Kanan: Ilustrasi KTP-el, Handphone & Form APMD -->
            <div class="apmd-graphic-container">
                <svg class="apmd-illustration-svg" viewBox="0 0 500 420" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- Lembar Papan Dokumen Belakang -->
                    <rect x="130" y="30" width="260" height="340" rx="14" fill="#3b4859" opacity="0.12"/>
                    <rect x="140" y="20" width="250" height="340" rx="12" fill="#ffffff" stroke="#4f46e5" stroke-width="6"/>
                    <rect x="155" y="35" width="220" height="290" rx="8" fill="#f8fafc"/>
                    
                    <!-- Bintang Dekorasi Aksen -->
                    <path d="M375 70L382 82L395 85L384 95L387 108L375 101L363 108L366 95L355 85L368 82L375 70Z" fill="#fbbf24"/>
                    <path d="M125 180L130 188L140 190L132 198L134 208L125 203L116 208L118 198L110 190L120 188L125 180Z" fill="#fbbf24"/>
                    
                    <!-- Tangan Kiri Memegang KTP-el -->
                    <path d="M60 380C60 300 120 200 170 180L200 230L140 380H60Z" fill="#38bdf8" opacity="0.3"/>
                    <path d="M85 360L165 210C170 200 185 195 195 200C205 205 210 218 202 230L145 360H85Z" fill="#f87171"/>
                    
                    <!-- Kartu KTP Elektronik -->
                    <g transform="rotate(-5 200 210)">
                        <rect x="160" y="190" width="130" height="85" rx="8" fill="#60a5fa" stroke="#1d4ed8" stroke-width="2"/>
                        <rect x="170" y="202" width="30" height="36" rx="4" fill="#ffffff"/>
                        <circle cx="185" cy="216" r="8" fill="#cbd5e1"/>
                        <path d="M173 234C173 226 197 226 197 234H173Z" fill="#cbd5e1"/>
                        <rect x="210" y="205" width="65" height="6" rx="3" fill="#ffffff"/>
                        <rect x="210" y="217" width="50" height="5" rx="2.5" fill="#e0f2fe"/>
                        <rect x="210" y="227" width="40" height="5" rx="2.5" fill="#e0f2fe"/>
                    </g>
                    
                    <!-- Smartphone di Tangan Kanan -->
                    <rect x="295" y="170" width="110" height="195" rx="18" fill="#1e293b" stroke="#cbd5e1" stroke-width="3"/>
                    <rect x="303" y="182" width="94" height="170" rx="12" fill="#ffffff"/>
                    <rect x="312" y="195" width="76" height="42" rx="6" fill="#6366f1"/>
                    <rect x="312" y="245" width="76" height="20" rx="4" fill="#93c5fd"/>
                    <rect x="312" y="272" width="76" height="20" rx="4" fill="#fde68a"/>
                    
                    <!-- Tangan Kanan Memegang Ponsel -->
                    <path d="M430 380C430 310 395 220 365 210L350 250L385 380H430Z" fill="#6366f1" opacity="0.4"/>
                    <path d="M380 360L355 240C350 228 360 215 372 218C384 220 390 234 388 248L405 360H380Z" fill="#f87171"/>
                </svg>
            </div>

        </div>
    </section>

    <!-- 3. Pelacakan Status Surat & Akses Cepat -->
    <main class="content-body-wrap">
        
        <!-- Bar Lacak Nomor Resi Permohonan -->
        <div class="tracking-box-bar">
            <div class="tracking-title-info">
                <div class="tracking-icon-circle">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <div>
                    <h4>Lacak Status Pengajuan Surat</h4>
                    <p>Periksa progres verifikasi permohonan surat administrasi desa Anda.</p>
                </div>
            </div>

            <form class="tracking-input-form" onsubmit="event.preventDefault(); window.open('https://apmd.tubankab.go.id/', '_blank');">
                <input type="text" placeholder="Contoh: SRT-202609-XXXX" required>
                <button type="submit" class="btn-cek-resi">Cek Resi</button>
            </form>
        </div>

        <!-- Katalog Pilihan Surat -->
        <h2 class="section-headline">
            <i class="fa-solid fa-folder-open"></i>
            <span>Katalog Permohonan Surat Online Terpadu</span>
        </h2>

        <div class="letter-options-grid">
            
            <!-- SKU -->
            <a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener" class="letter-card-item" style="--card-accent: #f59e0b; --card-soft-bg: #fef3c7;">
                <div>
                    <div class="card-header-flex">
                        <div class="card-icon-pill">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <h4>Surat Keterangan Usaha (SKU)</h4>
                    </div>
                    <p>Bukti legalitas kepemilikan usaha lokal warga untuk pengajuan pinjaman perbankan, KUR, atau verifikasi mitra dagang.</p>
                </div>
                <div class="btn-card-apmd">
                    <span>Ajukan di APMD Tuban</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- Domisili -->
            <a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener" class="letter-card-item" style="--card-accent: #0284c7; --card-soft-bg: #e0f2fe;">
                <div>
                    <div class="card-header-flex">
                        <div class="card-icon-pill">
                            <i class="fa-solid fa-house-chimney-user"></i>
                        </div>
                        <h4>Surat Keterangan Domisili</h4>
                    </div>
                    <p>Surat keterangan bukti tempat tinggal warga sementara atau tetap untuk keperluan pendaftaran kerja dan kependudukan.</p>
                </div>
                <div class="btn-card-apmd">
                    <span>Ajukan di APMD Tuban</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- SKCK -->
            <a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener" class="letter-card-item" style="--card-accent: #10b981; --card-soft-bg: #d1fae5;">
                <div>
                    <div class="card-header-flex">
                        <div class="card-icon-pill">
                            <i class="fa-solid fa-id-card-clip"></i>
                        </div>
                        <h4>Pengantar SKCK Desa</h4>
                    </div>
                    <p>Surat pengantar resmi dari pemerintah desa untuk melengkapi berkas penerbitan Catatan Kepolisian di Polsek / Polres Tuban.</p>
                </div>
                <div class="btn-card-apmd">
                    <span>Ajukan di APMD Tuban</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

        </div>

    </main>

    <!-- 5. Footer -->
    <footer>
        <p>&copy; 2026 Pemerintah Kabupaten Tuban • Terintegrasi dengan <a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener">Anjungan Pelayanan Mandiri Desa (APMD)</a>. Seluruh hak cipta dilindungi.</p>
    </footer>

</body>
</html>