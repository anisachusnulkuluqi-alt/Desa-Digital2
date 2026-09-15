<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kecamatan - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        body { background: #f8f9fa; margin: 0; }
        
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
        
        .header-user { display: flex; align-items: center; gap: 12px; color: white; cursor: pointer; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        
        /* Breadcrumb */
        .breadcrumb-bar {
            background: white; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid #e5e7eb;
        }
        .breadcrumb { margin: 0; background: none; padding: 0; }
        .breadcrumb-item a { color: #6b7280; text-decoration: none; }
        .breadcrumb-item.active { color: #1e88e5; font-weight: 600; }
        .breadcrumb-date { color: #6b7280; font-size: 14px; }
        .breadcrumb-date i { margin-right: 5px; }
        
        /* Main */
        .main-content { padding: 30px; max-width: 1400px; margin: 0 auto; }
        .section-title {
            font-size: 13px; font-weight: 700; color: #00897b;
            text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;
        }
        
        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card {
            background: linear-gradient(135deg, rgba(30,136,229,0.1), rgba(0,137,123,0.1));
            border-radius: 12px; padding: 25px; text-align: center;
            border: 1px solid rgba(30,136,229,0.1);
        }
        .stat-icon {
            width: 55px; height: 55px; margin: 0 auto 12px;
            background: linear-gradient(135deg, #1e88e5, #00897b);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            color: white; font-size: 26px;
        }
        .stat-number { font-size: 32px; font-weight: 800; color: #1e3a8a; margin-bottom: 5px; }
        .stat-label { font-size: 13px; color: #6b7280; font-weight: 500; }
        
        /* Page Header */
        .page-header { margin-bottom: 25px; }
        .page-header h2 { font-size: 24px; font-weight: 700; color: #1e3a8a; margin-bottom: 8px; }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }
        
        /* Action Bar */
        .action-bar { 
            display: flex; justify-content: space-between; align-items: center; 
            margin-bottom: 20px; gap: 15px; flex-wrap: wrap; 
        }
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
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-download:hover { background: #059669; color: white; }
        .btn-add {
            background: #1e88e5; color: white; border: none;
            padding: 10px 20px; border-radius: 8px;
            font-weight: 600; font-size: 14px;
            text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-add:hover { background: #1565c0; color: white; }
        
        /* Table */
        .table-custom { 
            background: white; border-radius: 12px; overflow: hidden; 
            border: 1px solid #e5e7eb; 
        }
        .table-custom thead { 
            background: linear-gradient(135deg, #1e3a8a, #00897b); 
            color: white; 
        }
        .table-custom thead th {
            padding: 15px 20px; font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px; border: none;
        }
        .table-custom tbody td {
            padding: 15px 20px; font-size: 14px; color: #1f2937;
            border-bottom: 1px solid #f3f4f6; vertical-align: middle;
        }
        .table-custom tbody tr:hover { background: #f9fafb; }
        .table-id { font-weight: 600; color: #1e88e5; }
        .table-name { display: flex; align-items: center; gap: 10px; font-weight: 600; }
        .table-name i { color: #6b7280; }
        .table-kecamatan { color: #6b7280; }
        
        .badge-desa {
            background: #dbeafe; color: #1e40af;
            padding: 5px 12px; border-radius: 12px;
            font-size: 12px; font-weight: 600; display: inline-block;
        }
        
        .btn-action {
            width: 32px; height: 32px;
            border-radius: 6px; border: none;
            display: inline-flex; align-items: center; justify-content: center;
            font-size: 14px; text-decoration: none;
            transition: all 0.2s;
        }
        .btn-detail { background: #dbeafe; color: #1e40af; }
        .btn-detail:hover { background: #1e40af; color: white; }
        .btn-edit { background: #fef3c7; color: #92400e; }
        .btn-edit:hover { background: #f59e0b; color: white; }
        .btn-delete { background: #fee2e2; color: #991b1b; }
        .btn-delete:hover { background: #ef4444; color: white; }
        
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
            background: #1e88e5; color: white; border-color: #1e88e5;
        }
        .pagination-custom button:hover:not(.active), .pagination-custom a:hover:not(.active) {
            background: #f3f4f6;
        }
        
        /* Floating Buttons */
        .floating-buttons {
            position: fixed; bottom: 30px; right: 30px;
            display: flex; flex-direction: column; gap: 10px; z-index: 999;
        }
        .floating-btn {
            width: 50px; height: 50px; border-radius: 50%;
            background: white; border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #6b7280; font-size: 20px;
            transition: all 0.3s; text-decoration: none;
        }
        .floating-btn:hover { transform: scale(1.1); color: #1e88e5; }
        .floating-btn.primary {
            background: #1e88e5; color: white;
        }
        .floating-btn.primary:hover { background: #1565c0; color: white; }
        
        /* Alert */
        .alert-custom {
            border-radius: 8px; border: none;
            padding: 12px 20px; margin-bottom: 20px;
        }
        
        /* Footer */
        .footer {
            background: white; padding: 20px 30px;
            display: flex; justify-content: space-between; align-items: center;
            border-top: 1px solid #e5e7eb; margin-top: 50px;
        }
        .footer small { color: #6b7280; }
        .footer a { color: #00897b; text-decoration: none; margin-left: 20px; font-size: 14px; }
        
        @media (max-width: 992px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .action-bar { flex-direction: column; align-items: stretch; }
            .action-search { max-width: 100%; }
            .action-buttons { justify-content: flex-end; }
            .header-search { display: none; }
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
            <i class="bi bi-chevron-down"></i>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-house"></i></a></li>
                <li class="breadcrumb-item active">Kecamatan</li>
            </ol>
        </nav>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i> <?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM YYYY')); ?>

        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Stats Cards -->
        <div class="section-title">IKHTISAR DATA KECAMATAN</div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-building"></i>
                </div>
                <div class="stat-number"><?php echo e($totalKecamatan ?? $kecamatans->total()); ?></div>
                <div class="stat-label">Total Kecamatan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <div class="stat-number"><?php echo e($totalDesa ?? 0); ?></div>
                <div class="stat-label">Total Desa</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people"></i>
                </div>
                <div class="stat-number"><?php echo e($avgDesa ?? 0); ?></div>
                <div class="stat-label">Rata-rata Desa/Kec</div>
            </div>
        </div>
        
        <!-- Page Header -->
        <div class="page-header">
            <h2>Daftar Kecamatan</h2>
            <p>Kelola data kecamatan di Kabupaten Tuban</p>
        </div>
        
        <!-- Alert Success -->
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-custom alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <!-- Alert Error -->
        <?php if(session('error')): ?>
        <div class="alert alert-danger alert-custom alert-dismissible fade show">
            <i class="bi bi-exclamation-triangle-fill me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <!-- Action Bar -->
        <div class="action-bar">
            <form method="GET" action="<?php echo e(route('admin.kecamatan.index')); ?>" class="action-search">
                <i class="bi bi-search"></i>
                <input type="text" name="search" placeholder="Cari nama kecamatan..." value="<?php echo e(request('search')); ?>">
            </form>
            <div class="action-buttons">
                <button class="btn-download" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <a href="<?php echo e(route('admin.kecamatan.create')); ?>" class="btn-add">
                    <i class="bi bi-plus-lg"></i> Tambah Kecamatan
                </a>
            </div>
        </div>
        
        <!-- Table -->
        <div class="table-custom">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th>NAMA KECAMATAN</th>
                        <th>KODE WILAYAH</th>
                        <th>JUMLAH DESA</th>
                        <th class="text-end" style="width: 150px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kecamatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="table-id"><?php echo e($kecamatans->firstItem() + $index); ?></td>
                        <td>
                            <div class="table-name">
                                <i class="bi bi-building"></i> 
                                <?php echo e(ucfirst($kecamatan->nama_kecamatan)); ?>

                            </div>
                        </td>
                        <td class="table-kecamatan"><?php echo e($kecamatan->kode_wilayah ?? '-'); ?></td>
                        <td>
                            <span class="badge-desa">
                                <?php echo e($kecamatan->desas_count ?? $kecamatan->desas->count()); ?> desa
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="<?php echo e(route('admin.kecamatan.show', $kecamatan->id)); ?>" 
                                   class="btn-action btn-detail" 
                                   title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('admin.kecamatan.edit', $kecamatan->id)); ?>" 
                                   class="btn-action btn-edit" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('admin.kecamatan.destroy', $kecamatan->id)); ?>" 
                                      method="POST" 
                                      style="display: inline;"
                                      onsubmit="return confirm('Yakin ingin menghapus kecamatan <?php echo e($kecamatan->nama_kecamatan); ?>?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="bi bi-inbox fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted mb-3">Tidak ada data kecamatan</p>
                            <a href="<?php echo e(route('admin.kecamatan.create')); ?>" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Tambah Kecamatan
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            
            <!-- Pagination -->
            <?php if($kecamatans->hasPages()): ?>
            <div class="pagination-info">
                <small>
                    Menampilkan <?php echo e($kecamatans->firstItem()); ?> dari <?php echo e($kecamatans->total()); ?> data kecamatan
                </small>
                <div class="pagination-custom">
                    <?php echo e($kecamatans->links()); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Floating Buttons -->
    <div class="floating-buttons">
        <a href="<?php echo e(route('admin.kecamatan.create')); ?>" class="floating-btn primary" title="Tambah Data">
            <i class="bi bi-plus"></i>
        </a>
        <button class="floating-btn" title="Pengaturan">
            <i class="bi bi-gear"></i>
        </button>
        <button class="floating-btn" title="Bantuan">
            <i class="bi bi-question-circle"></i>
        </button>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <small>© 2026 Pemerintah Kabupaten Tuban. Hak Cipta Dilindungi.</small>
        <div>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/admin/kecamatan/index.blade.php ENDPATH**/ ?>