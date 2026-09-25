<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Desa - Portal Desa Digital</title>
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
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-title i { color: #1e3a8a; font-size: 26px; }
        .page-subtitle { color: #64748b; font-size: 14px; margin-bottom: 24px; }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-left: 4px solid #1e3a8a;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            flex-shrink: 0;
        }
        
        .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .stat-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
        
        .stat-info h3 { font-size: 24px; font-weight: 800; color: #1e293b; margin: 0; line-height: 1; }
        .stat-info p { font-size: 11px; color: #64748b; margin: 4px 0 0 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
        
        .search-bar {
            background: white;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 18px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .search-box { position: relative; }
        .search-box input {
            width: 100%;
            padding: 10px 14px 10px 40px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
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
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
        }
        
        .table-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .table-header {
            padding: 16px 20px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .table-title {
            font-size: 14px;
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
            padding: 3px 10px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .btn-action-header {
            color: white;
            border: none;
            padding: 9px 16px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .btn-import { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
        .btn-import:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3); color: white; }
        
        .btn-add { background: linear-gradient(135deg, #14b8a6, #0f766e); }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3); color: white; }
        
        .table-simple { width: 100%; border-collapse: collapse; }
        .table-simple thead { background: #f8fafc; }
        
        .table-simple th {
            padding: 12px 20px;
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .table-simple td {
            padding: 14px 20px;
            font-size: 14px;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .table-simple tbody tr:last-child td { border-bottom: none; }
        .table-simple tbody tr { cursor: pointer; transition: all 0.2s; }
        .table-simple tbody tr:hover { background: #f1f5f9; }
        
        .desa-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .desa-name-icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            background: #dbeafe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e40af;
            font-size: 14px;
            flex-shrink: 0;
        }
        
        .badge-jenis {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
        }
        
        .badge-desa { background: #dbeafe; color: #1e40af; }
        .badge-kelurahan { background: #fef3c7; color: #92400e; }
        
        .alert-banner {
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            animation: slideDown 0.3s ease-out;
            box-shadow: 0 2px 8px rgba(22, 101, 52, 0.08);
        }
        
        .alert-banner i { font-size: 18px; color: #16a34a; }
        
        .alert-banner .close-btn {
            margin-left: auto;
            background: none;
            border: none;
            color: #166534;
            cursor: pointer;
            font-size: 16px;
            padding: 0 4px;
            opacity: 0.6;
            transition: opacity 0.2s;
        }
        
        .alert-banner .close-btn:hover { opacity: 1; }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .empty-state { text-align: center; padding: 40px; color: #94a3b8; }
        .empty-state i { font-size: 32px; display: block; margin-bottom: 10px; }
        
        /* Modal Styles */
        .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 18px 22px;
            border: none;
        }
        .modal-header .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-body { padding: 24px 22px; max-height: 70vh; overflow-y: auto; }
        .modal-footer { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px; }
        
        .detail-row {
            display: flex;
            margin-bottom: 14px;
            padding-bottom: 14px;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-row:last-child { border-bottom: none; }
        
        .detail-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 130px;
            flex-shrink: 0;
        }
        
        .detail-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 600;
        }
        
        .detail-value a {
            color: #1e40af;
            text-decoration: none;
        }
        
        .detail-value a:hover {
            text-decoration: underline;
        }
        
        .social-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 8px;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            color: white;
            transition: all 0.2s;
        }
        
        .social-link:hover { transform: translateY(-1px); }
        .social-link.website { background: #3b82f6; }
        .social-link.youtube { background: #ef4444; }
        .social-link.instagram { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-link.facebook { background: #1877f2; }
        .social-link.tiktok { background: #000000; }
        .social-link.whatsapp { background: #25d366; }
        
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom, .form-select-custom {
            width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s;
        }
        .form-input-custom:focus, .form-select-custom:focus {
            outline: none; border-color: #3b82f6; background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }
        
        .btn-modal-cancel {
            background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 9px 18px;
            border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-cancel:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        
        .btn-modal-save {
            background: linear-gradient(135deg, #10b981, #059669); color: white; border: none;
            padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35); color: white; }
        
        .btn-modal-delete {
            background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none;
            padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
            margin-right: auto;
        }
        .btn-modal-delete:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.35); color: white; }
        
        .section-divider {
            font-size: 11px;
            font-weight: 700;
            color: #1e3a8a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 16px 0 10px 0;
            padding-bottom: 6px;
            border-bottom: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item active">Data Desa</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        @if(session('success'))
        <div class="alert-banner">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button class="close-btn" onclick="this.parentElement.style.display='none'">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        <h1 class="page-title">
            <i class="bi bi-houses-fill"></i>
            Data Desa/Kelurahan
        </h1>
        <p class="page-subtitle">Kelola data desa dan kelurahan di Kabupaten Tuban</p>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="bi bi-houses-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalDesa ?? 0 }}</h3>
                    <p>TOTAL DESA</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalKecamatan ?? 0 }}</h3>
                    <p>TOTAL KECAMATAN</p>
                </div>
            </div>
        </div>

        <div class="search-bar">
            <div class="search-box">
                <i class="bi bi-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama desa...">
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <div class="table-title">
                    <i class="bi bi-list-ul"></i>
                    Daftar Desa
                    <span class="badge-count">{{ $desas->count() }} Desa</span>
                </div>
                <div>
                    <button type="button" class="btn-action-header btn-import" onclick="openImportModal()">
                        <i class="bi bi-file-earmark-excel"></i>
                        Import Excel
                    </button>
                    <button type="button" class="btn-action-header btn-add" onclick="openTambahModal()" style="margin-left: 8px;">
                        <i class="bi bi-plus-lg"></i>
                        Tambah
                    </button>
                </div>
            </div>

            <table class="table-simple">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th>NAMA DESA</th>
                        <th>KECAMATAN</th>
                        <th>JENIS</th>
                        <th>KODE DESA</th>
                    </tr>
                </thead>
                <tbody id="desaTable">
                    @forelse($desas as $index => $desa)
                    <tr data-id="{{ $desa->id }}" onclick="showDetail({{ $desa->id }}, '{{ addslashes($desa->nama_desa) }}', '{{ addslashes($desa->kecamatan->nama_kecamatan ?? '-') }}', '{{ $desa->kode_desa ?? '-' }}', '{{ $desa->jenis ?? 'Desa' }}', '{{ addslashes($desa->website ?? '') }}', '{{ addslashes($desa->youtube ?? '') }}', '{{ addslashes($desa->instagram ?? '') }}', '{{ addslashes($desa->facebook ?? '') }}', '{{ addslashes($desa->tiktok ?? '') }}', '{{ addslashes($desa->whatsapp ?? '') }}')">
                        <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <div class="desa-name">
                                <div class="desa-name-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                {{ $desa->nama_desa }}
                            </div>
                        </td>
                        <td>{{ $desa->kecamatan->nama_kecamatan ?? '-' }}</td>
                        <td>
                            <span class="badge-jenis {{ ($desa->jenis ?? 'Desa') === 'Kelurahan' ? 'badge-kelurahan' : 'badge-desa' }}">
                                {{ $desa->jenis ?? 'Desa' }}
                            </span>
                        </td>
                        <td>{{ $desa->kode_desa ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                Belum ada data desa
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Detail Desa -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-houses-fill"></i>
                        <span id="detailNamaDesa">Detail Desa</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-row">
                        <div class="detail-label">Nama Desa</div>
                        <div class="detail-value" id="detailNama"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Kecamatan</div>
                        <div class="detail-value" id="detailKecamatan"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Jenis</div>
                        <div class="detail-value" id="detailJenis"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Kode Desa</div>
                        <div class="detail-value" id="detailKodeDesa"></div>
                    </div>
                    <div class="detail-row" style="flex-direction: column; align-items: flex-start;">
                        <div class="detail-label" style="margin-bottom: 8px;">Sosial Media & Website</div>
                        <div class="detail-value" id="detailSosialMedia" style="width: 100%;">
                            <span style="color: #94a3b8;">Tidak ada data</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Tutup
                    </button>
                    <button type="button" class="btn-modal-save" onclick="openEditFromDetail()">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Desa -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Desa
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formDesa">
                    @csrf
                    <input type="hidden" id="desaId" name="id">
                    <div class="modal-body">
                        <div class="section-divider">Informasi Dasar</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">
                                    Kecamatan <span class="required">*</span>
                                </label>
                                <select id="kecamatanId" name="kecamatan_id" class="form-select-custom" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach(\App\Models\Kecamatan::orderBy('nama_kecamatan')->get() as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">
                                    Nama Desa/Kelurahan <span class="required">*</span>
                                </label>
                                <input type="text" id="namaDesa" name="nama_desa" class="form-input-custom" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Kode Desa</label>
                                <input type="text" id="kodeDesa" name="kode_desa" class="form-input-custom" placeholder="Contoh: 3523010001">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">
                                    Jenis <span class="required">*</span>
                                </label>
                                <select id="jenis" name="jenis" class="form-select-custom" required>
                                    <option value="Desa">Desa</option>
                                    <option value="Kelurahan">Kelurahan</option>
                                </select>
                            </div>
                        </div>

                        <div class="section-divider">Website & Sosial Media</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Website</label>
                                <input type="url" id="website" name="website" class="form-input-custom" placeholder="https://desa.go.id">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">YouTube</label>
                                <input type="text" id="youtube" name="youtube" class="form-input-custom" placeholder="Link channel YouTube">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Instagram</label>
                                <input type="text" id="instagram" name="instagram" class="form-input-custom" placeholder="@username atau link">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Facebook</label>
                                <input type="text" id="facebook" name="facebook" class="form-input-custom" placeholder="Link halaman Facebook">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">TikTok</label>
                                <input type="text" id="tiktok" name="tiktok" class="form-input-custom" placeholder="@username atau link">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">WhatsApp</label>
                                <input type="text" id="whatsapp" name="whatsapp" class="form-input-custom" placeholder="081234567890">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="button" id="btnHapusDesa" class="btn-modal-delete" onclick="hapusDariModal()" style="display: none;">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                        <button type="submit" class="btn-modal-save">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Import Excel -->
    <div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-excel"></i>
                        Import Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formImport" action="{{ route('admin.desa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">Pilih File Excel</label>
                            <input type="file" name="file" class="form-input-custom" accept=".xlsx,.xls" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-save">
                            <i class="bi bi-upload"></i> Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalDetail, modalForm, modalImport;
        let currentDesaId = null;

        document.addEventListener('DOMContentLoaded', function() {
            modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            modalImport = new bootstrap.Modal(document.getElementById('modalImport'));
            
            document.getElementById('formDesa').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#desaTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });

        function openImportModal() {
            modalImport.show();
        }

        function openTambahModal() {
            currentDesaId = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Desa';
            document.getElementById('formDesa').reset();
            document.getElementById('desaId').value = '';
            document.getElementById('jenis').value = 'Desa';
            document.getElementById('btnHapusDesa').style.display = 'none';
            modalForm.show();
        }

        function openEditModal(id, nama, kecamatanId, kodeDesa, jenis, website, youtube, instagram, facebook, tiktok, whatsapp) {
            currentDesaId = id;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Desa';
            document.getElementById('desaId').value = id;
            document.getElementById('namaDesa').value = nama;
            document.getElementById('kecamatanId').value = kecamatanId || '';
            document.getElementById('kodeDesa').value = kodeDesa || '';
            document.getElementById('jenis').value = jenis || 'Desa';
            document.getElementById('website').value = website || '';
            document.getElementById('youtube').value = youtube || '';
            document.getElementById('instagram').value = instagram || '';
            document.getElementById('facebook').value = facebook || '';
            document.getElementById('tiktok').value = tiktok || '';
            document.getElementById('whatsapp').value = whatsapp || '';
            document.getElementById('btnHapusDesa').style.display = 'inline-flex';
            modalForm.show();
        }

        function openEditFromDetail() {
            modalDetail.hide();
            setTimeout(() => {
                const nama = document.getElementById('detailNama').textContent;
                const kecamatan = document.getElementById('detailKecamatan').textContent;
                const kodeDesa = document.getElementById('detailKodeDesa').textContent;
                const jenis = document.getElementById('detailJenis').textContent;
                const sosialMedia = document.getElementById('detailSosialMedia');
                
                openEditModal(
                    currentDesaId, 
                    nama, 
                    null, 
                    kodeDesa, 
                    jenis, 
                    sosialMedia.dataset.website || '',
                    sosialMedia.dataset.youtube || '',
                    sosialMedia.dataset.instagram || '',
                    sosialMedia.dataset.facebook || '',
                    sosialMedia.dataset.tiktok || '',
                    sosialMedia.dataset.whatsapp || ''
                );
            }, 300);
        }

        function showDetail(id, nama, kecamatan, kodeDesa, jenis, website, youtube, instagram, facebook, tiktok, whatsapp) {
            currentDesaId = id;
            document.getElementById('detailNamaDesa').textContent = nama;
            document.getElementById('detailNama').textContent = nama;
            document.getElementById('detailKecamatan').textContent = kecamatan;
            document.getElementById('detailKodeDesa').textContent = kodeDesa;
            document.getElementById('detailJenis').innerHTML = `<span class="badge-jenis ${jenis === 'Kelurahan' ? 'badge-kelurahan' : 'badge-desa'}">${jenis}</span>`;
            
            // Build social media links
            let socialHtml = '';
            if (website) socialHtml += `<a href="${website}" target="_blank" class="social-link website"><i class="bi bi-globe"></i> Website</a>`;
            if (youtube) socialHtml += `<a href="${youtube}" target="_blank" class="social-link youtube"><i class="bi bi-youtube"></i> YouTube</a>`;
            if (instagram) socialHtml += `<a href="${instagram}" target="_blank" class="social-link instagram"><i class="bi bi-instagram"></i> Instagram</a>`;
            if (facebook) socialHtml += `<a href="${facebook}" target="_blank" class="social-link facebook"><i class="bi bi-facebook"></i> Facebook</a>`;
            if (tiktok) socialHtml += `<a href="${tiktok}" target="_blank" class="social-link tiktok"><i class="bi bi-tiktok"></i> TikTok</a>`;
            if (whatsapp) socialHtml += `<a href="https://wa.me/${whatsapp.replace(/\D/g,'')}" target="_blank" class="social-link whatsapp"><i class="bi bi-whatsapp"></i> WhatsApp</a>`;
            
            const sosialEl = document.getElementById('detailSosialMedia');
            sosialEl.innerHTML = socialHtml || '<span style="color: #94a3b8;">Tidak ada data</span>';
            sosialEl.dataset.website = website;
            sosialEl.dataset.youtube = youtube;
            sosialEl.dataset.instagram = instagram;
            sosialEl.dataset.facebook = facebook;
            sosialEl.dataset.tiktok = tiktok;
            sosialEl.dataset.whatsapp = whatsapp;
            
            modalDetail.show();
        }

        function hapusDariModal() {
            const id = document.getElementById('desaId').value;
            const nama = document.getElementById('namaDesa').value;
            
            if (confirm(`Yakin ingin menghapus desa "${nama}"?`)) {
                fetch(`/admin/desa/${id}`, {
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
                        modalForm.hide();
                        sessionStorage.setItem('desaNotif', 'Data desa berhasil dihapus!');
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal menghapus data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal menghapus data');
                });
            }
        }

        function submitForm() {
            const formData = new FormData(document.getElementById('formDesa'));
            const id = document.getElementById('desaId').value;
            const url = id ? `/admin/desa/${id}` : '/admin/desa';
            
            if (id) {
                formData.append('_method', 'PUT');
            }

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
                    const pesan = id ? 'Data desa berhasil diperbarui!' : 'Data desa berhasil ditambahkan!';
                    sessionStorage.setItem('desaNotif', pesan);
                    location.reload();
                } else {
                    let errorMsg = 'Gagal menyimpan data';
                    if (data.errors) {
                        errorMsg = Object.values(data.errors).flat().join('\n');
                    } else if (data.message) {
                        errorMsg = data.message;
                    }
                    alert('Error: ' + errorMsg);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data');
            });
        }
    </script>
</body>
</html>