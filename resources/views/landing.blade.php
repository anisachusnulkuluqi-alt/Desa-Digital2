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

    <script>
        (function() {
            try {
                var s = JSON.parse(localStorage.getItem('desa_digital_accessibility') || '{}');
                var cl = document.documentElement.classList;
                if (s.fontSize && s.fontSize !== 'normal') cl.add('access-font-' + s.fontSize);
                if (s.contrast && s.contrast !== 'normal') cl.add('access-contrast-' + s.contrast);
                if (s.colorBlind && s.colorBlind !== 'normal') cl.add('access-cb-' + s.colorBlind);
                if (s.dyslexic) cl.add('access-dyslexic');
                if (s.underlineLinks) cl.add('access-links-underline');
            } catch (e) {}
        })();
    </script>

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
        section[id], footer[id] { scroll-margin-top: var(--site-header-height, 80px); }
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
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .site-header-spacer { height: 92px; }

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
        .nav-menu a.active { color: #ffffff; background: rgba(148, 163, 184, 0.32); box-shadow: inset 0 0 0 1px rgba(203, 213, 225, 0.35); }

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
            min-height: clamp(520px, calc(100vh - 78px), 820px);
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
            background:
                linear-gradient(115deg, rgba(24, 42, 73, 0.22), rgba(83, 73, 132, 0.11) 58%, rgba(14, 42, 63, 0.19)),
                linear-gradient(180deg, rgba(15, 23, 42, 0.1) 0%, rgba(15, 23, 42, 0.3) 100%);
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
            filter: drop-shadow(0 2px 2px rgba(15, 23, 42, 0.82)) drop-shadow(0 7px 13px rgba(15, 23, 42, 0.48)) drop-shadow(0 8px 24px rgba(56, 189, 248, 0.2));
            animation: hero-enter 0.75s cubic-bezier(0.2, 0.7, 0.2, 1) both;
        }

        .hero-lead-text {
            font-size: 1.08rem;
            color: #e2e8f0;
            font-weight: 500;
            max-width: 540px;
            margin: 0 auto 24px;
            line-height: 1.6;
            text-shadow: 0 2px 3px rgba(15, 23, 42, 0.92), 0 5px 13px rgba(15, 23, 42, 0.58);
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
            border: 1px solid rgba(255, 255, 255, .72);
            border-radius: 18px;
            background: #172033;
            box-shadow: 0 18px 42px rgba(15, 23, 42, .17);
        }

        .video-embed-box {
            position: absolute;
            inset: 0;
            overflow: hidden;
            background: #172033;
        }
        .video-embed-box iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        .video-poster {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            width: 100%;
            height: 100%;
            padding: 0;
            overflow: hidden;
            border: 0;
            background: #172033;
            cursor: pointer;
        }
        .video-poster::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(115deg, rgba(23, 35, 57, .24), rgba(53, 54, 103, .16) 58%, rgba(13, 31, 48, .28));
            transition: background .2s ease;
        }
        .video-poster:hover::after,
        .video-poster:focus-visible::after {
            background: linear-gradient(115deg, rgba(23, 35, 57, .12), rgba(53, 54, 103, .08) 58%, rgba(13, 31, 48, .18));
        }
        .video-poster:focus-visible {
            outline: 3px solid #7dd3fc;
            outline-offset: -5px;
        }
        .video-poster img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: saturate(.88) contrast(.97);
            transition: transform .45s ease, filter .45s ease;
        }
        .video-poster:hover img {
            transform: scale(1.025);
            filter: saturate(.96) contrast(1);
        }
        .video-play-mark {
            position: relative;
            z-index: 1;
            display: grid;
            width: 104px;
            height: 104px;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .72);
            border-radius: 50%;
            background: rgba(255, 255, 255, .94);
            box-shadow: 0 12px 35px rgba(11, 22, 42, .25);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .video-poster:hover .video-play-mark {
            transform: scale(1.06);
            box-shadow: 0 16px 42px rgba(11, 22, 42, .32);
        }
        .video-play-mark img {
            position: static;
            width: 55px;
            height: 55px;
            object-fit: contain;
            filter: none;
        }
        .video-play-triangle {
            position: absolute;
            right: -2px;
            bottom: 2px;
            display: grid;
            width: 34px;
            height: 34px;
            place-items: center;
            padding-left: 2px;
            border: 3px solid #fff;
            border-radius: 50%;
            background: linear-gradient(145deg, #168bc4, #5954a8);
            color: #fff;
            font-size: 12px;
            box-shadow: 0 4px 12px rgba(25, 39, 77, .24);
        }
        @media (max-width: 580px) {
            .video-player-frame { border-radius: 14px; }
            .video-play-mark { width: 82px; height: 82px; }
            .video-play-mark img { width: 46px; height: 46px; }
            .video-play-triangle { width: 30px; height: 30px; font-size: 10px; }
        }

        /* 4. SEKSI STATISTIK: KAPSUL BULAT TERANG */
        .section-stats-circle {
            padding: clamp(32px, 4vw, 52px) clamp(20px, 5vw, 88px);
            background: linear-gradient(115deg, #e0ecf8 0%, #f2f7fc 52%, #dceaf8 100%);
            position: relative;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
        }

        .stats-heading {
            max-width: 1140px;
            margin: 0 auto 24px;
            color: var(--text-dark);
            font-size: clamp(1.25rem, 2.5vw, 1.8rem);
            font-weight: 900;
            text-align: center;
        }
        .stats-heading::after {
            content: '';
            display: block;
            width: 48px;
            height: 3px;
            margin: 12px auto 0;
            border-radius: 999px;
            background: linear-gradient(90deg, #0284c7, #10b981);
        }
        .stats-subheading {
            margin: -12px auto 28px;
            color: var(--text-muted);
            font-size: 0.88rem;
            line-height: 1.6;
            text-align: center;
        }

        .stats-carousel {
            position: relative;
            max-width: 1140px;
            margin: 0 auto;
        }

        .stats-grid-circles {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            position: relative;
            z-index: 2;
        }

        .stats-grid-circles.is-carousel-active {
            grid-auto-flow: column;
            grid-auto-columns: calc((100% - 48px) / 4);
            grid-template-columns: none;
            overflow-x: auto;
            overscroll-behavior-x: contain;
            scroll-snap-type: x mandatory;
            scroll-behavior: smooth;
            scrollbar-width: none;
        }

        .stats-grid-circles::-webkit-scrollbar { display: none; }
        .stats-grid-circles.is-carousel-active > * { scroll-snap-align: start; }

        .stats-carousel-arrow {
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

        .stats-carousel-arrow:hover:not(:disabled) { background: var(--primary); color: #ffffff; }
        .stats-carousel-arrow:disabled { opacity: 0.38; cursor: default; }
        .stats-carousel-arrow[hidden] { display: none; }
        .stats-carousel-arrow-prev { left: -21px; }
        .stats-carousel-arrow-next { right: -21px; }

        .stat-circle-pod:nth-child(8n + 1) { --pod-accent: #0284c7; --pod-bg: #e0f2fe; --pod-border: #bae6fd; --pod-glow: rgba(2, 132, 199, 0.18); }
        .stat-circle-pod:nth-child(8n + 2) { --pod-accent: #2563eb; --pod-bg: #dbeafe; --pod-border: #bfdbfe; --pod-glow: rgba(37, 99, 235, 0.18); }
        .stat-circle-pod:nth-child(8n + 3) { --pod-accent: #059669; --pod-bg: #d1fae5; --pod-border: #a7f3d0; --pod-glow: rgba(5, 150, 105, 0.18); }
        .stat-circle-pod:nth-child(8n + 4) { --pod-accent: #4f46e5; --pod-bg: #e0e7ff; --pod-border: #c7d2fe; --pod-glow: rgba(79, 70, 229, 0.18); }
        .stat-circle-pod:nth-child(8n + 5) { --pod-accent: #d97706; --pod-bg: #fef3c7; --pod-border: #fde68a; --pod-glow: rgba(217, 119, 6, 0.18); }
        .stat-circle-pod:nth-child(8n + 6) { --pod-accent: #7c3aed; --pod-bg: #ede9fe; --pod-border: #ddd6fe; --pod-glow: rgba(124, 58, 237, 0.18); }
        .stat-circle-pod:nth-child(8n + 7) { --pod-accent: #e11d48; --pod-bg: #ffe4e6; --pod-border: #fecdd3; --pod-glow: rgba(225, 29, 72, 0.18); }
        .stat-circle-pod:nth-child(8n) { --pod-accent: #0d9488; --pod-bg: #ccfbf1; --pod-border: #99f6e4; --pod-glow: rgba(13, 148, 136, 0.18); }

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
            width: min(calc(100% - 40px), 1240px);
            margin: 0 auto;
            align-items: stretch;
            overflow: hidden;
            border: 1.5px solid var(--border-soft);
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
        }

        .location-info-card {
            background: #ffffff;
            border: 0;
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
            border-left: 1.5px solid var(--border-soft);
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
        .floating-tool-feedback { background: #fff7ed; border-color: #fed7aa; color: #c2410c; }
        .floating-tool-feedback.is-submitted { background: #fef9c3; border-color: #fde047; color: #eab308; }
        .floating-tool-stats { background: #dbeafe; border-color: #93c5fd; color: #1d4ed8; }
        .floating-tool-accessibility { background: #f5f3ff; border-color: #ddd6fe; color: #7c3aed; }
        .floating-tool-accessibility:hover { background: #ede9fe; color: #6d28d9; }

        .website-tool-control { position: relative; display: flex; align-items: center; }
        .feedback-submitted-notice { position: absolute; right: 0; bottom: calc(100% + 10px); width: max-content; max-width: min(240px, calc(100vw - 40px)); padding: 9px 12px; border: 1px solid #fde68a; border-radius: 10px; background: #fffbeb; color: #854d0e; font-size: 0.75rem; font-weight: 700; line-height: 1.4; text-align: center; box-shadow: 0 6px 18px rgba(15, 23, 42, 0.15); }
        .feedback-submitted-notice[hidden] { display: none; }
        .website-tool-panel {
            position: absolute;
            top: auto;
            bottom: 0;
            right: calc(100% + 12px);
            width: min(340px, calc(100vw - 88px));
            max-height: calc(100vh - 28px);
            overflow-y: auto;
            padding: 18px;
            border: 1px solid var(--tool-border, #cbd5e1);
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.98);
            color: var(--text-dark);
            text-align: left;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.2);
        }

        .website-tool-panel[hidden] { display: none; }
        .website-tool-heading { margin: 0 0 5px; color: #172554; font-size: 1rem; font-weight: 850; letter-spacing: -0.02em; }
        .website-tool-caption { margin: 0 0 15px; color: #64748b; font-size: 0.76rem; line-height: 1.55; }
        .feedback-rating-row { display: flex; justify-content: space-between; gap: 6px; margin: 0 0 8px; padding: 8px; border: 1px solid #e2e8f0; border-radius: 12px; background: #f8fafc; }
        .feedback-rating-option {
            display: grid;
            justify-items: center;
            align-content: center;
            gap: 2px;
            flex: 1;
            min-width: 0;
            min-height: 54px;
            padding: 4px 2px;
            border: 1px solid transparent;
            border-radius: 9px;
            background: transparent;
            color: #94a3b8;
            line-height: 1;
            cursor: pointer;
            transition: color .15s ease, background-color .15s ease, transform .15s ease, box-shadow .15s ease;
        }
        .feedback-rating-option:hover,
        .feedback-rating-option:focus-visible,
        .feedback-rating-option.is-active { color: #d97706; background: #fff; }
        .feedback-rating-option.is-active[aria-pressed="true"] { box-shadow: 0 2px 8px rgba(15, 23, 42, 0.1); }
        .feedback-rating-option:hover { transform: translateY(-1px); }
        .feedback-rating-option:focus-visible { outline: 2px solid #d97706; outline-offset: 2px; }
        .feedback-rating-option:disabled { cursor: wait; }
        .feedback-rating-star { font-size: 1.45rem; }
        .feedback-rating-number { color: #64748b; font-size: 0.64rem; font-weight: 700; }
        .feedback-rating-label { min-height: 1.4em; margin: 0 0 12px; color: #334155; font-size: 0.75rem; font-weight: 700; text-align: center; }
        .feedback-comment-wrap[hidden] { display: none; }
        .feedback-comment-wrap .website-tool-caption { display: block; margin-bottom: 7px; color: #475569; }
        .feedback-message-wrap { position: relative; }
        .feedback-message { display: block; width: 100%; min-height: 88px; resize: vertical; padding: 11px 50px 28px 12px; border: 1px solid #cbd5e1; border-radius: 10px; background: #fff; color: var(--text-dark); font: inherit; font-size: 0.76rem; box-sizing: border-box; outline: none; }
        .feedback-message:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, .12); }
        .feedback-character-count { position: absolute; right: 12px; bottom: 10px; color: #64748b; font-size: 0.68rem; line-height: 1; pointer-events: none; }
        .feedback-submit { width: 100%; margin-top: 10px; padding: 11px 12px; border: 0; border-radius: 10px; background: #1d4ed8; color: #ffffff; font: inherit; font-size: 0.76rem; font-weight: 800; cursor: pointer; transition: background-color .15s ease, transform .15s ease; }
        .feedback-submit:not(:disabled):hover { background: #1e40af; transform: translateY(-1px); }
        .feedback-submit:disabled { opacity: 0.48; cursor: not-allowed; }
        .feedback-status { min-height: 1.2em; margin: 10px 0 0; color: #047857; font-size: 0.72rem; line-height: 1.45; }
        .feedback-status[data-state="error"] { color: #b91c1c; }
        .feedback-status[data-state="pending"] { color: #475569; }
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

        .accessibility-tool-control {
            position: relative;
            display: flex;
            align-items: center;
        }

        .accessibility-panel {
            position: absolute;
            top: auto;
            bottom: 0;
            right: calc(100% + 12px);
            width: min(252px, calc(100vw - 76px));
            max-height: calc(100vh - 28px);
            overflow-y: auto;
            padding: 12px 13px 10px;
            border: 1px solid #ddd6fe;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.98);
            color: var(--text-dark);
            text-align: left;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow: 0 12px 32px rgba(124, 58, 237, 0.16);
        }

        .accessibility-panel[hidden] { display: none; }

        .accessibility-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 7px;
            padding-bottom: 6px;
            border-bottom: 1px solid #f1f5f9;
        }

        .accessibility-title-wrap {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            font-weight: 850;
            color: #1e1b4b;
        }

        .accessibility-title-wrap i {
            color: #7c3aed;
            font-size: 0.92rem;
        }

        .accessibility-close-btn {
            display: grid;
            place-items: center;
            width: 22px;
            height: 22px;
            border: 0;
            background: transparent;
            color: #64748b;
            font-size: 1.15rem;
            line-height: 1;
            cursor: pointer;
            border-radius: 6px;
            transition: color 0.15s, background-color 0.15s;
        }

        .accessibility-close-btn:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .accessibility-section {
            margin-bottom: 7px;
        }

        .accessibility-section-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 3px;
        }

        .accessibility-cb-hint {
            font-size: 0.62rem;
            font-weight: 700;
            color: #7c3aed;
            background: #f5f3ff;
            border: 1px solid #ddd6fe;
            padding: 1px 5px;
            border-radius: 4px;
            line-height: 1.2;
        }

        .accessibility-label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.68rem;
            font-weight: 750;
            color: #64748b;
            letter-spacing: -0.01em;
            margin-bottom: 3px;
        }

        .accessibility-label i {
            font-size: 0.66rem;
            color: #8b5cf6;
        }

        .accessibility-btn-group {
            display: flex;
            gap: 3px;
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 2px;
        }

        .accessibility-opt-btn {
            flex: 1;
            min-width: 0;
            padding: 4px 2px;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: #475569;
            font-size: 0.7rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            text-align: center;
            white-space: nowrap;
        }

        .accessibility-opt-btn:hover {
            background: #ffffff;
            color: #0f172a;
        }

        .accessibility-opt-btn.is-active {
            background: #7c3aed;
            color: #ffffff;
            box-shadow: 0 1px 4px rgba(124, 58, 237, 0.28);
        }

        .accessibility-chips-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5px;
        }

        .accessibility-chip-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 100%;
            padding: 5px 4px;
            border: 1px solid #e2e8f0;
            border-radius: 7px;
            background: #f8fafc;
            color: #475569;
            font-size: 0.68rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
            white-space: nowrap;
        }

        .accessibility-chip-btn:hover {
            background: #ffffff;
            border-color: #cbd5e1;
            color: #0f172a;
        }

        .accessibility-chip-btn.is-active {
            border-color: #8b5cf6;
            background: #f5f3ff;
            color: #6d28d9;
            font-weight: 800;
        }

        .accessibility-chip-btn.is-active i {
            color: #7c3aed;
        }

        .accessibility-reset-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 100%;
            margin-top: 5px;
            padding: 5px 8px;
            border: 1px dashed #cbd5e1;
            border-radius: 7px;
            background: #ffffff;
            color: #64748b;
            font-size: 0.68rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
        }

        .accessibility-reset-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
            background: #fef2f2;
        }

        /* Accessibility Root Modifiers */
        html.access-font-sm { font-size: 88%; }
        html.access-font-lg { font-size: 112%; }
        html.access-font-xl { font-size: 125%; }

        html.access-contrast-high {
            filter: contrast(135%);
        }

        html.access-contrast-grayscale {
            filter: grayscale(100%) !important;
        }

        /* Color Blind Mode Filters (feColorMatrix) */
        html.access-cb-protanopia {
            filter: url('#access-filter-protanopia');
        }
        html.access-cb-deuteranopia {
            filter: url('#access-filter-deuteranopia');
        }
        html.access-cb-tritanopia {
            filter: url('#access-filter-tritanopia');
        }

        /* Kombinasi dengan kontras tinggi */
        html.access-contrast-high.access-cb-protanopia {
            filter: url('#access-filter-protanopia') contrast(135%);
        }
        html.access-contrast-high.access-cb-deuteranopia {
            filter: url('#access-filter-deuteranopia') contrast(135%);
        }
        html.access-contrast-high.access-cb-tritanopia {
            filter: url('#access-filter-tritanopia') contrast(135%);
        }

        html.access-dyslexic,
        html.access-dyslexic body,
        html.access-dyslexic p,
        html.access-dyslexic h1,
        html.access-dyslexic h2,
        html.access-dyslexic h3,
        html.access-dyslexic h4,
        html.access-dyslexic span,
        html.access-dyslexic a,
        html.access-dyslexic button,
        html.access-dyslexic input,
        html.access-dyslexic textarea {
            font-family: Arial, Helvetica, sans-serif !important;
            letter-spacing: 0.035em !important;
            word-spacing: 0.05em !important;
        }

        html.access-links-underline a {
            text-decoration: underline !important;
            text-underline-offset: 3px !important;
        }

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
            font-weight: 700;
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
            .stats-grid-circles { gap: 16px; }
            .stats-grid-circles.is-carousel-active { grid-auto-columns: calc((100% - 32px) / 3); }
            .stat-circle-number { font-size: 1.45rem; }
            .site-header { gap: 24px; }
            .nav-menu { gap: 12px; }
            .nav-menu a { font-size: 0.76rem; }
            .location-grid-layout { grid-template-columns: 1fr; }
            .map-viewport-frame { min-height: 420px; border-top: 1.5px solid var(--border-soft); border-left: 0; }
            .map-viewport-frame iframe { min-height: 420px; }
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
            .stats-grid-circles { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px; }
            .stats-grid-circles.is-carousel-active { grid-auto-columns: calc((100% - 12px) / 2); grid-template-columns: none; }
            .services-cards-cluster { grid-auto-columns: calc((100% - 20px) / 2); }
            .hero-main-title { font-size: 2.8rem; }
            .accordion-content-text { padding-left: 20px; }
            .location-grid-layout { grid-template-columns: 1fr; }
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
            .stats-carousel-arrow { width: 36px; height: 36px; }
            .stats-carousel-arrow-prev { left: 5px; }
            .stats-carousel-arrow-next { right: 5px; }
            .stats-grid-circles.is-carousel-active { grid-auto-columns: 78%; gap: 12px; padding: 4px 6px 12px; }
            .floating-tools { right: 14px; bottom: 14px; gap: 7px; }
            .floating-tool-button { width: 44px; height: 44px; font-size: 1.05rem; }
            .visitor-stats-popover { right: calc(100% + 10px); width: min(164px, calc(100vw - 88px)); }
            .website-tool-panel { right: calc(100% + 10px); width: min(290px, calc(100vw - 88px)); }
            .accessibility-panel { right: calc(100% + 8px); width: min(242px, calc(100vw - 76px)); }
            .back-to-top-button { width: 48px; height: 48px; margin-top: 16px; }
        }

        @media (max-width: 900px) and (orientation: portrait) {
            .site-header { flex-wrap: nowrap; gap: 8px; }
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
    <link rel="stylesheet" href="<?= asset('css/public-header.css'); ?>">
</head>
<body>

    <!-- SVG Filters untuk Aksesibilitas Buta Warna (Color Vision Deficiency) -->
    <svg xmlns="http://www.w3.org/2000/svg" style="position: absolute; width: 0; height: 0; overflow: hidden; pointer-events: none;" aria-hidden="true">
        <defs>
            <!-- Protanopia (Sulit membedakan warna merah) -->
            <filter id="access-filter-protanopia" color-interpolation-filters="sRGB">
                <feColorMatrix type="matrix" values="
                    0.567, 0.433, 0.000, 0, 0
                    0.558, 0.442, 0.000, 0, 0
                    0.000, 0.242, 0.758, 0, 0
                    0.000, 0.000, 0.000, 1, 0" />
            </filter>
            <!-- Deuteranopia (Sulit membedakan warna hijau) -->
            <filter id="access-filter-deuteranopia" color-interpolation-filters="sRGB">
                <feColorMatrix type="matrix" values="
                    0.625, 0.375, 0.000, 0, 0
                    0.700, 0.300, 0.000, 0, 0
                    0.000, 0.300, 0.700, 0, 0
                    0.000, 0.000, 0.000, 1, 0" />
            </filter>
            <!-- Tritanopia (Sulit membedakan warna biru-kuning) -->
            <filter id="access-filter-tritanopia" color-interpolation-filters="sRGB">
                <feColorMatrix type="matrix" values="
                    0.950, 0.050, 0.000, 0, 0
                    0.000, 0.433, 0.567, 0, 0
                    0.000, 0.475, 0.525, 0, 0
                    0.000, 0.000, 0.000, 1, 0" />
            </filter>
        </defs>
    </svg>

    @include('partials.public-header', ['activePage' => 'home', 'showSpacer' => true])

    <!-- 2. HERO BANNER -->
    <section id="hero-banner" class="hero-banner-clean" style="background-image: url('<?= asset('images/alun2.jpeg'); ?>');">
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
                <div class="video-embed-box" id="profil-video">
                    <button type="button" class="video-poster" id="profil-video-play" aria-label="Putar video Profil Desa Digital Kabupaten Tuban">
                        <img src="https://img.youtube.com/vi/gPCZo6dKDWM/hqdefault.jpg" alt="" loading="lazy" onerror="this.onerror=null; this.src='<?= asset('images/alun2.jpeg'); ?>';">
                        <span class="video-play-mark" aria-hidden="true">
                            <img src="<?= asset('images/desa-digital.png'); ?>" alt="">
                            <span class="video-play-triangle"><i class="fa-solid fa-play"></i></span>
                        </span>
                    </button>
                </div>
            </div>

        </div>
    </section>
    <script>
        document.getElementById('profil-video-play')?.addEventListener('click', () => {
            const player = document.getElementById('profil-video');
            const iframe = document.createElement('iframe');
            iframe.src = 'https://www.youtube-nocookie.com/embed/gPCZo6dKDWM?autoplay=1&controls=0&disablekb=1&rel=0&playsinline=1&iv_load_policy=3';
            iframe.title = 'Profil Desa Digital Kabupaten Tuban';
            iframe.allow = 'autoplay; encrypted-media';
            iframe.allowFullscreen = true;
            player.replaceChildren(iframe);
        });
    </script>

    <!-- 4. SEKSI LAYANAN PUBLIK -->
    <section id="layanan-digital" class="section-services-clean">
        
        <div class="services-header-box">
            <h2>Gerbang Layanan Publik Digital</h2>
        </div>

        <div class="services-carousel">
            <button type="button" class="services-carousel-arrow services-carousel-arrow-prev" id="services-carousel-prev" aria-label="Lihat layanan sebelumnya" aria-controls="services-carousel-track" title="Lihat layanan sebelumnya" hidden>
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="services-cards-cluster" id="services-carousel-track">
            @php
                $serviceThemes = [
                    ['accent' => '#2563eb', 'border' => '#bfdbfe', 'glow' => 'rgba(37, 99, 235, 0.22)', 'pill' => '#dbeafe', 'text' => '#1d4ed8', 'gradient' => 'linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%)', 'shadow' => 'rgba(37, 99, 235, 0.35)'],
                    ['accent' => '#059669', 'border' => '#a7f3d0', 'glow' => 'rgba(5, 150, 105, 0.22)', 'pill' => '#d1fae5', 'text' => '#047857', 'gradient' => 'linear-gradient(135deg, #047857 0%, #10b981 100%)', 'shadow' => 'rgba(16, 185, 129, 0.35)'],
                    ['accent' => '#d97706', 'border' => '#fde68a', 'glow' => 'rgba(217, 119, 6, 0.22)', 'pill' => '#fef3c7', 'text' => '#b45309', 'gradient' => 'linear-gradient(135deg, #b45309 0%, #f59e0b 100%)', 'shadow' => 'rgba(245, 158, 11, 0.35)'],
                    ['accent' => '#e11d48', 'border' => '#fecdd3', 'glow' => 'rgba(225, 29, 72, 0.22)', 'pill' => '#ffe4e6', 'text' => '#be123c', 'gradient' => 'linear-gradient(135deg, #be123c 0%, #f43f5e 100%)', 'shadow' => 'rgba(244, 63, 94, 0.35)'],
                    ['accent' => '#7c3aed', 'border' => '#ddd6fe', 'glow' => 'rgba(124, 58, 237, 0.22)', 'pill' => '#ede9fe', 'text' => '#6d28d9', 'gradient' => 'linear-gradient(135deg, #6d28d9 0%, #8b5cf6 100%)', 'shadow' => 'rgba(139, 92, 246, 0.35)'],
                ];
                $serviceIcons = [
                    'Website Desa' => 'fa-globe',
                    'Data Spasial' => 'fa-location-dot',
                    'Surat Desa' => 'fa-envelope-open-text',
                    'CCTV' => 'fa-video',
                    'e-PBB' => 'fa-qrcode',
                ];
            @endphp
            @foreach($layanans as $index => $layanan)
                @php
                    $theme = $serviceThemes[$index % count($serviceThemes)];
                    $serviceHost = parse_url($layanan->link, PHP_URL_HOST);
                    $isExternalService = $serviceHost && $serviceHost !== request()->getHost();
                @endphp
                <a href="{{ $layanan->link }}" class="service-card-clean"
                   @if($isExternalService) target="_blank" rel="noopener noreferrer" @endif
                   style="--service-accent: {{ $theme['accent'] }}; --service-border: {{ $theme['border'] }}; --service-glow: {{ $theme['glow'] }}; --service-pill: {{ $theme['pill'] }}; --service-text: {{ $theme['text'] }};">
                    <div class="service-icon-circle"
                         style="background: {{ $theme['gradient'] }}; --icon-shadow: {{ $theme['shadow'] }};">
                        <i class="fa-solid {{ $serviceIcons[$layanan->nama] ?? 'fa-link' }}"></i>
                    </div>
                    <h4>{{ $layanan->nama }}</h4>
                    <div class="service-action-arrow"><i class="fa-solid fa-arrow-right"></i></div>
                </a>
            @endforeach
            </div>
            <button type="button" class="services-carousel-arrow services-carousel-arrow-next" id="services-carousel-next" aria-label="Lihat layanan berikutnya" aria-controls="services-carousel-track" title="Lihat layanan berikutnya" hidden>
                <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
    </section>

    <!-- 5. SEKSI STATISTIK TEMPAT DARI MASTER -->
    <section id="statistik-wilayah" class="section-stats-circle">
        <h2 class="stats-heading">ANGKA STATISTIK</h2>
        <div class="stats-carousel">
            <button type="button" class="stats-carousel-arrow stats-carousel-arrow-prev" id="stats-carousel-prev" aria-label="Lihat statistik sebelumnya" aria-controls="place-statistics-grid" title="Lihat statistik sebelumnya" hidden>
                <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
            </button>
            <div class="stats-grid-circles" id="place-statistics-grid" aria-live="polite">
                @foreach($placeCategories as $category)
                <div class="stat-circle-pod reveal-item" data-category="{{ $category['name'] }}" data-core="{{ ($category['is_core'] ?? false) ? 'true' : 'false' }}" style="--reveal-x: 0px; --reveal-y: 26px;">
                    <div class="stat-circle-icon"><i class="fa-solid fa-map-location-dot" aria-hidden="true"></i></div>
                    <div class="stat-circle-number" data-count="{{ $category['count'] }}" aria-label="{{ number_format($category['count'], 0, ',', '.') }}">0</div>
                    <div class="stat-circle-label">{{ $category['label'] ?? ucwords(str_replace(['_', '-'], ' ', $category['name'])) }}</div>
                </div>
                @endforeach
            </div>
            <button type="button" class="stats-carousel-arrow stats-carousel-arrow-next" id="stats-carousel-next" aria-label="Lihat statistik berikutnya" aria-controls="place-statistics-grid" title="Lihat statistik berikutnya" hidden>
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

    <div class="floating-tools" aria-label="Menu akses cepat">
        <div class="website-tool-control">
            <button type="button" class="floating-tool-button floating-tool-feedback" id="feedback-toggle" aria-label="Survei kepuasan website" aria-expanded="false" aria-controls="feedback-panel" title="Survei kepuasan website">
                <i class="fa-regular fa-star" aria-hidden="true"></i>
            </button>
            <span class="feedback-submitted-notice" id="feedback-submitted-notice" role="status" aria-live="polite" hidden>Anda sudah memberikan feedback.</span>
            <section class="website-tool-panel" id="feedback-panel" aria-label="Penilaian survei kepuasan website" hidden>
                <h2 class="website-tool-heading">Kepuasan Anda</h2>
                <p class="website-tool-caption">Bagaimana pengalaman Anda menggunakan portal Desa Digital?</p>
                <div class="feedback-rating-row" role="group" aria-label="Pilih nilai kepuasan">
                    <button type="button" class="feedback-rating-option" data-rating="1" aria-label="1 bintang, sangat tidak puas" aria-pressed="false"><span class="feedback-rating-star" aria-hidden="true">&#9733;</span><span class="feedback-rating-number" aria-hidden="true">1</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="2" aria-label="2 bintang, kurang puas" aria-pressed="false"><span class="feedback-rating-star" aria-hidden="true">&#9733;</span><span class="feedback-rating-number" aria-hidden="true">2</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="3" aria-label="3 bintang, cukup puas" aria-pressed="false"><span class="feedback-rating-star" aria-hidden="true">&#9733;</span><span class="feedback-rating-number" aria-hidden="true">3</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="4" aria-label="4 bintang, puas" aria-pressed="false"><span class="feedback-rating-star" aria-hidden="true">&#9733;</span><span class="feedback-rating-number" aria-hidden="true">4</span></button>
                    <button type="button" class="feedback-rating-option" data-rating="5" aria-label="5 bintang, sangat puas" aria-pressed="false"><span class="feedback-rating-star" aria-hidden="true">&#9733;</span><span class="feedback-rating-number" aria-hidden="true">5</span></button>
                </div>
                <p class="feedback-rating-label" id="feedback-rating-label">Pilih bintang 1 sampai 5</p>
                <div class="feedback-comment-wrap" id="feedback-comment-wrap" hidden>
                    <label class="website-tool-caption" for="feedback-message">Apa yang perlu kami perbaiki? Kritik dan saran wajib diisi.</label>
                    <div class="feedback-message-wrap">
                        <textarea class="feedback-message" id="feedback-message" maxlength="500" placeholder="Tuliskan kritik atau saran Anda" aria-label="Kritik dan saran" aria-required="true"></textarea>
                        <span class="feedback-character-count" id="feedback-character-count" aria-label="Jumlah karakter" aria-live="polite">0/500</span>
                    </div>
                    <button type="button" class="feedback-submit" id="feedback-submit" disabled>Kirim Penilaian</button>
                </div>
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
        <div class="accessibility-tool-control">
            <button type="button" class="floating-tool-button floating-tool-accessibility" id="accessibility-toggle" aria-label="Menu aksesibilitas website" aria-expanded="false" aria-controls="accessibility-panel" title="Menu aksesibilitas website">
                <i class="fa-solid fa-universal-access" aria-hidden="true"></i>
            </button>
            <section class="accessibility-panel" id="accessibility-panel" aria-label="Pengaturan aksesibilitas website" hidden>
                <div class="accessibility-header">
                    <div class="accessibility-title-wrap">
                        <i class="fa-solid fa-universal-access" aria-hidden="true"></i>
                        <span>Aksesibilitas</span>
                    </div>
                    <button type="button" class="accessibility-close-btn" id="accessibility-close" aria-label="Tutup menu aksesibilitas">&times;</button>
                </div>

                <!-- Ukuran Huruf -->
                <div class="accessibility-section">
                    <span class="accessibility-label"><i class="fa-solid fa-font" aria-hidden="true"></i> Ukuran Teks</span>
                    <div class="accessibility-btn-group" role="group" aria-label="Pengaturan ukuran teks">
                        <button type="button" class="accessibility-opt-btn" data-access-font="sm" aria-label="Ukuran font kecil" title="Kecil">A-</button>
                        <button type="button" class="accessibility-opt-btn is-active" data-access-font="normal" aria-label="Ukuran font normal" title="Normal">Normal</button>
                        <button type="button" class="accessibility-opt-btn" data-access-font="lg" aria-label="Ukuran font besar" title="Besar">A+</button>
                        <button type="button" class="accessibility-opt-btn" data-access-font="xl" aria-label="Ukuran font sangat besar" title="Sangat Besar">A++</button>
                    </div>
                </div>

                <!-- Kontras Tampilan -->
                <div class="accessibility-section">
                    <span class="accessibility-label"><i class="fa-solid fa-circle-half-stroke" aria-hidden="true"></i> Kontras Layar</span>
                    <div class="accessibility-btn-group" role="group" aria-label="Pengaturan kontras">
                        <button type="button" class="accessibility-opt-btn is-active" data-access-contrast="normal" aria-label="Kontras standar" title="Standar">Standar</button>
                        <button type="button" class="accessibility-opt-btn" data-access-contrast="high" aria-label="Kontras tinggi" title="Kontras Tinggi">Kontras</button>
                        <button type="button" class="accessibility-opt-btn" data-access-contrast="grayscale" aria-label="Tampilan monokrom" title="Monokrom">Monokrom</button>
                    </div>
                </div>

                <!-- Filter Buta Warna -->
                <div class="accessibility-section">
                    <div class="accessibility-section-head">
                        <span class="accessibility-label"><i class="fa-solid fa-palette" aria-hidden="true"></i> Buta Warna</span>
                        <span class="accessibility-cb-hint" id="access-cb-hint">Off</span>
                    </div>
                    <div class="accessibility-btn-group" role="group" aria-label="Filter buta warna">
                        <button type="button" class="accessibility-opt-btn is-active" data-access-cb="normal" title="Normal (Tanpa filter)">Normal</button>
                        <button type="button" class="accessibility-opt-btn" data-access-cb="deuteranopia" title="Deuteranopia: Buta warna hijau">Deuter</button>
                        <button type="button" class="accessibility-opt-btn" data-access-cb="protanopia" title="Protanopia: Buta warna merah">Protan</button>
                        <button type="button" class="accessibility-opt-btn" data-access-cb="tritanopia" title="Tritanopia: Buta warna biru">Tritan</button>
                    </div>
                </div>

                <!-- Keterbacaan Tambahan -->
                <div class="accessibility-section">
                    <span class="accessibility-label"><i class="fa-solid fa-book-open-reader" aria-hidden="true"></i> Keterbacaan</span>
                    <div class="accessibility-chips-grid">
                        <button type="button" class="accessibility-chip-btn" id="access-toggle-dyslexic" aria-pressed="false" title="Aktifkan font ramah disleksia">
                            <i class="fa-solid fa-spell-check" aria-hidden="true"></i>
                            <span>Disleksia</span>
                        </button>
                        <button type="button" class="accessibility-chip-btn" id="access-toggle-underline" aria-pressed="false" title="Garis bawahi semua tautan">
                            <i class="fa-solid fa-underline" aria-hidden="true"></i>
                            <span>Garis Link</span>
                        </button>
                    </div>
                </div>

                <!-- Reset Pengaturan -->
                <button type="button" class="accessibility-reset-btn" id="accessibility-reset" title="Kembalikan semua pengaturan ke awal">
                    <i class="fa-solid fa-rotate-left" aria-hidden="true"></i>
                    <span>Reset Pengaturan</span>
                </button>
            </section>
        </div>
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
            '.stat-circle-icon, .stat-circle-label',
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

        const placeStatisticsGrid = document.getElementById('place-statistics-grid');
        const statsPreviousButton = document.getElementById('stats-carousel-prev');
        const statsNextButton = document.getElementById('stats-carousel-next');
        const initialStatsCardCount = placeStatisticsGrid?.querySelectorAll('[data-core="true"]').length ?? 0;
        const numberFormat = new Intl.NumberFormat('id-ID');
        const countAnimationFrames = new WeakMap();

        const updateStatsCarousel = () => {
            if (!placeStatisticsGrid || !statsPreviousButton || !statsNextButton) return;

            const hasMoreCategoriesThanInitial = placeStatisticsGrid.children.length > initialStatsCardCount;
            placeStatisticsGrid.classList.toggle('is-carousel-active', hasMoreCategoriesThanInitial);

            if (!hasMoreCategoriesThanInitial) placeStatisticsGrid.scrollLeft = 0;

            const hasOverflow = hasMoreCategoriesThanInitial
                && placeStatisticsGrid.scrollWidth > placeStatisticsGrid.clientWidth + 1;
            statsPreviousButton.hidden = !hasOverflow;
            statsNextButton.hidden = !hasOverflow;
            statsPreviousButton.disabled = placeStatisticsGrid.scrollLeft <= 1;
            statsNextButton.disabled = placeStatisticsGrid.scrollLeft + placeStatisticsGrid.clientWidth >= placeStatisticsGrid.scrollWidth - 1;
        };

        const scrollStats = direction => {
            const firstCard = placeStatisticsGrid?.querySelector('.stat-circle-pod');
            if (!placeStatisticsGrid || !firstCard) return;

            const styles = getComputedStyle(placeStatisticsGrid);
            const gap = Number.parseFloat(styles.columnGap) || 0;
            const scrollDistance = firstCard.getBoundingClientRect().width + gap;
            const behavior = window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth';
            placeStatisticsGrid.scrollBy({ left: direction * scrollDistance, behavior });
        };

        statsPreviousButton?.addEventListener('click', () => scrollStats(-1));
        statsNextButton?.addEventListener('click', () => scrollStats(1));
        placeStatisticsGrid?.addEventListener('scroll', updateStatsCarousel, { passive: true });
        window.addEventListener('resize', updateStatsCarousel);
        if (placeStatisticsGrid) new ResizeObserver(updateStatsCarousel).observe(placeStatisticsGrid);
        updateStatsCarousel();

        const animatePlaceCount = element => {
            const target = Number(element.dataset.count);
            const start = Number(element.dataset.displayValue || 0);
            const frame = countAnimationFrames.get(element);
            if (frame) cancelAnimationFrame(frame);

            element.classList.add('is-counted');
            element.setAttribute('aria-label', numberFormat.format(target));
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || start === target) {
                element.dataset.displayValue = String(target);
                element.textContent = numberFormat.format(target);
                return;
            }

            const startTime = performance.now();
            const duration = 900;
            const update = currentTime => {
                const progress = Math.min((currentTime - startTime) / duration, 1);
                const easedProgress = 1 - Math.pow(1 - progress, 3);
                const value = Math.round(start + (target - start) * easedProgress);
                element.dataset.displayValue = String(value);
                element.textContent = numberFormat.format(value);

                if (progress < 1) {
                    countAnimationFrames.set(element, requestAnimationFrame(update));
                } else {
                    countAnimationFrames.delete(element);
                }
            };

            countAnimationFrames.set(element, requestAnimationFrame(update));
        };

        const placeCountObserver = 'IntersectionObserver' in window
            ? new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (!entry.isIntersecting) return;
                    animatePlaceCount(entry.target);
                    placeCountObserver.unobserve(entry.target);
                });
            }, { threshold: 0.35 })
            : null;

        const observePlaceCount = element => {
            if (placeCountObserver) {
                placeCountObserver.observe(element);
            } else {
                animatePlaceCount(element);
            }
        };

        document.querySelectorAll('#place-statistics-grid .stat-circle-number').forEach(observePlaceCount);

        const categoryIcons = {
            wisata: 'fa-mountain-sun',
            wifi: 'fa-wifi',
            kuliner: 'fa-utensils',
            pasar: 'fa-store',
            pendidikan: 'fa-graduation-cap',
            kesehatan: 'fa-heart-pulse',
            ibadah: 'fa-mosque',
            masjid: 'fa-mosque',
            hotel: 'fa-hotel',
            bumdes: 'fa-briefcase'
        };

        const createPlaceCategoryCard = category => {
            const card = document.createElement('div');
            card.className = 'stat-circle-pod reveal-item';
            card.dataset.category = category.name;
            card.dataset.core = 'false';
            card.style.setProperty('--reveal-x', '0px');
            card.style.setProperty('--reveal-y', '26px');

            const iconWrap = document.createElement('div');
            iconWrap.className = 'stat-circle-icon';
            const icon = document.createElement('i');
            const iconKey = category.name.toLowerCase().replace(/[_-]+/g, ' ');
            icon.className = `fa-solid ${categoryIcons[iconKey] || 'fa-map-location-dot'}`;
            icon.setAttribute('aria-hidden', 'true');
            iconWrap.append(icon);

            const number = document.createElement('div');
            number.className = 'stat-circle-number';
            number.dataset.count = String(category.count);
            number.textContent = '0';

            const label = document.createElement('div');
            label.className = 'stat-circle-label';
            label.textContent = category.label || category.name
                .replace(/[_-]+/g, ' ')
                .replace(/\b[a-z]/g, letter => letter.toUpperCase());

            card.append(iconWrap, number, label);
            return card;
        };

        const renderPlaceCategories = categories => {
            if (!placeStatisticsGrid) return;

            const currentCategories = new Set();
            categories.forEach(category => {
                const name = String(category.name);
                const count = Number(category.count);
                if (!Number.isFinite(count)) return;

                currentCategories.add(name);
                let card = Array.from(placeStatisticsGrid.children)
                    .find(item => item.dataset.category === name);

                if (!card) {
                    card = createPlaceCategoryCard({ name, count });
                    placeStatisticsGrid.append(card);
                    if (revealObserver) {
                        revealObserver.observe(card);
                    } else {
                        card.classList.add('is-visible');
                    }
                    observePlaceCount(card.querySelector('.stat-circle-number'));
                }

                const number = card.querySelector('.stat-circle-number');
                number.dataset.count = String(count);
                if (number.classList.contains('is-counted')) animatePlaceCount(number);
            });

            Array.from(placeStatisticsGrid.children).forEach(card => {
                if (currentCategories.has(card.dataset.category)) return;
                revealObserver?.unobserve(card);
                placeCountObserver?.unobserve(card.querySelector('.stat-circle-number'));
                card.remove();
            });
            updateStatsCarousel();
        };

        let placeStatisticsRequestPending = false;
        const updatePlaceStatistics = async () => {
            if (placeStatisticsRequestPending) return;
            placeStatisticsRequestPending = true;
            try {
                const response = await fetch('{{ route('place-statistics') }}', {
                    headers: { 'Accept': 'application/json' },
                    cache: 'no-store'
                });
                if (!response.ok) throw new Error(`Permintaan statistik gagal (${response.status}).`);

                const result = await response.json();
                if (!Array.isArray(result.categories)) {
                    throw new Error('Format data statistik tempat tidak valid.');
                }
                renderPlaceCategories(result.categories);
            } catch (error) {
                console.error('Statistik tempat gagal diperbarui:', error);
            } finally {
                placeStatisticsRequestPending = false;
            }
        };

        updatePlaceStatistics();
        window.setInterval(updatePlaceStatistics, 60000);
        window.addEventListener('focus', updatePlaceStatistics);

        const sectionLinks = Array.from(document.querySelectorAll('.nav-menu a[href^="#"]'));
        const linkedSections = sectionLinks
            .map(link => ({ link, section: document.querySelector(link.hash) }))
            .filter(entry => entry.section)
            .sort((a, b) => a.section.compareDocumentPosition(b.section) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1);
        const updateActiveSection = () => {
            const focusPoint = window.scrollY + document.querySelector('.site-header').offsetHeight + Math.max(120, window.innerHeight * 0.3);
            const activeEntry = linkedSections
                .filter(({ section }) => section.getBoundingClientRect().top + window.scrollY <= focusPoint)
                .at(-1);

            sectionLinks.forEach(link => {
                const isActive = activeEntry?.link === link;
                link.classList.toggle('active', isActive);
                if (isActive) {
                    link.setAttribute('aria-current', 'location');
                } else {
                    link.removeAttribute('aria-current');
                }
            });
        };

        window.addEventListener('scroll', updateActiveSection, { passive: true });
        window.addEventListener('resize', updateActiveSection);
        updateActiveSection();

        const feedbackButton = document.getElementById('feedback-toggle');
        const feedbackPanel = document.getElementById('feedback-panel');
        const feedbackSubmittedNotice = document.getElementById('feedback-submitted-notice');
        const feedbackMessage = document.getElementById('feedback-message');
        const feedbackCharacterCount = document.getElementById('feedback-character-count');
        const feedbackCommentWrap = document.getElementById('feedback-comment-wrap');
        const feedbackRatingLabel = document.getElementById('feedback-rating-label');
        const feedbackSubmitButton = document.getElementById('feedback-submit');
        const feedbackStatus = document.getElementById('feedback-status');
        const feedbackRatingOptions = [...document.querySelectorAll('.feedback-rating-option')];
        const visitorStatsButton = document.getElementById('visitor-stats-toggle');
        const visitorStatsPanel = document.getElementById('visitor-stats-panel');
        const accessibilityButton = document.getElementById('accessibility-toggle');
        const accessibilityPanel = document.getElementById('accessibility-panel');
        const accessibilityCloseButton = document.getElementById('accessibility-close');
        const accessibilityResetButton = document.getElementById('accessibility-reset');
        const accessFontButtons = [...document.querySelectorAll('[data-access-font]')];
        const accessContrastButtons = [...document.querySelectorAll('[data-access-contrast]')];
        const accessDyslexicToggle = document.getElementById('access-toggle-dyslexic');
        const accessUnderlineToggle = document.getElementById('access-toggle-underline');
        const accessCbButtons = [...document.querySelectorAll('[data-access-cb]')];
        const accessCbHint = document.getElementById('access-cb-hint');
        const backToTopButton = document.getElementById('back-to-top');
        let selectedFeedbackRating = null;
        let feedbackRequestPending = false;
        let hasSubmittedFeedback = false;
        let feedbackNoticeTimeout;
        const updateFeedbackCharacterCount = () => {
            feedbackCharacterCount.textContent = `${feedbackMessage.value.length}/500`;
        };
        const feedbackRatingLabels = {
            1: 'Sangat tidak puas',
            2: 'Kurang puas',
            3: 'Cukup puas',
            4: 'Puas',
            5: 'Sangat puas'
        };

        const setFeedbackVisible = isVisible => {
            if (!feedbackButton || !feedbackPanel) return;
            feedbackPanel.hidden = !isVisible;
            feedbackButton.setAttribute('aria-expanded', String(isVisible));
        };

        const showFeedbackSubmittedNotice = () => {
            feedbackSubmittedNotice.hidden = false;
            window.clearTimeout(feedbackNoticeTimeout);
            feedbackNoticeTimeout = window.setTimeout(() => {
                feedbackSubmittedNotice.hidden = true;
            }, 3500);
        };

        const setVisitorStatsVisible = isVisible => {
            if (!visitorStatsButton || !visitorStatsPanel) return;
            visitorStatsPanel.hidden = !isVisible;
            visitorStatsButton.setAttribute('aria-expanded', String(isVisible));
            visitorStatsButton.setAttribute('aria-label', isVisible ? 'Sembunyikan statistik pengunjung' : 'Tampilkan statistik pengunjung');
            visitorStatsButton.title = isVisible ? 'Sembunyikan statistik pengunjung' : 'Tampilkan statistik pengunjung';
        };

        const setAccessibilityVisible = isVisible => {
            if (!accessibilityButton || !accessibilityPanel) return;
            accessibilityPanel.hidden = !isVisible;
            accessibilityButton.setAttribute('aria-expanded', String(isVisible));
            accessibilityButton.setAttribute('aria-label', isVisible ? 'Tutup menu aksesibilitas' : 'Menu aksesibilitas website');
            accessibilityButton.title = isVisible ? 'Tutup menu aksesibilitas' : 'Menu aksesibilitas website';
        };

        feedbackButton?.addEventListener('click', () => {
            if (hasSubmittedFeedback) {
                setFeedbackVisible(false);
                setVisitorStatsVisible(false);
                setAccessibilityVisible(false);
                showFeedbackSubmittedNotice();
                return;
            }
            const isVisible = feedbackPanel?.hidden ?? false;
            setFeedbackVisible(isVisible);
            if (isVisible) {
                setVisitorStatsVisible(false);
                setAccessibilityVisible(false);
                feedbackSubmittedNotice.hidden = true;
            }
        });

        visitorStatsButton?.addEventListener('click', () => {
            const isVisible = visitorStatsPanel?.hidden ?? false;
            setVisitorStatsVisible(isVisible);
            if (isVisible) {
                setFeedbackVisible(false);
                setAccessibilityVisible(false);
            }
        });

        accessibilityButton?.addEventListener('click', () => {
            const isVisible = accessibilityPanel?.hidden ?? false;
            setAccessibilityVisible(isVisible);
            if (isVisible) {
                setFeedbackVisible(false);
                setVisitorStatsVisible(false);
            }
        });

        accessibilityCloseButton?.addEventListener('click', () => {
            setAccessibilityVisible(false);
            accessibilityButton?.focus();
        });

        document.addEventListener('click', event => {
            if (feedbackPanel && !event.target.closest('.website-tool-control')) {
                setFeedbackVisible(false);
                feedbackSubmittedNotice.hidden = true;
            }
            if (visitorStatsPanel && !event.target.closest('.visitor-stats-control')) {
                setVisitorStatsVisible(false);
            }
            if (accessibilityPanel && !event.target.closest('.accessibility-tool-control')) {
                setAccessibilityVisible(false);
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
            if (event.key === 'Escape' && accessibilityPanel && !accessibilityPanel.hidden) {
                setAccessibilityVisible(false);
                accessibilityButton?.focus();
            }
        });

        // Accessibility Settings Management
        const ACCESS_STORAGE_KEY = 'desa_digital_accessibility';
        const defaultAccessSettings = {
            fontSize: 'normal',
            contrast: 'normal',
            colorBlind: 'normal',
            dyslexic: false,
            underlineLinks: false
        };

        const loadAccessSettings = () => {
            try {
                return Object.assign({}, defaultAccessSettings, JSON.parse(localStorage.getItem(ACCESS_STORAGE_KEY) || '{}'));
            } catch {
                return Object.assign({}, defaultAccessSettings);
            }
        };

        const saveAccessSettings = settings => {
            try {
                localStorage.setItem(ACCESS_STORAGE_KEY, JSON.stringify(settings));
            } catch {}
        };

        let currentAccessSettings = loadAccessSettings();

        const applyAccessSettings = (settings, persist = true) => {
            const root = document.documentElement;

            // Font size
            root.classList.remove('access-font-sm', 'access-font-lg', 'access-font-xl');
            if (settings.fontSize && settings.fontSize !== 'normal') {
                root.classList.add(`access-font-${settings.fontSize}`);
            }
            accessFontButtons.forEach(btn => {
                btn.classList.toggle('is-active', btn.dataset.accessFont === settings.fontSize);
            });

            // Contrast
            root.classList.remove('access-contrast-high', 'access-contrast-grayscale');
            if (settings.contrast && settings.contrast !== 'normal') {
                root.classList.add(`access-contrast-${settings.contrast}`);
            }
            accessContrastButtons.forEach(btn => {
                btn.classList.toggle('is-active', btn.dataset.accessContrast === settings.contrast);
            });

            // Color blind filter
            root.classList.remove('access-cb-protanopia', 'access-cb-deuteranopia', 'access-cb-tritanopia');
            if (settings.colorBlind && settings.colorBlind !== 'normal') {
                root.classList.add(`access-cb-${settings.colorBlind}`);
            }
            accessCbButtons.forEach(btn => {
                btn.classList.toggle('is-active', btn.dataset.accessCb === settings.colorBlind);
            });

            if (accessCbHint) {
                const cbLabels = {
                    normal: 'Off',
                    deuteranopia: 'Deuter (Hijau)',
                    protanopia: 'Protan (Merah)',
                    tritanopia: 'Tritan (Biru)'
                };
                accessCbHint.textContent = cbLabels[settings.colorBlind] || 'Off';
            }

            // Dyslexic font
            root.classList.toggle('access-dyslexic', Boolean(settings.dyslexic));
            if (accessDyslexicToggle) {
                accessDyslexicToggle.classList.toggle('is-active', Boolean(settings.dyslexic));
                accessDyslexicToggle.setAttribute('aria-pressed', String(Boolean(settings.dyslexic)));
            }

            // Underline links
            root.classList.toggle('access-links-underline', Boolean(settings.underlineLinks));
            if (accessUnderlineToggle) {
                accessUnderlineToggle.classList.toggle('is-active', Boolean(settings.underlineLinks));
                accessUnderlineToggle.setAttribute('aria-pressed', String(Boolean(settings.underlineLinks)));
            }

            if (persist) {
                saveAccessSettings(settings);
            }
        };

        applyAccessSettings(currentAccessSettings, false);

        accessFontButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                currentAccessSettings.fontSize = btn.dataset.accessFont;
                applyAccessSettings(currentAccessSettings);
            });
        });

        accessContrastButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                currentAccessSettings.contrast = btn.dataset.accessContrast;
                if (currentAccessSettings.contrast === 'grayscale') {
                    currentAccessSettings.colorBlind = 'normal';
                }
                applyAccessSettings(currentAccessSettings);
            });
        });

        accessCbButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                currentAccessSettings.colorBlind = btn.dataset.accessCb;
                if (currentAccessSettings.colorBlind !== 'normal' && currentAccessSettings.contrast === 'grayscale') {
                    currentAccessSettings.contrast = 'normal';
                }
                applyAccessSettings(currentAccessSettings);
            });
        });

        accessDyslexicToggle?.addEventListener('click', () => {
            currentAccessSettings.dyslexic = !currentAccessSettings.dyslexic;
            applyAccessSettings(currentAccessSettings);
        });

        accessUnderlineToggle?.addEventListener('click', () => {
            currentAccessSettings.underlineLinks = !currentAccessSettings.underlineLinks;
            applyAccessSettings(currentAccessSettings);
        });

        accessibilityResetButton?.addEventListener('click', () => {
            currentAccessSettings = Object.assign({}, defaultAccessSettings);
            applyAccessSettings(currentAccessSettings);
        });

        feedbackRatingOptions.forEach(option => {
            option.addEventListener('click', () => {
                if (feedbackRequestPending || hasSubmittedFeedback) return;
                selectedFeedbackRating = Number(option.dataset.rating);
                feedbackRatingOptions.forEach(ratingOption => {
                    const rating = Number(ratingOption.dataset.rating);
                    ratingOption.setAttribute('aria-pressed', String(rating === selectedFeedbackRating));
                    ratingOption.classList.toggle('is-active', rating <= selectedFeedbackRating);
                });
                feedbackRatingLabel.textContent = `${selectedFeedbackRating} bintang — ${feedbackRatingLabels[selectedFeedbackRating]}`;
                feedbackStatus.textContent = '';
                feedbackStatus.dataset.state = '';

                if (selectedFeedbackRating === 5) {
                    feedbackCommentWrap.hidden = true;
                    feedbackSubmitButton.disabled = true;
                    submitFeedback();
                    return;
                }

                feedbackCommentWrap.hidden = false;
                feedbackSubmitButton.disabled = !feedbackMessage.value.trim();
                feedbackMessage.focus();
            });
        });

        feedbackMessage?.addEventListener('input', () => {
            updateFeedbackCharacterCount();
            feedbackSubmitButton.disabled = !feedbackMessage.value.trim() || feedbackRequestPending;
            if (feedbackMessage.value.trim()) {
                feedbackStatus.textContent = '';
                feedbackStatus.dataset.state = '';
            }
        });

        const resetFeedbackForm = () => {
            selectedFeedbackRating = null;
            feedbackMessage.value = '';
            updateFeedbackCharacterCount();
            feedbackCommentWrap.hidden = true;
            feedbackSubmitButton.disabled = true;
            feedbackRatingLabel.textContent = 'Pilih bintang 1 sampai 5';
            feedbackRatingOptions.forEach(option => {
                option.setAttribute('aria-pressed', 'false');
                option.classList.remove('is-active');
                option.disabled = false;
            });
        };

        const submitFeedback = async () => {
            if (!selectedFeedbackRating || feedbackRequestPending || hasSubmittedFeedback) return;
            if (selectedFeedbackRating < 5 && !feedbackMessage.value.trim()) {
                feedbackStatus.textContent = 'Mohon isi kritik atau saran sebelum mengirim.';
                feedbackStatus.dataset.state = 'error';
                feedbackMessage.focus();
                return;
            }

            feedbackRequestPending = true;
            feedbackSubmitButton.disabled = true;
            feedbackStatus.textContent = 'Mengirim penilaian...';
            feedbackStatus.dataset.state = 'pending';
            feedbackRatingOptions.forEach(option => { option.disabled = true; });

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
                        message: selectedFeedbackRating < 5 ? feedbackMessage.value.trim() : null
                    })
                });
                const result = await response.json();
                if (!response.ok) throw new Error(result.message || 'Penilaian gagal dikirim.');

                feedbackStatus.textContent = result.message;
                feedbackStatus.dataset.state = 'success';
                resetFeedbackForm();
                hasSubmittedFeedback = true;
                feedbackButton.classList.add('is-submitted');
                feedbackButton.setAttribute('aria-label', 'Anda telah memberikan feedback');
                feedbackButton.title = 'Anda telah memberikan feedback';
                feedbackButton.querySelector('i').classList.replace('fa-regular', 'fa-solid');
                feedbackMessage.disabled = true;
                feedbackSubmitButton.disabled = true;
                feedbackRatingOptions.forEach(option => { option.disabled = true; });
                setFeedbackVisible(false);
            } catch (error) {
                feedbackStatus.textContent = error.message || 'Koneksi gagal. Silakan coba lagi.';
                feedbackStatus.dataset.state = 'error';
                feedbackRatingOptions.forEach(option => { option.disabled = false; });
                feedbackSubmitButton.disabled = selectedFeedbackRating === 5 || !feedbackMessage.value.trim();
            } finally {
                feedbackRequestPending = false;
            }
        };

        feedbackSubmitButton?.addEventListener('click', submitFeedback);

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