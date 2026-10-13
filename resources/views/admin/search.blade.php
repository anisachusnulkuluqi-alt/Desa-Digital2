<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hasil Pencarian: {{ $searchTerm }} - Portal Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; }

        .search-results-summary {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 18px 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .search-input-group {
            position: relative;
            max-width: 540px;
            width: 100%;
        }

        .search-input-group input {
            width: 100%;
            height: 44px;
            padding: 0 16px 0 44px;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            font-size: 14px;
            background: #f8fafc;
            color: #0f172a;
            transition: all 0.2s;
        }

        .search-input-group input:focus {
            outline: none;
            border-color: #2563eb;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .search-input-group button {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #64748b;
            font-size: 16px;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .category-filter-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 24px;
        }

        .category-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all 0.2s;
        }

        .category-pill:hover, .category-pill.active {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #1d4ed8;
        }

        .category-pill .pill-count {
            background: #e2e8f0;
            color: #475569;
            font-size: 11px;
            padding: 2px 7px;
            border-radius: 10px;
        }

        .category-pill:hover .pill-count, .category-pill.active .pill-count {
            background: #2563eb;
            color: white;
        }

        .result-group-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            overflow: hidden;
        }

        .result-group-header {
            padding: 14px 20px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .result-group-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .result-group-title i {
            color: #2563eb;
            font-size: 16px;
        }

        .result-item-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .result-item {
            padding: 14px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            transition: background 0.15s;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-item:hover {
            background: #f8fafc;
        }

        .result-item-main {
            display: flex;
            align-items: center;
            gap: 14px;
            min-width: 0;
            flex: 1;
        }

        .result-item-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .result-item-details {
            min-width: 0;
            flex: 1;
        }

        .result-item-title {
            font-size: 14px;
            font-weight: 600;
            color: #0f172a;
            margin-bottom: 3px;
            text-decoration: none;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .result-item-title:hover {
            color: #2563eb;
        }

        .result-item-meta {
            font-size: 12px;
            color: #64748b;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .result-item-action {
            flex-shrink: 0;
        }

        .btn-view-result {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 8px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1px solid #bfdbfe;
            transition: all 0.2s;
        }

        .btn-view-result:hover {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .empty-results {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 60px 24px;
            text-align: center;
            color: #64748b;
        }

        .empty-results-icon {
            font-size: 48px;
            color: #cbd5e1;
            margin-bottom: 16px;
        }

        .empty-results h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .empty-results p {
            font-size: 14px;
            max-width: 480px;
            margin: 0 auto 20px;
        }

        @media (max-width: 768px) {
            .result-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .result-item-action {
                width: 100%;
            }
            .btn-view-result {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @include('admin.partials.list-page-styles')
</head>
<body>
    @include('admin.partials.sidebar', ['activeMenu' => ''])

    <div class="admin-main">
        <header class="admin-topbar">
            <div class="admin-breadcrumb">
                <a href="{{ route('dashboard') }}" style="color: inherit; text-decoration: none;">Admin</a>
                <span aria-hidden="true">/</span>
                <strong>Pencarian</strong>
            </div>
            @include('admin.partials.header-actions')
        </header>

        <main class="admin-content">
            <div class="admin-page-heading">
                <p class="admin-eyebrow">Pencarian Seluruh Sistem</p>
                <h1>Hasil Pencarian</h1>
                <p class="admin-page-subtitle">Menampilkan seluruh data & atribut yang cocok di semua modul portal Desa Digital.</p>
            </div>

            <!-- Search Bar Refinement -->
            <div class="search-results-summary">
                <form action="{{ route('admin.search') }}" method="GET" class="search-input-group" role="search">
                    <button type="submit" aria-label="Cari">
                        <i class="bi bi-search"></i>
                    </button>
                    <input
                        type="search"
                        name="q"
                        value="{{ $searchTerm }}"
                        placeholder="Ketik kata kunci untuk mencari di semua modul & atribut..."
                        required
                        autofocus
                    >
                </form>
                <div>
                    <span class="badge" style="background: #2563eb; font-size: 13px; font-weight: 600; padding: 8px 14px; border-radius: 8px;">
                        <i class="bi bi-collection-fill me-1"></i>
                        {{ number_format($totalResults) }} Hasil Ditemukan
                    </span>
                </div>
            </div>

            @if($totalResults > 0)
                <!-- Category Quick Navigation Pills -->
                <div class="category-filter-pills" role="navigation" aria-label="Kategori Pencarian">
                    <a href="#all" class="category-pill active">
                        Semua Hasil
                        <span class="pill-count">{{ $totalResults }}</span>
                    </a>
                    @foreach($groupedResults as $groupName => $items)
                        <a href="#group-{{ \Illuminate\Support\Str::slug($groupName) }}" class="category-pill">
                            {{ $groupName }}
                            <span class="pill-count">{{ count($items) }}</span>
                        </a>
                    @endforeach
                </div>

                <!-- Grouped Results -->
                <div id="all">
                    @foreach($groupedResults as $groupName => $items)
                        <section class="result-group-card" id="group-{{ \Illuminate\Support\Str::slug($groupName) }}">
                            <div class="result-group-header">
                                <div class="result-group-title">
                                    <i class="{{ $items[0]['icon'] ?? 'bi-folder-fill' }}"></i>
                                    <span>{{ $groupName }}</span>
                                </div>
                                <span class="badge" style="background: #e2e8f0; color: #334155; font-size: 11px; padding: 4px 10px; border-radius: 6px; font-weight: 600;">
                                    {{ count($items) }} data
                                </span>
                            </div>
                            <ul class="result-item-list">
                                @foreach($items as $item)
                                    <li class="result-item">
                                        <div class="result-item-main">
                                            <div class="result-item-icon">
                                                <i class="{{ $item['icon'] ?? 'bi-card-text' }}"></i>
                                            </div>
                                            <div class="result-item-details">
                                                <a href="{{ $item['url'] }}" class="result-item-title">
                                                    {{ $item['title'] }}
                                                </a>
                                                <div class="result-item-meta">
                                                    <span class="badge bg-light text-dark border me-1" style="font-size: 10px; font-weight: 600;">
                                                        {{ $item['type'] ?? $groupName }}
                                                    </span>
                                                    @if(!empty($item['description']))
                                                        <span>{{ $item['description'] }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="result-item-action">
                                            <a href="{{ $item['url'] }}" class="btn-view-result">
                                                Buka / Kelola
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </section>
                    @endforeach
                </div>
            @else
                <div class="empty-results">
                    <div class="empty-results-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h3>Tidak Ada Hasil Ditemukan</h3>
                    <p>Tidak ditemukan data atau atribut yang cocok dengan kata kunci <strong>"{{ $searchTerm }}"</strong> di modul manapun.</p>
                    <a href="{{ route('dashboard') }}" class="btn-view-result" style="padding: 9px 18px; font-size: 13px;">
                        <i class="bi bi-arrow-left"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            @endif
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/admin-sidebar-toggle.js') }}"></script>
</body>
</html>

