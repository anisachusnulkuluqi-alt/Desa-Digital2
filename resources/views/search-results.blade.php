<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Desa Digital Tuban</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/global-search.css') }}">
    <style>
        :root {
            --ink: #102231;
            --muted: #61717d;
            --paper: #f1f7f7;
            --line: #d9e4e5;
            --teal: #087e83;
            --coral: #e66a4e;
        }

        * { box-sizing: border-box; }
        body { margin: 0; background: var(--paper); color: var(--ink); font-family: 'Plus Jakarta Sans', sans-serif; }
        .site-header { display: flex; align-items: center; justify-content: space-between; gap: clamp(14px, 2vw, 28px); padding: 20px clamp(20px, 8.8vw, 128px); background: linear-gradient(112deg, #102a43 0%, #155e75 52%, #0f766e 100%); border-bottom: 1px solid rgba(255, 255, 255, 0.12); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); }
        .brand { display: inline-flex; align-items: center; gap: 10px; color: #ffffff; text-decoration: none; font-family: 'Manrope', sans-serif; font-size: 1.45rem; font-weight: 800; letter-spacing: -0.01em; }
        .brand img { width: auto; height: 52px; max-width: 160px; object-fit: contain; }
        .brand .brand-desa { color: #ffffff; }
        .brand .brand-digital { color: #38bdf8; }
        .header-nav-menu { display: flex; align-items: center; justify-content: flex-end; gap: clamp(8px, 0.75vw, 12px); list-style: none; margin: 0 0 0 auto; padding: 0; }
        .header-nav-menu a { display: block; padding: 9px 8px; border-radius: 6px; color: rgba(255, 255, 255, 0.9); font-family: 'Manrope', sans-serif; font-size: 0.8rem; font-weight: 700; text-decoration: none; transition: color 0.2s ease, background-color 0.2s ease; }
        .header-nav-menu a:hover { color: #ffffff; background: rgba(255, 255, 255, 0.1); }
        .header-nav-menu a.active { color: #ffffff; background: rgba(148, 163, 184, 0.32); box-shadow: inset 0 0 0 1px rgba(203, 213, 225, 0.35); }
        main { width: min(100% - 36px, 980px); margin: 44px auto 80px; }
        .search-heading { margin-bottom: 26px; }
        .eyebrow { color: var(--teal); font-size: 0.72rem; font-weight: 800; letter-spacing: 1px; text-transform: uppercase; }
        h1 { margin: 8px 0 18px; font-size: 2rem; line-height: 1.2; }
        .search-form { display: flex; gap: 10px; max-width: 720px; }
        .search-form input { flex: 1; min-width: 0; padding: 14px 16px; border: 1px solid var(--line); border-radius: 6px; background: #ffffff; color: var(--ink); font: inherit; }
        .search-form button { padding: 0 20px; border: 0; border-radius: 6px; background: var(--teal); color: #ffffff; font: inherit; font-weight: 800; cursor: pointer; }
        .result-summary { margin: 24px 0 34px; color: var(--muted); font-size: 0.9rem; }
        .result-group { margin-top: 30px; }
        .result-group h2 { margin: 0 0 12px; font-size: 1rem; }
        .result-list { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .result-item { display: flex; justify-content: space-between; gap: 16px; min-height: 90px; padding: 16px; border: 1px solid var(--line); border-radius: 6px; background: #ffffff; color: inherit; text-decoration: none; transition: border-color 0.2s ease, transform 0.2s ease; }
        .result-item:hover { border-color: var(--teal); transform: translateY(-2px); }
        .result-item strong { display: block; margin-bottom: 5px; font-size: 0.9rem; }
        .result-item span { display: block; color: var(--muted); font-size: 0.78rem; line-height: 1.5; }
        .result-arrow { flex: 0 0 auto; align-self: center; color: var(--coral); }
        .empty-state { padding: 28px 0; border-top: 1px solid var(--line); color: var(--muted); }

        @media (max-width: 640px) {
            .site-header { flex-wrap: wrap; gap: 12px; padding: 12px 18px; }
            .brand { gap: 8px; font-size: 1.15rem; }
            .brand img { height: 42px; max-width: 72px; }
            .header-nav-menu { flex: 0 0 100%; justify-content: center; gap: 4px; }
            .header-nav-menu a { padding: 8px 6px; font-size: 0.72rem; }
            main { margin-top: 30px; }
            h1 { font-size: 1.6rem; }
            .search-form button { padding: 0 14px; }
            .result-list { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <header class="site-header">
        <a class="brand" href="{{ url('/') }}">
            <img src="{{ asset('images/desa-digital.png') }}" alt="Logo Desa Digital">
            <span class="brand-desa">Desa</span><span class="brand-digital">Digital</span>
        </a>
        <ul class="header-nav-menu">
            <li><a href="{{ url('/#hero-banner') }}" class="active">BERANDA</a></li>
            <li><a href="{{ url('/#tentang-kami') }}">TENTANG KAMI</a></li>
            <li><a href="{{ url('/#layanan-digital') }}">LAYANAN</a></li>
            <li><a href="{{ url('/#hubungi-kami') }}">HUBUNGI KAMI</a></li>
        </ul>
    </header>

    <main>
        <div class="search-heading">
            <span class="eyebrow">Pencarian Portal</span>
            <h1>Hasil untuk “{{ $searchTerm }}”</h1>
            <form class="search-form global-search-form" action="{{ url('/search') }}" method="GET" role="search" data-suggestions-url="{{ route('search.suggestions') }}" autocomplete="off">
                <div class="global-search-control">
                    <input type="search" name="q" value="{{ $searchTerm }}" aria-label="Cari informasi dan data" data-global-search-input role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="results-search-suggestions" autofocus>
                    <div class="global-search-suggestions" id="results-search-suggestions" role="listbox" hidden></div>
                </div>
                <button type="submit"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> Cari</button>
            </form>
        </div>

        <p class="result-summary">{{ $resultCount }} hasil ditemukan di informasi, layanan, dan data wilayah.</p>

        @forelse ($groups as $group)
            <section class="result-group">
                <h2>{{ $group['title'] }}</h2>
                <div class="result-list">
                    @foreach ($group['items'] as $item)
                        <a class="result-item" href="{{ $item['url'] }}">
                            <span>
                                <strong>{{ $item['title'] }}</strong>
                                <span>{{ $item['description'] }}</span>
                            </span>
                            <i class="fa-solid fa-arrow-right result-arrow" aria-hidden="true"></i>
                        </a>
                    @endforeach
                </div>
            </section>
        @empty
            <div class="empty-state">Belum ada hasil yang cocok. Coba kata kunci desa, kecamatan, wisata, layanan, atau kontak.</div>
        @endforelse
    </main>
    <script src="{{ asset('js/global-search.js') }}" defer></script>
</body>
</html>