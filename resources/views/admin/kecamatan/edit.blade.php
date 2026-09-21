<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kecamatan - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        .page-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .breadcrumb { margin: 0; font-size: 13px; }
        .breadcrumb a { color: #64748b; text-decoration: none; }
        .breadcrumb a:hover { color: #1e3a8a; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        
        .date-display {
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .main-content { padding: 30px; max-width: 800px; margin: 0 auto; }
        
        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-title i { color: #1e3a8a; }
        .page-subtitle { color: #64748b; font-size: 13px; margin-bottom: 24px; }
        
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .form-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 20px 24px;
            color: white;
        }
        
        .form-header h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0 0 4px 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-header p { font-size: 12px; margin: 0; opacity: 0.9; }
        .form-body { padding: 30px; }
        .form-group { margin-bottom: 24px; }
        
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        
        .form-label .required { color: #dc2626; margin-left: 2px; }
        
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            transition: all 0.2s;
            background: #f8fafc;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #1e3a8a;
            background: white;
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
        }
        
        .form-input::placeholder { color: #94a3b8; font-weight: 500; }
        .form-input.is-invalid { border-color: #dc2626; background: #fef2f2; }
        
        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 500;
        }
        
        .form-hint {
            font-size: 12px;
            color: #64748b;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .form-hint i { font-size: 14px; color: #94a3b8; }
        
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            margin-top: 24px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            text-decoration: none;
        }
        
        .btn-cancel {
            background: white;
            color: #64748b;
            border: 1px solid #e2e8f0;
        }
        
        .btn-cancel:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #1e293b;
        }
        
        .btn-save {
            background: linear-gradient(135deg, #14b8a6, #0f766e);
            color: white;
            box-shadow: 0 2px 8px rgba(20, 184, 166, 0.2);
        }
        
        .btn-save:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(20, 184, 166, 0.3);
            color: white;
        }
        
        @media (max-width: 768px) {
            .main-content { padding: 16px; }
            .form-body { padding: 20px; }
            .form-actions { flex-direction: column; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.kecamatan.index') }}">Data Kecamatan</a></li>
                <li class="breadcrumb-item active">Edit Data</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        <h1 class="page-title">
            <i class="bi bi-pencil-square"></i>
            Edit Kecamatan
        </h1>
        <p class="page-subtitle">Ubah nama kecamatan {{ $kecamatan->nama_kecamatan }}</p>

        <div class="form-card">
            <div class="form-header">
                <h3>
                    <i class="bi bi-building"></i>
                    Data Kecamatan
                </h3>
                <p>Edit nama kecamatan</p>
            </div>
            
            <div class="form-body">
                <form action="{{ route('admin.kecamatan.update', $kecamatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label" for="nama_kecamatan">
                            Nama Kecamatan <span class="required">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="nama_kecamatan"
                            name="nama_kecamatan" 
                            class="form-input @error('nama_kecamatan') is-invalid @enderror" 
                            value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" 
                            placeholder="Masukkan nama kecamatan"
                            required
                            autofocus
                        >
                        @error('nama_kecamatan')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <div class="form-hint">
                            <i class="bi bi-info-circle"></i>
                            Nama kecamatan yang akan ditampilkan di sistem
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-cancel">
                            <i class="bi bi-x-lg"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check-lg"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>