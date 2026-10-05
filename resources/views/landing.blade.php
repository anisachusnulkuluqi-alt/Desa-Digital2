<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= csrf_token(); ?>">
    <title>Desa Digital - Pemerintah Kabupaten Tuban</title>
    <link rel="icon" type="image/png" href="<?= asset('images/desa-digital.png'); ?>">
    
    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('css/global-search.css'); ?>">

    <style>
        :root {
            --bg-body: #eaf2fa;
            --bg-card: #ffffff;
            --header-dark: #283548;
            --header-dark-trans: rgba(40, 53, 72, 0.98);
            --bg-section: #eaf2fa;
            --bg-blue-gradient: radial-gradient(ellipse at 78% 92%, rgba(59, 130, 246, 0.12), transparent 38%), radial-gradient(ellipse at 18% 5%, rgba(56, 189, 248, 0.2), transparent 40%), radial-gradient(ellipse at 48% 0%, #d8efff 0%, #e9f2fb 52%, #dce8f5 100%);
            
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --accent-cyan: #38bdf8;
            
            --text-dark: #0f172a;
            --text-gray: #475569;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
        }

        html { scroll-behavior: smooth; overflow-x: clip; }
        section[id], footer[id] { scroll-margin-top: 80px; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        
        body { 
            background: linear-gradient(135deg, #e3eef9 0%, #f4f8fc 48%, #dce9f6 100%);
            color: var(--text-dark); 
            overflow-x: hidden; 
        }

        /* 1. TOP NAVBAR */
        .site-header {
            background: linear-gradient(112deg, #102a43 0%, #155e75 52%, #0f766e 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 20px clamp(20px, 8.8vw, 128px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(14px, 2vw, 28px);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-logo-img {
            height: 52px;
            width: auto;
            max-width: 160px;
            object-fit: contain;
            display: block;
        }

        .brand-text-logo {
            font-size: 1.45rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            font-family: 'Manrope', sans-serif;
        }
        .brand-text-logo span {
            color: var(--accent-cyan);
            margin-left: 2px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: clamp(8px, 0.75vw, 12px);
            list-style: none;
            flex-wrap: wrap;
            justify-content: flex-end;
            margin-left: auto;
        }

        .nav-menu a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            font-family: 'Manrope', sans-serif;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0;
            position: relative;
            padding: 9px 8px;
            border-radius: 6px;
            transition: color 0.2s ease, background-color 0.2s ease;
        }
        .nav-menu a:hover { color: #ffffff; background: rgba(255, 255, 255, 0.1); }
        .nav-menu a.active { color: #ffffff; background: rgba(255, 255, 255, 0.16); }

        .menu-toggle {
            display: none;
            place-items: center;
            width: 42px;
            height: 42px;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .search-pill-nav {
            display: flex;
            align-items: center;
            flex: 0 0 150px;
            min-width: 0;
            padding: 4px 10px 4px 14px;
            font-family: 'Manrope', sans-serif;
            border: 1px solid rgba(255, 255, 255, 0.42);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.12);
            transition: border-color 0.2s ease, background-color 0.2s ease;
        }

        .search-pill-nav:focus-within {
            background: rgba(255, 255, 255, 0.18);
            border-color: rgba(255, 255, 255, 0.8);
        }

        .search-pill-nav input {
            width: 100%;
            min-width: 0;
            border: 0;
            outline: 0;
            background: transparent;
            color: #ffffff;
            font-size: 0.85rem;
            font-family: 'Manrope', sans-serif;
            font-weight: 600;
        }

        .search-pill-nav input::placeholder { color: rgba(255, 255, 255, 0.6); }

        .search-pill-nav button {
            display: grid;
            place-items: center;
            width: 28px;
            height: 28px;
            flex: 0 0 28px;
            border: 0;
            background: transparent;
            color: #ffffff;
            font-size: 1rem;
            font-family: 'Manrope', sans-serif;
            cursor: pointer;
        }

        /* 2. HERO BANNER */
        .hero-banner-clean {
            position: relative;
            min-height: clamp(520px, calc(100vh - 72px), 820px);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 64px 24px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
            overflow: hidden;
        }

        .hero-banner-clean::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15, 23, 42, 0.12) 0%, rgba(15, 23, 42, 0.28) 100%);
        }

        .hero-banner-clean::after {
            content: '';
            position: absolute;
            inset: 0;
            z-index: 1;
            pointer-events: none;
            opacity: 0;
            background-image:
                radial-gradient(circle at 15% 38%, rgba(255, 255, 255, 0.95) 0 1px, rgba(125, 211, 252, 0.7) 2px, transparent 4px),
                radial-gradient(circle at 30% 68%, rgba(255, 255, 255, 0.9) 0 1px, rgba(56, 189, 248, 0.62) 2px, transparent 4px),
                radial-gradient(circle at 58% 34%, rgba(255, 255, 255, 0.92) 0 1px, rgba(103, 232, 249, 0.68) 2px, transparent 4px),
                radial-gradient(circle at 76% 61%, rgba(255, 255, 255, 0.9) 0 1px, rgba(125, 211, 252, 0.62) 2px, transparent 4px),
                radial-gradient(circle at 91% 30%, rgba(255, 255, 255, 0.88) 0 1px, rgba(56, 189, 248, 0.6) 2px, transparent 4px),
                linear-gradient(112deg, transparent 42%, rgba(125, 211, 252, 0.04) 46%, rgba(255, 255, 255, 0.2) 50%, rgba(34, 211, 238, 0.1) 53%, transparent 59%);
            background-size: 100% 100%, 100% 100%, 100% 100%, 100% 100%, 100% 100%, 220% 100%;
            background-position: 0 0, 0 0, 0 0, 0 0, 0 0, -140% 0;
            background-repeat: no-repeat;
            mix-blend-mode: screen;
            animation: hero-glimmer 10s ease-in-out infinite;
        }

        @keyframes hero-glimmer {
            0%, 18% { opacity: 0; background-position: 0 0, 0 0, 0 0, 0 0, 0 0, -140% 0; }
            34% { opacity: 0.62; background-position: 0 0, 0 0, 0 0, 0 0, 0 0, -35% 0; }
            52% { opacity: 0.38; background-position: 0 0, 0 0, 0 0, 0 0, 0 0, 45% 0; }
            70%, 100% { opacity: 0; background-position: 0 0, 0 0, 0 0, 0 0, 0 0, 140% 0; }
        }

        .hero-content-wrap {
            position: relative;
            z-index: 2;
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-main-title {
            font-size: 3.2rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            line-height: 1.2;
            padding: 0.02em 0.06em 0.1em;
            margin-bottom: 8px;
            background: linear-gradient(180deg, #ffffff 40%, #7dd3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 8px 30px rgba(56, 189, 248, 0.35));
            animation: hero-enter 0.75s cubic-bezier(0.2, 0.7, 0.2, 1) both;
        }

        .hero-lead-text {
            font-size: 1.08rem;
            color: #e2e8f0;
            font-weight: 500;
            max-width: 540px;
            margin: 0 auto 24px;
            line-height: 1.6;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
            animation: hero-enter 0.7s 0.12s cubic-bezier(0.2, 0.7, 0.2, 1) both;
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
            animation: hero-enter 0.7s 0.32s cubic-bezier(0.2, 0.7, 0.2, 1) both;
        }
        .btn-jelajah-solo:hover {
            transform: translateY(-3px) scale(1.02);
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 100%);
            box-shadow: 0 16px 38px rgba(56, 189, 248, 0.55);
            color: #ffffff;
        }

        @keyframes hero-enter {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* 3. SEKSI INOVASI EKOSISTEM DESA */
        .section-profil-accordion {
            padding: clamp(64px, 7vw, 96px) clamp(20px, 5vw, 88px);
            background: linear-gradient(125deg, #f7fbff 0%, #edf5fc 48%, #f8fbff 100%);
            position: relative;
        }

        .section-header-clean {
            text-align: left;
            max-width: 1280px;
            margin: 0 auto 32px;
        }
        .section-purpose-label {
            display: inline-block;
            color: #0284c7;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 10px;
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
            max-width: 820px;
            font-size: 2.5rem;
            font-weight: 900;
            letter-spacing: -0.025em;
            line-height: 1.18;
            color: var(--text-dark);
            margin-bottom: 12px;
        }
        .section-header-clean p {
            max-width: 760px;
            font-size: 0.96rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .profil-dual-layout {
            display: grid;
            grid-template-columns: minmax(0, 1.02fr) minmax(0, 0.98fr);
            gap: clamp(24px, 3vw, 42px);
            max-width: 1280px;
            margin: 0 auto;
            align-items: stretch;
        }

        .accordion-stack-clean {
            display: flex;
            flex-direction: column;
            gap: 10px;
            justify-content: center;
        }

        .accordion-item-clean {
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            background: #ffffff;
            overflow: hidden;
            transition: all 0.28s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.02);
        }
        .accordion-item-clean:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.08);
        }
        .accordion-item-clean::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
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
            padding: 17px 18px;
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
            gap: 14px;
            font-size: 0.94rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        
        .accordion-icon-box {
            width: 42px;
            height: 42px;
            border-radius: 12px;
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
            max-height: 0;
            overflow: hidden;
            padding: 0 24px 0 74px;
            opacity: 0;
            transform: translateY(-8px);
            font-size: 0.88rem;
            color: var(--text-gray);
            line-height: 1.65;
            transition: max-height 0.45s ease, opacity 0.35s ease, transform 0.4s ease, padding 0.4s ease;
        }
        .accordion-item-clean.active .accordion-content-text {
            max-height: 180px;
            padding-bottom: 20px;
            opacity: 1;
            transform: translateY(0);
        }

        .video-player-frame {
            position: relative;
            width: 100%;
            aspect-ratio: 16 / 9;
            align-self: center;
            overflow: hidden;
            background: transparent;
        }

        .video-embed-box {
            position: absolute;
            inset: 0;
            background: transparent;
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
            padding: clamp(32px, 4vw, 52px) clamp(20px, 5vw, 88px);
            background: linear-gradient(115deg, #e0ecf8 0%, #f2f7fc 52%, #dceaf8 100%);
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

        /* 5. SEKSI GERBANG LAYANAN: ELEGAN & MINIMALIS */
        .section-services-clean {
            padding: clamp(56px, 6vw, 88px) clamp(20px, 5vw, 88px);
            background: var(--bg-blue-gradient);
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .services-header-box {
            position: relative;
            z-index: 2;
            max-width: 680px;
            margin: 0 auto 46px auto;
        }

        .services-header-box h2 {
            font-size: 2.35rem;
            font-weight: 900;
            letter-spacing: -0.025em;
            color: var(--text-dark);
            margin-bottom: 0;
        }

        .services-carousel {
            position: relative;
            max-width: 1240px;
            margin: 0 auto;
        }

        .services-cards-cluster {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: calc((100% - 80px) / 5);
            gap: 20px;
            overflow-x: auto;
            overscroll-behavior-x: contain;
            scroll-snap-type: x mandatory;
            scrollbar-width: none;
            position: relative;
            z-index: 2;
        }

        .services-cards-cluster::-webkit-scrollbar { display: none; }

        .services-carousel-arrow {
            position: absolute;
            top: 50%;
            z-index: 4;
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            border: 1px solid var(--border-soft);
            border-radius: 50%;
            background: #ffffff;
            color: var(--primary-dark);
            font-size: 0.95rem;
            cursor: pointer;
            transform: translateY(-50%);
            box-shadow: 0 6px 18px rgba(15, 23, 42, 0.16);
            transition: opacity 0.2s ease, background-color 0.2s ease, color 0.2s ease;
        }

        .services-carousel-arrow:hover:not(:disabled) { background: var(--primary); color: #ffffff; }
        .services-carousel-arrow:disabled { opacity: 0.38; cursor: default; }
        .services-carousel-arrow[hidden] { display: none; }
        .services-carousel-arrow-prev { left: -21px; }
        .services-carousel-arrow-next { right: -21px; }

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
            scroll-snap-align: start;
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

        .reveal-item {
            opacity: 0;
            transform: translate3d(var(--reveal-x, 0), var(--reveal-y, 26px), 0) scale(var(--reveal-scale, 1)) rotate(var(--reveal-rotation, 0deg));
            transition: opacity 0.65s ease, transform 0.65s cubic-bezier(0.2, 0.7, 0.2, 1);
            transition-delay: var(--reveal-delay, 0ms);
        }

        .reveal-item.is-visible {
            opacity: 1;
            transform: translate3d(0, 0, 0) scale(1) rotate(0deg);
        }

        .reveal-icon {
            --reveal-scale: 0.72;
        }

        #tentang-kami .reveal-item {
            transition-duration: 0.85s;
        }

        #tentang-kami .reveal-item.reveal-icon {
            --reveal-scale: 0.56;
        }

        .accordion-header-btn:hover .accordion-icon-box,
        .location-detail-item:hover > i {
            transform: translateY(-3px) rotate(-8deg) scale(1.08);
        }

        .service-card-clean h4 {
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 10px;
            letter-spacing: -0.01em;
        }

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
            padding: clamp(44px, 5vw, 72px) 0;
            background: linear-gradient(125deg, #e4effa 0%, #f3f7fc 50%, #deebf8 100%);
            border-top: 1px solid var(--border-soft);
        }

        .location-grid-layout {
            display: grid;
            grid-template-columns: minmax(280px, 0.85fr) minmax(0, 2fr);
            gap: 0;
            width: min(100%, 1440px);
            margin: 0 auto;
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
            font-size: 1.5rem;
            font-weight: 900;
            line-height: 1.4;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .location-office-name {
            max-width: 360px;
            margin-bottom: 24px;
            color: var(--text-muted);
            font-size: 0.88rem;
            font-weight: 600;
            line-height: 1.55;
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

        .social-media-clean {
            padding: 48px 20px 52px;
            background: linear-gradient(135deg, #f4f9fc 0%, #ffffff 52%, #f3f8f7 100%);
            border-top: 1px solid var(--border-soft);
            text-align: center;
        }

        .social-media-clean h2 {
            margin: 0 0 24px;
            color: var(--text-dark);
            font-size: 1.25rem;
            font-weight: 800;
        }

        .social-logo-row {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .social-logo-item {
            display: inline-grid;
            place-items: center;
            width: 48px;
            height: 48px;
            border: 1px solid var(--border-soft);
            border-radius: 50%;
            background: #ffffff;
            color: var(--social-color);
            font-size: 1.25rem;
            text-decoration: none;
            box-shadow: 0 5px 16px rgba(15, 23, 42, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }

        .social-logo-item:hover {
            transform: translateY(-3px);
            border-color: var(--social-color);
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.1);
        }

        .social-logo-item i {
            font-size: inherit;
        }

        .social-logo-item:focus-visible {
            outline: 3px solid color-mix(in srgb, var(--social-color) 35%, transparent);
            outline-offset: 3px;
        }

        .floating-tools {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 1200;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .floating-tool-button {
            display: grid;
            place-items: center;
            width: 48px;
            height: 48px;
            border: 1px solid transparent;
            border-radius: 50%;
            font-size: 1.15rem;
            cursor: pointer;
            box-shadow: 0 5px 16px rgba(15, 23, 42, 0.14);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
        }

        .floating-tool-button:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(15, 23, 42, 0.2); }
        .floating-tool-button:focus-visible { outline: 3px solid #0f172a; outline-offset: 3px; }
        .floating-tool-button[aria-pressed="true"] { box-shadow: 0 0 0 3px #ffffff, 0 0 0 5px currentColor; }
        .floating-tool-feedback { background: #ffe4e6; border-color: #fda4af; color: #be123c; }
        .floating-tool-stats { background: #dbeafe; border-color: #93c5fd; color: #1d4ed8; }
        .floating-tool-display { background: #fef3c7; border-color: #fcd34d; color: #b45309; }
        .floating-tool-text { background: #ede9fe; border-color: #c4b5fd; color: #6d28d9; }

        .website-tool-control { position: relative; display: flex; align-items: center; }
        .website-tool-panel {
            position: absolute;
            top: auto;
            bottom: 0;
            right: calc(100% + 12px);
            width: min(290px, calc(100vw - 88px));
            max-height: calc(100vh - 28px);
            overflow-y: auto;
            padding: 16px;
            border: 1px solid var(--tool-border, #cbd5e1);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.97);
            color: var(--text-dark);
            text-align: left;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.18);
        }

        .website-tool-panel[hidden] { display: none; }
        .website-tool-heading { margin: 0 0 4px; font-size: 0.9rem; font-weight: 900; }
        .website-tool-caption { margin: 0 0 13px; color: var(--text-muted); font-size: 0.72rem; line-height: 1.5; }
        .feedback-rating-row { display: flex; justify-content: space-between; gap: 5px; margin-bottom: 12px; }
        .feedback-rating-option { display: grid; place-items: center; gap: 4px; min-width: 42px; padding: 7px 5px; border: 1px solid transparent; border-radius: 8px; background: #f8fafc; color: #64748b; cursor: pointer; }
        .feedback-rating-option i { font-size: 1.1rem; }
        .feedback-rating-option span { font-size: 0.62rem; }
        .feedback-rating-option:hover, .feedback-rating-option[aria-pressed="true"] { border-color: #fda4af; background: #fff1f2; color: #be123c; }
        .feedback-message { width: 100%; min-height: 72px; resize: vertical; padding: 9px 10px; border: 1px solid var(--border-soft); border-radius: 7px; color: var(--text-dark); font: inherit; font-size: 0.74rem; }
        .feedback-submit { width: 100%; margin-top: 9px; padding: 9px 12px; border: 0; border-radius: 7px; background: #be123c; color: #ffffff; font: inherit; font-size: 0.75rem; font-weight: 800; cursor: pointer; }
        .feedback-submit:disabled { opacity: 0.48; cursor: not-allowed; }
        .feedback-status { min-height: 1.2em; margin: 8px 0 0; color: #047857; font-size: 0.7rem; line-height: 1.4; }
        .screen-dimming-overlay { position: fixed; inset: 0; z-index: 1100; pointer-events: none; background: rgba(15, 23, 42, var(--screen-dim-opacity, 0)); transition: background-color 0.15s ease; }
        .screen-dimming-control { --tool-border: #fcd34d; }
        .screen-dimming-label { display: flex; justify-content: space-between; gap: 12px; margin: 16px 0 5px; color: var(--text-gray); font-size: 0.72rem; font-weight: 700; }
        .screen-dimming-value { color: #b45309; font-variant-numeric: tabular-nums; }
        .screen-dimming-range { width: 100%; accent-color: #d97706; cursor: pointer; }

        .visitor-stats-control { position: relative; display: flex; align-items: center; }
        .visitor-stats-popover {
            position: absolute;
            top: 50%;
            right: calc(100% + 12px);
            width: 164px;
            padding: 14px;
            transform: translateY(-50%);
            border: 1px solid #93c5fd;
            border-radius: 16px;
            background: rgba(219, 234, 254, 0.86);
            color: var(--text-muted);
            text-align: center;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 10px 26px rgba(37, 99, 235, 0.16);
        }

        .visitor-stats-popover[hidden] { display: none; }
        .visitor-stats-number { display: block; color: #2563eb; font-size: 1.2rem; font-weight: 900; line-height: 1.2; font-variant-numeric: tabular-nums; }
        .visitor-stats-label { display: block; margin-top: 3px; font-size: 0.76rem; }
        .visitor-stats-divider { height: 1px; margin: 10px 0; border: 0; background: rgba(37, 99, 235, 0.2); }

        .back-to-top-button {
            width: 50px;
            height: 50px;
            margin-top: 22px;
            border: 0;
            border-radius: 6px;
            background: #0ea5e9;
            color: #ffffff;
            font-size: 1.2rem;
        }

        html.large-text { font-size: 18px; }

        .accordion-icon-box,
        .stat-circle-icon,
        .service-icon-circle,
        .service-action-arrow,
        .location-detail-item > i {
            transition: transform 0.35s ease, background-color 0.35s ease, color 0.35s ease;
        }

        .accordion-item-clean:hover .accordion-icon-box,
        .location-detail-item:hover > i {
            transform: translateY(-2px) rotate(-4deg);
        }

        .stat-circle-pod:hover .stat-circle-icon {
            transform: translateY(-3px) scale(1.08) rotate(-8deg);
        }

        .service-card-clean:hover .service-icon-circle {
            transform: scale(1.1) rotate(5deg);
        }

        /* 7. FOOTER */
        footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 22px 7%;
            font-size: 0.84rem;
            text-align: center;
        }

        footer p {
            margin: 0;
            color: #cbd5e1;
            line-height: 1.6;
        }

        /* RESPONSIVE */
        @media (min-width: 1440px) {
            .hero-main-title { font-size: 3.4rem; }
            .section-header-clean h2,
            .services-header-box h2 { font-size: 2.6rem; }
        }

        @media (max-width: 1180px) {
            .services-cards-cluster { grid-auto-columns: calc((100% - 40px) / 3); }
            .stats-grid-circles { grid-template-columns: repeat(4, 1fr); gap: 10px; }
            .stat-circle-number { font-size: 1.45rem; }
            .site-header { gap: 24px; }
            .nav-menu { gap: 12px; }
            .nav-menu a { font-size: 0.76rem; }
            .location-grid-layout { grid-template-columns: 1fr; }
            .map-viewport-frame { border-left: 1.5px solid var(--border-soft); }
        }

        @media (max-width: 900px) {
            .site-header { flex-wrap: wrap; gap: 12px 20px; }
            .nav-menu {
                order: 3;
                flex: 0 0 100%;
                justify-content: center;
                margin-left: 0;
            }
            .search-pill-nav { margin-left: auto; }
                .brand-logo-img { height: 46px; }
                .brand-text-logo { font-size: 1.3rem; }
            .profil-dual-layout { grid-template-columns: 1fr; }
            .section-header-clean { margin-bottom: 26px; }
            .section-header-clean h2 { font-size: 2.1rem; }
            .stats-grid-circles { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            .services-cards-cluster { grid-auto-columns: calc((100% - 20px) / 2); }
            .hero-main-title { font-size: 2.8rem; }
            .accordion-content-text { padding-left: 20px; }
            .location-grid-layout { grid-template-columns: 1fr; }
            .map-viewport-frame { border-left: 1.5px solid var(--border-soft); }
        }

        @media (max-width: 580px) {
            .site-header { padding: 10px 14px; gap: 10px 12px; }
            .brand-link { gap: 8px; }
            .brand-logo-img { height: 40px; max-width: 64px; }
            .brand-text-logo { font-size: 1.15rem; }
            .search-pill-nav { flex: 0 1 min(150px, 36vw); padding-left: 9px; }
            .nav-menu { gap: 8px 18px; }
            .nav-menu a { font-size: 0.7rem; }
            .services-cards-cluster { grid-auto-columns: 100%; }
            .services-carousel-arrow { width: 36px; height: 36px; }
            .services-carousel-arrow-prev { left: 5px; }
            .services-carousel-arrow-next { right: 5px; }
            .section-header-clean h2 { font-size: 1.8rem; }
            .hero-banner-clean { min-height: 540px; }
            .stats-grid-circles { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .floating-tools { right: 14px; bottom: 14px; gap: 7px; }
            .floating-tool-button { width: 44px; height: 44px; font-size: 1.05rem; }
            .visitor-stats-popover { right: calc(100% + 10px); width: min(164px, calc(100vw - 88px)); }
            .website-tool-panel { right: calc(100% + 10px); width: min(290px, calc(100vw - 88px)); }
            .back-to-top-button { width: 48px; height: 48px; margin-top: 16px; }
        }

        @media (max-width: 900px) and (orientation: portrait) {
            .site-header { position: sticky; flex-wrap: nowrap; gap: 8px; }
            .search-pill-nav { order: 2; margin-left: auto; flex: 0 1 min(150px, 36vw); }
            .search-pill-nav .global-search-suggestions { right: -88px; width: min(360px, calc(100vw - 28px)); }
            .menu-toggle { order: 3; display: grid; margin-left: 0; flex: 0 0 42px; }
            .nav-menu {
                order: 4;
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                right: 14px;
                z-index: 1001;
                flex-direction: column;
                align-items: stretch;
                width: min(260px, calc(100vw - 28px));
                margin: 0;
                padding: 8px;
                border: 1px solid rgba(255, 255, 255, 0.18);
                border-radius: 10px;
                background: linear-gradient(145deg, #102a43, #0f766e);
                box-shadow: 0 16px 36px rgba(15, 23, 42, 0.25);
            }
            .site-header.nav-open .nav-menu { display: flex; }
            .nav-menu a { display: block; padding: 11px 12px; font-size: 0.82rem; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                scroll-behavior: auto !important;
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                animation-delay: 0ms !important;
                transition-duration: 0.01ms !important;
                transition-delay: 0ms !important;
            }

            .reveal-item {
                opacity: 1;
                transform: none;
            }
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

        <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="primary-navigation">
            <i class="fa-solid fa-bars" aria-hidden="true"></i>
        </button>

        <ul class="nav-menu" id="primary-navigation">
            <li><a href="#hero-banner" class="active">BERANDA</a></li>
            <li><a href="#tentang-kami">TENTANG KAMI</a></li>
            <li><a href="#layanan-digital">LAYANAN</a></li>
            <li><a href="#hubungi-kami">HUBUNGI KAMI</a></li>
        </ul>

        <form class="search-pill-nav global-search-form" action="<?= url('/search'); ?>" method="GET" role="search" data-suggestions-url="<?= route('search.suggestions'); ?>" autocomplete="off">
            <div class="global-search-control">
                <input type="search" name="q" placeholder="Cari informasi..." aria-label="Cari informasi dan data" data-global-search-input role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="landing-search-suggestions">
                <div class="global-search-suggestions" id="landing-search-suggestions" role="listbox" hidden></div>
            </div>
            <button type="submit" aria-label="Cari"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

    </header>

    <script>
        (() => {
            const header = document.querySelector('.site-header');
            const menuButton = header.querySelector('.menu-toggle');
            const menuIcon = menuButton.querySelector('i');

            const setMenuOpen = isOpen => {
                header.classList.toggle('nav-open', isOpen);
                menuButton.setAttribute('aria-expanded', String(isOpen));
                menuButton.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
                menuIcon.className = `fa-solid ${isOpen ? 'fa-xmark' : 'fa-bars'}`;
            };

            menuButton.addEventListener('click', () => setMenuOpen(!header.classList.contains('nav-open')));
            header.querySelectorAll('.nav-menu a').forEach(link => link.addEventListener('click', () => setMenuOpen(false)));
            document.addEventListener('click', event => {
                if (!header.contains(event.target)) setMenuOpen(false);
            });
            document.addEventListener('keydown', event => {
                if (event.key === 'Escape' && header.classList.contains('nav-open')) {
                    setMenuOpen(false);
                    menuButton.focus();
                }
            });
        })();
    </script>
    <script src="<?= asset('js/global-search.js'); ?>" defer></script>

    <!-- 2. HERO BANNER -->
    <section id="hero-banner" class="hero-banner-clean" style="background-image: url('<?= asset('images/alun-alun-tuban.jpg'); ?>');">
        <div class="hero-content-wrap">
            
            <h1 class="hero-main-title">Desa Digital</h1>
            <p class="hero-lead-text">Digitalisasi Pemerintahan Desa di Kabupaten Tuban</p>
            <div>
                <a href="#tentang-kami" class="btn-jelajah-solo">
                    <span>Mulai</span>
                </a>
            </div>

        </div>
    </section>

    <!-- 3. ACCORDION & PROFIL INOVASI -->
    <section id="tentang-kami" class="section-profil-accordion">
        <div class="section-header-clean">
            <span class="section-purpose-label">SEPUTAR TENTANG</span>
            <h2>DESA DIGITAL</h2>
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
                <div class="stat-circle-number"><?= number_format($statistics['totalWifiDesa'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Titik WiFi</div>
            </div>

            <!-- 2. Website Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #2563eb; --pod-bg: #dbeafe; --pod-border: #bfdbfe; --pod-glow: rgba(37, 99, 235, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-globe"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalWebsite'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Website Desa</div>
            </div>

            <!-- 3. Wisata Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #059669; --pod-bg: #d1fae5; --pod-border: #a7f3d0; --pod-glow: rgba(5, 150, 105, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-mountain-sun"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalWisata'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Wisata Desa</div>
            </div>

            <!-- 4. Balai Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #4f46e5; --pod-bg: #e0e7ff; --pod-border: #c7d2fe; --pod-glow: rgba(79, 70, 229, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-building-columns"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalKantorDesa'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Balai Desa</div>
            </div>

            <!-- 5. Pasar Desa -->
            <div class="stat-circle-pod" style="--pod-accent: #d97706; --pod-bg: #fef3c7; --pod-border: #fde68a; --pod-glow: rgba(217, 119, 6, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-store"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalPasar'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Pasar Rakyat</div>
            </div>

            <!-- 6. Unit BUMDes -->
            <div class="stat-circle-pod" style="--pod-accent: #7c3aed; --pod-bg: #ede9fe; --pod-border: #ddd6fe; --pod-glow: rgba(124, 58, 237, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-briefcase"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalBumdes'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Unit BUMDes</div>
            </div>

            <!-- 7. Dokumen KKDMP -->
            <div class="stat-circle-pod" style="--pod-accent: #e11d48; --pod-bg: #ffe4e6; --pod-border: #fecdd3; --pod-glow: rgba(225, 29, 72, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-chart-pie"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalKkdmp'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Dokumen KKDMP</div>
            </div>

            <!-- 8. Distrik Kecamatan -->
            <div class="stat-circle-pod" style="--pod-accent: #0d9488; --pod-bg: #ccfbf1; --pod-border: #99f6e4; --pod-glow: rgba(13, 148, 136, 0.18);">
                <div class="stat-circle-icon"><i class="fa-solid fa-sitemap"></i></div>
                <div class="stat-circle-number"><?= number_format($statistics['totalKecamatan'] ?? 0, 0, ',', '.'); ?></div>
                <div class="stat-circle-label">Kecamatan</div>
            </div>

        </div>
    </section>

    <!-- 5. SEKSI GERBANG LAYANAN: ELEGAN, MINIMALIS & TANPA TEKS DESKRIPSI -->
    <section id="layanan-digital" class="section-services-clean">
        
        <div class="services-header-box">
            <h2>Gerbang Layanan Publik Digital</h2>
        </div>

        <div class="services-carousel">
            <button type="button" class="services-carousel-arrow services-carousel-arrow-prev" id="services-carousel-prev" aria-label="Lihat layanan sebelumnya" aria-controls="services-carousel-track" title="Lihat layanan sebelumnya" hidden>
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="services-cards-cluster" id="services-carousel-track">
            
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

            <!-- 3. Surat Desa (Langsung Terhubung ke APMD Tuban) -->
            <a href="https://apmd.tubankab.go.id/" target="_blank" rel="noopener noreferrer" class="service-card-clean"
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

            <!-- 4. CCTV (Langsung Terhubung ke CCTV Tuban) -->
            <a href="https://cctv.tubankab.go.id/" target="_blank" rel="noopener noreferrer" class="service-card-clean"
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

            <!-- 5. e-PBB (Langsung Terhubung ke PBB Tuban) -->
            <a href="https://pbb.tubankab.go.id/" target="_blank" rel="noopener noreferrer" class="service-card-clean"
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
            <button type="button" class="services-carousel-arrow services-carousel-arrow-next" id="services-carousel-next" aria-label="Lihat layanan berikutnya" aria-controls="services-carousel-track" title="Lihat layanan berikutnya" hidden>
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
    </section>

    <!-- 6. LOKASI KEDINASAN -->
    <section id="hubungi-kami" class="section-location-clean">
        <div class="location-grid-layout">
            
            <div class="location-info-card">
                <div>
                    <h3>Hubungi Kami</h3>
                    <p class="location-office-name">Dinas Komunikasi, Informatika, Statistik dan Persandian Kabupaten Tuban</p>
                    
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

                <a href="https://www.google.com/maps/dir/?api=1&destination=-6.901873934235668,112.0440727763729" target="_blank" rel="noopener noreferrer" class="btn-maps-route">
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

        </div>
    </section>

    <section class="social-media-clean" aria-labelledby="social-media-title">
        <h2 id="social-media-title">Media sosial</h2>
        <div class="social-logo-row" aria-label="Platform media sosial">
            <a class="social-logo-item" style="--social-color: #1877f2;" href="https://www.facebook.com/diskominfo.tuban" target="_blank" rel="noopener noreferrer" aria-label="Facebook Diskominfo Tuban">
                <i class="fa-brands fa-facebook-f" aria-hidden="true"></i>
            </a>
            <a class="social-logo-item" style="--social-color: #e4405f;" href="https://www.instagram.com/kominfo.tuban" target="_blank" rel="noopener noreferrer" aria-label="Instagram Diskominfo Tuban">
                <i class="fa-brands fa-instagram" aria-hidden="true"></i>
            </a>
            <a class="social-logo-item" style="--social-color: #ff0000;" href="https://www.youtube.com/@diskominfotuban865" target="_blank" rel="noopener noreferrer" aria-label="YouTube Diskominfo Tuban">
                <i class="fa-brands fa-youtube" aria-hidden="true"></i>
            </a>
            <a class="social-logo-item" style="--social-color: #111111;" href="https://www.tiktok.com/@kominfo.tuban" target="_blank" rel="noopener noreferrer" aria-label="TikTok Diskominfo Tuban">
                <i class="fa-brands fa-tiktok" aria-hidden="true"></i>
            </a>
            <a class="social-logo-item" style="--social-color: #111111;" href="https://x.com/DiskominfoTuban" target="_blank" rel="noopener noreferrer" aria-label="X Diskominfo Tuban">
                <i class="fa-brands fa-twitter" aria-hidden="true"></i>
            </a>
        </div>
    </section>

    <!-- 7. FOOTER -->
    <footer>
        <p>&copy; 2026 <strong>Dinas Komunikasi dan Informatika, Statistik dan Persandian</strong> Kabupaten Tuban</p>
    </footer>

    <div class="screen-dimming-overlay" id="screen-dimming-overlay" aria-hidden="true"></div>
    <div class="floating-tools" aria-label="Menu akses cepat">
        <div class="website-tool-control">
            <button type="button" class="floating-tool-button floating-tool-feedback" id="feedback-toggle" aria-label="Beri penilaian untuk website" aria-expanded="false" aria-controls="feedback-panel" title="Beri penilaian untuk website">
                <i class="fa-solid fa-face-smile" aria-hidden="true"></i>
            </button>
            <section class="website-tool-panel" id="feedback-panel" aria-label="Penilaian kepuasan website" hidden>
                <h2 class="website-tool-heading">Bagaimana pengalaman Anda?</h2>
                <p class="website-tool-caption">Penilaian Anda membantu kami meningkatkan layanan website.</p>
                <div class="feedback-rating-row" role="group" aria-label="Pilih nilai kepuasan">
                    <button type="button" class="feedback-rating-option" data-rating="1" aria-label="Sangat kurang" aria-pressed="false"><i class="fa-solid fa-face-frown" aria-hidden="true"></i><span>Kurang</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="2" aria-label="Kurang" aria-pressed="false"><i class="fa-solid fa-face-meh" aria-hidden="true"></i><span>Cukup</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="3" aria-label="Cukup baik" aria-pressed="false"><i class="fa-solid fa-face-smile" aria-hidden="true"></i><span>Baik</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="4" aria-label="Puas" aria-pressed="false"><i class="fa-solid fa-face-laugh" aria-hidden="true"></i><span>Puas</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="5" aria-label="Sangat puas" aria-pressed="false"><i class="fa-solid fa-face-grin-stars" aria-hidden="true"></i><span>Hebat</span></button>
                </div>
                <textarea class="feedback-message" id="feedback-message" maxlength="500" placeholder="Saran singkat (opsional)" aria-label="Saran singkat"></textarea>
                <button type="button" class="feedback-submit" id="feedback-submit" disabled>Kirim penilaian</button>
                <p class="feedback-status" id="feedback-status" role="status" aria-live="polite"></p>
            </section>
        </div>
        <div class="visitor-stats-control">
            <button type="button" class="floating-tool-button floating-tool-stats" id="visitor-stats-toggle" aria-label="Tampilkan statistik pengunjung" aria-expanded="false" aria-controls="visitor-stats-panel" title="Tampilkan statistik pengunjung">
                <i class="fa-solid fa-eye" aria-hidden="true"></i>
            </button>
            <section class="visitor-stats-popover" id="visitor-stats-panel" aria-label="Statistik pengunjung" aria-live="polite" hidden>
                <span class="visitor-stats-number" id="visitors-today">{{ number_format($statistics['kunjunganHariIni'] ?? 0, 0, ',', '.') }}</span>
                <span class="visitor-stats-label">Kunjungan Hari Ini</span>
                <hr class="visitor-stats-divider">
                <span class="visitor-stats-number" id="visitors-total">{{ number_format($statistics['totalKunjungan'] ?? 0, 0, ',', '.') }}</span>
                <span class="visitor-stats-label">Total Kunjungan</span>
            </section>
        </div>
        <div class="website-tool-control screen-dimming-control">
            <button type="button" class="floating-tool-button floating-tool-display" id="screen-dimming-toggle" aria-label="Atur pencahayaan layar" aria-expanded="false" aria-controls="screen-dimming-panel" title="Atur pencahayaan layar">
                <i class="fa-solid fa-lightbulb" aria-hidden="true"></i>
            </button>
            <section class="website-tool-panel" id="screen-dimming-panel" aria-label="Pengaturan pencahayaan layar" hidden>
                <h2 class="website-tool-heading">Pencahayaan layar</h2>
                <p class="website-tool-caption">Atur tingkat redup tampilan agar nyaman dibaca.</p>
                <label class="screen-dimming-label" for="screen-dimming-range"><span>Redupkan tampilan</span><output class="screen-dimming-value" id="screen-dimming-value" for="screen-dimming-range">0%</output></label>
                <input class="screen-dimming-range" id="screen-dimming-range" type="range" min="0" max="45" step="5" value="0" aria-label="Tingkat redup tampilan">
            </section>
        </div>
        <button type="button" class="floating-tool-button floating-tool-text" id="large-text-toggle" aria-label="Perbesar teks" aria-pressed="false" title="Perbesar teks">
            <i class="fa-solid fa-text-height" aria-hidden="true"></i>
        </button>
        <button type="button" class="floating-tool-button back-to-top-button" id="back-to-top" aria-label="Kembali ke bagian paling atas" title="Kembali ke atas">
            <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
        </button>
    </div>

    <!-- SCRIPT AKORDEON -->
    <script>
        const navigationEntry = performance.getEntriesByType('navigation')[0];
        if (navigationEntry?.type === 'reload') {
            if ('scrollRestoration' in history) history.scrollRestoration = 'manual';
            if (window.location.hash) {
                history.replaceState(null, '', window.location.pathname + window.location.search);
            }

            const resetHomeScroll = () => {
                document.documentElement.style.scrollBehavior = 'auto';
                window.scrollTo(0, 0);
            };

            resetHomeScroll();
            window.addEventListener('pageshow', resetHomeScroll, { once: true });
            requestAnimationFrame(() => requestAnimationFrame(() => {
                resetHomeScroll();
                document.documentElement.style.removeProperty('scroll-behavior');
            }));
        }

        const revealGroups = [
            '.section-header-clean',
            '.profil-dual-layout',
            '.accordion-item-clean',
            '.video-player-frame',
            '.accordion-title-wrap',
            '.accordion-header-btn > i.fa-chevron-down',
            '.accordion-icon-box',
            '.stats-grid-circles > *',
            '.stat-circle-icon, .stat-circle-number, .stat-circle-label',
            '.services-header-box',
            '.services-cards-cluster > *',
            '.service-icon-circle, .service-card-clean h4, .service-action-arrow',
            '.header-tag-pill i',
            '.location-info-card, .map-viewport-frame',
            '.location-detail-item',
            '.location-detail-item > i'
        ];
        const revealDirections = [
            [0, 30], [30, 0], [0, -30], [-30, 0], [22, 22], [-22, 22]
        ];
        let revealIndex = 0;

        revealGroups.forEach(selector => {
            document.querySelectorAll(selector).forEach((element, index) => {
                element.classList.add('reveal-item');
                const isRevealIcon = element.matches('.accordion-icon-box, .accordion-header-btn > i, .stat-circle-icon, .service-icon-circle, .service-action-arrow, .header-tag-pill i, .location-detail-item > i');
                const isProfileElement = Boolean(element.closest('#tentang-kami'));
                const motionScale = isProfileElement ? 1.55 : 1;

                if (isRevealIcon) {
                    element.classList.add('reveal-icon');
                    element.style.setProperty('--reveal-rotation', `${revealIndex % 2 ? 18 : -18}deg`);
                }
                const [offsetX, offsetY] = revealDirections[revealIndex % revealDirections.length];
                element.style.setProperty('--reveal-x', `${offsetX * motionScale}px`);
                element.style.setProperty('--reveal-y', `${offsetY * motionScale}px`);
                element.style.setProperty('--reveal-delay', `${Math.min(index * (isProfileElement ? 90 : 75), isProfileElement ? 360 : 300)}ms`);
                revealIndex += 1;
            });
        });

        const revealTargets = [...document.querySelectorAll('.reveal-item')];
        let revealObserver = null;

        if ('IntersectionObserver' in window) {
            revealObserver = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        revealObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.12, rootMargin: '0px 0px -24px 0px' });

            revealTargets.forEach(element => revealObserver.observe(element));
        } else {
            revealTargets.forEach(element => element.classList.add('is-visible'));
        }

        const revealVisibleItems = () => {
            revealTargets.forEach(element => {
                if (element.classList.contains('is-visible')) return;

                const bounds = element.getBoundingClientRect();
                if (bounds.top <= window.innerHeight * 0.9 && bounds.bottom >= 0) {
                    element.classList.add('is-visible');
                    revealObserver?.unobserve(element);
                }
            });
        };

        window.addEventListener('scroll', revealVisibleItems, { passive: true });
        window.addEventListener('resize', revealVisibleItems);
        revealVisibleItems();

        const sectionLinks = Array.from(document.querySelectorAll('.nav-menu a[href^="#"]'));
        const updateActiveSection = () => {
            const focusPoint = window.scrollY + Math.max(120, window.innerHeight * 0.3);
            const activeSection = sectionLinks
                .map(link => document.querySelector(link.hash))
                .find(section => section && section.offsetTop <= focusPoint && section.offsetTop + section.offsetHeight > focusPoint);

            sectionLinks.forEach(link => {
                link.classList.toggle('active', Boolean(activeSection && link.hash === `#${activeSection.id}`));
            });
        };

        window.addEventListener('scroll', updateActiveSection, { passive: true });
        window.addEventListener('resize', updateActiveSection);
        updateActiveSection();

        const feedbackButton = document.getElementById('feedback-toggle');
        const feedbackPanel = document.getElementById('feedback-panel');
        const feedbackMessage = document.getElementById('feedback-message');
        const feedbackSubmitButton = document.getElementById('feedback-submit');
        const feedbackStatus = document.getElementById('feedback-status');
        const feedbackRatingOptions = [...document.querySelectorAll('.feedback-rating-option')];
        const visitorStatsButton = document.getElementById('visitor-stats-toggle');
        const visitorStatsPanel = document.getElementById('visitor-stats-panel');
        const screenDimmingButton = document.getElementById('screen-dimming-toggle');
        const screenDimmingPanel = document.getElementById('screen-dimming-panel');
        const screenDimmingRange = document.getElementById('screen-dimming-range');
        const screenDimmingValue = document.getElementById('screen-dimming-value');
        const screenDimmingOverlay = document.getElementById('screen-dimming-overlay');
        const largeTextButton = document.getElementById('large-text-toggle');
        const backToTopButton = document.getElementById('back-to-top');
        let selectedFeedbackRating = null;

        const setFeedbackVisible = isVisible => {
            if (!feedbackButton || !feedbackPanel) return;
            feedbackPanel.hidden = !isVisible;
            feedbackButton.setAttribute('aria-expanded', String(isVisible));
        };

        const setVisitorStatsVisible = isVisible => {
            if (!visitorStatsButton || !visitorStatsPanel) return;
            visitorStatsPanel.hidden = !isVisible;
            visitorStatsButton.setAttribute('aria-expanded', String(isVisible));
            visitorStatsButton.setAttribute('aria-label', isVisible ? 'Sembunyikan statistik pengunjung' : 'Tampilkan statistik pengunjung');
            visitorStatsButton.title = isVisible ? 'Sembunyikan statistik pengunjung' : 'Tampilkan statistik pengunjung';
        };

        const setScreenDimmingVisible = isVisible => {
            if (!screenDimmingButton || !screenDimmingPanel) return;
            screenDimmingPanel.hidden = !isVisible;
            screenDimmingButton.setAttribute('aria-expanded', String(isVisible));
        };

        feedbackButton?.addEventListener('click', () => {
            const isVisible = feedbackPanel?.hidden ?? false;
            setFeedbackVisible(isVisible);
            if (isVisible) {
                setVisitorStatsVisible(false);
                setScreenDimmingVisible(false);
            }
        });

        visitorStatsButton?.addEventListener('click', () => {
            const isVisible = visitorStatsPanel?.hidden ?? false;
            setVisitorStatsVisible(isVisible);
            if (isVisible) {
                setFeedbackVisible(false);
                setScreenDimmingVisible(false);
            }
        });

        screenDimmingButton?.addEventListener('click', () => {
            const isVisible = screenDimmingPanel?.hidden ?? false;
            setScreenDimmingVisible(isVisible);
            if (isVisible) {
                setFeedbackVisible(false);
                setVisitorStatsVisible(false);
            }
        });

        document.addEventListener('click', event => {
            if (feedbackPanel && !event.target.closest('.website-tool-control:not(.screen-dimming-control)')) {
                setFeedbackVisible(false);
            }
            if (visitorStatsPanel && !event.target.closest('.visitor-stats-control')) {
                setVisitorStatsVisible(false);
            }
            if (screenDimmingPanel && !event.target.closest('.screen-dimming-control')) {
                setScreenDimmingVisible(false);
            }
        });

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && feedbackPanel && !feedbackPanel.hidden) {
                setFeedbackVisible(false);
                feedbackButton?.focus();
            }
            if (event.key === 'Escape' && visitorStatsPanel && !visitorStatsPanel.hidden) {
                setVisitorStatsVisible(false);
                visitorStatsButton?.focus();
            }
            if (event.key === 'Escape' && screenDimmingPanel && !screenDimmingPanel.hidden) {
                setScreenDimmingVisible(false);
                screenDimmingButton?.focus();
            }
        });

        feedbackRatingOptions.forEach(option => {
            option.addEventListener('click', () => {
                selectedFeedbackRating = Number(option.dataset.rating);
                feedbackRatingOptions.forEach(ratingOption => {
                    ratingOption.setAttribute('aria-pressed', String(ratingOption === option));
                });
                feedbackSubmitButton.disabled = false;
                feedbackStatus.textContent = '';
            });
        });

        feedbackSubmitButton?.addEventListener('click', async () => {
            if (!selectedFeedbackRating) return;

            feedbackSubmitButton.disabled = true;
            feedbackStatus.textContent = 'Mengirim penilaian...';

            try {
                const response = await fetch('{{ route('website-feedback.store') }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        rating: selectedFeedbackRating,
                        message: feedbackMessage.value.trim()
                    })
                });
                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Penilaian gagal dikirim.');

                feedbackStatus.textContent = result.message;
                feedbackMessage.value = '';
                selectedFeedbackRating = null;
                feedbackRatingOptions.forEach(option => option.setAttribute('aria-pressed', 'false'));
            } catch (error) {
                feedbackStatus.textContent = error.message || 'Koneksi gagal. Silakan coba lagi.';
                feedbackSubmitButton.disabled = false;
            }
        });

        const screenDimmingStorageKey = 'desa-digital-screen-dimming';
        const applyScreenDimming = value => {
            const dimLevel = Number(value);
            screenDimmingRange.value = String(dimLevel);
            screenDimmingValue.textContent = dimLevel === 0 ? 'Normal' : `${dimLevel}% redup`;
            screenDimmingOverlay.style.setProperty('--screen-dim-opacity', String(dimLevel / 100));
        };

        try {
            applyScreenDimming(window.localStorage.getItem(screenDimmingStorageKey) || '0');
        } catch {
            applyScreenDimming('0');
        }

        screenDimmingRange?.addEventListener('input', () => {
            applyScreenDimming(screenDimmingRange.value);
            try {
                window.localStorage.setItem(screenDimmingStorageKey, screenDimmingRange.value);
            } catch {}
        });

        const updateVisitorStats = async () => {
            try {
                const response = await fetch('{{ route('website-visits.stats') }}', {
                    headers: { 'Accept': 'application/json' },
                    cache: 'no-store'
                });
                if (!response.ok) return;

                const counts = await response.json();
                const numberFormat = new Intl.NumberFormat('id-ID');
                document.getElementById('visitors-today').textContent = numberFormat.format(counts.kunjunganHariIni ?? 0);
                document.getElementById('visitors-total').textContent = numberFormat.format(counts.totalKunjungan ?? 0);
            } catch {
                return;
            }
        };

        updateVisitorStats();
        window.setInterval(updateVisitorStats, 60000);

        largeTextButton?.addEventListener('click', () => {
            const isLargeText = largeTextButton.getAttribute('aria-pressed') !== 'true';
            document.documentElement.classList.toggle('large-text', isLargeText);
            largeTextButton.setAttribute('aria-pressed', String(isLargeText));
            largeTextButton.setAttribute('aria-label', isLargeText ? 'Kembalikan ukuran teks' : 'Perbesar teks');
            largeTextButton.title = isLargeText ? 'Kembalikan ukuran teks' : 'Perbesar teks';
        });

        backToTopButton?.addEventListener('click', () => {
            const behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';
            window.scrollTo({ top: 0, behavior });
        });

        const servicesTrack = document.getElementById('services-carousel-track');
        const servicesPreviousButton = document.getElementById('services-carousel-prev');
        const servicesNextButton = document.getElementById('services-carousel-next');

        const updateServicesCarousel = () => {
            if (!servicesTrack || !servicesPreviousButton || !servicesNextButton) return;

            const hasOverflow = servicesTrack.scrollWidth > servicesTrack.clientWidth + 1;
            servicesPreviousButton.hidden = !hasOverflow;
            servicesNextButton.hidden = !hasOverflow;
            servicesPreviousButton.disabled = servicesTrack.scrollLeft <= 1;
            servicesNextButton.disabled = servicesTrack.scrollLeft + servicesTrack.clientWidth >= servicesTrack.scrollWidth - 1;
        };

        const scrollServices = direction => {
            const firstCard = servicesTrack?.querySelector('.service-card-clean');
            if (!servicesTrack || !firstCard) return;

            const gap = Number.parseFloat(getComputedStyle(servicesTrack).columnGap) || 0;
            const scrollDistance = firstCard.getBoundingClientRect().width + gap;
            servicesTrack.scrollBy({ left: direction * scrollDistance, behavior: 'auto' });
            updateServicesCarousel();
        };

        servicesPreviousButton?.addEventListener('click', () => scrollServices(-1));
        servicesNextButton?.addEventListener('click', () => scrollServices(1));
        servicesTrack?.addEventListener('scroll', updateServicesCarousel, { passive: true });
        window.addEventListener('resize', updateServicesCarousel);
        new ResizeObserver(updateServicesCarousel).observe(servicesTrack);
        new MutationObserver(updateServicesCarousel).observe(servicesTrack, { childList: true });
        updateServicesCarousel();

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