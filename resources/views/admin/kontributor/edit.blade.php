<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontributor - Portal Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; }
        .admin-main { min-height: 100vh; margin-left: 260px; }
        .admin-topbar { position: sticky; top: 0; z-index: 90; display: flex; min-height: 62px; align-items: center; justify-content: space-between; padding: 0 28px; border-bottom: 1px solid #e2e8f0; background: #fff; }
        .admin-content { max-width: 900px; margin: 0 auto; padding: 28px; }
        .page-heading { margin-bottom: 24px; }
        .page-heading h1 { margin: 0; color: #1e293b; font-size: 26px; font-weight: 800; }
        .page-heading p { margin: 6px 0 0; color: #64748b; font-size: 13px; }
        .panel { overflow: hidden; border: 1px solid #e2e8f0; border-radius: 10px; background: #fff; }
        .panel-heading { padding: 16px 20px; border-bottom: 1px solid #e2e8f0; color: #1e293b; font-size: 14px; font-weight: 700; }
        .panel-body { padding: 20px; }
        .account-form { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .field { display: flex; flex-direction: column; gap: 6px; }
        .field label { color: #334155; font-size: 12px; font-weight: 700; }
        .field input { min-height: 40px; padding: 8px 11px; border: 1px solid #cbd5e1; border-radius: 6px; font: inherit; font-size: 13px; }
        .field input:focus { border-color: #2563eb; outline: 3px solid #2563eb20; }
        .field small { color: #64748b; font-size: 11px; }
        .form-error { color: #b91c1c; font-size: 12px; }
        .form-actions { grid-column: 1 / -1; display: flex; justify-content: flex-end; gap: 10px; margin-top: 4px; }
        .action-button { display: inline-flex; min-height: 40px; align-items: center; justify-content: center; gap: 7px; padding: 0 15px; border: 1px solid #cbd5e1; border-radius: 6px; background: #fff; color: #334155; font: inherit; font-size: 13px; font-weight: 700; text-decoration: none; cursor: pointer; }
        .action-button--save { border-color: #1e40af; background: #1e40af; color: #fff; }
        .action-button--save:hover { background: #1d4ed8; color: #fff; }
        @media (max-width: 992px) { .admin-main { margin-left: 0; } }
        @media (max-width: 640px) {
            .admin-topbar { padding: 0 16px; }
            .admin-content { padding: 20px 14px; }
            .account-form { grid-template-columns: 1fr; }
            .form-actions { grid-column: auto; flex-direction: column-reverse; }
            .action-button { width: 100%; }
        }
    </style>
</head>
<body>
    @include('admin.partials.sidebar', ['activeMenu' => 'kontributor'])

    <div class="admin-main">
        <header class="admin-topbar">
            <strong>Manajemen Pengguna</strong>
            <span>{{ auth()->user()->name }}</span>
        </header>

        <main class="admin-content">
            <div class="page-heading">
                <h1>Edit Kontributor</h1>
                <p>Perbarui informasi akun kontributor.</p>
            </div>

            <section class="panel">
                <div class="panel-heading">{{ $contributor->name }}</div>
                <div class="panel-body">
                    <form class="account-form" method="POST" action="{{ route('admin.kontributor.update', $contributor->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="field">
                            <label for="name">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $contributor->name) }}" required maxlength="255" autocomplete="name">
                            @error('name') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $contributor->email) }}" required maxlength="255" autocomplete="email">
                            @error('email') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="password">Password baru</label>
                            <input id="password" name="password" type="password" minlength="8" autocomplete="new-password">
                            <small>Kosongkan jika password tidak ingin diubah.</small>
                            @error('password') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="password_confirmation">Konfirmasi password baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password">
                        </div>
                        <div class="form-actions">
                            <a class="action-button" href="{{ route('admin.kontributor.index') }}">Batal</a>
                            <button class="action-button action-button--save" type="submit"><i class="bi bi-check-lg"></i> Simpan perubahan</button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
</body>
</html>