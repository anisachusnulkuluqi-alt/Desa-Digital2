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

        /* 1. TOP FLOATING APP BAR (ALA GOOGLE MAPS) */
        .gmaps-floating-header {
            position: absolute;
            top: 16px;
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

        /* QUICK FILTER CHIPS (HORIZONTAL SCROLL) */
        .category-chips-row {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 4px;
            pointer-events: auto;
            scrollbar-width: none;
        }
        .category-chips-row::-webkit-scrollbar { display: none; }

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
            width: 100vw;
            height: 100vh;
            z-index: 1;
        }

        /* 3. FLOATING RIGHT LAYER CONTROLLER */
        .gmaps-controls-right {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: flex-end;
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

        /* LAYER DRAWER PANEL (TUMPANG-TINDIH ADMINISTRASI) */
        .layer-control-panel {
            width: 250px;
            background: var(--card-glass);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-glass);
            border-radius: 16px;
            padding: 14px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.2);
            display: flex;
            flex-direction: column;
            gap: 10px;
            font-size: 0.78rem;
        }

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

        /* 4. BOTTOM DRAWER TABLE (BOTTOM SHEET) */
        .bottom-table-drawer {
            position: absolute;
            bottom: 0;
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

        /* TABLE WRAPPER */
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
            transition: background 0.2s;
        }

        .btn-focus-map:hover {
            background: #0369a1;
        }

        /* 5. POPUP CARD STYLING */
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

        .card-popup-body {
            padding: 16px 18px;
        }

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
            transition: background 0.2s;
        }

        .popup-route-btn:hover {
            background: #0284c7;
        }

        @media (max-width: 768px) {
            .gmaps-floating-header { max-width: calc(100% - 32px); }
            .layer-control-panel { display: none; }
        }
    </style>
