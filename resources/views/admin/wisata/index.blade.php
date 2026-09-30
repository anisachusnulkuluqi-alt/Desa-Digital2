<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wisata Desa - Portal Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        .sidebar { width: 260px; background: #0f172a; min-height: 100vh; position: fixed; left: 0; top: 0; padding: 20px 14px; z-index: 100; }
        .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
        .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
        .sidebar-brand-icon img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
        .sidebar-brand-text small { color: #64748b; font-size: 10px; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: #2563eb; color: white; }
        .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
        
        .main-content { margin-left: 260px; }
        
        .top-header { background: white; border-bottom: 1px solid #e2e8f0; padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 99; }
        .breadcrumb { margin: 0; font-size: 13px; }
        .breadcrumb a { color: #64748b; text-decoration: none; }
        .breadcrumb a:hover { color: #1e3a8a; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        
        .header-user { display: flex; align-items: center; gap: 10px; padding: 6px 12px; background: white; border: 1px solid #e2e8f0; border-radius: 10px; }
        .header-user-avatar { width: 32px; height: 32px; border-radius: 8px; background: #1e3a8a; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 12px; }
        .header-user-name { font-size: 12px; font-weight: 600; color: #1e293b; }
        
        .page-body { padding: 28px; }
        
        .page-header { margin-bottom: 24px; }
        .page-label { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
        .page-title { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 6px; }
        .page-subtitle { font-size: 13px; color: #64748b; }
        
        .table-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; }
        .table-header { padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .table-title { font-size: 14px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 10px; }
        .badge-count { background: #1e3a8a; color: white; font-size: 11px; padding: 3px 10px; border-radius: 10px; font-weight: 600; }
        
        .table-actions { display: flex; align-items: center; gap: 12px; }
        .search-box { position: relative; }
        .search-box input { width: 240px; padding: 9px 14px 9px 38px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 13px; transition: all 0.2s; }
        .search-box input:focus { outline: none; border-color: #1e3a8a; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .search-box i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 14px; }
        
        .btn-add { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th { padding: 14px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-modern td { padding: 16px 20px; font-size: 13px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .wisata-link { 
            font-weight: 600; 
            color: #1e3a8a; 
            cursor: pointer; 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            transition: all 0.2s;
        }
        .wisata-link:hover { color: #1e40af; text-decoration: underline; }
        .wisata-icon { width: 32px; height: 32px; border-radius: 8px; background: #dbeafe; display: flex; align-items: center; justify-content: center; color: #1e40af; font-size: 14px; flex-shrink: 0; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; color: #cbd5e1; }
        .empty-state h4 { font-size: 16px; font-weight: 600; color: #64748b; margin-bottom: 8px; }
        .empty-state p { font-size: 13px; }
        
        /* Pagination - RAPI & BERFUNGSI */
        .pagination-wrapper { 
            padding: 20px 24px; 
            border-top: 1px solid #e2e8f0; 
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .pagination-info { font-size: 13px; color: #64748b; font-weight: 500; }
        .pagination { margin: 0; display: flex; gap: 4px; list-style: none; padding: 0; }
        .pagination .page-link { 
            border: 1px solid #e2e8f0; 
            color: #1e3a8a; 
            font-size: 13px; 
            font-weight: 600; 
            padding: 8px 14px; 
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pagination .page-link:hover { background: #f1f5f9; border-color: #1e3a8a; }
        .pagination .page-item.active .page-link { background: #1e3a8a; border-color: #1e3a8a; color: white; }
        .pagination .page-item.disabled .page-link { color: #cbd5e1; cursor: not-allowed; background: #f8fafc; border-color: #e2e8f0; }
        
        /* Modal Detail */
        .modal-detail .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-detail .modal-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-radius: 12px 12px 0 0; padding: 18px 22px; border: none; }
        .modal-detail .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-detail .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-detail .modal-body { padding: 0; }
        .modal-detail .modal-footer { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px; }
        
        .detail-foto-container { 
            width: 100%; 
            height: 250px; 
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            position: relative; 
            overflow: hidden; 
        }
        .detail-foto-container img { 
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
        }
        .detail-foto-placeholder { 
            color: white; 
            text-align: center; 
        }
        .detail-foto-placeholder i { font-size: 48px; opacity: 0.7; }
        .detail-foto-placeholder p { font-size: 13px; opacity: 0.8; margin-top: 8px; }
        
        .detail-info { padding: 24px 22px; }
        .detail-nama { font-size: 22px; font-weight: 800; color: #1e293b; margin-bottom: 6px; }
        .detail-desa { font-size: 13px; color: #64748b; margin-bottom: 20px; display: flex; align-items: center; gap: 6px; }
        
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px; }
        .detail-item { }
        .detail-item-label { font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
        .detail-item-value { font-size: 14px; font-weight: 600; color: #1e293b; }
        
        .detail-deskripsi { 
            background: #f8fafc; 
            padding: 14px; 
            border-radius: 8px; 
            font-size: 13px; 
            color: #475569; 
            line-height: 1.6; 
            margin-bottom: 20px; 
        }
        .detail-deskripsi-label { font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px; }
        
        .btn-modal-cancel { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-cancel:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        .btn-modal-edit { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-edit:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        .btn-modal-delete { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-delete:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35); color: white; }
        
        /* Modal Form */
        .modal-form .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-form .modal-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-radius: 12px 12px 0 0; padding: 18px 22px; border: none; }
        .modal-form .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-form .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-form .modal-body { padding: 24px 22px; max-height: 70vh; overflow-y: auto; }
        .modal-form .modal-footer { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px; }
        
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; }
        .form-input-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .form-textarea-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; resize: vertical; min-height: 80px; }
        .form-textarea-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        
        /* File Upload */
        .file-upload-container {
            border: 2px dashed #e2e8f0;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            background: #f8fafc;
        }
        .file-upload-container:hover {
            border-color: #1e3a8a;
            background: #f1f5f9;
        }
        .file-upload-container input[type="file"] {
            display: none;
        }
        .file-upload-icon {
            font-size: 32px;
            color: #94a3b8;
            margin-bottom: 8px;
        }
        .file-upload-text {
            font-size: 13px;
            color: #64748b;
            font-weight: 500;
        }
        .file-upload-hint {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 4px;
        }
        .file-preview {
            margin-top: 12px;
            display: none;
        }
        .file-preview img {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            border: 2px solid #e2e8f0;
        }
        .file-preview.active {
            display: block;
        }
        
        .btn-modal-save { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .section-divider { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 10px 0; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }
        
        .alert-banner { background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-banner i { font-size: 18px; color: #16a34a; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; color: #166534; cursor: pointer; font-size: 16px; }
        
        @media (max-width: 992px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } }
        @media (max-width: 768px) { .table-header { flex-direction: column; align-items: stretch; } .table-actions { flex-direction: column; } .search-box input { width: 100%; } .detail-grid { grid-template-columns: 1fr; } .pagination-wrapper { justify-content: center; } }
    </style>
    @include('admin.partials.list-page-styles')
</head>
<body>
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon"><img src="{{ asset('images/desa-digital.png') }}" alt="Logo Desa Digital"></div>
            <div class="sidebar-brand-text">
                <h5>Desa Digital</h5>
                <small>Admin pengelola data</small>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="bi bi-house-fill"></i><span>Beranda</span></a></li>
            <li><a href="{{ route('admin.kecamatan.index') }}"><i class="bi bi-geo-alt-fill"></i><span>Kecamatan</span></a></li>
            <li><a href="{{ route('admin.desa.index') }}"><i class="bi bi-houses-fill"></i><span>Desa</span></a></li>
            <li><a href="{{ route('admin.wisata.index') }}" class="active"><i class="bi bi-image-fill"></i><span>Wisata Desa</span></a></li>
            <li><a href="{{ route('admin.pasar.index') }}"><i class="bi bi-shop"></i><span>Pasar Desa</span></a></li>
            <li><a href="{{ route('admin.kantor.index') }}"><i class="bi bi-building"></i><span>Kantor Desa</span></a></li>
            <li><a href="{{ route('admin.wifi.index') }}"><i class="bi bi-wifi"></i><span>WiFi Desa</span></a></li>
            <li><a href="{{ route('admin.bumdes.index') }}"><i class="bi bi-briefcase-fill"></i><span>BUMDes</span></a></li>
            <li><a href="{{ route('admin.kkdmp.index') }}"><i class="bi bi-people-fill"></i><span>KKDMP</span></a></li>
        </ul>
    </aside>

    <div class="admin-main">
        <header class="admin-topbar">
            <div class="admin-breadcrumb">Admin <span aria-hidden="true">/</span> <strong>Wisata Desa</strong></div>
            <div class="admin-user">{{ auth()->user()->name ?? 'Administrator' }}</div>
        </header>

        <main class="admin-content">
            @if(session('success'))
            <div class="admin-alert">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" aria-label="Tutup notifikasi" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <div class="admin-page-heading">
                <p class="admin-eyebrow">Data Wisata Desa</p>
                <h1>Wisata Desa</h1>
                <p class="admin-page-subtitle">Kelola data wisata desa Kabupaten Tuban.</p>
            </div>

            <section class="admin-list-panel" aria-label="Daftar wisata desa">
                <div class="admin-list-toolbar">
                    <div class="admin-list-title">
                        <i class="bi bi-list-ul"></i>
                        Daftar Wisata
                        <span class="admin-count">{{ number_format($wisatas->total()) }} Titik</span>
                    </div>
                    <div class="admin-list-actions">
                        <form method="GET" action="{{ route('admin.wisata.index') }}" style="margin: 0">
                            <label class="admin-search-wrap" for="searchInput">
                                <i class="bi bi-search" aria-hidden="true"></i>
                                <input class="admin-search" type="search" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari nama wisata...">
                            </label>
                            <button class="visually-hidden" type="submit">Cari</button>
                        </form>
                        <button type="button" class="admin-primary-btn" onclick="openTambahModal()">
                            <i class="bi bi-plus-lg"></i> Tambah Wisata
                        </button>
                    </div>
                </div>

                <div class="admin-table-wrap">
                    <table class="admin-table admin-table--wisata">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA WISATA</th>
                                <th>DESA</th>
                            </tr>
                        </thead>
                        <tbody id="wisataTable">
                            @forelse($wisatas as $index => $wisata)
                            @php
                                $props = [];
                                if (!empty($wisata->properties)) {
                                    if (is_string($wisata->properties)) {
                                        $props = json_decode($wisata->properties, true) ?: [];
                                    } elseif (is_array($wisata->properties)) {
                                        $props = $wisata->properties;
                                    }
                                }
                                $jenis = $props['jenis'] ?? $props['Jenis'] ?? $props['jenis_wisata'] ?? '';
                                $htm = $props['htm'] ?? $props['HTM'] ?? $props['Harga'] ?? $props['htm_wisata'] ?? '';
                                $jam = $props['jam_operasional'] ?? $props['Jam'] ?? $props['Jam Operasional'] ?? $props['jam'] ?? '';
                                $deskripsi = $props['deskripsi'] ?? $props['Deskripsi'] ?? '';
                                $reservasi = $props['reservasi'] ?? $props['Reservasi'] ?? $props['kontak'] ?? '';
                                $desa = $props['desa'] ?? $props['Desa'] ?? $props['nama_desa'] ?? '-';
                                $foto = $props['foto'] ?? $props['Foto'] ?? $props['image'] ?? '';
                            @endphp
                            <tr data-id="{{ $wisata->id }}">
                                <td class="admin-row-number">{{ $wisatas->firstItem() + $index }}</td>
                                <td>
                                    <a class="wisata-link admin-place-name" onclick="openDetailModal({{ $wisata->id }}, '{{ addslashes($wisata->nama_lokasi ?? $wisata->nama ?? '') }}', '{{ addslashes($desa) }}', '{{ addslashes($jenis) }}', '{{ addslashes($deskripsi) }}', '{{ addslashes($jam) }}', '{{ addslashes($htm) }}', '{{ addslashes($reservasi) }}', '{{ $wisata->latitude ?? '' }}', '{{ $wisata->longitude ?? '' }}', '{{ addslashes($foto) }}')">
                                        <span class="admin-place-icon"><i class="bi bi-image-fill"></i></span>
                                        {{ $wisata->nama_lokasi ?? $wisata->nama ?? '-' }}
                                    </a>
                                </td>
                                <td>{{ $desa }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td class="admin-empty" colspan="3">
                                    <div>
                                        <i class="bi bi-inbox"></i>
                                        Belum ada data wisata
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @include('admin.partials.pagination', ['paginator' => $wisatas])
            </section>
        </main>
    </div>

    <!-- Modal Detail Wisata -->
    <div class="modal fade modal-detail" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-image-fill"></i> Detail Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-foto-container" id="detailFotoContainer">
                        <div class="detail-foto-placeholder">
                            <i class="bi bi-image"></i>
                            <p>Tidak ada foto</p>
                        </div>
                    </div>
                    <div class="detail-info">
                        <h2 class="detail-nama" id="detailNama">-</h2>
                        <div class="detail-desa">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span id="detailDesa">-</span>
                        </div>
                        
                        <div class="detail-grid">
                            <div class="detail-item">
                                <div class="detail-item-label">Jenis Wisata</div>
                                <div class="detail-item-value" id="detailJenis">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-item-label">HTM</div>
                                <div class="detail-item-value" id="detailHtm">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-item-label">Jam Operasional</div>
                                <div class="detail-item-value" id="detailJam">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-item-label">Reservasi</div>
                                <div class="detail-item-value" id="detailReservasi">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-item-label">Latitude</div>
                                <div class="detail-item-value" id="detailLat" style="font-family: monospace;">-</div>
                            </div>
                            <div class="detail-item">
                                <div class="detail-item-label">Longitude</div>
                                <div class="detail-item-value" id="detailLng" style="font-family: monospace;">-</div>
                            </div>
                        </div>

                        <div class="detail-deskripsi" id="detailDeskripsiContainer" style="display: none;">
                            <div class="detail-deskripsi-label">Deskripsi</div>
                            <div id="detailDeskripsi"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tutup</button>
                    <button type="button" class="btn-modal-delete" id="btnHapusDetail" onclick="hapusDariDetail()"><i class="bi bi-trash"></i> Hapus</button>
                    <button type="button" class="btn-modal-edit" id="btnEditDetail" onclick="editDariDetail()"><i class="bi bi-pencil"></i> Edit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit -->
    <div class="modal fade modal-form" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle"><i class="bi bi-plus-circle"></i> Tambah Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formWisata" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="wisataId" name="id">
                    <div class="modal-body">
                        <div class="section-divider">Informasi Dasar</div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Nama Wisata <span class="required">*</span></label>
                                <input type="text" id="namaWisata" name="nama_lokasi" class="form-input-custom" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Desa</label>
                                <input type="text" id="desaWisata" name="desa" class="form-input-custom" placeholder="Nama desa">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Jenis Wisata</label>
                                <input type="text" id="jenisWisata" name="jenis_wisata" class="form-input-custom" placeholder="Contoh: Alam, Budaya">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">HTM</label>
                                <input type="text" id="htm" name="htm" class="form-input-custom" placeholder="Contoh: Rp 15.000">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Jam Operasional</label>
                                <input type="text" id="jamOperasional" name="jam_operasional" class="form-input-custom" placeholder="Contoh: 08.00 - 17.00">
                            </div>
                        </div>

                        <div class="section-divider">Lokasi & Kontak</div>
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
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label-custom">Reservasi / Kontak</label>
                                <input type="text" id="reservasi" name="reservasi" class="form-input-custom" placeholder="No WA / Link">
                            </div>
                        </div>

                        <div class="section-divider">Deskripsi & Foto</div>
                        <div class="mb-3">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea id="deskripsi" name="deskripsi" class="form-textarea-custom" placeholder="Deskripsi singkat tentang wisata"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Foto Wisata</label>
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
        let modalForm, modalDetail;
        let currentWisataId = null;
        let currentWisataData = null;

        document.addEventListener('DOMContentLoaded', function() {
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
            
            document.getElementById('formWisata').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#wisataTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
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

        function openDetailModal(id, nama, desa, jenis, deskripsi, jam, htm, reservasi, latitude, longitude, foto) {
            currentWisataId = id;
            currentWisataData = { nama, desa, jenis, deskripsi, jam, htm, reservasi, latitude, longitude, foto };

            document.getElementById('detailNama').textContent = nama || '-';
            document.getElementById('detailDesa').textContent = desa || '-';
            document.getElementById('detailJenis').textContent = jenis || '-';
            document.getElementById('detailHtm').textContent = htm || '-';
            document.getElementById('detailJam').textContent = jam || '-';
            document.getElementById('detailReservasi').textContent = reservasi || '-';
            document.getElementById('detailLat').textContent = latitude || '-';
            document.getElementById('detailLng').textContent = longitude || '-';

            const fotoContainer = document.getElementById('detailFotoContainer');
            if (foto && foto.trim() !== '') {
                fotoContainer.innerHTML = `<img src="${foto}" alt="${nama}" onerror="this.parentElement.innerHTML='<div class=\\'detail-foto-placeholder\\'><i class=\\'bi bi-image\\'></i><p>Gagal memuat foto</p></div>'">`;
            } else {
                fotoContainer.innerHTML = '<div class="detail-foto-placeholder"><i class="bi bi-image"></i><p>Tidak ada foto</p></div>';
            }

            const deskContainer = document.getElementById('detailDeskripsiContainer');
            if (deskripsi && deskripsi.trim() !== '') {
                document.getElementById('detailDeskripsi').textContent = deskripsi;
                deskContainer.style.display = 'block';
            } else {
                deskContainer.style.display = 'none';
            }

            modalDetail.show();
        }

        function editDariDetail() {
            modalDetail.hide();
            setTimeout(() => {
                const d = currentWisataData;
                openEditModal(currentWisataId, d.nama, d.desa, d.jenis, d.deskripsi, d.jam, d.htm, d.reservasi, d.latitude, d.longitude, d.foto);
            }, 300);
        }

        function hapusDariDetail() {
            const nama = currentWisataData?.nama || '';
            if (confirm(`Yakin ingin menghapus wisata "${nama}"?`)) {
                fetch(`/admin/wisata/${currentWisataId}`, {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                        'Accept': 'application/json' 
                    },
                    body: new URLSearchParams({ '_method': 'DELETE' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        modalDetail.hide();
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal menghapus data');
                    }
                })
                .catch(error => { console.error('Error:', error); alert('Gagal menghapus data'); });
            }
        }

        function openTambahModal() {
            currentWisataId = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Wisata';
            document.getElementById('formWisata').reset();
            document.getElementById('wisataId').value = '';
            document.getElementById('fotoPreview').classList.remove('active');
            modalForm.show();
        }

        function openEditModal(id, nama, desa, jenis, deskripsi, jam, htm, reservasi, latitude, longitude, foto) {
            currentWisataId = id;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Wisata';
            document.getElementById('wisataId').value = id;
            document.getElementById('namaWisata').value = nama || '';
            document.getElementById('desaWisata').value = desa || '';
            document.getElementById('jenisWisata').value = jenis || '';
            document.getElementById('deskripsi').value = deskripsi || '';
            document.getElementById('jamOperasional').value = jam || '';
            document.getElementById('htm').value = htm || '';
            document.getElementById('reservasi').value = reservasi || '';
            document.getElementById('latitude').value = latitude || '';
            document.getElementById('longitude').value = longitude || '';
            
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

        function hapusWisata(id, nama) {
            if (confirm(`Yakin ingin menghapus wisata "${nama}"?`)) {
                fetch(`/admin/wisata/${id}`, {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                        'Accept': 'application/json' 
                    },
                    body: new URLSearchParams({ '_method': 'DELETE' })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) location.reload();
                    else alert(data.message || 'Gagal menghapus data');
                })
                .catch(error => { console.error('Error:', error); alert('Gagal menghapus data'); });
            }
        }

        function submitForm() {
            const formData = new FormData(document.getElementById('formWisata'));
            const id = document.getElementById('wisataId').value;
            const url = id ? `/admin/wisata/${id}` : '/admin/wisata';
            
            if (id) formData.append('_method', 'PUT');

            fetch(url, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    modalForm.hide();
                    location.reload();
                } else {
                    let errorMsg = 'Gagal menyimpan data';
                    if (data.errors) errorMsg = Object.values(data.errors).flat().join('\n');
                    else if (data.message) errorMsg = data.message;
                    alert('Error: ' + errorMsg);
                }
            })
            .catch(error => { console.error('Error:', error); alert('Terjadi kesalahan'); });
        }
    </script>
</body>
</html>