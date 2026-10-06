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
        
        .table-actions { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; }
        .search-box { position: relative; }
        .search-box input { width: 240px; padding: 9px 14px 9px 38px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; }
        .search-box input:focus { outline: none; border-color: #1e3a8a; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; }
        
        .btn-add { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th { padding: 14px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-modern td { padding: 16px 20px; font-size: 13px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .tempat-link { font-weight: 600; color: #1e3a8a; cursor: pointer; text-decoration: none; display: flex; align-items: center; gap: 10px; }
        .tempat-link:hover { color: #1e40af; text-decoration: underline; }
        .tempat-icon { width: 32px; height: 32px; border-radius: 8px; background: #dbeafe; display: flex; align-items: center; justify-content: center; color: #1e40af; font-size: 14px; }
        
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; border: 1px solid #e2e8f0; background: white; color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-right: 6px; }
        .btn-action:hover { background: #f8fafc; }
        .btn-edit:hover { color: #1e3a8a; border-color: #1e3a8a; }
        .btn-delete:hover { color: #dc2626; border-color: #dc2626; background: #fef2f2; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; color: #cbd5e1; }
        .empty-state h4 { font-size: 16px; font-weight: 600; color: #64748b; margin-bottom: 8px; }
        
        .pagination-wrapper { padding: 20px 24px; border-top: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .pagination-info { font-size: 13px; color: #64748b; font-weight: 500; }
        .pagination { margin: 0; display: flex; gap: 4px; list-style: none; padding: 0; }
        .pagination .page-link { border: 1px solid #e2e8f0; color: #1e3a8a; font-size: 13px; font-weight: 600; padding: 8px 14px; border-radius: 6px; text-decoration: none; background: white; }
        .pagination .page-link:hover { background: #f1f5f9; border-color: #1e3a8a; }
        .pagination .page-item.active .page-link { background: #1e3a8a; border-color: #1e3a8a; color: white; }
        .pagination .page-item.disabled .page-link { color: #cbd5e1; cursor: not-allowed; background: #f8fafc; }
        
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
        
        .section-divider { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 10px 0; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }
        
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }
        
        .file-upload-container { border: 2px dashed #e2e8f0; border-radius: 10px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.2s; background: #f8fafc; }
        .file-upload-container:hover { border-color: #1e3a8a; background: #f1f5f9; }
        .file-upload-container input[type="file"] { display: none; }
        .file-upload-icon { font-size: 32px; color: #94a3b8; margin-bottom: 8px; }
        .file-upload-text { font-size: 13px; color: #64748b; font-weight: 500; }
        .file-upload-hint { font-size: 11px; color: #94a3b8; margin-top: 4px; }
        .file-preview { margin-top: 12px; display: none; }
        .file-preview img { max-width: 100%; max-height: 200px; border-radius: 8px; border: 2px solid #e2e8f0; }
        .file-preview.active { display: block; }
        
        .btn-modal-cancel { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        @media (max-width: 992px) { .main-content { margin-left: 0; } }
        @media (max-width: 768px) { .card-header-modern { flex-direction: column; align-items: stretch; } .table-actions { flex-direction: column; } .search-box input { width: 100%; } }
    </style>
</head>
<body>
    
    @include('admin.partials.sidebar', ['activeMenu' => $kategori])

    <div class="main-content">
        <header class="top-header">
            <div class="breadcrumb-simple">
                <a href="{{ route('dashboard') }}">Admin</a>
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
                        Daftar {{ ucfirst($kategori) }}
                        <span class="badge-count">{{ $totalTempat }} Data</span>
                    </div>
                    <div class="table-actions">
                        <form method="GET" action="{{ route('admin.tempat.kategori', $kategori) }}" style="display: flex; gap: 10px; align-items: center;">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama...">
                            </div>
                        </form>
                        <button type="button" class="btn-add" onclick="openTambahModal()">
                            <i class="bi bi-plus-lg"></i> Tambah {{ ucfirst($kategori) }}
                        </button>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA</th>
                                <th>DESA</th>
                                <th>ALAMAT</th>
                                <th style="width: 140px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tempats as $index => $tempat)
                            <tr>
                                <td style="color: #94a3b8; font-weight: 600;">{{ ($tempats->currentPage() - 1) * $tempats->perPage() + $index + 1 }}</td>
                                <td>
                                    <div class="tempat-link">
                                        <div class="tempat-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                        {{ $tempat->nama }}
                                    </div>
                                </td>
                                <td>{{ $tempat->desa ?? '-' }}</td>
                                <td>{{ $tempat->alamat ?? '-' }}</td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="openEditModal({{ $tempat->id }}, '{{ addslashes($tempat->nama) }}', '{{ addslashes($tempat->desa ?? '') }}', '{{ addslashes($tempat->alamat ?? '') }}', '{{ $tempat->latitude ?? '' }}', '{{ $tempat->longitude ?? '' }}', '{{ addslashes($tempat->deskripsi ?? '') }}')">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="hapusData({{ $tempat->id }}, '{{ addslashes($tempat->nama) }}')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum ada data {{ $kategori }}</h4>
                                        <p>Klik tombol "Tambah {{ ucfirst($kategori) }}" untuk menambahkan data.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($tempats->hasPages())
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Showing {{ $tempats->firstItem() }} to {{ $tempats->lastItem() }} of {{ $tempats->total() }} results
                    </div>
                    <ul class="pagination">
                        @if ($tempats->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo; Prev</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $tempats->previousPageUrl() }}">&laquo; Prev</a></li>
                        @endif
                        @foreach ($tempats->getUrlRange(1, $tempats->lastPage()) as $page => $url)
                            @if ($page == $tempats->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                        @if ($tempats->hasMorePages())
                            <li class="page-item"><a class="page-link" href="{{ $tempats->nextPageUrl() }}">Next &raquo;</a></li>
                        @else
                            <li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>
                        @endif
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit -->
    <div class="modal fade modal-form" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle"><i class="bi bi-plus-circle"></i> Tambah {{ ucfirst($kategori) }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formData" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="dataId" name="id">
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                    <div class="modal-body">
                        <div class="section-divider">Informasi Dasar</div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Nama <span class="required">*</span></label>
                                <input type="text" id="namaData" name="nama" class="form-input-custom" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Desa</label>
                                <input type="text" id="desaData" name="desa" class="form-input-custom" placeholder="Nama desa">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Alamat</label>
                                <input type="text" id="alamatData" name="alamat" class="form-input-custom" placeholder="Alamat lengkap">
                            </div>
                        </div>

                        <div class="section-divider">Lokasi</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Latitude</label>
                                <input type="text" id="latitudeData" name="latitude" class="form-input-custom" placeholder="-6.9175">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Longitude</label>
                                <input type="text" id="longitudeData" name="longitude" class="form-input-custom" placeholder="111.8360">
                            </div>
                        </div>

                        <div class="section-divider">Deskripsi</div>
                        <div class="mb-3">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea id="deskripsiData" name="deskripsi" class="form-textarea-custom" placeholder="Deskripsi singkat"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn-modal-save"><i class="bi bi-check-lg"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalForm;
        let currentDataId = null;
        const kategori = '{{ $kategori }}';

        document.addEventListener('DOMContentLoaded', function() {
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            document.getElementById('formData').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });
        });

        function openTambahModal() {
            currentDataId = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah ' + capitalizeFirst(kategori);
            document.getElementById('formData').reset();
            document.getElementById('dataId').value = '';
            document.getElementById('formData').action = '/admin/tempat';
            document.getElementById('formData').method = 'POST';
            
            // Hapus method PUT jika ada
            let methodInput = document.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();
            
            modalForm.show();
        }

        function openEditModal(id, nama, desa, alamat, latitude, longitude, deskripsi) {
            currentDataId = id;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit ' + capitalizeFirst(kategori);
            document.getElementById('dataId').value = id;
            document.getElementById('namaData').value = nama || '';
            document.getElementById('desaData').value = desa || '';
            document.getElementById('alamatData').value = alamat || '';
            document.getElementById('latitudeData').value = latitude || '';
            document.getElementById('longitudeData').value = longitude || '';
            document.getElementById('deskripsiData').value = deskripsi || '';
            document.getElementById('formData').action = '/admin/tempat/' + id;
            document.getElementById('formData').method = 'POST';
            
            // Tambahkan method PUT
            let methodInput = document.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'PUT';
                document.getElementById('formData').appendChild(methodInput);
            } else {
                methodInput.value = 'PUT';
            }
            
            modalForm.show();
        }

        function hapusData(id, nama) {
            if (confirm(`Yakin ingin menghapus "${nama}"?`)) {
                fetch('/admin/tempat/' + id, {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                        'Accept': 'application/json' 
                    },
                    body: new URLSearchParams({ '_method': 'DELETE' })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) location.reload();
                    else alert(data.message || 'Gagal menghapus');
                })
                .catch(err => { console.error(err); alert('Gagal menghapus'); });
            }
        }

        function submitForm() {
            const formData = new FormData(document.getElementById('formData'));
            const url = currentDataId ? '/admin/tempat/' + currentDataId : '/admin/tempat';
            
            if (currentDataId) formData.append('_method', 'PUT');

            fetch(url, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { modalForm.hide(); location.reload(); }
                else {
                    let msg = 'Gagal menyimpan';
                    if (data.errors) msg = Object.values(data.errors).flat().join('\n');
                    else if (data.message) msg = data.message;
                    alert('Error: ' + msg);
                }
            })
            .catch(err => { console.error(err); alert('Terjadi kesalahan'); });
        }

        function capitalizeFirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
</body>
</html>