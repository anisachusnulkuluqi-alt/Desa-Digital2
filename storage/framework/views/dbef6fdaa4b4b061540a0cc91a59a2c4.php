<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Desa - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
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
        
        .header-user { display: flex; align-items: center; gap: 12px; color: white; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        
        .breadcrumb-bar {
            background: white;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }
        .breadcrumb-bar a { color: #64748b; text-decoration: none; font-weight: 500; }
        .breadcrumb-bar a:hover { color: #1e88e5; }
        .breadcrumb-bar .active { color: #1e88e5; font-weight: 600; }
        .breadcrumb-bar .separator { color: #cbd5e1; margin: 0 8px; }
        .breadcrumb-date { color: #64748b; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
        .breadcrumb-date i { color: #94a3b8; }
        
        .main-content { padding: 30px; max-width: 900px; margin: 0 auto; }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
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
        .page-title p { color: #64748b; font-size: 14px; margin: 0; margin-top: 4px; }
        
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
        .btn-back { background: white; color: #475569; border: 1px solid #e2e8f0; }
        .btn-back:hover { background: #f8fafc; border-color: #cbd5e1; color: #0f172a; }
        .btn-save { background: linear-gradient(135deg, #1e88e5, #00897b); color: white; }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(30,136,229,0.3); color: white; }
        
        .form-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .card-header-modern {
            background: linear-gradient(135deg, #1e3a8a, #00897b);
            color: white;
            padding: 16px 20px;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .card-body-modern { padding: 24px; }
        
        .form-group { margin-bottom: 20px; }
        
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-control, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        
        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 24px;
        }
        
        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .main-content { padding: 20px; }
        }
    </style>
</head>
<body>
    <!-- Header -->
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
                <strong><?php echo e(auth()->user()->name ?? 'Admin Desa'); ?></strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                <?php echo e(substr(auth()->user()->name ?? 'A', 0, 1)); ?>

            </div>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div>
            <a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-house-door"></i> Home</a>
            <span class="separator">/</span>
            <a href="<?php echo e(route('admin.desa.index')); ?>">Data Desa</a>
            <span class="separator">/</span>
            <span class="active">Tambah</span>
        </div>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i>
            <?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM YYYY')); ?>

        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <div class="page-title">
                <h1><i class="bi bi-plus-circle"></i> Tambah Desa Baru</h1>
                <p>Isi data desa baru di Kabupaten Tuban</p>
            </div>
            <div>
                <a href="<?php echo e(route('admin.desa.index')); ?>" class="btn btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        
        <?php if($errors->any()): ?>
        <div class="alert alert-danger alert-custom">
            <strong>Ada kesalahan:</strong>
            <ul class="mb-0 mt-2 ps-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>
        
        <!-- Form Card -->
        <div class="form-card">
            <div class="card-header-modern">
                <i class="bi bi-building"></i> Data Desa Baru
            </div>
            <div class="card-body-modern">
                <form method="POST" action="<?php echo e(route('admin.desa.store')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Nama Desa <span class="text-danger">*</span></label>
                            <input type="text" name="nama_desa" class="form-control" value="<?php echo e(old('nama_desa')); ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kode Desa</label>
                            <input type="text" name="kode_desa" class="form-control" value="<?php echo e(old('kode_desa')); ?>" placeholder="Contoh: 3523010001">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <select name="kecamatan_id" class="form-select" required>
                                <option value="">-- Pilih Kecamatan --</option>
                                <?php $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kec->id); ?>" <?php echo e(old('kecamatan_id') == $kec->id ? 'selected' : ''); ?>>
                                        <?php echo e($kec->nama_kecamatan); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kepala Desa</label>
                            <input type="text" name="kepala_desa" class="form-control" value="<?php echo e(old('kepala_desa')); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Jumlah Penduduk</label>
                            <input type="number" name="jumlah_penduduk" class="form-control" value="<?php echo e(old('jumlah_penduduk', 0)); ?>" min="0">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah KK</label>
                            <input type="number" name="jumlah_kk" class="form-control" value="<?php echo e(old('jumlah_kk', 0)); ?>" min="0">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Luas Wilayah (km²)</label>
                            <input type="number" step="0.01" name="luas_wilayah" class="form-control" value="<?php echo e(old('luas_wilayah')); ?>" min="0">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="telepon" class="form-control" value="<?php echo e(old('telepon')); ?>">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" value="<?php echo e(old('alamat')); ?>">
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="<?php echo e(route('admin.desa.index')); ?>" class="btn btn-back">Batal</a>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check-lg"></i> Simpan Desa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/admin/desa/create.blade.php ENDPATH**/ ?>