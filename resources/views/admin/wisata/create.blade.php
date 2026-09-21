<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wisata - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; }
        
        .top-nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #64748b;
        }
        
        .breadcrumb a { color: #64748b; text-decoration: none; }
        .breadcrumb a:hover { color: #1e3a8a; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        
        .date-display {
            font-size: 13px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        /* ===== LEBIHBAR MAIN CONTENT ===== */
        .main-content {
            padding: 24px 40px;
            max-width: 1200px;  /* Diperbesar dari 900px ke 1200px */
            margin: 0 auto;
        }
        
        .page-title {
            font-size: 24px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .page-subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
        }
        
        .form-section {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .section-header {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            padding: 16px 24px;
            color: white;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-subtitle { font-size: 12px; opacity: 0.85; }
        .section-body { padding: 28px 32px; }  /* Padding diperbesar */
        
        /* ===== GRID 3 KOLOM UNTUK LEBAR LEBIH BAIK ===== */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);  /* 3 kolom untuk layar lebar */
            gap: 20px;
        }
        
        .form-group { margin-bottom: 0; }
        .form-group.full-width { grid-column: 1 / -1; }
        .form-group.half-width { grid-column: span 2; }  /* Untuk field yang lebih lebar */
        
        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .form-label .required { color: #ef4444; margin-left: 2px; }
        
        .form-input, .form-select, .form-textarea {
            width: 100%;
            padding: 11px 16px;  /* Padding diperbesar */
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            background: #f8fafc;
            transition: all 0.25s;
        }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }
        
        .form-textarea {
            min-height: 140px;  /* TextArea lebih tinggi */
            resize: vertical;
        }
        
        .form-hint {
            font-size: 11px;
            color: #64748b;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .error-message {
            color: #ef4444;
            font-size: 11px;
            margin-top: 4px;
            font-weight: 500;
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
            padding: 11px 24px;  /* Tombol lebih besar */
            border-radius: 10px;
            font-size: 14px;  /* Font tombol lebih besar */
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            text-decoration: none;
        }
        
        .btn-secondary {
            background: white;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
        }
        
        .btn-secondary:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #1e293b;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(16, 185, 129, 0.35);
            color: white;
        }
        
        @media (max-width: 992px) {
            .form-grid { grid-template-columns: repeat(2, 1fr); }  /* 2 kolom di tablet */
        }
        
        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }  /* 1 kolom di mobile */
            .main-content { padding: 16px; }
        }
    </style>
</head>
<body>
    <div class="top-nav">
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}" class="breadcrumb-item">
                <i class="bi bi-house"></i> Home
            </a>
            <span>/</span>
            <a href="{{ route('admin.wisata.index') }}" class="breadcrumb-item">Wisata Desa</a>
            <span>/</span>
            <div class="breadcrumb-item active">Tambah Data</div>
        </div>

        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        <h1 class="page-title">
            <i class="bi bi-plus-circle"></i>
            Tambah Wisata
        </h1>
        <p class="page-subtitle">Tambahkan data wisata desa baru</p>

        <form action="{{ route('admin.wisata.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-info-circle-fill"></i>
                        Informasi Dasar
                    </div>
                    <div class="section-subtitle">Data umum wisata</div>
                </div>

                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group half-width">
                            <label class="form-label">
                                NAMA WISATA <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nama_wisata" 
                                class="form-input" 
                                placeholder="Masukkan nama wisata"
                                value="{{ old('nama_wisata') }}"
                                required
                                autofocus
                            >
                            @error('nama_wisata')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">DESA</label>
                            <input 
                                type="text" 
                                name="desa" 
                                class="form-input" 
                                placeholder="Nama desa lokasi wisata"
                                value="{{ old('desa') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">JAM OPERASIONAL</label>
                            <input 
                                type="text" 
                                name="jam_operasional" 
                                class="form-input" 
                                placeholder="Contoh: 09.00-17.00"
                                value="{{ old('jam_operasional') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">HTM (Rp)</label>
                            <input 
                                type="text" 
                                name="htm" 
                                class="form-input" 
                                placeholder="5000"
                                value="{{ old('htm') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">RESERVASI</label>
                            <input 
                                type="text" 
                                name="reservasi" 
                                class="form-input" 
                                placeholder="Kontak reservasi"
                                value="{{ old('reservasi') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">JENIS WISATA</label>
                            <input 
                                type="text" 
                                name="jenis_wisata" 
                                class="form-input" 
                                placeholder="Wisata Alam"
                                value="{{ old('jenis_wisata') }}"
                            >
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">DESKRIPSI</label>
                            <textarea 
                                name="deskripsi" 
                                class="form-textarea" 
                                placeholder="Deskripsi lengkap wisata..."
                            >{{ old('deskripsi') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-geo-alt-fill"></i>
                        Lokasi & Foto
                    </div>
                    <div class="section-subtitle">Koordinat dan foto wisata</div>
                </div>

                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">LATITUDE</label>
                            <input 
                                type="text" 
                                name="latitude" 
                                class="form-input" 
                                placeholder="-7.0073946"
                                value="{{ old('latitude') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label">LONGITUDE</label>
                            <input 
                                type="text" 
                                name="longitude" 
                                class="form-input" 
                                placeholder="111.8982897"
                                value="{{ old('longitude') }}"
                            >
                        </div>

                        <div class="form-group half-width">
                            <label class="form-label">FOTO WISATA</label>
                            <input 
                                type="file" 
                                name="foto" 
                                class="form-input" 
                                accept="image/*"
                            >
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Format: JPG, PNG, GIF (Maks. 2MB)
                            </div>
                            @error('foto')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">ALT TEXT (Deskripsi Foto)</label>
                            <input 
                                type="text" 
                                name="alt" 
                                class="form-input" 
                                placeholder="Deskripsi untuk foto wisata"
                                value="{{ old('alt') }}"
                            >
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.wisata.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Simpan Wisata
                </button>
            </div>
        </form>
    </div>
</body>
</html>