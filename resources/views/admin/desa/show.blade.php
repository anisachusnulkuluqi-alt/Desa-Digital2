<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desa - {{ $desa->nama_desa }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        .page-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 36px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .breadcrumb { margin: 0; font-size: 14px; }
        .breadcrumb a { color: #64748b; text-decoration: none; }
        .breadcrumb a:hover { color: #1e3a8a; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        
        .date-display { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 6px; }
        
        .main-content { padding: 28px 36px; max-width: 1200px; margin: 0 auto; }
        
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #1e3a8a;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 20px;
            padding: 8px 16px;
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            transition: all 0.2s;
        }
        
        .btn-back:hover {
            background: #1e3a8a;
            color: white;
            border-color: #1e3a8a;
        }
        
        .desa-header-card {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            border-radius: 12px;
            padding: 28px 32px;
            margin-bottom: 24px;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.2);
        }
        
        .desa-header-card h1 {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .desa-header-card p {
            font-size: 16px;
            opacity: 0.9;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }
        
        .info-card {
            background: white;
            border-radius: 12px;
            padding: 20px 24px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            border-left: 4px solid #1e3a8a;
        }
        
        .info-card-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .info-card-value {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .social-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .social-item {
            background: white;
            border-radius: 12px;
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            transition: all 0.2s;
        }
        
        .social-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .social-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: white;
            flex-shrink: 0;
        }
        
        .social-icon.website { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .social-icon.youtube { background: linear-gradient(135deg, #ef4444, #dc2626); }
        .social-icon.instagram { background: linear-gradient(135deg, #ec4899, #db2777); }
        .social-icon.facebook { background: linear-gradient(135deg, #1d4ed8, #1e40af); }
        .social-icon.tiktok { background: linear-gradient(135deg, #111827, #374151); }
        .social-icon.whatsapp { background: linear-gradient(135deg, #10b981, #059669); }
        
        .social-info { flex: 1; }
        
        .social-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        
        .social-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 500;
        }
        
        .social-value.empty {
            color: #94a3b8;
            font-style: italic;
        }
        
        .social-value a {
            color: #1e40af;
            text-decoration: none;
        }
        
        .social-value a:hover {
            text-decoration: underline;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35);
            color: white;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        
        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
            .main-content { padding: 18px; }
            .desa-header-card h1 { font-size: 24px; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.desa.index') }}">Data Desa</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        <a href="{{ route('admin.desa.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Desa
        </a>

        <div class="desa-header-card">
            <h1>
                <i class="bi bi-geo-alt-fill"></i>
                {{ $desa->nama_desa }}
            </h1>
            <p>
                <i class="bi bi-building"></i>
                Kecamatan {{ $desa->kecamatan->nama_kecamatan ?? '-' }}
            </p>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <div class="info-card-label">Kode Desa</div>
                <div class="info-card-value">{{ $desa->kode_desa ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label">Jenis</div>
                <div class="info-card-value">{{ $desa->jenis ?? '-' }}</div>
            </div>
            <div class="info-card">
                <div class="info-card-label">Kecamatan</div>
                <div class="info-card-value">{{ $desa->kecamatan->nama_kecamatan ?? '-' }}</div>
            </div>
        </div>

        <h2 class="section-title">
            <i class="bi bi-share-fill"></i>
            Media Sosial & Kontak
        </h2>

        <div class="social-list">
            <div class="social-item">
                <div class="social-icon website">
                    <i class="bi bi-globe"></i>
                </div>
                <div class="social-info">
                    <div class="social-label">Website</div>
                    <div class="social-value {{ $desa->website ? '' : 'empty' }}">
                        @if($desa->website)
                            <a href="{{ $desa->website }}" target="_blank">{{ $desa->website }}</a>
                        @else
                            Belum ditambahkan
                        @endif
                    </div>
                </div>
            </div>

            <div class="social-item">
                <div class="social-icon youtube">
                    <i class="bi bi-youtube"></i>
                </div>
                <div class="social-info">
                    <div class="social-label">YouTube</div>
                    <div class="social-value {{ $desa->youtube_url ? '' : 'empty' }}">
                        @if($desa->youtube_url)
                            <a href="{{ $desa->youtube_url }}" target="_blank">{{ $desa->youtube_url }}</a>
                        @else
                            Belum ditambahkan
                        @endif
                    </div>
                </div>
            </div>

            <div class="social-item">
                <div class="social-icon instagram">
                    <i class="bi bi-instagram"></i>
                </div>
                <div class="social-info">
                    <div class="social-label">Instagram</div>
                    <div class="social-value {{ $desa->instagram_url ? '' : 'empty' }}">
                        @if($desa->instagram_url)
                            <a href="{{ $desa->instagram_url }}" target="_blank">{{ $desa->instagram_url }}</a>
                        @else
                            Belum ditambahkan
                        @endif
                    </div>
                </div>
            </div>

            <div class="social-item">
                <div class="social-icon facebook">
                    <i class="bi bi-facebook"></i>
                </div>
                <div class="social-info">
                    <div class="social-label">Facebook</div>
                    <div class="social-value {{ $desa->facebook_url ? '' : 'empty' }}">
                        @if($desa->facebook_url)
                            <a href="{{ $desa->facebook_url }}" target="_blank">{{ $desa->facebook_url }}</a>
                        @else
                            Belum ditambahkan
                        @endif
                    </div>
                </div>
            </div>

            <div class="social-item">
                <div class="social-icon tiktok">
                    <i class="bi bi-tiktok"></i>
                </div>
                <div class="social-info">
                    <div class="social-label">TikTok</div>
                    <div class="social-value {{ $desa->tiktok_url ? '' : 'empty' }}">
                        @if($desa->tiktok_url)
                            <a href="{{ $desa->tiktok_url }}" target="_blank">{{ $desa->tiktok_url }}</a>
                        @else
                            Belum ditambahkan
                        @endif
                    </div>
                </div>
            </div>

            <div class="social-item">
                <div class="social-icon whatsapp">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <div class="social-info">
                    <div class="social-label">WhatsApp</div>
                    <div class="social-value {{ $desa->whatsapp_url ? '' : 'empty' }}">
                        @if($desa->whatsapp_url)
                            <a href="{{ $desa->whatsapp_url }}" target="_blank">{{ $desa->whatsapp_url }}</a>
                        @else
                            Belum ditambahkan
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('admin.desa.edit', $desa->id) }}" class="btn-edit">
                <i class="bi bi-pencil"></i> Edit Desa
            </a>
        </div>
    </div>
</body>
</html>