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
            padding: 4px;
            border: 0;
            background: transparent;
            color: var(--text-light);
            font-size: 14px;
            cursor: pointer;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s, background 0.2s;
        }

        .search-box-submit:hover {
            color: var(--primary);
            background: #eff6ff;
        }

        .search-suggestions {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            left: 0;
            z-index: 120;
            max-height: 380px;
            overflow-y: auto;
            padding: 6px;
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
            padding: 8px 10px;
            border-radius: 7px;
            color: var(--text-primary);
            font-size: 13px;
            text-decoration: none;
            transition: background 0.15s;
        }

        .search-suggestion:hover,
        .search-suggestion[aria-selected="true"] {
            background: #eff6ff;
            color: var(--primary);
        }

        .search-suggestion-main {
            display: flex;
            flex-direction: column;
            gap: 2px;
            min-width: 0;
            flex: 1;
        }

        .search-suggestion-title {
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-suggestion-desc {
            font-size: 11px;
            color: var(--text-light);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-suggestion-type {
            flex: 0 0 auto;
            color: #2563eb;
            background: #eff6ff;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 8px;
            border-radius: 6px;
        }

        .search-suggestion-all {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 12px;
            margin-top: 4px;
            border-top: 1px solid var(--border);
            border-radius: 0 0 7px 7px;
            background: #f8fafc;
            color: var(--primary);
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: background 0.15s;
        }

        .search-suggestion-all:hover,
        .search-suggestion-all[aria-selected="true"] {
            background: #eff6ff;
        }

        .search-suggestions-empty {
            padding: 12px 10px;
            color: var(--text-secondary);
            font-size: 12px;
            text-align: center;
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
            .main-content { margin-left: 0 !important; width: 100% !important; }
        }

        @media (max-width: 768px) {
            .top-header { padding: 0 14px; gap: 8px; }
            .search-box { min-width: 0; }
            .welcome-banner { padding: 22px 18px; }
        }

        @media (max-width: 576px) {
            .stats-grid { grid-template-columns: 1fr; }
            .page-body { padding: 14px; }
            .welcome-text h1 { font-size: 16px; }
            .welcome-text h2 { font-size: 20px; }
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

        /* ===== SURVEI SECTION ===== */
        .survei-dashboard-card {
            background: white;
            border-radius: 14px;
            border: 1px solid var(--border);
            margin-top: 24px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
            animation: fadeInUp 0.4s ease-out 0.44s backwards;
        }
        .survei-dashboard-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }
        .survei-dashboard-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .survei-title-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #fdf2f8;
            color: #db2777;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
        }
        .survei-dashboard-title h3 {
            font-size: 16px;
            font-weight: 800;
            margin: 0 0 2px;
            color: var(--text-primary);
        }
        .survei-dashboard-title p {
            font-size: 12px;
            color: var(--text-secondary);
            margin: 0;
        }
        .survei-metric-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            background: #f8fafc;
            border: 1px solid var(--border);
            color: var(--text-secondary);
        }
        .survei-metric-pill strong {
            color: var(--text-primary);
        }
        .btn-tinjau-semua {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-tinjau-semua:hover {
            background: #1d4ed8;
            color: white;
            transform: translateY(-1px);
        }
        .survei-table {
            width: 100%;
            border-collapse: collapse;
        }
        .survei-table th {
            padding: 12px 20px;
            background: #f8fafc;
            color: var(--text-secondary);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border);
            text-align: left;
        }
        .survei-table td {
            padding: 14px 20px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
            vertical-align: middle;
        }
        .survei-table tbody tr:hover {
            background: #fbfcfe;
        }
        .survei-table tbody tr:last-child td {
            border-bottom: none;
        }
        .rating-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
        }
        .rating-badge-5 { background: #dcfce7; color: #15803d; }
        .rating-badge-4 { background: #ecfdf5; color: #059669; }
        .rating-badge-3 { background: #fef9c3; color: #a16207; }
        .rating-badge-2 { background: #ffedd5; color: #c2410c; }
        .rating-badge-1 { background: #fee2e2; color: #b91c1c; }
        .btn-action-tinjau {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            background: white;
            border: 1px solid var(--border);
            color: var(--primary);
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-action-tinjau:hover {
            background: #eff6ff;
            border-color: var(--primary);
        }
    </style>
</head>
<body>
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        <header class="top-header">
            <form class="search-box" id="dashboardSearchForm" action="{{ route('admin.search') }}" method="GET" role="search">
                <button class="search-box-submit" type="submit" aria-label="Cari semua data & atribut" title="Cari semua data & atribut">
                    <i class="bi bi-search" aria-hidden="true"></i>
                </button>
                <input
                    type="search"
                    name="q"
                    id="dashboardSearchInput"
                    placeholder="Cari semua data & atribut (wisata, pasar, tempat, desa...)"
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

                {{-- SURVEI KEPUASAN CARD --}}
                <a href="{{ route('admin.survei.index') }}" class="stat-card text-decoration-none" style="cursor: pointer; display: block;" title="Klik untuk membuka dan meninjau data survei kepuasan">
                    <div class="stat-top justify-content-between">
                        <div class="stat-icon" style="background: #fdf2f8; color: #db2777;"><i class="bi bi-chat-heart-fill"></i></div>
                        @if(($surveiHariIni ?? 0) > 0)
                            <span class="badge bg-danger rounded-pill" style="font-size: 10px; padding: 3px 8px; font-weight: 700;">+{{ $surveiHariIni }} Hari Ini</span>
                        @endif
                    </div>
                    <div class="stat-label">Survei Kepuasan</div>
                    <div class="stat-value-row">
                        <div class="stat-value">{{ $totalSurvei ?? 0 }}</div>
                        <div class="stat-unit">responden</div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-1" style="font-size: 11px; color: #64748b; font-weight: 600;">
                        <span>⭐ {{ $avgRatingSurvei ?? 0 }} / 5</span>
                        <span>{{ $persentaseKepuasan ?? 0 }}% Puas</span>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: {{ $persentaseKepuasan ?? 0 }}%; background: #db2777;"></div></div>
                </a>

            </div>

            <!-- Section Survei Kepuasan Masuk & Peninjauan -->
            <div class="survei-dashboard-card">
                <div class="survei-dashboard-header">
                    <div class="survei-dashboard-title">
                        <div class="survei-title-icon">
                            <i class="bi bi-chat-heart-fill"></i>
                        </div>
                        <div>
                            <h3>Tanggapan &amp; Survei Kepuasan Terbaru</h3>
                            <p>Pantau data masukan, kritik, saran, serta tingkat kepuasan publik yang masuk secara berkala.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center flex-wrap gap-2">
                        <div class="survei-metric-pill" title="Rata-rata Skor Bintang">
                            <i class="bi bi-star-fill text-warning"></i>
                            <span>Rata-rata: <strong>{{ $avgRatingSurvei ?? 0 }} / 5.0</strong></span>
                        </div>
                        <div class="survei-metric-pill" title="Persentase Responden Puas (Bintang 4-5)">
                            <i class="bi bi-emoji-smile-fill text-success"></i>
                            <span>Kepuasan: <strong>{{ $persentaseKepuasan ?? 0 }}%</strong></span>
                        </div>
                        <div class="survei-metric-pill" title="Total Masukan Hari Ini">
                            <i class="bi bi-calendar-check text-primary"></i>
                            <span>Hari Ini: <strong>{{ $surveiHariIni ?? 0 }}</strong></span>
                        </div>
                        <a href="{{ route('admin.survei.index') }}" class="btn-tinjau-semua ms-md-2">
                            <span>Tinjau Semua Survei</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="survei-table">
                        <thead>
                            <tr>
                                <th style="width: 140px;">Waktu</th>
                                <th style="width: 200px;">Responden</th>
                                <th style="width: 170px;">Tingkat Kepuasan</th>
                                <th>Kritik & Masukan</th>
                                <th style="width: 90px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentSurveis as $item)
                            <tr>
                                <td>
                                    <div style="font-weight: 600; color: #1e293b; font-size: 12.5px;">
                                        {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}
                                    </div>
                                    <small style="color: #94a3b8; font-size: 11px;">
                                        {{ $item->created_at ? $item->created_at->format('H:i') . ' WIB' : '' }}
                                    </small>
                                </td>
                                <td>
                                    <div style="font-weight: 600; color: #1e293b;">
                                        {{ $item->display_name }}
                                    </div>
                                    <small style="color: #64748b; font-size: 11.5px;">
                                        {{ $item->display_pekerjaan }}
                                    </small>
                                </td>
                                <td>
                                    <div class="rating-badge rating-badge-{{ $item->rating }}">
                                        <span>{{ $item->rating_emoji }}</span>
                                        <span>{{ $item->rating }}/5 • {{ $item->rating_label }}</span>
                                    </div>
                                </td>
                                <td>
                                    @if($item->message)
                                        <div style="color: #334155; line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" title="{{ $item->message }}">
                                            {{ $item->message }}
                                        </div>
                                    @else
                                        <span style="color: #94a3b8; font-style: italic; font-size: 12px;">(Hanya memberikan rating bintang)</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <button
                                        type="button"
                                        class="btn-action-tinjau btn-open-review"
                                        data-nama="{{ $item->display_name }}"
                                        data-pekerjaan="{{ $item->display_pekerjaan }}"
                                        data-rating="{{ $item->rating }}"
                                        data-rating-label="{{ $item->rating_label }}"
                                        data-rating-emoji="{{ $item->rating_emoji }}"
                                        data-waktu="{{ $item->created_at ? $item->created_at->translatedFormat('l, d F Y - H:i') . ' WIB' : '-' }}"
                                        data-pesan="{{ $item->message ?: 'Tidak ada pesan tertulis (hanya nilai rating).' }}"
                                        title="Tinjau detail data survei ini"
                                    >
                                        <i class="bi bi-eye"></i> Tinjau
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div style="text-align: center; padding: 40px 20px; color: #94a3b8;">
                                        <i class="bi bi-chat-square-heart" style="font-size: 38px; display: block; margin-bottom: 8px; color: #cbd5e1;"></i>
                                        <div style="font-weight: 700; color: #475569; font-size: 14px;">Belum Ada Tanggapan Survei</div>
                                        <p style="font-size: 12.5px; margin: 4px 0 12px;">Data survei kepuasan yang dikirimkan oleh pengunjung atau masyarakat akan otomatis muncul di sini.</p>
                                        <a href="{{ route('survei.public') }}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size: 12px; border-radius: 6px;">
                                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Halaman Survei Publik
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Peninjauan Detail Survei (Dashboard) -->
    <div class="modal fade" id="modalTinjauSurvei" tabindex="-1" aria-labelledby="modalTinjauSurveiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 16px 20px;">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalTinjauSurveiLabel" style="font-size: 15px; font-weight: 800; color: #0f172a;">
                        <i class="bi bi-chat-heart-fill text-danger"></i> Tinjau Survei Kepuasan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <h6 class="mb-0 fw-bold" id="modalReviewNama" style="color: #0f172a; font-size: 15px;">-</h6>
                                <small class="text-muted" id="modalReviewPekerjaan" style="font-size: 12px;">-</small>
                            </div>
                            <span class="badge rounded-pill" id="modalReviewRatingBadge" style="font-size: 12px; padding: 6px 12px;">
                                <span id="modalReviewEmoji">⭐</span> <span id="modalReviewRating">5</span>/5
                            </span>
                        </div>
                        <div class="text-muted" style="font-size: 11.5px;">
                            <i class="bi bi-clock me-1"></i> <span id="modalReviewWaktu">-</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Tingkat Kepuasan</label>
                        <div id="modalReviewRatingStars" class="text-warning fs-5"></div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Kritik, Saran & Masukan Responden</label>
                        <div id="modalReviewPesan" class="p-3 rounded" style="background: #f1f5f9; font-size: 13.5px; line-height: 1.6; color: #1e293b; min-height: 80px; white-space: pre-wrap;">-</div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 12px 20px; background: #f8fafc;">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" style="font-size: 12.5px; border-radius: 8px;">Tutup</button>
                    <a href="{{ route('admin.survei.index') }}" class="btn btn-sm btn-primary" style="font-size: 12.5px; border-radius: 8px;">
                        <i class="bi bi-arrow-right-circle me-1"></i> Buka Manajemen Survei
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-dashboard-search.js') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reviewModalEl = document.getElementById('modalTinjauSurvei');
            if (reviewModalEl && window.bootstrap) {
                const modal = new bootstrap.Modal(reviewModalEl);
                document.querySelectorAll('.btn-open-review').forEach(btn => {
                    btn.addEventListener('click', function () {
                        document.getElementById('modalReviewNama').textContent = this.dataset.nama || 'Anonim';
                        document.getElementById('modalReviewPekerjaan').textContent = this.dataset.pekerjaan || 'Masyarakat Umum';
                        document.getElementById('modalReviewWaktu').textContent = this.dataset.waktu || '-';
                        document.getElementById('modalReviewEmoji').textContent = this.dataset.ratingEmoji || '⭐';
                        document.getElementById('modalReviewRating').textContent = this.dataset.rating || '5';
                        document.getElementById('modalReviewPesan').textContent = this.dataset.pesan || '-';

                        const rating = parseInt(this.dataset.rating || 5);
                        let starsHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            starsHtml += i <= rating ? '<i class="bi bi-star-fill me-1"></i>' : '<i class="bi bi-star me-1 text-secondary opacity-50"></i>';
                        }
                        starsHtml += ` <span class="ms-2 fs-6 text-dark fw-bold">${this.dataset.ratingLabel || ''}</span>`;
                        document.getElementById('modalReviewRatingStars').innerHTML = starsHtml;

                        const badge = document.getElementById('modalReviewRatingBadge');
                        badge.className = 'badge rounded-pill ' + (rating >= 4 ? 'bg-success' : (rating === 3 ? 'bg-warning text-dark' : 'bg-danger'));

                        modal.show();
                    });
                });
            }
        });
    </script>

</body>
</html>