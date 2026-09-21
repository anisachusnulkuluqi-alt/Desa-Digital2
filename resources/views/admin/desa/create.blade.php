<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Desa/Kelurahan - Portal Desa Digital</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: #f8fafc;
            color: #0f172a;
        }

        /* ===== TOP NAVIGATION ===== */
        .top-nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #64748b;
        }

        .breadcrumb a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: #3b82f6;
        }

        .breadcrumb-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .breadcrumb-item.active {
            color: #3b82f6;
            font-weight: 600;
        }

        .date-display {
            font-size: 12px;
            color: #64748b;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            padding: 28px 28px;
            max-width: 900px;
            margin: 0 auto;
        }

        .page-header {
            margin-bottom: 28px;
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
        }

        /* ===== FORM CARD ===== */
        .form-section {
            background: white;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .section-header {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            padding: 18px 24px;
            color: white;
        }

        .section-title {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-subtitle {
            font-size: 12px;
            opacity: 0.85;
        }

        .section-body {
            padding: 28px 24px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .form-label .required {
            color: #ef4444;
            margin-left: 2px;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 500;
            color: #1e293b;
            background: #f8fafc;
            transition: all 0.25s;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.08);
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .form-hint {
            font-size: 11px;
            color: #64748b;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .form-hint i {
            font-size: 12px;
            color: #94a3b8;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
            margin-top: 24px;
        }

        .btn {
            padding: 11px 22px;
            border-radius: 10px;
            font-size: 13px;
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

        /* ===== SOCIAL MEDIA INPUT ===== */
        .social-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 18px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            margin-bottom: 14px;
            transition: all 0.25s;
        }

        .social-row:hover {
            background: white;
            border-color: #bfdbfe;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            flex-shrink: 0;
        }

        .social-icon.web { background: linear-gradient(135deg, #3b82f6, #1e40af); }
        .social-icon.yt { background: #dc2626; }
        .social-icon.ig { background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); }
        .social-icon.fb { background: #1877f2; }
        .social-icon.tt { background: #000000; }
        .social-icon.wa { background: #25d366; }

        .social-input {
            flex: 1;
        }

        .social-input label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .social-input input {
            width: 100%;
            padding: 9px 12px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 13px;
            background: white;
            transition: all 0.25s;
        }

        .social-input input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.08);
        }

        @media (max-width: 768px) {
            .form-grid { grid-template-columns: 1fr; }
            .main-content { padding: 20px; }
        }
    </style>
</head>
<body>
    <!-- Top Navigation -->
    <div class="top-nav">
        <div class="breadcrumb">
            <div class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-house"></i> Home
                </a>
            </div>
            <span>/</span>
            <div class="breadcrumb-item">
                <a href="{{ route('admin.desa.index') }}">Data Desa</a>
            </div>
            <span>/</span>
            <div class="breadcrumb-item active">Tambah Data</div>
        </div>

        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="page-header">
            <h1 class="page-title">
                Tambah Desa/Kelurahan
            </h1>
            <p class="page-subtitle">Tambahkan data desa atau kelurahan baru</p>
        </div>

        <form action="{{ route('admin.desa.store') }}" method="POST">
            @csrf

            <!-- Informasi Dasar -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-info-circle-fill"></i>
                        Informasi Dasar
                    </div>
                    <div class="section-subtitle">Data umum desa/kelurahan</div>
                </div>

                <div class="section-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">
                                NAMA DESA/KELURAHAN <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nama_desa" 
                                class="form-input" 
                                placeholder="Masukkan nama desa/kelurahan"
                                value="{{ old('nama_desa') }}"
                                required
                                autofocus
                            >
                            @error('nama_desa')
                                <div class="form-hint" style="color: #ef4444;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                KODE DESA <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="kode_desa" 
                                class="form-input" 
                                placeholder="Contoh: 3523010001"
                                value="{{ old('kode_desa') }}"
                                required
                            >
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Kode unik desa (harus berbeda)
                            </div>
                            @error('kode_desa')
                                <div class="form-hint" style="color: #ef4444;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                KECAMATAN <span class="required">*</span>
                            </label>
                            <select 
                                name="kecamatan_id" 
                                class="form-select"
                                required
                            >
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach($kecamatans as $kecamatan)
                                    <option value="{{ $kecamatan->id }}" {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                        {{ $kecamatan->nama_kecamatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kecamatan_id')
                                <div class="form-hint" style="color: #ef4444;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                JENIS <span class="required">*</span>
                            </label>
                            <select 
                                name="jenis" 
                                class="form-select"
                                required
                            >
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Desa" {{ old('jenis') == 'Desa' ? 'selected' : '' }}>Desa</option>
                                <option value="Kelurahan" {{ old('jenis') == 'Kelurahan' ? 'selected' : '' }}>Kelurahan</option>
                            </select>
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Pilih Desa atau Kelurahan
                            </div>
                            @error('jenis')
                                <div class="form-hint" style="color: #ef4444;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Sosial & Kontak -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="bi bi-share-fill"></i>
                        Media Sosial & Kontak
                    </div>
                    <div class="section-subtitle">Opsional - isi jika tersedia</div>
                </div>

                <div class="section-body">
                    {{-- Website --}}
                    <div class="social-row">
                        <div class="social-icon web">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div class="social-input">
                            <label>Website</label>
                            <input 
                                type="url" 
                                name="website" 
                                value="{{ old('website') }}" 
                                placeholder="https://desa-example.go.id"
                            >
                            @error('website')
                                <div class="form-hint" style="color: #ef4444; margin-top: 4px;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- YouTube --}}
                    <div class="social-row">
                        <div class="social-icon yt">
                            <i class="bi bi-youtube"></i>
                        </div>
                        <div class="social-input">
                            <label>YouTube</label>
                            <input 
                                type="url" 
                                name="youtube" 
                                value="{{ old('youtube') }}" 
                                placeholder="https://youtube.com/@channel"
                            >
                            @error('youtube')
                                <div class="form-hint" style="color: #ef4444; margin-top: 4px;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Instagram --}}
                    <div class="social-row">
                        <div class="social-icon ig">
                            <i class="bi bi-instagram"></i>
                        </div>
                        <div class="social-input">
                            <label>Instagram</label>
                            <input 
                                type="text" 
                                name="instagram" 
                                value="{{ old('instagram') }}" 
                                placeholder="https://instagram.com/username"
                            >
                            @error('instagram')
                                <div class="form-hint" style="color: #ef4444; margin-top: 4px;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Facebook --}}
                    <div class="social-row">
                        <div class="social-icon fb">
                            <i class="bi bi-facebook"></i>
                        </div>
                        <div class="social-input">
                            <label>Facebook</label>
                            <input 
                                type="url" 
                                name="facebook" 
                                value="{{ old('facebook') }}" 
                                placeholder="https://facebook.com/pagename"
                            >
                            @error('facebook')
                                <div class="form-hint" style="color: #ef4444; margin-top: 4px;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- TikTok --}}
                    <div class="social-row">
                        <div class="social-icon tt">
                            <i class="bi bi-tiktok"></i>
                        </div>
                        <div class="social-input">
                            <label>TikTok</label>
                            <input 
                                type="text" 
                                name="tiktok" 
                                value="{{ old('tiktok') }}" 
                                placeholder="https://tiktok.com/@username"
                            >
                            @error('tiktok')
                                <div class="form-hint" style="color: #ef4444; margin-top: 4px;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="social-row">
                        <div class="social-icon wa">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <div class="social-input">
                            <label>WhatsApp</label>
                            <input 
                                type="text" 
                                name="whatsapp" 
                                value="{{ old('whatsapp') }}" 
                                placeholder="081234567890"
                            >
                            <div class="form-hint">
                                <i class="bi bi-info-circle"></i>
                                Format: 08xxxxxxxxxx
                            </div>
                            @error('whatsapp')
                                <div class="form-hint" style="color: #ef4444; margin-top: 4px;">
                                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="form-actions">
                <a href="{{ route('admin.desa.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-lg"></i>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg"></i>
                    Simpan Desa
                </button>
            </div>
        </form>
    </div>
</body>
</html>