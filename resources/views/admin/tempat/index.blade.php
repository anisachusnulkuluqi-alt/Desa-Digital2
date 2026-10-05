<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tempat - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; }
        
        .sidebar { width: 260px; background: #0f172a; min-height: 100vh; position: fixed; left: 0; top: 0; padding: 20px 14px; z-index: 100; overflow-y: auto; }
        .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
        .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; }
        .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
        .sidebar-brand-text small { color: #64748b; font-size: 10px; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu .sidebar-menu-divider { height: 0; margin: 10px 10px 8px; border-top: 1px solid rgba(148, 163, 184, .25); list-style: none; }
        .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover { background: #1d4ed8; color: white; }
        .sidebar-menu a.active { background: #2563eb; color: white; }
        .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
        
        .main-content { margin-left: 260px; }
        
        .top-header { background: white; border-bottom: 1px solid #e2e8f0; padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 99; }
        .breadcrumb-simple { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 8px; }
        .breadcrumb-simple a { color: #64748b; text-decoration: none; }
        .breadcrumb-simple a:hover { color: #1e3a8a; }
        .breadcrumb-simple .separator { color: #cbd5e1; }
        .breadcrumb-simple .active { color: #1e293b; font-weight: 600; }
        
        .header-actions { display: flex; align-items: center; gap: 12px; }
        .header-home-btn { width: 38px; height: 38px; border-radius: 8px; background: white; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; cursor: pointer; transition: all 0.2s; text-decoration: none; font-size: 16px; }
        .header-home-btn:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e3a8a; }
        
        .user-profile { display: flex; align-items: center; gap: 10px; padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; }
        .user-avatar { width: 32px; height: 32px; border-radius: 8px; background: #1e3a8a; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px; }
        .user-info strong { display: block; font-size: 12px; font-weight: 600; color: #1e293b; }
        .user-info small { font-size: 10px; color: #64748b; }
        
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
        
        .badge-kategori { display: inline-block; padding: 3px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
        
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
        
        .autocomplete-wrapper { position: relative; }
        .autocomplete-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin-top: 4px;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            display: none;
        }
        .autocomplete-list.active { display: block; }
        .autocomplete-item {
            padding: 10px 14px;
            cursor: pointer;
            font-size: 13px;
            color: #1e293b;
            transition: all 0.15s;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .autocomplete-item:hover { background: #f1f5f9; }
        .autocomplete-item i { color: #94a3b8; font-size: 12px; }
        .autocomplete-item.new-item { 
            background: #fef3c7; 
            border-top: 1px dashed #e2e8f0;
        }
        .autocomplete-item.new-item i { color: #d97706; }
        
        .kategori-hint { 
            font-size: 11px; 
            color: #64748b; 
            margin-top: 4px; 
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .kategori-hint i { color: #1e3a8a; }
        
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
        
        .section-divider { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 10px 0; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }
        
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }
        
        @media (max-width: 992px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } }
        @media (max-width: 768px) { .card-header-modern { flex-direction: column; align-items: stretch; } .table-actions { flex-direction: column; } .search-box input { width: 100%; } }
    </style>
</head>
<body>
    
    @include('admin.partials.sidebar', ['activeMenu' => 'tempat'])

    <div class="main-content">
        <header class="top-header">
            <div class="breadcrumb-simple">
                <a href="{{ route('dashboard') }}">Admin</a>
                <span class="separator">/</span>
                <span class="active">Tempat</span>
            </div>
            <div class="header-actions">
                <a href="{{ url('/') }}" class="header-home-btn" title="Kembali ke Website">
                    <i class="bi bi-house-fill"></i>
                </a>
                <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                    <div class="user-info">
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                        <small>{{ ucfirst(Auth::user()->role ?? 'Admin') }}</small>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-body">
            <div class="page-header">
                <div class="page-label">DATA TEMPAT</div>
                <h1 class="page-title">Tempat</h1>
                <p class="page-subtitle">Kelola data tempat di Kabupaten Tuban.</p>
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
                        Daftar Tempat
                        <span class="badge-count">{{ $tempats->total() }} Titik</span>
                    </div>
                    <div class="table-actions">
                        <form method="GET" action="{{ route('admin.tempat.index') }}" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama tempat...">
                            </div>
                        </form>
                        <button type="button" class="btn-add" onclick="openTambahModal()">
                            <i class="bi bi-plus-lg"></i> Tambah Tempat
                        </button>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA TEMPAT</th>
                                <th>KATEGORI</th>
                                <th>DESA</th>
                                <th>KOORDINAT</th>
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
                                <td>
                                    <span class="badge-kategori" style="background: {{ $tempat->kategori_color }}; color: {{ $tempat->kategori_text_color }};">{{ ucfirst($tempat->kategori) }}</span>
                                </td>
                                <td>{{ $tempat->desa ?? '-' }}</td>
                                <td>
                                    @if($tempat->latitude && $tempat->longitude)
                                        <span style="font-family: monospace; font-size: 12px; color: #1e40af; font-weight: 600;">{{ $tempat->latitude }}, {{ $tempat->longitude }}</span>
                                    @else
                                        <span style="color: #94a3b8;">-</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn-action btn-edit" onclick="openEditModal({{ $tempat->id }}, '{{ addslashes($tempat->nama) }}', '{{ addslashes($tempat->kategori) }}', '{{ addslashes($tempat->desa ?? '') }}', '{{ addslashes($tempat->alamat ?? '') }}', '{{ $tempat->latitude ?? '' }}', '{{ $tempat->longitude ?? '' }}', '{{ addslashes($tempat->deskripsi ?? '') }}', '{{ $tempat->foto ? asset('storage/' . $tempat->foto) : '' }}')">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="hapusTempat({{ $tempat->id }}, '{{ addslashes($tempat->nama) }}')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum ada data tempat</h4>
                                        <p>Klik tombol "Tambah Tempat" untuk menambahkan data baru.</p>
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
                    <h5 class="modal-title" id="modalFormTitle"><i class="bi bi-plus-circle"></i> Tambah Tempat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formTempat" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="tempatId" name="id">
                    <div class="modal-body">
                        <div class="section-divider">Informasi Dasar</div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Nama Tempat <span class="required">*</span></label>
                                <input type="text" id="namaTempat" name="nama" class="form-input-custom" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Kategori <span class="required">*</span></label>
                                <div class="autocomplete-wrapper">
                                    <input type="text" id="kategoriInput" name="kategori" class="form-input-custom" 
                                           placeholder="Ketik kategori (contoh: wisata, kuliner, hotel...)" 
                                           autocomplete="off" required>
                                    <div class="autocomplete-list" id="autocompleteList"></div>
                                </div>
                                <div class="kategori-hint">
                                    <i class="bi bi-lightbulb"></i>
                                    <span>Ketik untuk melihat saran kategori, atau ketik kategori baru</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Desa</label>
                                <input type="text" id="desa" name="desa" class="form-input-custom" placeholder="Nama desa">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Alamat</label>
                                <input type="text" id="alamat" name="alamat" class="form-input-custom" placeholder="Alamat lengkap">
                            </div>
                        </div>

                        <div class="section-divider">Lokasi</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-input-custom" placeholder="-6.9175">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-input-custom" placeholder="111.8360">
                            </div>
                        </div>

                        <div class="section-divider">Deskripsi & Foto</div>
                        <div class="mb-3">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-textarea-custom" placeholder="Deskripsi singkat tentang tempat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Foto</label>
                            <label class="file-upload-container" for="fotoUpload">
                                <input type="file" id="fotoUpload" name="foto" accept="image/*" onchange="previewFoto(this)">
                                <div class="file-upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                                <div class="file-upload-text">Klik untuk upload foto</div>
                                <div class="file-upload-hint">Format: JPG, PNG, WEBP (Maks 2MB)</div>
                            </label>
                            <div class="file-preview" id="fotoPreview">
                                <img id="fotoPreviewImg" src="" alt="Preview">
                            </div>
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
        let currentTempatId = null;
        let autocompleteTimeout = null;

        document.addEventListener('DOMContentLoaded', function() {
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            document.getElementById('formTempat').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            const kategoriInput = document.getElementById('kategoriInput');
            const autocompleteList = document.getElementById('autocompleteList');

            kategoriInput.addEventListener('input', function() {
                clearTimeout(autocompleteTimeout);
                const query = this.value.trim();
                
                if (query.length < 1) {
                    autocompleteList.classList.remove('active');
                    return;
                }

                autocompleteTimeout = setTimeout(() => {
                    fetch(`/admin/tempat/autocomplete-kategori?q=${encodeURIComponent(query)}`)
                        .then(r => r.json())
                        .then(data => {
                            autocompleteList.innerHTML = '';
                            
                            if (data.length > 0) {
                                data.forEach(kat => {
                                    const item = document.createElement('div');
                                    item.className = 'autocomplete-item';
                                    item.innerHTML = `<i class="bi bi-tag"></i> ${kat}`;
                                    item.onclick = () => {
                                        kategoriInput.value = kat;
                                        autocompleteList.classList.remove('active');
                                    };
                                    autocompleteList.appendChild(item);
                                });
                            }
                            
                            const newItem = document.createElement('div');
                            newItem.className = 'autocomplete-item new-item';
                            newItem.innerHTML = `<i class="bi bi-plus-circle"></i> Buat kategori baru: "<strong>${query}</strong>"`;
                            newItem.onclick = () => {
                                autocompleteList.classList.remove('active');
                            };
                            autocompleteList.appendChild(newItem);
                            
                            autocompleteList.classList.add('active');
                        });
                }, 300);
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.autocomplete-wrapper')) {
                    autocompleteList.classList.remove('active');
                }
            });
        });

        function previewFoto(input) {
            const preview = document.getElementById('fotoPreview');
            const previewImg = document.getElementById('fotoPreviewImg');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.classList.add('active');
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.remove('active');
            }
        }

        function openTambahModal() {
            currentTempatId = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Tempat';
            document.getElementById('formTempat').reset();
            document.getElementById('tempatId').value = '';
            document.getElementById('fotoPreview').classList.remove('active');
            document.getElementById('autocompleteList').classList.remove('active');
            modalForm.show();
        }

        function openEditModal(id, nama, kategori, desa, alamat, latitude, longitude, deskripsi, foto) {
            currentTempatId = id;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Tempat';
            document.getElementById('tempatId').value = id;
            document.getElementById('namaTempat').value = nama || '';
            document.getElementById('kategoriInput').value = kategori || '';
            document.getElementById('desa').value = desa || '';
            document.getElementById('alamat').value = alamat || '';
            document.getElementById('latitude').value = latitude || '';
            document.getElementById('longitude').value = longitude || '';
            document.getElementById('deskripsi').value = deskripsi || '';
            
            const preview = document.getElementById('fotoPreview');
            const previewImg = document.getElementById('fotoPreviewImg');
            if (foto && foto.trim() !== '') {
                previewImg.src = foto;
                preview.classList.add('active');
            } else {
                preview.classList.remove('active');
            }
            modalForm.show();
        }

        function hapusTempat(id, nama) {
            if (confirm(`Yakin ingin menghapus "${nama}"?`)) {
                fetch(`/admin/tempat/${id}`, {
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
            const formData = new FormData(document.getElementById('formTempat'));
            const id = document.getElementById('tempatId').value;
            const url = id ? `/admin/tempat/${id}` : '/admin/tempat';
            if (id) formData.append('_method', 'PUT');

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
    </script>
</body>
</html>