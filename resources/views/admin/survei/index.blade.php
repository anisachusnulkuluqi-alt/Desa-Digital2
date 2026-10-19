<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Survei Kepuasan - Portal Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; }

        .main-content { margin-left: 260px; min-height: 100vh; }

        .top-header {
            min-height: 62px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .breadcrumb-simple { font-size: 13px; color: #64748b; display: flex; align-items: center; gap: 8px; }
        .breadcrumb-simple a { color: #64748b; text-decoration: none; }
        .breadcrumb-simple a:hover { color: #1e3a8a; }
        .breadcrumb-simple .separator { color: #cbd5e1; }
        .breadcrumb-simple .active { color: #1e293b; font-weight: 600; }

        .page-body { padding: 28px; }
        .page-header { margin-bottom: 24px; }
        .page-label { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
        .page-title { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 6px; }
        .page-subtitle { font-size: 13px; color: #64748b; margin: 0; }

        /* Card & Table */
        .table-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }
        .table-header {
            padding: 16px 22px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }
        .table-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .table-title i { color: #2563eb; font-size: 17px; }
        .badge-count {
            background: #1e3a8a;
            color: white;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 10px;
            font-weight: 600;
        }

        .table-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .search-box {
            position: relative;
        }
        .search-box input {
            width: 220px;
            height: 38px;
            padding: 0 12px 0 34px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }
        .search-box input:focus {
            background: white;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .search-box i {
            position: absolute;
            left: 11px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
        }

        .filter-select {
            height: 38px;
            padding: 0 28px 0 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            color: #334155;
            background-color: #f8fafc;
            font-weight: 500;
            outline: none;
            cursor: pointer;
        }
        .filter-select:focus {
            border-color: #2563eb;
            background-color: white;
        }

        .btn-header-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
        }

        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th {
            padding: 13px 20px;
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .table-modern td {
            padding: 14px 20px;
            font-size: 13px;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }

        .rating-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .btn-action {
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
            background: white;
            color: #64748b;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-action:hover { background: #f8fafc; color: #1e3a8a; border-color: #1e3a8a; }
        .btn-tinjau { color: #2563eb; border-color: #bfdbfe; background: #eff6ff; }
        .btn-tinjau:hover { background: #2563eb; color: white; border-color: #2563eb; }
        .btn-delete:hover { color: #dc2626; border-color: #dc2626; background: #fef2f2; }

        .empty-state {
            text-align: center;
            padding: 56px 20px;
            color: #94a3b8;
        }
        .empty-state i {
            font-size: 40px;
            margin-bottom: 10px;
            display: block;
            color: #cbd5e1;
        }

        .alert-banner {
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
            background: #dcfce7;
            border: 1px solid #86efac;
            color: #166534;
        }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }

        @media (max-width: 992px) {
            .main-content { margin-left: 0 !important; width: 100% !important; }
        }
        @media (max-width: 768px) {
            .top-header { padding: 0 14px; min-height: 56px; gap: 8px; }
            .breadcrumb-simple { font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: calc(100% - 150px); }
            .table-header { flex-direction: column; align-items: stretch; gap: 12px; }
            .table-actions { flex-direction: column; align-items: stretch; }
            .search-box input, .filter-select { width: 100%; }
            .page-body { padding: 16px; }
            .table-modern { min-width: 650px; }
            .page-title { font-size: 22px; }
        }
    </style>
</head>
<body>

    @include('admin.partials.sidebar')

    <div class="main-content">
        <header class="top-header">
            <div class="breadcrumb-simple">
                <a href="{{ route('dashboard') }}">Admin</a>
                <span class="separator">/</span>
                <span class="active">Survei Kepuasan</span>
            </div>
            @include('admin.partials.header-actions')
        </header>

        <div class="page-body">
            <div class="page-header d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div>
                    <div class="page-label">LAYANAN PUBLIK</div>
                    <h1 class="page-title">Survei Kepuasan</h1>
                    <p class="page-subtitle">Kelola data masukan dan penilaian kepuasan masyarakat terhadap layanan website.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.survei.export', request()->query()) }}" class="btn btn-sm btn-outline-success btn-header-action" title="Ekspor data hasil survei ke CSV">
                        <i class="bi bi-download"></i> Ekspor CSV
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="alert-banner">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="close-btn" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <!-- TABEL DAFTAR SURVEI KEPUASAN -->
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title">
                        <i class="bi bi-chat-heart-fill"></i>
                        Daftar Survei Kepuasan
                        <span class="badge-count">{{ $surveis->total() }} Data</span>
                    </div>

                    <form method="GET" action="{{ route('admin.survei.index') }}" class="table-actions">
                        <select name="rating" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Rating</option>
                            @for($r = 5; $r >= 1; $r--)
                                <option value="{{ $r }}" {{ $ratingFilter == $r ? 'selected' : '' }}>⭐ {{ $r }}</option>
                            @endfor
                        </select>

                        <select name="time" class="filter-select" onchange="this.form.submit()">
                            <option value="">Semua Waktu</option>
                            <option value="today" {{ $timeFilter === 'today' ? 'selected' : '' }}>Hari Ini</option>
                            <option value="week" {{ $timeFilter === 'week' ? 'selected' : '' }}>7 Hari</option>
                            <option value="month" {{ $timeFilter === 'month' ? 'selected' : '' }}>30 Hari</option>
                        </select>

                        @if($ratingFilter || $timeFilter)
                            <a href="{{ route('admin.survei.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none px-1" style="font-size: 12.5px;">
                                <i class="bi bi-x-circle me-1"></i> Reset
                            </a>
                        @endif
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 130px;">Waktu</th>
                                <th style="width: 180px;">Responden</th>
                                <th style="width: 140px;">Penilaian</th>
                                <th>Kritik & Masukan</th>
                                <th style="width: 120px; text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($surveis as $index => $survei)
                            <tr>
                                <td>{{ $surveis->firstItem() + $index }}</td>
                                <td>
                                    <div style="font-size: 12.5px; font-weight: 600;">
                                        {{ $survei->created_at ? $survei->created_at->format('d/m/Y') : '-' }}
                                    </div>
                                    <small style="color: #94a3b8; font-size: 11px;">
                                        {{ $survei->created_at ? $survei->created_at->format('H:i') . ' WIB' : '' }}
                                    </small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width: 32px; height: 32px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; border: 1px solid #bfdbfe;">
                                            <i class="bi {{ $survei->device_icon }}"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight: 700; color: #1e293b; font-size: 13px; line-height: 1.25;">
                                                {{ $survei->device_label }}
                                            </div>
                                            <small style="color: #64748b; font-size: 11px;">
                                                @if($survei->nama)
                                                    {{ $survei->nama }} {{ $survei->pekerjaan ? '• ' . $survei->pekerjaan : '' }}
                                                @else
                                                    {{ $survei->browser_label }} • Anonim
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="rating-badge rating-badge-{{ $survei->rating }}">
                                        <span>⭐ {{ $survei->rating }}/5</span>
                                    </div>
                                </td>
                                <td>
                                    @if($survei->message)
                                        <div style="color: #334155; line-height: 1.45; max-width: 460px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" title="{{ $survei->message }}">
                                            {{ $survei->message }}
                                        </div>
                                    @else
                                        <span style="color: #94a3b8; font-style: italic; font-size: 12px;">(Hanya memberikan rating bintang)</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <button
                                            type="button"
                                            class="btn-action btn-tinjau btn-open-detail"
                                            data-nama="{{ $survei->display_name }}"
                                            data-pekerjaan="{{ $survei->display_pekerjaan }}"
                                            data-device="{{ $survei->device_label }}"
                                            data-device-icon="{{ $survei->device_icon }}"
                                            data-browser="{{ $survei->browser_label }}"
                                            data-rating="{{ $survei->rating }}"
                                            data-rating-label="{{ $survei->rating_label }}"
                                            data-rating-emoji="{{ $survei->rating_emoji }}"
                                            data-waktu="{{ $survei->created_at ? $survei->created_at->translatedFormat('l, d F Y - H:i') . ' WIB' : '-' }}"
                                            data-pesan="{{ $survei->message ?: 'Tidak ada pesan tertulis dari responden.' }}"
                                            title="Tinjau detail responden dan kritik/saran"
                                        >
                                            <i class="bi bi-eye"></i> Tinjau
                                        </button>
                                        <form method="POST" action="{{ route('admin.survei.destroy', $survei->id) }}" onsubmit="return confirm('Hapus data tanggapan survei ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <p class="mb-0 fw-semibold text-secondary">Belum ada data survei.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @include('admin.partials.pagination', ['paginator' => $surveis])
            </div>
        </div>
    </div>

    <!-- Modal Peninjauan Detail Survei -->
    <div class="modal fade" id="modalDetailSurvei" tabindex="-1" aria-labelledby="modalDetailSurveiLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.15);">
                <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #e2e8f0; padding: 16px 20px;">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalDetailSurveiLabel" style="font-size: 15px; font-weight: 800; color: #0f172a;">
                        <i class="bi bi-chat-heart-fill text-primary"></i> Detail Masukan Survei
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 38px; height: 38px; border-radius: 8px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 18px; border: 1px solid #bfdbfe; flex-shrink: 0;">
                                    <i id="detailModalDeviceIcon" class="bi bi-laptop"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold" id="detailModalDevice" style="color: #0f172a; font-size: 14.5px;">-</h6>
                                    <small class="text-muted" id="detailModalBrowser" style="font-size: 12px;">-</small>
                                </div>
                            </div>
                            <span class="badge rounded-pill" id="detailModalRatingBadge" style="font-size: 12px; padding: 6px 12px;">
                                <span id="detailModalEmoji">⭐</span> <span id="detailModalRating">5</span>/5
                            </span>
                        </div>
                        <div class="pt-2 border-top mt-2 d-flex flex-wrap gap-3 text-muted" style="font-size: 11.5px;">
                            <div><i class="bi bi-person me-1 text-primary"></i> <span id="detailModalNama">-</span></div>
                            <div><i class="bi bi-briefcase me-1 text-primary"></i> <span id="detailModalPekerjaan">-</span></div>
                            <div><i class="bi bi-clock me-1 text-primary"></i> <span id="detailModalWaktu">-</span></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Tingkat Kepuasan</label>
                        <div id="detailModalRatingStars" class="text-warning fs-5"></div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label text-muted fw-bold" style="font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px;">Kritik, Saran & Masukan Responden</label>
                        <div id="detailModalPesan" class="p-3 rounded" style="background: #f1f5f9; font-size: 13.5px; line-height: 1.6; color: #1e293b; min-height: 90px; white-space: pre-wrap;">-</div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 12px 20px; background: #f8fafc;">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" style="font-size: 12.5px; border-radius: 8px;">Tutup</button>
                    <button type="button" class="btn btn-sm btn-primary" onclick="window.print()" style="font-size: 12.5px; border-radius: 8px;">
                        <i class="bi bi-printer me-1"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-sidebar-toggle.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detailModalEl = document.getElementById('modalDetailSurvei');
            if (detailModalEl && window.bootstrap) {
                const modal = new bootstrap.Modal(detailModalEl);
                document.querySelectorAll('.btn-open-detail').forEach(btn => {
                    btn.addEventListener('click', function () {
                        document.getElementById('detailModalNama').textContent = this.dataset.nama || 'Anonim';
                        document.getElementById('detailModalPekerjaan').textContent = this.dataset.pekerjaan || 'Masyarakat Umum';
                        document.getElementById('detailModalDevice').textContent = this.dataset.device || 'Perangkat Web';
                        document.getElementById('detailModalBrowser').textContent = this.dataset.browser || 'Browser Web';
                        
                        const iconEl = document.getElementById('detailModalDeviceIcon');
                        if (iconEl) {
                            iconEl.className = 'bi ' + (this.dataset.deviceIcon || 'bi-laptop');
                        }

                        document.getElementById('detailModalWaktu').textContent = this.dataset.waktu || '-';
                        document.getElementById('detailModalEmoji').textContent = this.dataset.ratingEmoji || '⭐';
                        document.getElementById('detailModalRating').textContent = this.dataset.rating || '5';
                        document.getElementById('detailModalPesan').textContent = this.dataset.pesan || '-';

                        const rating = parseInt(this.dataset.rating || 5);
                        let starsHtml = '';
                        for (let i = 1; i <= 5; i++) {
                            starsHtml += i <= rating ? '<i class="bi bi-star-fill me-1"></i>' : '<i class="bi bi-star me-1 text-secondary opacity-50"></i>';
                        }
                        starsHtml += ` <span class="ms-2 fs-6 text-dark fw-bold">${this.dataset.ratingLabel || ''}</span>`;
                        document.getElementById('detailModalRatingStars').innerHTML = starsHtml;

                        const badge = document.getElementById('detailModalRatingBadge');
                        badge.className = 'badge rounded-pill ' + (rating >= 4 ? 'bg-success' : (rating === 3 ? 'bg-warning text-dark' : 'bg-danger'));

                        modal.show();
                    });
                });
            }
        });
    </script>

</body>
</html>
