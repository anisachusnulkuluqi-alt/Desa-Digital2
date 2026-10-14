<header class="site-header">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('images/desa-digital.png') }}"
             alt="Logo Desa Digital"
             class="brand-logo-img"
             onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png'">
        <span class="brand-text-logo">Desa<span>Digital</span></span>
    </a>

    <button class="menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="primary-navigation">
        <i class="fa-solid fa-bars" aria-hidden="true"></i>
    </button>

    <ul class="nav-menu" id="primary-navigation">
        <li><a href="{{ $activePage === 'home' ? '#hero-banner' : url('/#hero-banner') }}" @class(['active' => $activePage === 'home']) @if ($activePage === 'home') aria-current="page" @endif>BERANDA</a></li>
        <li><a href="{{ $activePage === 'home' ? '#tentang-kami' : url('/#tentang-kami') }}">TENTANG KAMI</a></li>
        <li><a href="{{ $activePage === 'home' ? '#layanan-digital' : url('/#layanan-digital') }}">LAYANAN</a></li>
        <li><a href="{{ $activePage === 'home' ? '#statistik-wilayah' : url('/#statistik-wilayah') }}">STATISTIK</a></li>
        <li><a href="{{ $activePage === 'home' ? '#hubungi-kami' : url('/#hubungi-kami') }}">HUBUNGI KAMI</a></li>
    </ul>

    <form class="search-pill-nav global-search-form" action="{{ url('/search') }}" method="GET" role="search" data-suggestions-url="{{ route('search.suggestions') }}" autocomplete="off">
        <div class="global-search-control">
            <input type="search" name="q" placeholder="Cari..." aria-label="Cari informasi dan data" data-global-search-input role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="public-header-search-suggestions">
            <div class="global-search-suggestions" id="public-header-search-suggestions" role="listbox" hidden></div>
        </div>
        <button type="submit" aria-label="Cari"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</header>

@if ($showSpacer ?? false)
    <div class="site-header-spacer" aria-hidden="true"></div>
@endif

<script>
    (() => {
        const header = document.querySelector('.site-header');
        const headerSpacer = document.querySelector('.site-header-spacer');
        const menuButton = header.querySelector('.menu-toggle');
        const menuIcon = menuButton.querySelector('i');

        const syncHeaderHeight = () => {
            const headerHeight = `${header.offsetHeight}px`;
            if (headerSpacer) headerSpacer.style.height = headerHeight;
            document.documentElement.style.setProperty('--site-header-height', headerHeight);
        };

        const setMenuOpen = isOpen => {
            header.classList.toggle('nav-open', isOpen);
            menuButton.setAttribute('aria-expanded', String(isOpen));
            menuButton.setAttribute('aria-label', isOpen ? 'Tutup menu' : 'Buka menu');
            menuIcon.className = `fa-solid ${isOpen ? 'fa-xmark' : 'fa-bars'}`;
        };

        syncHeaderHeight();
        window.addEventListener('resize', syncHeaderHeight);
        menuButton.addEventListener('click', () => setMenuOpen(!header.classList.contains('nav-open')));
        header.querySelectorAll('.nav-menu a').forEach(link => link.addEventListener('click', () => setMenuOpen(false)));
        document.addEventListener('click', event => {
            if (!header.contains(event.target)) setMenuOpen(false);
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && header.classList.contains('nav-open')) {
                setMenuOpen(false);
                menuButton.focus();
            }
        });
    })();
</script>
<script src="{{ asset('js/global-search.js') }}" defer></script>
