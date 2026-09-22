<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        .stat-icon.green { background: linear-gradient(135deg, #10b981, #059669); }
        
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
        
        .filter-alert {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
            font-weight: 500;
        }
        
        .filter-alert a {
            background: #1e3a8a;
            color: white;
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
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
        
        .btn-import { background: linear-gradient(135deg, #8b5cf6, #6d28d9); }
        .btn-import:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3); color: white; }
        
        .btn-add { background: linear-gradient(135deg, #14b8a6, #0f766e); }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3); color: white; }
        
        .table-simple { width: 100%; border-collapse: collapse; }
        .table-simple thead { background: #f8fafc; }
        
        .table-simple th {
            padding: 14px 24px;
            font-size: 12px;
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
        .table-simple tbody tr { cursor: pointer; transition: all 0.2s; }
        .table-simple tbody tr:hover { background: #f1f5f9; }
        
        .desa-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .desa-name i { color: #10b981; font-size: 16px; }
        
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
        
        .empty-state { text-align: center; padding: 48px; color: #94a3b8; }
        .empty-state i { font-size: 36px; display: block; margin-bottom: 12px; }
        
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
        
        .detail-row {
            display: flex;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid #e2e8f0;
        }
        .detail-row:last-child { border-bottom: none; }
        
        .detail-label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 120px;
            flex-shrink: 0;
        }
        
        .detail-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 600;
        }
        
        .badge-jenis {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .badge-desa { background: #dbeafe; color: #1e40af; }
        .badge-kelurahan { background: #fef3c7; color: #d97706; }
        
        .badge-status {
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        
        .badge-aktif { background: #d1fae5; color: #065f46; }
        
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom, .form-select-custom {
            width: 100%; padding: 12px 16px; border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s;
        }
        .form-input-custom:focus, .form-select-custom:focus {
            outline: none; border-color: #3b82f6; background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }
        .form-hint { font-size: 11px; color: #64748b; margin-top: 6px; display: flex; align-items: center; gap: 4px; }
        
        .btn-modal-cancel {
            background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 10px 20px;
            border-radius: 10px; font-size: 13px; font-weight: 600; cursor: pointer;
            transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-cancel:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        
        .btn-modal-save {
            background: linear-gradient(135deg, #10b981, #059669); color: white; border: none;
            padding: 10px 24px; border-radius: 10px; font-size: 13px; font-weight: 600;
            cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.35); color: white; }
        .btn-modal-save:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 18px; }
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
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
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
                    <h3>{{ $totalDesa }}</h3>
                    <p>Total Desa</p>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon green">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalKecamatan }}</h3>
                    <p>Total Kecamatan</p>
                </div>
            </div>
        </div>

        @if($selectedKecamatan)
        <div class="filter-alert">
            <div>
                <i class="bi bi-funnel-fill"></i>
                <strong>Filter:</strong> Menampilkan desa di Kecamatan <strong>{{ $selectedKecamatan->nama_kecamatan }}</strong>
            </div>
            <a href="{{ route('admin.desa.index') }}">
                <i class="bi bi-x-lg"></i> Hapus Filter
            </a>
        </div>
        @endif

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
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="btn-action-header btn-import" data-bs-toggle="modal" data-bs-target="#modalImport">
                        <i class="bi bi-file-earmark-excel"></i>
                        Import Excel
                    </button>
                    <button type="button" class="btn-action-header btn-add" data-bs-toggle="modal" data-bs-target="#modalDesa" onclick="openModalTambah()">
                        <i class="bi bi-plus-lg"></i>
                        Tambah
                    </button>
                </div>
            </div>

            <table class="table-simple">
                <thead>
                    <tr>
                        <th style="width: 80px;">NO</th>
                        <th>NAMA DESA</th>
                    </tr>
                </thead>
                <tbody id="desaTable">
                    @forelse($desas as $index => $desa)
                    <tr data-id="{{ $desa->id }}" onclick="window.location.href='{{ route('admin.desa.detail', $desa->id) }}'">
                        <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                        <td>
                            <div class="desa-name">
                                <i class="bi bi-geo-alt-fill"></i>
                                {{ $desa->nama_desa }}
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2">
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

    <!-- Modal Tambah/Edit -->
    <div class="modal fade" id="modalDesa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span id="modalTitleText">Tambah Desa</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formDesa">
                    @csrf
                    <input type="hidden" id="desaId" name="id">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Nama Desa/Kelurahan <span class="required">*</span></label>
                                <input type="text" id="namaDesa" name="nama_desa" class="form-input-custom" placeholder="Masukkan nama desa" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Kode Desa</label>
                                <input type="text" id="kodeDesa" name="kode_desa" class="form-input-custom" placeholder="Contoh: 3523010001">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Kecamatan <span class="required">*</span></label>
                                <select id="kecamatanId" name="kecamatan_id" class="form-select-custom" required>
                                    <option value="">-- Pilih Kecamatan --</option>
                                    @foreach(\App\Models\Kecamatan::orderBy('nama_kecamatan')->get() as $kec)
                                    <option value="{{ $kec->id }}">{{ $kec->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Jenis <span class="required">*</span></label>
                                <select id="jenis" name="jenis" class="form-select-custom" required>
                                    <option value="Desa">Desa</option>
                                    <option value="Kelurahan">Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        
                        <hr style="margin: 20px 0; border-color: #e2e8f0;">
                        <h6 style="font-weight: 700; color: #1e293b; margin-bottom: 16px;">
                            <i class="bi bi-share-fill"></i> Media Sosial & Website
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom"><i class="bi bi-globe"></i> Website</label>
                                <input type="url" id="website" name="website" class="form-input-custom" placeholder="https://desa.go.id">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom"><i class="bi bi-whatsapp"></i> WhatsApp</label>
                                <input type="url" id="whatsappUrl" name="whatsapp_url" class="form-input-custom" placeholder="https://wa.me/628xxx">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom"><i class="bi bi-youtube"></i> YouTube</label>
                                <input type="url" id="youtubeUrl" name="youtube_url" class="form-input-custom" placeholder="https://youtube.com/@desa">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom"><i class="bi bi-instagram"></i> Instagram</label>
                                <input type="url" id="instagramUrl" name="instagram_url" class="form-input-custom" placeholder="https://instagram.com/desa">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom"><i class="bi bi-facebook"></i> Facebook</label>
                                <input type="url" id="facebookUrl" name="facebook_url" class="form-input-custom" placeholder="https://facebook.com/desa">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom"><i class="bi bi-tiktok"></i> TikTok</label>
                                <input type="url" id="tiktokUrl" name="tiktok_url" class="form-input-custom" placeholder="https://tiktok.com/@desa">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-save" id="btnSubmit">
                            <i class="bi bi-check-lg"></i>
                            <span id="btnSubmitText">Simpan Desa</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
    <div class="modal fade" id="modalImport" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-excel"></i>
                        Import Desa dari Excel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.desa.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label-custom">Pilih File Excel <span class="required">*</span></label>
                            <input type="file" name="file_excel" class="form-input-custom" accept=".xlsx,.xls,.csv" required>
                            <div style="margin-top: 12px; padding: 12px; background: #eff6ff; border-radius: 8px; font-size: 12px; color: #1e40af;">
                                <strong>Format Excel:</strong> NAMA KECAMATAN, DESA, KODE<br>
                                <a href="{{ route('admin.desa.download-template') }}" style="color: #1e40af; text-decoration: underline; font-weight: 600;">
                                    <i class="bi bi-download"></i> Download Template
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
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
        let modalDesa;
        let isEditMode = false;

        document.addEventListener('DOMContentLoaded', function() {
            modalDesa = new bootstrap.Modal(document.getElementById('modalDesa'));
            
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

        function openModalTambah() {
            isEditMode = false;
            document.getElementById('modalTitleText').textContent = 'Tambah Desa';
            document.getElementById('btnSubmitText').textContent = 'Simpan Desa';
            document.getElementById('formDesa').reset();
            document.getElementById('desaId').value = '';
            document.getElementById('jenis').value = 'Desa';
            document.getElementById('formDesa').action = "{{ route('admin.desa.store') }}";
        }

        function submitForm() {
            const btnSubmit = document.getElementById('btnSubmit');
            const originalText = btnSubmit.innerHTML;
            
            btnSubmit.disabled = true;
            btnSubmit.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Menyimpan...';
            
            const formData = new FormData(document.getElementById('formDesa'));
            const url = document.getElementById('formDesa').action;

            fetch(url, {
                method: 'POST',
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
                    modalDesa.hide();
                    alert(data.message);
                    setTimeout(() => { window.location.reload(); }, 800);
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menyimpan data');
            })
            .finally(() => {
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = originalText;
            });
        }
    </script>
</body>
</html>