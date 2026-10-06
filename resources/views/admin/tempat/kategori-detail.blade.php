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
        
        .btn-add { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-add:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .btn-secondary-custom { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 10px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; text-decoration: none; }
        .btn-secondary-custom:hover { background: #f8fafc; border-color: #cbd5e1; }
        
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th { padding: 14px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-modern td { padding: 16px 20px; font-size: 13px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; border: 1px solid #e2e8f0; background: white; color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-right: 6px; }
        .btn-action:hover { background: #f8fafc; }
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
        .form-input-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; }
        .form-input-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .form-textarea-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; resize: vertical; min-height: 80px; }
        .form-textarea-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        
        .section-divider { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 0.5px; margin: 16px 0 10px 0; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; }
        
        .btn-modal-cancel { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 9px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .btn-modal-save:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }
        
        @media (max-width: 992px) { .main-content { margin-left: 0; } }
        @media (max-width: 768px) { .card-header-modern { flex-direction: column; align-items: stretch; } }
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
                        <a href="{{ route('admin.tempat.index') }}" class="btn-secondary-custom">
                            <i class="bi bi-gear"></i> Kelola Field
                        </a>
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
                        <p>Klik tombol "Kelola Field" untuk menambahkan field/kolom terlebih dahulu.</p>
                    </div>
                    @elseif($data->count() === 0)
                    <div class="empty-state">
                        <i class="bi bi-inbox"></i>
                        <h4>Belum ada data</h4>
                        <p>Klik tombol "Tambah Data" untuk menambahkan data baru.</p>
                    </div>
                    @else
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA</th>
                                @foreach($fields as $field)
                                <th>{{ strtoupper(str_replace('_', ' ', $field->nama_field)) }}</th>
                                @endforeach
                                <th style="width: 100px;">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                                <td><strong>{{ $item->nama }}</strong></td>
                                @php
                                    $infoTambahan = json_decode($item->info_tambahan, true) ?? [];
                                @endphp
                                @foreach($fields as $field)
                                <td>
                                    @if($field->tipe_field === 'file' && isset($infoTambahan[$field->nama_field]))
                                        <img src="{{ asset('storage/' . $infoTambahan[$field->nama_field]) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @elseif(isset($infoTambahan[$field->nama_field]))
                                        {{ $infoTambahan[$field->nama_field] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                @endforeach
                                <td>
                                    <button class="btn-action btn-delete" onclick="hapusData({{ $item->id }}, '{{ addslashes($item->nama) }}')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade modal-form" id="modalTambahData" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle"></i> Tambah Data {{ ucfirst($kategori) }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formTambahData" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                    <div class="modal-body">
                        <div class="section-divider">Informasi Dasar</div>
                        <div class="mb-3">
                            <label class="form-label-custom">Nama <span class="required">*</span></label>
                            <input type="text" name="nama" class="form-input-custom" required>
                        </div>

                        @if($fields->count() > 0)
                        <div class="section-divider">Field Tambahan</div>
                        @foreach($fields as $field)
                        <div class="mb-3">
                            <label class="form-label-custom">{{ ucfirst(str_replace('_', ' ', $field->nama_field)) }}</label>
                            @if($field->tipe_field === 'text')
                                <input type="text" name="{{ $field->nama_field }}" class="form-input-custom" placeholder="Masukkan {{ str_replace('_', ' ', $field->nama_field) }}">
                            @elseif($field->tipe_field === 'number')
                                <input type="number" step="any" name="{{ $field->nama_field }}" class="form-input-custom" placeholder="Masukkan {{ str_replace('_', ' ', $field->nama_field) }}">
                            @elseif($field->tipe_field === 'textarea')
                                <textarea name="{{ $field->nama_field }}" class="form-textarea-custom" placeholder="Masukkan {{ str_replace('_', ' ', $field->nama_field) }}"></textarea>
                            @elseif($field->tipe_field === 'file')
                                <input type="file" name="{{ $field->nama_field }}" class="form-input-custom" accept="image/*">
                                <small style="color: #64748b; font-size: 11px;">Format: JPG, PNG, WEBP</small>
                            @elseif($field->tipe_field === 'date')
                                <input type="date" name="{{ $field->nama_field }}" class="form-input-custom">
                            @endif
                        </div>
                        @endforeach
                        @else
                        <div style="background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px; padding: 16px; margin-top: 16px;">
                            <i class="bi bi-exclamation-triangle" style="color: #d97706; font-size: 18px;"></i>
                            <strong style="color: #92400e; display: block; margin-bottom: 4px;">Belum ada field yang dikonfigurasi</strong>
                            <span style="color: #78350f; font-size: 13px;">Klik "Kelola Field" untuk menambahkan field terlebih dahulu.</span>
                        </div>
                        @endif
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalTambahData;

        document.addEventListener('DOMContentLoaded', function() {
            modalTambahData = new bootstrap.Modal(document.getElementById('modalTambahData'));
            
            document.getElementById('formTambahData').addEventListener('submit', function(e) {
                e.preventDefault();
                submitData();
            });
        });

        function openTambahDataModal() {
            document.getElementById('formTambahData').reset();
            modalTambahData.show();
        }

        function submitData() {
            const formData = new FormData(document.getElementById('formTambahData'));
            
            fetch('/admin/tempat/data', {
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
                    modalTambahData.hide(); 
                    location.reload(); 
                } else {
                    let msg = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Gagal menyimpan');
                    alert('Error: ' + msg);
                }
            })
            .catch(err => { console.error(err); alert('Terjadi kesalahan'); });
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
    </script>
</body>
</html>