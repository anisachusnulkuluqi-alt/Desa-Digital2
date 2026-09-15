<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Desa - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        .header { background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%); padding: 15px 30px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon { width: 45px; height: 45px; background: rgba(255,255,255,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; }
        .header-logo-text h5 { margin: 0; font-weight: 800; font-size: 18px; color: white; }
        .header-logo-text small { color: rgba(255,255,255,0.9); font-size: 11px; }
        .header-user { display: flex; align-items: center; gap: 12px; color: white; }
        .header-user-avatar { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; font-weight: 700; }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        .breadcrumb-bar { background: white; padding: 12px 30px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e2e8f0; font-size: 13px; }
        .breadcrumb-bar a { color: #64748b; text-decoration: none; font-weight: 500; }
        .breadcrumb-bar a:hover { color: #1e88e5; }
        .breadcrumb-bar .active { color: #1e88e5; font-weight: 600; }
        .breadcrumb-bar .separator { color: #cbd5e1; margin: 0 8px; }
        .breadcrumb-date { color: #64748b; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
        .breadcrumb-date i { color: #94a3b8; }
        .main-content { padding: 30px; max-width: 1200px; margin: 0 auto; }
        .page-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; flex-wrap: wrap; gap: 16px; }
        .page-title h1 { font-size: 28px; font-weight: 800; color: #0f172a; margin: 0; display: flex; align-items: center; gap: 10px; }
        .page-title h1 i { color: #1e88e5; }
        .page-title p { color: #64748b; font-size: 14px; margin: 0; margin-top: 4px; }
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; border: none; cursor: pointer; transition: all 0.2s; }
        .btn-back { background: white; color: #475569; border: 1px solid #e2e8f0; }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #0f172a; }
        .btn-edit { background: linear-gradient(135deg, #1e88e5, #00897b); color: white; }
        .btn-edit:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(30,136,229,0.3); color: white; }
        .btn-delete { background: #ef4444; color: white; }
        .btn-delete:hover { background: #dc2626; color: white; }
        .detail-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 20px; }
        .card-header-modern { background: linear-gradient(135deg, #1e3a8a, #00897b); color: white; padding: 16px 20px; font-weight: 700; font-size: 16px; display: flex; align-items: center; gap: 8px; }
        .card-body-modern { padding: 24px; }
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
        .info-item { padding: 16px; background: #f8fafc; border-radius: 8px; border-left: 4px solid #1e88e5; }
        .info-item.full { grid-column: 1 / -1; }
        .info-label { font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: flex; align-items: center; gap: 6px; }
        .info-label i { color: #1e88e5; font-size: 14px; }
        .info-value { font-size: 15px; font-weight: 600; color: #0f172a; line-height: 1.4; }
        .info-value.empty { color: #94a3b8; font-style: italic; }
        .action-buttons { display: flex; gap: 10px; margin-top: 20px; }
        @media (max-width: 768px) { .info-grid { grid-template-columns: 1fr; } .main-content { padding: 20px; } }
    </style>
</head>
<body>
    <header class="header">
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
    
    <div class="breadcrumb-bar">
        <div>
            <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Home</a>
            <span class="separator">/</span>
            <a href="{{ route('admin.desa.index') }}">Data Desa</a>
            <span class="separator">/</span>
            <span class="active">Detail</span>
        </div>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i>
            {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>
    
    <div class="main-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="bi bi-geo-alt-fill"></i> Detail Desa {{ $desa->nama_desa }}</h1>
                <p>Informasi lengkap desa {{ $desa->nama_desa }}</p>
            </div>
            <div class="action-buttons">
                <a href="{{ route('admin.desa.index') }}" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <a href="{{ route('admin.desa.edit', $desa->id) }}" class="btn btn-edit">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('admin.desa.destroy', $desa->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus desa {{ $desa->nama_desa }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-delete">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        
        <div class="detail-card">
            <div class="card-header-modern">
                <i class="bi bi-info-circle"></i> Informasi Desa
            </div>
            <div class="card-body-modern">
                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-building"></i> Nama Desa</div>
                        <div class="info-value">{{ $desa->nama_desa }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-geo-alt"></i> Kode Desa</div>
                        <div class="info-value">{{ $desa->kode_desa ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-map"></i> Kecamatan</div>
                        <div class="info-value">{{ $desa->kecamatan->nama_kecamatan ?? '-' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-person"></i> Kepala Desa</div>
                        <div class="info-value {{ !$desa->kepala_desa ? 'empty' : '' }}">{{ $desa->kepala_desa ?? 'Belum diisi' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-people"></i> Jumlah Penduduk</div>
                        <div class="info-value">{{ number_format($desa->jumlah_penduduk ?? 0) }} Jiwa</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-house-heart"></i> Jumlah KK</div>
                        <div class="info-value">{{ number_format($desa->jumlah_kk ?? 0) }} KK</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-rulers"></i> Luas Wilayah</div>
                        <div class="info-value">{{ $desa->luas_wilayah ?? '-' }} km²</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-telephone"></i> Telepon</div>
                        <div class="info-value {{ !$desa->telepon ? 'empty' : '' }}">{{ $desa->telepon ?? 'Belum diisi' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label"><i class="bi bi-envelope"></i> Email</div>
                        <div class="info-value {{ !$desa->email ? 'empty' : '' }}">{{ $desa->email ?? 'Belum diisi' }}</div>
                    </div>
                    <div class="info-item full">
                        <div class="info-label"><i class="bi bi-pin-map"></i> Alamat</div>
                        <div class="info-value {{ !$desa->alamat ? 'empty' : '' }}">{{ $desa->alamat ?? 'Belum diisi' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
