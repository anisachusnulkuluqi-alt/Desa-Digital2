<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>KKDMP - Portal Desa Digital</title>
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
        
        .kkdmp-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .kkdmp-name-icon {
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
        
        .detail-foto {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
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
        
        .current-foto-info {
            margin-top: 10px;
            padding: 10px;
            background: #f0f9ff;
            border-radius: 6px;
            font-size: 12px;
            color: #0369a1;
            border-left: 3px solid #0ea5e9;
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
                <li class="breadcrumb-item active">KKDMP</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        <div id="notifBanner" style="display: none;">
            <div class="alert-banner">
                <i class="bi bi-check-circle-fill"></i>
                <span id="notifText"></span>
                <button class="close-btn" onclick="closeNotif()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <h1 class="page-title">
            <i class="bi bi-people-fill"></i>
            KKDMP
        </h1>
        <p class="page-subtitle">Kelola data Kelompok Kerja Desa Mandiri Pangan di Kabupaten Tuban</p>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalKkdmp ?? 0 }}</h3>
                    <p>Total KKDMP</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalDesa ?? 0 }}</h3>
                    <p>Desa/Kelurahan</p>
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
                    Daftar KKDMP
                    <span class="badge-count">{{ $kkdmp->count() }} KKDMP</span>
                </div>
                <div>
                    <button type="button" class="btn-action-header btn-add" onclick="openTambahModal()">
                        <i class="bi bi-plus-lg"></i>
                        Tambah KKDMP
                    </button>
                </div>
            </div>

            <table class="table-simple">
                <thead>
                    <tr>
                        <th style="width: 60px;">NO</th>
                        <th>NAMA DESA</th>
                    </tr>
                </thead>
                <tbody id="kkdmpTable">
                    @forelse($kkdmp as $index => $item)
                    <tr data-id="{{ $item->id }}" onclick="showDetail({{ $item->id }}, '{{ addslashes($item->nama_desa ?? '-') }}', '{{ addslashes($item->jenis ?? '') }}', '{{ addslashes($item->nama_ketua ?? '') }}', '{{ addslashes($item->no_ahu ?? '') }}', '{{ addslashes($item->alamat ?? '') }}', '{{ $item->latitude ?? '' }}', '{{ $item->longitude ?? '' }}', '{{ $item->foto ?? '' }}')">
                        <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <div class="kkdmp-name">
                                <div class="kkdmp-name-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                {{ $item->nama_desa ?? '-' }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                Belum ada data KKDMP
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Detail KKDMP -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-people-fill"></i>
                        <span id="detailNamaKkdmp">Detail KKDMP</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-row">
                        <div class="detail-label">Nama Desa</div>
                        <div class="detail-value" id="detailNamaDesa"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Jenis</div>
                        <div class="detail-value" id="detailJenis"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Nama Ketua</div>
                        <div class="detail-value" id="detailKetua"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">No AHU</div>
                        <div class="detail-value" id="detailNoAhu"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Alamat</div>
                        <div class="detail-value" id="detailAlamat"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Koordinat</div>
                        <div class="detail-value" id="detailKoordinat"></div>
                    </div>
                    <div class="detail-row" style="flex-direction: column; align-items: flex-start;">
                        <div class="detail-label" style="margin-bottom: 8px;">Foto</div>
                        <div class="detail-value" id="detailFotoContainer" style="width: 100%;">
                            <span style="color: #94a3b8;">Tidak ada foto</span>
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

    <!-- Modal Tambah/Edit KKDMP -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle">
                        <i class="bi bi-plus-circle"></i>
                        Tambah KKDMP
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formKkdmp" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="kkdmpId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">
                                Nama Desa <span class="required">*</span>
                            </label>
                            <input type="text" id="namaDesa" name="nama_desa" class="form-input-custom" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Jenis</label>
                            <input type="text" id="jenis" name="jenis" class="form-input-custom">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Nama Ketua</label>
                            <input type="text" id="namaKetua" name="nama_ketua" class="form-input-custom">
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">No AHU</label>
                            <input type="text" id="noAhu" name="no_ahu" class="form-input-custom">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Alamat</label>
                            <textarea id="alamat" name="alamat" class="form-input-custom" rows="2"></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Latitude</label>
                                <input type="text" id="latitude" name="latitude" class="form-input-custom">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Longitude</label>
                                <input type="text" id="longitude" name="longitude" class="form-input-custom">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Foto</label>
                            <input type="file" id="foto" name="foto" class="form-input-custom" accept="image/*">
                            <div id="currentFoto"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="button" id="btnHapusKkdmp" class="btn-modal-delete" onclick="hapusDariModal()" style="display: none;">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalDetail, modalForm;
        let currentKkdmpId = null;
        let currentFotoPath = null;

        document.addEventListener('DOMContentLoaded', function() {
            modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            
            const notifMessage = sessionStorage.getItem('kkdmpNotif');
            if (notifMessage) {
                showNotif(notifMessage);
                sessionStorage.removeItem('kkdmpNotif');
            }
            
            document.getElementById('formKkdmp').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#kkdmpTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });

        function showNotif(message) {
            const banner = document.getElementById('notifBanner');
            const text = document.getElementById('notifText');
            text.textContent = message;
            banner.style.display = 'block';
            
            setTimeout(() => {
                closeNotif();
            }, 4000);
        }

        function closeNotif() {
            document.getElementById('notifBanner').style.display = 'none';
        }

        function openTambahModal() {
            currentKkdmpId = null;
            currentFotoPath = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah KKDMP';
            document.getElementById('formKkdmp').reset();
            document.getElementById('kkdmpId').value = '';
            document.getElementById('btnHapusKkdmp').style.display = 'none';
            document.getElementById('currentFoto').innerHTML = '';
            modalForm.show();
        }

        function openEditModal(id, namaDesa, jenis, ketua, noAhu, alamat, latitude, longitude, foto) {
            currentKkdmpId = id;
            currentFotoPath = foto;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit KKDMP';
            document.getElementById('kkdmpId').value = id;
            document.getElementById('namaDesa').value = namaDesa || '';
            document.getElementById('jenis').value = jenis || '';
            document.getElementById('namaKetua').value = ketua || '';
            document.getElementById('noAhu').value = noAhu || '';
            document.getElementById('alamat').value = alamat || '';
            document.getElementById('latitude').value = latitude || '';
            document.getElementById('longitude').value = longitude || '';
            document.getElementById('btnHapusKkdmp').style.display = 'inline-flex';
            
            if (foto) {
                document.getElementById('currentFoto').innerHTML = `
                    <div class="current-foto-info">
                        <i class="bi bi-image"></i> <strong>Foto saat ini:</strong> ${foto.split('/').pop()}<br>
                        <small>Kosongkan field foto di atas jika tidak ingin mengubah</small>
                    </div>
                `;
            } else {
                document.getElementById('currentFoto').innerHTML = '';
            }
            
            modalForm.show();
        }

        function openEditFromDetail() {
            const id = currentKkdmpId;
            const namaDesa = document.getElementById('detailNamaDesa').textContent;
            const jenis = document.getElementById('detailJenis').textContent;
            const ketua = document.getElementById('detailKetua').textContent;
            const noAhu = document.getElementById('detailNoAhu').textContent;
            const alamat = document.getElementById('detailAlamat').textContent;
            const koordinat = document.getElementById('detailKoordinat').textContent;
            
            const latMatch = koordinat.match(/Lat: ([\d.-]+)/);
            const longMatch = koordinat.match(/Long: ([\d.-]+)/);
            const latitude = latMatch ? latMatch[1] : '';
            const longitude = longMatch ? longMatch[1] : '';
            
            modalDetail.hide();
            setTimeout(() => {
                openEditModal(id, namaDesa, jenis, ketua, noAhu, alamat, latitude, longitude, currentFotoPath || '');
            }, 300);
        }

        function showDetail(id, namaDesa, jenis, ketua, noAhu, alamat, latitude, longitude, foto) {
            currentKkdmpId = id;
            currentFotoPath = foto;
            document.getElementById('detailNamaKkdmp').textContent = namaDesa;
            document.getElementById('detailNamaDesa').textContent = namaDesa;
            document.getElementById('detailJenis').textContent = jenis || '-';
            document.getElementById('detailKetua').textContent = ketua || '-';
            document.getElementById('detailNoAhu').textContent = noAhu || '-';
            document.getElementById('detailAlamat').textContent = alamat || '-';
            document.getElementById('detailKoordinat').textContent = `Lat: ${latitude || '-'}, Long: ${longitude || '-'}`;
            
            if (foto) {
                document.getElementById('detailFotoContainer').innerHTML = `
                    <img src="/storage/${foto}" alt="Foto ${namaDesa}" class="detail-foto" style="max-width: 100%; border-radius: 8px; margin-top: 8px;">
                `;
            } else {
                document.getElementById('detailFotoContainer').innerHTML = '<span style="color: #94a3b8;">Tidak ada foto</span>';
            }
            
            modalDetail.show();
        }

        function hapusDariModal() {
            const id = document.getElementById('kkdmpId').value;
            const namaDesa = document.getElementById('namaDesa').value;
            
            if (confirm(`Yakin ingin menghapus KKDMP "${namaDesa}"?`)) {
                fetch(`/admin/kkdmp/${id}`, {
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
                        sessionStorage.setItem('kkdmpNotif', 'Data KKDMP berhasil dihapus!');
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
            const formData = new FormData(document.getElementById('formKkdmp'));
            const id = document.getElementById('kkdmpId').value;
            const url = id ? `/admin/kkdmp/${id}` : '/admin/kkdmp';
            
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
                    const pesan = id ? 'Data KKDMP berhasil diperbarui!' : 'Data KKDMP berhasil ditambahkan!';
                    sessionStorage.setItem('kkdmpNotif', pesan);
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