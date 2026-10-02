<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kontributor - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: #0f172a; min-height: 100vh; position: fixed; left: 0; top: 0; padding: 20px 14px; z-index: 100; }
        .sidebar-brand { display: flex; align-items: center; gap: 10px; padding: 8px 12px; margin-bottom: 30px; }
        .sidebar-brand-icon { width: 38px; height: 38px; background: #2563eb; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; }
        .sidebar-brand-text h5 { color: white; font-weight: 700; font-size: 14px; margin: 0; }
        .sidebar-brand-text small { color: #64748b; font-size: 10px; }
        .sidebar-menu { list-style: none; padding: 0; }
        .sidebar-menu li { margin-bottom: 4px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; color: #94a3b8; text-decoration: none; border-radius: 8px; font-size: 13px; font-weight: 500; transition: all 0.2s; }
        .sidebar-menu a:hover, .sidebar-menu a.active { background: #2563eb; color: white; }
        .sidebar-menu a i { font-size: 16px; width: 18px; text-align: center; }
        
        .main-content { margin-left: 260px; }
        
        /* Header - Sama dengan KKDMP */
        .top-header { 
            background: white; 
            border-bottom: 1px solid #e2e8f0; 
            padding: 14px 28px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
            position: sticky; 
            top: 0; 
            z-index: 99; 
        }

        .breadcrumb-simple { 
            font-size: 13px; 
            color: #64748b; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
        }

        .breadcrumb-simple a { 
            color: #64748b; 
            text-decoration: none; 
            transition: color 0.2s;
        }

        .breadcrumb-simple a:hover { 
            color: #1e3a8a; 
        }

        .breadcrumb-simple .separator { 
            color: #cbd5e1; 
        }

        .breadcrumb-simple .active { 
            color: #1e293b; 
            font-weight: 600; 
        }

        .header-actions { 
            display: flex; 
            align-items: center; 
            gap: 12px; 
        }

        /* Tombol Rumah - Putih dengan Border (seperti KKDMP) */
        .header-home-btn { 
            width: 38px; 
            height: 38px; 
            border-radius: 8px; 
            background: white; 
            border: 1px solid #e2e8f0; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: #64748b; 
            cursor: pointer; 
            transition: all 0.2s; 
            text-decoration: none; 
            font-size: 16px;
        }

        .header-home-btn:hover { 
            background: #f8fafc; 
            border-color: #cbd5e1;
            color: #1e3a8a;
        }

        .user-profile { 
            display: flex; 
            align-items: center; 
            gap: 10px; 
            padding: 6px 12px; 
            background: white; 
            border: 1px solid #e2e8f0; 
            border-radius: 10px; 
            cursor: pointer; 
        }

        .user-avatar { 
            width: 32px; 
            height: 32px; 
            border-radius: 8px; 
            background: #1e3a8a; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: white; 
            font-weight: 700; 
            font-size: 12px; 
        }

        .user-info strong { 
            display: block; 
            font-size: 12px; 
            font-weight: 600; 
            color: #1e293b; 
        }

        .user-info small { 
            font-size: 10px; 
            color: #64748b; 
        }
        
        /* Page Body */
        .page-body { padding: 28px; }
        .page-header { margin-bottom: 24px; }
        .page-label { font-size: 11px; font-weight: 700; color: #1e3a8a; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px; }
        .page-title { font-size: 28px; font-weight: 800; color: #1e293b; margin-bottom: 6px; }
        .page-subtitle { font-size: 13px; color: #64748b; }
        
        /* Card */
        .card-modern { background: white; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 24px; }
        .card-header-modern { padding: 20px 24px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; }
        .card-title-modern { font-size: 16px; font-weight: 700; color: #1e293b; display: flex; align-items: center; gap: 10px; }
        .card-title-modern i { color: #1e3a8a; font-size: 18px; }
        .badge-count { background: #1e3a8a; color: white; font-size: 11px; padding: 3px 10px; border-radius: 10px; font-weight: 600; }
        
        /* Form */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 24px; }
        .form-group { margin-bottom: 0; }
        .form-label-custom { display: block; font-size: 12px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.3px; }
        .form-label-custom .required { color: #ef4444; margin-left: 2px; }
        .form-input-custom { width: 100%; padding: 10px 14px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; font-weight: 500; color: #1e293b; background: #f8fafc; transition: all 0.25s; font-family: 'Inter', sans-serif; }
        .form-input-custom:focus { outline: none; border-color: #1e3a8a; background: white; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .form-input-custom::placeholder { color: #94a3b8; }
        
        .form-actions { padding: 16px 24px; border-top: 1px solid #e2e8f0; background: #f8fafc; display: flex; justify-content: flex-end; gap: 10px; }
        
        .btn-primary-custom { background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border: none; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-primary-custom:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3); color: white; }
        .btn-secondary-custom { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-secondary-custom:hover { background: #f8fafc; border-color: #cbd5e1; color: #1e293b; }
        
        /* Table */
        .table-modern { width: 100%; border-collapse: collapse; }
        .table-modern thead { background: #f8fafc; }
        .table-modern th { padding: 14px 20px; font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .table-modern td { padding: 16px 20px; font-size: 13px; color: #1e293b; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        .table-modern tbody tr { transition: all 0.2s; }
        .table-modern tbody tr:hover { background: #f8fafc; }
        .table-modern tbody tr:last-child td { border-bottom: none; }
        
        .user-cell { display: flex; align-items: center; gap: 12px; }
        .user-cell-avatar { width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 13px; flex-shrink: 0; }
        .user-cell-name { font-weight: 600; color: #1e293b; }
        
        .badge-role { display: inline-block; padding: 3px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
        .badge-admin { background: #dbeafe; color: #1e40af; }
        .badge-kontributor { background: #dcfce7; color: #166534; }
        
        .btn-action { padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; border: 1px solid #e2e8f0; background: white; color: #64748b; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; margin-right: 6px; }
        .btn-action:hover { background: #f8fafc; }
        .btn-edit:hover { color: #1e3a8a; border-color: #1e3a8a; }
        .btn-delete:hover { color: #dc2626; border-color: #dc2626; background: #fef2f2; }
        
        .empty-state { text-align: center; padding: 60px 20px; color: #94a3b8; }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; color: #cbd5e1; }
        .empty-state h4 { font-size: 16px; font-weight: 600; color: #64748b; margin-bottom: 8px; }
        .empty-state p { font-size: 13px; }
        
        /* Alert */
        .alert-banner { padding: 14px 20px; border-radius: 10px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; }
        .alert-success { background: #dcfce7; border: 1px solid #86efac; color: #166534; }
        .alert-error { background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; }
        .alert-banner i { font-size: 18px; }
        .alert-banner .close-btn { margin-left: auto; background: none; border: none; cursor: pointer; font-size: 16px; color: inherit; }
        
        /* Password toggle */
        .password-wrapper { position: relative; }
        .password-toggle { position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #94a3b8; cursor: pointer; font-size: 16px; }
        .password-toggle:hover { color: #1e3a8a; }
        
        /* Role Info Banner */
        .role-info-banner { background: #dbeafe; border: 1px solid #93c5fd; color: #1e40af; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 13px; font-weight: 500; }
        .role-info-banner i { font-size: 16px; }
        
        @media (max-width: 992px) { .sidebar { transform: translateX(-100%); } .main-content { margin-left: 0; } .form-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon"><i class="bi bi-house-heart-fill"></i></div>
            <div class="sidebar-brand-text">
                <h5>Desa Digital</h5>
                <small>Admin pengelola data</small>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="bi bi-house-fill"></i><span>Beranda</span></a></li>
            <li><a href="{{ route('admin.kecamatan.index') }}"><i class="bi bi-geo-alt-fill"></i><span>Kecamatan</span></a></li>
            <li><a href="{{ route('admin.desa.index') }}"><i class="bi bi-houses-fill"></i><span>Desa</span></a></li>
            <li><a href="{{ route('admin.wisata.index') }}"><i class="bi bi-image-fill"></i><span>Wisata Desa</span></a></li>
            <li><a href="{{ route('admin.pasar.index') }}"><i class="bi bi-shop"></i><span>Pasar Desa</span></a></li>
            <li><a href="{{ route('admin.kantor.index') }}"><i class="bi bi-building"></i><span>Kantor Desa</span></a></li>
            <li><a href="{{ route('admin.wifi.index') }}"><i class="bi bi-wifi"></i><span>WiFi Desa</span></a></li>
            <li><a href="{{ route('admin.bumdes.index') }}"><i class="bi bi-briefcase-fill"></i><span>BUMDes</span></a></li>
            <li><a href="{{ route('admin.kkdmp.index') }}"><i class="bi bi-people-fill"></i><span>KKDMP</span></a></li>
            <li><a href="{{ route('admin.kontributor.index') }}" class="active"><i class="bi bi-people-fill"></i><span>Kontributor</span></a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header (Sama dengan KKDMP) -->
        <header class="top-header">
            <div class="breadcrumb-simple">
                <a href="{{ route('dashboard') }}">Admin</a>
                <span class="separator">/</span>
                <span class="active">Kontributor</span>
            </div>
            <div class="header-actions">
                <a href="{{ url('/') }}" class="header-home-btn" title="Kembali ke Website">
                    <i class="bi bi-house-fill"></i>
                </a>
                <div class="user-profile">
                    <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}</div>
                    <div class="user-info">
                        <strong>{{ Auth::user()->name ?? 'Admin' }}</strong>
                        <small>{{ ucfirst(Auth::user()->role ?? 'Admin') }}</small>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-body">
            <div class="page-header">
                <div class="page-label">MANAJEMEN PENGGUNA</div>
                <h1 class="page-title">Kontributor</h1>
                <p class="page-subtitle">Kelola akun yang dapat mengakses fitur CRUD administrasi.</p>
            </div>

            @if(session('success'))
            <div class="alert-banner alert-success">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
                <button class="close-btn" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert-banner alert-error">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <span>{{ session('error') }}</span>
                <button class="close-btn" onclick="this.parentElement.style.display='none'"><i class="bi bi-x-lg"></i></button>
            </div>
            @endif

            @php
                $dataKontributor = $kontributors ?? $contributors ?? $kontributor ?? $users ?? collect();
                $isAdmin = auth()->user()->role === 'admin';
            @endphp

            {{-- Info Role untuk Kontributor --}}
            @if(!$isAdmin)
            <div class="role-info-banner">
                <i class="bi bi-info-circle-fill"></i>
                <span>Anda login sebagai <strong>Kontributor</strong>. Anda hanya dapat menambah dan mengedit data. Tombol hapus tidak tersedia.</span>
            </div>
            @endif

            {{-- Form Tambah - HANYA ADMIN --}}
            @if($isAdmin)
            <div class="card-modern">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <i class="bi bi-person-plus-fill"></i>
                        Tambah Akun Kontributor
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.kontributor.store') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label-custom">Nama <span class="required">*</span></label>
                            <input type="text" name="name" class="form-input-custom" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                            @error('name')
                                <small style="color: #dc2626; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Email <span class="required">*</span></label>
                            <input type="email" name="email" class="form-input-custom" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                            @error('email')
                                <small style="color: #dc2626; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Kata Sandi <span class="required">*</span></label>
                            <div class="password-wrapper">
                                <input type="password" name="password" id="password" class="form-input-custom" placeholder="Minimal 8 karakter" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('password', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <small style="color: #dc2626; font-size: 11px; margin-top: 4px; display: block;">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label-custom">Konfirmasi Kata Sandi <span class="required">*</span></label>
                            <div class="password-wrapper">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-input-custom" placeholder="Ulangi kata sandi" required>
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group" style="grid-column: 1 / -1;">
                            <label class="form-label-custom">Role</label>
                            <select name="role" class="form-input-custom">
                                <option value="kontributor" {{ old('role') == 'kontributor' ? 'selected' : '' }}>Kontributor</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="reset" class="btn-secondary-custom">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </button>
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-person-plus-fill"></i> Tambah Kontributor
                        </button>
                    </div>
                </form>
            </div>
            @endif

            {{-- Daftar Kontributor --}}
            <div class="card-modern">
                <div class="card-header-modern">
                    <div class="card-title-modern">
                        <i class="bi bi-list-ul"></i>
                        Daftar Kontributor
                        <span class="badge-count">{{ $dataKontributor->count() }} Akun</span>
                    </div>
                </div>
                <div style="overflow-x: auto;">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 50px;">NO</th>
                                <th>NAMA</th>
                                <th>EMAIL</th>
                                <th>ROLE</th>
                                <th>DIBUAT</th>
                                @if($isAdmin)
                                <th style="width: 140px;">AKSI</th>
                                @else
                                <th style="width: 100px;">AKSI</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dataKontributor as $index => $item)
                            <tr>
                                <td style="color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-cell-avatar">{{ strtoupper(substr($item->name ?? 'A', 0, 1)) }}</div>
                                        <div class="user-cell-name">{{ $item->name }}</div>
                                    </div>
                                </td>
                                <td style="color: #64748b;">{{ $item->email }}</td>
                                <td>
                                    @if(($item->role ?? '') === 'admin')
                                        <span class="badge-role badge-admin"><i class="bi bi-shield-check"></i> Admin</span>
                                    @else
                                        <span class="badge-role badge-kontributor"><i class="bi bi-person-check"></i> Kontributor</span>
                                    @endif
                                </td>
                                <td style="color: #64748b; font-size: 12px;">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                                </td>
                                <td>
                                    {{-- Tombol Edit - Semua Role --}}
                                    <button class="btn-action btn-edit" onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ addslashes($item->email) }}', '{{ $item->role ?? 'kontributor' }}')">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                    
                                    {{-- Tombol Hapus - HANYA ADMIN --}}
                                    @if($isAdmin)
                                    <form method="POST" action="{{ route('admin.kontributor.destroy', $item->id) }}" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus kontributor ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="{{ $isAdmin ? 6 : 5 }}">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox"></i>
                                        <h4>Belum ada kontributor</h4>
                                        <p>Tambahkan kontributor pertama menggunakan form di atas.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); color: white; border-radius: 12px 12px 0 0; padding: 18px 22px; border: none;">
                    <h5 class="modal-title" style="font-size: 16px; font-weight: 700; display: flex; align-items: center; gap: 10px;">
                        <i class="bi bi-pencil-square"></i> Edit Kontributor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
                </div>
                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body" style="padding: 24px 22px;">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama</label>
                            <input type="text" name="name" id="editName" class="form-input-custom" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-input-custom" required>
                        </div>
                        
                        {{-- Role Select - HANYA ADMIN --}}
                        @if($isAdmin)
                        <div class="mb-3">
                            <label class="form-label-custom">Role</label>
                            <select name="role" id="editRole" class="form-input-custom">
                                <option value="kontributor">Kontributor</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        @else
                        <input type="hidden" name="role" id="editRole" value="kontributor">
                        @endif
                        
                        <div class="mb-3">
                            <label class="form-label-custom">Password Baru (Opsional)</label>
                            <div class="password-wrapper">
                                <input type="password" name="password" id="editPassword" class="form-input-custom" placeholder="Kosongkan jika tidak ingin mengubah">
                                <button type="button" class="password-toggle" onclick="togglePassword('editPassword', this)">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 12px 12px;">
                        <button type="button" class="btn-secondary-custom" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg"></i> Batal
                        </button>
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-check-lg"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let modalEdit;
        document.addEventListener('DOMContentLoaded', function() {
            modalEdit = new bootstrap.Modal(document.getElementById('modalEdit'));
        });

        function openEditModal(id, name, email, role) {
            document.getElementById('formEdit').action = '/admin/kontributor/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
            document.getElementById('editPassword').value = '';
            modalEdit.show();
        }

        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }

        setTimeout(function() {
            document.querySelectorAll('.alert-banner').forEach(function(alert) {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.3s ease';
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 300);
            });
        }, 5000);
    </script>
</body>
</html>