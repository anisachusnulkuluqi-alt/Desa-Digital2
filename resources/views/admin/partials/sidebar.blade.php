@php
    // Ambil kategori dari 2 sumber: tabel 'kategoris' (dari tombol Tambah Atribut) + kolom 'kategori' di tabel 'tempat'
    $kategoriDariTabel = \App\Models\Kategori::pluck('nama')->filter()->values();
    $kategoriDariTempat = \App\Models\Tempat::select('kategori')->distinct()->pluck('kategori')->filter()->values();
    $allKategori = auth()->user()?->hasRole(\App\Models\User::ROLE_CONTRIBUTOR)
        ? $kategoriDariTabel
        : $kategoriDariTabel->merge($kategoriDariTempat)->unique()->filter()->values();
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

    body.admin-sidebar-collapsed .main-content,
    body.admin-sidebar-collapsed .main,
    body.admin-sidebar-collapsed .admin-main,
    body.admin-sidebar-collapsed .settings-main,
    body.admin-sidebar-collapsed .page-header {
        margin-left: 76px !important;
    }

    /* Mobile Drawer & Hamburger Button */
    .sidebar-close-btn {
        display: none;
        align-items: center;
        justify-content: center;
        margin-left: auto;
        width: 32px;
        height: 32px;
        min-width: 32px;
        padding: 0;
        border-radius: 8px;
        border: 1px solid rgba(148, 163, 184, .25);
        background: transparent;
        color: #94a3b8;
        font-size: 15px;
        cursor: pointer;
        transition: background .2s, color .2s, border-color .2s;
    }
    .sidebar-close-btn:hover {
        background: rgba(255, 255, 255, .12);
        color: #fff;
        border-color: rgba(255, 255, 255, .4);
    }

    .sidebar-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .6);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        z-index: 1040;
        opacity: 0;
        pointer-events: none;
        transition: opacity .3s ease;
    }

    .admin-mobile-toggle {
        display: none !important;
    }

    @media (max-width: 992px) {
        .admin-mobile-toggle {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            min-width: 38px;
            padding: 0;
            margin-right: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #ffffff;
            color: #1e293b;
            font-size: 20px;
            cursor: pointer;
            flex-shrink: 0;
            line-height: 1;
            transition: background .2s, color .2s, border-color .2s;
        }
        .admin-mobile-toggle:hover {
            background: #f1f5f9;
            color: #2563eb;
            border-color: #94a3b8;
        }
        body > .admin-mobile-toggle {
            position: fixed;
            top: 12px;
            left: 12px;
            z-index: 1030;
            box-shadow: 0 4px 14px rgba(15, 23, 42, .18);
        }

        .sidebar-close-btn {
            display: inline-flex !important;
        }

        .sidebar {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            bottom: 0 !important;
            height: 100vh !important;
            height: 100dvh !important;
            width: 280px !important;
            max-width: 85vw !important;
            z-index: 1050 !important;
            transform: translateX(-100%) !important;
            transition: transform .3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: none !important;
            overflow-y: auto !important;
            -webkit-overflow-scrolling: touch;
        }

        body.admin-sidebar-mobile-open {
            overflow: hidden !important;
        }

        body.admin-sidebar-mobile-open .sidebar {
            transform: translateX(0) !important;
            box-shadow: 6px 0 32px rgba(0, 0, 0, .45) !important;
        }

        body.admin-sidebar-mobile-open .sidebar-backdrop {
            opacity: 1 !important;
            pointer-events: auto !important;
        }

        body.admin-location-module {
            --admin-sidebar-width: 0px !important;
        }

        .admin-main,
        .main-content,
        .main,
        .settings-main,
        .page-header,
        .app .main,
        body.admin-location-module .main,
        body.admin-location-module .page-header,
        body.admin-location-module .main-content {
            margin-left: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
        }

        body.admin-sidebar-collapsed .main-content,
        body.admin-sidebar-collapsed .main,
        body.admin-sidebar-collapsed .admin-main,
        body.admin-sidebar-collapsed .settings-main,
        body.admin-sidebar-collapsed .page-header {
            margin-left: 0 !important;
        }

        .sidebar-collapse-toggle {
            display: none !important;
        }
    }
</style>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon"><img src="{{ asset('images/desa-digital.png') }}" alt="Logo Desa Digital"></div>
        <div class="sidebar-brand-text">
            <h5>Desa Digital</h5>
            <small>{{ auth()->user()?->isAdmin() ? 'Admin pengelola data' : (auth()->user()?->role === \App\Models\User::ROLE_CONTRIBUTOR ? 'Kontributor data' : ucfirst(auth()->user()?->role ?? 'pengguna')) }}</small>
        </div>
        <button type="button" class="sidebar-close-btn" id="adminSidebarCloseBtn" aria-label="Tutup navigasi">
            <i class="bi bi-x-lg" aria-hidden="true"></i>
        </button>
    </div>
    @if(auth()->user()?->isAdmin())
        @include('admin.partials.sidebar.admin-menu')
    @else
        @include('admin.partials.sidebar.contributor-menu')
    @endif

    <button
        type="button"
        class="sidebar-collapse-toggle"
        id="adminSidebarCollapseToggle"
        aria-label="Perkecil sidebar"
        aria-pressed="false"
        title="Perkecil sidebar"
    >
        <i class="bi bi-chevron-double-left" aria-hidden="true"></i>
        <span class="sidebar-collapse-label"></span>
    </button>
</aside>

<div class="sidebar-backdrop" id="adminSidebarBackdrop" aria-hidden="true"></div>

<script src="{{ asset('js/admin-sidebar-toggle.js') }}" defer></script>