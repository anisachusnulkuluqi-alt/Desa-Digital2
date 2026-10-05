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
        
        .sidebar { width: 260px; background: #0f172a; min-height: 100vh; position: fixed; left: 0; top: 0; padding: 20px 14px; z-index: 100; overflow-y: auto; }
        .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
        .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; }
        .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
        .sidebar-brand-text small { color: #64748b; font-size: 10px; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: #2563eb; color: white; }
        .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
        .sidebar-divider { margin: 16px 0; padding-top: 16px; border-top: 1px solid rgba(148, 163, 184, 0.2); list-style: none; }
        
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
        
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }
        
        @media (max-width: 992px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } }
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
                        Daftar {{ ucfirst($kategori) }}
                        <span class="badge-count">{{ $totalTempat }} {{ ucfirst($kategori) }}</span>
                    </div>
                    <div class="table-actions">
                        <form method="GET" action="{{ route('admin.tempat.kategori', $kategori) }}" style="display: flex; gap: 10px; align-items: center;">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau desa...">
                            </div>
                        </form>
                        <a href="{{ route('admin.tempat.index') }}" class="btn-add">
                            <i class="bi bi-plus-lg"></i> Tambah {{ ucfirst($kategori) }}
                        </a>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA</th>
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
                                        <div class="tempat-icon"><i class="bi bi-pin-map-fill"></i></div>
                                        {{ $tempat->nama }}
                                    </div>
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

    <!-- Modal Edit (sama seperti di index.blade.php) -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-radius: 12px 12px 0 0; padding: 18px 22px; border: none;">
                    <h5 class="modal-title" style="font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px;">
                        <i class="bi bi-pencil-square"></i> Edit {{ ucfirst($kategori) }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter: brightness(0) invert(1);"></button>
                </div>
                <form id="formEdit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 24px 22px;">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama</label>
                            <input type="text" name="nama" id="editNama" class="form-input-custom" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Kategori</label>
                                <input type="text" name="kategori" id="editKategori" class="form-input-custom" value="{{ $kategori }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Desa</label>
                                <input type="text" name="desa" id="editDesa" class="form-input-custom">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Alamat</label>
                            <input type="text" name="alamat" id="editAlamat" class="form-input-custom">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Latitude</label>
                                <input type="text" name="latitude" id="editLatitude" class="form-input-custom">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">Longitude</label>
                                <input type="text" name="longitude" id="editLongitude" class="form-input-custom">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea name="deskripsi" id="editDeskripsi" class="form-input-custom" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Foto (kosongkan jika tidak ingin mengubah)</label>
                            <input type="file" name="foto" id="editFoto" class="form-input-custom" accept="image/*">
                            <img id="editFotoPreview" src="" style="max-width: 200px; margin-top: 10px; border-radius: 8px; display: none;">
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px;">
                        <button type="button" class="btn-action" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                        <button type="submit" class="btn-add"><i class="bi bi-check-lg"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalEdit;
        document.addEventListener('DOMContentLoaded', function() {
            modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
        });

        function openEditModal(id, nama, kategori, desa, alamat, latitude, longitude, deskripsi, foto) {
            document.getElementById('formEdit').action = '/admin/tempat/' + id;
            document.getElementById('editNama').value = nama || '';
            document.getElementById('editKategori').value = kategori || '';
            document.getElementById('editDesa').value = desa || '';
            document.getElementById('editAlamat').value = alamat || '';
            document.getElementById('editLatitude').value = latitude || '';
            document.getElementById('editLongitude').value = longitude || '';
            document.getElementById('editDeskripsi').value = deskripsi || '';
            
            const preview = document.getElementById('editFotoPreview');
            if (foto && foto.trim() !== '') {
                preview.src = foto;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
            
            modalEdit.show();
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
    </script>
</body>
</html>