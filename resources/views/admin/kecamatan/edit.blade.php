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
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; }
        body { background: #f8f9fa; margin: 0; }
        
        /* Header */
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
        
        .header-search { flex: 1; max-width: 500px; margin: 0 30px; }
        .header-search input {
            width: 100%; padding: 12px 20px 12px 45px;
            border: none; border-radius: 25px;
            font-size: 14px; background: white;
        }
        .header-search-wrapper { position: relative; }
        .header-search-wrapper i {
            position: absolute; left: 18px; top: 50%;
            transform: translateY(-50%); color: #9ca3af;
        }
        
        .header-user { display: flex; align-items: center; gap: 12px; color: white; cursor: pointer; }
        .header-user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            background: rgba(255,255,255,0.3);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700;
        }
        .header-user-info strong { display: block; font-size: 14px; }
        .header-user-info small { font-size: 11px; opacity: 0.9; }
        
        /* Breadcrumb */
        .breadcrumb-bar {
            background: white; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center;
            border-bottom: 1px solid #e5e7eb;
        }
        .breadcrumb { margin: 0; background: none; padding: 0; }
        .breadcrumb-item a { color: #6b7280; text-decoration: none; }
        .breadcrumb-item.active { color: #1e88e5; font-weight: 600; }
        .breadcrumb-date { color: #6b7280; font-size: 14px; }
        .breadcrumb-date i { margin-right: 5px; }
        
        /* Main */
        .main-content { padding: 30px; max-width: 1200px; margin: 0 auto; }
        
        /* Page Header */
        .page-header { margin-bottom: 25px; }
        .page-header h2 { 
            font-size: 24px; font-weight: 700; color: #1e3a8a; 
            margin-bottom: 8px;
            display: flex; align-items: center; gap: 10px;
        }
        .page-header p { color: #6b7280; font-size: 14px; margin-bottom: 0; }
        
        /* Info Card */
        .info-card {
            background: #e0f2fe;
            border-left: 4px solid #1e88e5;
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        .info-card-title {
            font-size: 14px;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-card-text {
            font-size: 13px;
            color: #374151;
            margin: 0;
        }
        
        /* Form Card */
        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .form-card-header {
            background: linear-gradient(135deg, #1e3a8a, #00897b);
            color: white;
            padding: 20px 25px;
        }
        
        .form-card-header h5 {
            margin: 0;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-card-header small {
            display: block;
            margin-top: 5px;
            opacity: 0.9;
            font-size: 13px;
        }
        
        .form-card-body { padding: 30px; }
        
        /* Form Group */
        .form-group { margin-bottom: 20px; }
        
        .form-label-custom {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }
        
        .form-label-custom .required {
            color: #ef4444;
            margin-left: 3px;
        }
        
        .form-control-custom {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            font-family: 'Inter', sans-serif;
            background: white;
            color: #1f2937;
        }
        
        .form-control-custom:focus {
            outline: none;
            border-color: #1e88e5;
            box-shadow: 0 0 0 3px rgba(30,136,229,0.1);
        }
        
        textarea.form-control-custom {
            min-height: 100px;
            resize: vertical;
        }
        
        .form-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 5px;
        }
        
        /* Form Row */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        /* Action Buttons - TERPISAH */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 20px 25px;
            background: #f9fafb;
            border-top: 1px solid #e5e7eb;
        }
        
        .btn-cancel {
            background: white;
            color: #6b7280;
            border: 1px solid #d1d5db;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-cancel:hover {
            background: #f3f4f6;
            color: #374151;
        }
        
        .btn-submit {
            background: linear-gradient(135deg, #1e88e5, #00897b);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(30,136,229,0.3);
            color: white;
        }
        
        /* Alert */
        .alert-custom {
            border-radius: 8px;
            border: none;
            padding: 12px 20px;
            margin-bottom: 20px;
        }
        
        /* Footer */
        .footer {
            background: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e5e7eb;
            margin-top: 50px;
        }
        .footer small { color: #6b7280; }
        .footer a { color: #00897b; text-decoration: none; margin-left: 20px; font-size: 14px; }
        
        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .form-actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-logo">
            <div class="header-logo-icon">
                <i class="bi bi-grid-3x3-gap-fill"></i>
            </div>
            <div class="header-logo-text">
                <h5>PORTAL DESA DIGITAL</h5>
                <small>KABUPATEN TUBAN</small>
            </div>
        </div>
        
        <div class="header-search">
            <div class="header-search-wrapper">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Cari data cepat...">
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
            <i class="bi bi-chevron-down"></i>
        </div>
    </header>
    
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.kecamatan.index') }}">Kecamatan</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
        <div class="breadcrumb-date">
            <i class="bi bi-calendar"></i> {{ now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="page-header">
            <h2><i class="bi bi-pencil-square"></i> Edit Kecamatan</h2>
            <p>Perbarui informasi kecamatan di Kabupaten Tuban</p>
        </div>
        
        <!-- Alert Success -->
        @if(session('success'))
        <div class="alert alert-success alert-custom alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <!-- Alert Error -->
        @if($errors->any())
        <div class="alert alert-danger alert-custom alert-dismissible fade show">
            <h6 class="fw-bold mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Ada kesalahan:</h6>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <!-- Info Card -->
        <div class="info-card">
            <div class="info-card-title">
                <i class="bi bi-info-circle"></i> Informasi Kecamatan
            </div>
            <p class="info-card-text mb-0">
                Anda sedang mengedit data kecamatan <strong>{{ $kecamatan->nama_kecamatan }}</strong>. 
                Pastikan semua informasi yang diisi sudah benar sebelum menyimpan perubahan.
            </p>
        </div>
        
        <!-- Form Card -->
        <div class="form-card">
            <div class="form-card-header">
                <h5>
                    <i class="bi bi-building"></i> Data Kecamatan
                </h5>
                <small>Formulir edit data kecamatan</small>
            </div>
            
            <!-- FORM EDIT - HANYA UNTUK UPDATE -->
            <form action="{{ route('admin.kecamatan.update', $kecamatan->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-card-body">
                    <!-- Row 1: Nama & Kode Wilayah -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label-custom">
                                Nama Kecamatan <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_kecamatan" 
                                   class="form-control-custom" 
                                   value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" 
                                   placeholder="Masukkan nama kecamatan"
                                   required>
                            <div class="form-text">Nama kecamatan yang akan ditampilkan</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-custom">
                                Kode Wilayah <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   name="kode_wilayah" 
                                   class="form-control-custom" 
                                   value="{{ old('kode_wilayah', $kecamatan->kode_wilayah) }}" 
                                   placeholder="Contoh: 352301"
                                   required>
                            <div class="form-text">Kode wilayah administratif BPS</div>
                        </div>
                    </div>
                    
                    <!-- Row 2: Kabupaten & Jumlah Desa -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label-custom">Kabupaten</label>
                            <input type="text" 
                                   name="kabupaten" 
                                   class="form-control-custom" 
                                   value="{{ old('kabupaten', $kecamatan->kabupaten ?? 'Tuban') }}" 
                                   placeholder="Nama kabupaten">
                            <div class="form-text">Nama kabupaten tempat kecamatan berada</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-custom">Jumlah Desa</label>
                            <input type="number" 
                                   name="jumlah_desa" 
                                   class="form-control-custom" 
                                   value="{{ old('jumlah_desa', $kecamatan->jumlah_desa ?? 0) }}" 
                                   placeholder="0"
                                   min="0">
                            <div class="form-text">Total desa dalam kecamatan ini</div>
                        </div>
                    </div>
                    
                    <!-- Row 3: Telepon & Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label-custom">Telepon</label>
                            <input type="text" 
                                   name="telepon" 
                                   class="form-control-custom" 
                                   value="{{ old('telepon', $kecamatan->telepon) }}" 
                                   placeholder="0356-xxxxxx">
                            <div class="form-text">Nomor telepon kecamatan</div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label-custom">Email</label>
                            <input type="email" 
                                   name="email" 
                                   class="form-control-custom" 
                                   value="{{ old('email', $kecamatan->email) }}" 
                                   placeholder="kecamatan@tuban.go.id">
                            <div class="form-text">Alamat email resmi</div>
                        </div>
                    </div>
                    
                    <!-- Alamat -->
                    <div class="form-group">
                        <label class="form-label-custom">Alamat Kantor</label>
                        <textarea name="alamat" 
                                  class="form-control-custom" 
                                  placeholder="Masukkan alamat lengkap kantor kecamatan">{{ old('alamat', $kecamatan->alamat) }}</textarea>
                        <div class="form-text">Alamat lengkap kantor kecamatan</div>
                    </div>
                    
                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label class="form-label-custom">Deskripsi</label>
                        <textarea name="deskripsi" 
                                  class="form-control-custom" 
                                  rows="4"
                                  placeholder="Tuliskan deskripsi singkat tentang kecamatan ini">{{ old('deskripsi', $kecamatan->deskripsi) }}</textarea>
                        <div class="form-text">Deskripsi umum kecamatan (opsional)</div>
                    </div>
                </div>
                
                <!-- Action Buttons - HANYA Batal & Simpan -->
                <div class="form-actions">
                    <a href="{{ route('admin.kecamatan.index') }}" class="btn-cancel">
                        <i class="bi bi-x"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Tombol Hapus TERPISAH di luar form -->
        <div class="form-card">
            <div class="form-card-header" style="background: linear-gradient(135deg, #dc2626, #991b1b);">
                <h5>
                    <i class="bi bi-exclamation-triangle"></i> Zona Berbahaya
                </h5>
                <small>Hapus data kecamatan secara permanen</small>
            </div>
            
            <div class="form-card-body">
                <p class="text-muted mb-3">
                    <i class="bi bi-info-circle text-danger"></i>
                    Setelah dihapus, data kecamatan <strong>{{ $kecamatan->nama_kecamatan }}</strong> tidak dapat dikembalikan.
                </p>
                
                <form action="{{ route('admin.kecamatan.destroy', $kecamatan->id) }}" method="POST" onsubmit="return confirm('⚠️ PERINGATAN!\n\nYakin ingin menghapus kecamatan {{ $kecamatan->nama_kecamatan }}?\n\nData yang sudah dihapus TIDAK BISA dikembalikan!')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Hapus Kecamatan Ini
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <small>© 2026 Pemerintah Kabupaten Tuban. Hak Cipta Dilindungi.</small>
        <div>
            <a href="#">Syarat & Ketentuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>