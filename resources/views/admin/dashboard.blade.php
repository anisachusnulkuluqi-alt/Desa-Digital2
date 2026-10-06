<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #2563eb;
            --primary-light: #3b82f6;
            --bg-main: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-light: #94a3b8;
            --border: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
        }

        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: var(--bg-main);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 260px;
            height: 100vh;
            background: #0f172a;
            padding: 20px 14px;
            z-index: 100;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            margin-bottom: 24px;
        }

        .sidebar-brand-icon {
            width: 38px;
            height: 38px;
            background: var(--primary);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .sidebar-brand-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .sidebar-brand-text h5 {
            color: white;
            font-weight: 700;
            font-size: 14px;
            margin: 0;
        }

        .sidebar-brand-text small {
            color: #64748b;
            font-size: 10px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            flex: 1;
        }

        .sidebar-menu li { margin-bottom: 2px; }
        .sidebar-menu .sidebar-menu-divider { height: 0; margin: 10px 10px 8px; border-top: 1px solid rgba(148, 163, 184, .25); }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-menu a i {
            font-size: 16px;
            width: 18px;
            text-align: center;
        }

        .sidebar-menu a:hover {
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .sidebar-menu a.active {
            background: var(--primary);
            color: white;
        }

        .sidebar-menu a:hover { background: #1d4ed8; }
        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        /* ===== TOP HEADER ===== */
        .top-header {
            background: white;
            border-bottom: 1px solid var(--border);
            height: 62px;
            padding: 0 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 420px;
        }

        .search-box input {
            width: 100%;
            padding: 9px 14px 9px 38px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #f8fafc;
            font-size: 13px;
            transition: all 0.2s;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
        }

        .search-box-submit {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            padding: 0;
            border: 0;
            background: transparent;
            color: var(--text-light);
            font-size: 14px;
            cursor: pointer;
        }

        .search-suggestions {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            left: 0;
            z-index: 120;
            max-height: 360px;
            overflow-y: auto;
            padding: 5px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            box-shadow: 0 12px 28px rgba(15, 23, 42, .14);
        }

        .search-suggestion {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 9px 10px;
            border-radius: 7px;
            color: var(--text-primary);
            font-size: 13px;
            text-decoration: none;
        }

        .search-suggestion:hover,
        .search-suggestion[aria-selected="true"] {
            background: #eff6ff;
            color: var(--primary);
        }

        .search-suggestion-type {
            flex: 0 0 auto;
            color: var(--text-light);
            font-size: 11px;
        }

        .search-suggestions-empty {
            padding: 10px;
            color: var(--text-secondary);
            font-size: 12px;
        }

        /* ===== PAGE BODY ===== */
        .page-body {
            padding: 20px 24px;
        }

        /* ===== WELCOME BANNER ===== */
        .welcome-banner {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 100%);
            border-radius: 14px;
            padding: 24px 28px;
            color: white;
            position: relative;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .welcome-banner::before {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .welcome-text h1 {
            font-size: 12px;
            font-weight: 500;
            opacity: 0.7;
            margin-bottom: 4px;
        }

        .welcome-text h2 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .welcome-text p {
            font-size: 12px;
            opacity: 0.75;
            max-width: 440px;
            line-height: 1.5;
        }

        .welcome-date {
            background: rgba(255,255,255,0.1);
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255,255,255,0.15);
            white-space: nowrap;
        }

        /* ===== STATS GRID ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 16px 18px;
            border: 1px solid var(--border);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            border-color: var(--primary-light);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: var(--primary);
            opacity: 0;
            transition: opacity 0.25s;
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-top {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }

        .stat-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 17px;
            transition: all 0.25s;
        }

        .stat-card:hover .stat-icon {
            background: var(--primary);
            color: white;
            transform: scale(1.05);
        }

        .stat-label {
            font-size: 10px;
            color: var(--text-secondary);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .stat-value-row {
            display: flex;
            align-items: baseline;
            gap: 4px;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -1px;
            line-height: 1;
        }

        .stat-unit {
            font-size: 11px;
            color: var(--text-light);
            font-weight: 500;
        }

        .stat-bar {
            height: 3px;
            background: #f1f5f9;
            border-radius: 3px;
            overflow: hidden;
        }

        .stat-bar-fill {
            height: 100%;
            background: var(--primary);
            border-radius: 3px;
            transition: width 1s ease-out;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }

        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-body { padding: 14px; }
            .welcome-text h2 { font-size: 18px; }
            .welcome-content { flex-direction: column; align-items: flex-start; gap: 12px; }
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-banner { animation: fadeInUp 0.4s ease-out; }

        .stat-card {
            animation: fadeInUp 0.4s ease-out backwards;
        }

        .stat-card:nth-child(1) { animation-delay: 0.04s; }
        .stat-card:nth-child(2) { animation-delay: 0.08s; }
        .stat-card:nth-child(3) { animation-delay: 0.12s; }
        .stat-card:nth-child(4) { animation-delay: 0.16s; }
        .stat-card:nth-child(5) { animation-delay: 0.20s; }
        .stat-card:nth-child(6) { animation-delay: 0.24s; }
        .stat-card:nth-child(7) { animation-delay: 0.28s; }
        .stat-card:nth-child(8) { animation-delay: 0.32s; }
        .stat-card:nth-child(9) { animation-delay: 0.36s; }
        .stat-card:nth-child(10) { animation-delay: 0.40s; }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <header class="top-header">
            <form class="search-box" id="dashboardSearchForm" action="{{ route('admin.desa.index') }}" method="GET" role="search">
                <button class="search-box-submit" type="submit" aria-label="Cari">
                    <i class="bi bi-search" aria-hidden="true"></i>
                </button>
                <input
                    type="search"
                    name="search"
                    id="dashboardSearchInput"
                    placeholder="Cari desa, kecamatan, atau menu..."
                    autocomplete="off"
                    role="combobox"
                    aria-autocomplete="list"
                    aria-expanded="false"
                    aria-controls="dashboardSearchSuggestions"
                    data-suggestions-url="{{ route('admin.search.suggestions') }}"
                    required
                >
                <div class="search-suggestions" id="dashboardSearchSuggestions" role="listbox" hidden></div>
            </form>

            @include('admin.partials.header-actions')
        </header>

        <div class="page-body">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-content">
                    <div class="welcome-text">
                        <h1>Selamat datang,</h1>
                        <h2>Website Desa Digital</h2>
                        <p>Kelola dan pantau seluruh data desa, kecamatan, dan layanan digital untuk mendukung pembangunan desa yang lebih maju.</p>
                    </div>
                    <div class="welcome-date">
                        <i class="bi bi-calendar-event"></i>
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </div>
                </div>
            </div>

            <!-- Stats Grid (TANDA PANAH SUDAH DIHAPUS) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-houses-fill"></i></div>
                    </div>
                    <div class="stat-label">Total Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalDesa ?? 0 }}</div>
                        <div class="stat-unit">desa</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 80%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-geo-alt-fill"></i></div>
                    </div>
                    <div class="stat-label">Kecamatan</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalKecamatan ?? 0 }}</div>
                        <div class="stat-unit">kec.</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 40%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-image-fill"></i></div>
                    </div>
                    <div class="stat-label">Wisata Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalWisata ?? 0 }}</div>
                        <div class="stat-unit">objek</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 50%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-shop"></i></div>
                    </div>
                    <div class="stat-label">Pasar Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalPasar ?? 0 }}</div>
                        <div class="stat-unit">pasar</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 60%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-building-fill"></i></div>
                    </div>
                    <div class="stat-label">Kantor Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalKantorDesa ?? 0 }}</div>
                        <div class="stat-unit">kantor</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 70%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-wifi"></i></div>
                    </div>
                    <div class="stat-label">WiFi Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalWifiDesa ?? 0 }}</div>
                        <div class="stat-unit">titik</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 90%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-briefcase-fill"></i></div>
                    </div>
                    <div class="stat-label">BUMDes</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalBumdes ?? 0 }}</div>
                        <div class="stat-unit">unit</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 30%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                    </div>
                    <div class="stat-label">KKDMP</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalKkdmp ?? 0 }}</div>
                        <div class="stat-unit">kelompok</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 75%;"></div></div>
                </div>

            </div>
        </div>
    </div>

    <script src="{{ asset('js/admin-dashboard-search.js') }}" defer></script>

</body>
</html>