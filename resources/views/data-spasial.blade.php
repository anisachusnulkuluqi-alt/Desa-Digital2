<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geoportal Spasial Modern - Desa Digital Tuban</title>

    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Leaflet JS & CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        :root {
            --primary: #0284c7;
            --primary-vivid: #0ea5e9;
            --emerald: #10b981;
            --amber: #f59e0b;
            --violet: #8b5cf6;
            --rose: #f43f5e;
            --cyan: #06b6d4;
            --dark-surface: #0f172a;
            --card-glass: rgba(255, 255, 255, 0.94);
            --border-glass: rgba(226, 232, 240, 0.9);
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            width: 100vw;
            height: 100vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            background: #0f172a;
        }

        .main-navbar {
            position: fixed;
            inset: 0 0 auto;
            height: 82px;
            z-index: 1100;
            background: #ffffff;
            padding: 14px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .brand-logo-img {
            width: auto;
            height: 40px;
            max-width: 140px;
            object-fit: contain;
        }

        .brand-title-text {
            color: #0f172a;
            font-size: 1.28rem;
            font-weight: 800;
        }

        .brand-title-text span { color: #0284c7; }

        .navbar-nav-cluster {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-links-menu {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }

        .nav-links-menu a {
            color: #475569;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-decoration: none;
            text-transform: uppercase;
        }

        .nav-links-menu a:hover,
        .nav-links-menu a.active { color: #0284c7; }

        .search-pill-nav {
            display: flex;
            align-items: center;
            width: 220px;
            padding: 6px 14px;
            background: #f1f5f9;
            border: 1.5px solid #cbd5e1;
            border-radius: 40px;
        }

        .search-pill-nav input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            color: #0f172a;
            font-size: 0.82rem;
        }

        .search-pill-nav button {
            border: none;
            background: transparent;
            color: #64748b;
            cursor: pointer;
        }

        .site-footer {
            position: fixed;
            inset: auto 0 0;
            z-index: 1100;
            padding: 12px 7%;
            background: #0f172a;
            color: #94a3b8;
            font-size: 0.72rem;
            text-align: center;
        }

        /* 1. TOP FLOATING APP BAR */
        .gmaps-floating-header {
            position: absolute;
            top: 98px;
            left: 16px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 680px;
            width: calc(100% - 32px);
            pointer-events: none;
        }

        .search-pill-box {
            background: var(--card-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            border-radius: 28px;
            padding: 6px 10px 6px 16px;
            display: flex;
            align-items: center;
            box-shadow: 0 14px 30px -6px rgba(15, 23, 42, 0.22);
            gap: 10px;
            pointer-events: auto;
        }

        .btn-brand-menu {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1rem;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(2, 132, 199, 0.35);
        }

        .search-pill-box input {
            flex: 1;
            border: none;
            outline: none;
            background: transparent;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        .search-pill-box input::placeholder {
            color: #94a3b8;
            font-weight: 500;
        }

        .search-action-btn {
            background: #f1f5f9;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
        }

        .search-action-btn:hover {
            background: #e2e8f0;
            color: var(--text-dark);
        }

        .category-chips-row {
            display: flex;
            flex-direction: column;
            gap: 7px;
            padding: 0;
            pointer-events: auto;
            order: 5;
        }

        .map-filter-panel {
            background: var(--card-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            border-radius: 16px;
            padding: 10px;
            box-shadow: 0 14px 30px -6px rgba(15, 23, 42, 0.2);
            pointer-events: auto;
            display: flex;
            flex-direction: column;
        }

        .location-filter-title {
            order: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 8px;
            color: #475569;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .location-section-title {
            padding: 10px 4px 6px;
            border-top: 1px solid #cbd5e1;
            color: #64748b;
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        .location-filter-option {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 8px;
            border-radius: 8px;
            color: #1e293b;
            cursor: pointer;
            font-size: 0.76rem;
            font-weight: 700;
        }

        .location-filter-option:hover { background: #f1f5f9; }

        .location-filter-option input {
            width: 15px;
            height: 15px;
            accent-color: var(--primary);
            cursor: pointer;
        }

        .chip-btn {
            background: var(--card-glass);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 0.76rem;
            font-weight: 700;
            color: #1e293b;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            white-space: nowrap;
            transition: all 0.2s;
        }

        .chip-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.14);
        }

        .chip-btn.active {
            background: #0f172a;
            color: #ffffff;
            border-color: #0f172a;
        }

        .chip-dot {
            width: 9px;
            height: 9px;
            border-radius: 50%;
        }

        /* 2. MAP CANVAS */
        #map {
            position: absolute;
            inset: 82px 0 40px;
            z-index: 1;
        }

        /* 3. FLOATING CONTROLS */
        .gmaps-controls-right {
            position: absolute;
            top: 100px;
            right: 16px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: flex-end;
        }

        .map-tool-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .map-tool-row .control-bubble {
            flex-direction: row;
        }

        .control-bubble {
            background: var(--card-glass);
            backdrop-filter: blur(14px);
            border: 1px solid var(--border-glass);
            border-radius: 14px;
            box-shadow: 0 10px 25px -4px rgba(15, 23, 42, 0.18);
            padding: 6px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .tool-btn {
            width: 42px;
            height: 42px;
            border: none;
            background: transparent;
            border-radius: 10px;
            color: #334155;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }

        .tool-btn:hover {
            background: #f1f5f9;
            color: var(--primary);
        }

        .tool-btn.active {
            background: #e0f2fe;
            color: var(--primary);
        }

        .layer-control-panel {
            width: 100%;
            order: 3;
            padding: 0 4px 0;
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 0.78rem;
        }

        .location-filter-title + .location-section-title { order: 2; }
        .layer-control-panel + .location-section-title { order: 4; }

        .layer-panel-title {
            font-size: 0.72rem;
            font-weight: 800;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .layer-checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .layer-checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-weight: 600;
            color: #1e293b;
        }

        .layer-checkbox-row input {
            accent-color: var(--primary);
            cursor: pointer;
            width: 15px;
            height: 15px;
        }

        .color-badge-preview {
            width: 14px;
            height: 10px;
            border-radius: 3px;
            border: 1px solid rgba(0, 0, 0, 0.25);
            display: inline-block;
        }

        /* 4. BOTTOM DRAWER */
        .bottom-table-drawer {
            position: absolute;
            bottom: 40px;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            border-top: 1.5px solid #cbd5e1;
            box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.2);
            z-index: 1001;
            transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(calc(100% - 50px));
            display: flex;
            flex-direction: column;
            max-height: 52vh;
        }

        .bottom-table-drawer.open {
            transform: translateY(0);
        }

        .drawer-handle-bar {
            height: 50px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
        }

        .drawer-grabber {
            width: 44px;
            height: 5px;
            background: #cbd5e1;
            border-radius: 4px;
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
        }

        .drawer-title-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .drawer-title-group h3 {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .counter-badge {
            background: #e0f2fe;
            color: #0369a1;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 800;
        }

        .drawer-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .table-filter-select {
            padding: 6px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #334155;
            outline: none;
            background: #ffffff;
        }

        .btn-drawer-toggle {
            background: #f1f5f9;
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            font-size: 0.85rem;
        }

        .drawer-table-content {
            flex: 1;
            overflow-y: auto;
            padding: 12px 24px 20px 24px;
        }

        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.82rem;
            text-align: left;
        }

        .modern-table th {
            background: #f8fafc;
            padding: 10px 14px;
            font-weight: 700;
            color: #475569;
            border-bottom: 1.5px solid #e2e8f0;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .modern-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            font-weight: 500;
        }

        .modern-table tr:hover td {
            background: #f0f9ff;
            cursor: pointer;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .btn-focus-map {
            background: #0284c7;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.74rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-focus-map:hover { background: #0369a1; }

        /* 5. POPUP */
        .leaflet-popup-content-wrapper {
            border-radius: 18px;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.35);
            border: 1px solid #cbd5e1;
        }

        .leaflet-popup-content {
            margin: 0;
            width: 290px !important;
        }

        .card-popup-banner {
            height: 85px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.2rem;
        }

        .card-popup-body { padding: 16px 18px; }

        .popup-badge {
            display: inline-block;
            font-size: 0.68rem;
            font-weight: 800;
            padding: 3px 8px;
            border-radius: 6px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .card-popup-body h4 {
            font-size: 1.05rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 4px;
        }

        .card-popup-body p {
            font-size: 0.8rem;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 14px;
        }

        .popup-route-btn {
            width: 100%;
            background: #0f172a;
            color: #ffffff !important;
            padding: 10px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 700;
            text-decoration: none;
        }

        .popup-route-btn:hover { background: #0284c7; }

        @media (max-width: 768px) {
            .gmaps-floating-header { max-width: calc(100% - 32px); }
            .main-navbar { padding: 14px 5%; }
            .navbar-nav-cluster { display: none; }
            .site-footer { padding: 10px 4%; font-size: 0.65rem; }
        }
    </style>
</head>
<body>

    <nav class="main-navbar">
        <a href="{{ url('/') }}" class="navbar-brand-link">
            <img src="{{ asset('images/desa-digital.png') }}"
                 alt="Logo Desa Digital"
                 class="brand-logo-img"
                 onerror="this.onerror=null; this.style.display='none'; document.getElementById('altLogoText').style.display='inline';">
            <span id="altLogoText" class="brand-title-text" style="display: none;">Desa<span>Digital</span></span>
        </a>

        <div class="navbar-nav-cluster">
            <ul class="nav-links-menu">
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/#tentang-kami') }}">Tentang Kami</a></li>
                <li><a href="{{ url('/#statistik-wilayah') }}">Statistik</a></li>
                <li><a href="{{ url('/#layanan-digital') }}">Layanan</a></li>
                <li><a href="{{ url('/data-spasial') }}" class="active">Peta Spasial</a></li>
                <li><a href="{{ url('/#lokasi-kami') }}">Hubungi Kami</a></li>
            </ul>

            <form class="search-pill-nav" action="{{ url('/desa') }}" method="GET">
                <input type="text" name="search" placeholder="Cari desa / modul...">
                <button type="submit" title="Cari"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
    </nav>

    <!-- TOP BAR -->
    <div class="gmaps-floating-header">
        <div class="search-pill-box">
            <a href="{{ url('/') }}" class="btn-brand-menu" title="Kembali ke Beranda">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <input type="text" id="liveSearchInput" placeholder="Cari nama kantor desa, titik WiFi, pasar, wisata..." oninput="handleSearch(this.value)">
            <button class="search-action-btn" title="Cari Lokasi" onclick="handleSearch(document.getElementById('liveSearchInput').value)">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <button class="search-action-btn" title="Buka Tabel Data" onclick="toggleDrawer()">
                <i class="fa-solid fa-table-list"></i>
            </button>
        </div>

    </div>

    <!-- MAP CONTAINER -->
    <div id="map"></div>

    <!-- FLOATING CONTROLS (KANAN) -->
    <div class="gmaps-controls-right">
        <div class="map-tool-row">
            <div class="control-bubble">
                <button class="tool-btn active" id="btnOsm" onclick="setBaseMap('osm')" title="Peta Vektor Standar">
                    <i class="fa-solid fa-map"></i>
                </button>
                <button class="tool-btn" id="btnSat" onclick="setBaseMap('sat')" title="Citra Satelit Google">
                    <i class="fa-solid fa-earth-asia"></i>
                </button>
                <button class="tool-btn" id="btnDark" onclick="setBaseMap('dark')" title="Mode Malam">
                    <i class="fa-solid fa-moon"></i>
                </button>
            </div>

            <div class="control-bubble">
                <button class="tool-btn" onclick="geoLocateMe()" title="Lokasi Saya Saat Ini">
                    <i class="fa-solid fa-crosshairs"></i>
                </button>
                <button class="tool-btn" onclick="resetViewTuban()" title="Fokuskan ke Kabupaten Tuban">
                    <i class="fa-solid fa-compress"></i>
                </button>
                <button class="tool-btn" onclick="toggleDrawer()" title="Tampilkan Tabel Data">
                    <i class="fa-solid fa-list-check"></i>
                </button>
            </div>
        </div>

        <div class="map-filter-panel">
            <div class="location-filter-title">
                <span>Legenda</span>
                <i class="fa-solid fa-map-pin" style="color: var(--primary);"></i>
            </div>

            <div class="location-section-title">Batas Wilayah</div>

            <div class="layer-control-panel">
                <div class="layer-checkbox-group">
                    <label class="layer-checkbox-row">
                        <input type="checkbox" id="layerKabupaten" checked onchange="toggleLayer('kabupaten', this.checked)">
                        <span class="color-badge-preview" style="background: #dc2626;"></span>
                        <span>Batas Kabupaten</span>
                    </label>
                    <label class="layer-checkbox-row">
                        <input type="checkbox" id="layerKecamatan" checked onchange="toggleLayer('kecamatan', this.checked)">
                        <span class="color-badge-preview" style="background: #0284c7;"></span>
                        <span>Layer Kecamatan</span>
                    </label>
                    <label class="layer-checkbox-row">
                        <input type="checkbox" id="layerDesa" checked onchange="toggleLayer('desa', this.checked)">
                        <span class="color-badge-preview" style="background: #10b981;"></span>
                        <span>Layer Desa / Kelurahan</span>
                    </label>
                </div>
            </div>

            <div class="location-section-title">Lokasi</div>

            <div class="category-chips-row">
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-all" checked onchange="filterOnlyCategory('all', this)">
                    <i class="fa-solid fa-layer-group"></i> Semua Data
                </label>
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-wifi" onchange="filterOnlyCategory('wifi', this)">
                    <span class="chip-dot" style="background: var(--primary-vivid);"></span> WiFi Desa
                </label>
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-kantor" onchange="filterOnlyCategory('kantor', this)">
                    <span class="chip-dot" style="background: var(--amber);"></span> Kantor Desa
                </label>
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-pasar" onchange="filterOnlyCategory('pasar', this)">
                    <span class="chip-dot" style="background: var(--emerald);"></span> Pasar Desa
                </label>
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-wisata" onchange="filterOnlyCategory('wisata', this)">
                    <span class="chip-dot" style="background: var(--cyan);"></span> Wisata Desa
                </label>
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-bumdes" onchange="filterOnlyCategory('bumdes', this)">
                    <span class="chip-dot" style="background: var(--violet);"></span> BUMDes
                </label>
                <label class="location-filter-option">
                    <input type="checkbox" id="chip-kkdmp" onchange="filterOnlyCategory('kkdmp', this)">
                    <span class="chip-dot" style="background: var(--rose);"></span> KKDMP
                </label>
            </div>

        </div>

    </div>

    <!-- BOTTOM DRAWER TABLE -->
    <div class="bottom-table-drawer" id="bottomDrawer">
        <div class="drawer-handle-bar" onclick="toggleDrawer()">
            <div class="drawer-grabber"></div>
            <div class="drawer-title-group">
                <h3>
                    <i class="fa-solid fa-database" style="color: var(--primary);"></i>
                    Direktori Data Spasial Terpadu
                </h3>
                <span class="counter-badge" id="tableCounterBadge">Memuat Data...</span>
            </div>

            <div class="drawer-actions-right" onclick="event.stopPropagation()">
                <select class="table-filter-select" id="kecamatanFilter" onchange="applyKecamatanFilter(this.value)">
                    <option value="">Semua Kecamatan</option>
                    <option value="Tuban">Kecamatan Tuban</option>
                    <option value="Jenu">Kecamatan Jenu</option>
                    <option value="Palang">Kecamatan Palang</option>
                    <option value="Semanding">Kecamatan Semanding</option>
                    <option value="Merakurak">Kecamatan Merakurak</option>
                    <option value="Rengel">Kecamatan Rengel</option>
                    <option value="Singgahan">Kecamatan Singgahan</option>
                    <option value="Bancar">Kecamatan Bancar</option>
                    <option value="Kenduruan">Kecamatan Kenduruan</option>
                    <option value="Jatirogo">Kecamatan Jatirogo</option>
                    <option value="Bangilan">Kecamatan Bangilan</option>
                </select>

                <button class="btn-drawer-toggle" onclick="toggleDrawer()">
                    <i class="fa-solid fa-chevron-up" id="drawerChevron"></i>
                </button>
            </div>
        </div>

        <div class="drawer-table-content">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Nama Entitas / Fasilitas</th>
                        <th>Kecamatan</th>
                        <th>Desa / Dusun</th>
                        <th>Status Layanan</th>
                        <th>Aksi Navigasi</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
    </div>

    <footer class="site-footer">
        <p>&copy; 2026 Pemerintah Kabupaten Tuban • Dinas Komunikasi, Informatika, Statistik dan Persandian. Seluruh hak cipta dilindungi.</p>
    </footer>

    <script>
        // Inisialisasi Peta Tuban
        const tubanCenter = [-6.9150, 111.9500];
        const map = L.map('map', { zoomControl: false }).setView(tubanCenter, 11);
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // Tile Base Layer
        const tileOsm  = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 });
        const tileSat  = L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', { maxZoom: 20 });
        const tileDark = L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', { maxZoom: 19 });
        tileOsm.addTo(map);

        function setBaseMap(type) {
            document.querySelectorAll('.control-bubble .tool-btn').forEach(b => b.classList.remove('active'));
            map.removeLayer(tileOsm);
            map.removeLayer(tileSat);
            map.removeLayer(tileDark);

            if (type === 'osm') {
                tileOsm.addTo(map);
                document.getElementById('btnOsm').classList.add('active');
            } else if (type === 'sat') {
                tileSat.addTo(map);
                document.getElementById('btnSat').classList.add('active');
            } else if (type === 'dark') {
                tileDark.addTo(map);
                document.getElementById('btnDark').classList.add('active');
            }
        }

        function resetViewTuban() {
            map.flyTo(tubanCenter, 11, { duration: 1.2 });
        }

        function geoLocateMe() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(pos => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;
                    map.flyTo([lat, lng], 14, { duration: 1.5 });
                    L.circleMarker([lat, lng], {
                        radius: 8,
                        fillColor: '#0284c7',
                        color: '#ffffff',
                        weight: 3,
                        fillOpacity: 1
                    }).addTo(map).bindPopup('<b>Posisi Anda Saat Ini</b>').openPopup();
                });
            }
        }

        // Wadah Layer Poligon GeoJSON
        const layers = {
            kabupaten: L.layerGroup().addTo(map),
            kecamatan: L.layerGroup().addTo(map),
            desa: L.layerGroup().addTo(map)
        };

        map.createPane('desaPane');
        map.getPane('desaPane').style.zIndex = 450;

        function toggleLayer(name, isChecked) {
            if (isChecked) {
                map.addLayer(layers[name]);
            } else {
                map.removeLayer(layers[name]);
            }
        }

        // Pemuatan GeoJSON
        fetch("{{ asset('geojson/kabupaten.geojson') }}")
            .then(res => res.json())
            .then(data => {
                L.geoJSON(data, {
                    style: {
                        color: '#dc2626',
                        weight: 3,
                        dashArray: '6, 6',
                        fillColor: '#ef4444',
                        fillOpacity: 0.05
                    },
                    onEachFeature: (feature, layer) => {
                        const nama = feature.properties?.nm_dati2 || 'Kabupaten Tuban';
                        layer.bindPopup(`<b>Wilayah:</b> ${nama}`);
                    }
                }).addTo(layers.kabupaten);
            }).catch(e => console.error("Gagal muat kabupaten.geojson:", e));

        fetch("{{ asset('geojson/kecamatan.geojson') }}")
            .then(res => res.json())
            .then(data => {
                L.geoJSON(data, {
                    style: (feature) => {
                        const colors = ['#0284c7', '#8b5cf6', '#10b981', '#f59e0b', '#06b6d4', '#ec4899'];
                        const randomColor = colors[Math.floor(Math.random() * colors.length)];
                        return {
                            color: '#0284c7',
                            weight: 2,
                            fillColor: randomColor,
                            fillOpacity: 0.22
                        };
                    },
                    onEachFeature: (feature, layer) => {
                        const nama = feature.properties?.nm_kecamatan || 'Kecamatan';
                        layer.bindPopup(`<b>Kecamatan:</b> ${nama}`);
                    }
                }).addTo(layers.kecamatan);
            }).catch(e => console.error("Gagal muat kecamatan.geojson:", e));

        fetch("{{ asset('geojson/desa.geojson') }}")
            .then(res => res.json())
            .then(data => {
                L.geoJSON(data, {
                    pane: 'desaPane',
                    style: {
                        color: '#10b981',
                        weight: 1.2,
                        dashArray: '3, 4',
                        fillColor: '#10b981',
                        fillOpacity: 0.2
                    },
                    onEachFeature: (feature, layer) => {
                        const desa = feature.properties?.nm_kelurahan || 'Desa';
                        layer.bindPopup(`<b>Desa/Kelurahan:</b> ${desa}`);
                        layer.on({
                            mouseover: event => {
                                event.target.setStyle({
                                    color: '#047857',
                                    weight: 3,
                                    fillColor: '#34d399',
                                    fillOpacity: 0.45
                                });
                                event.target.bringToFront();
                            },
                            mouseout: event => {
                                event.target.setStyle({
                                    color: '#10b981',
                                    weight: 1.2,
                                    fillColor: '#10b981',
                                    fillOpacity: 0.2
                                });
                            }
                        });
                    }
                }).addTo(layers.desa);
            }).catch(e => console.error("Gagal muat desa.geojson:", e));

        const spatialSources = {
            wifi: '{{ asset('geojson/wifi.geojson') }}',
            kantor: '{{ asset('geojson/kantor.geojson') }}',
            pasar: '{{ asset('geojson/pasar.geojson') }}',
            wisata: '{{ asset('geojson/wisata.geojson') }}',
            bumdes: '{{ asset('geojson/bumdes.geojson') }}',
            kkdmp: '{{ asset('geojson/kkdmp.geojson') }}'
        };

        let databaseSpasial = [];

        function normalizeSpatialFeature(feature, type) {
            const properties = feature.properties || {};
            const [lng, lat] = feature.geometry?.coordinates || [];
            const address = properties.alamat || '';
            const kecMatch = address.match(/\bKec(?:amatan)?\.?\s+([^,]+)/i);

            return {
                id: `${type}-${feature.id ?? properties.FID}`,
                type,
                name: properties.nama_ssid || properties.nama_pasar || properties.nama_wisat || properties.nama || 'Lokasi tanpa nama',
                kec: properties.kecamatan || (kecMatch ? kecMatch[1].trim() : ''),
                desa: properties.nama_desa || properties.kelurahan || properties.desa || properties.desa_kelur || '',
                lat,
                lng,
                status: properties.status || properties.jenis_wisa || properties.jenis || 'Tersedia',
                desc: properties.deskripsi || address || 'Tidak ada deskripsi lokasi.'
            };
        }

        async function loadSpatialData() {
            const entries = await Promise.all(Object.entries(spatialSources).map(async ([type, source]) => {
                const response = await fetch(source);
                if (!response.ok) throw new Error(`HTTP ${response.status} saat memuat ${source}`);
                const data = await response.json();
                return data.features
                    .filter(feature => feature.geometry?.type === 'Point')
                    .map(feature => normalizeSpatialFeature(feature, type));
            }));

            databaseSpasial = entries.flat().filter(item => Number.isFinite(item.lat) && Number.isFinite(item.lng));
        }

        let activeMarkers = [];
        let currentFilterType = 'all';
        let currentSearchQuery = '';
        let currentKecFilter = '';

        function getCategoryMeta(type) {
            switch(type) {
                case 'wifi': return { label: 'WiFi Publik', color: '#0ea5e9', bg: '#e0f2fe', icon: 'fa-wifi' };
                case 'kantor': return { label: 'Kantor Dinas', color: '#f59e0b', bg: '#fef3c7', icon: 'fa-landmark' };
                case 'pasar': return { label: 'Pasar & UMKM', color: '#10b981', bg: '#d1fae5', icon: 'fa-store' };
                case 'wisata': return { label: 'Pariwisata', color: '#06b6d4', bg: '#cffafe', icon: 'fa-mountain-sun' };
                case 'bumdes': return { label: 'Unit BUMDes', color: '#8b5cf6', bg: '#ede9fe', icon: 'fa-briefcase' };
                case 'kkdmp': return { label: 'KKDMP', color: '#f43f5e', bg: '#ffe4e6', icon: 'fa-people-group' };
                default: return { label: 'Fasilitas', color: '#64748b', bg: '#f1f5f9', icon: 'fa-location-dot' };
            }
        }

        function renderPointsAndTable() {
            activeMarkers.forEach(m => map.removeLayer(m));
            activeMarkers = [];

            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';
            let matchedCount = 0;

            databaseSpasial.forEach(item => {
                if (currentFilterType !== 'all' && item.type !== currentFilterType) return;
                if (currentKecFilter && item.kec !== currentKecFilter) return;

                if (currentSearchQuery) {
                    const q = currentSearchQuery.toLowerCase();
                    if (!item.name.toLowerCase().includes(q) && !item.desa.toLowerCase().includes(q) && !item.kec.toLowerCase().includes(q)) return;
                }

                matchedCount++;
                const meta = getCategoryMeta(item.type);

                const customIcon = L.divIcon({
                    className: 'custom-modern-pin',
                    html: `
                        <div style="
                            width: 38px; height: 38px;
                            background: ${meta.color};
                            border: 3px solid #ffffff;
                            border-radius: 50%;
                            display: flex; align-items: center; justify-content: center;
                            color: white; font-size: 15px;
                            box-shadow: 0 8px 18px rgba(0,0,0,0.35);
                            cursor: pointer;
                        ">
                            <i class="fa-solid ${meta.icon}"></i>
                        </div>
                    `,
                    iconSize: [38, 38],
                    iconAnchor: [19, 19],
                    popupAnchor: [0, -20]
                });

                const popupHtml = `
                    <div>
                        <div class="card-popup-banner" style="background: linear-gradient(135deg, ${meta.color} 0%, #0f172a 100%);">
                            <i class="fa-solid ${meta.icon}"></i>
                        </div>
                        <div class="card-popup-body">
                            <span class="popup-badge" style="background: ${meta.bg}; color: ${meta.color};">${meta.label}</span>
                            <h4>${item.name}</h4>
                            <p><strong>Desa ${item.desa}, Kec. ${item.kec}</strong><br>${item.desc}</p>
                            <a href="https://www.google.com/maps/dir/?api=1&destination=${item.lat},${item.lng}" target="_blank" class="popup-route-btn">
                                <i class="fa-solid fa-diamond-turn-right"></i> Petunjuk Arah (Google Maps)
                            </a>
                        </div>
                    </div>
                `;

                const marker = L.marker([item.lat, item.lng], { icon: customIcon }).bindPopup(popupHtml);
                marker.addTo(map);
                activeMarkers.push(marker);

                const tr = document.createElement('tr');
                tr.onclick = () => flyToPoint(item.lat, item.lng, marker);
                tr.innerHTML = `
                    <td>
                        <span class="category-pill" style="background: ${meta.bg}; color: ${meta.color};">
                            <i class="fa-solid ${meta.icon}"></i> ${meta.label}
                        </span>
                    </td>
                    <td><strong>${item.name}</strong></td>
                    <td>Kec. ${item.kec}</td>
                    <td>Desa ${item.desa}</td>
                    <td><span style="color: #059669; font-weight: 700;">● ${item.status}</span></td>
                    <td>
                        <button class="btn-focus-map" onclick="event.stopPropagation(); flyToPoint(${item.lat}, ${item.lng}, activeMarkers[${matchedCount - 1}])">
                            <i class="fa-solid fa-location-crosshairs"></i> Lihat Peta
                        </button>
                    </td>
                `;
                tableBody.appendChild(tr);
            });

            document.getElementById('tableCounterBadge').innerText = `${matchedCount} Lokasi Aktif`;
        }

        function filterOnlyCategory(type, element) {
            document.querySelectorAll('.category-chips-row input[type="checkbox"]').forEach(input => {
                input.checked = false;
            });
            if (element) element.checked = true;
            currentFilterType = type;
            loadSpatialData()
                .then(renderPointsAndTable)
                .catch(error => {
                    console.error('Gagal memuat data titik GeoJSON:', error);
                    document.getElementById('tableCounterBadge').innerText = 'Data gagal dimuat';
                });
        }

        function handleSearch(val) {
            currentSearchQuery = val;
            renderPointsAndTable();
        }

        function applyKecamatanFilter(kec) {
            currentKecFilter = kec;
            renderPointsAndTable();
        }

        function flyToPoint(lat, lng, markerInstance) {
            map.flyTo([lat, lng], 15, { duration: 1.2 });
            setTimeout(() => {
                if (markerInstance) markerInstance.openPopup();
            }, 1200);

            const drawer = document.getElementById('bottomDrawer');
            if (drawer.classList.contains('open')) toggleDrawer();
        }

        function toggleDrawer() {
            const drawer = document.getElementById('bottomDrawer');
            const chevron = document.getElementById('drawerChevron');
            drawer.classList.toggle('open');

            if (drawer.classList.contains('open')) {
                chevron.classList.replace('fa-chevron-up', 'fa-chevron-down');
            } else {
                chevron.classList.replace('fa-chevron-down', 'fa-chevron-up');
            }
        }

        // Deteksi parameter URL dari Beranda (?filter=wifi, dsb.)
        document.addEventListener("DOMContentLoaded", function () {
            renderPointsAndTable();

            const urlParams = new URLSearchParams(window.location.search);
            const filter = urlParams.get('filter');

            if (filter) {
                const targetBtn = document.getElementById(`chip-${filter}`);
                if (targetBtn) {
                    targetBtn.click();
                }
            }
        });
    </script>
</body>
</html>