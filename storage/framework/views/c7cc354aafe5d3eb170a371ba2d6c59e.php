<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Desa Digital</title>
    
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
            width: 240px;
            height: 100vh;
            background: #0f172a;
            padding: 20px 14px;
            z-index: 1000;
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
            color: white;
            font-size: 18px;
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

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 240px;
            min-height: 100vh;
        }

        /* ===== TOP HEADER ===== */
        .top-header {
            background: white;
            border-bottom: 1px solid var(--border);
            padding: 12px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
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

        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 14px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: white;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            font-size: 15px;
        }

        .header-icon-btn:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .header-icon-btn .badge-dot {
            position: absolute;
            top: 7px;
            right: 7px;
            width: 6px;
            height: 6px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid white;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px 4px 4px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
        }

        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 12px;
        }

        .user-info strong {
            display: block;
            font-size: 11px;
            font-weight: 600;
        }

        .user-info small {
            font-size: 9px;
            color: var(--text-secondary);
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

        /* ===== STATS GRID - SIMPEL & MODERN ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        /* CARD SERAGAM - PUTIH DENGAN BORDER TIPIS */
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

        /* Garis aksen tipis di atas */
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
            justify-content: space-between;
            margin-bottom: 12px;
        }

        /* ICON SERAGAM - BIRU */
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

        .stat-trend {
            font-size: 10px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 2px;
            background: #f1f5f9;
            color: var(--text-secondary);
        }

        .stat-trend.up { 
            background: rgba(16, 185, 129, 0.08); 
            color: var(--success); 
        }
        .stat-trend.down { 
            background: rgba(239, 68, 68, 0.08); 
            color: var(--danger); 
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

        /* Progress bar tipis */
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
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">
                <i class="bi bi-house-heart-fill"></i>
            </div>
            <div class="sidebar-brand-text">
                <h5>Desa Digital</h5>
                <small>Bersama Membangun Desa</small>
            </div>
        </div>

        <ul class="sidebar-menu">
            <li><a href="#" class="active"><i class="bi bi-house-fill"></i><span>Beranda</span></a></li>
            <li><a href="<?php echo e(route('admin.kecamatan.index')); ?>"><i class="bi bi-geo-alt-fill"></i><span>Kecamatan</span></a></li>
            <li><a href="<?php echo e(route('admin.desa.index')); ?>"><i class="bi bi-houses-fill"></i><span>Desa</span></a></li>
            
            <!-- ✅ DIPERBAIKI: Link Wisata Desa sekarang mengarah ke route yang benar -->
            <li><a href="<?php echo e(route('admin.wisata.index')); ?>"><i class="bi bi-image-fill"></i><span>Wisata Desa</span></a></li>
            
            <li><a href="#"><i class="bi bi-shop"></i><span>Pasar Desa</span></a></li>
            <li><a href="#"><i class="bi bi-building"></i><span>Kantor Desa</span></a></li>
            <li><a href="#"><i class="bi bi-wifi"></i><span>WiFi Desa</span></a></li>
            <li><a href="#"><i class="bi bi-briefcase-fill"></i><span>BUMDes</span></a></li>
            <li><a href="#"><i class="bi bi-people-fill"></i><span>KKDMP</span></a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <header class="top-header">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari desa, kecamatan, atau menu...">
            </div>

            <div class="header-actions">
                <button class="header-icon-btn">
                    <i class="bi bi-bell-fill"></i>
                    <span class="badge-dot"></span>
                </button>

                <div class="user-profile">
                    <div class="user-avatar">A</div>
                    <div class="user-info">
                        <strong>Admin Desa</strong>
                        <small>Administrator</small>
                    </div>
                    <i class="bi bi-chevron-down" style="color: var(--text-secondary); font-size: 10px;"></i>
                </div>
            </div>
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
                        <?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?>

                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-houses-fill"></i></div>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-right"></i> +1</span>
                    </div>
                    <div class="stat-label">Total Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">8</div>
                        <div class="stat-unit">desa</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 80%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <span class="stat-trend"><i class="bi bi-dash"></i> Tetap</span>
                    </div>
                    <div class="stat-label">Kecamatan</div>
                    <div class="stat-value-row">
                        <div class="stat-value">4</div>
                        <div class="stat-unit">kec.</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 40%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-image-fill"></i></div>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-right"></i> +1</span>
                    </div>
                    <div class="stat-label">Wisata Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">5</div>
                        <div class="stat-unit">objek</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 50%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-shop"></i></div>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-right"></i> +2</span>
                    </div>
                    <div class="stat-label">Pasar Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">6</div>
                        <div class="stat-unit">pasar</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 60%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-building-fill"></i></div>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-right"></i> +1</span>
                    </div>
                    <div class="stat-label">Kantor Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">7</div>
                        <div class="stat-unit">kantor</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 70%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-wifi"></i></div>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-right"></i> +3</span>
                    </div>
                    <div class="stat-label">WiFi Desa</div>
                    <div class="stat-value-row">
                        <div class="stat-value">12</div>
                        <div class="stat-unit">titik</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 90%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-briefcase-fill"></i></div>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-right"></i> +1</span>
                    </div>
                    <div class="stat-label">BUMDes</div>
                    <div class="stat-value-row">
                        <div class="stat-value">3</div>
                        <div class="stat-unit">unit</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 30%;"></div></div>
                </div>

                <div class="stat-card">
                    <div class="stat-top">
                        <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                        <span class="stat-trend down"><i class="bi bi-arrow-down-right"></i> -1</span>
                    </div>
                    <div class="stat-label">KKDMP</div>
                    <div class="stat-value-row">
                        <div class="stat-value">9</div>
                        <div class="stat-unit">orang</div>
                    </div>
                    <div class="stat-bar"><div class="stat-bar-fill" style="width: 75%;"></div></div>
                </div>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>