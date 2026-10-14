<li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard', 'admin.*.dashboard') ? 'active' : '' }}"><i class="bi bi-house-fill"></i><span>Beranda</span></a></li>
<li><a href="{{ route('admin.kecamatan.index') }}" class="{{ request()->routeIs('admin.kecamatan.*') ? 'active' : '' }}"><i class="bi bi-geo-alt-fill"></i><span>Kecamatan</span></a></li>
<li><a href="{{ route('admin.desa.index') }}" class="{{ request()->routeIs('admin.desa.*') ? 'active' : '' }}"><i class="bi bi-houses-fill"></i><span>Desa</span></a></li>
<li><a href="{{ route('admin.wisata.index') }}" class="{{ request()->routeIs('admin.wisata.*') ? 'active' : '' }}"><i class="bi bi-image-fill"></i><span>Wisata Desa</span></a></li>
<li><a href="{{ route('admin.pasar.index') }}" class="{{ request()->routeIs('admin.pasar.*') ? 'active' : '' }}"><i class="bi bi-shop"></i><span>Pasar Desa</span></a></li>
<li><a href="{{ route('admin.kantor.index') }}" class="{{ request()->routeIs('admin.kantor.*') ? 'active' : '' }}"><i class="bi bi-building"></i><span>Kantor Desa</span></a></li>
<li><a href="{{ route('admin.wifi.index') }}" class="{{ request()->routeIs('admin.wifi.*') ? 'active' : '' }}"><i class="bi bi-wifi"></i><span>WiFi Desa</span></a></li>
<li><a href="{{ route('admin.bumdes.index') }}" class="{{ request()->routeIs('admin.bumdes.*') ? 'active' : '' }}"><i class="bi bi-briefcase-fill"></i><span>BUMDes</span></a></li>
<li><a href="{{ route('admin.kkdmp.index') }}" class="{{ request()->routeIs('admin.kkdmp.*') ? 'active' : '' }}"><i class="bi bi-people-fill"></i><span>KKDMP</span></a></li>

@if(auth()->user()?->hasRole(\App\Models\User::ROLE_ADMIN, \App\Models\User::ROLE_CONTRIBUTOR))
    @foreach($allKategori as $kat)
        <li>
            <a href="{{ route('admin.tempat.kategori.detail', $kat) }}" class="{{ request('kategori') == $kat ? 'active' : '' }}">
                <i class="bi bi-pin-map-fill"></i>
                <span>{{ ucfirst($kat) }}</span>
            </a>
        </li>
    @endforeach
@endif

<li class="sidebar-menu-divider" role="separator"></li>
@php
    $surveiBaruHariIni = \Illuminate\Support\Facades\Schema::hasTable('website_feedback')
        ? \App\Models\SurveiKepuasan::whereDate('created_at', \Carbon\Carbon::today())->count()
        : 0;
@endphp
<li>
    <a href="{{ route('admin.survei.index') }}" class="{{ request()->routeIs('admin.survei.*') ? 'active' : '' }}" style="display: flex; align-items: center; justify-content: space-between;">
        <span style="display: flex; align-items: center; gap: 10px; min-width: 0; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
            <i class="bi bi-chat-heart-fill"></i>
            <span>Survei Kepuasan</span>
        </span>
        @if($surveiBaruHariIni > 0)
            <span class="badge bg-danger rounded-pill" style="font-size: 10px; padding: 2px 7px; font-weight: 700; flex-shrink: 0;" title="{{ $surveiBaruHariIni }} survei masuk hari ini">+{{ $surveiBaruHariIni }}</span>
        @endif
    </a>
</li>
