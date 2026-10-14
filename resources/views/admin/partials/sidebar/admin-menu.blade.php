<ul class="sidebar-menu">
    @include('admin.partials.sidebar.shared-links')
    <li>
        <a href="{{ route('admin.layanan.index') }}" class="{{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i>
            <span>Layanan (Master)</span>
        </a>
    </li>
    @foreach($allKategori as $kat)
        <li>
            <a href="{{ route('admin.tempat.kategori.detail', $kat) }}" class="{{ request('kategori') == $kat ? 'active' : '' }}">
                <i class="bi bi-pin-map-fill"></i>
                <span>{{ ucfirst($kat) }}</span>
            </a>
        </li>
    @endforeach
    <li>
        <a href="{{ route('admin.tempat.index') }}" class="{{ request()->routeIs('admin.tempat.index') ? 'active' : '' }}">
            <i class="bi bi-pin-map-fill"></i>
            <span>Spasial (Master)</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.kontributor.index') }}" class="{{ request()->routeIs('admin.kontributor.*') ? 'active' : '' }}">
            <i class="bi bi-person-fill"></i>
            <span>Manajemen User</span>
        </a>
    </li>
</ul>
