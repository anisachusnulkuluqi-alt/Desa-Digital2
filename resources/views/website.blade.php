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
            
            --header-dark-slate: #283548;
            --digital-cyan: #38bdf8;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-canvas); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }

        /* 1. Header shared with the public home page */
        .site-header {
            background: linear-gradient(112deg, #102a43 0%, #155e75 52%, #0f766e 100%);
            padding: 20px clamp(20px, 8.8vw, 128px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: clamp(14px, 2vw, 28px);
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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
            height: 52px;
            width: auto;
            max-width: 160px;
            object-fit: contain;
            display: block;
        }

        /* Teks Logo: "Desa Digital" Persis Gambar */
        .brand-text-logo {
            font-size: 1.45rem;
            letter-spacing: 0;
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
            gap: clamp(8px, 0.75vw, 12px);
            list-style: none; 
            flex-wrap: wrap;
            justify-content: flex-end;
            margin-left: auto;
        }
        .nav-menu a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0;
            position: relative;
            padding: 9px 8px;
            border-radius: 6px;
            transition: color 0.2s ease, background-color 0.2s ease;
        }
        .nav-menu a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.1);
        }
        .nav-menu a.active {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.16);
        }
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

        /* 2. Hero Ringkas & Minimalis */
        .hero-compact {
            background: radial-gradient(ellipse at 82% 18%, rgba(56, 189, 248, 0.18), transparent 35%), linear-gradient(135deg, #102a43 0%, #164e63 58%, #0f766e 100%);
            color: #ffffff;
            padding: 48px 7% 72px;
            text-align: center;
            position: relative;
        }
        .hero-compact h1 {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800;
            letter-spacing: 0;
            margin-bottom: 8px;
        }
        .hero-compact p {
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.76);
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
            border-radius: 9px;
            padding: 9px 12px 9px 38px;
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
            width: 100%;
            color: inherit;
            font: inherit;
            text-align: left;
            cursor: pointer;
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
        .district-item-card:focus-visible {
            outline: 3px solid rgba(2, 132, 199, 0.35);
            outline-offset: 3px;
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

        .filter-bar-minimal {
            padding: 10px 14px;
            border-radius: 12px;
            margin-bottom: 22px;
        }
        .total-distrik-pill {
            padding: 6px 12px;
            border-radius: 9px;
            white-space: nowrap;
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
            border: 1px solid rgba(148, 163, 184, 0.35);
            border-radius: 16px;
            width: 100%;
            max-width: 980px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 28px 80px rgba(15, 23, 42, 0.28);
            overflow: hidden;
            animation: popUp 0.25s ease-out;
        }
        @keyframes popUp {
            from { opacity: 0; transform: scale(0.96); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal-top-bar {
            background: linear-gradient(112deg, #0f766e 0%, #087e8b 55%, #0369a1 100%);
            padding: 18px 22px;
            color: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-heading-copy { min-width: 0; }
        .modal-top-bar h3 {
            font-size: 1.15rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .modal-top-bar h3 span { color: #cffafe; }
        .modal-subtitle {
            margin: 5px 0 0 29px;
            color: rgba(255, 255, 255, 0.78);
            font-size: 0.76rem;
        }
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
            padding: 0 22px 18px;
            overflow-y: auto;
            flex: 1;
        }

        .village-table-head,
        .village-column-grid {
            display: block;
        }

        .village-table-head,
        .village-row-card {
            display: grid;
            grid-template-columns: minmax(210px, 1.25fr) minmax(190px, 1fr) 156px;
            align-items: center;
            column-gap: 18px;
        }

        .village-table-head {
            position: sticky;
            top: 0;
            z-index: 2;
            min-height: 42px;
            padding: 0 12px;
            border-bottom: 1px solid var(--border-soft);
            background: #ffffff;
            color: #64748b;
            font-size: 0.66rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .village-row-card:hover {
            background: #f8fbfc;
        }
        .village-row-card {
            min-height: 58px;
            padding: 9px 12px;
            border-bottom: 1px solid #e8eef2;
            transition: background-color 0.18s ease;
        }

        .village-name-cell { min-width: 0; }
        .village-name-cell h4 {
            overflow: hidden;
            color: #0f5f8f;
            font-size: 0.84rem;
            font-weight: 800;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .village-name-meta {
            display: flex;
            align-items: center;
            gap: 7px;
            margin-top: 4px;
            color: var(--text-muted);
            font-size: 0.68rem;
        }
        .type-tag {
            display: inline-block;
            padding: 2px 7px;
            border-radius: 999px;
            background: #ecfdf5;
            color: #047857;
            font-size: 0.62rem;
            font-weight: 800;
        }
        .code-tag {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .village-website-cell {
            display: flex;
            align-items: center;
            min-width: 0;
        }
        .link-web-desa {
            display: inline-flex;
            align-items: center;
            min-width: 0;
            gap: 7px;
            color: #475569;
            font-size: 0.76rem;
            text-decoration: none;
        }
        .link-web-desa i { color: #0891b2; }
        .website-domain {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .link-web-desa:hover { color: #0369a1; }
        .missing-link {
            color: #94a3b8;
            font-size: 0.74rem;
        }
        .sosmed-pill-cluster {
            display: flex;
            justify-content: flex-start;
            gap: 5px;
        }
        .btn-sosmed-mini {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            border-radius: 8px;
            color: var(--social-color);
            font-size: 0.88rem;
            text-decoration: none;
            transition: background-color 0.18s ease, transform 0.18s ease;
        }
        .btn-sosmed-mini:hover {
            background: color-mix(in srgb, var(--social-color) 12%, white);
            transform: translateY(-2px);
        }
        .btn-sosmed-mini.ig { --social-color: #d94676; }
        .btn-sosmed-mini.fb { --social-color: #1877f2; }
        .btn-sosmed-mini.yt { --social-color: #e11d48; }
        .btn-sosmed-mini.tt { --social-color: #111827; }
        .social-empty {
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            color: #cbd5e1;
            font-size: 0.88rem;
        }
        .empty-state {
            grid-column: 1 / -1;
            padding: 28px;
            color: var(--text-muted);
            text-align: center;
        }
        @media (max-width: 960px) {
            .district-grid-clean { grid-template-columns: repeat(2, 1fr); }
            .site-header { flex-wrap: wrap; gap: 12px 20px; padding-inline: 5%; }
            .nav-menu {
                order: 3;
                flex: 0 0 100%;
                justify-content: center;
                gap: 6px;
                margin-left: 0;
            }
            .nav-menu a { padding: 8px 6px; font-size: 0.74rem; }
        }
        @media (max-width: 640px) {
            .district-grid-clean { grid-template-columns: 1fr; }
            .site-header { padding: 10px 14px; gap: 10px 12px; }
            .brand-link-clean { gap: 8px; }
            .brand-logo-icon { height: 40px; max-width: 64px; }
            .brand-text-logo { font-size: 1.15rem; }
            .nav-menu { gap: 7px 12px; }
            .nav-menu a { padding: 7px 5px; font-size: 0.68rem; }
            .filter-bar-minimal { align-items: stretch; gap: 9px; }
            .search-input-wrap { flex-basis: 100%; max-width: none; }
            .total-distrik-pill { align-self: flex-start; font-size: 0.7rem; }
            .hero-compact { padding: 38px 20px 60px; }
            .content-wrap { padding-inline: 16px; }
            .district-item-card { padding: 16px; }
            .card-identity { gap: 10px; }
            .card-text h3 { font-size: 0.96rem; }
            .modal-drawer-overlay { padding: 10px; }
            .modal-drawer-card { max-height: 94vh; }
            .modal-top-bar { padding: 15px 16px; }
            .modal-body-scroll { padding: 0 12px 12px; }
            .village-table-head { display: none; }
            .village-row-card {
                grid-template-columns: minmax(0, 1fr) auto;
                gap: 6px 10px;
                padding: 12px 8px;
            }
            .village-name-cell { grid-column: 1 / -1; }
            .village-website-cell { grid-column: 1; }
            .sosmed-pill-cluster { grid-column: 2; grid-row: 2; }
            .btn-sosmed-mini, .social-empty { width: 26px; height: 28px; }
        }
        @media (max-width: 900px) and (orientation: portrait) {
            .site-header { position: sticky; flex-wrap: nowrap; }
            .menu-toggle { display: grid; margin-left: auto; flex: 0 0 42px; }
            .nav-menu {
                display: none;
                position: absolute;
                top: calc(100% + 8px);
                right: 14px;
                z-index: 101;
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

        <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="primary-navigation">
            <i class="fa-solid fa-bars" aria-hidden="true"></i>
        </button>

        <ul class="nav-menu" id="primary-navigation">
            <li><a href="{{ url('/#hero-banner') }}" class="active">BERANDA</a></li>
            <li><a href="{{ url('/#tentang-kami') }}">TENTANG KAMI</a></li>
            <li><a href="{{ url('/#layanan-digital') }}">LAYANAN</a></li>
            <li><a href="{{ url('/#hubungi-kami') }}">HUBUNGI KAMI</a></li>
        </ul>

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

    <!-- 2. Hero Ringkas & Minimalis -->
    <section class="hero-compact">
        <h1>Direktori Website Desa & Kelurahan</h1>
        <p>Data wilayah terhubung langsung dengan basis data Kabupaten Tuban.</p>
    </section>

    <main class="content-wrap">
        <div class="filter-bar-minimal">
            <div class="search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" id="searchInput" placeholder="Cari kecamatan atau desa..." oninput="handleSearch(this.value)" aria-label="Cari kecamatan atau desa">
            </div>
            <div class="total-distrik-pill" id="counterBadge">
                <i class="fa-solid fa-circle-check" style="color: var(--emerald);"></i>
                <span>{{ number_format($kecamatans->count()) }} Kecamatan · {{ number_format($totalWebsiteAktif) }} Website · {{ number_format($kecamatans->sum('desa_count')) }} Wilayah</span>
            </div>
        </div>

        <div class="district-grid-clean" id="gridDistrik">
            @forelse ($kecamatans as $item)
                @php
                    $villageData = $item->desa->map(fn ($desa) => [
                        'nama' => $desa->nama_desa,
                        'jenis' => $desa->jenis,
                        'kode' => $desa->kode_desa,
                        'website' => $desa->website,
                        'instagram' => $desa->instagram,
                        'facebook' => $desa->facebook,
                        'youtube' => $desa->youtube,
                        'tiktok' => $desa->tiktok,
                        'whatsapp' => $desa->whatsapp,
                    ])->values();
                    $websiteCount = $item->desa->filter(fn ($desa) => filled($desa->website))->count();
                    $searchText = strtolower($item->nama_kecamatan . ' ' . $item->desa->pluck('nama_desa')->implode(' '));
                @endphp
                <button type="button" class="district-item-card"
                        data-name="{{ $searchText }}"
                        data-kecamatan="{{ $item->nama_kecamatan }}"
                        data-kode="{{ filled($item->kode_wilayah) ? $item->kode_wilayah : 'Belum tersedia' }}"
                        data-total="{{ $item->desa_count }}"
                        data-websites="{{ $websiteCount }}"
                        data-villages="{{ $villageData->toJson() }}">
                    <div class="card-identity">
                        <div class="card-icon-round">
                            <img src="{{ asset('images/logo-tuban.png') }}" alt="" aria-hidden="true"
                                 onerror="this.onerror=null; this.src='{{ asset('images/desa-digital.png') }}';">
                        </div>
                        <div class="card-text">
                            <h3>Kecamatan {{ $item->nama_kecamatan }}</h3>
                            <small>Kode: {{ filled($item->kode_wilayah) ? $item->kode_wilayah : 'Belum tersedia' }}</small>
                        </div>
                    </div>

                    <div class="card-action-cue">
                        <span class="badge-count">{{ number_format($item->desa_count) }} Wilayah</span>
                        <i class="fa-solid fa-arrow-right btn-arrow-cue"></i>
                    </div>
                </button>
            @empty
                <p class="empty-state">Data kecamatan belum tersedia.</p>
            @endforelse
        </div>
    </main>

    <!-- 4. Modal Kolom Data Desa / Kelurahan Saat Kartu Diklik -->
    <div class="modal-drawer-overlay" id="villageModal" role="dialog" aria-modal="true" aria-labelledby="modalKecamatanTitle" onclick="checkCloseOutside(event)">
        <div class="modal-drawer-card">
            
            <div class="modal-top-bar">
                <div class="modal-heading-copy">
                    <h3 id="modalKecamatanTitle">
                        <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                        <span>-</span>
                    </h3>
                    <p class="modal-subtitle" id="modalKecamatanSubtitle">Daftar desa dan kelurahan</p>
                </div>
                <button type="button" class="btn-close-modal" onclick="closeVillageModal()">&times;</button>
            </div>

            <div class="modal-body-scroll">
                <div class="village-table-head" aria-hidden="true">
                    <span>Nama Desa/Kelurahan</span>
                    <span>Website</span>
                    <span>Sosial Media</span>
                </div>
                <div class="village-column-grid" id="villageRowsGrid" role="list">
                </div>

            </div>
        </div>
    </div>

    <!-- Script Filter & Interaksi Klik Kolom -->
    <script>
        const searchFromUrl = new URLSearchParams(window.location.search).get('search') || '';
        const districtCards = document.querySelectorAll('.district-item-card');
        const defaultCountLabel = document.querySelector('#counterBadge span').textContent;
        let lastOpenedCard = null;

        function handleSearch(val) {
            const query = val.toLowerCase().trim();
            let count = 0;

            districtCards.forEach(card => {
                const matches = card.dataset.name.includes(query);
                card.style.display = matches ? 'flex' : 'none';
                count += Number(matches);
            });

            const countLabel = document.querySelector('#counterBadge span');
            countLabel.textContent = query
                ? `${count} dari ${districtCards.length} kecamatan`
                : defaultCountLabel;
        }

        if (searchFromUrl) {
            document.getElementById('searchInput').value = searchFromUrl;
            handleSearch(searchFromUrl);
        }

        districtCards.forEach(card => {
            card.addEventListener('click', () => {
                lastOpenedCard = card;
                showVillageDrawer(
                    card.dataset.kecamatan,
                    card.dataset.kode,
                    Number(card.dataset.total),
                    Number(card.dataset.websites),
                    JSON.parse(card.dataset.villages)
                );
            });
        });

        function createTextElement(tag, className, text) {
            const element = document.createElement(tag);
            element.className = className;
            element.textContent = text || '';
            return element;
        }

        function safeExternalUrl(value) {
            if (!value || !value.trim()) return null;

            try {
                const normalizedValue = /^https?:\/\//i.test(value) ? value : `https://${value}`;
                const url = new URL(normalizedValue);
                return ['http:', 'https:'].includes(url.protocol) ? url.href : null;
            } catch {
                return null;
            }
        }

        function createExternalLink(url, className, title, iconClass) {
            const link = document.createElement('a');
            link.className = className;
            link.href = url;
            link.target = '_blank';
            link.rel = 'noopener noreferrer';
            link.title = title;
            link.setAttribute('aria-label', title);

            const icon = document.createElement('i');
            icon.className = iconClass;
            icon.setAttribute('aria-hidden', 'true');
            link.appendChild(icon);
            return link;
        }

        function showVillageDrawer(namaKec, kodeKec, totalDesa, websiteCount, villageList) {
            document.querySelector('#modalKecamatanTitle span').textContent = namaKec;
            document.getElementById('modalKecamatanSubtitle').textContent = `${totalDesa} wilayah · ${websiteCount} website terdaftar`;

            const grid = document.getElementById('villageRowsGrid');
            grid.replaceChildren();

            if (villageList.length === 0) {
                grid.appendChild(createTextElement('p', 'empty-state', 'Belum ada data desa atau kelurahan untuk kecamatan ini.'));
            }

            villageList.forEach(item => {
                const card = document.createElement('div');
                card.className = 'village-row-card';
                card.setAttribute('role', 'listitem');

                const nameCell = document.createElement('div');
                nameCell.className = 'village-name-cell';
                nameCell.appendChild(createTextElement('h4', '', item.nama));
                const nameMeta = document.createElement('div');
                nameMeta.className = 'village-name-meta';
                nameMeta.append(
                    createTextElement('span', 'type-tag', item.jenis || 'Wilayah'),
                    createTextElement('span', 'code-tag', item.kode || 'Kode belum tersedia')
                );
                nameCell.appendChild(nameMeta);

                const websiteCell = document.createElement('div');
                websiteCell.className = 'village-website-cell';
                const websiteUrl = safeExternalUrl(item.website);
                if (websiteUrl) {
                    const websiteLink = createExternalLink(websiteUrl, 'link-web-desa', 'Buka website ' + item.nama, 'fa-solid fa-globe');
                    const domain = new URL(websiteUrl).hostname.replace(/^www\./, '');
                    websiteLink.appendChild(createTextElement('span', 'website-domain', domain));
                    websiteCell.appendChild(websiteLink);
                } else {
                    websiteCell.appendChild(createTextElement('span', 'missing-link', 'Belum tersedia'));
                }

                const socialLinks = document.createElement('div');
                socialLinks.className = 'sosmed-pill-cluster';
                const socialPlatforms = [
                    ['instagram', 'Instagram', 'fa-brands fa-instagram', 'ig'],
                    ['facebook', 'Facebook', 'fa-brands fa-facebook-f', 'fb'],
                    ['youtube', 'YouTube', 'fa-brands fa-youtube', 'yt'],
                    ['tiktok', 'TikTok', 'fa-brands fa-tiktok', 'tt'],
                ];

                socialPlatforms.forEach(([field, label, icon, style]) => {
                    const url = safeExternalUrl(item[field]);
                    if (url) {
                        socialLinks.appendChild(createExternalLink(url, `btn-sosmed-mini ${style}`, label + ' ' + item.nama, icon));
                    } else {
                        const placeholder = document.createElement('span');
                        placeholder.className = 'social-empty';
                        placeholder.title = `${label} belum tersedia`;
                        placeholder.setAttribute('aria-label', `${label} belum tersedia`);
                        const platformIcon = document.createElement('i');
                        platformIcon.className = icon;
                        platformIcon.setAttribute('aria-hidden', 'true');
                        placeholder.appendChild(platformIcon);
                        socialLinks.appendChild(placeholder);
                    }
                });

                const whatsappNumber = (item.whatsapp || '').replace(/\D/g, '').replace(/^0/, '62');
                if (whatsappNumber) {
                    socialLinks.appendChild(createExternalLink(`https://wa.me/${whatsappNumber}`, 'btn-sosmed-mini wa', 'WhatsApp ' + item.nama, 'fa-brands fa-whatsapp'));
                } else {
                    const whatsappPlaceholder = document.createElement('span');
                    whatsappPlaceholder.className = 'social-empty';
                    whatsappPlaceholder.title = 'WhatsApp belum tersedia';
                    whatsappPlaceholder.setAttribute('aria-label', 'WhatsApp belum tersedia');
                    const whatsappIcon = document.createElement('i');
                    whatsappIcon.className = 'fa-brands fa-whatsapp';
                    whatsappIcon.setAttribute('aria-hidden', 'true');
                    whatsappPlaceholder.appendChild(whatsappIcon);
                    socialLinks.appendChild(whatsappPlaceholder);
                }

                card.append(nameCell, websiteCell, socialLinks);
                grid.appendChild(card);
            });

            document.getElementById('villageModal').style.display = 'flex';
            document.querySelector('.btn-close-modal').focus();
        }

        function closeVillageModal() {
            document.getElementById('villageModal').style.display = 'none';
            lastOpenedCard?.focus();
        }

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && document.getElementById('villageModal').style.display === 'flex') {
                closeVillageModal();
            }
        });

        function checkCloseOutside(e) {
            if (e.target.id === 'villageModal') {
                closeVillageModal();
            }
        }
    </script>
</body>
</html>