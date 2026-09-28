@php
    $activeMenu = $activeMenu ?? null;
    $menuItems = [
        ['key' => 'dashboard', 'route' => 'dashboard', 'icon' => 'bi-house-fill', 'label' => 'Beranda'],
        ['key' => 'kecamatan', 'route' => 'admin.kecamatan.index', 'icon' => 'bi-geo-alt-fill', 'label' => 'Kecamatan'],
        ['key' => 'desa', 'route' => 'admin.desa.index', 'icon' => 'bi-houses-fill', 'label' => 'Desa'],
        ['key' => 'wisata', 'route' => 'admin.wisata.index', 'icon' => 'bi-image-fill', 'label' => 'Wisata Desa'],
        ['key' => 'pasar', 'route' => 'admin.pasar.index', 'icon' => 'bi-shop', 'label' => 'Pasar Desa'],
        ['key' => 'kantor', 'route' => 'admin.kantor.index', 'icon' => 'bi-building', 'label' => 'Kantor Desa'],
        ['key' => 'wifi', 'route' => 'admin.wifi.index', 'icon' => 'bi-wifi', 'label' => 'WiFi Desa'],
        ['key' => 'bumdes', 'route' => 'admin.bumdes.index', 'icon' => 'bi-briefcase-fill', 'label' => 'BUMDes'],
        ['key' => 'kkdmp', 'route' => 'admin.kkdmp.index', 'icon' => 'bi-people-fill', 'label' => 'KKDMP'],
    ];
@endphp

<style>
    .sidebar {
        width: 260px;
        background: #0f172a;
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        padding: 20px 14px;
        z-index: 100;
    }
    .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
    .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; }
    .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
    .sidebar-brand-text small { color: #64748b; font-size: 10px; }
    .sidebar-menu { list-style: none; padding: 0; }
    .sidebar-menu li { margin-bottom: 4px; }
    .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
    .sidebar-menu a:hover, .sidebar-menu a.active { background: #2563eb; color: white; }
    .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
    .main-content { max-width: none; margin: 0 0 0 260px; }
    .main { margin-left: 260px; }
    .page-header { position: sticky; top: 0; z-index: 99; margin-left: 260px; padding: 14px 28px; background: white; border-bottom: 1px solid #e2e8f0; }
    @media (max-width: 992px) {
        .sidebar { transform: translateX(-100%); }
        .main-content, .main { margin-left: 0; }
        .page-header { margin-left: 0; }
    }
</style>

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-house-heart-fill"></i></div>
        <div class="sidebar-brand-text">
            <h5>Desa Digital</h5>
            <small>Admin pengelola data</small>
        </div>
    </div>
    <ul class="sidebar-menu">
        @foreach ($menuItems as $item)
            <li>
                <a href="{{ route($item['route']) }}" class="{{ $activeMenu === $item['key'] ? 'active' : '' }}">
                    <i class="bi {{ $item['icon'] }}"></i><span>{{ $item['label'] }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</aside>