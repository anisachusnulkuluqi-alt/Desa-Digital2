<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Digital - Pemerintah Kabupaten Tuban</title>
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --header-dark: #334155;
            --header-dark-trans: rgba(51, 65, 85, 0.96);
            
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --accent-cyan: #38bdf8;
            
            --text-dark: #0f172a;
            --text-gray: #475569;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
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
        .site-header {
            background: var(--header-dark-trans);
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

        .brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 38px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
            display: block;
        }

        .brand-text-logo {
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
        }
        .brand-text-logo span {
            color: var(--accent-cyan);
            margin-left: 2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 22px;
            list-style: none;
        }

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
        .nav-menu a.active { color: var(--accent-cyan); }
        .nav-menu a.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--accent-cyan);
            border-radius: 2px;
        }

        .search-pill-nav {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 5px 14px;
            width: 190px;
            transition: all 0.25s ease;
        }
        .search-pill-nav:focus-within {
            width: 230px;
            background: rgba(255, 255, 255, 0.2);
            border-color: var(--accent-cyan);
        }
        .search-pill-nav input {
            background: transparent;
            border: none;
            outline: none;
            color: #ffffff;
            font-size: 0.8rem;
            width: 100%;
        }
        .search-pill-nav input::placeholder { color: rgba(255, 255, 255, 0.6); }
        .search-pill-nav button {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            font-size: 0.8rem;
        }

        /* 2. HERO BANNER */
        .hero-banner-clean {
            position: relative;
            min-height: 590px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 90px 24px 80px 24px;
            background-size: cover;
            background-position: center 60%;
            background-repeat: no-repeat;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-banner-clean::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(15, 23, 42, 0.62) 0%, rgba(15, 23, 42, 0.94) 100%);
        }

        .hero-content-wrap {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-main-title {
            font-size: 4.5rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.08;
            margin-bottom: 16px;
            background: linear-gradient(180deg, #ffffff 40%, #7dd3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 8px 30px rgba(56, 189, 248, 0.35));
        }

        .hero-lead-text {
            font-size: 1.2rem;
            color: #e2e8f0;
            font-weight: 500;
            max-width: 680px;
            margin: 0 auto 24px auto;
            line-height: 1.6;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
        }

        .hero-info-pills {
            display: inline-flex;
            align-items: center;
            gap: 16px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(12px);
            padding: 8px 22px;
            border-radius: 40px;
            margin-bottom: 34px;
            font-size: 0.82rem;
            font-weight: 700;
            color: #cbd5e1;
        }
        .hero-info-pills span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .hero-info-pills span strong {
            color: #38bdf8;
        }
        .hero-info-pills .divider-dot {
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
        }

        .btn-jelajah-solo {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 44px;
            border-radius: 50px;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            font-size: 0.96rem;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 12px 32px rgba(2, 132, 199, 0.45);
            border: 1px solid rgba(255, 255, 255, 0.25);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .btn-jelajah-solo:hover {
            transform: translateY(-3px) scale(1.02);
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            box-shadow: 0 16px 38px rgba(56, 189, 248, 0.55);
            color: #ffffff;
        }

        /* 3. SEKSI INOVASI EKOSISTEM DESA */
        .section-profil-accordion {
            padding: 90px 7%;
            background: #ffffff;
            position: relative;
        }

        .section-header-clean {
            text-align: center;
            max-width: 760px;
            margin: 0 auto 46px auto;
        }
        .header-tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
            color: #0369a1;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 12px;
            border: 1.5px solid #bae6fd;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.08);
        }
        .section-header-clean h2 {
            font-size: 2.3rem;
            font-weight: 900;
            letter-spacing: -0.025em;
            color: var(--text-dark);
            margin-bottom: 10px;
        }
        .section-header-clean p {
            font-size: 0.94rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .profil-dual-layout {
            display: grid;
            grid-template-columns: 1.15fr 1fr;
            gap: 32px;
            max-width: 1240px;
            margin: 0 auto;
            align-items: stretch;
        }

        .accordion-stack-clean {
            display: flex;
            flex-direction: column;
            gap: 12px;
            justify-content: center;
        }

        .accordion-item-clean {
            border: 1.5px solid var(--border-soft);
            border-radius: 16px;
            background: #ffffff;
            overflow: hidden;
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.02);
        }
        .accordion-item-clean::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: transparent;
            transition: background 0.25s ease;
        }
        
        .accordion-item-clean.theme-blue.active {
            border-color: #38bdf8;
            background: #f0f9ff;
            box-shadow: 0 10px 25px -4px rgba(2, 132, 199, 0.15);
        }
        .accordion-item-clean.theme-blue.active::before { background: #0284c7; }

        .accordion-item-clean.theme-emerald.active {
            border-color: #6ee7b7;
            background: #f0fdf4;
            box-shadow: 0 10px 25px -4px rgba(16, 185, 129, 0.15);
        }
        .accordion-item-clean.theme-emerald.active::before { background: #10b981; }

        .accordion-item-clean.theme-amber.active {
            border-color: #fde68a;
            background: #fffbeb;
            box-shadow: 0 10px 25px -4px rgba(245, 158, 11, 0.15);
        }
        .accordion-item-clean.theme-amber.active::before { background: #f59e0b; }

        .accordion-item-clean.theme-violet.active {
            border-color: #c4b5fd;
            background: #f5f3ff;
            box-shadow: 0 10px 25px -4px rgba(139, 92, 246, 0.15);
        }
        .accordion-item-clean.theme-violet.active::before { background: #8b5cf6; }

        .accordion-header-btn {
            width: 100%;
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: transparent;
            border: none;
            cursor: pointer;
            text-align: left;
            user-select: none;
        }

        .accordion-title-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.94rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        
        .accordion-icon-box {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            transition: all 0.25s ease;
        }
        .theme-blue .accordion-icon-box { background: #e0f2fe; color: #0284c7; }
        .theme-emerald .accordion-icon-box { background: #d1fae5; color: #10b981; }
        .theme-amber .accordion-icon-box { background: #fef3c7; color: #f59e0b; }
        .theme-violet .accordion-icon-box { background: #ede9fe; color: #8b5cf6; }

        .accordion-header-btn i.fa-chevron-down {
            color: var(--text-muted);
            font-size: 0.8rem;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            transition: all 0.25s ease;
        }
        .accordion-item-clean.active i.fa-chevron-down {
            transform: rotate(180deg);
            background: var(--text-dark);
            border-color: var(--text-dark);
            color: #ffffff;
        }

        .accordion-content-text {
            display: none;
            padding: 0 24px 18px 70px;
            font-size: 0.88rem;
            color: var(--text-gray);
            line-height: 1.65;
        }
        .accordion-item-clean.active .accordion-content-text {
            display: block;
        }

        .video-player-frame {
            border-radius: 18px;
            overflow: hidden;
            border: 1.5px solid #cbd5e1;
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.14);
            display: flex;
            flex-direction: column;
            background: #0f172a;
            position: relative;
        }
        .video-top-tag {
            background: #ffffff;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1.5px solid var(--border-soft);
        }
        .channel-info {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .channel-info i {
            color: #ef4444;
            font-size: 1.15rem;
        }
        .status-broadcast {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.72rem;
            font-weight: 800;
            color: #15803d;
            background: #dcfce7;
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid #86efac;
        }
        .status-broadcast .live-pulse {
            width: 7px;
            height: 7px;
            background: #16a34a;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7);
            animation: pulse 1.6s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(22, 163, 74, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(22, 163, 74, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(22, 163, 74, 0); }
        }

        .video-embed-box {
            position: relative;
            flex-grow: 1;
            min-height: 350px;
            background: #090e17;
        }
        .video-embed-box iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        /* 4. SEKSI STATISTIK: KAPSUL BULAT TERANG */
        .section-stats-circle {
            padding: 45px 6%;
            background: #f8fafc;
            position: relative;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .stats-grid-circles {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            max-width: 1140px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .stat-circle-pod {
            background: #ffffff;
            border: 1.5px solid var(--pod-border, #e2e8f0);
            border-radius: 9999px;
            padding: 12px 14px;
            min-height: 112px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
            transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
            position: relative;
        }

        .stat-circle-pod:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 10px 24px -4px var(--pod-glow, rgba(2, 132, 199, 0.18));
            border-color: var(--pod-accent, #0284c7);
        }

        .stat-circle-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--pod-bg, #e0f2fe);
            color: var(--pod-accent, #0284c7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }
        .stat-circle-pod:hover .stat-circle-icon {
            background: var(--pod-accent, #0284c7);
            color: #ffffff;
            transform: scale(1.08);
        }

        .stat-circle-number {
            font-size: 1.65rem;
            font-weight: 900;
            line-height: 1;
            letter-spacing: -0.03em;
            color: #0f172a;
            margin-bottom: 3px;
            font-variant-numeric: tabular-nums;
        }

        .stat-circle-label {
            font-size: 0.68rem;
            font-weight: 800;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        /* 5. SEKSI GERBANG LAYANAN: ELEGAN, MINIMALIS & TANPA TEKS DESKRIPSI */
        .section-services-clean {
            padding: 85px 7%;
            background: radial-gradient(circle at 50% 0%, #e0f2fe 0%, #f1f5f9 55%, #e2e8f0 100%);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .section-services-clean::before {
            content: '';
            position: absolute;
            top: -100px;
            left: 20%;
            width: 480px;
            height: 320px;
            background: radial-gradient(circle, rgba(56, 189, 248, 0.2), transparent 70%);
            pointer-events: none;
            filter: blur(40px);
        }

        .section-services-clean::after {
            content: '';
            position: absolute;
            bottom: -60px;
            right: 20%;
            width: 480px;
            height: 320px;
            background: radial-gradient(circle, rgba(168, 85, 247, 0.14), transparent 70%);
            pointer-events: none;
            filter: blur(45px);
        }

        .services-header-box {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin: 0 auto 46px auto;
        }

        .services-tag-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            color: var(--primary-dark);
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            border: 1.5px solid #bae6fd;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.1);
            margin-bottom: 12px;
        }

        .services-header-box h2 {
            font-size: 2.35rem;
            font-weight: 900;
            letter-spacing: -0.025em;
            color: var(--text-dark);
            margin-bottom: 0;
        }

        .services-cards-cluster {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            max-width: 1240px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Kartu Layanan Minimalis Tanpa Paragraf */
        .service-card-clean {
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1.5px solid rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            padding: 30px 18px 24px 18px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            box-shadow: 0 10px 24px -6px rgba(15, 23, 42, 0.05);
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            min-height: 190px;
        }

        .service-card-clean::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3.5px;
            background: var(--service-accent, var(--primary));
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .service-card-clean:hover {
            transform: translateY(-8px) scale(1.03);
            background: #ffffff;
            border-color: var(--service-border, #bae6fd);
            box-shadow: 0 18px 36px -6px var(--service-glow, rgba(2, 132, 199, 0.24));
        }

        .service-card-clean:hover::before {
            opacity: 1;
        }

        /* Ikon Dinamis */
        .service-icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.55rem;
            color: #ffffff;
            margin-bottom: 16px;
            box-shadow: 0 10px 22px var(--icon-shadow, rgba(0, 0, 0, 0.16));
            transition: transform 0.25s ease;
        }

        .service-card-clean:hover .service-icon-circle {
            transform: scale(1.1) rotate(5deg);
        }

        .service-card-clean h4 {
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
            letter-spacing: -0.01em;
        }

        /* Indikator Panah Minimalis */
        .service-action-arrow {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--service-pill, #f1f5f9);
            color: var(--service-text, var(--primary));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            transition: all 0.2s ease;
        }

        .service-card-clean:hover .service-action-arrow {
            background: var(--service-accent, var(--primary));
            color: #ffffff;
            transform: translateX(3px);
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
            padding: 38px 30px;
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
            color: var(--primary);
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
        .detail-texts a:hover { color: var(--primary); }

        .btn-maps-route {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 13px;
            border-radius: 10px;
            background: var(--primary);
            color: #ffffff;
            font-size: 0.88rem;
            font-weight: 800;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-maps-route:hover {
            background: var(--primary-dark);
            color: #ffffff;
        }

        .map-viewport-frame {
            border: 1.5px solid var(--border-soft);
            border-left: 0;
            overflow: hidden;
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
        @media (max-width: 1180px) {
            .services-cards-cluster { grid-template-columns: repeat(3, 1fr); }
            .stats-grid-circles { grid-template-columns: repeat(4, 1fr); gap: 10px; }
            .stat-circle-number { font-size: 1.45rem; }
        }

        @media (max-width: 900px) {
            .nav-menu { display: none; }
            .search-pill-nav { display: none; }
            .profil-dual-layout { grid-template-columns: 1fr; }
            .stats-grid-circles { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .services-cards-cluster { grid-template-columns: repeat(2, 1fr); }
            .hero-main-title { font-size: 2.8rem; }
            .accordion-content-text { padding-left: 20px; }
            .location-grid-layout { grid-template-columns: 1fr; }
            .map-viewport-frame { border-left: 1.5px solid var(--border-soft); }
        }

        @media (max-width: 580px) {
            .services-cards-cluster { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <!-- 1. TOP NAVBAR -->
    <header class="site-header">
        <a href="<?= url('/'); ?>" class="brand-link">
            <img src="<?= asset('images/desa-digital.png'); ?>" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-img"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png'">
            <div class="brand-text-logo">
                Desa<span>Digital</span>
            </div>
        </a>

        <ul class="nav-menu">
            <li><a href="<?= url('/'); ?>" class="active">BERANDA</a></li>
            <li><a href="<?= url('/website'); ?>">WEBSITE DESA</a></li>
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

    <!-- 2. HERO BANNER -->
    <section id="hero-banner" class="hero-banner-clean" style="background-image: url('<?= asset('images/alun-alun-tuban.jpg'); ?>');">
        <div class="hero-content-wrap">
            
            <h1 class="hero-main-title">Desa Digital</h1>
            <p class="hero-lead-text">Digitalisasi Pemerintahan Desa di Kabupaten Tuban Menuju Tata Kelola yang Efisien, Terpadu & Transparan</p>
            
            <div class="hero-info-pills">
                <span><i class="fa-solid fa-layer-group" style="color: #38bdf8;"></i> <strong>328</strong> Desa & Kelurahan</span>
                <div class="divider-dot"></div>
                <span><i class="fa-solid fa-sitemap" style="color: #38bdf8;"></i> <strong>20</strong> Distrik Kecamatan</span>
                <div class="divider-dot"></div>
                <span><i class="fa-solid fa-circle-check" style="color: #10b981;"></i> Layanan Siaga Terintegrasi</span>
            </div>

            <div>
                <a href="#layanan-digital" class="btn-jelajah-solo">
                    <span>Mulai Jelajah</span>
                    <i class="fa-solid fa-arrow-down"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- 3. ACCORDION & PROFIL INOVASI -->
    <section id="tentang-kami" class="section-profil-accordion">
        <div class="section-header-clean">
            <div class="header-tag-pill">
                <i class="fa-solid fa-network-wired"></i> PILAR TRANSFORMASI DIGITAL
            </div>
            <h2>Inovasi Ekosistem Desa</h2>
            <p>Akselerasi tata kelola pemerintahan berbasis teknologi informasi untuk mewujudkan pelayanan desa yang responsif, transparan, dan inklusif se-Kabupaten Tuban.</p>
        </div>

        <div class="profil-dual-layout">
            
            <div class="accordion-stack-clean">
                
                <div class="accordion-item-clean theme-blue active" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <div class="accordion-icon-box"><i class="fa-solid fa-globe"></i></div>
                            Website Desa & Media Sosial Resmi
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Kanal informasi resmi milik pemerintah desa di Kabupaten Tuban yang memuat profil wilayah, transparansi APBDes, potensi desa, dan publikasi kegiatan aparatur secara real-time.
                    </div>
                </div>

                <div class="accordion-item-clean theme-emerald" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <div class="accordion-icon-box"><i class="fa-solid fa-file-signature"></i></div>
                            Layanan Digital & Administrasi Persuratan
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Integrasi sistem pelayanan kependudukan mandiri seperti SKU, Surat Domisili, dan Pengantar SKCK dengan tanda tangan barcode resmi untuk mempercepat urusan warga.
                    </div>
                </div>

                <div class="accordion-item-clean theme-amber" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <div class="accordion-icon-box"><i class="fa-solid fa-wifi"></i></div>
                            Akses Internet & WiFi Publik Desa
                        </span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="accordion-content-text">
                        Penyediaan akses internet pita lebar dan jaringan WiFi publik gratis di titik-titik kumpul masyarakat serta balai desa untuk pemerataan literasi digital.
                    </div>
                </div>

                <div class="accordion-item-clean theme-violet" onclick="switchCleanAccordion(this)">
                    <button type="button" class="accordion-header-btn">
                        <span class="accordion-title-wrap">
                            <div class="accordion-icon-box"><i class="fa-solid fa-desktop"></i></div>
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
                    <div class="channel-info">
                        <i class="fa-brands fa-youtube"></i>
                        <span>Diskominfo-SP Tuban</span>
                    </div>
                    <div class="status-broadcast">
                        <div class="live-pulse"></div>
                        <span>Siaran Resmi</span>
                    </div>
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

    <!-- 4. SEKSI STATISTIK: KAPSUL BULAT TERANG -->
    <section id="statistik-wilayah" class="section-stats-circle">
        <div class="stats-grid-circles">
            
            <!-- 1. WiFi Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #0284c7; --pod-bg: #e0f2fe; --pod-border: #bae6fd; --pod-glow: rgba(2, 132, 199, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-wifi"></i></div>
                <div class="stat-circle-number">448</div>
                <div class="stat-circle-label">Titik WiFi</div>
            </div>

            <!-- 2. Website Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #2563eb; --pod-bg: #dbeafe; --pod-border: #bfdbfe; --pod-glow: rgba(37, 99, 235, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-globe"></i></div>
                <div class="stat-circle-number">328</div>
                <div class="stat-circle-label">Website Desa</div>
            </div>

            <!-- 3. Wisata Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #059669; --pod-bg: #d1fae5; --pod-border: #a7f3d0; --pod-glow: rgba(5, 150, 105, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-mountain-sun"></i></div>
                <div class="stat-circle-number">35</div>
                <div class="stat-circle-label">Wisata Desa</div>
            </div>

            <!-- 4. Balai Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #4f46e5; --pod-bg: #e0e7ff; --pod-border: #c7d2fe; --pod-glow: rgba(79, 70, 229, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-building-columns"></i></div>
                <div class="stat-circle-number">328</div>
                <div class="stat-circle-label">Balai Desa</div>
            </div>

            <!-- 5. Pasar Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #d97706; --pod-bg: #fef3c7; --pod-border: #fde68a; --pod-glow: rgba(217, 119, 6, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-store"></i></div>
                <div class="stat-circle-number">38</div>
                <div class="stat-circle-label">Pasar Rakyat</div>
            </div>

            <!-- 6. Unit BUMDes -->
            <div class="stat-circle-pod" style="--pod-accent: #7c3aed; --pod-bg: #ede9fe; --pod-border: #ddd6fe; --pod-glow: rgba(124, 58, 237, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-briefcase"></i></div>
                <div class="stat-circle-number">309</div>
                <div class="stat-circle-label">Unit BUMDes</div>
            </div>

            <!-- 7. Dokumen KKDMP -->
            <div class="stat-circle-pod" style="--pod-accent: #e11d48; --pod-bg: #ffe4e6; --pod-border: #fecdd3; --pod-glow: rgba(225, 29, 72, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-chart-pie"></i></div>
                <div class="stat-circle-number">83</div>
                <div class="stat-circle-label">Dokumen KKDMP</div>
            </div>

            <!-- 8. Distrik Kecamatan -->
            <div class="stat-circle-pod" style="--pod-accent: #0d9488; --pod-bg: #ccfbf1; --pod-border: #99f6e4; --pod-glow: rgba(13, 148, 136, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-sitemap"></i></div>
                <div class="stat-circle-number">20</div>
                <div class="stat-circle-label">Kecamatan</div>
            </div>

        </div>
    </section>

    <!-- 5. SEKSI GERBANG LAYANAN: ELEGAN, MINIMALIS & TANPA TEKS DESKRIPSI -->
    <section id="layanan-digital" class="section-services-clean">
        
        <div class="services-header-box">
            <div class="services-tag-pill">
                <i class="fa-solid fa-layer-group"></i> PUSAT LAYANAN TERPADU
            </div>
            <h2>Gerbang Layanan Publik Digital</h2>
        </div>

        <div class="services-cards-cluster">
            
            <!-- 1. Website Desa -->
            <a href="<?= url('/website'); ?>" class="service-card-clean" 
               style="--service-accent: #2563eb; --service-border: #bfdbfe; --service-glow: rgba(37, 99, 235, 0.22); --service-pill: #dbeafe; --service-text: #1d4ed8;">
                <div class="service-icon-circle" 
                     style="background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%); --icon-shadow: rgba(37, 99, 235, 0.35);">
                    <i class="fa-solid fa-globe"></i>
                </div>
                <h4>Website Desa</h4>
                <div class="service-action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 2. Data Spasial -->
            <a href="<?= url('/data-spasial'); ?>" class="service-card-clean"
               style="--service-accent: #059669; --service-border: #a7f3d0; --service-glow: rgba(5, 150, 105, 0.22); --service-pill: #d1fae5; --service-text: #047857;">
                <div class="service-icon-circle" 
                     style="background: linear-gradient(135deg, #047857 0%, #10b981 100%); --icon-shadow: rgba(16, 185, 129, 0.35);">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h4>Data Spasial</h4>
                <div class="service-action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 3. Surat Desa -->
            <a href="<?= url('/surat'); ?>" class="service-card-clean"
               style="--service-accent: #d97706; --service-border: #fde68a; --service-glow: rgba(217, 119, 6, 0.22); --service-pill: #fef3c7; --service-text: #b45309;">
                <div class="service-icon-circle" 
                     style="background: linear-gradient(135deg, #b45309 0%, #f59e0b 100%); --icon-shadow: rgba(245, 158, 11, 0.35);">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>
                <h4>Surat Desa</h4>
                <div class="service-action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 4. CCTV -->
            <a href="<?= url('/cctv'); ?>" class="service-card-clean"
               style="--service-accent: #e11d48; --service-border: #fecdd3; --service-glow: rgba(225, 29, 72, 0.22); --service-pill: #ffe4e6; --service-text: #be123c;">
                <div class="service-icon-circle" 
                     style="background: linear-gradient(135deg, #be123c 0%, #f43f5e 100%); --icon-shadow: rgba(244, 63, 94, 0.35);">
                    <i class="fa-solid fa-video"></i>
                </div>
                <h4>CCTV</h4>
                <div class="service-action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>

            <!-- 5. e-PBB -->
            <a href="<?= url('/epbb'); ?>" class="service-card-clean"
               style="--service-accent: #7c3aed; --service-border: #ddd6fe; --service-glow: rgba(124, 58, 237, 0.22); --service-pill: #ede9fe; --service-text: #6d28d9;">
                <div class="service-icon-circle" 
                     style="background: linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%); --icon-shadow: rgba(139, 92, 246, 0.35);">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
                <h4>e-PBB</h4>
                <div class="service-action-arrow">
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
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
                                <p><a href="https://diskominfo.tubankab.go.id" target="_blank" rel="noopener noreferrer">diskominfo.tubankab.go.id</a></p>
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

                <a href="https://maps.google.com/?q=Dinas+Komunikasi+dan+Informatika+Kabupaten+Tuban" target="_blank" rel="noopener noreferrer" class="btn-maps-route">
                    <i class="fa-solid fa-diamond-turn-right"></i>
                    <span>Buka Rute di Google Maps</span>
                </a>
            </div>

            <div class="map-viewport-frame">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!4v1790305660366!6m8!1m7!1szab-FoOpFkmJVJ79X0G0Pw!2m2!1d-6.901873934235668!2d112.0440727763729!3f119.96725389059543!4f-2.7866853560054636!5f0.7820865974627469"
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

    <!-- SCRIPT AKORDEON -->
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