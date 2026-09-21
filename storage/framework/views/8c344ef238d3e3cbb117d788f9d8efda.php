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

        /* 1. TOP FLOATING APP BAR */
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

        /* 3. FLOATING CONTROLS */
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

        /* 4. BOTTOM DRAWER */
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
            .layer-control-panel { display: none; }
        }
    </style>
</head>
<body>

    <!-- TOP BAR -->
    <div class="gmaps-floating-header">
        <div class="search-pill-box">
            <a href="<?php echo e(url('/')); ?>" class="btn-brand-menu" title="Kembali ke Beranda">
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

        <!-- Filter Chips Kategori -->
        <div class="category-chips-row">
            <button class="chip-btn active" id="chip-all" data-type="all" onclick="filterOnlyCategory('all', this)">
                <i class="fa-solid fa-layer-group"></i> Semua Data
            </button>
            <button class="chip-btn" id="chip-wifi" data-type="wifi" onclick="filterOnlyCategory('wifi', this)">
                <span class="chip-dot" style="background: var(--primary-vivid);"></span> Hanya WiFi Desa
            </button>
            <button class="chip-btn" id="chip-kantor" data-type="kantor" onclick="filterOnlyCategory('kantor', this)">
                <span class="chip-dot" style="background: var(--amber);"></span> Hanya Kantor Desa
            </button>
            <button class="chip-btn" id="chip-pasar" data-type="pasar" onclick="filterOnlyCategory('pasar', this)">
                <span class="chip-dot" style="background: var(--emerald);"></span> Hanya Pasar Desa
            </button>
            <button class="chip-btn" id="chip-wisata" data-type="wisata" onclick="filterOnlyCategory('wisata', this)">
                <span class="chip-dot" style="background: var(--cyan);"></span> Hanya Wisata Desa
            </button>
            <button class="chip-btn" id="chip-bumdes" data-type="bumdes" onclick="filterOnlyCategory('bumdes', this)">
                <span class="chip-dot" style="background: var(--violet);"></span> Hanya BUMDes
            </button>
            <button class="chip-btn" id="chip-dusun" data-type="dusun" onclick="filterOnlyCategory('dusun', this)">
                <span class="chip-dot" style="background: var(--rose);"></span> Hanya Dusun
            </button>
        </div>
    </div>

    <!-- MAP CONTAINER -->
    <div id="map"></div>

    <!-- FLOATING CONTROLS (KANAN) -->
    <div class="gmaps-controls-right">
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

        <!-- PANEL CHECKBOX LAYER POLIGON -->
        <div class="layer-control-panel">
            <div class="layer-panel-title">
                <span>Layer Poligon Wilayah</span>
                <i class="fa-solid fa-draw-polygon" style="color: var(--primary);"></i>
            </div>

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

        function toggleLayer(name, isChecked) {
            if (isChecked) {
                map.addLayer(layers[name]);
            } else {
                map.removeLayer(layers[name]);
            }
        }

        // Pemuatan GeoJSON
        fetch("<?php echo e(asset('geojson/kabupaten.geojson')); ?>")
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

        fetch("<?php echo e(asset('geojson/kecamatan.geojson')); ?>")
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

        fetch("<?php echo e(asset('geojson/desa.geojson')); ?>")
            .then(res => res.json())
            .then(data => {
                L.geoJSON(data, {
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
                    }
                }).addTo(layers.desa);
            }).catch(e => console.error("Gagal muat desa.geojson:", e));

        // Data Titik Marker Fasilitas
        const databaseSpasial = [
            { id: 1, type: 'wifi', name: 'WiFi Publik Alun-Alun Tuban', kec: 'Tuban', desa: 'Kutorejo', lat: -6.8945, lng: 112.0625, status: 'Online 100 Mbps', desc: 'Hotspot kecepatan tinggi di Alun-Alun Tuban.' },
            { id: 2, type: 'wifi', name: 'WiFi Balai Desa Sugiharjo', kec: 'Tuban', desa: 'Sugiharjo', lat: -6.8860, lng: 112.0280, status: 'Online Aktif', desc: 'Fasilitas internet kependudukan warga desa.' },
            { id: 3, type: 'wifi', name: 'WiFi Pesisir Dusun Dasin', kec: 'Jenu', desa: 'Sugihwaras', lat: -6.8590, lng: 111.9800, status: 'Online Aktif', desc: 'Jaringan internet masyarakat nelayan pesisir.' },
            { id: 4, type: 'wifi', name: 'WiFi Balai Desa Rengel', kec: 'Rengel', desa: 'Rengel', lat: -7.0540, lng: 111.9870, status: 'Online Aktif', desc: 'Internet publik posko pelayanan desa.' },
            { id: 5, type: 'kantor', name: 'Kantor Balai Desa Tasikharjo', kec: 'Jenu', desa: 'Tasikharjo', lat: -6.8480, lng: 111.9450, status: 'Buka (08.00 - 15.30)', desc: 'Pusat pengurusan surat keterangan dan domisili terpadu.' },
            { id: 6, type: 'kantor', name: 'Kantor Kecamatan Jenu', kec: 'Jenu', desa: 'Beji', lat: -6.8520, lng: 111.9650, status: 'Buka Kedinasan', desc: 'Pusat koordinasi wilayah pesisir barat Kabupaten Tuban.' },
            { id: 7, type: 'kantor', name: 'Kantor Balai Desa Prunggahan', kec: 'Semanding', desa: 'Prunggahan', lat: -6.9150, lng: 112.0300, status: 'Buka Pelayanan', desc: 'Pelayanan administrasi kependudukan satu pintu.' },
            { id: 8, type: 'pasar', name: 'Pasar Tradisional Merakurak', kec: 'Merakurak', desa: 'Sambonggede', lat: -6.9020, lng: 111.9950, status: 'Aktivitas Ramai', desc: 'Sentra komoditas pangan segar hasil bumi petani lokal.' },
            { id: 9, type: 'pasar', name: 'Pasar Ikan Asap Karangagung', kec: 'Palang', desa: 'Karangagung', lat: -6.9150, lng: 112.1450, status: 'Buka Harian', desc: 'Sentra grosir olahan perikanan laut khas Tuban timur.' },
            { id: 10, type: 'wisata', name: 'Air Terjun Nglirip', kec: 'Singgahan', desa: 'Mulyoagung', lat: -6.9605, lng: 111.8320, status: 'Destinasi Terbuka', desc: 'Air terjun alami berair toska di perbukitan Tuban.' },
            { id: 11, type: 'wisata', name: 'Pantai Pasir Putih Remen', kec: 'Jenu', desa: 'Remen', lat: -6.8120, lng: 111.9540, status: 'Wisata Pesisir', desc: 'Wisata pantai dan telaga laguna berpasir putih.' },
            { id: 12, type: 'wisata', name: 'Pemandian Alami Bektiharjo', kec: 'Semanding', desa: 'Bektiharjo', lat: -6.9450, lng: 112.0450, status: 'Wisata Sejarah', desc: 'Sumber mata air alami bersejarah di perbukitan Semanding.' },
            { id: 13, type: 'bumdes', name: 'BUMDes Tirta Kencana', kec: 'Semanding', desa: 'Bektiharjo', lat: -6.9280, lng: 112.0520, status: 'Operasional', desc: 'Pengelolaan saluran air bersih mandiri desa.' },
            { id: 14, type: 'bumdes', name: 'BUMDes Karya Makmur Sugiharjo', kec: 'Tuban', desa: 'Sugiharjo', lat: -6.8810, lng: 112.0320, status: 'Operasional', desc: 'Pengeringan gabah modern & loket bayar digital.' },
            { id: 15, type: 'dusun', name: 'Sentra Dusun Krajan', kec: 'Tuban', desa: 'Sugiharjo', lat: -6.8890, lng: 112.0250, status: '1.450 Jiwa', desc: 'Kawasan pemukiman warga terpadu 4 RT.' },
            { id: 16, type: 'dusun', name: 'Sentra Dusun Dasin', kec: 'Jenu', desa: 'Sugihwaras', lat: -6.8580, lng: 111.9750, status: '820 Jiwa', desc: 'Pemukiman rukun warga pesisir utara.' }
        ];

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
                case 'dusun': return { label: 'Sentra Dusun', color: '#f43f5e', bg: '#ffe4e6', icon: 'fa-house-chimney' };
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
            document.querySelectorAll('.category-chips-row .chip-btn').forEach(b => b.classList.remove('active'));
            if (element) element.classList.add('active');
            currentFilterType = type;
            renderPointsAndTable();
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
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/data-spasial.blade.php ENDPATH**/ ?>