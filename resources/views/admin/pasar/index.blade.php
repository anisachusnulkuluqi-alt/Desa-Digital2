<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pasar Desa - Portal Desa Digital</title>
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
        
        .pasar-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .pasar-name-icon {
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
        
        /* ✅ NOTIFIKASI BANNER - Seperti screenshot */
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
        
        .alert-banner i {
            font-size: 18px;
            color: #16a34a;
        }
        
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
        
        .alert-banner .close-btn:hover {
            opacity: 1;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
        
        .detail-foto {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-hint { font-size: 11px; color: #64748b; margin-top: 4px; font-style: italic; display: flex; align-items: center; gap: 4px; }
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
                <li class="breadcrumb-item active">Pasar Desa</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        <!-- ✅ NOTIFIKASI BANNER - Muncul dari session flash atau sessionStorage -->
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
            <i class="bi bi-shop"></i>
            Pasar Desa
        </h1>
        <p class="page-subtitle">Kelola data pasar tradisional di Kabupaten Tuban</p>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue">
                    <i class="bi bi-shop"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalPasar ?? 0 }}</h3>
                    <p>Total Pasar</p>
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
                <input type="text" id="searchInput" placeholder="Cari nama pasar...">
            </div>
        </div>

        <div class="table-card">
            <div class="table-header">
                <div class="table-title">
                    <i class="bi bi-list-ul"></i>
                    Daftar Pasar
                    <span class="badge-count">{{ $pasars->count() }} Pasar</span>
                </div>
                <div>
                    <button type="button" class="btn-action-header btn-add" onclick="openTambahModal()">
                        <i class="bi bi-plus-lg"></i>
                        Tambah Pasar
                    </button>
                </div>
            </div>

            <table class="table-simple">
                <thead>
                    <tr>
                        <th style="width: 50px;">NO</th>
                        <th>NAMA PASAR</th>
                        <th>DESA</th>
                    </tr>
                </thead>
                <tbody id="pasarTable">
                    @forelse($pasars as $index => $pasar)
                    <tr data-id="{{ $pasar->id }}" onclick="showDetail({{ $pasar->id }}, '{{ addslashes($pasar->nama_pasar) }}', '{{ addslashes($pasar->alamat ?? '-') }}', '{{ addslashes($pasar->desa->nama_desa ?? '-') }}', '{{ $pasar->latitude ?? '-' }}', '{{ $pasar->longitude ?? '-' }}', '{{ $pasar->status ?? 'aktif' }}', '{{ $pasar->foto ?? '' }}')">
                        <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <div class="pasar-name">
                                <div class="pasar-name-icon">
                                    <i class="bi bi-shop"></i>
                                </div>
                                {{ $pasar->nama_pasar }}
                            </div>
                        </td>
                        <td>{{ $pasar->desa->nama_desa ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                Belum ada data pasar
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Detail Pasar -->
    <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-shop"></i>
                        <span id="detailNamaPasar">Detail Pasar</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-row">
                        <div class="detail-label">Nama Pasar</div>
                        <div class="detail-value" id="detailNama"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Alamat</div>
                        <div class="detail-value" id="detailAlamat"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Desa/Kelurahan</div>
                        <div class="detail-value" id="detailDesa"></div>
                    </div>
                    <div class="detail-row">
                        <div class="detail-label">Koordinat</div>
                        <div class="detail-value" id="detailKoordinat"></div>
                    </div>
                    <div class="detail-row" style="flex-direction: column; align-items: flex-start;">
                        <div class="detail-label" style="margin-bottom: 8px;">Foto Pasar</div>
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

    <!-- Modal Tambah/Edit Pasar -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormTitle">
                        <i class="bi bi-plus-circle"></i>
                        Tambah Pasar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formPasar" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="pasarId" name="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">
                                Nama Pasar <span class="required">*</span>
                            </label>
                            <input type="text" id="namaPasar" name="nama_pasar" class="form-input-custom" placeholder="Masukkan nama pasar (contoh: Pasar Bandungrejo)" required>
                            <div class="form-hint"><i class="bi bi-info-circle"></i> Nama pasar yang akan ditampilkan di portal</div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Alamat Lengkap</label>
                            <textarea id="alamat" name="alamat" class="form-input-custom" rows="2" placeholder="Masukkan alamat lengkap pasar"></textarea>
                            <div class="form-hint"><i class="bi bi-info-circle"></i> Alamat lengkap lokasi pasar</div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Desa/Kelurahan</label>
                                <select id="desaId" name="desa_id" class="form-select-custom">
                                    <option value="">-- Pilih Desa/Kelurahan --</option>
                                    @foreach(\App\Models\Desa::orderBy('nama_desa')->get() as $desa)
                                        <option value="{{ $desa->id }}">{{ $desa->nama_desa }}</option>
                                    @endforeach
                                </select>
                                <div class="form-hint"><i class="bi bi-info-circle"></i> Pilih desa lokasi pasar</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Status</label>
                                <select id="status" name="status" class="form-select-custom">
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                                <div class="form-hint"><i class="bi bi-info-circle"></i> Status operasional pasar</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Latitude (Koordinat)</label>
                                <input type="text" id="latitude" name="latitude" class="form-input-custom" placeholder="-7.123456">
                                <div class="form-hint"><i class="bi bi-info-circle"></i> Koordinat lintang (contoh: -7.084268)</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Longitude (Koordinat)</label>
                                <input type="text" id="longitude" name="longitude" class="form-input-custom" placeholder="112.123456">
                                <div class="form-hint"><i class="bi bi-info-circle"></i> Koordinat bujur (contoh: 112.107540)</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Foto Pasar</label>
                            <input type="file" id="foto" name="foto" class="form-input-custom" accept="image/*">
                            <div class="form-hint"><i class="bi bi-info-circle"></i> Format: JPG, PNG (Maksimal 2MB). Kosongkan jika tidak ingin mengubah foto</div>
                            <div id="currentFoto"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="button" id="btnHapusPasar" class="btn-modal-delete" onclick="hapusDariModal()" style="display: none;">
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
        let currentPasarId = null;
        let currentFotoPath = null;

        document.addEventListener('DOMContentLoaded', function() {
            modalDetail = new bootstrap.Modal(document.getElementById('modalDetail'));
            modalForm = new bootstrap.Modal(document.getElementById('modalForm'));
            
            // ✅ CEK NOTIFIKASI DARI sessionStorage (setelah reload)
            const notifMessage = sessionStorage.getItem('pasarNotif');
            if (notifMessage) {
                showNotif(notifMessage);
                sessionStorage.removeItem('pasarNotif');
            }
            
            document.getElementById('formPasar').addEventListener('submit', function(e) {
                e.preventDefault();
                submitForm();
            });

            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#pasarTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });

        // ✅ FUNGSI TAMPILKAN NOTIFIKASI BANNER
        function showNotif(message) {
            const banner = document.getElementById('notifBanner');
            const text = document.getElementById('notifText');
            text.textContent = message;
            banner.style.display = 'block';
            
            // Auto hide setelah 4 detik
            setTimeout(() => {
                closeNotif();
            }, 4000);
        }

        function closeNotif() {
            const banner = document.getElementById('notifBanner');
            banner.style.display = 'none';
        }

        function openTambahModal() {
            currentPasarId = null;
            currentFotoPath = null;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Pasar';
            document.getElementById('formPasar').reset();
            document.getElementById('pasarId').value = '';
            document.getElementById('status').value = 'aktif';
            document.getElementById('btnHapusPasar').style.display = 'none';
            document.getElementById('currentFoto').innerHTML = '';
            modalForm.show();
        }

        function openEditModal(id, nama, alamat, desaId, latitude, longitude, status, foto) {
            currentPasarId = id;
            currentFotoPath = foto;
            document.getElementById('modalFormTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Pasar';
            document.getElementById('pasarId').value = id;
            document.getElementById('namaPasar').value = nama;
            document.getElementById('alamat').value = alamat;
            document.getElementById('desaId').value = desaId || '';
            document.getElementById('latitude').value = latitude || '';
            document.getElementById('longitude').value = longitude || '';
            document.getElementById('status').value = status || 'aktif';
            document.getElementById('btnHapusPasar').style.display = 'inline-flex';
            
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
            const id = currentPasarId;
            const nama = document.getElementById('detailNama').textContent;
            const alamat = document.getElementById('detailAlamat').textContent;
            const koordinat = document.getElementById('detailKoordinat').textContent;
            const desa = document.getElementById('detailDesa').textContent;
            
            const latMatch = koordinat.match(/Lat: ([\d.-]+)/);
            const longMatch = koordinat.match(/Long: ([\d.-]+)/);
            const latitude = latMatch ? latMatch[1] : '';
            const longitude = longMatch ? longMatch[1] : '';
            
            const desaSelect = document.getElementById('desaId');
            let desaId = '';
            for (let option of desaSelect.options) {
                if (option.text === desa) {
                    desaId = option.value;
                    break;
                }
            }
            
            modalDetail.hide();
            setTimeout(() => {
                openEditModal(id, nama, alamat, desaId, latitude, longitude, 'aktif', currentFotoPath || '');
            }, 300);
        }

        function showDetail(id, nama, alamat, desa, latitude, longitude, status, foto) {
            currentPasarId = id;
            currentFotoPath = foto;
            document.getElementById('detailNamaPasar').textContent = nama;
            document.getElementById('detailNama').textContent = nama;
            document.getElementById('detailAlamat').textContent = alamat;
            document.getElementById('detailDesa').textContent = desa;
            document.getElementById('detailKoordinat').textContent = `Lat: ${latitude}, Long: ${longitude}`;
            
            if (foto) {
                document.getElementById('detailFotoContainer').innerHTML = `
                    <img src="/storage/${foto}" alt="Foto ${nama}" class="detail-foto" style="max-width: 100%; border-radius: 8px; margin-top: 8px;">
                `;
            } else {
                document.getElementById('detailFotoContainer').innerHTML = '<span style="color: #94a3b8;">Tidak ada foto</span>';
            }
            
            modalDetail.show();
        }

        function hapusDariModal() {
            const id = document.getElementById('pasarId').value;
            const nama = document.getElementById('namaPasar').value;
            
            if (confirm(`Yakin ingin menghapus pasar "${nama}"?`)) {
                fetch(`/admin/pasar/${id}`, {
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
                        // ✅ SIMPAN PESAN KE sessionStorage SEBELUM RELOAD
                        sessionStorage.setItem('pasarNotif', 'Data pasar berhasil dihapus!');
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
            const formData = new FormData(document.getElementById('formPasar'));
            const id = document.getElementById('pasarId').value;
            const url = id ? `/admin/pasar/${id}` : '/admin/pasar';
            
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
                    // ✅ SIMPAN PESAN KE sessionStorage SEBELUM RELOAD
                    const pesan = id ? 'Data pasar berhasil diperbarui!' : 'Data pasar berhasil ditambahkan!';
                    sessionStorage.setItem('pasarNotif', pesan);
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