<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wisata Desa - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        .page-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 18px 32px;
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
        
        .main-content { padding: 28px 32px; max-width: 1200px; margin: 0 auto; }
        
        .page-title {
            font-size: 26px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-title i { color: #1e3a8a; }
        .page-subtitle { color: #64748b; font-size: 14px; margin-bottom: 26px; }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 26px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            border-left: 4px solid #1e3a8a;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        
        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }
        
        .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .stat-icon.purple { background: linear-gradient(135deg, #8b5cf6, #6d28d9); }
        
        .stat-info h3 {
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
            line-height: 1;
        }
        
        .stat-info p {
            font-size: 12px;
            color: #64748b;
            margin: 4px 0 0 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        
        .search-bar {
            background: white;
            border-radius: 12px;
            padding: 18px 20px;
            margin-bottom: 22px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
        }
        
        .search-box { position: relative; }
        
        .search-box input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: #1e3a8a;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08);
        }
        
        .search-box i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 16px;
        }
        
        .table-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.06);
            overflow: hidden;
        }
        
        .table-header {
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .table-title {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .badge-count {
            background: #1e3a8a;
            color: white;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .btn-add {
            background: linear-gradient(135deg, #14b8a6, #0f766e);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-add:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
            color: white;
        }
        
        .table-simple { width: 100%; border-collapse: collapse; }
        .table-simple thead { background: #f8fafc; }
        
        .table-simple th {
            padding: 14px 24px;
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table-simple td {
            padding: 16px 24px;
            font-size: 14px;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .table-simple tbody tr:last-child td { border-bottom: none; }
        
        .wisata-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #1e293b;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s;
            cursor: pointer;
        }
        
        .wisata-link:hover {
            background: #eff6ff;
            color: #1e40af;
            transform: translateX(4px);
        }
        
        .wisata-link:hover .wisata-icon {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            transform: scale(1.05);
        }
        
        .wisata-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e40af;
            font-size: 16px;
            transition: all 0.2s;
            flex-shrink: 0;
        }
        
        .wisata-name {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
        }
        
        .badge-jenis {
            padding: 5px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            background: #dbeafe;
            color: #1e40af;
        }
        
        .alert-success-custom {
            background: #d1fae5;
            border: 1px solid #10b981;
            color: #065f46;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .empty-state {
            text-align: center;
            padding: 48px;
            color: #94a3b8;
        }
        
        .empty-state i { font-size: 36px; display: block; margin-bottom: 12px; }
        
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 18px; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item active">Wisata Desa</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
        @endif

        <h1 class="page-title">
            <i class="bi bi-image-fill"></i>
            Wisata Desa
        </h1>
        <p class="page-subtitle">Kelola data wisata desa di Kabupaten Tuban</p>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="bi bi-image-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalWisata }}</h3>
                    <p>Total Wisata</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $wisatas->where('jenis_wisata', '!=', null)->unique('jenis_wisata')->count() }}</h3>
                    <p>Jenis Wisata</p>
                </div>
            </div>
        </div>

        <div class="search-bar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama wisata...">
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <div class="table-title">
                    <i class="bi bi-list-ul"></i>
                    Daftar Wisata
                    <span class="badge-count">{{ $wisatas->count() }} Wisata</span>
                </div>
                <a href="{{ route('admin.wisata.create') }}" class="btn-add">
                    <i class="bi bi-plus-lg"></i>
                    Tambah Wisata
                </a>
            </div>

            <table class="table-simple">
                <thead>
                    <tr>
                        <th style="width: 70px;">NO</th>
                        <th>NAMA WISATA</th>
                        <th>DESA</th>
                        <th>JENIS</th>
                        <th>HTM</th>
                    </tr>
                </thead>
                <tbody id="wisataTable">
                    @forelse($wisatas as $index => $wisata)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="{{ route('admin.wisata.show', $wisata->id) }}" class="wisata-link">
                                <div class="wisata-icon">
                                    <i class="bi bi-image"></i>
                                </div>
                                <span class="wisata-name">{{ $wisata->nama_wisata }}</span>
                            </a>
                        </td>
                        <td>{{ $wisata->desa ?? '-' }}</td>
                        <td>
                            <span class="badge-jenis">
                                {{ $wisata->jenis_wisata ?? '-' }}
                            </span>
                        </td>
                        <td>{{ $wisata->htm ? 'Rp ' . number_format($wisata->htm) : '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                Belum ada data wisata
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#wisataTable tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>
</html>