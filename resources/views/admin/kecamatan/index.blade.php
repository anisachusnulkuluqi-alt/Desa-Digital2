<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Kecamatan - Portal Desa Digital</title>
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
        
        .kecamatan-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .kecamatan-toggle {
            border: 0;
            padding: 0;
            background: transparent;
            color: #1e40af;
            font: inherit;
            text-align: left;
            cursor: pointer;
        }

        .kecamatan-toggle:hover { text-decoration: underline; }
        .kecamatan-toggle:focus-visible, .desa-detail-button:focus-visible { outline: 2px solid #2563eb; outline-offset: 3px; }
        .kecamatan-chevron { margin-left: auto; color: #64748b; transition: transform 0.2s; }
        .kecamatan-toggle[aria-expanded="true"] .kecamatan-chevron { transform: rotate(180deg); }

        .desa-dropdown-row { display: none; background: #f8fafc; }
        .desa-dropdown-row.is-open { display: table-row; }
        .desa-dropdown-row td { padding: 12px 20px 16px 80px; }
        .desa-dropdown-list { display: flex; flex-wrap: wrap; gap: 8px; }
        .desa-detail-button {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border: 1px solid #dbeafe;
            border-radius: 6px;
            padding: 7px 10px;
            background: white;
            color: #1e40af;
            font: inherit;
            font-size: 13px;
            cursor: pointer;
        }
        .desa-detail-button:hover { border-color: #93c5fd; background: #eff6ff; }
        .desa-empty { color: #64748b; font-size: 13px; }

        .modal-content { border: none; border-radius: 12px; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header { padding: 18px 22px; border: none; border-radius: 12px 12px 0 0; background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; }
        .modal-header .modal-title { display: flex; align-items: center; gap: 10px; font-size: 16px; font-weight: 700; }
        .modal-header .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-body { max-height: 70vh; overflow-y: auto; padding: 24px 22px; }
        .modal-footer { padding: 14px 22px; border-top: 1px solid #e2e8f0; border-radius: 0 0 12px 12px; background: #f8fafc; }
        .detail-row { display: flex; margin-bottom: 14px; padding-bottom: 14px; border-bottom: 1px solid #e2e8f0; }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { width: 130px; flex-shrink: 0; color: #64748b; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .detail-value { color: #1e293b; font-size: 14px; font-weight: 600; }
        .badge-jenis { display: inline-block; border-radius: 6px; padding: 4px 10px; background: #dbeafe; color: #1e40af; font-size: 12px; }
        .badge-jenis.badge-kelurahan { background: #fef3c7; color: #92400e; }
        .social-links { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 8px; }
        .social-link { display: inline-flex; align-items: center; gap: 6px; border-radius: 6px; padding: 6px 12px; color: white; font-size: 12px; font-weight: 600; text-decoration: none; }
        .social-link.website { background: #3b82f6; }
        .social-link.youtube { background: #ef4444; }
        .social-link.instagram { background: #d94675; }
        .social-link.facebook { background: #1877f2; }
        .social-link.tiktok { background: #111827; }
        .social-link.whatsapp { background: #16a34a; }
        .detail-value a { color: #1e40af; text-decoration: none; }
        .btn-modal-cancel, .btn-modal-save { display: inline-flex; align-items: center; gap: 6px; border-radius: 8px; padding: 9px 18px; font-size: 13px; font-weight: 600; text-decoration: none; }
        .btn-modal-cancel { border: 1.5px solid #e2e8f0; background: white; color: #64748b; }
        .btn-modal-save { border: none; background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: white; }
        .btn-modal-delete { display: inline-flex; align-items: center; gap: 6px; margin-right: auto; border: 0; border-radius: 8px; padding: 9px 18px; background: #ef4444; color: white; font-size: 13px; font-weight: 600; }
        .section-divider { margin: 8px 0 14px; padding-bottom: 6px; border-bottom: 1px solid #e2e8f0; color: #1e3a8a; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-label-custom { display: block; margin-bottom: 6px; color: #1e293b; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        .form-label-custom .required { color: #ef4444; }
        .form-input-custom, .form-select-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; background: #f8fafc; color: #1e293b; font-size: 14px; }
        .form-input-custom:focus, .form-select-custom:focus { outline: none; border-color: #3b82f6; background: white; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08); }
        
        .kecamatan-name-icon {
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
        
        .empty-state { text-align: center; padding: 40px; color: #94a3b8; }
        .empty-state i { font-size: 32px; display: block; margin-bottom: 10px; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
        }
    </style>
    @include('admin.partials.list-page-styles')
</head>
<body>
    @include('admin.partials.sidebar', ['activeMenu' => 'kecamatan'])
    <div class="admin-main">
        <header class="admin-topbar">
            <div class="admin-breadcrumb">Admin <span aria-hidden="true">/</span> <strong>Kecamatan</strong></div>
            <div class="admin-user">{{ auth()->user()->name ?? 'Administrator' }}</div>
        </header>
        <main class="admin-content">
        <div class="admin-page-heading">
            <p class="admin-eyebrow">Data Wilayah</p>
            <h1>Kecamatan</h1>
            <p class="admin-page-subtitle">Kelola daftar kecamatan di Kabupaten Tuban.</p>
        </div>

        <section class="admin-list-panel" aria-label="Daftar kecamatan">
            <div class="admin-list-toolbar">
                <div class="admin-list-title">
                    <i class="bi bi-list-ul"></i>
                    Daftar Kecamatan
                    <span class="admin-count">{{ number_format($totalKecamatan ?? $kecamatan->count()) }} Kecamatan</span>
                </div>
                <div class="admin-list-actions">
                    <form method="GET" action="{{ route('admin.kecamatan.index') }}" style="margin: 0">
                        <label class="admin-search-wrap" for="searchInput">
                            <i class="bi bi-search" aria-hidden="true"></i>
                            <input class="admin-search" type="search" id="searchInput" name="search" value="{{ request('search') }}" placeholder="Cari nama kecamatan...">
                        </label>
                        <button class="visually-hidden" type="submit">Cari</button>
                    </form>
                    <a class="admin-primary-btn" href="{{ route('admin.kecamatan.create') }}"><i class="bi bi-plus-lg"></i> Tambah Kecamatan</a>
                </div>
            </div>

            <div class="admin-table-wrap">
                <table class="admin-table admin-table--kecamatan">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Kecamatan</th>
                            <th>Jumlah Desa</th>
                        </tr>
                    </thead>
                    <tbody id="kecamatanTable">
                    @forelse($kecamatan as $index => $item)
                    <tr data-id="{{ $item->id }}">
                        <td class="admin-row-number">{{ $kecamatan->firstItem() + $index }}</td>
                        <td>
                            <div class="admin-place-name">
                                <span class="admin-place-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </span>
                                <button type="button" class="kecamatan-toggle" aria-expanded="false" aria-controls="desaKecamatan{{ $item->id }}" onclick="toggleDesa({{ $item->id }}, this)">
                                    {{ $item->nama_kecamatan }}
                                    <i class="bi bi-chevron-down kecamatan-chevron" aria-hidden="true"></i>
                                </button>
                            </div>
                        </td>
                        <td>{{ $item->desa ? $item->desa->count() : 0 }} desa</td>
                    </tr>
                    <tr id="desaKecamatan{{ $item->id }}" class="desa-dropdown-row" data-parent-id="{{ $item->id }}">
                        <td colspan="3">
                            <div class="desa-dropdown-list">
                                @forelse($item->desa->sortBy('nama_desa') as $desa)
                                    <button type="button" class="desa-detail-button"
                                        data-id="{{ $desa->id }}"
                                        data-nama="{{ $desa->nama_desa }}"
                                        data-kecamatan="{{ $item->nama_kecamatan }}"
                                        data-kecamatan-id="{{ $item->id }}"
                                        data-kode="{{ $desa->kode_desa ?? '-' }}"
                                        data-jenis="{{ $desa->jenis ?? 'Desa' }}"
                                        data-website="{{ $desa->website ?? '' }}"
                                        data-youtube="{{ $desa->youtube ?? '' }}"
                                        data-instagram="{{ $desa->instagram ?? '' }}"
                                        data-facebook="{{ $desa->facebook ?? '' }}"
                                        data-tiktok="{{ $desa->tiktok ?? '' }}"
                                        data-whatsapp="{{ $desa->whatsapp ?? '' }}"
                                        onclick="showDesaDetail(this)">
                                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                                        {{ $desa->nama_desa }}
                                    </button>
                                @empty
                                    <span class="desa-empty">Belum ada data desa di kecamatan ini.</span>
                                @endforelse
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="admin-empty" colspan="3">
                            <div>
                                <i class="bi bi-inbox"></i>
                                Belum ada data kecamatan
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
            @include('admin.partials.pagination', ['paginator' => $kecamatan])
        </section>
        </main>
    </div>

    <div class="modal fade" id="modalDetailDesa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-houses-fill"></i><span id="detailNamaDesa">Detail Desa</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="detail-row"><div class="detail-label">Nama Desa</div><div class="detail-value" id="detailNama"></div></div>
                    <div class="detail-row"><div class="detail-label">Kecamatan</div><div class="detail-value" id="detailKecamatan"></div></div>
                    <div class="detail-row"><div class="detail-label">Jenis</div><div class="detail-value" id="detailJenis"></div></div>
                    <div class="detail-row"><div class="detail-label">Kode Desa</div><div class="detail-value" id="detailKodeDesa"></div></div>
                    <div class="detail-row" style="flex-direction: column; align-items: flex-start;">
                        <div class="detail-label" style="width: auto; margin-bottom: 8px;">Sosial Media &amp; Website</div>
                        <div class="detail-value" id="detailSosialMedia" style="width: 100%;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Tutup</button>
                    <button type="button" class="btn-modal-save" onclick="openEditDesaFromDetail()"><i class="bi bi-pencil"></i> Edit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditDesa" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Desa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <form id="formEditDesa">
                    @csrf
                    <input type="hidden" id="editDesaId" name="id">
                    <div class="modal-body">
                        <div class="section-divider">Informasi Dasar</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="editKecamatanId">Kecamatan <span class="required">*</span></label>
                                <select id="editKecamatanId" name="kecamatan_id" class="form-select-custom" required>
                                    @foreach($kecamatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kecamatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="editNamaDesa">Nama Desa/Kelurahan <span class="required">*</span></label>
                                <input type="text" id="editNamaDesa" name="nama_desa" class="form-input-custom" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="editKodeDesa">Kode Desa</label>
                                <input type="text" id="editKodeDesa" name="kode_desa" class="form-input-custom">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom" for="editJenis">Jenis <span class="required">*</span></label>
                                <select id="editJenis" name="jenis" class="form-select-custom" required>
                                    <option value="Desa">Desa</option>
                                    <option value="Kelurahan">Kelurahan</option>
                                </select>
                            </div>
                        </div>
                        <div class="section-divider">Website &amp; Sosial Media</div>
                        <div class="row">
                            <div class="col-md-6 mb-3"><label class="form-label-custom" for="editWebsite">Website</label><input type="url" id="editWebsite" name="website" class="form-input-custom"></div>
                            <div class="col-md-6 mb-3"><label class="form-label-custom" for="editYoutube">YouTube</label><input type="text" id="editYoutube" name="youtube" class="form-input-custom"></div>
                            <div class="col-md-6 mb-3"><label class="form-label-custom" for="editInstagram">Instagram</label><input type="text" id="editInstagram" name="instagram" class="form-input-custom"></div>
                            <div class="col-md-6 mb-3"><label class="form-label-custom" for="editFacebook">Facebook</label><input type="text" id="editFacebook" name="facebook" class="form-input-custom"></div>
                            <div class="col-md-6 mb-3"><label class="form-label-custom" for="editTiktok">TikTok</label><input type="text" id="editTiktok" name="tiktok" class="form-input-custom"></div>
                            <div class="col-md-6 mb-3"><label class="form-label-custom" for="editWhatsapp">WhatsApp</label><input type="text" id="editWhatsapp" name="whatsapp" class="form-input-custom"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal"><i class="bi bi-x-lg"></i> Batal</button>
                        <button type="button" class="btn-modal-delete" onclick="hapusDesaDariEdit()"><i class="bi bi-trash"></i> Hapus</button>
                        <button type="submit" class="btn-modal-save"><i class="bi bi-check-lg"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalDetailDesa, modalEditDesa;
        let selectedDesa = null;

        document.addEventListener('DOMContentLoaded', function() {
            modalDetailDesa = new bootstrap.Modal(document.getElementById('modalDetailDesa'));
            modalEditDesa = new bootstrap.Modal(document.getElementById('modalEditDesa'));
            document.getElementById('formEditDesa').addEventListener('submit', simpanDesaDariEdit);
            document.getElementById('searchInput').addEventListener('input', function() {
                const filter = this.value.toLowerCase();
                const rows = document.querySelectorAll('#kecamatanTable tr[data-id]');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                    if (!text.includes(filter)) {
                        const dropdown = document.getElementById(`desaKecamatan${row.dataset.id}`);
                        dropdown.classList.remove('is-open');
                        row.querySelector('.kecamatan-toggle').setAttribute('aria-expanded', 'false');
                    }
                });
            });
        });

        function toggleDesa(id, button) {
            const dropdown = document.getElementById(`desaKecamatan${id}`);
            const isOpen = dropdown.classList.toggle('is-open');
            button.setAttribute('aria-expanded', String(isOpen));
        }

        function showDesaDetail(button) {
            const data = button.dataset;
            selectedDesa = { ...data };
            document.getElementById('detailNamaDesa').textContent = data.nama;
            document.getElementById('detailNama').textContent = data.nama;
            document.getElementById('detailKecamatan').textContent = data.kecamatan;
            document.getElementById('detailKodeDesa').textContent = data.kode;

            const jenis = document.createElement('span');
            jenis.className = `badge-jenis ${data.jenis === 'Kelurahan' ? 'badge-kelurahan' : 'badge-desa'}`;
            jenis.textContent = data.jenis;
            document.getElementById('detailJenis').replaceChildren(jenis);

            const sosialMedia = document.getElementById('detailSosialMedia');
            sosialMedia.replaceChildren();
            const links = [
                ['website', 'Website', 'bi-globe', data.website],
                ['youtube', 'YouTube', 'bi-youtube', data.youtube],
                ['instagram', 'Instagram', 'bi-instagram', data.instagram],
                ['facebook', 'Facebook', 'bi-facebook', data.facebook],
                ['tiktok', 'TikTok', 'bi-tiktok', data.tiktok],
                ['whatsapp', 'WhatsApp', 'bi-whatsapp', data.whatsapp ? `https://wa.me/${data.whatsapp.replace(/\\D/g, '')}` : '']
            ];
            const linkList = document.createElement('div');
            linkList.className = 'social-links';
            links.filter(([, , , url]) => url).forEach(([type, label, icon, url]) => {
                const link = document.createElement('a');
                link.className = `social-link ${type}`;
                link.href = url;
                link.target = '_blank';
                link.rel = 'noopener noreferrer';
                link.innerHTML = `<i class="bi ${icon}" aria-hidden="true"></i>`;
                link.append(document.createTextNode(` ${label}`));
                linkList.append(link);
            });
            if (linkList.childElementCount) {
                sosialMedia.append(linkList);
            } else {
                const empty = document.createElement('span');
                empty.style.color = '#94a3b8';
                empty.textContent = 'Tidak ada data';
                sosialMedia.append(empty);
            }

            modalDetailDesa.show();
        }

        function openEditDesaFromDetail() {
            if (!selectedDesa) return;

            modalDetailDesa.hide();
            setTimeout(() => {
                document.getElementById('editDesaId').value = selectedDesa.id;
                document.getElementById('editKecamatanId').value = selectedDesa.kecamatanId;
                document.getElementById('editNamaDesa').value = selectedDesa.nama;
                document.getElementById('editKodeDesa').value = selectedDesa.kode === '-' ? '' : selectedDesa.kode;
                document.getElementById('editJenis').value = selectedDesa.jenis;
                document.getElementById('editWebsite').value = selectedDesa.website;
                document.getElementById('editYoutube').value = selectedDesa.youtube;
                document.getElementById('editInstagram').value = selectedDesa.instagram;
                document.getElementById('editFacebook').value = selectedDesa.facebook;
                document.getElementById('editTiktok').value = selectedDesa.tiktok;
                document.getElementById('editWhatsapp').value = selectedDesa.whatsapp;
                modalEditDesa.show();
            }, 300);
        }

        async function simpanDesaDariEdit(event) {
            event.preventDefault();
            const id = document.getElementById('editDesaId').value;
            const formData = new FormData(event.currentTarget);
            formData.append('_method', 'PUT');

            try {
                const response = await fetch(`/admin/desa/${encodeURIComponent(id)}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: formData
                });
                const data = await response.json();
                if (!response.ok) {
                    const message = data.errors ? Object.values(data.errors).flat().join('\n') : (data.message || 'Gagal memperbarui data desa.');
                    alert(message);
                    return;
                }

                modalEditDesa.hide();
                location.reload();
            } catch (error) {
                alert('Terjadi kesalahan saat memperbarui data desa.');
            }
        }

        async function hapusDesaDariEdit() {
            const id = document.getElementById('editDesaId').value;
            const nama = document.getElementById('editNamaDesa').value;
            if (!confirm(`Yakin ingin menghapus desa "${nama}"?`)) return;

            try {
                const response = await fetch(`/admin/desa/${encodeURIComponent(id)}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ _method: 'DELETE' })
                });
                const data = await response.json();
                if (!response.ok || !data.success) {
                    alert(data.message || 'Gagal menghapus data desa.');
                    return;
                }

                location.reload();
            } catch (error) {
                alert('Terjadi kesalahan saat menghapus data desa.');
            }
        }
    </script>
</body>
</html>