<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Desa - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        /* Header */
        .header {
            background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon {
            width: 45px; height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 24px;
        }
        .header-logo-text h5 { margin: 0; font-weight: 800; font-size: 18px; color: white; }
        .header-logo-text small { color: rgba(255,255,255,0.9); font-size: 11px; }
        
        .header-search { flex: 1; max-width: 500px; margin: 0 30px; }
        .header-search input {
            width: 100%; padding: 12px 20px 12px 45px;
            border: none; border-radius: 25px;
            font-size: 14px; background: white;
        }
        .header-search-wrapper { position: relative; }
        .header-search-wrapper i {
            position: absolute; left: 18px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
        }
        
        .header-user { display: flex; align-items: center; gap: 12px; color: white; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        
        /* Breadcrumb Bar */
        .breadcrumb-bar {
            background: white;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }
        .breadcrumb-bar a {
            color: #64748b;
            text-decoration: none;
            font-weight: 500;
        }
        .breadcrumb-bar a:hover { color: #1e88e5; }
        .breadcrumb-bar .active {
            color: #1e88e5;
            font-weight: 600;
        }
        .breadcrumb-bar .separator {
            color: #cbd5e1;
            margin: 0 8px;
        }
        .breadcrumb-date {
            color: #64748b;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .breadcrumb-date i { color: #94a3b8; }
        
        /* Main Content */
        .main-content { padding: 30px; max-width: 1400px; margin: 0 auto; }
        
        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-title {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .page-title h1 {
            font-size: 28px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-title h1 i { color: #1e88e5; }
        .page-title p { 
            color: #64748b; 
            font-size: 14px; 
            margin: 0;
            width: 100%;
            margin-top: 4px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-back {
            background: white;
            color: #475569;
            border: 1px solid #e2e8f0;
        }
        .btn-back:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
        }
        
        .btn-add {
            background: linear-gradient(135deg, #1e88e5, #00897b);
            color: white;
        }
        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(30,136,229,0.3);
            color: white;
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-left: 4px solid #1e88e5;
            display: flex;
            align-items: center;
            gap: 14px;
        }
        
        .stat-icon {
            width: 50px; height: 50px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
            color: white;
            flex-shrink: 0;
        }
        .stat-icon.blue { background: linear-gradient(135deg, #1e88e5, #0ea5e9); }
        .stat-icon.teal { background: linear-gradient(135deg, #00897b, #14b8a6); }
        .stat-icon.purple { background: linear-gradient(135deg, #6366f1, #8b5cf6); }
        .stat-icon.cyan { background: linear-gradient(135deg, #06b6d4, #0891b2); }
        
        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            line-height: 1;
            margin-bottom: 4px;
        }
        
        .stat-label {
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
        }
        
        /* Filter Bar */
        .filter-bar {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            margin-bottom: 24px;
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            align-items: center;
        }
        
        .search-box {
            flex: 1;
            min-width: 250px;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
        }
        
        .search-box i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }
        
        .filter-select {
            padding: 10px 16px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            min-width: 200px;
        }
        
        .filter-select:focus {
            outline: none;
            border-color: #1e88e5;
        }
        
        .btn-filter {
            background: #1e88e5;
            color: white;
        }
        .btn-filter:hover {
            background: #00897b;
            color: white;
        }
        
        /* Table Card */
        .table-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
        }
        
        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .table-header h5 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .table-header h5 i { color: #1e88e5; }
        
        .badge-count {
            background: #1e88e5;
            color: white;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .table-modern {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        
        .table-modern thead {
            background: #f8fafc;
        }
        
        .table-modern th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table-modern td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #334155;
        }
        
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .no-cell { font-weight: 600; color: #1e88e5; width: 50px; }
        .nama-cell { font-weight: 600; color: #0f172a; }
        .nama-cell i { color: #1e88e5; margin-right: 6px; }
        .kecamatan-cell { color: #64748b; font-size: 12px; }
        .number-cell { text-align: right; font-weight: 600; }
        
        .btn-action {
            width: 32px; height: 32px;
            border-radius: 6px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            margin-right: 4px;
            cursor: pointer;
        }
        .btn-detail { background: #eff6ff; color: #0284c7; }
        .btn-detail:hover { background: #0284c7; color: white; }
        .btn-edit { background: #fef3c7; color: #92400e; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fee2e2; color: #991b1b; }
        .btn-delete:hover { background: #ef4444; color: white; }
        
        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        
        @media (max-width: 992px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 20px; }
            .page-title h1 { font-size: 22px; }
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
                <h5>PORTAL DESA DIGITAL</h5>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        
        <div class="header-search">
            <div class="header-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari data cepat...">
            </div>
        </div>
        
        <div class="header-user">
            <div class="header-user-info">
                <strong><?php echo e(auth()->user()->name ?? 'Admin Desa'); ?></strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                <?php echo e(substr(auth()->user()->name ?? 'A', 0, 1)); ?>

            </div>
        </div>
    </header>
    
    <!-- Breadcrumb Bar -->
    <div class="breadcrumb-bar">
        <div>
            <a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-house-door"></i> Home</a>
            <span class="separator">/</span>
            <span class="active">Data Desa</span>
        </div>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i>
            <?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM YYYY')); ?>

        </div>
    </div>
    
    <!-- Main Content -->
    <main class="main-content">
        <!-- Page Header -->
<div class="page-header">
    <div class="page-title">
        <h1><i class="bi bi-geo-alt-fill"></i> Data Desa</h1>
        <p>Kelola data desa di Kabupaten Tuban</p>
    </div>
    <div>
        <a href="<?php echo e(route('admin.desa.create')); ?>" class="btn btn-add">
            <i class="bi bi-plus-lg"></i> Tambah Desa
        </a>
    </div>
</div>
        
        <!-- Alert Success -->
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-custom alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-geo-alt-fill"></i></div>
                <div>
                    <div class="stat-value"><?php echo e($totalDesa ?? 0); ?></div>
                    <div class="stat-label">Total Desa</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon teal"><i class="bi bi-building"></i></div>
                <div>
                    <div class="stat-value"><?php echo e($totalKecamatan ?? 0); ?></div>
                    <div class="stat-label">Total Kecamatan</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon purple"><i class="bi bi-people"></i></div>
                <div>
                    <div class="stat-value"><?php echo e(number_format($desas->sum('jumlah_penduduk') ?? 0)); ?></div>
                    <div class="stat-label">Total Penduduk</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon cyan"><i class="bi bi-house-heart"></i></div>
                <div>
                    <div class="stat-value"><?php echo e(number_format($desas->sum('jumlah_kk') ?? 0)); ?></div>
                    <div class="stat-label">Total KK</div>
                </div>
            </div>
        </div>
        
        <!-- Filter Bar -->
        <form method="GET" action="<?php echo e(route('admin.desa.index')); ?>" class="filter-bar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="Cari nama desa..." value="<?php echo e(request('search')); ?>">
            </div>
            <select name="kecamatan_id" class="filter-select">
                <option value="">-- Semua Kecamatan --</option>
                <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($kec->id); ?>" <?php echo e(request('kecamatan_id') == $kec->id ? 'selected' : ''); ?>>
                        <?php echo e($kec->nama_kecamatan); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="btn btn-filter">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </form>
        
        <!-- Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h5><i class="bi bi-list-ul"></i> Daftar Desa</h5>
                <span class="badge-count"><?php echo e($desas->total()); ?> Desa</span>
            </div>
            
            <div style="overflow-x: auto;">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA DESA</th>
                            <th>KECAMATAN</th>
                            <th>KODE DESA</th>
                            <th style="text-align: right;">PENDUDUK</th>
                            <th style="text-align: right;">KK</th>
                            <th style="text-align: right;">LUAS (KM²)</th>
                            <th style="text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $desas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $desa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="no-cell"><?php echo e($desas->firstItem() + $index); ?></td>
                            <td class="nama-cell">
                                <i class="bi bi-geo-alt-fill"></i>
                                <?php echo e($desa->nama_desa); ?>

                            </td>
                            <td class="kecamatan-cell"><?php echo e($desa->kecamatan->nama_kecamatan ?? '-'); ?></td>
                            <td class="kecamatan-cell"><?php echo e($desa->kode_desa ?? '-'); ?></td>
                            <td class="number-cell"><?php echo e(number_format($desa->jumlah_penduduk ?? 0)); ?></td>
                            <td class="number-cell"><?php echo e(number_format($desa->jumlah_kk ?? 0)); ?></td>
                            <td class="number-cell"><?php echo e($desa->luas_wilayah ?? '-'); ?></td>
                            <td style="text-align: center;">
                                <a href="<?php echo e(route('admin.desa.show', $desa->id)); ?>" class="btn-action btn-detail" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.desa.edit', $desa->id)); ?>" class="btn-action btn-edit" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.desa.destroy', $desa->id)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus desa <?php echo e($desa->nama_desa); ?>?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox" style="font-size: 48px; display: block; margin-bottom: 12px; color: #cbd5e1;"></i>
                                <p style="font-size: 14px; margin: 0;">Belum ada data desa yang terdaftar.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if($desas->hasPages()): ?>
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; border-top: 1px solid #e2e8f0;">
                <small style="color: #64748b; font-size: 12px;">
                    Menampilkan <?php echo e($desas->firstItem()); ?> - <?php echo e($desas->lastItem()); ?> dari <?php echo e($desas->total()); ?> data
                </small>
                <div style="display: flex; gap: 4px;">
                    <?php echo e($desas->links()); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/admin/desa/index.blade.php ENDPATH**/ ?>