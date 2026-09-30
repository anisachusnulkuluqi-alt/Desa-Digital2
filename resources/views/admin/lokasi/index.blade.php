<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $category['label'] }} | Admin Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --navy: #0f172a;
            --blue: #1e3a8a;
            --blue-dark: #1e40af;
            --ink: #1e293b;
            --muted: #64748b;
            --line: #e2e8f2;
            --canvas: #f8fafc;
            --white: #fff;
            --red: #c2413b;
            --green: #13795b;
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--canvas); color: var(--ink); font: 14px 'Inter', sans-serif; }
        button, input, textarea { font: inherit; }
        button, a { -webkit-tap-highlight-color: transparent; }
        .app { min-height: 100vh; }
        .sidebar { position: fixed; inset: 0 auto 0 0; z-index: 5; width: 176px; padding: 20px 10px; background: var(--navy); color: #d5def1; }
        .brand { display: flex; align-items: center; gap: 9px; padding: 0 8px 24px; color: #fff; font: 800 15px 'Manrope', sans-serif; text-decoration: none; }
        .brand-mark { display: grid; width: 30px; height: 30px; place-items: center; border-radius: 8px; background: var(--blue); color: #fff; }
        .brand small { display: block; margin-top: 2px; color: #96a5c1; font: 11px 'DM Sans', sans-serif; }
        .nav-label { padding: 8px 10px; color: #8090ae; font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .nav-list { display: grid; gap: 3px; }
        .nav-list a { display: flex; align-items: center; gap: 10px; min-height: 36px; padding: 8px 10px; border-radius: 6px; color: #c5d0e5; text-decoration: none; font-size: 12px; }
        .nav-list a:hover { background: #1b2b50; color: #fff; }
        .nav-list a.active { background: var(--blue); color: #fff; }
        .nav-icon { width: 16px; text-align: center; color: #aab9d3; }
        .nav-list a.active .nav-icon { color: #fff; }
        .main { min-height: 100vh; margin-left: 176px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; min-height: 62px; padding: 0 28px; border-bottom: 1px solid var(--line); background: #fff; }
        .crumb { color: var(--muted); font-size: 12px; }
        .user-pill { padding: 7px 11px; border: 1px solid var(--line); border-radius: 6px; color: var(--ink); font-size: 12px; }
        .content { max-width: 1440px; margin: 0 auto; padding: 28px 28px 40px; }
        .page-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 24px; }
        .eyebrow { margin: 0 0 6px; color: var(--blue); font-size: 11px; font-weight: 700; text-transform: uppercase; }
        h1 { margin: 0; font-size: 28px; line-height: 1.2; font-weight: 800; }
        .subtitle { margin: 7px 0 0; color: var(--muted); font-size: 13px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 38px; padding: 0 13px; border: 1px solid transparent; border-radius: 8px; cursor: pointer; text-decoration: none; font-weight: 700; }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: var(--blue-dark); }
        .btn-light { border-color: var(--line); background: #fff; color: var(--ink); }
        .btn-danger { border-color: #f4d1ce; background: #fff; color: var(--red); }
        .panel { overflow: hidden; border: 1px solid var(--line); border-radius: 12px; background: #fff; }
        .panel-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 16px 24px; border-bottom: 1px solid var(--line); }
        .table-title { display: flex; align-items: center; gap: 10px; color: var(--ink); font-size: 14px; font-weight: 700; }
        .table-title > i { color: var(--blue); }
        .count { padding: 3px 10px; border-radius: 10px; background: var(--blue); color: #fff; font-size: 11px; font-weight: 600; white-space: nowrap; }
        .table-actions { display: flex; align-items: center; gap: 10px; }
        .search { width: 240px; height: 37px; padding: 0 12px; border: 1px solid var(--line); border-radius: 8px; outline: none; font-size: 13px; }
        .search:focus, .field:focus, .textarea:focus { border-color: #7aa5ff; box-shadow: 0 0 0 3px #2563eb18; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; table-layout: fixed; border-collapse: collapse; text-align: left; }
        th:first-child, td:first-child { width: 50px; }
        th:nth-child(2), td:nth-child(2) { width: 45%; }
        th { padding: 14px 20px; background: #f8fafc; color: var(--muted); font-size: 11px; font-weight: 700; text-transform: uppercase; white-space: nowrap; }
        td { padding: 16px 20px; border-top: 1px solid #f1f5f9; color: var(--ink); font-size: 13px; vertical-align: middle; }
        .row-number { color: #94a3b8; font-weight: 600; }
        tbody tr { cursor: pointer; transition: background 0.2s; }
        tbody tr:hover { background: #f8fafc; }
        .place-name { display: flex; align-items: center; gap: 10px; color: var(--blue); font-weight: 600; }
        .place-icon { display: grid; width: 32px; height: 32px; flex: 0 0 32px; place-items: center; border-radius: 8px; background: #dbeafe; color: #1e40af; font-size: 14px; }
        .empty { padding: 45px 16px; color: var(--muted); text-align: center; }
        .alert { margin-bottom: 16px; padding: 11px 14px; border: 1px solid #a8e0ce; border-radius: 6px; background: #eaf8f2; color: var(--green); }
        .alert-error { border-color: #f1c1bd; background: #fff1f0; color: var(--red); }
        .modal-backdrop { position: fixed; inset: 0; z-index: 20; display: none; place-items: center; padding: 20px; background: #0c1636a8; }
        .modal-backdrop.open { display: grid; }
        .modal { width: min(620px, 100%); max-height: min(92vh, 850px); overflow: auto; border-radius: 8px; background: #fff; box-shadow: 0 24px 80px #07112b40; }
        .location-edit-modal { display: flex; width: min(700px, 100%); flex-direction: column; overflow: hidden; border-radius: 12px; }
        .location-edit-modal .modal-head { flex: 0 0 auto; padding: 18px 22px; border: 0; border-radius: 12px 12px 0 0; background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: #fff; }
        .modal-head { display: flex; align-items: center; justify-content: space-between; padding: 18px 20px; border-bottom: 1px solid var(--line); }
        .modal-head h2 { margin: 0; font: 700 16px 'Inter', sans-serif; }
        .location-edit-modal .icon-btn { background: transparent; color: #fff; font-size: 22px; }
        .icon-btn { width: 32px; height: 32px; border: 0; border-radius: 6px; background: #f1f4f9; color: var(--ink); cursor: pointer; font-size: 18px; }
        .form-body { display: grid; gap: 14px; padding: 24px 22px; }
        .location-edit-modal .form-body { max-height: calc(92vh - 72px); overflow-y: auto; }
        .field-group { display: grid; gap: 6px; }
        .field-group label { color: #1e293b; font-size: 11px; font-weight: 700; text-transform: uppercase; }
        .field { width: 100%; min-height: 39px; padding: 10px 12px; border: 1.5px solid var(--line); border-radius: 8px; outline: none; background: #f8fafc; color: var(--ink); }
        .textarea { width: 100%; min-height: 110px; resize: vertical; padding: 10px 12px; border: 1.5px solid var(--line); border-radius: 8px; outline: none; background: #f8fafc; color: var(--ink); font: 12px ui-monospace, SFMono-Regular, Consolas, monospace; }
        .photo-preview { display: none; align-items: center; gap: 12px; margin-top: 10px; padding: 10px; border: 1px solid var(--line); border-radius: 8px; background: #f8fafc; }
        .photo-preview.visible { display: flex; }
        .photo-preview img { width: 76px; height: 58px; border-radius: 6px; object-fit: cover; }
        .photo-preview span { color: var(--muted); font-size: 12px; font-weight: 600; }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .modal-actions { position: sticky; bottom: -24px; display: flex; justify-content: flex-end; gap: 8px; margin: 8px -22px -24px; padding: 14px 22px; border-top: 1px solid var(--line); background: #f8fafc; }
        .section-divider { margin: 2px 0 0; padding-bottom: 7px; border-bottom: 1px solid var(--line); color: var(--blue); font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .detail-modal { width: min(700px, 100%); }
        .detail-modal-head { border: 0; border-radius: 12px 12px 0 0; background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: #fff; }
        .detail-modal-head .icon-btn { background: transparent; color: #fff; font-size: 22px; }
        .detail-photo { display: grid; height: 220px; place-items: center; overflow: hidden; background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: #fff; font-size: 42px; }
        .detail-photo img { width: 100%; height: 100%; object-fit: cover; }
        .detail-body { padding: 22px; }
        .detail-name { margin: 0 0 6px; color: var(--ink); font-size: 22px; font-weight: 800; }
        .detail-village { display: flex; align-items: center; gap: 6px; margin-bottom: 20px; color: var(--muted); font-size: 13px; }
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .detail-label { margin-bottom: 4px; color: var(--muted); font-size: 10px; font-weight: 700; text-transform: uppercase; }
        .detail-value { color: var(--ink); font-size: 13px; font-weight: 600; overflow-wrap: anywhere; }
        .detail-footer { display: flex; justify-content: flex-end; gap: 8px; padding: 14px 20px; border-top: 1px solid var(--line); background: #f8fafc; }
        .btn-modal-cancel, .btn-modal-edit, .btn-modal-delete { display: inline-flex; align-items: center; justify-content: center; gap: 6px; min-height: 38px; padding: 0 15px; border: 1px solid transparent; border-radius: 8px; cursor: pointer; font-size: 13px; font-weight: 600; }
        .btn-modal-cancel { border-color: var(--line); background: #fff; color: var(--muted); }
        .btn-modal-edit { background: linear-gradient(135deg, #1e3a8a, #3b82f6); color: #fff; }
        .btn-modal-delete { background: #ef4444; color: #fff; }
        @media (max-width: 760px) {
            .sidebar { width: 58px; padding-inline: 7px; }
            .brand { justify-content: center; padding-inline: 0; }
            .brand-copy, .nav-label, .nav-text { display: none; }
            .nav-list a { justify-content: center; padding-inline: 0; }
            .nav-icon { width: auto; }
            .main { margin-left: 58px; }
            .topbar { padding-inline: 16px; }
            .content { padding: 20px 14px 30px; }
            .page-head { align-items: flex-start; flex-direction: column; }
            .panel-toolbar { align-items: stretch; flex-direction: column; }
            .search { width: 100%; }
            .field-row { grid-template-columns: 1fr; }
        }
        @media (max-width: 760px) {
            .content { padding: 20px 14px 30px; }
            .panel-toolbar, .table-actions { align-items: stretch; flex-direction: column; }
            .search { width: 100%; }
            .detail-grid { grid-template-columns: 1fr; }
            .detail-footer { flex-wrap: wrap; }
            .field-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="app">
        @include('admin.partials.sidebar', ['activeMenu' => request()->route('kategori')])

        <main class="main">
            <header class="topbar">
                <div class="crumb">Admin <span aria-hidden="true">/</span> {{ $category['label'] }}</div>
                <div class="user-pill">{{ auth()->user()->name ?? 'Administrator' }}</div>
            </header>

            <section class="content">
                @if (session('success'))
                    <div class="alert">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="page-head">
                    <div>
                        <p class="eyebrow">Data titik lokasi</p>
                        <h1>{{ $category['label'] }}</h1>
                        <p class="subtitle">Kelola data {{ strtolower($category['label']) }} Kabupaten Tuban.</p>
                    </div>
                </div>

                <section class="panel" aria-label="Daftar {{ $category['label'] }}">
                    <div class="panel-toolbar">
                        <div class="table-title">
                            <i class="bi bi-list-ul"></i>
                            Daftar {{ $category['label'] }}
                            <span class="count">{{ number_format($totalLocations) }} Titik</span>
                        </div>
                        <div class="table-actions">
                            <form method="GET" action="{{ url()->current() }}">
                                <input class="search" type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama tempat atau desa..." aria-label="Cari nama tempat atau desa">
                            </form>
                            <button class="btn btn-primary" type="button" onclick="openCreateModal()"><i class="bi bi-plus-lg"></i> Tambah {{ $category['label'] }}</button>
                        </div>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 50px;">NO</th>
                                    <th>{{ $category['route'] === 'wifi' ? 'Nama SSID' : 'Nama tempat' }}</th>
                                    <th>Desa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locations as $index => $location)
                                    @php
                                        $locationProperties = is_array($location->properties)
                                            ? $location->properties
                                            : (json_decode($location->properties ?? '{}', true) ?: []);
                                        $village = null;
                                        foreach (['nama_desa', 'desa', 'Desa', 'kelurahan', 'desa_kelur', 'nama_kelurahan', 'village'] as $villageKey) {
                                            $villageValue = trim((string) ($locationProperties[$villageKey] ?? ''));
                                            if ($villageValue !== '' && $villageValue !== '-') {
                                                $village = $villageValue;
                                                break;
                                            }
                                        }
                                        if (!$village && $category['route'] === 'kantor') {
                                            $village = trim(preg_replace('/^(?:BALAI|KANTOR)\s+DESA\s+/i', '', $location->nama_lokasi));
                                        }
                                        $village = $village ?: '-';
                                    @endphp
                                    <tr tabindex="0" role="button" aria-label="Lihat detail {{ $location->nama_lokasi ?: 'lokasi' }}" data-id="{{ $location->id }}" data-name="{{ $location->nama_lokasi }}" data-address="{{ $location->alamat }}" data-latitude="{{ $location->latitude }}" data-longitude="{{ $location->longitude }}" data-properties="{{ json_encode($locationProperties, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}" onclick="openLocationDetail(this)" onkeydown="if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); openLocationDetail(this); }">
                                        <td class="row-number">{{ $locations->firstItem() + $index }}</td>
                                        <td><span class="place-name"><span class="place-icon"><i class="bi {{ ['wifi' => 'bi-wifi', 'kantor' => 'bi-building', 'pasar' => 'bi-shop', 'wisata' => 'bi-image-fill', 'bumdes' => 'bi-briefcase-fill', 'kkdmp' => 'bi-people-fill'][$category['route']] ?? 'bi-geo-alt-fill' }}"></i></span>{{ $location->nama_lokasi ?: 'Tanpa nama' }}</span></td>
                                        <td>{{ $village }}</td>
                                    </tr>
                                @empty
                                    <tr><td class="empty" colspan="3">Belum ada titik pada kategori ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @include('admin.partials.pagination', ['paginator' => $locations])
                </section>
            </section>
        </main>
    </div>

    <div class="modal-backdrop" id="locationDetailModal" role="dialog" aria-modal="true" aria-labelledby="detailModalTitle" onclick="if (event.target === this) closeDetailModal()">
        <section class="modal detail-modal">
            <header class="modal-head detail-modal-head">
                <h2 id="detailModalTitle"><i class="bi bi-geo-alt-fill"></i> Detail {{ $category['label'] }}</h2>
                <button class="icon-btn" type="button" aria-label="Tutup" onclick="closeDetailModal()"><i class="bi bi-x-lg"></i></button>
            </header>
            <div class="detail-photo" id="detailPhoto"><i class="bi bi-geo-alt-fill"></i></div>
            <div class="detail-body">
                <h3 class="detail-name" id="detailName">-</h3>
                <div class="detail-village"><i class="bi bi-geo-alt-fill"></i><span id="detailVillage">-</span></div>
                <div class="detail-grid">
                    <div><div class="detail-label">Alamat</div><div class="detail-value" id="detailAddress">-</div></div>
                    @if ($category['route'] === 'wifi')
                        <div><div class="detail-label">Fasilitator</div><div class="detail-value" id="detailFacilitator">-</div></div>
                    @endif
                    @if ($category['route'] === 'bumdes')
                        <div><div class="detail-label">Jenis Usaha</div><div class="detail-value" id="detailBusinessType">-</div></div>
                        <div><div class="detail-label">Nama Ketua</div><div class="detail-value" id="detailLeader">-</div></div>
                    @endif
                    @if ($category['route'] === 'kkdmp')
                        <div><div class="detail-label">Jenis</div><div class="detail-value" id="detailKkdmpType">-</div></div>
                        <div><div class="detail-label">Nama Ketua</div><div class="detail-value" id="detailKkdmpLeader">-</div></div>
                        <div><div class="detail-label">No. AHU</div><div class="detail-value" id="detailAhu">-</div></div>
                    @endif
                    @if ($category['route'] === 'kantor')
                        <div><div class="detail-label">Link Maps</div><div class="detail-value"><a id="detailMapsLink" href="#" target="_blank" rel="noopener noreferrer">-</a></div></div>
                    @endif
                    <div><div class="detail-label">Latitude</div><div class="detail-value" id="detailLatitude">-</div></div>
                    <div><div class="detail-label">Longitude</div><div class="detail-value" id="detailLongitude">-</div></div>
                </div>
            </div>
            <footer class="detail-footer">
                <button class="btn-modal-cancel" type="button" onclick="closeDetailModal()"><i class="bi bi-x-lg"></i> Tutup</button>
                <form id="locationDeleteForm" method="POST" onsubmit="return confirm('Hapus titik lokasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn-modal-delete" type="submit"><i class="bi bi-trash"></i> Hapus</button>
                </form>
                <button class="btn-modal-edit" type="button" onclick="editSelectedLocation()"><i class="bi bi-pencil"></i> Edit</button>
            </footer>
        </section>
    </div>

    <div class="modal-backdrop" id="locationModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" onclick="if (event.target === this) closeModal()">
        <section class="modal location-edit-modal">
            <header class="modal-head">
                <h2 id="modalTitle">{{ $category['route'] === 'pasar' ? 'Tambah Pasar Desa' : ($category['route'] === 'kantor' ? 'Tambah Balai Desa' : ($category['route'] === 'wifi' ? 'Tambah WiFi Desa' : ($category['route'] === 'bumdes' ? 'Tambah BUMDes' : ($category['route'] === 'kkdmp' ? 'Tambah KKDMP' : 'Tambah titik lokasi')))) }}</h2>
                <button class="icon-btn" type="button" aria-label="Tutup" onclick="closeModal()">×</button>
            </header>
            <form class="form-body" id="locationForm" method="POST" action="{{ $storeUrl }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="" disabled>
                <div class="section-divider">Informasi Dasar</div>
                @if (in_array($category['route'], ['pasar', 'kantor', 'wifi', 'bumdes'], true))
                    <div class="field-group">
                        <label for="villageField">Nama Desa</label>
                        <input class="field" id="villageField" name="desa" maxlength="255" required>
                    </div>
                @endif
                @if ($category['route'] === 'wifi')
                    <div class="field-group">
                        <label for="facilitatorField">Fasilitator</label>
                        <select class="field" id="facilitatorField" name="fasilitator" required>
                            <option value="">Pilih fasilitator</option>
                            <option value="pemerintah_desa">Pemerintah Desa</option>
                            <option value="pemerintah_kabupaten">Pemerintah Kabupaten</option>
                        </select>
                    </div>
                @endif
                <div class="field-group">
                    <label for="nameField">{{ $category['route'] === 'pasar' ? 'Nama Pasar' : ($category['route'] === 'kantor' ? 'Nama Balai Desa' : ($category['route'] === 'wifi' ? 'Nama SSID' : ($category['route'] === 'bumdes' ? 'Nama BUMDes' : ($category['route'] === 'kkdmp' ? 'Nama KKDMP' : 'Nama lokasi')))) }}</label>
                    <input class="field" id="nameField" name="nama_lokasi" maxlength="255" required>
                </div>
                @if ($category['route'] === 'kkdmp')
                    <div class="field-group">
                        <label for="kkdmpVillageField">Desa/Kelurahan</label>
                        <input class="field" id="kkdmpVillageField" name="desa_kelur" maxlength="255" required>
                    </div>
                    <div class="field-group">
                        <label for="kkdmpTypeField">Jenis</label>
                        <select class="field" id="kkdmpTypeField" name="jenis" required>
                            <option value="">Pilih jenis</option>
                            <option value="desa">Desa</option>
                            <option value="kelurahan">Kelurahan</option>
                        </select>
                    </div>
                    <div class="field-row">
                        <div class="field-group">
                            <label for="kkdmpLeaderField">Nama Ketua</label>
                            <input class="field" id="kkdmpLeaderField" name="nama_ketua" maxlength="255" required>
                        </div>
                        <div class="field-group">
                            <label for="ahuField">No. AHU</label>
                            <input class="field" id="ahuField" name="no_ahu" maxlength="255" required>
                        </div>
                    </div>
                @endif
                @if ($category['route'] === 'bumdes')
                    <div class="section-divider">Informasi Usaha</div>
                    <div class="field-group">
                        <label for="businessTypeField">Jenis Usaha</label>
                        <textarea class="textarea" id="businessTypeField" name="jenis_usaha" maxlength="5000" required></textarea>
                    </div>
                    <div class="field-group">
                        <label for="leaderField">Nama Ketua</label>
                        <input class="field" id="leaderField" name="nama_ketua" maxlength="255" required>
                    </div>
                @endif
                <div class="section-divider">Lokasi &amp; Kontak</div>
                <div class="field-group">
                    <label for="addressField">Alamat</label>
                    <input class="field" id="addressField" name="alamat" maxlength="5000">
                </div>
                @if ($category['route'] === 'kantor')
                    <div class="field-group">
                        <label for="linkMapsField">Link Maps</label>
                        <input class="field" id="linkMapsField" name="link_maps" type="url" maxlength="1000" placeholder="https://maps.app.goo.gl/...">
                    </div>
                @endif
                <div class="field-row">
                    <div class="field-group">
                        <label for="latitudeField">Latitude</label>
                        <input class="field" id="latitudeField" name="latitude" type="number" min="-90" max="90" step="any" required>
                    </div>
                    <div class="field-group">
                        <label for="longitudeField">Longitude</label>
                        <input class="field" id="longitudeField" name="longitude" type="number" min="-180" max="180" step="any" required>
                    </div>
                </div>
                <input type="hidden" id="propertiesField" name="properties" value="{}">
                @if (in_array($category['route'], ['pasar', 'kantor', 'wifi', 'bumdes', 'kkdmp'], true))
                    <div class="field-group">
                        <label for="photoField">Foto {{ $category['route'] === 'kantor' ? 'Balai Desa' : ($category['route'] === 'wifi' ? 'WiFi Desa' : ($category['route'] === 'bumdes' ? 'BUMDes' : ($category['route'] === 'kkdmp' ? 'KKDMP' : 'Pasar'))) }}</label>
                        <input class="field" id="photoField" name="foto" type="file" accept="image/jpeg,image/png,image/webp" onchange="previewLocationPhoto(this)">
                        <small style="color: var(--muted);">JPG, PNG, atau WEBP. Maksimal 2 MB.</small>
                        <div class="photo-preview" id="photoPreview">
                            <img id="photoPreviewImage" src="" alt="Preview foto lokasi">
                            <span id="photoPreviewLabel"></span>
                        </div>
                    </div>
                @endif
                <div class="modal-actions">
                    <button class="btn btn-light" type="button" onclick="closeModal()">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </section>
    </div>

    <script>
        const modal = document.getElementById('locationModal');
        const form = document.getElementById('locationForm');
        const methodField = document.getElementById('formMethod');
        const updateUrlTemplate = @json($updateUrlTemplate);
        const deleteUrlTemplate = @json($deleteUrlTemplate);
        const locationCategory = @json($category['route']);
        const detailModal = document.getElementById('locationDetailModal');
        let selectedLocationRow = null;
        let currentPhotoObjectUrl = null;

        function getLocationVillage(properties, locationName = '') {
            const village = [properties.nama_desa, properties.desa, properties.Desa, properties.kelurahan, properties.desa_kelur, properties.nama_kelurahan, properties.village]
                .map(value => String(value ?? '').trim())
                .find(value => value && value !== '-');

            if (village) return village;
            if (locationCategory === 'kantor') {
                return locationName.trim().replace(/^(?:BALAI|KANTOR)\s+DESA\s+/i, '') || '-';
            }

            return '-';
        }

        function setLocationPhotoPreview(source, label) {
            const preview = document.getElementById('photoPreview');
            const image = document.getElementById('photoPreviewImage');
            if (!preview || !image) return;
            const normalizedSource = typeof source === 'string' ? source.trim() : '';

            if (currentPhotoObjectUrl && currentPhotoObjectUrl !== normalizedSource) {
                URL.revokeObjectURL(currentPhotoObjectUrl);
            }
            currentPhotoObjectUrl = normalizedSource.startsWith('blob:') ? normalizedSource : null;

            if (!normalizedSource) {
                preview.classList.remove('visible');
                image.removeAttribute('src');
                return;
            }

            image.src = normalizedSource;
            document.getElementById('photoPreviewLabel').textContent = label || '';
            image.onerror = () => {
                preview.classList.remove('visible');
                image.removeAttribute('src');
            };
            preview.classList.add('visible');
        }

        function previewLocationPhoto(input) {
            const file = input.files?.[0];
            if (!file) return;

            setLocationPhotoPreview(URL.createObjectURL(file), file.name);
        }

        function openLocationDetail(row) {
            selectedLocationRow = row;
            const properties = JSON.parse(row.dataset.properties || '{}');
            const village = getLocationVillage(properties, row.dataset.name || '');
            const photo = String(properties.foto || properties.Foto || properties.image || '').trim();
            const photoContainer = document.getElementById('detailPhoto');

            document.getElementById('detailName').textContent = row.dataset.name || 'Lokasi tanpa nama';
            document.getElementById('detailVillage').textContent = village;
            document.getElementById('detailAddress').textContent = properties.alamat || row.dataset.address || '-';
            document.getElementById('detailLatitude').textContent = row.dataset.latitude || '-';
            document.getElementById('detailLongitude').textContent = row.dataset.longitude || '-';
            const facilitatorDetail = document.getElementById('detailFacilitator');
            if (facilitatorDetail) {
                const facilitator = String(properties.fasilitator || properties.fasilitato || '').trim().toLowerCase().replace(/\s+/g, '_');
                facilitatorDetail.textContent = {
                    pemerintah_desa: 'Pemerintah Desa',
                    pemerintah_kabupaten: 'Pemerintah Kabupaten'
                }[facilitator] || facilitator || '-';
            }
            const businessTypeDetail = document.getElementById('detailBusinessType');
            if (businessTypeDetail) businessTypeDetail.textContent = properties.jenis_usaha || properties.jenis_usah || '-';
            const leaderDetail = document.getElementById('detailLeader');
            if (leaderDetail) leaderDetail.textContent = properties.nama_ketua || '-';
            const kkdmpTypeDetail = document.getElementById('detailKkdmpType');
            if (kkdmpTypeDetail) {
                const type = String(properties.jenis || '').trim().toLowerCase();
                kkdmpTypeDetail.textContent = type === 'kelurahan' ? 'Kelurahan' : (type === 'desa' ? 'Desa' : '-');
            }
            const kkdmpLeaderDetail = document.getElementById('detailKkdmpLeader');
            if (kkdmpLeaderDetail) kkdmpLeaderDetail.textContent = properties.ketua || properties.nama_ketua || '-';
            const ahuDetail = document.getElementById('detailAhu');
            if (ahuDetail) ahuDetail.textContent = properties.no_ahu || '-';
            const mapsLink = document.getElementById('detailMapsLink');
            if (mapsLink) {
                const url = String(properties.link_maps || '').trim();
                mapsLink.textContent = url && /^https?:\/\//i.test(url) ? 'Buka Maps' : (url || '-');
                if (url && /^https?:\/\//i.test(url)) {
                    mapsLink.href = url;
                } else {
                    mapsLink.removeAttribute('href');
                }
            }
            document.getElementById('locationDeleteForm').action = deleteUrlTemplate.replace('__ID__', row.dataset.id);
            photoContainer.replaceChildren();

            if (photo) {
                const image = document.createElement('img');
                image.src = photo;
                image.alt = row.dataset.name || 'Foto lokasi';
                image.onerror = () => photoContainer.innerHTML = '<i class="bi bi-geo-alt-fill"></i>';
                photoContainer.appendChild(image);
            } else {
                photoContainer.innerHTML = '<i class="bi bi-geo-alt-fill"></i>';
            }

            detailModal.classList.add('open');
        }

        function closeDetailModal() {
            detailModal.classList.remove('open');
        }

        function editSelectedLocation() {
            const row = selectedLocationRow;
            closeDetailModal();
            if (row) openEditModal(row);
        }

        function openCreateModal() {
            form.reset();
            form.action = @json($storeUrl);
            methodField.disabled = true;
            document.getElementById('modalTitle').textContent = @json($category['route'] === 'pasar' ? 'Tambah Pasar Desa' : ($category['route'] === 'kantor' ? 'Tambah Balai Desa' : ($category['route'] === 'wifi' ? 'Tambah WiFi Desa' : ($category['route'] === 'bumdes' ? 'Tambah BUMDes' : ($category['route'] === 'kkdmp' ? 'Tambah KKDMP' : 'Tambah titik lokasi')))));
            document.getElementById('propertiesField').value = '{}';
            const mapsField = document.getElementById('linkMapsField');
            if (mapsField) mapsField.value = '';
            const villageField = document.getElementById('villageField');
            if (villageField) villageField.value = '';
            const facilitatorField = document.getElementById('facilitatorField');
            if (facilitatorField) facilitatorField.value = '';
            const businessTypeField = document.getElementById('businessTypeField');
            if (businessTypeField) businessTypeField.value = '';
            const leaderField = document.getElementById('leaderField');
            if (leaderField) leaderField.value = '';
            const kkdmpVillageField = document.getElementById('kkdmpVillageField');
            if (kkdmpVillageField) kkdmpVillageField.value = '';
            const kkdmpTypeField = document.getElementById('kkdmpTypeField');
            if (kkdmpTypeField) kkdmpTypeField.value = '';
            const kkdmpLeaderField = document.getElementById('kkdmpLeaderField');
            if (kkdmpLeaderField) kkdmpLeaderField.value = '';
            const ahuField = document.getElementById('ahuField');
            if (ahuField) ahuField.value = '';
            setLocationPhotoPreview('', '');
            modal.classList.add('open');
            document.getElementById('nameField').focus();
        }

        function openEditModal(button) {
            form.reset();
            form.action = updateUrlTemplate.replace('__ID__', button.dataset.id);
            methodField.disabled = false;
            methodField.value = 'PUT';
            document.getElementById('modalTitle').textContent = @json($category['route'] === 'pasar' ? 'Edit Pasar Desa' : ($category['route'] === 'kantor' ? 'Edit Balai Desa' : ($category['route'] === 'wifi' ? 'Edit WiFi Desa' : ($category['route'] === 'bumdes' ? 'Edit BUMDes' : ($category['route'] === 'kkdmp' ? 'Edit KKDMP' : 'Edit titik lokasi')))));
            document.getElementById('nameField').value = button.dataset.name || '';
            document.getElementById('addressField').value = button.dataset.address || '';
            document.getElementById('latitudeField').value = button.dataset.latitude || '';
            document.getElementById('longitudeField').value = button.dataset.longitude || '';

            try {
                const properties = JSON.parse(button.dataset.properties || '{}');
                document.getElementById('propertiesField').value = JSON.stringify(properties, null, 2);
                const mapsField = document.getElementById('linkMapsField');
                if (mapsField) mapsField.value = properties.link_maps || '';
                const villageField = document.getElementById('villageField');
                if (villageField) villageField.value = getLocationVillage(properties, button.dataset.name || '') === '-' ? '' : getLocationVillage(properties, button.dataset.name || '');
                const facilitatorField = document.getElementById('facilitatorField');
                if (facilitatorField) {
                    facilitatorField.value = String(properties.fasilitator || properties.fasilitato || '')
                        .trim()
                        .toLowerCase()
                        .replace(/\s+/g, '_');
                }
                    const businessTypeField = document.getElementById('businessTypeField');
                    if (businessTypeField) businessTypeField.value = properties.jenis_usaha || properties.jenis_usah || '';
                    const leaderField = document.getElementById('leaderField');
                    if (leaderField) leaderField.value = properties.nama_ketua || '';
                    const kkdmpVillageField = document.getElementById('kkdmpVillageField');
                    if (kkdmpVillageField) kkdmpVillageField.value = properties.desa_kelur || '';
                    const kkdmpTypeField = document.getElementById('kkdmpTypeField');
                    if (kkdmpTypeField) kkdmpTypeField.value = String(properties.jenis || '').trim().toLowerCase();
                    const kkdmpLeaderField = document.getElementById('kkdmpLeaderField');
                    if (kkdmpLeaderField) kkdmpLeaderField.value = properties.ketua || properties.nama_ketua || '';
                    const ahuField = document.getElementById('ahuField');
                    if (ahuField) ahuField.value = properties.no_ahu || '';
                setLocationPhotoPreview(properties.foto || properties.Foto || properties.image || '', 'Foto tersimpan. Pilih file baru untuk mengganti.');
            } catch (error) {
                document.getElementById('propertiesField').value = button.dataset.properties || '{}';
                setLocationPhotoPreview('', '');
            }

            modal.classList.add('open');
            document.getElementById('nameField').focus();
        }

        function closeModal() {
            modal.classList.remove('open');
        }

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                closeModal();
                closeDetailModal();
            }
        });
    </script>
</body>
</html>