<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Dusun - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { 
            background: #f1f5f9;
            background-image: radial-gradient(at 0% 0%, rgba(14, 165, 233, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(20, 184, 166, 0.08) 0px, transparent 50%);
            background-attachment: fixed;
        }
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 14px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e2e8f0;
        }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 20px;
        }
        .header-logo-text h5 { margin: 0; font-weight: 800; font-size: 15px; color: #0f172a; }
        .header-logo-text small { color: #64748b; font-size: 11px; }
        .main-content { padding: 30px; max-width: 1400px; margin: 0 auto; }
        .page-header {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 24px; flex-wrap: wrap; gap: 16px;
        }
        .page-title h1 {
            font-size: 24px; font-weight: 800; color: #0f172a;
            margin-bottom: 6px; display: flex; align-items: center; gap: 10px;
        }
        .page-title h1 i { color: #6366f1; }
        .page-title p { color: #64748b; font-size: 14px; margin: 0; }
        .btn {
            padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600;
            text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
            border: none; cursor: pointer; transition: all 0.2s;
        }
        .btn-back { background: white; color: #475569; border: 1px solid #e2e8f0; }
        .btn-back:hover { background: #f8fafc; }
        .btn-add { background: linear-gradient(135deg, #6366f1, #4f46e5); color: white; }
        .btn-add:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3); color: white; }
        .stats-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;
        }
        .stat-card {
            background: white; border-radius: 12px; padding: 20px;
            border: 1px solid #e2e8f0; border-left: 4px solid #6366f1;
            display: flex; align-items: center; gap: 14px;
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; color: white;
        }
        .stat-icon.indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }
        .stat-icon.teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }
        .stat-icon.blue { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
        .stat-icon.cyan { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        .stat-value { font-size: 22px; font-weight: 700; color: #0f172a; line-height: 1; margin-bottom: 4px; }
        .stat-label { font-size: 11px; color: #64748b; font-weight: 500; }
        .filter-bar {
            background: white; border-radius: 12px; padding: 16px 20px;
            border: 1px solid #e2e8f0; margin-bottom: 20px;
            display: flex; gap: 12px; flex-wrap: wrap; align-items: center;
        }
        .search-box { flex: 1; min-width: 250px; position: relative; }
        .search-box input {
            width: 100%; padding: 10px 16px 10px 40px;
            border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px;
        }
        .search-box i {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); color: #94a3b8;
        }
        .filter-select {
            padding: 10px 16px; border: 1px solid #e2e8f0;
            border-radius: 8px; font-size: 13px; min-width: 200px;
        }
        .table-card {
            background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden;
        }
        .table-header {
            padding: 16px 20px; border-bottom: 1px solid #e2e8f0;
            display: flex; justify-content: space-between; align-items: center;
        }
        .table-header h5 {
            margin: 0; font-size: 15px; font-weight: 700; color: #0f172a;
            display: flex; align-items: center; gap: 8px;
        }
        .table-header h5 i { color: #6366f1; }
        .badge-count {
            background: #6366f1; color: white; padding: 3px 10px;
            border-radius: 12px; font-size: 11px; font-weight: 600;
        }
        .table-modern { width: 100%; border-collapse: collapse; font-size: 13px; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th {
            padding: 12px 16px; text-align: left; font-weight: 600;
            color: #64748b; font-size: 11px; text-transform: uppercase;
            border-bottom: 1px solid #e2e8f0;
        }
        .table-modern td {
            padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #334155;
        }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .no-cell { font-weight: 600; color: #6366f1; width: 50px; }
        .nama-cell { font-weight: 600; color: #0f172a; }
        .btn-action {
            width: 32px; height: 32px; border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 13px; margin-right: 4px; cursor: pointer;
        }
        .btn-detail { background: #eef2ff; color: #4f46e5; }
        .btn-detail:hover { background: #4f46e5; color: white; }
        .btn-edit { background: #fef3c7; color: #92400e; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fee2e2; color: #991b1b; }
        .btn-delete:hover { background: #ef4444; color: white; }
        .pagination-info {
            display: flex; justify-content: space-between; align-items: center;
            padding: 16px 20px; border-top: 1px solid #e2e8f0;
        }
        .alert-custom { border-radius: 8px; border: none; padding: 12px 16px; margin-bottom: 20px; }
        @media (max-width: 992px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) { .stats-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-logo">
            <div class="header-logo-icon"><i class="bi bi-house-door"></i></div>
            <div class="header-logo-text">
                <h5>PORTAL DESA DIGITAL</h5>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        <div style="color: #64748b; font-size: 13px;">
            <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
        </div>
    </header>
    
    <div class="main-content">
        <div class="page-header">
            <div class="page-title">
                <h1><i class="bi bi-house-door"></i> Data Dusun</h1>
                <p>Kelola data kewilayahan dusun dan RT/RW</p>
            </div>
            <div class="btn-group">
                <a href="{{ route('dashboard') }}" class="btn btn-back"><i class="bi bi-arrow-left"></i> Kembali</a>
                <a href="{{ route('admin.dusun.create') }}" class="btn btn-add"><i class="bi bi-plus-lg"></i> Tambah Dusun</a>
            </div>
        </div>
        
        @if(session('success'))
        <div class="alert alert-success alert-custom">{{ session('success') }}</div>
        @endif
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon indigo"><i class="bi bi-house-door"></i></div>
                <div><div class="stat-value">{{ $dusuns->total() }}</div><div class="stat-label">Total Dusun</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon teal"><i class="bi bi-people"></i></div>
                <div><div class="stat-value">{{ number_format($dusuns->sum('jumlah_kk') ?? 0) }}</div><div class="stat-label">Total KK</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-grid"></i></div>
                <div><div class="stat-value">{{ number_format($dusuns->sum('jumlah_rw') ?? 0) }}</div><div class="stat-label">Total RW</div></div>
            </div>
            <div class="stat-card">
                <div class="stat-icon cyan"><i class="bi bi-grid-3x3"></i></div>
                <div><div class="stat-value">{{ number_format($dusuns->sum('jumlah_rt') ?? 0) }}</div><div class="stat-label">Total RT</div></div>
            </div>
        </div>
        
        <form method="GET" class="filter-bar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="Cari nama dusun..." value="{{ request('search') }}">
            </div>
            <select name="desa_id" class="filter-select">
                <option value="">-- Semua Desa --</option>
                @foreach($desas as $desa)
                    <option value="{{ $desa->id }}" {{ request('desa_id') == $desa->id ? 'selected' : '' }}>
                        {{ $desa->nama_desa }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-add"><i class="bi bi-funnel"></i> Filter</button>
        </form>
        
        <div class="table-card">
            <div class="table-header">
                <h5><i class="bi bi-list-ul"></i> Daftar Dusun</h5>
                <span class="badge-count">{{ $dusuns->total() }} Dusun</span>
            </div>
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>NO</th><th>NAMA DUSUN</th><th>DESA</th>
                        <th>KEPALA DUSUN</th><th style="text-align: right;">RT</th>
                        <th style="text-align: right;">RW</th><th style="text-align: right;">KK</th>
                        <th style="text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dusuns as $index => $dusun)
                    <tr>
                        <td class="no-cell">{{ $dusuns->firstItem() + $index }}</td>
                        <td class="nama-cell"><i class="bi bi-house-door"></i> {{ $dusun->nama_dusun }}</td>
                        <td>{{ $dusun->desa->nama_desa ?? '-' }}</td>
                        <td>{{ $dusun->kepala_dusun ?? '-' }}</td>
                        <td style="text-align: right;">{{ $dusun->jumlah_rt ?? 0 }}</td>
                        <td style="text-align: right;">{{ $dusun->jumlah_rw ?? 0 }}</td>
                        <td style="text-align: right;">{{ $dusun->jumlah_kk ?? 0 }}</td>
                        <td style="text-align: center;">
                            <a href="{{ route('admin.dusun.edit', $dusun->id) }}" class="btn-action btn-edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.dusun.destroy', $dusun->id) }}" method="POST" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action btn-delete" onclick="return confirm('Hapus dusun ini?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-5 text-muted">Tidak ada data dusun</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($dusuns->hasPages())
            <div class="pagination-info">
                <small>Menampilkan {{ $dusuns->firstItem() }} - {{ $dusuns->lastItem() }} dari {{ $dusuns->total() }}</small>
                {{ $dusuns->links() }}
            </div>
            @endif
        </div>
    </div>
</body>
</html>