<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Layanan (Master) - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        body { margin: 0; background: #f8fafc; color: #1e293b; }
        .main-content { margin-left: 260px; min-height: 100vh; }
        .top-header { min-height: 62px; background: white; border-bottom: 1px solid #e2e8f0; padding: 0 28px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 99; }
        .breadcrumb-simple { font-size: 13px; color: #64748b; }
        .breadcrumb-simple strong { color: #1e293b; }
        .page-body { padding: 28px; }
        .page-label { margin-bottom: 6px; color: #1e3a8a; font-size: 11px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
        .page-title { margin-bottom: 6px; font-size: 28px; font-weight: 800; }
        .page-subtitle { margin-bottom: 24px; color: #64748b; font-size: 13px; }
        .card-modern { overflow: hidden; border: 1px solid #e2e8f0; border-radius: 12px; background: white; }
        .card-header-modern { padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; gap: 12px; border-bottom: 1px solid #e2e8f0; }
        .card-title-modern { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 700; }
        .card-title-modern i { color: #1e3a8a; font-size: 18px; }
        .badge-count { padding: 3px 10px; border-radius: 10px; background: #1e3a8a; color: white; font-size: 11px; }
        .btn-add, .btn-modal-save { border: 0; border-radius: 8px; background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; font-size: 13px; font-weight: 600; }
        .btn-add { padding: 10px 18px; }
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern th { padding: 14px 20px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; color: #64748b; font-size: 11px; text-align: left; text-transform: uppercase; }
        .table-modern td { padding: 16px 20px; border-bottom: 1px solid #f1f5f9; font-size: 13px; vertical-align: middle; }
        .table-modern tbody tr:last-child td { border-bottom: 0; }
        .link-value { max-width: 520px; overflow-wrap: anywhere; color: #2563eb; }
        .btn-action { margin-right: 5px; padding: 6px 10px; border: 1px solid #e2e8f0; border-radius: 6px; background: white; color: #475569; font-size: 12px; font-weight: 600; }
        .btn-action:hover { border-color: #2563eb; color: #1d4ed8; }
        .btn-delete:hover { border-color: #dc2626; color: #dc2626; }
        .empty-state { padding: 56px 20px !important; color: #64748b; text-align: center; }
        .alert-banner { margin-bottom: 20px; padding: 14px 18px; border: 1px solid #86efac; border-radius: 10px; background: #dcfce7; color: #166534; }
        .form-label-custom { display: block; margin-bottom: 6px; font-size: 12px; font-weight: 700; }
        .form-input-custom { width: 100%; margin-bottom: 16px; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; }
        @media (max-width: 992px) { .main-content { margin-left: 0; } }
        @media (max-width: 600px) {
            .top-header { padding: 0 14px; }
            .page-body { padding: 20px 14px; }
            .card-header-modern { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    @include('admin.partials.sidebar', ['activeMenu' => 'layanan'])
    <div class="main-content">
        <header class="top-header">
            <div class="breadcrumb-simple">Admin <span aria-hidden="true">/</span> <strong>Layanan (Master)</strong></div>
            @include('admin.partials.header-actions')
        </header>
        <main class="page-body">
            <p class="page-label">Manajemen Layanan</p>
            <h1 class="page-title">Layanan (Master)</h1>
            <p class="page-subtitle">Kelola tautan yang ditampilkan pada Gerbang Layanan Publik Digital.</p>

            @if(session('success'))
                <div class="alert-banner"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif

            <section class="card-modern" aria-label="Daftar layanan">
                <div class="card-header-modern">
                    <div class="card-title-modern"><i class="bi bi-grid-fill"></i> Daftar Layanan <span class="badge-count">{{ $layanans->count() }} Layanan</span></div>
                    <button type="button" class="btn-add" onclick="openCreateModal()"><i class="bi bi-plus-lg"></i> Tambah Layanan</button>
                </div>
                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead><tr><th style="width: 60px;">No</th><th>Nama Layanan</th><th>Link</th><th style="width: 190px;">Aksi</th></tr></thead>
                        <tbody>
                            @forelse($layanans as $index => $layanan)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $layanan->nama }}</td>
                                    <td class="link-value">{{ $layanan->link }}</td>
                                    <td>
                                        <button type="button" class="btn-action" onclick="openEditModal({{ Illuminate\Support\Js::from($layanan->id) }}, {{ Illuminate\Support\Js::from($layanan->nama) }}, {{ Illuminate\Support\Js::from($layanan->link) }})"><i class="bi bi-pencil"></i> Edit</button>
                                        <form method="POST" action="{{ route('admin.layanan.destroy', $layanan) }}" style="display: inline;" onsubmit="return confirm('Hapus layanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete"><i class="bi bi-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="empty-state"><i class="bi bi-inbox" style="font-size: 36px;"></i><p class="mb-0 mt-2">Belum ada layanan.</p></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <div class="modal fade" id="modalLayanan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #1e3a8a, #3b82f6);">
                    <h5 class="modal-title" id="modalLayananTitle"><i class="bi bi-plus-circle"></i> Tambah Layanan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form id="formLayanan" method="POST" action="{{ route('admin.layanan.store') }}" data-update-url="{{ route('admin.layanan.update', ['layanan' => '__ID__']) }}">
                    @csrf
                    <input type="hidden" name="_method" id="layananMethod" value="">
                    <input type="hidden" name="layanan_id" id="layananId" value="">
                    <div class="modal-body p-4">
                        <label class="form-label-custom" for="layananNama">Nama Layanan <span class="text-danger">*</span></label>
                        <input type="text" class="form-input-custom" id="layananNama" name="nama" maxlength="120" required>
                        <label class="form-label-custom" for="layananLink">Link <span class="text-danger">*</span></label>
                        <input type="text" class="form-input-custom mb-0" id="layananLink" name="link" maxlength="2048" placeholder="https://contoh.id atau /website" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal-save px-3 py-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const layananModal = new bootstrap.Modal(document.getElementById('modalLayanan'));
        const layananForm = document.getElementById('formLayanan');
        const layananStoreUrl = @json(route('admin.layanan.store'));
        const layananUpdateUrl = layananForm.dataset.updateUrl;

        function openCreateModal() {
            layananForm.reset();
            layananForm.action = layananStoreUrl;
            document.getElementById('layananMethod').value = '';
            document.getElementById('layananId').value = '';
            document.getElementById('modalLayananTitle').innerHTML = '<i class="bi bi-plus-circle"></i> Tambah Layanan';
            layananModal.show();
        }

        function openEditModal(id, nama, link) {
            layananForm.action = layananUpdateUrl.replace('__ID__', id);
            document.getElementById('layananMethod').value = 'PUT';
            document.getElementById('layananId').value = id;
            document.getElementById('layananNama').value = nama;
            document.getElementById('layananLink').value = link;
            document.getElementById('modalLayananTitle').innerHTML = '<i class="bi bi-pencil-square"></i> Edit Layanan';
            layananModal.show();
        }

        @if($errors->any())
            @if(old('_method') === 'PUT')
                openEditModal(@json(old('layanan_id')), @json(old('nama')), @json(old('link')));
            @else
                document.getElementById('layananNama').value = @json(old('nama'));
                document.getElementById('layananLink').value = @json(old('link'));
                layananModal.show();
            @endif
        @endif
    </script>
</body>
</html>
