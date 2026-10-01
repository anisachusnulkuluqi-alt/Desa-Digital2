<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontributor - Portal Desa Digital</title>
    <link rel="icon" type="image/png" href="{{ asset('images/desa-digital.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; color: #1e293b; }
        .admin-main { min-height: 100vh; margin-left: 260px; }
        .admin-topbar { position: sticky; top: 0; z-index: 90; display: flex; min-height: 62px; align-items: center; justify-content: space-between; padding: 0 28px; border-bottom: 1px solid #e2e8f0; background: #fff; }
        .admin-content { max-width: 1200px; margin: 0 auto; padding: 28px; }
        .page-heading { margin-bottom: 24px; }
        .page-heading h1 { margin: 0; color: #1e293b; font-size: 26px; font-weight: 800; }
        .page-heading p { margin: 6px 0 0; color: #64748b; font-size: 13px; }
        .panel { margin-bottom: 20px; overflow: hidden; border: 1px solid #e2e8f0; border-radius: 10px; background: #fff; }
        .panel-heading { padding: 16px 20px; border-bottom: 1px solid #e2e8f0; color: #1e293b; font-size: 14px; font-weight: 700; }
        .panel-body { padding: 20px; }
        .account-form { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .field { display: flex; flex-direction: column; gap: 6px; }
        .field label { color: #334155; font-size: 12px; font-weight: 700; }
        .field input { min-height: 40px; padding: 8px 11px; border: 1px solid #cbd5e1; border-radius: 6px; font: inherit; font-size: 13px; }
        .field input:focus { border-color: #2563eb; outline: 3px solid #2563eb20; }
        .form-actions { grid-column: 1 / -1; display: flex; justify-content: flex-end; }
        .submit-button { min-height: 40px; padding: 0 16px; border: 0; border-radius: 6px; background: #1e40af; color: white; font: inherit; font-size: 13px; font-weight: 700; cursor: pointer; }
        .submit-button:hover { background: #1d4ed8; }
        .alert { margin-bottom: 18px; padding: 12px 16px; border: 1px solid #86efac; border-radius: 6px; background: #dcfce7; color: #166534; font-size: 13px; }
        .form-error { color: #b91c1c; font-size: 12px; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 16px; border-bottom: 1px solid #e2e8f0; text-align: left; font-size: 13px; }
        th { background: #f8fafc; color: #64748b; font-size: 11px; text-transform: uppercase; }
        tbody tr:last-child td { border-bottom: 0; }
        .empty-row { padding: 24px; color: #64748b; text-align: center; }
        .row-actions { display: flex; align-items: center; gap: 8px; }
        .row-action { display: inline-flex; min-height: 32px; align-items: center; gap: 5px; padding: 0 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: #fff; color: #334155; font: inherit; font-size: 12px; text-decoration: none; cursor: pointer; }
        .row-action:hover { background: #f1f5f9; }
        .row-action--delete { border-color: #fecaca; color: #b91c1c; }
        .row-action--delete:hover { background: #fef2f2; }
        .delete-form { margin: 0; }
        .pagination-wrap { padding: 14px 18px; border-top: 1px solid #e2e8f0; }
        @media (max-width: 992px) { .admin-main { margin-left: 0; } }
        @media (max-width: 640px) {
            .admin-topbar { padding: 0 16px; }
            .admin-content { padding: 20px 14px; }
            .account-form { grid-template-columns: 1fr; }
            .form-actions { grid-column: auto; }
            .submit-button { width: 100%; }
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
                <h1>Kontributor</h1>
                <p>Kelola akun yang dapat mengakses fitur CRUD administrasi.</p>
            </div>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            <section class="panel">
                <div class="panel-heading">Tambah akun kontributor</div>
                <div class="panel-body">
                    <form class="account-form" method="POST" action="{{ route('admin.kontributor.store') }}">
                        @csrf
                        <div class="field">
                            <label for="name">Nama</label>
                            <input id="name" name="name" type="text" value="{{ old('name') }}" required maxlength="255" autocomplete="name">
                            @error('name') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
                            @error('email') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="password">Kata sandi</label>
                            <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password">
                            @error('password') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="field">
                            <label for="password_confirmation">Konfirmasi kata sandi</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8" autocomplete="new-password">
                        </div>
                        <div class="form-actions">
                            <button class="submit-button" type="submit"><i class="bi bi-person-plus-fill"></i> Tambah kontributor</button>
                        </div>
                    </form>
                </div>
            </section>

            <section class="panel">
                <div class="panel-heading">Daftar kontributor <span>({{ $contributors->total() }})</span></div>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr><th>Nama</th><th>Email</th><th>Dibuat</th><th>Aksi</th></tr>
                        </thead>
                        <tbody>
                            @forelse ($contributors as $contributor)
                                <tr>
                                    <td>{{ $contributor->name }}</td>
                                    <td>{{ $contributor->email }}</td>
                                    <td>{{ $contributor->created_at?->format('d M Y') ?? '-' }}</td>
                                    <td>
                                        <div class="row-actions">
                                            <a class="row-action" href="{{ route('admin.kontributor.edit', $contributor->id) }}"><i class="bi bi-pencil-square"></i> Edit</a>
                                            <form class="delete-form" method="POST" action="{{ route('admin.kontributor.destroy', $contributor->id) }}" onsubmit="return confirm('Hapus akun kontributor ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="row-action row-action--delete" type="submit"><i class="bi bi-trash"></i> Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td class="empty-row" colspan="4">Belum ada kontributor.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($contributors->hasPages())
                    <div class="pagination-wrap">{{ $contributors->links() }}</div>
                @endif
            </section>
        </main>
    </div>
</body>
</html>