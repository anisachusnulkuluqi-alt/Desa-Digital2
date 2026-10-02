<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Desa - Portal Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
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
        .stats-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; margin-bottom: 22px; }
        .stat-card { background: white; border-radius: 10px; padding: 16px 20px; display: flex; align-items: center; gap: 16px; border-left: 4px solid #1e3a8a; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .stat-icon { width: 44px; height: 44px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; color: white; flex-shrink: 0; }
        .stat-icon.blue { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .stat-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
        .stat-info h3 { font-size: 24px; font-weight: 800; color: #1e293b; margin: 0; line-height: 1; }
        .stat-info p { font-size: 11px; color: #64748b; margin: 4px 0 0 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.4px; }
        .search-bar { background: white; border-radius: 10px; padding: 14px 18px; margin-bottom: 18px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .search-box { position: relative; }
        .search-box input { width: 100%; padding: 10px 14px 10px 40px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.2s; }
        .search-box input:focus { outline: none; border-color: #1e3a8a; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .search-box i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 15px; }
        
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
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            border-radius: 12px 12px 0 0;
            padding: 18px 22px;
            border: none;
        }
        .modal-header .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-body { padding: 24px 22px; max-height: 70vh; overflow-y: auto; }
        .modal-footer { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px; }
        .edit-form-grid, .edit-social-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .edit-section-title { margin: 18px 0 12px; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; color: #1e3a8a; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .edit-social-field { min-width: 0; }
        .edit-social-field .form-label-custom { margin-top: 10px; }
        .edit-error { margin-bottom: 16px; }
        .form-input-custom.static-field, .form-input-custom.static-field:focus { border-color: #d1d5db; background: #e5e7eb; color: #9ca3af; box-shadow: none; cursor: not-allowed; }
        .form-select-custom.static-field:disabled { border-color: #e2e8f0; background-color: #f1f3f5; color: #94a3b8; opacity: 1; cursor: not-allowed; }
        .form-label-custom[for="editNamaDesa"], .form-label-custom[for="editKodeDesa"], .form-label-custom[for="editKecamatan"] { color: #94a3b8; }
        @media (max-width: 768px) { .edit-form-grid, .edit-social-grid { grid-template-columns: 1fr; } }
        
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
            background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; border: none;
            padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
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
    @include('admin.partials.list-page-styles')
</head>
<body>
    @include('admin.partials.sidebar', ['activeMenu' => 'desa'])
    <div class="admin-main">
        <header class="admin-topbar">
            <div class="admin-breadcrumb">Admin <span aria-hidden="true">/</span> <strong>Desa</strong></div>
            <div class="admin-user">{{ auth()->user()->name ?? 'Administrator' }}</div>
        </header>
        <main class="admin-content">
        @if(session('success'))
        <div class="admin-alert">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
            <button type="button" aria-label="Tutup notifikasi" onclick="this.parentElement.style.display='none'">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        @endif

        <div class="admin-page-heading">
            <p class="admin-eyebrow">Data Wilayah</p>
            <h1>Desa</h1>
            <p class="admin-page-subtitle">Kelola data desa di Kabupaten Tuban.</p>
        </div>

        <section class="admin-list-panel" aria-label="Daftar desa">
            <div class="admin-list-toolbar">
                <div class="admin-list-title">
                    <i class="bi bi-list-ul"></i>
                    Daftar Desa
                    <span class="admin-count">{{ number_format($totalDesa ?? $desas->count()) }} Data</span>
                </div>
                <div class="admin-list-actions">
                    <form method="GET" action="{{ route('admin.desa.index') }}" style="margin: 0">
                        <label class="admin-search-wrap" for="searchInput">
                            <i class="bi bi-search" aria-hidden="true"></i>
                            <input class="admin-search" type="search" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari nama desa...">
                        </label>
                        <button class="visually-hidden" type="submit">Cari</button>
                    </form>
                </div>
            </div>

            <div class="admin-table-wrap">
            <table class="admin-table">
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
                    <tr tabindex="0" role="button" data-id="{{ $desa->id }}" onclick="showDetail({{ $desa->id }}, '{{ addslashes($desa->nama_desa) }}', '{{ addslashes($desa->kecamatan->nama_kecamatan ?? '-') }}', '{{ $desa->kode_desa ?? '-' }}', '{{ $desa->jenis ?? 'Desa' }}', '{{ addslashes($desa->website ?? '') }}', '{{ addslashes($desa->youtube ?? '') }}', '{{ addslashes($desa->instagram ?? '') }}', '{{ addslashes($desa->facebook ?? '') }}', '{{ addslashes($desa->tiktok ?? '') }}', '{{ addslashes($desa->whatsapp ?? '') }}', {{ $desa->kecamatan_id }})" onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); this.click(); }">
                        <td class="admin-row-number">{{ $desas->firstItem() + $index }}</td>
                        <td>
                            <div class="admin-place-name">
                                <span class="admin-place-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>
                                {{ $desa->nama_desa }}
                            </div>
                        </td>
                        <td>{{ $desa->kecamatan->nama_kecamatan ?? '-' }}</td>
                        <td>
                            <span class="admin-kind {{ ($desa->jenis ?? 'Desa') === 'Kelurahan' ? 'is-kelurahan' : '' }}">
                                {{ $desa->jenis ?? 'Desa' }}
                            </span>
                        </td>
                        <td>{{ $desa->kode_desa ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td class="admin-empty" colspan="5">
                            <div>
                                <i class="bi bi-inbox"></i>
                                Belum ada data desa
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                </table>
                </div>
                @include('admin.partials.pagination', ['paginator' => $desas])
            </section>
        </main>
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
                    <button type="button" class="btn-modal-save" onclick="editSelectedDesa()">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditDesa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="formEditDesa" method="POST" onsubmit="submitEditDesa(event)">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Data Desa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger edit-error" id="editDesaError" role="alert" hidden></div>
                        <div class="edit-form-grid">
                            <div>
                                <label class="form-label-custom" for="editNamaDesa">Nama Desa/Kelurahan <span class="required">*</span></label>
                                <input class="form-input-custom static-field" id="editNamaDesa" name="nama_desa" type="text" maxlength="255" readonly required>
                            </div>
                            <div>
                                <label class="form-label-custom" for="editKodeDesa">Kode Desa <span class="required">*</span></label>
                                <input class="form-input-custom static-field" id="editKodeDesa" name="kode_desa" type="text" maxlength="20" readonly required>
                            </div>
                            <div>
                                <label class="form-label-custom" for="editKecamatan">Kecamatan <span class="required">*</span></label>
                                <select class="form-select-custom static-field" id="editKecamatan" disabled required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach($kecamatans as $kecamatan)
                                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                                <input id="editKecamatanValue" name="kecamatan_id" type="hidden">
                            </div>
                            <div>
                                <label class="form-label-custom" for="editJenis">Jenis <span class="required">*</span></label>
                                <select class="form-select-custom" id="editJenis" name="jenis" required>
                                    <option value="Desa">Desa</option>
                                    <option value="Kelurahan">Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        <div class="edit-section-title">Media Sosial & Website</div>
                        <div class="edit-social-grid">
                            <div class="edit-social-field">
                                <label class="form-label-custom" for="editWebsite">Website</label>
                                <input class="form-input-custom" id="editWebsite" name="website" type="url" maxlength="255" placeholder="https://">
                            </div>
                            <div class="edit-social-field">
                                <label class="form-label-custom" for="editYoutube">YouTube</label>
                                <input class="form-input-custom" id="editYoutube" name="youtube" type="url" maxlength="255" placeholder="https://youtube.com/">
                            </div>
                            <div class="edit-social-field">
                                <label class="form-label-custom" for="editInstagram">Instagram</label>
                                <input class="form-input-custom" id="editInstagram" name="instagram" type="text" maxlength="255" placeholder="https://instagram.com/">
                            </div>
                            <div class="edit-social-field">
                                <label class="form-label-custom" for="editFacebook">Facebook</label>
                                <input class="form-input-custom" id="editFacebook" name="facebook" type="url" maxlength="255" placeholder="https://facebook.com/">
                            </div>
                            <div class="edit-social-field">
                                <label class="form-label-custom" for="editTiktok">TikTok</label>
                                <input class="form-input-custom" id="editTiktok" name="tiktok" type="text" maxlength="255" placeholder="https://tiktok.com/">
                            </div>
                            <div class="edit-social-field">
                                <label class="form-label-custom" for="editWhatsapp">WhatsApp</label>
                                <input class="form-input-custom" id="editWhatsapp" name="whatsapp" type="text" maxlength="50" placeholder="08xxxxxxxxxx">
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
        let modalDetail, modalEditDesa;
        let selectedDesa = null;
        const desaUpdateUrl = @json(url('/admin/desa'));

        document.addEventListener('DOMContentLoaded', function() {
            modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
            modalEditDesa = new bootstrap.Modal(document.getElementById('modalEditDesa'));

            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#desaTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });

        function showDetail(id, nama, kecamatan, kodeDesa, jenis, website, youtube, instagram, facebook, tiktok, whatsapp, kecamatanId) {
            selectedDesa = { id, nama, kecamatan, kecamatanId, kodeDesa, jenis, website, youtube, instagram, facebook, tiktok, whatsapp };
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

        function editSelectedDesa() {
            if (!selectedDesa) return;

            document.getElementById('modalDetail').addEventListener('hidden.bs.modal', () => {
                openEditDesa(selectedDesa);
            }, { once: true });
            modalDetail.hide();
        }

        function openEditDesa(desa) {
            const form = document.getElementById('formEditDesa');
            form.reset();
            form.action = `${desaUpdateUrl}/${desa.id}`;
            document.getElementById('editDesaError').hidden = true;
            document.getElementById('editNamaDesa').value = desa.nama || '';
            document.getElementById('editKodeDesa').value = desa.kodeDesa === '-' ? '' : desa.kodeDesa;
            document.getElementById('editKecamatan').value = desa.kecamatanId || '';
            document.getElementById('editKecamatanValue').value = desa.kecamatanId || '';
            document.getElementById('editJenis').value = desa.jenis || 'Desa';
            document.getElementById('editWebsite').value = desa.website || '';
            document.getElementById('editYoutube').value = desa.youtube || '';
            document.getElementById('editInstagram').value = desa.instagram || '';
            document.getElementById('editFacebook').value = desa.facebook || '';
            document.getElementById('editTiktok').value = desa.tiktok || '';
            document.getElementById('editWhatsapp').value = desa.whatsapp || '';
            modalEditDesa.show();
        }

        async function submitEditDesa(event) {
            event.preventDefault();
            const form = event.currentTarget;
            const errorBox = document.getElementById('editDesaError');
            const formData = new FormData(form);
            const saveButton = form.querySelector('button[type="submit"]');
            saveButton.disabled = true;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                const result = await response.json();

                if (!response.ok) {
                    const messages = Object.values(result.errors || {}).flat();
                    errorBox.textContent = messages.join(' ') || result.message || 'Data desa gagal diperbarui.';
                    errorBox.hidden = false;
                    return;
                }

                location.reload();
            } catch (error) {
                errorBox.textContent = 'Terjadi kesalahan saat menyimpan data desa.';
                errorBox.hidden = false;
            } finally {
                saveButton.disabled = false;
            }
        }

    </script>
</body>
</html>