</head>
<body>

    <!-- 1. GOOGLE MAPS FLOATING TOP BAR -->
    <div class="gmaps-floating-header">
        
        <!-- Search Input Pill -->
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

        <!-- Filter Chips Kategori (Tombol Cepat: Hanya WiFi, Hanya Kantor, dst.) -->
        <div class="category-chips-row">
            <button class="chip-btn active" data-type="all" onclick="filterOnlyCategory('all', this)">
                <i class="fa-solid fa-layer-group"></i> Semua Data
            </button>
            <button class="chip-btn" data-type="wifi" onclick="filterOnlyCategory('wifi', this)">
                <span class="chip-dot" style="background: var(--primary-vivid);"></span> Hanya WiFi Desa
            </button>
            <button class="chip-btn" data-type="kantor" onclick="filterOnlyCategory('kantor', this)">
                <span class="chip-dot" style="background: var(--amber);"></span> Hanya Kantor Desa
            </button>
            <button class="chip-btn" data-type="pasar" onclick="filterOnlyCategory('pasar', this)">
                <span class="chip-dot" style="background: var(--emerald);"></span> Hanya Pasar Desa
            </button>
            <button class="chip-btn" data-type="wisata" onclick="filterOnlyCategory('wisata', this)">
                <span class="chip-dot" style="background: var(--cyan);"></span> Hanya Wisata Desa
            </button>
            <button class="chip-btn" data-type="bumdes" onclick="filterOnlyCategory('bumdes', this)">
                <span class="chip-dot" style="background: var(--violet);"></span> Hanya BUMDes
            </button>
            <button class="chip-btn" data-type="dusun" onclick="filterOnlyCategory('dusun', this)">
                <span class="chip-dot" style="background: var(--rose);"></span> Hanya Dusun
            </button>
        </div>

    </div>

    <!-- 2. MAP CANVAS -->
    <div id="map"></div>

    <!-- 3. GMAPS FLOATING CONTROLS (KANAN) -->
    <div class="gmaps-controls-right">
        
        <!-- Pilihan Base Map -->
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

        <!-- Tombol Aksi Peta -->
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

        <!-- PANEL LAYER ADMINISTRASI (BISA DITUMPUK ATAU MENYALA SENDIRI-SENDIRI) -->
        <div class="layer-control-panel">
            <div class="layer-panel-title">
                <span>Layer Poligon Wilayah</span>
                <i class="fa-solid fa-draw-polygon" style="color: var(--primary);"></i>
            </div>

            <div class="layer-checkbox-group">
                <label class="layer-checkbox-row">
                    <input type="checkbox" id="layerKabupaten" checked onchange="renderBoundaryLayers()">
                    <span class="color-badge-preview" style="background: #ef4444;"></span>
                    <span>Batas Kabupaten</span>
                </label>
                <label class="layer-checkbox-row">
                    <input type="checkbox" id="layerKecamatan" checked onchange="renderBoundaryLayers()">
                    <span class="color-badge-preview" style="background: #0284c7;"></span>
                    <span>Layer Kecamatan</span>
                </label>
                <label class="layer-checkbox-row">
                    <input type="checkbox" id="layerDesa" checked onchange="renderBoundaryLayers()">
                    <span class="color-badge-preview" style="background: #10b981;"></span>
                    <span>Layer Desa / Kelurahan</span>
                </label>
                <label class="layer-checkbox-row">
                    <input type="checkbox" id="layerDusun" onchange="renderBoundaryLayers()">
                    <span class="color-badge-preview" style="background: #f59e0b;"></span>
                    <span>Layer Batas Dusun</span>
                </label>
            </div>
        </div>

    </div>

    <!-- 4. BOTTOM SHEET DRAWER TABLE -->
    <div class="bottom-table-drawer" id="bottomDrawer">
        <div class="drawer-handle-bar" onclick="toggleDrawer()">
            <div class="drawer-grabber"></div>
            <div class="drawer-title-group">
                <h3>
                    <i class="fa-solid fa-database" style="color: var(--primary);"></i>
                    Direktori Data Spasial Terpadu
                </h3>
                <span class="counter-badge" id="tableCounterBadge">20 Lokasi Aktif</span>
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
                <tbody id="tableBody">
                    <!-- Dinamis via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- SCRIPT ENGINE GIS & MULTI-LAYER CONTROLLER -->
    <script>
        // Koordinat Titik Pusat Kabupaten Tuban
        const tubanCenter = [-6.9150, 111.9900];
        const map = L.map('map', { zoomControl: false }).setView(tubanCenter, 11);

        // Pasang Kontrol Zoom di pojok bawah kanan
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        // 1. BASE MAP TILE LAYERS
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
                }, () => {
                    alert('Izin lokasi tidak diaktifkan pada peramban Anda.');
                });
            }
        }

        // 2. LAYER POLIGON MULTI-LEVEL (BISA MENUMPUK KABUPATEN, KECAMATAN, DESA, DUSUN)
        const boundaryLayers = {
            kabupaten: null,
            kecamatan: [],
            desa: [],
            dusun: []
        };

        // Garis batas luar Kabupaten Tuban
        const kabOuterCoords = [
            [-6.770, 111.640], [-6.810, 111.850], [-6.800, 111.930], [-6.840, 112.020],
            [-6.880, 112.060], [-6.910, 112.190], [-6.960, 112.180], [-7.040, 112.140],
            [-7.090, 112.110], [-7.110, 111.940], [-7.130, 111.750], [-7.060, 111.550],
            [-6.930, 111.560], [-6.840, 111.630]
        ];

        // Koordinat Kecamatan berlekuk (Palang, Tuban Kota, Jenu, Semanding, Merakurak, Rengel, Singgahan)
        const dataKecamatan = [
            { name: "Kecamatan Tuban Kota", color: "#0284c7", coords: [[-6.8835, 112.0350], [-6.8870, 112.0620], [-6.8920, 112.0780], [-6.9080, 112.0750], [-6.9180, 112.0520], [-6.9120, 112.0300], [-6.8980, 112.0250], [-6.8850, 112.0320]] },
            { name: "Kecamatan Palang", color: "#ec4899", coords: [[-6.8920, 112.0780], [-6.9010, 112.1150], [-6.9120, 112.1520], [-6.9240, 112.1950], [-6.9550, 112.1850], [-6.9720, 112.1400], [-6.9580, 112.0950], [-6.9180, 112.0750]] },
            { name: "Kecamatan Jenu", color: "#10b981", coords: [[-6.8050, 111.9350], [-6.8220, 111.9850], [-6.8520, 112.0150], [-6.8835, 112.0350], [-6.8980, 112.0250], [-6.8950, 111.9650], [-6.8750, 111.9200], [-6.8350, 111.9150]] },
            { name: "Kecamatan Semanding", color: "#f59e0b", coords: [[-6.9180, 112.0520], [-6.9180, 112.0750], [-6.9580, 112.0950], [-6.9950, 112.0850], [-7.0250, 112.0550], [-7.0150, 112.0150], [-6.9650, 112.0050], [-6.9250, 112.0250]] },
            { name: "Kecamatan Merakurak", color: "#8b5cf6", coords: [[-6.8750, 111.9200], [-6.8950, 111.9650], [-6.8980, 112.0250], [-6.9250, 112.0250], [-6.9550, 111.9950], [-6.9450, 111.9450], [-6.9200, 111.9150], [-6.8850, 111.9050]] },
            { name: "Kecamatan Rengel", color: "#06b6d4", coords: [[-7.0150, 112.0150], [-7.0250, 112.0550], [-7.0550, 112.0450], [-7.0850, 112.0150], [-7.0950, 111.9650], [-7.0650, 111.9550], [-7.0350, 111.9750]] },
            { name: "Kecamatan Singgahan", color: "#14b8a6", coords: [[-6.9350, 111.7850], [-6.9550, 111.8450], [-6.9850, 111.8950], [-7.0250, 111.9050], [-7.045, 111.8550], [-7.0250, 111.7950], [-6.9750, 111.7650]] }
        ];

        // Layer Desa (Sub-wilayah lebih detail)
        const dataDesa = [
            { name: "Desa Sugiharjo", kec: "Tuban", coords: [[-6.880, 112.020], [-6.882, 112.038], [-6.895, 112.035], [-6.893, 112.018]] },
            { name: "Desa Kutorejo (Alun-Alun)", kec: "Tuban", coords: [[-6.892, 112.055], [-6.892, 112.072], [-6.903, 112.070], [-6.902, 112.053]] },
            { name: "Desa Tasikharjo", kec: "Jenu", coords: [[-6.840, 111.930], [-6.842, 111.955], [-6.860, 111.950], [-6.858, 111.928]] },
            { name: "Desa Remen (Pantai)", kec: "Jenu", coords: [[-6.808, 111.940], [-6.810, 111.968], [-6.828, 111.962], [-6.825, 111.938]] },
            { name: "Desa Karangagung", kec: "Palang", coords: [[-6.905, 112.130], [-6.910, 112.160], [-6.928, 112.155], [-6.923, 112.128]] },
            { name: "Desa Bektiharjo", kec: "Semanding", coords: [[-6.935, 112.035], [-6.938, 112.060], [-6.955, 112.055], [-6.952, 112.032]] }
        ];

        // Layer Dusun (Blok Pemukiman Lokal)
        const dataDusun = [
            { name: "Dusun Krajan", desa: "Sugiharjo", coords: [[-6.885, 112.022], [-6.886, 112.032], [-6.892, 112.030], [-6.891, 112.021]] },
            { name: "Dusun Dasin", desa: "Sugihwaras", coords: [[-6.855, 111.972], [-6.856, 111.986], [-6.864, 111.984], [-6.862, 111.970]] }
        ];

        // Fungsi Render Ulang Poligon Wilayah secara Mandiri / Bertumpuk
        function renderBoundaryLayers() {
            // Bersihkan layer sebelumnya
            if (boundaryLayers.kabupaten) map.removeLayer(boundaryLayers.kabupaten);
            boundaryLayers.kecamatan.forEach(l => map.removeLayer(l));
            boundaryLayers.desa.forEach(l => map.removeLayer(l));
            boundaryLayers.dusun.forEach(l => map.removeLayer(l));

            boundaryLayers.kecamatan = [];
            boundaryLayers.desa = [];
            boundaryLayers.dusun = [];

            const isKab = document.getElementById('layerKabupaten').checked;
            const isKec = document.getElementById('layerKecamatan').checked;
            const isDes = document.getElementById('layerDesa').checked;
            const isDus = document.getElementById('layerDusun').checked;

            // 1. Gambar Batas Luar Kabupaten
            if (isKab) {
                boundaryLayers.kabupaten = L.polygon(kabOuterCoords, {
                    color: '#ef4444',
                    weight: 2.5,
                    dashArray: '6, 6',
                    fillOpacity: 0
                }).addTo(map).bindTooltip("<strong>Batas Resmi Kabupaten Tuban</strong>");
            }

            // 2. Gambar Layer Kecamatan
            if (isKec) {
                dataKecamatan.forEach(k => {
                    const poly = L.polygon(k.coords, {
                        color: k.color,
                        weight: 2,
                        fillColor: k.color,
                        fillOpacity: 0.28
                    }).addTo(map);

                    poly.bindTooltip(`<b>${k.name}</b>`, { sticky: true });
                    poly.on('click', () => map.fitBounds(poly.getBounds(), { padding: [40, 40] }));
                    boundaryLayers.kecamatan.push(poly);
                });
            }

            // 3. Gambar Layer Desa
            if (isDes) {
                dataDesa.forEach(d => {
                    const poly = L.polygon(d.coords, {
                        color: '#10b981',
                        weight: 1.5,
                        dashArray: '3, 4',
                        fillColor: '#10b981',
                        fillOpacity: 0.22
                    }).addTo(map);

                    poly.bindTooltip(`<b>${d.name}</b> (Kec. ${d.kec})`, { sticky: true });
                    boundaryLayers.desa.push(poly);
                });
            }

            // 4. Gambar Layer Dusun
            if (isDus) {
                dataDusun.forEach(du => {
                    const poly = L.polygon(du.coords, {
                        color: '#f59e0b',
                        weight: 1.2,
                        fillColor: '#f59e0b',
                        fillOpacity: 0.35
                    }).addTo(map);

                    poly.bindTooltip(`<b>${du.name}</b> (Desa ${du.desa})`, { sticky: true });
                    boundaryLayers.dusun.push(poly);
                });
            }
        }

        // 3. DATABASE TITIK-TITIK KOORDINAT SPASIAL
        const databaseSpasial = [
            // WiFi Desa
            { id: 1, type: 'wifi', name: 'WiFi Publik Alun-Alun Tuban', kec: 'Tuban', desa: 'Kutorejo', lat: -6.8945, lng: 112.0625, status: 'Online 100 Mbps', banner: '#0ea5e9', icon: 'fa-wifi', desc: 'Hotspot kecepatan tinggi di ruang publik Alun-Alun Tuban.' },
            { id: 2, type: 'wifi', name: 'WiFi Balai Desa Sugiharjo', kec: 'Tuban', desa: 'Sugiharjo', lat: -6.8860, lng: 112.0280, status: 'Online Aktif', banner: '#0ea5e9', icon: 'fa-wifi', desc: 'Fasilitas internet kependudukan warga desa.' },
            { id: 3, type: 'wifi', name: 'WiFi Pesisir Dusun Dasin', kec: 'Jenu', desa: 'Sugihwaras', lat: -6.8590, lng: 111.9800, status: 'Online Aktif', banner: '#0ea5e9', icon: 'fa-wifi', desc: 'Jaringan internet masyarakat nelayan pesisir.' },
            { id: 4, type: 'wifi', name: 'WiFi Balai Desa Rengel', kec: 'Rengel', desa: 'Rengel', lat: -7.0540, lng: 111.9870, status: 'Online Aktif', banner: '#0ea5e9', icon: 'fa-wifi', desc: 'Internet publik posko pelayanan desa.' },

            // Kantor Desa
            { id: 5, type: 'kantor', name: 'Kantor Balai Desa Tasikharjo', kec: 'Jenu', desa: 'Tasikharjo', lat: -6.8480, lng: 111.9450, status: 'Buka (08.00 - 15.30)', banner: '#f59e0b', icon: 'fa-landmark', desc: 'Pusat pengurusan surat keterangan dan domisili terpadu.' },
            { id: 6, type: 'kantor', name: 'Kantor Kecamatan Jenu', kec: 'Jenu', desa: 'Beji', lat: -6.8520, lng: 111.9650, status: 'Buka Kedinasan', banner: '#f59e0b', icon: 'fa-building-columns', desc: 'Pusat koordinasi wilayah pesisir barat Kabupaten Tuban.' },
            { id: 7, type: 'kantor', name: 'Kantor Balai Desa Prunggahan', kec: 'Semanding', desa: 'Prunggahan', lat: -6.9150, lng: 112.0300, status: 'Buka Pelayanan', banner: '#f59e0b', icon: 'fa-landmark', desc: 'Pelayanan administrasi kependudukan satu pintu.' },

            // Pasar Desa
            { id: 8, type: 'pasar', name: 'Pasar Tradisional Merakurak', kec: 'Merakurak', desa: 'Sambonggede', lat: -6.9020, lng: 111.9950, status: 'Aktivitas Ramai', banner: '#10b981', icon: 'fa-store', desc: 'Sentra komoditas pangan segar hasil bumi petani lokal.' },
            { id: 9, type: 'pasar', name: 'Pasar Ikan Asap Karangagung', kec: 'Palang', desa: 'Karangagung', lat: -6.9150, lng: 112.1450, status: 'Buka Harian', banner: '#10b981', icon: 'fa-store', desc: 'Sentra grosir olahan perikanan laut khas Tuban timur.' },

            // Wisata Desa
            { id: 10, type: 'wisata', name: 'Air Terjun Nglirip', kec: 'Singgahan', desa: 'Mulyoagung', lat: -6.9605, lng: 111.8320, status: 'Destinasi Terbuka', banner: '#06b6d4', icon: 'fa-mountain-sun', desc: 'Air terjun alami berair toska di perbukitan Tuban.' },
            { id: 11, type: 'wisata', name: 'Pantai Pasir Putih Remen', kec: 'Jenu', desa: 'Remen', lat: -6.8120, lng: 111.9540, status: 'Wisata Pesisir', banner: '#06b6d4', icon: 'fa-umbrella-beach', desc: 'Wisata pantai dan telaga laguna berpasir putih.' },
            { id: 12, type: 'wisata', name: 'Pemandian Alami Bektiharjo', kec: 'Semanding', desa: 'Bektiharjo', lat: -6.9450, lng: 112.0450, status: 'Wisata Sejarah', banner: '#06b6d4', icon: 'fa-water-ladder', desc: 'Sumber mata air alami bersejarah di perbukitan Semanding.' },

            // BUMDes
            { id: 13, type: 'bumdes', name: 'BUMDes Tirta Kencana', kec: 'Semanding', desa: 'Bektiharjo', lat: -6.9280, lng: 112.0520, status: 'Operasional', banner: '#8b5cf6', icon: 'fa-briefcase', desc: 'Pengelolaan saluran air bersih mandiri desa.' },
            { id: 14, type: 'bumdes', name: 'BUMDes Karya Makmur Sugiharjo', kec: 'Tuban', desa: 'Sugiharjo', lat: -6.8810, lng: 112.0320, status: 'Operasional', banner: '#8b5cf6', icon: 'fa-briefcase', desc: 'Pengeringan gabah modern & loket bayar digital.' },

            // Sentra Dusun
            { id: 15, type: 'dusun', name: 'Sentra Dusun Krajan', kec: 'Tuban', desa: 'Sugiharjo', lat: -6.8890, lng: 112.0250, status: '1.450 Jiwa', banner: '#f43f5e', icon: 'fa-house-chimney-window', desc: 'Kawasan pemukiman warga terpadu 4 RT.' },
            { id: 16, type: 'dusun', name: 'Sentra Dusun Dasin', kec: 'Jenu', desa: 'Sugihwaras', lat: -6.8580, lng: 111.9750, status: '820 Jiwa', banner: '#f43f5e', icon: 'fa-house-chimney-window', desc: 'Pemukiman rukun warga pesisir utara.' }
        ];

        let activeMarkers = [];
        let currentFilterType = 'all'; // Menyimpan filter eksklusif (misal 'wifi')
        let currentSearchQuery = '';
        let currentKecFilter = '';

        function getCategoryMeta(type) {
            switch(type) {
                case 'wifi': return { label: 'WiFi Publik', color: '#0ea5e9', bg: '#e0f2fe', icon: 'fa-wifi' };
                case 'kantor': return { label: 'Kantor Dinas', color: '#f59e0b', bg: '#fef3c7', icon: 'fa-landmark' };
                case 'pasar': return { label: 'Pasar & UMKM', color: '#10b981', bg: '#d1fae5', icon: 'fa-store' };
                case 'wisata': return { label: 'Pariwisata', color: '#06b6d4', bg: '#cffafe', icon: 'fa-mountain-sun' };
                case 'bumdes': return { label: 'Unit BUMDes', color: '#8b5cf6', bg: '#ede9fe', icon: 'fa-briefcase' };
                case 'dusun': return { label: 'Sentra Dusun', color: '#f43f5e', bg: '#ffe4e6', icon: 'fa-house-chimney' };
                default: return { label: 'Fasilitas', color: '#64748b', bg: '#f1f5f9', icon: 'fa-location-dot' };
            }
        }

        // 4. RENDER TITIK-TITIK KOORDINAT DAN TABEL SINKRON
        function renderPointsAndTable() {
            activeMarkers.forEach(m => map.removeLayer(m));
            activeMarkers = [];

            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            let matchedCount = 0;

            databaseSpasial.forEach(item => {
                // Filter hanya kategori tertentu jika dipilih (misal hanya WiFi)
                if (currentFilterType !== 'all' && item.type !== currentFilterType) return;

                // Filter dropdown kecamatan
                if (currentKecFilter && item.kec !== currentKecFilter) return;

                // Filter live search nama / desa
                if (currentSearchQuery) {
                    const q = currentSearchQuery.toLowerCase();
                    const matchName = item.name.toLowerCase().includes(q);
                    const matchDesa = item.desa.toLowerCase().includes(q);
                    const matchKec  = item.kec.toLowerCase().includes(q);
                    if (!matchName && !matchDesa && !matchKec) return;
                }

                matchedCount++;
                const meta = getCategoryMeta(item.type);

                // Pin Elegan 3D
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

                // Buat Baris Tabel Drawer
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

        // Fitur: Pilih Kategori Eksklusif (Hanya WiFi, Hanya Kantor, dsb.)
        function filterOnlyCategory(type, element) {
            document.querySelectorAll('.category-chips-row .chip-btn').forEach(b => b.classList.remove('active'));
            element.classList.add('active');
            currentFilterType = type;
            renderPointsAndTable();
        }

        // Fitur: Pencarian Input Real-Time
        function handleSearch(val) {
            currentSearchQuery = val;
            renderPointsAndTable();
        }

        // Fitur: Filter Dropdown Kecamatan
        function applyKecamatanFilter(kec) {
            currentKecFilter = kec;
            renderPointsAndTable();
        }

        // Fly To Location & Buka Popup
        function flyToPoint(lat, lng, markerInstance) {
            map.flyTo([lat, lng], 15, { duration: 1.2 });
            setTimeout(() => {
                if (markerInstance) markerInstance.openPopup();
            }, 1200);

            const drawer = document.getElementById('bottomDrawer');
            if (drawer.classList.contains('open')) toggleDrawer();
        }

        // Buka / Tutup Drawer Tabel Bawah
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

        // Render Inisial
        renderBoundaryLayers();
        renderPointsAndTable();
    </script>
</body>
</html>