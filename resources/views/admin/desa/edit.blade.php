<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Desa - {{ $desa->nama_desa }} - Portal Desa Digital</title>
    
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
        
        .date-display { font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px; }
        
        .main-content { padding: 30px; max-width: 900px; margin: 0 auto; }
        
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
            margin-bottom: 20px;
        }
        
        .form-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
            padding: 20px 30px;
            color: white;
        }
        
        .form-header h3 {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-header p { margin: 4px 0 0 0; font-size: 12px; opacity: 0.9; }
        .form-body { padding: 30px; }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }
        
        .form-group { margin-bottom: 0; }
        .form-group.full-width { grid-column: 1 / -1; }
        
        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .form-label .required { color: #dc2626; margin-left: 2px; }
        
        .form-input, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            transition: all 0.2s;
            background: #f8fafc;
        }
        
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #1e3a8a;
            background: white;
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }
        
        .form-input::placeholder { color: #94a3b8; font-weight: 400; }
        .form-input.is-invalid, .form-select.is-invalid { border-color: #dc2626; background: #fef2f2; }
        
        .error-message {
            color: #dc2626;
            font-size: 11px;
            margin-top: 4px;
            font-weight: 500;
        }
        
        .form-hint {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .form-hint i { font-size: 12px; color: #94a3b8; }
        
        /* Social Media Input */
        .social-input-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            margin-bottom: 12px;
            transition: all 0.2s;
        }
        
        .social-input-row:hover {
            background: #eff6ff;
            border-color: #bfdbfe;
        }
        
        .social-input-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }
        
        .social-input-icon.web { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .social-input-icon.yt { background: #dc2626; }
        .social-input-icon.ig { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-input-icon.fb { background: #1877f2; }
        .social-input-icon.tt { background: #000000; }
        .social-input-icon.wa { background: #25d366; }
        
        .social-input-info { flex: 1; min-width: 0; }
        
        .social-input-label {
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }
        
        .social-input-info input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 13px;
            background: white;
            transition: all 0.2s;
        }
        
        .social-input-info input:focus {
            outline: none;
            border-color: #1e3a8a;
            box-shadow: 0 0 0 2px rgba(30, 58, 138, 0.1);
        }
        
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
            .form-grid { grid-template-columns: 1fr; }
            .main-content { padding: 16px; }
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
                <li class="breadcrumb-item"><a href="{{ route('admin.desa.index') }}">Data Desa</a></li>
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
            Edit Desa/Kelurahan
        </h1>
        <p class="page-subtitle">Ubah data {{ $desa->nama_desa }}</p>

        <form action="{{ route('admin.desa.update', $desa->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- CARD: Informasi Dasar --}}
            <div class="form-card">
                <div class="form-header">
                    <h3><i class="bi bi-info-circle-fill"></i> Informasi Dasar</h3>
                    <p>Data umum desa/kelurahan</p>
                </div>
                <div class="form-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label" for="nama_desa">
                                Nama Desa/Kelurahan <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="nama_desa"
                                name="nama_desa" 
                                class="form-input @error('nama_desa') is-invalid @enderror" 
                                value="{{ old('nama_desa', $desa->nama_desa) }}" 
                                placeholder="Masukkan nama desa/kelurahan"
                                required
                                autofocus
                            >
                            @error('nama_desa')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="kode_desa">
                                Kode Desa <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="kode_desa"
                                name="kode_desa" 
                                class="form-input @error('kode_desa') is-invalid @enderror" 
                                value="{{ old('kode_desa', $desa->kode_desa) }}" 
                                placeholder="Contoh: 3523010001"
                                required
                            >
                            @error('kode_desa')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Kode unik desa (harus berbeda)
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="kecamatan_id">
                                Kecamatan <span class="required">*</span>
                            </label>
                            <select 
                                id="kecamatan_id"
                                name="kecamatan_id" 
                                class="form-select @error('kecamatan_id') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id', $desa->kecamatan_id) == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama_kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="jenis">
                                Jenis <span class="required">*</span>
                            </label>
                            <select 
                                id="jenis"
                                name="jenis" 
                                class="form-select @error('jenis') is-invalid @enderror"
                                required
                            >
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Desa" {{ old('jenis', $desa->jenis) == 'Desa' ? 'selected' : '' }}>Desa</option>
                                <option value="Kelurahan" {{ old('jenis', $desa->jenis) == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                            </select>
                            @error('jenis')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Pilih Desa atau Kelurahan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- CARD: Media Sosial & Kontak --}}
            <div class="form-card">
                <div class="form-header">
                    <h3><i class="bi bi-share-fill"></i> Media Sosial & Kontak</h3>
                    <p>Opsional - isi jika tersedia</p>
                </div>
                <div class="form-body">
                    {{-- Website --}}
                    <div class="social-input-row">
                        <div class="social-input-icon web">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div class="social-input-info">
                            <div class="social-input-label">Website</div>
                            <input 
                                type="url" 
                                name="website" 
                                value="{{ old('website', $desa->website) }}" 
                                placeholder="https://desa-example.go.id"
                            >
                            @error('website')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- YouTube --}}
                    <div class="social-input-row">
                        <div class="social-input-icon yt">
                            <i class="bi bi-youtube"></i>
                        </div>
                        <div class="social-input-info">
                            <div class="social-input-label">YouTube</div>
                            <input 
                                type="url" 
                                name="youtube" 
                                value="{{ old('youtube', $desa->youtube) }}" 
                                placeholder="https://youtube.com/@channel"
                            >
                            @error('youtube')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- Instagram --}}
                    <div class="social-input-row">
                        <div class="social-input-icon ig">
                            <i class="bi bi-instagram"></i>
                        </div>
                        <div class="social-input-info">
                            <div class="social-input-label">Instagram</div>
                            <input 
                                type="text" 
                                name="instagram" 
                                value="{{ old('instagram', $desa->instagram) }}" 
                                placeholder="https://instagram.com/username"
                            >
                            @error('instagram')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- Facebook --}}
                    <div class="social-input-row">
                        <div class="social-input-icon fb">
                            <i class="bi bi-facebook"></i>
                        </div>
                        <div class="social-input-info">
                            <div class="social-input-label">Facebook</div>
                            <input 
                                type="url" 
                                name="facebook" 
                                value="{{ old('facebook', $desa->facebook) }}" 
                                placeholder="https://facebook.com/pagename"
                            >
                            @error('facebook')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- TikTok --}}
                    <div class="social-input-row">
                        <div class="social-input-icon tt">
                            <i class="bi bi-tiktok"></i>
                        </div>
                        <div class="social-input-info">
                            <div class="social-input-label">TikTok</div>
                            <input 
                                type="text" 
                                name="tiktok" 
                                value="{{ old('tiktok', $desa->tiktok) }}" 
                                placeholder="https://tiktok.com/@username"
                            >
                            @error('tiktok')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- WhatsApp --}}
                    <div class="social-input-row">
                        <div class="social-input-icon wa">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="social-input-info">
                            <div class="social-input-label">WhatsApp</div>
                            <input 
                                type="text" 
                                name="whatsapp" 
                                value="{{ old('whatsapp', $desa->whatsapp) }}" 
                                placeholder="081234567890"
                            >
                            @error('whatsapp')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Format: 08xxxxxxxxxx
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- ACTION BUTTONS --}}
            <div class="form-card">
                <div class="form-body">
                    <div class="form-actions">
                        <a href="{{ route('admin.desa.index') }}" class="btn btn-cancel">
                            <i class="bi bi-x-lg"></i>
                            Batal
                        </a>
                        <button type="submit" class="btn btn-save">
                            <i class="bi bi-check-lg"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>