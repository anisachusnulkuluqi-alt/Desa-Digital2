<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Digital - Kabupaten Tuban</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            /* PALET TEKNOLOGI PEMERINTAHAN CERAH & DINAMIS */
            --primary-blue: #0284c7;
            --primary-blue-dark: #0369a1;
            --tech-cyan: #0ea5e9;
            --tech-cyan-glow: #38bdf8;
            --royal-indigo: #4f46e5;
            
            /* VARIASI WARNA MODUL EKOSISTEM */
            --var-emerald: #10b981;
            --var-amber: #f59e0b;
            --var-violet: #8b5cf6;
            --var-rose: #f43f5e;
            --var-teal: #0d9488;
            
            /* BACKGROUND ELEGAN & TIDAK TERLALU GELAP */
            --header-dark: #0f172a;
            --nav-dark: #1e293b;
            --bg-light-soft: #f8fafc;
            --bg-tech-gradient: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
            --bg-hub-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            
            /* TEKS & BORDER */
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --border-ui: #e2e8f0;
        }

        html { scroll-behavior: smooth; }
        section[id], footer[id] { scroll-margin-top: 85px; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: #ffffff; color: var(--text-dark); overflow-x: hidden; }

        /* 1. TOP HEADER */
        .top-header {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            padding: 12px 6%; 
            background: var(--header-dark); 
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .logo-area { display: flex; align-items: center; gap: 14px; }
        .logo-tuban-img {
            width: 38px;
            height: 44px;
            object-fit: contain;
            filter: drop-shadow(0 2px 6px rgba(14, 165, 233, 0.4));
        }
        .logo-text h2 { font-size: 1.15rem; font-weight: 800; color: #ffffff; line-height: 1.2; letter-spacing: -0.01em; }
        .logo-text p { font-size: 0.68rem; color: var(--tech-cyan-glow); font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }

        .auth-buttons { display: flex; gap: 12px; align-items: center; }
        .btn-login {
            background: transparent; 
            color: #f1f5f9; 
            text-decoration: none; 
            padding: 8px 20px;
            font-size: 0.85rem; 
            font-weight: 600; 
            border-radius: 8px; 
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.25s ease;
        }
        .btn-login:hover { 
            background: rgba(255, 255, 255, 0.1); 
            color: var(--tech-cyan-glow);
            border-color: var(--tech-cyan);
        }

        .btn-daftar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--tech-cyan) 100%); 
            color: #ffffff; 
            text-decoration: none; 
            padding: 8px 22px;
            font-size: 0.85rem; 
            font-weight: 700; 
            border-radius: 8px; 
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.35);
            transition: all 0.25s ease;
        }
        .btn-daftar:hover { 
            box-shadow: 0 6px 20px rgba(14, 165, 233, 0.5);
            transform: translateY(-1px);
        }

        /* 2. NAVBAR BERURUTAN */
        .navbar {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            padding: 12px 6%; 
            background: var(--nav-dark); 
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: sticky; 
            top: 0; 
            z-index: 100;
            backdrop-filter: blur(12px);
        }
        .nav-links { display: flex; list-style: none; gap: 24px; align-items: center; }
        .nav-links a { 
            color: #94a3b8; 
            text-decoration: none; 
            font-size: 0.85rem; 
            font-weight: 600; 
            transition: color 0.2s ease; 
        }
        .nav-links a.active, .nav-links a:hover { color: var(--tech-cyan-glow); }

        .status-badge {
            font-size: 0.74rem; 
            color: #7dd3fc; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-weight: 700;
            background: rgba(2, 132, 199, 0.15);
            padding: 5px 14px;
            border-radius: 20px;
            border: 1px solid rgba(56, 189, 248, 0.3);
        }
        .status-dot { width: 7px; height: 7px; background: #22c55e; border-radius: 50%; box-shadow: 0 0 8px #22c55e; }

        /* 3. HERO UTAMA: NAIK LEBIH TINGGI KE ATAS DENGAN JARAK PENCARIAN LEGA */
        .hero-tuban {
            position: relative; 
            min-height: 590px; 
            display: flex; 
            flex-direction: column;
            align-items: center; 
            justify-content: flex-start; /* Mengangkat orientasi konten ke atas */
            text-align: center; 
            padding: 50px 24px 85px 24px; /* Padding atas dirampingkan agar judul lebih terangkat */
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
            background-attachment: fixed; 
            color: #ffffff;
            overflow: hidden;
        }

        .hero-welcome-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(56, 189, 248, 0.4);
            padding: 6px 20px;
            border-radius: 30px;
            margin-bottom: 12px; /* Jarak rapat ke judul */
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }
        .hero-welcome-badge span {
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #7dd3fc;
        }

        /* JUDUL ATAS & BAWAH LEBIH TINGGI & MEMBERI JARAK BAWAH KE SEARCH */
        .hero-title-wrap {
            margin-bottom: 58px; /* MEMBERIKAN JARAK LEGA ANTARA JUDUL DENGAN KOLOM PENCARIAN */
            line-height: 1.15;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
        }
        .title-top {
            display: block;
            font-size: 3.3rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: -0.02em;
        }
        .title-bottom {
            display: block;
            font-size: 2.7rem;
            font-weight: 800;
            background: linear-gradient(135deg, #7dd3fc 0%, #38bdf8 50%, #0ea5e9 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 0.5px;
            margin-top: 4px;
        }

        .search-box {
            display: flex; 
            align-items: center; 
            background: #ffffff; 
            border-radius: 50px;
            padding: 6px 8px 6px 20px; 
            width: 100%; 
            max-width: 580px; 
            margin: 0 auto 24px auto;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }
        .search-box i { color: #64748b; margin-right: 12px; }
        .search-box input { border: none; outline: none; width: 100%; font-size: 0.9rem; color: #1e293b; }
        .search-box button {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--tech-cyan) 100%); 
            color: white; 
            border: none; 
            padding: 11px 26px;
            border-radius: 50px; 
            font-weight: 700; 
            font-size: 0.85rem;
            cursor: pointer; 
            transition: all 0.2s ease;
        }
        .search-box button:hover { 
            box-shadow: 0 4px 15px rgba(14, 165, 233, 0.4);
            transform: translateY(-1px);
        }

        .popular-tags { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center; }
        .popular-tags span { font-size: 0.82rem; color: #ffffff; font-weight: 600; text-shadow: 0 2px 4px rgba(0,0,0,0.6); }
        .tag {
            background: rgba(15, 23, 42, 0.75); 
            color: #ffffff; 
            font-weight: 600; 
            text-decoration: none;
            font-size: 0.78rem; 
            padding: 6px 16px; 
            border-radius: 20px; 
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px); 
            transition: all 0.2s ease;
        }
        .tag:hover { 
            background: var(--primary-blue); 
            border-color: var(--tech-cyan-glow);
        }

        /* 4. PROFIL GEOGRAFIS */
        .blue-hero {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #0f172a 100%);
            padding: 85px 6%; 
            color: white; 
            display: grid; 
            grid-template-columns: 1.15fr 1fr;
            gap: 48px; 
            align-items: center;
        }
        .badge-pill {
            display: inline-flex; align-items: center; gap: 6px; background: rgba(255, 255, 255, 0.15);
            color: #7dd3fc; padding: 6px 16px; border-radius: 20px; font-size: 0.76rem; font-weight: 800; margin-bottom: 16px;
            border: 1px solid rgba(255, 255, 255, 0.25);
        }
        .blue-hero h2 { font-size: 2.35rem; line-height: 1.25; font-weight: 800; margin-bottom: 18px; letter-spacing: -0.01em; }
        .blue-hero h2 span { color: #7dd3fc; }
        .blue-hero p { font-size: 0.95rem; color: #f0f9ff; line-height: 1.7; margin-bottom: 26px; }

        .btn-group { display: flex; gap: 14px; }
        .btn-white {
            background: #ffffff; 
            color: var(--primary-blue-dark); 
            text-decoration: none; 
            padding: 11px 22px;
            border-radius: 8px; 
            font-weight: 800; 
            font-size: 0.85rem; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
            transition: 0.25s;
        }
        .btn-white:hover { background: #f8fafc; transform: translateY(-1px); }
        .btn-outline {
            background: rgba(255, 255, 255, 0.1); 
            color: white; 
            border: 1px solid rgba(255, 255, 255, 0.35);
            padding: 11px 22px; 
            border-radius: 8px; 
            font-weight: 600; 
            font-size: 0.85rem; 
            text-decoration: none; 
            display: inline-flex; 
            align-items: center; 
            gap: 8px; 
            transition: 0.25s;
        }
        .btn-outline:hover { background: rgba(255, 255, 255, 0.2); }

        /* 5. DIREKTORI 9 MODUL */
        .section-padding { padding: 90px 6%; text-align: center; }
        .section-label {
            color: var(--primary-blue); font-size: 0.78rem; font-weight: 800; text-transform: uppercase;
            letter-spacing: 1.5px; margin-bottom: 10px;
        }
        .section-title { font-size: 2.2rem; font-weight: 800; margin-bottom: 12px; color: var(--text-dark); letter-spacing: -0.02em; }
        .section-subtitle { font-size: 0.94rem; color: var(--text-gray); max-width: 650px; margin: 0 auto 52px auto; line-height: 1.65; }
        
        .premium-services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
            max-width: 1200px;
            margin: 0 auto;
            text-align: left;
        }

        .premium-menu-card {
            background: #ffffff;
            border: 1.5px solid var(--border-ui);
            border-radius: 16px;
            padding: 24px 22px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
            text-decoration: none;
            color: inherit;
            transition: all 0.25s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .premium-menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px -4px rgba(2, 132, 199, 0.12);
        }

        .card-icon-wrap {
            width: 50px;
            height: 50px;
            min-width: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.3rem;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-body-wrap { flex: 1; }
        .card-tag-badge {
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
            display: inline-block;
        }

        .premium-menu-card h4 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .badge-utama {
            background: var(--primary-blue);
            color: white;
            font-size: 0.62rem;
            padding: 2px 7px;
            border-radius: 4px;
            font-weight: 700;
        }

        .premium-menu-card p {
            font-size: 0.82rem;
            color: var(--text-gray);
            line-height: 1.5;
        }

        /* 6. STRIP STATISTIK */
        .stats-strip {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); 
            padding: 48px 6%; 
            display: grid; 
            grid-template-columns: repeat(4, 1fr);
            text-align: center; 
            color: white; 
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .stat-item { text-decoration: none; color: inherit; display: block; }
        .stat-item h3 { font-size: 2.8rem; font-weight: 900; color: #38bdf8; }
        .stat-item p { font-size: 0.88rem; color: #cbd5e1; margin-top: 6px; font-weight: 600; }

        /* 7. HUB EKOSISTEM LAYANAN */
        .hub-section-modern {
            background: linear-gradient(180deg, #f0f7ff 0%, #ffffff 100%);
            padding: 95px 6%;
            position: relative;
        }

        .portal-hub-card {
            background: #ffffff;
            border: 1.5px solid var(--border-ui);
            border-radius: 18px;
            padding: 26px 18px;
            text-decoration: none;
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: all 0.25s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
        }

        .portal-hub-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 30px -4px rgba(0, 0, 0, 0.08);
        }

        .hub-icon-wrap {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            color: #ffffff;
            margin-bottom: 16px;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        }

        .portal-hub-card h4 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .portal-hub-card p {
            font-size: 0.78rem;
            color: var(--text-gray);
            line-height: 1.5;
            margin-bottom: 14px;
            flex-grow: 1;
        }

        .hub-link-tag {
            font-size: 0.74rem;
            font-weight: 800;
        }

        /* 8. ALUR STEP CARDS */
        .step-card-modern {
            background: #ffffff;
            border: 1.5px solid var(--border-ui);
            border-radius: 16px;
            padding: 26px 20px;
            position: relative;
            transition: all 0.25s ease;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
        }

        .step-card-modern:hover {
            border-color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.12);
        }

        .step-badge {
            position: absolute;
            top: -12px;
            left: 20px;
            font-size: 0.68rem;
            font-weight: 800;
            color: white;
            padding: 3px 12px;
            border-radius: 20px;
            letter-spacing: 0.5px;
        }

        .step-icon-area {
            font-size: 1.85rem;
            margin: 8px 0 14px 0;
        }

        .step-card-modern h5 {
            font-size: 1.02rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .step-card-modern p {
            font-size: 0.8rem;
            color: var(--text-gray);
            line-height: 1.55;
        }

        /* 9. BERITA */
        .news-grid-modern {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 26px; margin-top: 36px; text-align: left;
        }
        .news-card-modern {
            background: #ffffff; border: 1.5px solid var(--border-ui); border-radius: 16px; overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04); transition: all 0.25s ease;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .news-card-modern:hover {
            transform: translateY(-5px); box-shadow: 0 16px 30px -4px rgba(2, 132, 199, 0.12); border-color: var(--tech-cyan);
        }
        .news-thumb-wrap { position: relative; height: 190px; overflow: hidden; }
        .news-thumb-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .news-date-badge {
            position: absolute; bottom: 12px; right: 12px; background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(6px); color: #f8fafc; font-size: 0.7rem; font-weight: 700;
            padding: 4px 10px; border-radius: 20px;
        }
        .news-body-modern { padding: 22px; flex-grow: 1; display: flex; flex-direction: column; }
        .news-tag-badge {
            font-size: 0.7rem; font-weight: 800; padding: 4px 10px; border-radius: 6px;
            display: inline-block; width: fit-content; margin-bottom: 12px;
        }
        .news-card-modern h4 {
            font-size: 1.05rem; font-weight: 800; color: var(--text-dark); line-height: 1.4; margin-bottom: 10px;
        }
        .news-card-modern p {
            font-size: 0.84rem; color: var(--text-gray); line-height: 1.6; margin-bottom: 18px; flex-grow: 1;
        }
        .news-link-btn {
            font-size: 0.84rem; font-weight: 700; color: var(--primary-blue); text-decoration: none;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .news-link-btn:hover { text-decoration: underline; color: var(--tech-cyan); }

        /* 10. TESTIMONI */
        .testi-grid-modern {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-top: 36px; text-align: left;
        }
        .testi-card-modern {
            background: #ffffff; border: 1.5px solid var(--border-ui); border-radius: 16px; padding: 28px 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03); position: relative; transition: all 0.25s ease;
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .testi-card-modern:hover {
            transform: translateY(-4px); box-shadow: 0 14px 24px -4px rgba(2, 132, 199, 0.1); border-color: var(--tech-cyan);
        }
        .quote-icon-bg {
            position: absolute; top: 20px; right: 20px; font-size: 2.2rem; color: #e2e8f0; opacity: 0.5;
        }
        .stars-row { color: #f59e0b; font-size: 0.8rem; margin-bottom: 14px; display: flex; gap: 3px; }
        .testi-card-modern p {
            font-size: 0.88rem; color: #334155; line-height: 1.65; font-style: italic; position: relative; z-index: 1; margin-bottom: 22px;
        }
        .user-meta-modern {
            display: flex; align-items: center; gap: 14px; border-top: 1px solid #f1f5f9; padding-top: 16px;
        }
        .user-meta-modern img {
            width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid var(--tech-cyan);
        }
        .user-meta-modern h5 { font-size: 0.9rem; font-weight: 800; color: var(--text-dark); line-height: 1.2; }
        .user-meta-modern span { font-size: 0.74rem; color: var(--text-gray); margin-top: 2px; display: block; }

        /* 11. MAP LOKASI DISKOMINFO TUBAN */
        .location-section {
            background: #ffffff;
            padding: 85px 6%;
        }
        .location-card-grid {
            display: grid;
            grid-template-columns: 1fr 1.35fr;
            gap: 32px;
            max-width: 1200px;
            margin: 0 auto;
            align-items: stretch;
        }
        .location-info-card {
            background: #f8fafc;
            border: 1.5px solid var(--border-ui);
            border-radius: 20px;
            padding: 34px 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .map-frame-box {
            border-radius: 20px;
            overflow: hidden;
            border: 1.5px solid var(--border-ui);
            box-shadow: 0 12px 30px rgba(2, 132, 199, 0.08);
            min-height: 380px;
        }

        /* 12. FOOTER ELEGAN */
        footer { 
            background: #0f172a; 
            color: #94a3b8; 
            padding: 70px 6% 30px 6%; 
            font-size: 0.85rem; 
            border-top: 1px solid rgba(255, 255, 255, 0.08); 
        }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 40px; margin-bottom: 40px; }
        .footer-col h5 { color: white; font-size: 0.95rem; margin-bottom: 18px; font-weight: 800; }
        .footer-col ul { list-style: none; }
        .footer-col ul li { margin-bottom: 11px; }
        .footer-col ul li a { color: #94a3b8; text-decoration: none; transition: color 0.2s; }
        .footer-col ul li a:hover { color: var(--tech-cyan-glow); }

        .social-media-pills {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 18px;
        }
        .btn-sosmed {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.25s ease;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .btn-sosmed:hover {
            transform: translateY(-3px);
            background: var(--primary-blue);
            border-color: var(--tech-cyan-glow);
            color: #ffffff;
        }

        @media (max-width: 1024px) {
            .blue-hero { grid-template-columns: 1fr; }
            .premium-services-grid { grid-template-columns: repeat(2, 1fr); }
            .news-grid-modern, .testi-grid-modern { grid-template-columns: repeat(2, 1fr); }
            .location-card-grid { grid-template-columns: 1fr; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
            #alur-layanan .portal-hub-card-grid { grid-template-columns: repeat(3, 1fr) !important; }
            #alur-layanan .step-grid-row { grid-template-columns: repeat(2, 1fr) !important; }
        }

        @media (max-width: 640px) {
            .navbar { display: none; }
            .hero-tuban { padding-top: 40px; }
            .hero-title-wrap { margin-bottom: 38px; }
            .title-top { font-size: 2.3rem; }
            .title-bottom { font-size: 1.9rem; }
            .premium-services-grid, .stats-strip, .news-grid-modern, .testi-grid-modern, .footer-grid { grid-template-columns: 1fr; }
            #alur-layanan .portal-hub-card-grid { grid-template-columns: 1fr !important; }
            #alur-layanan .step-grid-row { grid-template-columns: 1fr !important; }
        }
    </style>
</head>
<body>

    <!-- 1. TOP HEADER RESMI (DENGAN FALLBACK LOGO LOKAL & ONLINE ANTI-RUSAK) -->
    <header class="top-header">
        <div class="logo-area">
            <img src="<?php echo e(asset('images/logo-tuban.png')); ?>" 
                 alt="Logo Kabupaten Tuban" 
                 class="logo-tuban-img"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Lambang_Kabupaten_Tuban.png/300px-Lambang_Kabupaten_Tuban.png';">
            <div class="logo-text">
                <h2>Desa Digital</h2>
                <p>Kabupaten Tuban</p>
            </div>
        </div>
        <div class="auth-buttons">
            <a href="<?php echo e(url('/login')); ?>" class="btn-login">Masuk</a>
            <a href="<?php echo e(url('/register')); ?>" class="btn-daftar">Daftar Akun</a>
        </div>
    </header>

    <!-- 2. NAVBAR BERURUTAN -->
    <nav class="navbar">
        <ul class="nav-links">
            <li><a href="#hero-tuban" class="active">Beranda</a></li>
            <li><a href="#profil-wilayah">Profil Tuban</a></li>
            <li><a href="#layanan-unggulan">Layanan & Data</a></li>
            <li><a href="#statistik-wilayah">Statistik Wilayah</a></li>
            <li><a href="#alur-layanan">Layanan Terpadu</a></li>
            <li><a href="#berita-acara">Kabar Daerah</a></li>
            <li><a href="#aspirasi-warga">Aspirasi Warga</a></li>
            <li><a href="#lokasi-kominfo">Lokasi Kominfo</a></li>
            <li><a href="#hubungi-kami">Hubungi Kami</a></li>
        </ul>
        <div class="status-badge">
            <span class="status-dot"></span> Sistem Aktif
        </div>
    </nav>

    <!-- 3. HERO UTAMA DENGAN POSISI JUDUL NAIK KE ATAS & BERJARAK LEGA KE SEARCH -->
    <section id="hero-tuban" class="hero-tuban" style="background-image: linear-gradient(rgba(15, 23, 42, 0.65), rgba(2, 132, 199, 0.35)), url('<?php echo e(asset('images/alun-alun-tuban.jpg')); ?>');">
        
        <!-- Badge Elegan Modern -->
        <div class="hero-welcome-badge">
            <i class="fa-solid fa-circle-nodes" style="color: var(--tech-cyan-glow); font-size: 0.85rem;"></i>
            <span>Selamat Datang di Portal Resmi</span>
        </div>

        <!-- JUDUL ATAS & BAWAH LEBIH KE ATAS DAN BERJARAK DENGAN SEARCH -->
        <div class="hero-title-wrap">
            <span class="title-top">Desa Digital</span>
            <span class="title-bottom">Kabupaten Tuban</span>
        </div>

        <!-- KOLOM PENCARIAN -->
        <form class="search-box" action="<?php echo e(url('/desa')); ?>" method="GET">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" placeholder="Cari layanan administrasi, regulasi desa, atau informasi fasilitas publik...">
            <button type="submit">Telusuri</button>
        </form>

        <div class="popular-tags">
            <span>Akses Cepat:</span>
            <a href="javascript:void(0)" onclick="openLayananModal()" class="tag">Pengurusan Surat</a>
            <a href="<?php echo e(url('/data-spasial')); ?>" class="tag">Peta Spasial (GIS)</a>
            <a href="<?php echo e(url('/desa')); ?>" class="tag">Katalog Desa</a>
            <a href="javascript:void(0)" onclick="openBansosModal()" class="tag">Cek Bansos NIK</a>
            <a href="javascript:void(0)" onclick="openPbbModal()" class="tag">Bayar e-PBB</a>
        </div>
    </section>

    <!-- 4. PROFIL KABUPATEN TUBAN -->
    <section id="profil-wilayah" class="blue-hero">
        <div>
            <span class="badge-pill">
                <i class="fa-solid fa-compass"></i> PROFIL KABUPATEN TUBAN
            </span>
            <h2>
                Mengenal Kabupaten Tuban: <span>Bumi Ronggolawe</span> di Gerbang Pesisir Pantura
            </h2>
            <p>
                Terbentang di pesisir utara Jawa Timur dengan garis laut sepanjang 65 km, Kabupaten Tuban menghubungkan simpul strategis maritim, kawasan perbukitan kapur, hingga wilayah agraris lembah Bengawan Solo yang menaungi 20 kecamatan dan 328 desa/kelurahan.
            </p>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 28px;">
                <div style="background: rgba(255, 255, 255, 0.1); padding: 14px; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.2);">
                    <small style="color: #7dd3fc; font-weight: 700; font-size: 0.7rem; text-transform: uppercase;">Luas Wilayah</small>
                    <h5 style="font-size: 1.05rem; font-weight: 800; margin-top: 4px;">1.839,94 km²</h5>
                </div>
                <div style="background: rgba(255, 255, 255, 0.1); padding: 14px; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.2);">
                    <small style="color: #7dd3fc; font-weight: 700; font-size: 0.7rem; text-transform: uppercase;">Panjang Pantai</small>
                    <h5 style="font-size: 1.05rem; font-weight: 800; margin-top: 4px;">65 Km Laut</h5>
                </div>
                <div style="background: rgba(255, 255, 255, 0.1); padding: 14px; border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.2);">
                    <small style="color: #7dd3fc; font-weight: 700; font-size: 0.7rem; text-transform: uppercase;">Administrasi</small>
                    <h5 style="font-size: 1.05rem; font-weight: 800; margin-top: 4px;">20 Kecamatan</h5>
                </div>
            </div>

            <div class="btn-group">
                <a href="<?php echo e(url('/data-spasial')); ?>" class="btn-white">
                    <i class="fa-solid fa-map"></i> Buka Peta Spasial Tuban
                </a>
                <a href="https://tubankab.go.id" target="_blank" class="btn-outline">
                    Portal Resmi Pemkab Tuban
                </a>
            </div>
        </div>

        <div style="position: relative; width: 100%;">
            <div style="background: rgba(255, 255, 255, 0.1); padding: 14px; border-radius: 18px; border: 1px solid rgba(255, 255, 255, 0.25); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.3);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding: 0 4px;">
                    <span style="font-size: 0.78rem; color: #7dd3fc; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                        <i class="fa-brands fa-youtube" style="color: #ef4444; font-size: 1rem;"></i> Diskominfo-SP Tuban Official
                    </span>
                    <span style="font-size: 0.7rem; color: #ffffff; background: rgba(0,0,0,0.35); padding: 3px 10px; border-radius: 6px; border: 1px solid rgba(255,255,255,0.15);">
                        Profil Daerah
                    </span>
                </div>

                <div style="position: relative; width: 100%; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; background: #000;">
                    <iframe 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                        src="https://www.youtube.com/embed/gPCZo6dKDWM?rel=0" 
                        title="Video Profil Resmi Kabupaten Tuban" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. DIREKTORI 9 MODUL LAYANAN ATAU DATA -->
    <section id="layanan-unggulan" class="section-padding" style="background: var(--bg-tech-gradient);">
        <p class="section-label">LAYANAN & DATA WILAYAH</p>
        <h3 class="section-title">Direktori Data & Layanan Administrasi</h3>
        <p class="section-subtitle">Akses cepat ke pusat data kelembagaan desa, fasilitas umum, sentra komoditas ekonomi, dan infrastruktur wilayah.</p>

        <div class="premium-services-grid">
            
            <!-- 1. Desa Utama (Biru Tech) -->
            <a href="<?php echo e(url('/desa')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--primary-blue);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--tech-cyan) 100%);">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--primary-blue);">Master Data</span>
                    <h4>DESA <span class="badge-utama">UTAMA</span></h4>
                    <p>Profil umum, data geografis, sejarah, dan struktur kepengurusan desa.</p>
                </div>
            </a>

            <!-- 2. Dusun (Teal) -->
            <a href="<?php echo e(url('/desa')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--var-teal);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);">
                    <i class="fa-solid fa-house-chimney-window"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--var-teal);">Kewilayahan</span>
                    <h4>DUSUN</h4>
                    <p>Data kewilayahan dusun, rukun tetangga (RT), dan demografi lokal.</p>
                </div>
            </a>

            <!-- 3. Kecamatan (Indigo) -->
            <a href="<?php echo e(url('/desa')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--royal-indigo);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);">
                    <i class="fa-solid fa-building-columns"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--royal-indigo);">Distrik</span>
                    <h4>KECAMATAN</h4>
                    <p>Informasi terintegrasi dengan distrik wilayah administratif Tuban.</p>
                </div>
            </a>

            <!-- 4. Wisata Desa (Emerald) -->
            <a href="<?php echo e(url('/data-spasial')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--var-emerald);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);">
                    <i class="fa-solid fa-mountain-sun"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--var-emerald);">Potensi Alam</span>
                    <h4>WISATA DESA</h4>
                    <p>Eksplorasi potensi pariwisata daerah, kebudayaan, dan cagar alam.</p>
                </div>
            </a>

            <!-- 5. Pasar Desa (Amber) -->
            <a href="<?php echo e(url('/data-spasial')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--var-amber);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);">
                    <i class="fa-solid fa-store"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--var-amber);">Perekonomian</span>
                    <h4>PASAR DESA</h4>
                    <p>Daftar pasar rakyat, komoditas utama, pelaku usaha mikro (UMKM).</p>
                </div>
            </a>

            <!-- 6. Kantor Desa (Cyan Tech) -->
            <a href="javascript:void(0)" onclick="openLayananModal()" class="premium-menu-card" style="border-left: 4px solid var(--tech-cyan);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--tech-cyan);">Administrasi</span>
                    <h4>KANTOR DESA</h4>
                    <p>Sistem layanan administrasi surat menyurat dan perizinan terpadu.</p>
                </div>
            </a>

            <!-- 7. WiFi Desa (Sky Blue) -->
            <a href="<?php echo e(url('/data-spasial')); ?>" class="premium-menu-card" style="border-left: 4px solid #0ea5e9;">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);">
                    <i class="fa-solid fa-wifi"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: #0ea5e9;">Infrastruktur</span>
                    <h4>WIFI DESA</h4>
                    <p>Pemantauan akses internet publik gratis dan jaringan desa digital.</p>
                </div>
            </a>

            <!-- 8. BUMDes (Violet) -->
            <a href="<?php echo e(url('/data-spasial')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--var-violet);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--var-violet);">Badan Usaha</span>
                    <h4>BUMDES</h4>
                    <p>Manajemen unit usaha bersama, keuangan, dan aset milik desa.</p>
                </div>
            </a>

            <!-- 9. KKDMP (Rose/Pink) -->
            <a href="<?php echo e(url('/desa')); ?>" class="premium-menu-card" style="border-left: 4px solid var(--var-rose);">
                <div class="card-icon-wrap" style="background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%);">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
                <div class="card-body-wrap">
                    <span class="card-tag-badge" style="color: var(--var-rose);">Perencanaan</span>
                    <h4>KKDMP</h4>
                    <p>Rencana Pembangunan Jangka Menengah desa dan dokumen strategis.</p>
                </div>
            </a>

        </div>
    </section>

    <!-- 6. ANGKA STATISTIK KESELURUHAN DATA -->
    <section id="statistik-wilayah" class="stats-strip">
        <div class="stat-item">
            <h3><?php echo e($totalWifi ?? 448); ?></h3>
            <p>Titik WiFi Aktif</p>
        </div>
        <a href="<?php echo e(url('/desa')); ?>" class="stat-item">
            <h3><?php echo e($totalWebDesa ?? 328); ?></h3>
            <p>Portal Desa Terhubung</p>
        </a>
        <div class="stat-item">
            <h3><?php echo e($totalWisata ?? 35); ?></h3>
            <p>Destinasi Wisata</p>
        </div>
        <div class="stat-item">
            <h3><?php echo e($totalDesaTerdaftar ?? 328); ?></h3>
            <p>Balai Pelayanan Terdaftar</p>
        </div>
    </section>

    <!-- 7. HUB EKOSISTEM LAYANAN & ALUR PENGURUSAN DOKUMEN -->
    <section id="alur-layanan" class="hub-section-modern">
        <div style="max-width: 1240px; margin: 0 auto;">
            
            <div style="text-align: center; max-width: 720px; margin: 0 auto 52px auto;">
                <span style="background: #e0f2fe; color: var(--primary-blue-dark); padding: 6px 18px; border-radius: 30px; font-size: 0.74rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; display: inline-block; margin-bottom: 12px; border: 1px solid #bae6fd;">
                    Inovasi Pelayanan Terpadu
                </span>
                <h2 style="font-size: 2.3rem; font-weight: 800; letter-spacing: -0.02em; line-height: 1.25; margin-bottom: 12px; color: var(--text-dark);">
                    Ekosistem Layanan Publik Terintegrasi
                </h2>
                <p style="font-size: 0.94rem; color: var(--text-gray); line-height: 1.65;">
                    Portal terpadu pengurusan berkas kependudukan mandiri, pemetaan geospasial, pemantauan CCTV publik, dan kemudahan pembayaran pajak daerah.
                </p>
            </div>

            <!-- 5 Hub Pilihan -->
            <div class="portal-hub-card-grid" style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; margin-bottom: 55px;">
                
                <!-- 1. Website Desa -->
                <a href="<?php echo e(url('/desa')); ?>" class="portal-hub-card">
                    <div class="hub-icon-wrap" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--tech-cyan) 100%);">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <h4>Website Desa</h4>
                    <p>Katalog profil kelurahan dan transparansi informasi publik desa.</p>
                    <span class="hub-link-tag" style="color: var(--primary-blue);">Buka Katalog &rarr;</span>
                </a>

                <!-- 2. Data Spasial -->
                <a href="<?php echo e(url('/data-spasial')); ?>" class="portal-hub-card">
                    <div class="hub-icon-wrap" style="background: linear-gradient(135deg, #0d9488 0%, #10b981 100%);">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h4>Data Spasial</h4>
                    <p>Peta geospasial sebaran WiFi, pasar, kantor desa, dan BUMDes.</p>
                    <span class="hub-link-tag" style="color: #0d9488;">Jelajahi Peta &rarr;</span>
                </a>

                <!-- 3. Surat Desa -->
                <a href="javascript:void(0)" onclick="openLayananModal()" class="portal-hub-card">
                    <div class="hub-icon-wrap" style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <h4>Surat Desa</h4>
                    <p>Permohonan SKU, domisili, dan pengantar nikah mandiri.</p>
                    <span class="hub-link-tag" style="color: #d97706;">Ajukan Surat &rarr;</span>
                </a>

                <!-- 4. CCTV Wilayah -->
                <a href="javascript:void(0)" onclick="openCctvModal()" class="portal-hub-card">
                    <div class="hub-icon-wrap" style="background: linear-gradient(135deg, #e11d48 0%, #f43f5e 100%);">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <h4>CCTV Wilayah</h4>
                    <p>Pantauan langsung titik keramaian publik dan keamanan balai warga.</p>
                    <span class="hub-link-tag" style="color: #e11d48;">Live Pantau &rarr;</span>
                </a>

                <!-- 5. e-PBB Desa -->
                <a href="javascript:void(0)" onclick="openPbbModal()" class="portal-hub-card">
                    <div class="hub-icon-wrap" style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%);">
                        <i class="fa-solid fa-qrcode"></i>
                    </div>
                    <h4>e-PBB Desa</h4>
                    <p>Cek tagihan dan pembayaran pajak PBB-P2 secara nontunai.</p>
                    <span class="hub-link-tag" style="color: #7c3aed;">Cek Tagihan &rarr;</span>
                </a>

            </div>

            <!-- Alur Pengurusan Dokumen -->
            <div style="background: #ffffff; border: 1.5px solid var(--border-ui); border-radius: 20px; padding: 40px 32px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.03);">
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 32px; border-bottom: 1px solid var(--border-ui); padding-bottom: 18px;">
                    <div>
                        <h3 style="font-size: 1.3rem; font-weight: 800; color: var(--text-dark);">Alur Pengurusan Dokumen Kependudukan</h3>
                        <p style="font-size: 0.82rem; color: var(--text-gray); margin-top: 4px;">Empat langkah ringkas mengurus administrasi desa tanpa perlu antre lama.</p>
                    </div>
                    <span style="font-size: 0.78rem; color: var(--primary-blue-dark); background: #e0f2fe; padding: 6px 14px; border-radius: 20px; font-weight: 700;">
                        Proses: 5–15 Menit
                    </span>
                </div>

                <div class="step-grid-row" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px;">
                    
                    <div class="step-card-modern">
                        <div class="step-badge" style="background: var(--primary-blue);">Langkah 1</div>
                        <div class="step-icon-area" style="color: var(--primary-blue);">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <h5>Pilih Dokumen</h5>
                        <p>Tentukan jenis surat (SKU, Keterangan Domisili, Pengantar SKCK, atau SKTM).</p>
                    </div>

                    <div class="step-card-modern">
                        <div class="step-badge" style="background: var(--var-teal);">Langkah 2</div>
                        <div class="step-icon-area" style="color: var(--var-teal);">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <h5>Unggah Persyaratan</h5>
                        <p>Lampirkan foto KTP, Kartu Keluarga, dan surat pengantar RT/RW setempat.</p>
                    </div>

                    <div class="step-card-modern">
                        <div class="step-badge" style="background: var(--var-amber);">Langkah 3</div>
                        <div class="step-icon-area" style="color: var(--var-amber);">
                            <i class="fa-solid fa-user-check"></i>
                        </div>
                        <h5>Validasi Data</h5>
                        <p>Operator balai desa memeriksa keabsahan berkas melalui dashboard terpadu.</p>
                    </div>

                    <div class="step-card-modern">
                        <div class="step-badge" style="background: var(--var-emerald);">Langkah 4</div>
                        <div class="step-icon-area" style="color: var(--var-emerald);">
                            <i class="fa-solid fa-print"></i>
                        </div>
                        <h5>Cetak Mandiri</h5>
                        <p>Dokumen ber-barcode resmi siap diunduh dari rumah atau diambil di balai desa.</p>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- 8. BERITA ACARA ATAU INFORMASI DAERAH TUBAN -->
    <section id="berita-acara" class="section-padding" style="background: #ffffff;">
        <p class="section-label">PUBLIKASI RESMI DAERAH</p>
        <h3 class="section-title">Kabar Terkini Bumi Ronggolawe</h3>
        <p class="section-subtitle">Kilas perkembangan transformasi layanan digital, infrastruktur pedesaan, serta perekonomian Kabupaten Tuban.</p>

        <div class="news-grid-modern">
            <div class="news-card-modern">
                <div class="news-thumb-wrap">
                    <img src="https://images.unsplash.com/photo-1518457607834-6e8d80c183c5?q=80&w=600&auto=format&fit=crop" alt="Perluasan Fiber Optik">
                    <span class="news-date-badge">07 Sep 2026</span>
                </div>
                <div class="news-body-modern">
                    <span class="news-tag-badge" style="background: #e0f2fe; color: var(--primary-blue);">Infrastruktur</span>
                    <h4>Perluasan Jaringan Fiber Optik ke Pesisir Pantura</h4>
                    <p>Pemerintah daerah mempercepat integrasi koneksi pita lebar untuk mendukung digitalisasi transaksi nelayan dan kantor desa.</p>
                    <a href="<?php echo e(url('/desa')); ?>" class="news-link-btn">Baca Selengkapnya &rarr;</a>
                </div>
            </div>

            <div class="news-card-modern">
                <div class="news-thumb-wrap">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?q=80&w=600&auto=format&fit=crop" alt="Bimtek Literasi Digital">
                    <span class="news-date-badge">04 Sep 2026</span>
                </div>
                <div class="news-body-modern">
                    <span class="news-tag-badge" style="background: #ccfbf1; color: var(--var-teal);">Pelatihan SDM</span>
                    <h4>Bimtek Pengelolaan Sistem Informasi Aparatur Desa</h4>
                    <p>Peningkatan kecakapan operasional aparatur balai desa guna memastikan efisiensi pelayanan administrasi mandiri.</p>
                    <a href="<?php echo e(url('/desa')); ?>" class="news-link-btn">Baca Selengkapnya &rarr;</a>
                </div>
            </div>

            <div class="news-card-modern">
                <div class="news-thumb-wrap">
                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=600&auto=format&fit=crop" alt="Wisata dan QRIS">
                    <span class="news-date-badge">01 Sep 2026</span>
                </div>
                <div class="news-body-modern">
                    <span class="news-tag-badge" style="background: #fef3c7; color: var(--var-amber);">Perekonomian</span>
                    <h4>Destinasi Wisata Desa Adopsi Tiket Non-Tunai QRIS</h4>
                    <p>Penerapan transaksi nontunai meningkatkan transparansi penerimaan pendapatan asli desa dari sektor pariwisata lokal.</p>
                    <a href="<?php echo e(url('/desa')); ?>" class="news-link-btn">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. ASPIRASI DAN TANGGAPAN WARGA -->
    <section id="aspirasi-warga" class="section-padding" style="background: #f8fafc;">
        <p class="section-label">SUARA MASYARAKAT</p>
        <h3 class="section-title">Aspirasi & Tanggapan Warga</h3>
        <p class="section-subtitle">Testimoni langsung masyarakat Kabupaten Tuban dalam memanfaatkan ekosistem digital terpadu.</p>

        <div class="testi-grid-modern">
            <div class="testi-card-modern">
                <i class="fa-solid fa-quote-right quote-icon-bg"></i>
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p>"Pengurusan surat izin domisili usaha saya selesai dalam hitungan menit tanpa perlu meninggalkan warung seharian."</p>
                <div class="user-meta-modern">
                    <img src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?q=80&w=120&auto=format&fit=crop" alt="H. Dwi Santoso">
                    <div>
                        <h5>H. Dwi Santoso</h5>
                        <span>Pelaku UMKM Pesisir</span>
                    </div>
                </div>
            </div>

            <div class="testi-card-modern">
                <i class="fa-solid fa-quote-right quote-icon-bg"></i>
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p>"Transparansi anggaran desa dan progres paving jalan dusun kini bisa dipantau secara terbuka oleh seluruh warga."</p>
                <div class="user-meta-modern">
                    <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?q=80&w=120&auto=format&fit=crop" alt="Eko Susanto">
                    <div>
                        <h5>Eko Susanto</h5>
                        <span>Tokoh Warga Dusun</span>
                    </div>
                </div>
            </div>

            <div class="testi-card-modern">
                <i class="fa-solid fa-quote-right quote-icon-bg"></i>
                <div class="stars-row">
                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                </div>
                <p>"Akses WiFi gratis di balai warga sangat meringankan biaya kuota untuk anak-anak kami saat belajar daring."</p>
                <div class="user-meta-modern">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=120&auto=format&fit=crop" alt="Siti Rahmawati">
                    <div>
                        <h5>Siti Rahmawati</h5>
                        <span>Pendidik Pedesaan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 10. ALOKASI LOKASI DISKOMINFO SP TUBAN -->
    <section id="lokasi-kominfo" class="location-section">
        <div style="text-align: center; max-width: 680px; margin: 0 auto 48px auto;">
            <p class="section-label">LOKASI KEDINASAN</p>
            <h3 class="section-title">Kantor Diskominfo SP Kabupaten Tuban</h3>
            <p class="section-subtitle">Pusat tata kelola teknologi informasi, statistik daerah, persandian, dan pengelolaan ekosistem Desa Digital Kabupaten Tuban.</p>
        </div>

        <div class="location-card-grid">
            <div class="location-info-card">
                <div>
                    <span style="font-size: 0.72rem; color: var(--primary-blue); font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Alamat Kantor</span>
                    <h4 style="font-size: 1.28rem; font-weight: 800; color: var(--text-dark); margin: 6px 0 14px 0;">Dinas Komunikasi, Informatika, Statistik dan Persandian</h4>
                    
                    <p style="font-size: 0.88rem; color: #475569; line-height: 1.6; margin-bottom: 20px;">
                        <i class="fa-solid fa-location-dot" style="color: var(--primary-blue); margin-right: 8px;"></i>
                        Jl. Kartini No. 2, Kutorejo, Kec. Tuban, Kabupaten Tuban, Jawa Timur 62311
                    </p>

                    <div style="display: flex; flex-direction: column; gap: 10px; font-size: 0.84rem; color: #334155; margin-bottom: 24px;">
                        <div><i class="fa-regular fa-clock" style="color: var(--primary-blue); margin-right: 8px;"></i> <strong>Jam Operasional:</strong> Senin – Jumat (07.30 – 16.00 WIB)</div>
                        <div><i class="fa-solid fa-phone" style="color: var(--primary-blue); margin-right: 8px;"></i> <strong>Telepon:</strong> (0356) 321522</div>
                        <div><i class="fa-solid fa-envelope" style="color: var(--primary-blue); margin-right: 8px;"></i> <strong>Email:</strong> diskominfo@tubankab.go.id</div>
                    </div>
                </div>

                <a href="https://maps.google.com/?q=Dinas+Komunikasi+dan+Informatika+Kabupaten+Tuban" target="_blank" class="btn-white" style="background: var(--primary-blue); color: white; justify-content: center; width: 100%;">
                    <i class="fa-solid fa-diamond-turn-right"></i> Petunjuk Rute Google Maps
                </a>
            </div>

            <!-- Google Maps Embed Diskominfo Tuban -->
            <div class="map-frame-box">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2783857500585!2d112.06014457499708!3d-6.893196993106037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e779a528e57929d%3A0x6bce98799bb52f75!2sDinas%20Komunikasi%20dan%20Informatika%20Kabupaten%20Tuban!5e0!3m2!1sid!2sid!4v1710000000000!5m2!1sid!2sid" 
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height: 380px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- 11. HUBUNGI KAMI & SOSIAL MEDIA -->
    <footer id="hubungi-kami">
        <div class="footer-grid">
            <div>
                <h5 style="font-size: 1.2rem; color: white;">Desa Digital Kabupaten Tuban</h5>
                <p style="line-height: 1.6; margin-bottom: 16px;">
                    Portal pemerintahan terpadu yang memadukan layanan administrasi kependudukan, pengawasan digital, dan penyebarluasan potensi desa demi kemakmuran bersama masyarakat Kabupaten Tuban.
                </p>

                <!-- Ikon Sosial Media Lengkap -->
                <div class="social-media-pills">
                    <a href="https://www.instagram.com/diskominfosp_tuban" target="_blank" class="btn-sosmed" title="Instagram Resmi">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.tiktok.com/@diskominfotuban" target="_blank" class="btn-sosmed" title="TikTok Resmi">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>
                    <a href="https://www.youtube.com/@diskominfotuban865" target="_blank" class="btn-sosmed" title="YouTube Resmi">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                    <a href="https://twitter.com/kominfotuban" target="_blank" class="btn-sosmed" title="X (Twitter)">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Desa%20Digital%20Tuban..." target="_blank" class="btn-sosmed" title="WhatsApp Siaga">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

            <div class="footer-col">
                <h5>Navigasi Halaman</h5>
                <ul>
                    <li><a href="#hero-tuban">Beranda Utama</a></li>
                    <li><a href="#profil-wilayah">Profil Kabupaten</a></li>
                    <li><a href="#layanan-unggulan">Direktori Layanan</a></li>
                    <li><a href="#statistik-wilayah">Statistik Wilayah</a></li>
                    <li><a href="<?php echo e(url('/data-spasial')); ?>">Peta Data Spasial</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Layanan Publik</h5>
                <ul>
                    <li><a href="javascript:void(0)" onclick="openLayananModal()">E-Surat Mandiri</a></li>
                    <li><a href="javascript:void(0)" onclick="openBansosModal()">Cek Penerima Bansos</a></li>
                    <li><a href="javascript:void(0)" onclick="openPbbModal()">Pelunasan e-PBB</a></li>
                    <li><a href="https://www.lapor.go.id" target="_blank">Aduan SP4N LAPOR!</a></li>
                    <li><a href="<?php echo e(url('/desa')); ?>">Katalog Profil Desa</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h5>Kontak Kedinasan</h5>
                <p><i class="fa-solid fa-phone" style="margin-right: 8px;"></i> (0356) 321522</p>
                <p style="margin-top: 8px;"><i class="fa-solid fa-envelope" style="margin-right: 8px;"></i> diskominfo@tubankab.go.id</p>
                <p style="margin-top: 8px;"><i class="fa-solid fa-building" style="margin-right: 8px;"></i> Gedung Pemkab Tuban Lt. 2</p>
                <p style="margin-top: 8px;"><i class="fa-solid fa-location-dot" style="margin-right: 8px;"></i> Jl. Kartini No. 2, Tuban 62311</p>
            </div>
        </div>

        <div style="border-top: 1px solid rgba(255, 255, 255, 0.08); padding-top: 22px; text-align: center; font-size: 0.82rem;">
            <p>&copy; 2026 Pemerintah Kabupaten Tuban • Dinas Komunikasi, Informatika, Statistik dan Persandian. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- MODAL 1: LAYANAN PERSURATAN -->
    <div id="layananModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: white; border-radius: 18px; max-width: 580px; width: 100%; padding: 26px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35); position: relative; max-height: 90vh; overflow-y: auto;">
            <button onclick="closeLayananModal()" style="position: absolute; top: 18px; right: 18px; background: #f1f5f9; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: #64748b;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div style="text-align: center; margin-bottom: 20px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">Layanan Surat Desa Mandiri</h3>
                <p style="font-size: 0.84rem; color: #64748b; margin-top: 4px;">Pilih format permohonan surat kependudukan di bawah ini:</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 20px;">
                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.92rem; font-weight: 700; color: #0f172a;">Surat Keterangan Usaha (SKU)</h4>
                        <p style="font-size: 0.76rem; color: #64748b;">Syarat: Fotokopi KTP, KK & Foto Tempat Usaha</p>
                    </div>
                    <button onclick="pilihSurat('Surat Keterangan Usaha (SKU)')" style="background: var(--primary-blue); color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 0.78rem; cursor: pointer;">Pilih</button>
                </div>

                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.92rem; font-weight: 700; color: #0f172a;">Surat Keterangan Domisili</h4>
                        <p style="font-size: 0.76rem; color: #64748b;">Syarat: Pengantar RT/RW Setempat & Fotokopi KTP</p>
                    </div>
                    <button onclick="pilihSurat('Surat Keterangan Domisili')" style="background: var(--var-teal); color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 0.78rem; cursor: pointer;">Pilih</button>
                </div>

                <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 12px; padding: 14px; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h4 style="font-size: 0.92rem; font-weight: 700; color: #0f172a;">Pengantar SKCK Desa</h4>
                        <p style="font-size: 0.76rem; color: #64748b;">Syarat: Fotokopi KK, KTP & Pas Foto 4x6</p>
                    </div>
                    <button onclick="pilihSurat('Pengantar SKCK Desa')" style="background: var(--var-amber); color: white; border: none; padding: 8px 14px; border-radius: 8px; font-weight: 700; font-size: 0.78rem; cursor: pointer;">Pilih</button>
                </div>
            </div>

            <div id="feedbackPilih" style="display: none; padding: 10px; background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; font-size: 0.8rem; color: #1e40af; text-align: center;">
                <span id="txtFeedback"></span>
            </div>
        </div>
    </div>

    <!-- MODAL 2: CEK BANSOS -->
    <div id="bansosModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: white; border-radius: 18px; max-width: 500px; width: 100%; padding: 26px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35); position: relative;">
            <button onclick="closeBansosModal()" style="position: absolute; top: 18px; right: 18px; background: #f1f5f9; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: #64748b;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div style="text-align: center; margin-bottom: 18px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">Pengecekan Bantuan Sosial</h3>
                <p style="font-size: 0.82rem; color: #64748b; margin-top: 4px;">Periksa status kepesertaan PKH, BPNT, atau BLT Dana Desa</p>
            </div>

            <form onsubmit="event.preventDefault(); cekNikBansos();" style="display: flex; flex-direction: column; gap: 14px;">
                <div>
                    <label style="display: block; font-size: 0.78rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nomor Induk Kependudukan (16 Digit NIK)</label>
                    <input type="text" id="inputNikBansos" placeholder="3523xxxxxxxxxxxx" maxlength="16" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 0.88rem;">
                </div>
                <button type="submit" style="background: var(--var-emerald); color: white; border: none; padding: 10px; border-radius: 8px; font-weight: 700; font-size: 0.84rem; cursor: pointer;">
                    Periksa Status NIK
                </button>
            </form>

            <div id="hasilBansos" style="display: none; margin-top: 14px; padding: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; font-size: 0.82rem; color: #166534;">
                <strong>Data Terverifikasi:</strong> NIK terdaftar sebagai penerima manfaat bantuan aktif di balai desa Anda.
            </div>
        </div>
    </div>

    <!-- MODAL 3: CCTV WILAYAH -->
    <div id="cctvModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: white; border-radius: 18px; max-width: 560px; width: 100%; padding: 24px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35); position: relative;">
            <button onclick="closeCctvModal()" style="position: absolute; top: 18px; right: 18px; background: #f1f5f9; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: #64748b;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div style="text-align: center; margin-bottom: 16px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">Pantauan CCTV Wilayah</h3>
                <p style="font-size: 0.82rem; color: #64748b; margin-top: 4px;">Kamera pemantauan arus lalu lintas dan titik kumpul publik</p>
            </div>

            <div style="background: #0f172a; border-radius: 12px; height: 220px; display: flex; flex-direction: column; align-items: center; justify-content: center; color: white; margin-bottom: 14px;">
                <i class="fa-solid fa-video" style="font-size: 2.2rem; color: var(--tech-cyan-glow); margin-bottom: 8px;"></i>
                <p style="font-size: 0.85rem; font-weight: 700;">Simpang Alun-Alun Tuban - Titik 01</p>
                <span style="font-size: 0.74rem; color: #94a3b8;">Status: Sinyal Aktif Normal</span>
            </div>
        </div>
    </div>

    <!-- MODAL 4: E-PBB DESA -->
    <div id="pbbModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 16px;">
        <div style="background: white; border-radius: 18px; max-width: 500px; width: 100%; padding: 26px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.35); position: relative;">
            <button onclick="closePbbModal()" style="position: absolute; top: 18px; right: 18px; background: #f1f5f9; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; color: #64748b;">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div style="text-align: center; margin-bottom: 18px;">
                <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a;">Pelayanan Pajak e-PBB Desa</h3>
                <p style="font-size: 0.82rem; color: #64748b; margin-top: 4px;">Pengecekan tagihan PBB-P2 terhubung Bapenda Tuban</p>
            </div>

            <form onsubmit="event.preventDefault(); cekPbbTagihan();" style="display: flex; flex-direction: column; gap: 14px;">
                <div>
                    <label style="display: block; font-size: 0.78rem; font-weight: 700; color: #334155; margin-bottom: 6px;">Nomor Objek Pajak (NOP 18 Digit)</label>
                    <input type="text" id="inputNop" placeholder="35.23.xxx.xxx.xxx-xxxx.x" maxlength="22" required style="width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; font-size: 0.88rem;">
                </div>
                <button type="submit" style="background: var(--var-violet); color: white; border: none; padding: 10px; border-radius: 8px; font-weight: 700; font-size: 0.84rem; cursor: pointer;">
                    Cek Tagihan
                </button>
            </form>

            <div id="hasilPbb" style="display: none; margin-top: 14px; padding: 12px; background: #faf5ff; border: 1px solid #e9d5ff; border-radius: 8px; font-size: 0.82rem; color: #581c87;">
                <strong>Tagihan Terverifikasi:</strong> Tahun Pajak 2026 berstatus <strong>Lunas / Bebas Denda</strong>.
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT LOGIC -->
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
            document.getElementById('txtFeedback').innerHTML = `Format <strong>${nama}</strong> dipilih. Silakan siapkan berkas ke balai desa.`;
            fb.style.display = 'block';
        }

        function openBansosModal() {
            document.getElementById('bansosModal').style.display = 'flex';
            document.getElementById('hasilBansos').style.display = 'none';
        }
        function closeBansosModal() {
            document.getElementById('bansosModal').style.display = 'none';
        }
        function cekNikBansos() {
            document.getElementById('hasilBansos').style.display = 'block';
        }

        function openCctvModal() {
            document.getElementById('cctvModal').style.display = 'flex';
        }
        function closeCctvModal() {
            document.getElementById('cctvModal').style.display = 'none';
        }

        function openPbbModal() {
            document.getElementById('pbbModal').style.display = 'flex';
            document.getElementById('hasilPbb').style.display = 'none';
        }
        function closePbbModal() {
            document.getElementById('pbbModal').style.display = 'none';
        }
        function cekPbbTagihan() {
            document.getElementById('hasilPbb').style.display = 'block';
        }
    </script>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/landing.blade.php ENDPATH**/ ?>