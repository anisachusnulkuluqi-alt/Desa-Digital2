<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $category['label'] }} | Admin Desa Digital</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #101a35;
            --blue: #2563eb;
            --blue-dark: #1d4ed8;
            --ink: #17233d;
            --muted: #71809b;
            --line: #e2e8f2;
            --canvas: #f4f7fb;
            --white: #fff;
            --red: #c2413b;
            --green: #13795b;
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: var(--canvas); color: var(--ink); font: 14px 'DM Sans', sans-serif; }
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
        .content { max-width: 1440px; margin: 0 auto; padding: 26px 28px 40px; }
        .page-head { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 20px; }
        .eyebrow { margin: 0 0 6px; color: var(--blue); font-size: 11px; font-weight: 700; text-transform: uppercase; }
        h1 { margin: 0; font: 800 24px 'Manrope', sans-serif; }
        .subtitle { margin: 7px 0 0; color: var(--muted); font-size: 13px; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 38px; padding: 0 13px; border: 1px solid transparent; border-radius: 6px; cursor: pointer; text-decoration: none; font-weight: 700; }
        .btn-primary { background: var(--blue); color: #fff; }
        .btn-primary:hover { background: var(--blue-dark); }
        .btn-light { border-color: var(--line); background: #fff; color: var(--ink); }
        .btn-danger { border-color: #f4d1ce; background: #fff; color: var(--red); }
        .panel { overflow: hidden; border: 1px solid var(--line); border-radius: 8px; background: #fff; }
        .panel-toolbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; padding: 15px 18px; border-bottom: 1px solid var(--line); }
        .count { color: var(--muted); font-size: 12px; }
        .count strong { color: var(--ink); font-size: 17px; }
        .search { width: min(320px, 100%); height: 37px; padding: 0 11px; border: 1px solid var(--line); border-radius: 6px; outline: none; }
        .search:focus, .field:focus, .textarea:focus { border-color: #7aa5ff; box-shadow: 0 0 0 3px #2563eb18; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 11px 16px; background: #f8faff; color: #677590; font-size: 10px; font-weight: 700; text-transform: uppercase; white-space: nowrap; }
        td { padding: 12px 16px; border-top: 1px solid #edf0f5; color: #42516c; vertical-align: middle; }
        tbody tr:hover { background: #fbfcff; }
        .name { color: var(--ink); font-weight: 700; }
        .address { max-width: 300px; overflow: hidden; color: var(--muted); text-overflow: ellipsis; white-space: nowrap; }
        .coords { white-space: nowrap; font: 12px ui-monospace, SFMono-Regular, Consolas, monospace; }
        .map-link { color: var(--blue); text-decoration: none; }
        .map-link:hover { text-decoration: underline; }
        .actions { display: flex; align-items: center; gap: 7px; white-space: nowrap; }
        .btn-small { min-height: 30px; padding: 0 9px; font-size: 12px; }
        .inline-form { display: inline; margin: 0; }
        .empty { padding: 45px 16px; color: var(--muted); text-align: center; }
        .pagination { padding: 14px 18px; border-top: 1px solid var(--line); }
        .alert { margin-bottom: 16px; padding: 11px 14px; border: 1px solid #a8e0ce; border-radius: 6px; background: #eaf8f2; color: var(--green); }
        .alert-error { border-color: #f1c1bd; background: #fff1f0; color: var(--red); }
        .modal-backdrop { position: fixed; inset: 0; z-index: 20; display: none; place-items: center; padding: 20px; background: #0c1636a8; }
        .modal-backdrop.open { display: grid; }
        .modal { width: min(620px, 100%); max-height: min(92vh, 850px); overflow: auto; border-radius: 8px; background: #fff; box-shadow: 0 24px 80px #07112b40; }
        .modal-head { display: flex; align-items: center; justify-content: space-between; padding: 18px 20px; border-bottom: 1px solid var(--line); }
        .modal-head h2 { margin: 0; font: 700 17px 'Manrope', sans-serif; }
        .icon-btn { width: 32px; height: 32px; border: 0; border-radius: 6px; background: #f1f4f9; color: var(--ink); cursor: pointer; font-size: 18px; }
        .form-body { display: grid; gap: 14px; padding: 20px; }
        .field-group { display: grid; gap: 6px; }
        .field-group label { color: #52617b; font-size: 12px; font-weight: 700; }
        .field { width: 100%; min-height: 39px; padding: 9px 11px; border: 1px solid var(--line); border-radius: 6px; outline: none; }
        .textarea { width: 100%; min-height: 130px; resize: vertical; padding: 10px 11px; border: 1px solid var(--line); border-radius: 6px; outline: none; font: 12px ui-monospace, SFMono-Regular, Consolas, monospace; }
        .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
        .modal-actions { display: flex; justify-content: flex-end; gap: 8px; padding-top: 3px; }
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
                        <p class="subtitle">Kelola nama, alamat, koordinat, dan properti GeoJSON.</p>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="openCreateModal()"><span aria-hidden="true">＋</span> Tambah titik</button>
                </div>

                <section class="panel" aria-label="Daftar {{ $category['label'] }}">
                    <div class="panel-toolbar">
                        <div class="count"><strong>{{ number_format($totalLocations) }}</strong> titik tersimpan</div>
                        <form method="GET" action="{{ url()->current() }}">
                            <input class="search" type="search" name="search" value="{{ request('search') }}" placeholder="Cari nama tempat atau desa..." aria-label="Cari nama tempat atau desa">
                        </form>
                    </div>
                    <div class="table-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nama tempat</th>
                                    <th>Desa</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locations as $location)
                                    @php
                                        $locationProperties = is_array($location->properties)
                                            ? $location->properties
                                            : (json_decode($location->properties ?? '{}', true) ?: []);
                                        $village = $locationProperties['nama_desa']
                                            ?? $locationProperties['desa']
                                            ?? $locationProperties['Desa']
                                            ?? $locationProperties['kelurahan']
                                            ?? $locationProperties['desa_kelur']
                                            ?? '-';
                                    @endphp
                                    <tr>
                                        <td><span class="name">{{ $location->nama_lokasi ?: 'Tanpa nama' }}</span></td>
                                        <td>{{ $village }}</td>
                                        <td>
                                            <div class="actions">
                                                <button class="btn btn-light btn-small" type="button" data-id="{{ $location->id }}" data-name="{{ $location->nama_lokasi }}" data-address="{{ $location->alamat }}" data-latitude="{{ $location->latitude }}" data-longitude="{{ $location->longitude }}" data-properties="{{ $location->properties ?: '{}' }}" onclick="openEditModal(this)">Edit</button>
                                                <form class="inline-form" method="POST" action="{{ str_replace('__ID__', (string) $location->id, $deleteUrlTemplate) }}" onsubmit="return confirm('Hapus titik lokasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-small" type="submit">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td class="empty" colspan="3">Belum ada titik pada kategori ini.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if ($locations->hasPages())
                        <div class="pagination">{{ $locations->links() }}</div>
                    @endif
                </section>
            </section>
        </main>
    </div>

    <div class="modal-backdrop" id="locationModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" onclick="if (event.target === this) closeModal()">
        <section class="modal">
            <header class="modal-head">
                <h2 id="modalTitle">Tambah titik lokasi</h2>
                <button class="icon-btn" type="button" aria-label="Tutup" onclick="closeModal()">×</button>
            </header>
            <form class="form-body" id="locationForm" method="POST" action="{{ $storeUrl }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="" disabled>
                <div class="field-group">
                    <label for="nameField">Nama lokasi</label>
                    <input class="field" id="nameField" name="nama_lokasi" maxlength="255" required>
                </div>
                <div class="field-group">
                    <label for="addressField">Alamat</label>
                    <input class="field" id="addressField" name="alamat" maxlength="5000">
                </div>
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
                <div class="field-group">
                    <label for="propertiesField">Properti GeoJSON (JSON)</label>
                    <textarea class="textarea" id="propertiesField" name="properties" spellcheck="false">{}</textarea>
                </div>
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

        function openCreateModal() {
            form.reset();
            form.action = @json($storeUrl);
            methodField.disabled = true;
            document.getElementById('modalTitle').textContent = 'Tambah titik lokasi';
            document.getElementById('propertiesField').value = '{}';
            modal.classList.add('open');
            document.getElementById('nameField').focus();
        }

        function openEditModal(button) {
            form.reset();
            form.action = updateUrlTemplate.replace('__ID__', button.dataset.id);
            methodField.disabled = false;
            methodField.value = 'PUT';
            document.getElementById('modalTitle').textContent = 'Edit titik lokasi';
            document.getElementById('nameField').value = button.dataset.name || '';
            document.getElementById('addressField').value = button.dataset.address || '';
            document.getElementById('latitudeField').value = button.dataset.latitude || '';
            document.getElementById('longitudeField').value = button.dataset.longitude || '';

            try {
                document.getElementById('propertiesField').value = JSON.stringify(JSON.parse(button.dataset.properties || '{}'), null, 2);
            } catch (error) {
                document.getElementById('propertiesField').value = button.dataset.properties || '{}';
            }

            modal.classList.add('open');
            document.getElementById('nameField').focus();
        }

        function closeModal() {
            modal.classList.remove('open');
        }

        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') closeModal();
        });
    </script>
</body>
</html>