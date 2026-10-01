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
        .site-header { display: flex; align-items: center; justify-content: space-between; gap: 24px; padding: 14px clamp(20px, 6vw, 88px); background: #263b45; }
        .brand { display: inline-flex; align-items: center; gap: 12px; color: #ffffff; text-decoration: none; font-size: 1.35rem; font-weight: 800; }
        .brand img { width: auto; height: 46px; max-width: 78px; object-fit: contain; }
        .brand span { color: #67d4cb; }
        .back-link { color: #ffffff; font-size: 0.86rem; font-weight: 700; text-decoration: none; }
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
            .site-header { gap: 12px; padding: 12px 18px; }
            .brand { gap: 8px; font-size: 1.1rem; }
            .brand img { height: 38px; max-width: 58px; }
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
            <span>Desa</span> Digital
        </a>
        <a class="back-link" href="{{ url('/') }}"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Beranda</a>
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