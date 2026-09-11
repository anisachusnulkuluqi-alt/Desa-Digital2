<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kecamatan {{ $kecamatan->nama_kecamatan }}</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        /* ===== HEADER ===== */
        .top-header {
            background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            padding: 14px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .header-logo { display: flex; align-items: center; gap: 10px; }
        .header-logo-icon {
            width: 38px; height: 38px;
            background: rgba(255,255,255,0.2);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            color: white;
        }
        .header-logo-text h5 { margin: 0; font-weight: 700; font-size: 15px; color: white; }
        .header-logo-text small { font-size: 10px; color: rgba(255,255,255,0.9); }
        
        .header-user { display: flex; align-items: center; gap: 10px; color: white; }
        .header-user-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px;
        }
        .header-user-info strong { display: block; font-size: 13px; font-weight: 600; }
        .header-user-info small { font-size: 10px; opacity: 0.9; }
        
        /* ===== BREADCRUMB ===== */
        .breadcrumb-bar {
            background: white; padding: 10px 25px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }
        .breadcrumb-bar a { color: #64748b; text-decoration: none; font-weight: 500; }
        .breadcrumb-bar a:hover { color: #1e88e5; }
        .breadcrumb-bar .active { color: #1e88e5; font-weight: 600; }
        .breadcrumb-date { color: #64748b; font-size: 13px; }
        
        /* ===== MAIN ===== */
        .main-content { padding: 24px 25px; max-width: 1200px; margin: 0 auto; }
        
        /* ===== HERO BANNER ===== */
        .hero-banner {
            background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            border-radius: 12px;
            padding: 30px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        
        .hero-banner::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 8px;
        }
        
        .hero-subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 12px;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.2);
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .hero-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
        }
        
        /* ===== STATS GRID - 3 KOLOM ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, #1e88e5, #00897b);
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .stat-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, rgba(30,136,229,0.1), rgba(0,137,123,0.1));
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: #1e88e5;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .stat-value {
            font-size: 22px;
            font-weight: 700;
            color: #1e3a8a;
            line-height: 1;
            margin-bottom: 4px;
        }
        
        .stat-label {
            font-size: 11px;
            color: #64748b;
            font-weight: 500;
        }
        
        /* ===== TWO COLUMN LAYOUT ===== */
        .detail-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .detail-section {
            background: white;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        
        .detail-section.full-width {
            grid-column: 1 / -1;
        }
        
        .section-header {
            padding: 14px 18px;
            background: linear-gradient(135deg, rgba(30,136,229,0.05), rgba(0,137,123,0.05));
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .section-header h5 {
            margin: 0;
            font-size: 14px;
            font-weight: 700;
            color: #1e3a8a;
        }
        
        .section-header i {
            color: #00897b;
            font-size: 16px;
        }
        
        .section-body {
            padding: 18px;
        }
        
        /* ===== INFO LIST ===== */
        .info-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .info-list-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px dashed #e2e8f0;
        }
        
        .info-list-item:last-child {
            border-bottom: none;
        }
        
        .info-list-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
            gap: 8px;
            flex-shrink: 0;
            min-width: 140px;
        }
        
        .info-list-label i {
            color: #1e88e5;
            font-size: 14px;
        }
        
        .info-list-value {
            font-size: 14px;
            font-weight: 600;
            color: #1f2937;
            text-align: right;
            flex: 1;
        }
        
        .info-list-value.empty {
            color: #94a3b8;
            font-style: italic;
        }
        
        /* ===== DESKRIPSI ===== */
        .deskripsi-content {
            font-size: 14px;
            line-height: 1.8;
            color: #334155;
            padding: 16px;
            background: linear-gradient(135deg, rgba(30,136,229,0.03), rgba(0,137,123,0.03));
            border-radius: 8px;
            border-left: 3px solid #1e88e5;
        }
        
        /* ===== DESA TABLE ===== */
        .desa-table-wrapper {
            padding: 0;
        }
        
        .table-modern {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, #1e3a8a, #00897b);
            color: white;
        }
        
        .table-modern th {
            padding: 12px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table-modern td {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }
        
        .table-modern tbody tr { transition: background 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .table-modern .no-cell {
            font-weight: 600;
            color: #1e88e5;
            width: 50px;
        }
        
        .table-modern .nama-cell { font-weight: 600; color: #0f172a; }
        .table-modern .kode-cell { color: #64748b; font-size: 12px; }
        
        .badge-count {
            background: linear-gradient(135deg, #1e88e5, #00897b);
            color: white;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            margin-left: 8px;
        }
        
        /* ===== PRINT STYLES ===== */
        @media print {
            @page {
                size: A4 landscape;
                margin: 12mm;
            }
            
            body { background: white; }
            
            .top-header, .breadcrumb-bar, .no-print {
                display: none !important;
            }
            
            .main-content {
                padding: 0;
                max-width: 100%;
            }
            
            .hero-banner {
                background: white !important;
                color: #1e3a8a !important;
                border: 2px solid #1e88e5;
                padding: 20px;
            }
            
            .hero-banner::before, .hero-banner::after { display: none; }
            .hero-title { color: #1e3a8a; }
            .hero-subtitle { color: #64748b; }
            .hero-badge { background: #f1f5f9; color: #1e88e5; }
            .hero-badge::before { background: #10b981; }
            
            .stat-card { border: 1px solid #e2e8f0; }
            .stat-card::before { background: #1e88e5; }
            
            .detail-layout { grid-template-columns: 1fr; }
            
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
                padding-bottom: 12px;
                border-bottom: 2px solid #1e88e5;
            }
            
            .print-header h1 {
                font-size: 18pt;
                font-weight: 700;
                color: #1e3a8a;
                margin-bottom: 4px;
            }
            
            .print-header h2 {
                font-size: 12pt;
                font-weight: 600;
                color: #00897b;
                margin-bottom: 6px;
            }
            
            .print-header .print-meta {
                font-size: 9pt;
                color: #64748b;
            }
            
            .print-info {
                display: block !important;
                margin-bottom: 16px;
            }
            
            .print-info h3 {
                font-size: 12pt;
                font-weight: 700;
                color: #1e3a8a;
                margin-bottom: 10px;
                padding-bottom: 4px;
                border-bottom: 2px solid #1e88e5;
            }
            
            .print-info-table {
                width: 100%;
                border-collapse: collapse;
            }
            
            .print-info-table tr { border-bottom: 1px solid #e5e7eb; }
            
            .print-info-table td {
                padding: 8px;
                font-size: 10pt;
            }
            
            .print-info-table td:first-child {
                font-weight: 600;
                color: #334155;
                width: 35%;
                background: #f8fafc;
            }
            
            .print-desa {
                display: block !important;
                page-break-inside: avoid;
            }
            
            .print-desa h3 {
                font-size: 12pt;
                font-weight: 700;
                color: #1e3a8a;
                margin-bottom: 10px;
                padding-bottom: 4px;
                border-bottom: 2px solid #1e88e5;
            }
            
            .print-desa-table {
                width: 100%;
                border-collapse: collapse;
                font-size: 9pt;
            }
            
            .print-desa-table th {
                background: #1e3a8a;
                color: white;
                padding: 8px;
                text-align: left;
                font-weight: 600;
                font-size: 9pt;
                text-transform: uppercase;
            }
            
            .print-desa-table td {
                padding: 6px 8px;
                border-bottom: 1px solid #e5e7eb;
                font-size: 9pt;
            }
            
            .print-desa-table tbody tr:nth-child(even) {
                background: #f8fafc;
            }
            
            .print-footer {
                display: block !important;
                margin-top: 20px;
                padding-top: 8px;
                border-top: 2px solid #1e88e5;
                font-size: 8pt;
                color: #64748b;
                text-align: center;
            }
        }
        
        .print-header, .print-info, .print-desa, .print-footer {
            display: none;
        }
        
        @media (max-width: 992px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
            .detail-layout { grid-template-columns: 1fr; }
        }
        
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
            .hero-title { font-size: 22px; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="top-header">
        <div class="header-logo">
            <div class="header-logo-icon"><i class="bi bi-grid-3x3-gap-fill"></i></div>
            <div class="header-logo-text">
                <h5>PORTAL DESA DIGITAL</h5>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        <div class="header-user">
            <div class="header-user-info">
                <strong>{{ auth()->user()->name ?? 'Admin Desa' }}</strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div>
            <a href="{{ route('dashboard') }}">Home</a> / 
            <a href="{{ route('admin.kecamatan.index') }}">Kecamatan</a> / 
            <span class="active">Detail</span>
        </div>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Hero Banner - TANPA TOMBOL CETAK -->
        <div class="hero-banner">
            <div class="hero-content">
                <h1 class="hero-title">
                    <i class="bi bi-building"></i> {{ $kecamatan->nama_kecamatan }}
                </h1>
                <p class="hero-subtitle">
                    Kabupaten {{ $kecamatan->kabupaten ?? 'Tuban' }} • Kode Wilayah {{ $kecamatan->kode_wilayah ?? '-' }}
                </p>
                <span class="hero-badge">Status Aktif</span>
            </div>
        </div>
        
        <!-- Stats Grid - 3 KOLOM (Tahun Dibentuk Dihapus) -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-houses"></i></div>
                <div class="stat-value">{{ $kecamatan->desas->count() }}</div>
                <div class="stat-label">Total Desa</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-geo-alt"></i></div>
                <div class="stat-value">{{ $kecamatan->kode_wilayah ?? '-' }}</div>
                <div class="stat-label">Kode Wilayah</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="bi bi-map"></i></div>
                <div class="stat-value">{{ $kecamatan->kabupaten ?? 'Tuban' }}</div>
                <div class="stat-label">Kabupaten</div>
            </div>
        </div>
        
        <!-- Two Column Layout -->
        <div class="detail-layout">
            <!-- Informasi Umum -->
            <div class="detail-section">
                <div class="section-header">
                    <i class="bi bi-info-circle"></i>
                    <h5>Informasi Umum</h5>
                </div>
                <div class="section-body">
                    <ul class="info-list">
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-building"></i> Kecamatan</span>
                            <span class="info-list-value">{{ $kecamatan->nama_kecamatan }}</span>
                        </li>
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-geo-alt"></i> Kode Wilayah</span>
                            <span class="info-list-value">{{ $kecamatan->kode_wilayah ?? '-' }}</span>
                        </li>
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-map"></i> Kabupaten</span>
                            <span class="info-list-value">{{ $kecamatan->kabupaten ?? 'Tuban' }}</span>
                        </li>
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-houses"></i> Jumlah Desa</span>
                            <span class="info-list-value">{{ $kecamatan->jumlah_desa ?? $kecamatan->desas->count() }} Desa</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Kontak -->
            <div class="detail-section">
                <div class="section-header">
                    <i class="bi bi-telephone"></i>
                    <h5>Informasi Kontak</h5>
                </div>
                <div class="section-body">
                    <ul class="info-list">
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-telephone"></i> Telepon</span>
                            <span class="info-list-value {{ !$kecamatan->telepon ? 'empty' : '' }}">
                                {{ $kecamatan->telepon ?? 'Belum diisi' }}
                            </span>
                        </li>
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-envelope"></i> Email</span>
                            <span class="info-list-value {{ !$kecamatan->email ? 'empty' : '' }}">
                                {{ $kecamatan->email ?? 'Belum diisi' }}
                            </span>
                        </li>
                        <li class="info-list-item">
                            <span class="info-list-label"><i class="bi bi-pin-map"></i> Alamat</span>
                            <span class="info-list-value {{ !$kecamatan->alamat ? 'empty' : '' }}">
                                {{ $kecamatan->alamat ?? 'Belum diisi' }}
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Deskripsi -->
            @if($kecamatan->deskripsi)
            <div class="detail-section full-width">
                <div class="section-header">
                    <i class="bi bi-file-text"></i>
                    <h5>Deskripsi Kecamatan</h5>
                </div>
                <div class="section-body">
                    <div class="deskripsi-content">
                        {{ $kecamatan->deskripsi }}
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Daftar Desa - TANPA KOLOM LUAS WILAYAH -->
            <div class="detail-section full-width">
                <div class="section-header">
                    <i class="bi bi-houses"></i>
                    <h5>Daftar Desa dalam Kecamatan</h5>
                    <span class="badge-count">{{ $kecamatan->desas->count() }} Desa</span>
                </div>
                <div class="desa-table-wrapper">
                    @if($kecamatan->desas->count() > 0)
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Desa</th>
                                    <th>Kode Desa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kecamatan->desas as $index => $desa)
                                <tr>
                                    <td class="no-cell">{{ $index + 1 }}</td>
                                    <td class="nama-cell">{{ $desa->nama_desa }}</td>
                                    <td class="kode-cell">{{ $desa->kode_desa ?? '-' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="text-center py-5 text-muted">
                            <i class="bi bi-inbox" style="font-size: 40px; display: block; margin-bottom: 12px; color: #cbd5e1;"></i>
                            <p style="font-size: 14px; margin: 0; color: #64748b;">Belum ada data desa dalam kecamatan ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- ===== PRINT ONLY CONTENT ===== -->
        
        <div class="print-header">
            <h1>LAPORAN DATA KECAMATAN</h1>
            <h2>Kecamatan {{ $kecamatan->nama_kecamatan }}</h2>
            <div class="print-meta">
                Kabupaten {{ $kecamatan->kabupaten ?? 'Tuban' }} | 
                Dicetak: {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm') }}
            </div>
        </div>
        
        <div class="print-info">
            <h3>Informasi Umum</h3>
            <table class="print-info-table">
                <tr><td>Kecamatan</td><td>{{ $kecamatan->nama_kecamatan }}</td></tr>
                <tr><td>Kode Wilayah</td><td>{{ $kecamatan->kode_wilayah ?? '-' }}</td></tr>
                <tr><td>Kabupaten</td><td>{{ $kecamatan->kabupaten ?? 'Tuban' }}</td></tr>
                <tr><td>Jumlah Desa</td><td>{{ $kecamatan->desas->count() }} Desa</td></tr>
                <tr><td>Telepon</td><td>{{ $kecamatan->telepon ?? '-' }}</td></tr>
                <tr><td>Email</td><td>{{ $kecamatan->email ?? '-' }}</td></tr>
                <tr><td>Alamat Kantor</td><td>{{ $kecamatan->alamat ?? '-' }}</td></tr>
            </table>
        </div>
        
        @if($kecamatan->deskripsi)
        <div class="print-info">
            <h3>Deskripsi</h3>
            <div style="font-size: 10pt; line-height: 1.6; color: #334155;">
                {{ $kecamatan->deskripsi }}
            </div>
        </div>
        @endif
        
        <div class="print-desa">
            <h3>Daftar Desa ({{ $kecamatan->desas->count() }})</h3>
            @if($kecamatan->desas->count() > 0)
                <table class="print-desa-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">No</th>
                            <th>Nama Desa</th>
                            <th>Kode</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kecamatan->desas as $index => $desa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><strong>{{ $desa->nama_desa }}</strong></td>
                            <td>{{ $desa->kode_desa ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        
        <div class="print-footer">
            Portal Desa Digital - Kabupaten Tuban | Dicetak pada {{ now()->locale('id')->isoFormat('D MMMM YYYY HH:mm') }}
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>