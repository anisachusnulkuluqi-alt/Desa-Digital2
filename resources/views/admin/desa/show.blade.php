<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desa - {{ $desa->nama_desa }} - Portal Desa Digital</title>
    
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
        
        .date-display {
            font-size: 13px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .main-content { padding: 20px 36px; max-width: 1000px; margin: 0 auto; }
        
        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-title i { color: #1e3a8a; font-size: 28px; }
        .page-subtitle { color: #64748b; font-size: 14px; margin-bottom: 20px; }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .detail-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 20px 34px;
            color: white;
        }
        
        .detail-header h2 {
            font-size: 24px;
            font-weight: 800;
            margin: 0 0 6px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .detail-header p { margin: 0; opacity: 0.9; font-size: 14px; }
        
        .detail-body { padding: 24px 34px; }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        
        .info-item {
            padding: 16px 20px;
            background: #f8fafc;
            border-radius: 10px;
            border-left: 4px solid #1e3a8a;
        }
        
        .info-label {
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        
        .info-value {
            font-size: 17px;
            font-weight: 700;
            color: #1e293b;
        }
        
        .info-value.text-muted {
            color: #94a3b8;
            font-style: italic;
        }
        
        .badge-jenis {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
        }
        
        .badge-desa { background: #dbeafe; color: #1e40af; }
        .badge-kelurahan { background: #fef3c7; color: #d97706; }
        
        .social-section {
            margin-top: 24px;
        }
        
        .section-title {
            font-size: 16px;
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
        
        .social-row {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 14px 20px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            transition: all 0.2s;
        }
        
        .social-row:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
            transform: translateX(4px);
        }
        
        .social-row.empty {
            opacity: 0.5;
            background: #f8fafc;
        }
        
        .social-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 22px;
            flex-shrink: 0;
        }
        
        .social-icon-box.web { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .social-icon-box.yt { background: #dc2626; }
        .social-icon-box.ig { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-icon-box.fb { background: #1877f2; }
        .social-icon-box.tt { background: #000000; }
        .social-icon-box.wa { background: #25d366; }
        
        .social-info { flex: 1; min-width: 0; }
        
        .social-label {
            font-size: 11px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        
        .social-value {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .social-value.empty-text {
            color: #94a3b8;
            font-style: italic;
            font-weight: 500;
        }
        
        .social-action a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 12px;
            background: white;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            color: #1e3a8a;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .social-action a:hover {
            background: #1e3a8a;
            color: white;
            border-color: #1e3a8a;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            margin-top: 24px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            text-decoration: none;
        }
        
        .btn-back {
            background: white;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
        }
        
        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #1e293b;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #14b8a6, #0f766e);
            color: white;
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.25);
        }
        
        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(20, 184, 166, 0.35);
            color: white;
        }
        
        .btn-delete {
            background: #fee2e2;
            color: #dc2626;
        }
        
        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }
        
        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
            .social-row { flex-direction: column; align-items: flex-start; }
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
        <h1 class="page-title">
            <i class="bi bi-geo-alt-fill"></i>
            Detail Desa
        </h1>
        <p class="page-subtitle">Informasi lengkap {{ $desa->nama_desa }}</p>

        <div class="detail-card">
            <div class="detail-header">
                <h2>
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $desa->nama_desa }}
                </h2>
                <p>Kecamatan {{ $desa->kecamatan->nama_kecamatan ?? '-' }}</p>
            </div>
            
            <div class="detail-body">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Kode Desa</div>
                        <div class="info-value">{{ $desa->kode_desa ?? '-' }}</div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Jenis</div>
                        <div class="info-value">
                            @if($desa->jenis == 'Desa')
                                <span class="badge-jenis badge-desa">Desa</span>
                            @elseif($desa->jenis == 'Kelurahan')
                                <span class="badge-jenis badge-kelurahan">Kelurahan</span>
                            @else
                                <span class="badge-jenis" style="background: #f1f5f9; color: #64748b;">-</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Kecamatan</div>
                        <div class="info-value">{{ $desa->kecamatan->nama_kecamatan ?? '-' }}</div>
                    </div>
                </div>

                <div class="social-section">
                    <h3 class="section-title">
                        <i class="bi bi-share-fill"></i>
                        Media Sosial & Kontak
                    </h3>
                    
                    <div class="social-list">
                        <div class="social-row {{ !$desa->website ? 'empty' : '' }}">
                            <div class="social-icon-box web">
                                <i class="bi bi-globe"></i>
                            </div>
                            <div class="social-info">
                                <div class="social-label">Website</div>
                                <div class="social-value {{ !$desa->website ? 'empty-text' : '' }}">
                                    {{ $desa->website ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                            @if($desa->website)
                            <div class="social-action">
                                <a href="{{ $desa->website }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    Kunjungi
                                </a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="social-row {{ !$desa->youtube ? 'empty' : '' }}">
                            <div class="social-icon-box yt">
                                <i class="bi bi-youtube"></i>
                            </div>
                            <div class="social-info">
                                <div class="social-label">YouTube</div>
                                <div class="social-value {{ !$desa->youtube ? 'empty-text' : '' }}">
                                    {{ $desa->youtube ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                            @if($desa->youtube)
                            <div class="social-action">
                                <a href="{{ $desa->youtube }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    Kunjungi
                                </a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="social-row {{ !$desa->instagram ? 'empty' : '' }}">
                            <div class="social-icon-box ig">
                                <i class="bi bi-instagram"></i>
                            </div>
                            <div class="social-info">
                                <div class="social-label">Instagram</div>
                                <div class="social-value {{ !$desa->instagram ? 'empty-text' : '' }}">
                                    {{ $desa->instagram ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                            @if($desa->instagram)
                            <div class="social-action">
                                <a href="{{ $desa->instagram }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    Kunjungi
                                </a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="social-row {{ !$desa->facebook ? 'empty' : '' }}">
                            <div class="social-icon-box fb">
                                <i class="bi bi-facebook"></i>
                            </div>
                            <div class="social-info">
                                <div class="social-label">Facebook</div>
                                <div class="social-value {{ !$desa->facebook ? 'empty-text' : '' }}">
                                    {{ $desa->facebook ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                            @if($desa->facebook)
                            <div class="social-action">
                                <a href="{{ $desa->facebook }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    Kunjungi
                                </a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="social-row {{ !$desa->tiktok ? 'empty' : '' }}">
                            <div class="social-icon-box tt">
                                <i class="bi bi-tiktok"></i>
                            </div>
                            <div class="social-info">
                                <div class="social-label">TikTok</div>
                                <div class="social-value {{ !$desa->tiktok ? 'empty-text' : '' }}">
                                    {{ $desa->tiktok ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                            @if($desa->tiktok)
                            <div class="social-action">
                                <a href="{{ $desa->tiktok }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    Kunjungi
                                </a>
                            </div>
                            @endif
                        </div>
                        
                        <div class="social-row {{ !$desa->whatsapp ? 'empty' : '' }}">
                            <div class="social-icon-box wa">
                                <i class="bi bi-whatsapp"></i>
                            </div>
                            <div class="social-info">
                                <div class="social-label">WhatsApp</div>
                                <div class="social-value {{ !$desa->whatsapp ? 'empty-text' : '' }}">
                                    {{ $desa->whatsapp ?? 'Belum ditambahkan' }}
                                </div>
                            </div>
                            @if($desa->whatsapp)
                            <div class="social-action">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $desa->whatsapp) }}" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    Chat
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.desa.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                    <a href="{{ route('admin.desa.edit', $desa->id) }}" class="btn btn-edit">
                        <i class="bi bi-pencil"></i>
                        Edit Data
                    </a>
                    <form action="{{ route('admin.desa.destroy', $desa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus desa ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            <i class="bi bi-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>