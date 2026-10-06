@php
    // Ambil kategori dari 2 sumber: tabel 'kategoris' (dari tombol Tambah Atribut) + kolom 'kategori' di tabel 'tempat'
    $kategoriDariTabel = \App\Models\Kategori::pluck('nama')->filter()->values();
    $kategoriDariTempat = \App\Models\Tempat::select('kategori')->distinct()->pluck('kategori')->filter()->values();
    $allKategori = $kategoriDariTabel->merge($kategoriDariTempat)->unique()->filter()->values();
@endphp

<style>
    .sidebar {
        width: 260px;
        background: #0f172a;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px 14px;
        z-index: 100;
        overflow-y: auto;
    }
    .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
    .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; flex-shrink: 0; }
    .sidebar-brand-icon img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
    .sidebar-brand-text small { color: #64748b; font-size: 10px; }
    .sidebar-menu { list-style: none; padding: 0; }
    .sidebar-menu li { margin-bottom: 4px; }
    .sidebar .sidebar-menu > li:not(.sidebar-menu-divider) { margin: 0 0 4px; }
    .sidebar-menu .sidebar-menu-divider { height: 0; margin: 10px 10px 8px; border-top: 1px solid rgba(148, 163, 184, .25); list-style: none; }
    .sidebar-menu a { display: flex; align-items: center; gap: 10px; height: 40px; min-height: 40px; padding: 0 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; line-height: 20px; transition: all 0.2s; }
    .sidebar-menu a span { min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .sidebar-menu a:hover { background: #1d4ed8; color: white; }
    .sidebar-menu a.active { background: #2563eb; color: white; }
    .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
    .sidebar-collapse-toggle {
        width: 100%;
        min-height: 40px;
        margin-top: 10px;
        padding: 0 12px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        gap: 10px;
        border: 1px solid rgba(148, 163, 184, .25);
        border-radius: 8px;
        background: transparent;
        color: #94a3b8;
        font: inherit;
        font-size: 12px;
        cursor: pointer;
        transition: background .2s, color .2s, border-color .2s;
    }
    .sidebar-collapse-toggle:hover { border-color: #3b82f6; background: #1e293b; color: white; }
    .sidebar-collapse-toggle i { width: 18px; text-align: center; font-size: 16px; }

    body.admin-sidebar-collapsed .sidebar { width: 76px; padding-right: 10px; padding-left: 10px; }
    body.admin-sidebar-collapsed .sidebar-brand { justify-content: center; padding-right: 0; padding-left: 0; }
    body.admin-sidebar-collapsed .sidebar-brand-text,
    body.admin-sidebar-collapsed .sidebar-menu a span,
    body.admin-sidebar-collapsed .sidebar-collapse-label { display: none; }
    body.admin-sidebar-collapsed .sidebar-menu a { justify-content: center; padding-right: 8px; padding-left: 8px; }
    body.admin-sidebar-collapsed .sidebar-menu a i { width: auto; }
    body.admin-sidebar-collapsed .sidebar-menu .sidebar-menu-divider { margin-right: 6px; margin-left: 6px; }
    body.admin-sidebar-collapsed .sidebar-collapse-toggle { justify-content: center; padding-right: 0; padding-left: 0; }

    body.admin-location-module { --admin-sidebar-width: 260px; }
    body.admin-location-module.admin-sidebar-collapsed { --admin-sidebar-width: 76px; }
    body.admin-location-module .main,
    body.admin-location-module .page-header,
    body.admin-location-module .main-content {
        width: calc(100% - var(--admin-sidebar-width));
        min-width: 0;
        margin-left: var(--admin-sidebar-width) !important;
    }

    @media (max-width: 760px) {
        body.admin-location-module { --admin-sidebar-width: 58px; }
        body.admin-location-module.admin-sidebar-collapsed { --admin-sidebar-width: 76px; }
        body.admin-location-module .sidebar { width: var(--admin-sidebar-width); padding-right: 7px; padding-left: 7px; }
        body.admin-location-module .sidebar-brand { justify-content: center; padding-right: 0; padding-left: 0; }
        body.admin-location-module .sidebar-brand-text,
        body.admin-location-module .sidebar-menu a span,
        body.admin-location-module .sidebar-collapse-label { display: none; }
        body.admin-location-module .sidebar-menu a { justify-content: center; padding-right: 0; padding-left: 0; }
        body.admin-location-module .sidebar-menu a i { width: auto; }
        body.admin-location-module .sidebar-collapse-toggle { justify-content: center; padding-right: 0; padding-left: 0; }
    }

    body.admin-sidebar-collapsed .main-content,
    body.admin-sidebar-collapsed .main,
    body.admin-sidebar-collapsed .admin-main,
    body.admin-sidebar-collapsed .settings-main,
    body.admin-sidebar-collapsed .page-header {
        margin-left: 76px !important;
    }
    @media (max-width: 992px) {
        body.admin-sidebar-collapsed .main-content,
        body.admin-sidebar-collapsed .main,
        body.admin-sidebar-collapsed .admin-main,
        body.admin-sidebar-collapsed .settings-main,
        body.admin-sidebar-collapsed .page-header {
            margin-left: 76px !important;
        }
    }
</style>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon"><img src="{{ asset('images/desa-digital.png') }}" alt="Logo Desa Digital"></div>
        <div class="sidebar-brand-text">
            <h5>Desa Digital</h5>
            <small>Admin pengelola data</small>
        </div>
    </div>
    <ul class="sidebar-menu">
        {{-- MENU UTAMA --}}
        <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-house-fill"></i><span>Beranda</span></a></li>
        <li><a href="{{ route('admin.kecamatan.index') }}" class="{{ request()->routeIs('admin.kecamatan.*') ? 'active' : '' }}"><i class="bi bi-geo-alt-fill"></i><span>Kecamatan</span></a></li>
        <li><a href="{{ route('admin.desa.index') }}" class="{{ request()->routeIs('admin.desa.*') ? 'active' : '' }}"><i class="bi bi-houses-fill"></i><span>Desa</span></a></li>
        <li><a href="{{ route('admin.wisata.index') }}" class="{{ request()->routeIs('admin.wisata.*') ? 'active' : '' }}"><i class="bi bi-image-fill"></i><span>Wisata Desa</span></a></li>
        <li><a href="{{ route('admin.pasar.index') }}" class="{{ request()->routeIs('admin.pasar.*') ? 'active' : '' }}"><i class="bi bi-shop"></i><span>Pasar Desa</span></a></li>
        <li><a href="{{ route('admin.kantor.index') }}" class="{{ request()->routeIs('admin.kantor.*') ? 'active' : '' }}"><i class="bi bi-building"></i><span>Kantor Desa</span></a></li>
        <li><a href="{{ route('admin.wifi.index') }}" class="{{ request()->routeIs('admin.wifi.*') ? 'active' : '' }}"><i class="bi bi-wifi"></i><span>WiFi Desa</span></a></li>
        <li><a href="{{ route('admin.bumdes.index') }}" class="{{ request()->routeIs('admin.bumdes.*') ? 'active' : '' }}"><i class="bi bi-briefcase-fill"></i><span>BUMDes</span></a></li>
        <li><a href="{{ route('admin.kkdmp.index') }}" class="{{ request()->routeIs('admin.kkdmp.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i><span>KKDMP</span></a></li>

        {{-- 🔥 MENU DINAMIS: Muncul otomatis dari tabel 'kategoris' + kolom 'kategori' di tabel 'tempat' (TANPA PEMBATAS) --}}
        @foreach($allKategori as $kat)
            <li>
                <a href="{{ route('admin.tempat.kategori.detail', $kat) }}" class="{{ request('kategori') == $kat ? 'active' : '' }}">
                    <i class="bi bi-pin-map-fill"></i>
                    <span>{{ ucfirst($kat) }}</span>
                </a>
            </li>
        @endforeach

        {{-- TEMPAT (MASTER) --}}
        <li>
            <a href="{{ route('admin.tempat.index') }}" class="{{ request()->routeIs('admin.tempat.index') ? 'active' : '' }}">
                <i class="bi bi-pin-map-fill"></i>
                <span>Tempat (Master)</span>
            </a>
        </li>

        {{-- PEMBATAS SEBELUM KONTRIBUTOR --}}
        <li class="sidebar-menu-divider" role="separator"></li>

        {{-- KONTRIBUTOR (PALING BAWAH) --}}
        <li>
            <a href="{{ route('admin.kontributor.index') }}" class="{{ request()->routeIs('admin.kontributor.*') ? 'active' : '' }}">
                <i class="bi bi-person-plus-fill"></i>
                <span>Kontributor</span>
            </a>
        </li>
    </ul>

    <button
        type="button"
        class="sidebar-collapse-toggle"
        id="adminSidebarCollapseToggle"
        aria-label="Perkecil sidebar"
        aria-pressed="false"
        title="Perkecil sidebar"
    >
        <i class="bi bi-chevron-double-left" aria-hidden="true"></i>
        <span class="sidebar-collapse-label">Perkecil menu</span>
    </button>
</aside>

<script src="{{ asset('js/admin-sidebar-toggle.js') }}" defer></script>