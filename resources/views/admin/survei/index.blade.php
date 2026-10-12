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

        /* Card Modern */
        .card-modern {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            margin-bottom: 24px;
        }
        .card-header-modern {
            padding: 20px 24px;
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
        .card-title-modern i { color: #1e3a8a; font-size: 18px; }
        .badge-count {
            background: #1e3a8a;
            color: white;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Filter Toolbar */
        .search-box {
            position: relative;
            min-width: 240px;
        }
        .search-box input {
            width: 100%;
            padding: 8px 14px 8px 34px;
            border: 1px solid #e2e8f0;
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

        /* Table */
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th {
            padding: 14px 20px;
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
            padding: 16px 20px;
            font-size: 13px;
            color: #1e293b;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
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

        @media (max-width: 992px) { .main-content { margin-left: 0 !important; width: 100% !important; } }
        @media (max-width: 768px) {
            .top-header { padding: 0 14px; min-height: 56px; gap: 8px; }
            .breadcrumb-simple { font-size: 11px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: calc(100% - 150px); }
            .card-header-modern { flex-direction: column; align-items: stretch; gap: 12px; }
            .search-box { min-width: 100%; }
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
            <div class="page-header">
                <div class="page-label">LAYANAN PUBLIK</div>
                <h1 class="page-title">Survei Kepuasan</h1>
                <p class="page-subtitle">Kelola dan pantau data masukan serta survei kepuasan masyarakat terhadap layanan website.</p>
            </div>

            @if(session('success'))
            <div class="alert-banner alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button class="close-btn" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            <!-- CARD TABEL SURVEI SIMPEL -->
            <div class="card-modern">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <i class="bi bi-chat-heart-fill"></i>
                        Daftar Survei Kepuasan
                        <span class="badge-count">{{ $surveis->total() }} Data</span>
                    </div>

                    <form method="GET" action="{{ route('admin.survei.index') }}" class="search-box">
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

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th style="width: 150px;">Waktu</th>
                                <th style="width: 180px;">Nama</th>
                                <th style="width: 180px;">Penilaian</th>
                                <th>Kritik & Saran</th>
                                <th style="width: 80px; text-align: center;">Aksi</th>
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
                                    <div class="rating-stars">
                                        @for($s = 1; $s <= 5; $s++)
                                            @if($s <= $survei->rating)
                                                <i class="bi bi-star-fill"></i>
                                            @else
                                                <i class="bi bi-star-fill empty"></i>
                                            @endif
                                        @endfor
                                        <span class="rating-text">({{ $survei->rating }}/5)</span>
                                    </div>
                                </td>
                                <td>
                                    @if($survei->message)
                                        <span style="color: #334155;">{{ $survei->message }}</span>
                                    @else
                                        <span style="color: #94a3b8; font-style: italic;">(Tidak ada catatan)</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <form method="POST" action="{{ route('admin.survei.destroy', $survei->id) }}" onsubmit="return confirm('Hapus data survei ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
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

</body>
</html>
