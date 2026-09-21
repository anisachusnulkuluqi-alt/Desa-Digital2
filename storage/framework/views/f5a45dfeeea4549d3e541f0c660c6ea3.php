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
        
        .stat-info h3 { font-size: 28px; font-weight: 800; color: #1e293b; margin: 0; line-height: 1; }
        .stat-info p { font-size: 12px; color: #64748b; margin: 4px 0 0 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
        
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
        
        .btn-action-header {
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
        
        .btn-import {
            background: linear-gradient(135deg, #8b5cf6, #6d28d9);
        }
        .btn-import:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
            color: white;
        }
        
        .btn-add {
            background: linear-gradient(135deg, #14b8a6, #0f766e);
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
        .table-simple tbody tr:hover { background: #f8fafc; }
        
        .kecamatan-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #1e40af;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.2s;
        }
        
        .kecamatan-link:hover {
            color: #1e3a8a;
            transform: translateX(4px);
        }
        
        .kecamatan-sub {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .btn-action {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-edit { background: #dbeafe; color: #1e40af; }
        .btn-edit:hover { background: #1e40af; color: white; }
        
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #dc2626; color: white; }
        
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
        
        .alert-error-custom {
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #991b1b;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .empty-state { text-align: center; padding: 48px; color: #94a3b8; }
        .empty-state i { font-size: 36px; display: block; margin-bottom: 12px; }
        
        /* Modal Styles */
        .modal-content { border-radius: 14px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            border-radius: 14px 14px 0 0;
            padding: 20px 24px;
            border: none;
        }
        .modal-header .modal-title { font-size: 18px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-body { padding: 28px 24px; }
        .modal-footer { border-top: 1px solid #e2e8f0; padding: 16px 24px; background: #f8fafc; border-radius: 0 0 14px 14px; }
        
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom {
            width: 100%; padding: 12px 16px; border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s;
        }
        .form-input-custom:focus { outline: none; border-color: #3b82f6; background: white; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08); }
        .form-hint { font-size: 11px; color: #64748b; margin-top: 6px; display: flex; align-items: center; gap: 4px; }
        
        .btn-modal-cancel {
            background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 10px 20px;
            border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-cancel:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        
        .btn-modal-save {
            background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; padding: 10px 24px;
            border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35); color: white; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 18px; }
            .table-header { flex-direction: column; gap: 12px; align-items: flex-start; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item active">Data Kecamatan</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            <?php echo e(\Carbon\Carbon::now()->translatedFormat('l, d F Y')); ?>

        </div>
    </div>

    <div class="main-content">
        <?php if(session('success')): ?>
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i>
            <?php echo e(session('success')); ?>

        </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
        <div class="alert-error-custom">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <?php echo e(session('error')); ?>

        </div>
        <?php endif; ?>

        <h1 class="page-title">
            <i class="bi bi-geo-alt-fill"></i>
            Data Kecamatan
        </h1>
        <p class="page-subtitle">Kelola data kecamatan di Kabupaten Tuban</p>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo e($totalKecamatan); ?></h3>
                    <p>Total Kecamatan</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon purple">
                    <i class="bi bi-houses-fill"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo e($kecamatans->sum('desas_count')); ?></h3>
                    <p>Total Desa</p>
                </div>
            </div>
        </div>

        <div class="search-bar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama kecamatan...">
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <div class="table-title">
                    <i class="bi bi-list-ul"></i>
                    Daftar Kecamatan
                    <span class="badge-count"><?php echo e($kecamatans->count()); ?> Kecamatan</span>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-action-header btn-import" data-bs-toggle="modal" data-bs-target="#modalImport">
                        <i class="bi bi-file-earmark-excel"></i>
                        Import Excel
                    </button>
                    <button type="button" class="btn-action-header btn-add" data-bs-toggle="modal" data-bs-target="#modalKecamatan" onclick="openModalTambah()">
                        <i class="bi bi-plus-lg"></i>
                        Tambah
                    </button>
                </div>
            </div>

            <table class="table-simple">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th>NAMA KECAMATAN</th>
                        <th style="width: 200px;">AKSI</th>
                    </tr>
                </thead>
                <tbody id="kecamatanTable">
                    <?php $__empty_1 = true; $__currentLoopData = $kecamatans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kecamatan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr data-id="<?php echo e($kecamatan->id); ?>">
                        <td><?php echo e($index + 1); ?></td>
                        <td>
                            <!-- ✅ KLIK NAMA KECAMATAN UNTUK LIHAT DESA -->
                            <a href="<?php echo e(route('admin.kecamatan.show', $kecamatan->id)); ?>" class="kecamatan-link">
                                <i class="bi bi-folder2-open"></i>
                                <?php echo e($kecamatan->nama_kecamatan); ?>

                            </a>
                            <div class="kecamatan-sub">
                                <i class="bi bi-houses"></i> <?php echo e($kecamatan->desas_count); ?> desa
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn-action btn-edit" onclick="openModalEdit(<?php echo e($kecamatan->id); ?>, '<?php echo e($kecamatan->nama_kecamatan); ?>')">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button type="button" class="btn-action btn-delete" onclick="hapusKecamatan(<?php echo e($kecamatan->id); ?>, '<?php echo e($kecamatan->nama_kecamatan); ?>')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                Belum ada data kecamatan
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH/EDIT KECAMATAN ===== -->
    <div class="modal fade" id="modalKecamatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span id="modalTitleText">Tambah Kecamatan</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formKecamatan">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="kecamatanId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">
                                Nama Kecamatan <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="namaKecamatan" 
                                name="nama_kecamatan" 
                                class="form-input-custom" 
                                placeholder="Masukkan nama kecamatan"
                                required
                                autofocus
                            >
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Nama kecamatan yang akan ditampilkan di sistem
                            </div>
                            <div id="errorNama" style="color: #ef4444; font-size: 11px; margin-top: 6px; display: none;"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-save" id="btnSubmit">
                            <i class="bi bi-check-lg"></i>
                            <span id="btnSubmitText">Simpan Kecamatan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ===== MODAL IMPORT EXCEL ===== -->
    <div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-excel"></i>
                        Import Kecamatan dari Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(route('admin.kecamatan.import')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">
                                Pilih File Excel <span class="required">*</span>
                            </label>
                            <input 
                                type="file" 
                                name="file_excel" 
                                class="form-input-custom" 
                                accept=".xlsx,.xls,.csv"
                                required
                            >
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Format: XLSX, XLS, atau CSV (Maks. 10MB)
                            </div>
                            <div style="margin-top: 12px; padding: 12px; background: #eff6ff; border-radius: 8px; font-size: 12px; color: #1e40af;">
                                <strong>Format Excel yang benar:</strong><br>
                                Header kolom harus: <strong>Nama Kecamatan</strong><br><br>
                                <a href="<?php echo e(route('admin.kecamatan.download-template')); ?>" style="color: #1e40af; text-decoration: underline; font-weight: 600;">
                                    <i class="bi bi-download"></i> Download Template Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-save">
                            <i class="bi bi-upload"></i> Import Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalKecamatan;
        let isEditMode = false;

        document.addEventListener('DOMContentLoaded', function() {
            modalKecamatan = new bootstrap.Modal(document.getElementById('modalKecamatan'));
            
            document.getElementById('formKecamatan').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#kecamatanTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });

        function openModalTambah() {
            isEditMode = false;
            document.getElementById('modalTitleText').textContent = 'Tambah Kecamatan';
            document.getElementById('btnSubmitText').textContent = 'Simpan Kecamatan';
            document.getElementById('kecamatanId').value = '';
            document.getElementById('namaKecamatan').value = '';
            document.getElementById('errorNama').style.display = 'none';
            document.getElementById('formKecamatan').action = "<?php echo e(route('admin.kecamatan.store')); ?>";
        }

        function openModalEdit(id, nama) {
            isEditMode = true;
            document.getElementById('modalTitleText').textContent = 'Edit Kecamatan';
            document.getElementById('btnSubmitText').textContent = 'Update Kecamatan';
            document.getElementById('kecamatanId').value = id;
            document.getElementById('namaKecamatan').value = nama;
            document.getElementById('errorNama').style.display = 'none';
            document.getElementById('formKecamatan').action = `/admin/kecamatan/${id}`;
            modalKecamatan.show();
        }

        function submitForm() {
            const btnSubmit = document.getElementById('btnSubmit');
            const originalText = btnSubmit.innerHTML;
            
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';
            
            const formData = new FormData(document.getElementById('formKecamatan'));
            const url = document.getElementById('formKecamatan').action;
            const method = isEditMode ? 'POST' : 'POST';
            
            if (isEditMode) {
                formData.append('_method', 'PUT');
            }

            fetch(url, {
                method: method,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    modalKecamatan.hide();
                    showToast(data.message, 'success');
                    setTimeout(() => { window.location.reload(); }, 800);
                } else {
                    showToast(data.message || 'Terjadi kesalahan', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Gagal menyimpan data', 'error');
            })
            .finally(() => {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = originalText;
            });
        }

        function hapusKecamatan(id, nama) {
            if (confirm(`Yakin ingin menghapus kecamatan "${nama}"? Data desa di dalamnya tidak akan terhapus, tapi kecamatan ini akan hilang.`)) {
                fetch(`/admin/kecamatan/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: new URLSearchParams({ '_method': 'DELETE' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message, 'success');
                        setTimeout(() => { window.location.reload(); }, 800);
                    } else {
                        showToast(data.message || 'Gagal menghapus', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('Gagal menghapus data', 'error');
                });
            }
        }

        function showToast(message, type = 'success') {
            // Implementasi toast sederhana bisa ditambahkan di sini jika diperlukan
            alert(message); // Fallback sementara
        }
    </script>
</body>
</html><?php /**PATH C:\Users\DELL\Desa-Digital2\resources\views/admin/kecamatan/index.blade.php ENDPATH**/ ?>