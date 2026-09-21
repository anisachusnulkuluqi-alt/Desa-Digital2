<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Wisata - {{ $wisata->nama_wisata }} - Portal Desa Digital</title>
    
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
        
        .main-content { padding: 28px 36px; max-width: 1200px; margin: 0 auto; }
        
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
        .page-subtitle { color: #64748b; font-size: 14px; margin-bottom: 24px; }
        
        .detail-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .detail-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 28px 34px;
            color: white;
        }
        
        .detail-header h2 {
            font-size: 26px;
            font-weight: 800;
            margin: 0 0 8px 0;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .detail-header p { margin: 0; opacity: 0.9; font-size: 15px; }
        
        .detail-body { padding: 32px 34px; }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }
        
        .info-item {
            padding: 18px 22px;
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
            background: rgba(255,255,255,0.2);
            color: white;
        }
        
        .foto-section { margin-bottom: 28px; }
        
        .foto-container {
            width: 100%;
            max-height: 500px;
            border-radius: 12px;
            overflow: hidden;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .foto-container img {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
        }
        
        .foto-placeholder {
            padding: 80px 20px;
            text-align: center;
            color: #94a3b8;
        }
        
        .foto-placeholder i {
            font-size: 64px;
            margin-bottom: 16px;
            display: block;
        }
        
        .deskripsi-section { margin-bottom: 28px; }
        
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .deskripsi-content {
            padding: 22px 24px;
            background: #f8fafc;
            border-radius: 10px;
            border-left: 4px solid #1e3a8a;
            font-size: 14px;
            line-height: 1.8;
            color: #1e293b;
        }
        
        .koordinat-section { margin-bottom: 28px; }
        
        .koordinat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
            margin-top: 28px;
        }
        
        .btn {
            padding: 11px 24px;
            border-radius: 10px;
            font-size: 14px;
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
            .koordinat-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.wisata.index') }}">Wisata Desa</a></li>
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
            <i class="bi bi-image-fill"></i>
            Detail Wisata
        </h1>
        <p class="page-subtitle">Informasi lengkap {{ $wisata->nama_wisata }}</p>

        <div class="detail-card">
            <div class="detail-header">
                <h2>
                    <i class="bi bi-image-fill"></i>
                    {{ $wisata->nama_wisata }}
                </h2>
                <p>
                    <i class="bi bi-geo-alt-fill"></i>
                    Desa {{ $wisata->desa ?? '-' }}
                    @if($wisata->jenis_wisata)
                        • <span class="badge-jenis">{{ $wisata->jenis_wisata }}</span>
                    @endif
                </p>
            </div>
            
            <div class="detail-body">
                {{-- Foto --}}
                @if($wisata->foto)
                <div class="foto-section">
                    <h3 class="section-title">
                        <i class="bi bi-camera-fill"></i>
                        Foto Wisata
                    </h3>
                    <div class="foto-container">
                        <img src="{{ asset('storage/' . $wisata->foto) }}" alt="{{ $wisata->alt ?? $wisata->nama_wisata }}">
                    </div>
                    @if($wisata->alt)
                    <p style="margin-top: 10px; font-size: 12px; color: #64748b; font-style: italic;">
                        <i class="bi bi-info-circle"></i> {{ $wisata->alt }}
                    </p>
                    @endif
                </div>
                @else
                <div class="foto-section">
                    <h3 class="section-title">
                        <i class="bi bi-camera-fill"></i>
                        Foto Wisata
                    </h3>
                    <div class="foto-container">
                        <div class="foto-placeholder">
                            <i class="bi bi-image"></i>
                            <p>Belum ada foto</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Informasi Dasar --}}
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Jam Operasional</div>
                        <div class="info-value">
                            {{ $wisata->jam_operasional ?? '-' }}
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Harga Tiket Masuk</div>
                        <div class="info-value">
                            {{ $wisata->htm ? 'Rp ' . number_format($wisata->htm) : '-' }}
                        </div>
                    </div>
                    
                    <div class="info-item">
                        <div class="info-label">Reservasi</div>
                        <div class="info-value">
                            {{ $wisata->reservasi ?? '-' }}
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                @if($wisata->deskripsi)
                <div class="deskripsi-section">
                    <h3 class="section-title">
                        <i class="bi bi-file-text-fill"></i>
                        Deskripsi
                    </h3>
                    <div class="deskripsi-content">
                        {{ $wisata->deskripsi }}
                    </div>
                </div>
                @endif

                {{-- Koordinat --}}
                @if($wisata->latitude || $wisata->longitude)
                <div class="koordinat-section">
                    <h3 class="section-title">
                        <i class="bi bi-geo-alt-fill"></i>
                        Koordinat Lokasi
                    </h3>
                    <div class="koordinat-grid">
                        <div class="info-item">
                            <div class="info-label">Latitude</div>
                            <div class="info-value">{{ $wisata->latitude ?? '-' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Longitude</div>
                            <div class="info-value">{{ $wisata->longitude ?? '-' }}</div>
                        </div>
                    </div>
                    @if($wisata->latitude && $wisata->longitude)
                    <div style="margin-top: 14px;">
                        <a href="https://www.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}" target="_blank" class="btn btn-back" style="font-size: 12px; padding: 8px 16px;">
                            <i class="bi bi-map-fill"></i>
                            Buka di Google Maps
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                {{-- ✅ ACTION BUTTONS (SUDAH DIPERBAIKI 100%) --}}
                <div class="action-buttons">
                    <a href="{{ route('admin.wisata.index') }}" class="btn btn-back">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                    
                    <a href="{{ route('admin.wisata.edit', $wisata->id) }}" class="btn btn-edit">
                        <i class="bi bi-pencil"></i>
                        Edit Data
                    </a>
                    
                    <form action="{{ route('admin.wisata.destroy', $wisata->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus wisata ini?')">
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