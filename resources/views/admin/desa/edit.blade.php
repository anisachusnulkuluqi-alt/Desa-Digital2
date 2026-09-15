<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Desa - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        .header {
            background: linear-gradient(135deg, #1e88e5 0%, #00897b 100%);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header-logo { display: flex; align-items: center; gap: 12px; }
        .header-logo-icon {
            width: 45px; height: 45px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-size: 24px;
        }
        .header-logo-text h5 { margin: 0; font-weight: 800; font-size: 18px; color: white; }
        .header-logo-text small { color: rgba(255,255,255,0.9); font-size: 11px; }
        
        .header-user { display: flex; align-items: center; gap: 12px; color: white; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        
        .breadcrumb-bar {
            background: white;
            padding: 12px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }
        .breadcrumb-bar a { color: #64748b; text-decoration: none; font-weight: 500; }
        .breadcrumb-bar a:hover { color: #1e88e5; }
        .breadcrumb-bar .active { color: #1e88e5; font-weight: 600; }
        .breadcrumb-bar .separator { color: #cbd5e1; margin: 0 8px; }
        .breadcrumb-date { color: #64748b; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 6px; }
        .breadcrumb-date i { color: #94a3b8; }
        
        .main-content { padding: 30px; max-width: 1000px; margin: 0 auto; }
        
        .form-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .card-header-modern {
            background: linear-gradient(135deg, #1e3a8a, #00897b);
            color: white;
            padding: 20px 24px;
        }
        
        .card-header-modern h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-header-modern p {
            margin: 4px 0 0 0;
            font-size: 13px;
            opacity: 0.9;
        }
        
        .card-body-modern { padding: 30px 24px; }
        
        .form-group { margin-bottom: 24px; }
        
        .form-label {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-label .required {
            color: #ef4444;
            margin-left: 2px;
        }
        
        .form-control, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
        }
        
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            font-family: 'Inter', sans-serif;
        }
        
        .form-hint {
            font-size: 12px;
            color: #6b7280;
            margin-top: 6px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 14px 18px;
            margin-bottom: 24px;
        }
        
        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
        }
        
        .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-secondary {
            background: white;
            color: #475569;
            border: 1px solid #d1d5db;
        }
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #94a3b8;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1e88e5, #00897b);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30,136,229,0.3);
        }
        
        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .main-content { padding: 20px; }
            .action-buttons { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-logo">
            <div class="header-logo-icon"><i class="bi bi-grid-3x3-gap-fill"></i></div>
            <div class="header-logo-text">
                <h5>PORTAL DESA DIGITAL</h5>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        <div class="header-user">
            <div class="header-user-info">
                <strong>{{ auth()->user()->name ?? 'Admin Desa' }}</strong>
                <small>Operator Kabupaten</small>
            </div>
            <div class="header-user-avatar">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
            </div>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <div>
            <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Home</a>
            <span class="separator">/</span>
            <a href="{{ route('admin.desa.index') }}">Data Desa</a>
            <span class="separator">/</span>
            <span class="active">Edit</span>
        </div>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i>
            {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        @if ($errors->any())
        <div class="alert alert-danger alert-custom">
            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Ada kesalahan:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <!-- Form Card -->
        <div class="form-card">
            <div class="card-header-modern">
                <h3><i class="bi bi-building"></i> Data Desa</h3>
                <p>Formulir edit data desa</p>
            </div>
            <div class="card-body-modern">
                <form method="POST" action="{{ route('admin.desa.update', $desa->id) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Nama Desa
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_desa" 
                                   class="form-control" 
                                   value="{{ old('nama_desa', $desa->nama_desa) }}" 
                                   required>
                            <div class="form-hint">Nama desa yang akan ditampilkan</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                Kode Desa
                            </label>
                            <input type="text" 
                                   name="kode_desa" 
                                   class="form-control" 
                                   value="{{ old('kode_desa', $desa->kode_desa) }}"
                                   placeholder="Contoh: 3523010001">
                            <div class="form-hint">Kode desa administratif BPS</div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Kecamatan
                                <span class="required">*</span>
                            </label>
                            <select name="kecamatan_id" class="form-select" required>
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatans as $kec)
                                    <option value="{{ $kec->id }}" 
                                            {{ old('kecamatan_id', $desa->kecamatan_id) == $kec->id ? 'selected' : '' }}>
                                        {{ $kec->nama_kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="form-hint">Kecamatan tempat desa berada</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                Kepala Desa
                            </label>
                            <input type="text" 
                                   name="kepala_desa" 
                                   class="form-control" 
                                   value="{{ old('kepala_desa', $desa->kepala_desa) }}"
                                   placeholder="Nama kepala desa">
                            <div class="form-hint">Nama lengkap kepala desa</div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Jumlah Penduduk
                            </label>
                            <input type="number" 
                                   name="jumlah_penduduk" 
                                   class="form-control" 
                                   value="{{ old('jumlah_penduduk', $desa->jumlah_penduduk) }}" 
                                   min="0"
                                   placeholder="0">
                            <div class="form-hint">Total jumlah penduduk desa</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                Jumlah KK
                            </label>
                            <input type="number" 
                                   name="jumlah_kk" 
                                   class="form-control" 
                                   value="{{ old('jumlah_kk', $desa->jumlah_kk) }}" 
                                   min="0"
                                   placeholder="0">
                            <div class="form-hint">Total jumlah kepala keluarga</div>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                Telepon
                            </label>
                            <input type="text" 
                                   name="telepon" 
                                   class="form-control" 
                                   value="{{ old('telepon', $desa->telepon) }}"
                                   placeholder="Nomor telepon kantor desa">
                            <div class="form-hint">Nomor telepon kantor desa</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                Email
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control" 
                                   value="{{ old('email', $desa->email) }}"
                                   placeholder="email@desa.go.id">
                            <div class="form-hint">Alamat email resmi desa</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            Alamat
                        </label>
                        <textarea name="alamat" 
                                  class="form-control" 
                                  rows="4"
                                  placeholder="Alamat lengkap kantor desa">{{ old('alamat', $desa->alamat) }}</textarea>
                        <div class="form-hint">Alamat lengkap kantor desa</div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="{{ route('admin.desa.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>