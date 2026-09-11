<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Desa - Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f8f9fa; margin: 0; }
        
        /* Header */
        .header {
            background: white;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e5e7eb;
        }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon {
            width: 45px; height: 45px;
            background: #1e3a8a;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 24px;
        }
        .header-logo-text h5 { margin: 0; font-weight: 700; font-size: 18px; color: #1e3a8a; }
        .header-logo-text small { color: #6b7280; font-size: 11px; letter-spacing: 1px; }
        
        .header-search { flex: 1; max-width: 400px; margin: 0 30px; }
        .header-search input {
            width: 100%; padding: 10px 20px 10px 45px;
            border: 1px solid #e5e7eb; border-radius: 8px;
            font-size: 14px; background: #f9fafb;
        }
        .header-search-wrapper { position: relative; }
        .header-search-wrapper i {
            position: absolute; left: 15px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
        }
        
        .header-user { display: flex; align-items: center; gap: 12px; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: #e5e7eb;
            display: flex; align-items: center; justify-content: center;
        }
        .header-user-info strong { display: block; font-size: 14px; color: #1f2937; }
        .header-user-info small { font-size: 12px; color: #6b7280; }
        
        /* Breadcrumb */
        .breadcrumb-bar {
            background: white; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid #e5e7eb;
        }
        .breadcrumb { margin: 0; background: none; padding: 0; }
        .breadcrumb-item a { color: #6b7280; text-decoration: none; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        .breadcrumb-date { color: #6b7280; font-size: 14px; }
        .breadcrumb-date i { margin-right: 5px; }
        
        /* Main */
        .main-content { padding: 30px; }
        .section-title {
            font-size: 13px; font-weight: 700; color: #1e3a8a;
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;
        }
        
        /* Card */
        .card-custom {
            background: white; border-radius: 12px; padding: 25px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e5e7eb; height: 100%;
        }
        
        /* Stats */
        .stats-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 10px; }
        .stats-title { font-size: 16px; font-weight: 700; color: #1f2937; margin: 0; }
        .stats-subtitle { font-size: 12px; color: #6b7280; margin: 0; }
        .stats-badge {
            background: #dbeafe; color: #1e40af;
            padding: 4px 10px; border-radius: 12px;
            font-size: 11px; font-weight: 600;
        }
        .stats-number {
            font-size: 36px; font-weight: 800; color: #1e3a8a;
            margin: 15px 0 5px 0;
        }
        .stats-number small { font-size: 14px; font-weight: 500; color: #6b7280; }
        
        .chart-container { display: flex; align-items: center; gap: 20px; margin: 20px 0; }
        .chart-donut { width: 120px; height: 120px; }
        .chart-legend { flex: 1; }
        .legend-item { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .legend-color { width: 12px; height: 12px; border-radius: 3px; }
        .legend-text strong { display: block; font-size: 13px; color: #1f2937; }
        .legend-text small { font-size: 12px; color: #6b7280; }
        
        .bar-chart-title { font-size: 14px; font-weight: 700; color: #1f2937; margin-bottom: 5px; }
        .bar-chart-subtitle { font-size: 12px; color: #6b7280; margin-bottom: 15px; }
        .bar-chart-badge {
            background: #d1fae5; color: #065f46;
            padding: 3px 8px; border-radius: 10px;
            font-size: 11px; font-weight: 600;
            display: inline-block; margin-bottom: 15px;
        }
        .bar-chart-container { height: 150px; }
        
        /* Page Header */
        .page-header h2 { font-size: 24px; font-weight: 700; color: #1e3a8a; margin-bottom: 8px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 20px; }
        
        /* Action Bar */
        .action-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 15px; flex-wrap: wrap; }
        .action-search { position: relative; flex: 1; max-width: 400px; }
        .action-search input {
            width: 100%; padding: 10px 20px 10px 40px;
            border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px;
        }
        .action-search i {
            position: absolute; left: 15px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
        }
        .action-buttons { display: flex; gap: 10px; }
        .btn-download {
            background: #10b981; color: white; border: none;
            padding: 10px 20px; border-radius: 8px;
            font-weight: 600; font-size: 14px;
        }
        .btn-download:hover { background: #059669; color: white; }
        .btn-add {
            background: #3b82f6; color: white; border: none;
            padding: 10px 20px; border-radius: 8px;
            font-weight: 600; font-size: 14px;
        }
        .btn-add:hover { background: #2563eb; color: white; }
        
        /* Table */
        .table-custom { background: white; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb; }
        .table-custom thead { background: #1e3a8a; color: white; }
        .table-custom thead th {
            padding: 15px 20px; font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px; border: none;
        }
        .table-custom tbody td {
            padding: 15px 20px; font-size: 14px; color: #1f2937;
            border-bottom: 1px solid #f3f4f6; vertical-align: middle;
        }
        .table-custom tbody tr:hover { background: #f9fafb; }
        .table-id { font-weight: 600; color: #1e3a8a; }
        .table-name { display: flex; align-items: center; gap: 10px; font-weight: 600; }
        .table-name i { color: #6b7280; }
        .table-kecamatan { color: #6b7280; }
        
        .status-badge {
            padding: 5px 12px; border-radius: 12px;
            font-size: 12px; font-weight: 600; display: inline-block;
        }
        .status-maju { background: #d1fae5; color: #065f46; }
        .status-berkembang { background: #dbeafe; color: #1e40af; }
        .status-mandiri { background: #fef3c7; color: #92400e; }
        .status-aktif { background: #d1fae5; color: #065f46; }
        
        .btn-detail {
            background: #1e3a8a; color: white; border: none;
            padding: 8px 16px; border-radius: 6px;
            font-size: 13px; font-weight: 600;
        }
        .btn-detail:hover { background: #1e40af; color: white; }
        
        /* Pagination */
        .pagination-info {
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 20px; border-top: 1px solid #e5e7eb;
        }
        .pagination-info small { color: #6b7280; font-size: 13px; }
        .pagination-custom { display: flex; gap: 5px; }
        .pagination-custom button, .pagination-custom a {
            width: 32px; height: 32px; border: 1px solid #e5e7eb;
            background: white; border-radius: 6px; font-size: 13px;
            color: #6b7280; text-decoration: none;
            display: flex; align-items: center; justify-content: center;
        }
        .pagination-custom button.active, .pagination-custom a.active {
            background: #1e3a8a; color: white; border-color: #1e3a8a;
        }
        .pagination-custom button:hover:not(.active), .pagination-custom a:hover:not(.active) {
            background: #f3f4f6;
        }
        
        /* Alert */
        .alert-custom {
            border-radius: 8px; border: none;
            padding: 12px 20px; margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-logo">
            <div class="header-logo-icon">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <div class="header-logo-text">
                <h5>Desa Digital</h5>
                <small>SISTEM INFORMASI DESA</small>
            </div>
        </div>
        
        <div class="header-search">
            <div class="header-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari data cepat...">
            </div>
        </div>
        
        <div class="header-user">
            <div class="header-user-info text-end">
                <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                <i class="bi bi-person"></i>
            </div>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-arrow-left"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Utama</a></li>
                <li class="breadcrumb-item active">Data Desa</li>
            </ol>
        </nav>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="row g-4">
            <!-- Left Column: Stats -->
            <div class="col-lg-4">
                <div class="section-title">IKHTISAR DATA UTAMA</div>
                
                <div class="card-custom">
                    <!-- Total Desa -->
                    <div class="stats-header">
                        <div>
                            <h6 class="stats-title">Total Desa</h6>
                            <p class="stats-subtitle">Berdasarkan data registrasi terbaru</p>
                        </div>
                        <span class="stats-badge">+{{ $totalDesa }} Desa</span>
                    </div>
                    
                    <h2 class="stats-number">{{ number_format($totalDesa) }} <small>Desa terdaftar</small></h2>
                    
                    <!-- Donut Chart: Status Desa -->
                    <div class="chart-container">
                        <div class="chart-donut">
                            <canvas id="statusChart"></canvas>
                        </div>
                        <div class="chart-legend">
    @if($desaMaju > 0)
    <div class="legend-item">
        <div class="legend-color" style="background: #1e3a8a;"></div>
        <div class="legend-text">
            <strong>Maju</strong>
            <small>{{ $desaMaju }} Desa</small>
        </div>
    </div>
    @endif
    
    @if($desaBerkembang > 0)
    <div class="legend-item">
        <div class="legend-color" style="background: #3b82f6;"></div>
        <div class="legend-text">
            <strong>Berkembang</strong>
            <small>{{ $desaBerkembang }} Desa</small>
        </div>
    </div>
    @endif
    
    @if($desaMandiri > 0)
    <div class="legend-item">
        <div class="legend-color" style="background: #f59e0b;"></div>
        <div class="legend-text">
            <strong>Mandiri</strong>
            <small>{{ $desaMandiri }} Desa</small>
        </div>
    </div>
    @endif
    
    @if($desaAktif > 0)
    <div class="legend-item">
        <div class="legend-color" style="background: #10b981;"></div>
        <div class="legend-text">
            <strong>Aktif</strong>
            <small>{{ $desaAktif }} Desa</small>
        </div>
    </div>
    @endif
    
    @if($desaMaju == 0 && $desaBerkembang == 0 && $desaMandiri == 0 && $desaAktif == 0)
    <div class="legend-item">
        <div class="legend-color" style="background: #6b7280;"></div>
        <div class="legend-text">
            <strong>Belum Ada Status</strong>
            <small>{{ $totalDesa }} Desa</small>
        </div>
    </div>
    @endif
</div>
                                <div class="legend-color" style="background: #f59e0b;"></div>
                                <div class="legend-text">
                                    <strong>Mandiri</strong>
                                    <small>{{ $desaMandiri }} Desa</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <!-- Bar Chart: Pertumbuhan Desa -->
                    <div class="bar-chart-title">Pertumbuhan Desa</div>
                    <div class="bar-chart-subtitle">Jumlah desa binaan per tahun</div>
                    <div class="bar-chart-badge">{{ $totalDesa }} Desa Terbina</div>
                    
                    <div class="bar-chart-container">
                        <canvas id="desaChart"></canvas>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: Table -->
            <div class="col-lg-8">
                <div class="page-header">
                    <h2>Halaman Pengelolaan Data Desa</h2>
                    <p>Gunakan panel ini untuk mengelola, menyaring, dan memperbarui informasi seluruh desa binaan Desa Digital.</p>
                </div>
                
                <!-- Alert Success -->
                @if(session('success'))
                <div class="alert alert-success alert-custom alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <!-- Action Bar -->
                <div class="action-bar">
                    <form method="GET" action="{{ route('admin.desa.index') }}" class="action-search" style="flex: 1; max-width: 400px;">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search" placeholder="Cari berdasarkan nama desa..." value="{{ request('search') }}">
                    </form>
                    <div class="action-buttons">
                        <a href="{{ route('admin.desa.index') }}" class="btn-download">
                            <i class="bi bi-download"></i> Unduh Laporan
                        </a>
                        <a href="{{ route('admin.desa.create') }}" class="btn-add">
                            <i class="bi bi-plus"></i> Tambah Desa
                        </a>
                    </div>
                </div>
                
                <!-- Table -->
                <div class="table-custom">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>ID DESA</th>
                                <th>NAMA DESA</th>
                                <th>KECAMATAN</th>
                                <th>STATUS</th>
                                <th class="text-end">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($desas as $index => $desa)
                            <tr>
                                <td class="table-id">DSA-{{ str_pad($desa->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="table-name">
                                        <i class="bi bi-house"></i> {{ $desa->nama_desa }}
                                    </div>
                                </td>
                                <td class="table-kecamatan">Kecamatan {{ $desa->kecamatan }}</td>
                                <td>
                                    <span class="status-badge status-{{ $desa->status ?? 'aktif' }}">
                                        {{ ucfirst($desa->status ?? 'Aktif') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('admin.desa.edit', $desa->id) }}" class="btn-detail">
                                            Detail <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                                    <p class="text-muted mb-0">Tidak ada data desa</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="pagination-info">
                        <small>
                            @if($desas->hasPages())
                                Menampilkan {{ $desas->firstItem() }} dari {{ $desas->total() }} data desa
                            @else
                                Menampilkan {{ $desas->count() }} data desa
                            @endif
                        </small>
                        @if($desas->hasPages())
                        <div class="pagination-custom">
                            {{ $desas->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Donut Chart - Status Desa
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Maju', 'Berkembang', 'Mandiri'],
                datasets: [{
                    data: [{{ $desaMaju }}, {{ $desaBerkembang }}, {{ $desaMandiri }}],
                    backgroundColor: ['#1e3a8a', '#3b82f6', '#f59e0b'],
                    borderWidth: 0,
                    cutout: '70%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
        
        // Bar Chart - Pertumbuhan Desa
        const desaCtx = document.getElementById('desaChart').getContext('2d');
        new Chart(desaCtx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    data: @json($chartData),
                    backgroundColor: '#3b82f6',
                    borderRadius: 6,
                    barPercentage: 0.6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { display: false }, ticks: { display: false } },
                    x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#6b7280' } }
                }
            }
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>