<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ucfirst($kategori) }} - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; }
        .main-content { margin-left: 260px; }
        .top-header { min-height: 62px; background: white; border-bottom: 1px solid #e2e8f0; padding: 0 28px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 99; }
        .breadcrumb-simple { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 8px; }
        .breadcrumb-simple a { color: #64748b; text-decoration: none; }
        .breadcrumb-simple a:hover { color: #1e3a8a; }
        .breadcrumb-simple .separator { color: #cbd5e1; }
        .breadcrumb-simple .active { color: #1e293b; font-weight: 600; }
        .page-body { padding: 28px; }
        .page-header { margin-bottom: 24px; }
        .page-label { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
        .page-title { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 6px; }
        .page-subtitle { font-size: 13px; color: #64748b; }
        .card-modern { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 24px; }
        .card-header-modern { padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .card-title-modern { font-size: 14px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 10px; }
        .card-title-modern i { color: #1e3a8a; font-size: 18px; }
        .badge-count { background: #1e3a8a; color: white; font-size: 11px; padding: 3px 10px; border-radius: 10px; font-weight: 600; }
        .btn-add { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th { padding: 14px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-modern td { padding: 16px 20px; font-size: 13px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-modern tbody tr { transition: all 0.2s; cursor: pointer; }
        .table-modern tbody tr:hover { background: #f1f5f9; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        .tempat-link { display: flex; align-items: center; gap: 10px; font-weight: 600; color: #1e3a8a; text-decoration: none; }
        .tempat-icon { width: 32px; height: 32px; border-radius: 8px; background: #dbeafe; display: flex; align-items: center; justify-content: center; color: #1e40af; font-size: 14px; }
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; color: #cbd5e1; }
        .empty-state h4 { font-size: 16px; font-weight: 600; color: #64748b; margin-bottom: 8px; }
        .modal-detail .modal-dialog { max-width: 560px; }
        .modal-detail .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.2); overflow: hidden; }
        .modal-detail .modal-header { background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); color: white; padding: 16px 20px; border: none; }
        .modal-detail .modal-header .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .modal-detail .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.9; }
        .modal-detail .modal-header .btn-close:hover { opacity: 1; }
        .modal-detail .modal-body { padding: 0; }
        .modal-detail .photo-area { width: 100%; height: 220px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid #f1f5f9; overflow: hidden; }
        .modal-detail .photo-area img { width: 100%; height: 100%; object-fit: cover; }
        .modal-detail .photo-area i { font-size: 48px; color: #94a3b8; }
        .modal-detail .detail-content { padding: 20px 24px 24px; }
        .modal-detail .detail-title { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; }
        .modal-detail .detail-subtitle { font-size: 13px; color: #64748b; margin-bottom: 20px; display: flex; align-items: center; gap: 6px; padding-left: 2px; }
        .modal-detail .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px 24px; }
        .modal-detail .info-item label { display: block; font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .modal-detail .info-item p { font-size: 14px; color: #1e293b; font-weight: 500; margin: 0; word-break: break-word; line-height: 1.5; }
        .modal-detail .info-item.full-width { grid-column: 1 / -1; }
        .modal-detail .modal-footer { border-top: 1px solid #e2e8f0; padding: 12px 20px; background: white; justify-content: flex-end; gap: 8px; }
        .btn-modal-cancel { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-cancel:hover { background: #f8fafc; }
        .btn-modal-delete { background: #ef4444; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-delete:hover { background: #dc2626; }
        .btn-modal-edit { background: #2563eb; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-edit:hover { background: #1d4ed8; }
        .modal-form .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-form .modal-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-radius: 12px 12px 0 0; padding: 18px 22px; border: none; }
        .modal-form .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-form .modal-header .btn-close { filter: brightness(0) invert(1); }
        .modal-form .modal-body { padding: 24px 22px; max-height: 70vh; overflow-y: auto; }
        .modal-form .modal-footer { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px; }
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; }
        .form-input-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .form-textarea-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; resize: vertical; min-height: 80px; }
        .form-textarea-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .btn-modal-save { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        .section-divider { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 10px 0; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }
        .current-photo-preview { margin-top: 8px; }
        .current-photo-preview img { max-width: 100px; border-radius: 4px; border: 1px solid #e2e8f0; }
        .current-photo-label { font-size: 11px; color: #64748b; margin-bottom: 4px; display: block; }
        @media (max-width: 992px) { .main-content { margin-left: 0; } }
        @media (max-width: 768px) { .card-header-modern { flex-direction: column; align-items: stretch; } .info-grid { grid-template-columns: 1fr; } .modal-detail .modal-dialog { max-width: 95%; margin: 10px; } }
    </style>
</head>
<body>
    @include('admin.partials.sidebar', ['activeMenu' => $kategori])

    <div class="main-content">
        <header class="top-header">
            <div class="breadcrumb-simple">
                <a href="{{ route('dashboard') }}">Admin</a>
                <span class="separator">/</span>
                <a href="{{ route('admin.tempat.index') }}">Tempat</a>
                <span class="separator">/</span>
                <span class="active">{{ ucfirst($kategori) }}</span>
            </div>
            @include('admin.partials.header-actions')
        </header>

        <div class="page-body">
            <div class="page-header">
                <div class="page-label">DATA {{ strtoupper($kategori) }}</div>
                <h1 class="page-title">{{ ucfirst($kategori) }}</h1>
                <p class="page-subtitle">Kelola data {{ $kategori }} di Kabupaten Tuban.</p>
            </div>

            @if(session('success'))
            <div class="alert-banner alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button class="close-btn" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <div class="card-modern">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <i class="bi bi-list-ul"></i>
                        Daftar Data {{ ucfirst($kategori) }}
                        <span class="badge-count">{{ $data->count() }} Data</span>
                    </div>
                    <div style="display: flex; gap: 10px;">
                        <button type="button" class="btn-add" onclick="openTambahDataModal()">
                            <i class="bi bi-plus-lg"></i> Tambah Data
                        </button>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    @if($fields->count() === 0)
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>Belum ada field yang dikonfigurasi</h4>
                        <p>Klik tombol "Tambah Data" untuk menambahkan data baru.</p>
                    </div>
                    @elseif($data->count() === 0)
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>Belum ada data</h4>
                        <p>Klik tombol "Tambah Data" untuk menambahkan data baru.</p>
                    </div>
                    @else
                    <table class="table-modern" id="dataTable">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA TEMPAT</th>
                                <th>DESA</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            @php
                                $infoTambahan = $item->info_tambahan;
                                $desaValue = $item->desa ?? '';
                                if (empty($desaValue)) {
                                    $desaValue = $infoTambahan['desa'] ?? $infoTambahan['nama_desa'] ?? $infoTambahan['Desa'] ?? $infoTambahan['Nama Desa'] ?? '';
                                }
                                $desaDisplay = !empty($desaValue) ? $desaValue : '-';
                                $fotoValue = '';
                                foreach ($infoTambahan as $key => $val) {
                                    if (in_array(strtolower($key), ['foto', 'gambar', 'image', 'photo'])) {
                                        $fotoValue = $val;
                                        break;
                                    }
                                }
                            @endphp
                            <tr class="data-row" 
                                data-id="{{ $item->id }}" 
                                data-nama="{{ $item->nama }}" 
                                data-desa="{{ $desaDisplay }}"
                                data-foto="{{ $fotoValue }}"
                                data-info='@json($infoTambahan)'>
                                <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="tempat-link">
                                        <div class="tempat-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                        {{ $item->nama }}
                                    </div>
                                </td>
                                <td>{{ $desaDisplay }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade modal-detail" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-geo-alt-fill"></i> Detail {{ ucfirst($kategori) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="photo-area" id="detailPhoto"><i class="bi bi-geo-alt-fill"></i></div>
                    <div class="detail-content">
                        <div class="detail-title" id="detailNama">Nama Tempat</div>
                        <div class="detail-subtitle"><i class="bi bi-geo-alt"></i> <span id="detailDesa">Desa</span></div>
                        <div class="info-grid" id="detailGrid"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tutup</button>
                    <button type="button" class="btn-modal-delete" id="btnDeleteModal"><i class="bi bi-trash"></i> Hapus</button>
                    <button type="button" class="btn-modal-edit" id="btnEditModal"><i class="bi bi-pencil"></i> Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form (Tambah/Edit) -->
    <div class="modal fade modal-form" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle"><i class="bi bi-plus-circle"></i> Tambah Data {{ ucfirst($kategori) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formData" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="dataId" name="id">
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                    <div class="modal-body" id="formBody"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn-modal-save"><i class="bi bi-check-lg"></i> <span id="btnSaveText">Simpan</span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
        $fieldsList = $fields->map(function($f) {
            return ['nama_field' => $f->nama_field, 'tipe_field' => $f->tipe_field, 'label' => ucfirst(str_replace('_', ' ', $f->nama_field))];
        })->values();
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalDetail, modalForm;
        let currentItemId = null;
        const fieldsList = @json($fieldsList);
        const kategori = '{{ $kategori }}';

        document.addEventListener('DOMContentLoaded', function() {
            modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            
            document.getElementById('formData').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            const dataTable = document.getElementById('dataTable');
            if (dataTable) {
                dataTable.addEventListener('click', function(e) {
                    const row = e.target.closest('.data-row');
                    if (row) {
                        const id = row.getAttribute('data-id');
                        const nama = row.getAttribute('data-nama');
                        const desa = row.getAttribute('data-desa');
                        const foto = row.getAttribute('data-foto') || '';
                        let infoTambahan = {};
                        try { infoTambahan = JSON.parse(row.getAttribute('data-info') || '{}'); } catch (err) {}
                        showDetailModal(id, nama, desa, foto, infoTambahan);
                    }
                });
            }
        });

        function showDetailModal(id, nama, desa, foto, infoTambahan) {
            currentItemId = id;
            document.getElementById('detailNama').innerHTML = '<i class="bi bi-geo-alt-fill"></i> ' + nama;
            document.getElementById('detailDesa').innerText = desa || '-';
            
            const photoArea = document.getElementById('detailPhoto');
            if (foto && foto !== '' && foto !== '-') {
                photoArea.innerHTML = '<img src="/storage/' + foto + '" alt="' + nama + '">';
            } else {
                photoArea.innerHTML = '<i class="bi bi-geo-alt-fill"></i>';
            }
            
            document.getElementById('btnDeleteModal').onclick = function() { 
                if (confirm('Yakin ingin menghapus "' + nama + '"?')) {
                    modalDetail.hide();
                    setTimeout(() => hapusData(id, nama), 300);
                }
            };
            document.getElementById('btnEditModal').onclick = function() { 
                modalDetail.hide(); 
                setTimeout(() => openEditModal(id, nama, desa, foto, infoTambahan), 300);
            };
            
            const gridContainer = document.getElementById('detailGrid');
            gridContainer.innerHTML = '';
            
            fieldsList.forEach(function(field) {
                const fieldName = field.nama_field.toLowerCase();
                if (['foto', 'gambar', 'image', 'photo'].includes(fieldName)) return;
                if (['desa', 'nama_desa'].includes(fieldName)) return;
                
                const value = infoTambahan[field.nama_field] || '-';
                let displayValue = value;
                
                if (field.tipe_field === 'file' && value !== '-' && value !== '') {
                    displayValue = '<img src="/storage/' + value + '" style="width: 100px; height: auto; border-radius: 4px; border: 1px solid #e2e8f0;">';
                } else if (field.tipe_field === 'textarea' && value !== '-') {
                    displayValue = '<p style="white-space: pre-wrap; margin: 0;">' + value + '</p>';
                }
                
                const isFullWidth = field.tipe_field === 'textarea' || field.tipe_field === 'file';
                gridContainer.innerHTML += '<div class="info-item' + (isFullWidth ? ' full-width' : '') + '"><label>' + field.label + '</label><p>' + displayValue + '</p></div>';
            });
            
            modalDetail.show();
        }

        function buildFormFields(infoTambahan = {}, currentFoto = '') {
            const formBody = document.getElementById('formBody');
            let html = '';
            
            html += '<div class="section-divider">Informasi Dasar</div>';
            html += '<div class="mb-3">';
            html += '<label class="form-label-custom">Nama <span class="required">*</span></label>';
            html += '<input type="text" name="nama" class="form-input-custom" value="' + escapeHtml(infoTambahan['__nama'] || '') + '" required>';
            html += '</div>';
            
            if (fieldsList.length > 0) {
                html += '<div class="section-divider">Field Tambahan</div>';
                
                fieldsList.forEach(function(field) {
                    const fieldName = field.nama_field;
                    const value = infoTambahan[fieldName] || '';
                    const isCoordinate = ['latitude', 'longitude'].includes(fieldName);

                    html += '<div class="mb-3">';
                    html += '<label class="form-label-custom">' + field.label + (isCoordinate ? ' <span class="required">*</span>' : '') + '</label>';

                    if (field.tipe_field === 'text') {
                        html += '<input type="text" name="' + fieldName + '" class="form-input-custom" value="' + escapeHtml(value) + '" placeholder="Masukkan ' + field.label.toLowerCase() + '">';
                    } else if (field.tipe_field === 'number') {
                        const range = fieldName === 'latitude' ? ' min="-90" max="90"' : (fieldName === 'longitude' ? ' min="-180" max="180"' : '');
                        html += '<input type="number" step="any"' + range + (isCoordinate ? ' required' : '') + ' name="' + fieldName + '" class="form-input-custom" value="' + escapeHtml(value) + '" placeholder="Masukkan ' + field.label.toLowerCase() + '">';
                    } else if (field.tipe_field === 'textarea') {
                        html += '<textarea name="' + fieldName + '" class="form-textarea-custom" placeholder="Masukkan ' + field.label.toLowerCase() + '">' + escapeHtml(value) + '</textarea>';
                    } else if (field.tipe_field === 'file') {
                        html += '<input type="file" name="' + fieldName + '" class="form-input-custom" accept="image/*">';
                        html += '<small style="color: #64748b; font-size: 11px;">Format: JPG, PNG, WEBP</small>';
                        
                        const fieldNameLower = fieldName.toLowerCase();
                        if (['foto', 'gambar', 'image', 'photo'].includes(fieldNameLower) && currentFoto) {
                            html += '<div class="current-photo-preview">';
                            html += '<span class="current-photo-label">Foto saat ini:</span>';
                            html += '<img src="/storage/' + currentFoto + '" alt="Foto saat ini">';
                            html += '</div>';
                        }
                    } else if (field.tipe_field === 'date') {
                        html += '<input type="date" name="' + fieldName + '" class="form-input-custom" value="' + escapeHtml(value) + '">';
                    }
                    
                    html += '</div>';
                });
            } else {
                html += '<div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 16px; margin-top: 16px;">';
                html += '<i class="bi bi-exclamation-triangle" style="color: #d97706; font-size: 18px;"></i>';
                html += '<strong style="color: #92400e; display: block; margin-bottom: 4px;">Belum ada field</strong>';
                html += '<span style="color: #78350f; font-size: 13px;">Silakan tambahkan field melalui menu Tempat (Master).</span>';
                html += '</div>';
            }
            
            formBody.innerHTML = html;
        }

        function escapeHtml(text) {
            if (!text) return '';
            return String(text).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
        }

        function openTambahDataModal() {
            currentItemId = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Data ' + capitalizeFirst(kategori);
            document.getElementById('btnSaveText').innerText = 'Simpan';
            document.getElementById('dataId').value = '';
            buildFormFields({}, '');
            modalForm.show();
        }

        function openEditModal(id, nama, desa, foto, infoTambahan) {
            currentItemId = id;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Data ' + capitalizeFirst(kategori);
            document.getElementById('btnSaveText').innerText = 'Update';
            document.getElementById('dataId').value = id;
            infoTambahan['__nama'] = nama;
            buildFormFields(infoTambahan, foto);
            modalForm.show();
        }

        function submitForm() {
            const form = document.getElementById('formData');
            const formData = new FormData(form);
            const id = document.getElementById('dataId').value;
            
            let url, method;
            
            if (id) {
                url = '/admin/tempat/' + id;
                method = 'POST';
                formData.append('_method', 'PUT');
            } else {
                url = '/admin/tempat/data';
                method = 'POST';
            }
            
            formData.set('kategori', kategori);
            
            fetch(url, {
                method: method,
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: formData
            })
            .then(r => {
                if (!r.ok) {
                    return r.text().then(text => { throw new Error(text); });
                }
                return r.json();
            })
            .then(data => {
                if (data.success) { 
                    modalForm.hide(); 
                    location.reload(); 
                } else {
                    let msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Gagal menyimpan');
                    alert('Error: ' + msg);
                }
            })
            .catch(err => { console.error('Submit error:', err); alert('Terjadi kesalahan: ' + err.message); });
        }

        function hapusData(id, nama) {
            fetch('/admin/tempat/' + id, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: new URLSearchParams({ '_method': 'DELETE' })
            })
            .then(r => {
                if (!r.ok) {
                    return r.text().then(text => { throw new Error(text); });
                }
                return r.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Data berhasil dihapus!');
                    location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus');
                }
            })
            .catch(err => { console.error('Delete error:', err); alert('Gagal menghapus: ' + err.message); });
        }

        function capitalizeFirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
</body>
</html>