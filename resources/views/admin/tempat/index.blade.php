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
        
        .btn-add { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th { padding: 14px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-modern td { padding: 16px 20px; font-size: 13px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; border: 1px solid #e2e8f0; background: white; color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-right: 6px; }
        .btn-action:hover { background: #f8fafc; }
        .btn-edit:hover { color: #1e3a8a; border-color: #1e3a8a; }
        .btn-delete:hover { color: #dc2626; border-color: #dc2626; background: #fef2f2; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; color: #cbd5e1; }
        .empty-state h4 { font-size: 16px; font-weight: 600; color: #64748b; margin-bottom: 8px; }
        
        .modal-form .modal-content { border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-form .modal-header { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-radius: 12px 12px 0 0; padding: 18px 22px; border: none; }
        .modal-form .modal-title { font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .modal-form .modal-header .btn-close { filter: brightness(0) invert(1); }
        .modal-form .modal-body { padding: 24px 22px; max-height: 70vh; overflow-y: auto; }
        .modal-form .modal-footer { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px; }
        
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom, .form-select-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; }
        .form-input-custom:focus, .form-select-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        
        .kategori-hint { font-size: 11px; color: #64748b; margin-top: 8px; display: flex; align-items: center; gap: 4px; }
        .kategori-hint i { color: #1e3a8a; }
        
        .btn-modal-cancel { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }

        .field-item { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; background: #f8fafc; border-radius: 8px; margin-bottom: 8px; border: 1px solid #e2e8f0; }
        .field-item-info { display: flex; align-items: center; gap: 10px; }
        .field-item-name { font-weight: 600; color: #1e293b; font-size: 13px; }
        .field-item-type { font-size: 11px; color: #64748b; background: #e2e8f0; padding: 2px 8px; border-radius: 4px; }
        
        .section-divider { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 10px 0; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }
        
        @media (max-width: 992px) { .main-content { margin-left: 0; } }
        @media (max-width: 768px) { .card-header-modern { flex-direction: column; align-items: stretch; } .table-actions { flex-direction: column; } }
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
            @include('admin.partials.header-actions')
        </header>

        <div class="page-body">
            <div class="page-header">
                <div class="page-label">MANAJEMEN ATRIBUT/KATEGORI</div>
                <h1 class="page-title">Tempat</h1>
                <p class="page-subtitle">Kelola kategori dan field kustom untuk pengelompokan data tempat.</p>
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
                        <i class="bi bi-tags-fill"></i>
                        Daftar Kategori/Atribut
                        <span class="badge-count">{{ $kategoris->count() }} Kategori</span>
                    </div>
                    <div class="table-actions">
                        <button type="button" class="btn-add" onclick="openAtributModal()">
                            <i class="bi bi-plus-lg"></i> Tambah Atribut
                        </button>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA KATEGORI</th>
                                <th style="width: 300px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $index => $kategori)
                            <tr>
                                <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                                <td>
                                    <a href="javascript:void(0)" 
                                       onclick="openKategoriPopup('{{ $kategori->nama }}')"
                                       style="color: #1e3a8a; text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 10px; cursor: pointer;"
                                       onmouseover="this.style.textDecoration='underline'" 
                                       onmouseout="this.style.textDecoration='none'">
                                        <span style="width: 32px; height: 32px; border-radius: 8px; background: #dbeafe; display: inline-flex; align-items: center; justify-content: center; color: #1e40af; font-size: 14px;">
                                            <i class="bi bi-tag-fill"></i>
                                        </span>
                                        {{ ucfirst($kategori->nama) }}
                                    </a>
                                </td>
                                <td>
                                    <button class="btn-action" onclick="openKategoriPopup('{{ $kategori->nama }}')">
                                        <i class="bi bi-gear"></i> Kelola Field
                                    </button>
                                    <button class="btn-action btn-edit" onclick="openEditModal({{ $kategori->id }}, '{{ addslashes($kategori->nama) }}')">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    <button class="btn-action btn-delete" onclick="hapusKategori({{ $kategori->id }}, '{{ addslashes($kategori->nama) }}')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum ada kategori</h4>
                                        <p>Klik tombol "Tambah Atribut" untuk membuat kategori baru.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 1: Tambah Atribut/Kategori Baru -->
    <div class="modal fade modal-form" id="modalAtribut" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Tambah Atribut/Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formAtribut">
                    @csrf
                    <div class="modal-body">
                        <label class="form-label-custom">Nama Kategori <span class="required">*</span></label>
                        <input type="text" id="namaKategori" name="nama" class="form-input-custom" 
                               placeholder="Contoh: kuliner, wisata, hotel, sekolah..." required>
                        <div class="kategori-hint">
                            <i class="bi bi-lightbulb"></i>
                            <span>Kategori akan muncul di sidebar setelah disimpan</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-save">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal 2: Edit Atribut/Kategori -->
    <div class="modal fade modal-form" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formEdit">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editId" name="id">
                    <div class="modal-body">
                        <label class="form-label-custom">Nama Kategori <span class="required">*</span></label>
                        <input type="text" id="editNama" name="nama" class="form-input-custom" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-save">
                            <i class="bi bi-check-lg"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal 3: Popup Kelola Field -->
    <div class="modal fade modal-form" id="modalKategoriPopup" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKategoriTitle">
                        <i class="bi bi-gear-fill"></i> Kelola Field
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: brightness(0) invert(1);"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="section-divider">Field yang Sudah Ada</div>
                    <div id="fieldList">
                        <p style="color: #94a3b8; text-align: center; padding: 20px;">Memuat data...</p>
                    </div>

                    <div class="section-divider">Tambah Field Baru</div>
                    <form id="formField">
                        @csrf
                        <input type="hidden" id="kategoriIdField" name="kategori_id">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Field <span class="required">*</span></label>
                            <input type="text" id="namaField" name="nama_field" class="form-input-custom" 
                                   placeholder="Contoh: nama_pemilik, jam_buka, kapasitas" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Tipe Field <span class="required">*</span></label>
                            <select id="tipeField" name="tipe_field" class="form-select-custom" required>
                                <option value="text">Text (Teks biasa)</option>
                                <option value="number">Number (Angka)</option>
                                <option value="textarea">Textarea (Teks panjang)</option>
                                <option value="file">File (Upload gambar/file)</option>
                                <option value="date">Date (Tanggal)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-add" style="width: 100%;">
                            <i class="bi bi-plus-lg"></i> Tambah Field
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i> Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalAtribut, modalEdit, modalKategoriPopup;
        let currentKategori = '';
        let currentKategoriId = '';

        document.addEventListener('DOMContentLoaded', function() {
            modalAtribut = new bootstrap.Modal(document.getElementById('modalAtribut'));
            modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
            modalKategoriPopup = new bootstrap.Modal(document.getElementById('modalKategoriPopup'));
            
            document.getElementById('formAtribut').addEventListener('submit', function(e) {
                e.preventDefault();
                submitAtribut();
            });
            
            document.getElementById('formEdit').addEventListener('submit', function(e) {
                e.preventDefault();
                submitEdit();
            });

            document.getElementById('formField').addEventListener('submit', function(e) {
                e.preventDefault();
                submitField();
            });
        });

        function openAtributModal() {
            document.getElementById('formAtribut').reset();
            modalAtribut.show();
        }

        function submitAtribut() {
            const formData = new FormData(document.getElementById('formAtribut'));
            fetch('/admin/tempat/kategori', {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { 
                    modalAtribut.hide(); 
                    location.reload(); 
                } else {
                    let msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Gagal menyimpan');
                    alert('Error: ' + msg);
                }
            })
            .catch(err => { console.error(err); alert('Terjadi kesalahan'); });
        }

        function openEditModal(id, nama) {
            document.getElementById('editId').value = id;
            document.getElementById('editNama').value = nama;
            modalEdit.show();
        }

        function submitEdit() {
            const id = document.getElementById('editId').value;
            const formData = new FormData(document.getElementById('formEdit'));
            fetch('/admin/tempat/kategori/' + id, {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { 
                    modalEdit.hide(); 
                    location.reload(); 
                } else {
                    let msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Gagal menyimpan');
                    alert('Error: ' + msg);
                }
            })
            .catch(err => { console.error(err); alert('Terjadi kesalahan'); });
        }

        function hapusKategori(id, nama) {
            if (confirm(`Yakin ingin menghapus kategori "${nama}"?\n\nKategori akan hilang dari sidebar.`)) {
                fetch('/admin/tempat/kategori/' + id, {
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

        // === FUNGSI POPUP KELOLA FIELD ===
        function openKategoriPopup(kategori) {
            currentKategori = kategori;
            document.getElementById('modalKategoriTitle').innerHTML = 
                '<i class="bi bi-gear-fill"></i> Kelola Field - ' + capitalizeFirst(kategori);
            document.getElementById('fieldList').innerHTML = '<p style="color: #94a3b8; text-align: center; padding: 20px;">Memuat data...</p>';
            
            // Fetch ke endpoint JSON (BUKAN endpoint view)
            fetch('/admin/tempat/kategori-json/' + encodeURIComponent(kategori))
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        currentKategoriId = data.kategori_id;
                        document.getElementById('kategoriIdField').value = data.kategori_id;
                        renderFields(data.fields);
                        modalKategoriPopup.show();
                    } else {
                        alert('Gagal memuat data: ' + (data.error || 'Unknown error'));
                    }
                })
                .catch(err => { console.error(err); alert('Gagal memuat data'); });
        }

        function renderFields(fields) {
            const container = document.getElementById('fieldList');
            if (fields.length === 0) {
                container.innerHTML = '<p style="color: #94a3b8; text-align: center; padding: 20px;">Belum ada field. Silakan tambahkan di bawah.</p>';
                return;
            }
            
            let html = '';
            fields.forEach(field => {
                html += `
                    <div class="field-item">
                        <div class="field-item-info">
                            <span class="field-item-name">${capitalizeFirst(field.nama_field)}</span>
                            <span class="field-item-type">${field.tipe_field}</span>
                        </div>
                        <button class="btn-action btn-delete" onclick="hapusField(${field.id}, '${field.nama_field}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
            });
            container.innerHTML = html;
        }

        function submitField() {
            const formData = new FormData(document.getElementById('formField'));
            
            fetch('/admin/tempat/field', {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                    'Accept': 'application/json' 
                },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) { 
                    document.getElementById('formField').reset();
                    document.getElementById('kategoriIdField').value = currentKategoriId;
                    openKategoriPopup(currentKategori);
                } else {
                    let msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Gagal menyimpan');
                    alert('Error: ' + msg);
                }
            })
            .catch(err => { console.error(err); alert('Terjadi kesalahan'); });
        }

        function hapusField(id, nama) {
            if (confirm(`Yakin ingin menghapus field "${nama}"?`)) {
                fetch('/admin/tempat/field/' + id, {
                    method: 'POST',
                    headers: { 
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), 
                        'Accept': 'application/json' 
                    },
                    body: new URLSearchParams({ '_method': 'DELETE' })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) openKategoriPopup(currentKategori);
                    else alert(data.message || 'Gagal menghapus');
                })
                .catch(err => { console.error(err); alert('Gagal menghapus'); });
            }
        }

        function capitalizeFirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    </script>
</body>
</html>