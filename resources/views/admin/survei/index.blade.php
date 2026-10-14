<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Survei Kepuasan - Portal Desa Digital</title>
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
        .page-subtitle { font-size: 13px; color: #64748b; }

        /* Summary Stat Cards */
        .stats-summary-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-summary-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 16px 20px;
            display: flex;
            align-items: center;
            gap: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .stat-summary-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        }
        .stat-summary-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            flex-shrink: 0;
        }
        .icon-blue { background: #eff6ff; color: #2563eb; }
        .icon-amber { background: #fef3c7; color: #d97706; }
        .icon-green { background: #dcfce7; color: #16a34a; }
        .icon-purple { background: #f3e8ff; color: #9333ea; }
        .stat-summary-info .label {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        .stat-summary-info .value {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.1;
        }
        .stat-summary-info .subtext {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Card Modern */
        .card-modern {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.02);
        }
        .card-header-modern {
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }
        .card-title-modern {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-title-modern i { color: #db2777; font-size: 18px; }
        .badge-count {
            background: #1e3a8a;
            color: white;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Filter Toolbar */
        .filter-toolbar {
            padding: 14px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }
        .filter-pills-row {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .filter-pill {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            background: white;
            border: 1px solid #cbd5e1;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .filter-pill:hover {
            border-color: #2563eb;
            color: #2563eb;
            background: #eff6ff;
        }
        .filter-pill.active {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .search-box {
            position: relative;
            min-width: 240px;
        }
        .search-box input {
            width: 100%;
            padding: 7px 14px 7px 34px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 12.5px;
            color: #1e293b;
            background: white;
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

        .btn-export-csv {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            background: #10b981;
            color: white;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-export-csv:hover {
            background: #059669;
            color: white;
            transform: translateY(-1px);
        }

        /* Table */
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
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #fbfcfe; }
        .table-modern tbody tr:last-child td { border-bottom: none; }

        .rating-stars {
            display: inline-flex;
            align-items: center;
            gap: 2px;
            color: #f59e0b;
            font-size: 13px;
        }
        .rating-stars i.empty { color: #cbd5e1; }
        .rating-text {
            display: inline-block;
            margin-left: 6px;
            font-size: 11.5px;
            font-weight: 600;
            color: #64748b;
        }

        .rating-pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 11.5px;
            font-weight: 700;
        }
        .rating-badge-5 { background: #dcfce7; color: #15803d; }
        .rating-badge-4 { background: #ecfdf5; color: #059669; }
        .rating-badge-3 { background: #fef9c3; color: #a16207; }
        .rating-badge-2 { background: #ffedd5; color: #c2410c; }
        .rating-badge-1 { background: #fee2e2; color: #b91c1c; }

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
        .btn-tinjau {
            color: #2563eb;
            border-color: #bfdbfe;
            background: #eff6ff;
        }
        .btn-tinjau:hover {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        .btn-delete:hover { color: #dc2626; border-color: #dc2626; background: #fef2f2; }

        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 14px; display: block; color: #cbd5e1; }
        .empty-state h4 { font-size: 16px; font-weight: 700; color: #475569; margin-bottom: 6px; }
        .empty-state p { font-size: 13px; color: #94a3b8; max-width: 420px; margin: 0 auto; line-height: 1.5; }

        .alert-banner {
            padding: 14px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 600;
        }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }

        @media (max-width: 992px) {
            .main-content { margin-left: 0 !important; width: 100% !important; }
            .stats-summary-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .top-header { padding: 0 14px; min-height: 56px; gap: 8px; }
            .breadcrumb-simple { font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: calc(100% - 150px); }
            .card-header-modern, .filter-toolbar { flex-direction: column; align-items: stretch; gap: 12px; }
            .search-box { min-width: 100%; }
            .page-body { padding: 16px; }
            .table-modern { min-width: 700px; }
            .page-title { font-size: 22px; }
        }
        @media (max-width: 576px) {
            .stats-summary-grid { grid-template-columns: 1fr; }
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
                    <div class="page-label">LAYANAN PUBLIK & PENINJAUAN</div>
                    <h1 class="page-title">Survei Kepuasan</h1>
                    <p class="page-subtitle">Kelola dan tinjau seluruh data masukan serta penilaian kepuasan masyarakat terhadap layanan website Desa Digital.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('survei.public') }}" target="_blank" class="btn btn-sm btn-outline-primary" style="font-size: 12.5px; border-radius: 8px; padding: 7px 14px; font-weight: 600;">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka Form Survei Publik
                    </a>
                    <a href="{{ route('admin.survei.export', request()->query()) }}" class="btn-export-csv" title="Ekspor data hasil survei kepuasan ke format file CSV">
                        <i class="bi bi-download"></i> Ekspor CSV
                    </a>
                </div>
            </div>

            @if(session('success'))
            <div class="alert-banner alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button class="close-btn" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <!-- 4 SUMMARY CARDS STATISTIK KEPUSAN -->
            <div class="stats-summary-grid">
                <div class="stat-summary-card">
                    <div class="stat-summary-icon icon-blue">
                        <i class="bi bi-chat-square-text-fill"></i>
                    </div>
                    <div class="stat-summary-info">
                        <div class="label">Total Tanggapan</div>
                        <div class="value">{{ number_format($totalSurvei, 0, ',', '.') }}</div>
                        <div class="subtext">Responden terdaftar</div>
                    </div>
                </div>

                <div class="stat-summary-card">
                    <div class="stat-summary-icon icon-amber">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="stat-summary-info">
                        <div class="label">Rata-Rata Skor</div>
                        <div class="value">{{ $avgRating }} <span style="font-size: 14px; color: #94a3b8; font-weight: 500;">/ 5.0</span></div>
                        <div class="subtext">
                            @for($i=1; $i<=5; $i++)
                                <i class="bi bi-star-fill {{ $i <= round($avgRating) ? 'text-warning' : 'text-secondary opacity-50' }}" style="font-size: 11px;"></i>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="stat-summary-card">
                    <div class="stat-summary-icon icon-green">
                        <i class="bi bi-emoji-smile-fill"></i>
                    </div>
                    <div class="stat-summary-info">
                        <div class="label">Tingkat Kepuasan</div>
                        <div class="value">{{ $persentaseKepuasan }}%</div>
                        <div class="subtext">Responden puas (⭐ 4-5)</div>
                    </div>
                </div>

                <div class="stat-summary-card">
                    <div class="stat-summary-icon icon-purple">
                        <i class="bi bi-calendar-check-fill"></i>
                    </div>
                    <div class="stat-summary-info">
                        <div class="label">Masuk Hari Ini</div>
                        <div class="value">{{ number_format($surveiHariIni, 0, ',', '.') }}</div>
                        <div class="subtext">{{ \Carbon\Carbon::today()->translatedFormat('d M Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- CARD TABEL SURVEI DENGAN FILTER & PENINJAUAN -->
            <div class="card-modern">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <i class="bi bi-chat-heart-fill"></i>
                        Daftar Survei Kepuasan
                        <span class="badge-count">{{ $surveis->total() }} Data</span>
                    </div>

                    <form method="GET" action="{{ route('admin.survei.index') }}" class="search-box">
                        @if($ratingFilter)
                            <input type="hidden" name="rating" value="{{ $ratingFilter }}">
                        @endif
                        @if($timeFilter)
                            <input type="hidden" name="time" value="{{ $timeFilter }}">
                        @endif
                        <i class="bi bi-search"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Cari masukan atau nama..."
                            autocomplete="off"
                        >
                    </form>
                </div>

                <!-- FILTER TOOLBAR (RATING & WAKTU) -->
                <div class="filter-toolbar">
                    <div class="filter-pills-row">
                        <span style="font-size: 12px; font-weight: 700; color: #475569; margin-right: 4px;">Filter Nilai:</span>
                        <a href="{{ route('admin.survei.index', array_filter(['search' => $search, 'time' => $timeFilter])) }}" class="filter-pill {{ empty($ratingFilter) ? 'active' : '' }}">
                            Semua Rating
                        </a>
                        @for($r = 5; $r >= 1; $r--)
                        <a href="{{ route('admin.survei.index', array_filter(['search' => $search, 'time' => $timeFilter, 'rating' => $r])) }}" class="filter-pill {{ $ratingFilter == $r ? 'active' : '' }}">
                            ⭐ {{ $r }}
                        </a>
                        @endfor
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <span style="font-size: 12px; font-weight: 700; color: #475569;">Waktu:</span>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('admin.survei.index', array_filter(['search' => $search, 'rating' => $ratingFilter])) }}" class="btn btn-outline-secondary {{ empty($timeFilter) ? 'active fw-bold' : '' }}" style="font-size: 11.5px;">Semua</a>
                            <a href="{{ route('admin.survei.index', array_filter(['search' => $search, 'rating' => $ratingFilter, 'time' => 'today'])) }}" class="btn btn-outline-secondary {{ $timeFilter === 'today' ? 'active fw-bold' : '' }}" style="font-size: 11.5px;">Hari Ini</a>
                            <a href="{{ route('admin.survei.index', array_filter(['search' => $search, 'rating' => $ratingFilter, 'time' => 'week'])) }}" class="btn btn-outline-secondary {{ $timeFilter === 'week' ? 'active fw-bold' : '' }}" style="font-size: 11.5px;">7 Hari</a>
                            <a href="{{ route('admin.survei.index', array_filter(['search' => $search, 'rating' => $ratingFilter, 'time' => 'month'])) }}" class="btn btn-outline-secondary {{ $timeFilter === 'month' ? 'active fw-bold' : '' }}" style="font-size: 11.5px;">30 Hari</a>
                        </div>

                        @if($search || $ratingFilter || $timeFilter)
                        <a href="{{ route('admin.survei.index') }}" class="btn btn-sm btn-link text-danger text-decoration-none" style="font-size: 12px;">
                            <i class="bi bi-x-circle me-1"></i> Reset
                        </a>
                        @endif
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 140px;">Waktu</th>
                                <th style="width: 190px;">Responden</th>
                                <th style="width: 180px;">Penilaian</th>
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
                                    <div style="font-weight: 600; color: #1e293b;">
                                        {{ $survei->display_name }}
                                    </div>
                                    <small style="color: #64748b; font-size: 11px;">
                                        {{ $survei->display_pekerjaan }}
                                    </small>
                                </td>
                                <td>
                                    <div class="rating-pill-badge rating-badge-{{ $survei->rating }} mb-1">
                                        <span>{{ $survei->rating_emoji }}</span>
                                        <span>{{ $survei->rating }}/5 • {{ $survei->rating_label }}</span>
                                    </div>
                                    <div class="rating-stars d-block">
                                        @for($s = 1; $s <= 5; $s++)
                                            @if($s <= $survei->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star-fill empty"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>
                                    @if($survei->message)
                                        <div style="color: #334155; line-height: 1.45; max-width: 480px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" title="{{ $survei->message }}">
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
                                        <i class="bi bi-chat-square-heart"></i>
                                        <h4>Belum Ada Data Survei</h4>
                                        <p>Data survei kepuasan yang dikirimkan oleh pengunjung atau masyarakat akan muncul di sini.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination jika ada data lebih dari 1 halaman --}}
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
                        <i class="bi bi-chat-heart-fill text-danger"></i> Tinjau Masukan Survei Kepuasan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <div class="p-3 mb-3" style="background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <h6 class="mb-0 fw-bold" id="detailModalNama" style="color: #0f172a; font-size: 15px;">-</h6>
                                <small class="text-muted" id="detailModalPekerjaan" style="font-size: 12px;">-</small>
                            </div>
                            <span class="badge rounded-pill" id="detailModalRatingBadge" style="font-size: 12px; padding: 6px 12px;">
                                <span id="detailModalEmoji">⭐</span> <span id="detailModalRating">5</span>/5
                            </span>
                        </div>
                        <div class="text-muted" style="font-size: 11.5px;">
                            <i class="bi bi-clock me-1"></i> <span id="detailModalWaktu">-</span>
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
                        <i class="bi bi-printer me-1"></i> Cetak / Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const detailModalEl = document.getElementById('modalDetailSurvei');
            if (detailModalEl && window.bootstrap) {
                const modal = new bootstrap.Modal(detailModalEl);
                document.querySelectorAll('.btn-open-detail').forEach(btn => {
                    btn.addEventListener('click', function () {
                        document.getElementById('detailModalNama').textContent = this.dataset.nama || 'Anonim';
                        document.getElementById('detailModalPekerjaan').textContent = this.dataset.pekerjaan || 'Masyarakat Umum';
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
