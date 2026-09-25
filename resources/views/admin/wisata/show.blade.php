<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Wisata - {{ $wisata->nama_wisata ?? 'Wisata' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; box-sizing: border-box; margin: 0; padding: 0; }
        body { background: #f8fafc; color: #1e293b; font-size: 13px; }
        
        .page-header { background: white; border-bottom: 1px solid #e2e8f0; padding: 14px 28px; display: flex; align-items: center; justify-content: space-between; }
        .breadcrumb { margin: 0; font-size: 13px; }
        .breadcrumb a { color: #64748b; text-decoration: none; }
        .breadcrumb-item.active { color: #1e3a8a; font-weight: 600; }
        .date-display { font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 6px; }
        .main-content { padding: 22px 28px; max-width: 1200px; margin: 0 auto; }
        .page-title { font-size: 20px; font-weight: 700; color: #1e293b; margin-bottom: 4px; display: flex; align-items: center; gap: 8px; }
        .page-title i { color: #1e3a8a; font-size: 22px; }
        .page-subtitle { color: #64748b; font-size: 12px; margin-bottom: 20px; }
        
        .wisata-header-card { background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); border-radius: 12px; padding: 20px 24px; color: white; margin-bottom: 18px; }
        .wisata-header-card h2 { font-size: 22px; font-weight: 700; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
        .wisata-meta { display: flex; align-items: center; gap: 12px; flex-wrap: wrap; font-size: 13px; }
        .badge-jenis { background: rgba(255,255,255,0.2); padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; }
        
        .foto-section { background: white; border-radius: 10px; padding: 18px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); margin-bottom: 18px; }
        .foto-section h4 { font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
        .foto-container { max-width: 450px; border-radius: 10px; overflow: hidden; background: #f1f5f9; }
        .foto-container img { width: 100%; height: auto; max-height: 280px; object-fit: cover; display: block; }
        
        .info-cards-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 18px; }
        .info-card-box { background: white; border-radius: 10px; padding: 16px 18px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border-left: 3px solid #1e3a8a; }
        .info-card-box .label { font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.4px; margin-bottom: 6px; }
        .info-card-box .value { font-size: 16px; font-weight: 700; color: #1e293b; }
        
        .section-title { font-size: 14px; font-weight: 700; color: #1e293b; margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }
        .section-title i { color: #1e3a8a; }
        .deskripsi-box { background: white; border-radius: 10px; padding: 18px 20px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); margin-bottom: 18px; border-left: 3px solid #1e3a8a; }
        .deskripsi-text { font-size: 13px; line-height: 1.6; color: #475569; }
        
        .koordinat-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 12px; }
        .koordinat-box { background: white; border-radius: 10px; padding: 16px 18px; box-shadow: 0 1px 4px rgba(0,0,0,0.05); border-left: 3px solid #1e3a8a; }
        .koordinat-box .label { font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 6px; }
        .koordinat-box .value { font-size: 16px; font-weight: 700; color: #1e293b; }
        
        .btn-maps { background: white; color: #1e3a8a; border: 1.5px solid #e2e8f0; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 12px; display: inline-flex; align-items: center; gap: 5px; text-decoration: none; margin-bottom: 18px; }
        .btn-maps:hover { background: #eff6ff; border-color: #1e3a8a; }
        
        .action-buttons { display: flex; gap: 10px; padding-top: 16px; border-top: 1px solid #e2e8f0; }
        .btn-action { padding: 9px 18px; border-radius: 8px; font-weight: 600; font-size: 13px; display: inline-flex; align-items: center; gap: 5px; cursor: pointer; transition: all 0.2s; text-decoration: none; border: none; }
        .btn-edit { background: linear-gradient(135deg, #14b8a6, #0f766e); color: white; }
        .btn-edit:hover { transform: translateY(-1px); box-shadow: 0 3px 10px rgba(20, 184, 166, 0.3); color: white; }
        .btn-delete { background: #fee2e2; color: #dc2626; }
        .btn-delete:hover { background: #fecaca; color: #dc2626; }
        
        /* MODAL STYLES */
        .modal-content { border-radius: 14px; border: none; box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .modal-header-form { background: linear-gradient(135deg, #14b8a6 0%, #0f766e 100%); color: white; border-radius: 14px 14px 0 0; padding: 18px 22px; border: none; }
        .modal-header-form .modal-title { font-size: 17px; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .modal-header-form .btn-close { filter: brightness(0) invert(1); opacity: 0.8; }
        .modal-body-form { padding: 20px 22px; }
        .modal-footer-form { border-top: 1px solid #e2e8f0; padding: 14px 22px; background: #f8fafc; border-radius: 0 0 14px 14px; }
        .form-label-custom { font-size: 11px; font-weight: 600; color: #1e293b; margin-bottom: 4px; }
        .form-input-custom { padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 13px; width: 100%; }
        .form-input-custom:focus { outline: none; border-color: #1e3a8a; box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.08); }
        .btn-modal-cancel { background: white; color: #64748b; border: 1.5px solid #e2e8f0; padding: 8px 18px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; }
        .btn-modal-save { background: linear-gradient(135deg, #14b8a6, #0f766e); color: white; border: none; padding: 8px 20px; border-radius: 8px; font-size: 12px; font-weight: 600; cursor: pointer; }
        
        @media (max-width: 768px) {
            .info-cards-grid, .koordinat-grid { grid-template-columns: 1fr; }
            .main-content { padding: 14px; }
        }
    </style>
</head>
<body>
    <div class="page-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bi bi-house"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.wisata.index') }}">Wisata Desa</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        <div class="date-display">
            <i class="bi bi-calendar"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </div>
    </div>

    <div class="main-content">
        <h1 class="page-title"><i class="bi bi-image-fill"></i> Detail Wisata</h1>
        <p class="page-subtitle">Informasi lengkap {{ $wisata->nama_wisata }}</p>

        <div class="wisata-header-card">
            <h2><i class="bi bi-image-fill"></i> {{ $wisata->nama_wisata }}</h2>
            <div class="wisata-meta">
                <span><i class="bi bi-geo-alt-fill"></i> {{ $wisata->desa ? 'Desa ' . $wisata->desa : '-' }}</span>
                @if($wisata->jenis_wisata)
                <span class="badge-jenis">{{ $wisata->jenis_wisata }}</span>
                @endif
            </div>
        </div>

        @if($wisata->foto)
        <div class="foto-section">
            <h4><i class="bi bi-camera-fill"></i> Foto Wisata</h4>
            <div class="foto-container">
                <img src="{{ asset('storage/' . $wisata->foto) }}" alt="{{ $wisata->nama_wisata }}">
            </div>
        </div>
        @endif

        <div class="info-cards-grid">
            <div class="info-card-box">
                <div class="label">JAM OPERASIONAL</div>
                <div class="value">{{ $wisata->jam_operasional ?? '-' }}</div>
            </div>
            <div class="info-card-box">
                <div class="label">HARGA TIKET MASUK</div>
                <div class="value">{{ $wisata->htm ? 'Rp ' . number_format($wisata->htm, 0, ',', '.') : '-' }}</div>
            </div>
            <div class="info-card-box">
                <div class="label">RESERVASI</div>
                <div class="value" style="font-size: 14px;">{{ $wisata->reservasi ?? '-' }}</div>
            </div>
        </div>

        <h4 class="section-title"><i class="bi bi-file-text-fill"></i> Deskripsi</h4>
        <div class="deskripsi-box">
            <div class="deskripsi-text">{{ $wisata->deskripsi ?? 'Belum ada deskripsi.' }}</div>
        </div>

        @if($wisata->latitude || $wisata->longitude)
        <h4 class="section-title"><i class="bi bi-geo-alt-fill"></i> Koordinat Lokasi</h4>
        <div class="koordinat-grid">
            <div class="koordinat-box">
                <div class="label">LATITUDE</div>
                <div class="value">{{ $wisata->latitude ?? '-' }}</div>
            </div>
            <div class="koordinat-box">
                <div class="label">LONGITUDE</div>
                <div class="value">{{ $wisata->longitude ?? '-' }}</div>
            </div>
        </div>
        @if($wisata->latitude && $wisata->longitude)
        <a href="https://www.google.com/maps?q={{ $wisata->latitude }},{{ $wisata->longitude }}" target="_blank" class="btn-maps">
            <i class="bi bi-map-fill"></i> Buka di Google Maps
        </a>
        @endif
        @endif

        <div class="action-buttons">
            {{-- TOMBOL EDIT MEMBUKA MODAL --}}
            <button type="button" class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#modalEditWisata">
                <i class="bi bi-pencil-fill"></i> Edit Data
            </button>
            
            <form action="{{ route('admin.wisata.destroy', $wisata->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    <i class="bi bi-trash-fill"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT WISATA -->
    <div class="modal fade" id="modalEditWisata" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-form">
                    <div>
                        <h5 class="modal-title"><i class="bi bi-pencil-square"></i> Edit Data Wisata</h5>
                        <p style="font-size: 11px; margin: 2px 0 0 0; opacity: 0.9;">Ubah data {{ $wisata->nama_wisata }}</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <form action="{{ route('admin.wisata.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body modal-body-form">
                        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); color: white; border-radius: 10px; padding: 12px 16px; margin-bottom: 16px;">
                            <div style="font-size: 13px; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                                <i class="bi bi-info-circle-fill"></i> Informasi Dasar
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label class="form-label-custom">NAMA WISATA *</label>
                                <input type="text" name="nama_wisata" class="form-control form-input-custom" value="{{ $wisata->nama_wisata }}" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">DESA</label>
                                <input type="text" name="desa" class="form-control form-input-custom" value="{{ $wisata->desa }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">JAM OPERASIONAL</label>
                                <input type="text" name="jam_operasional" class="form-control form-input-custom" value="{{ $wisata->jam_operasional }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">HTM (RP)</label>
                                <input type="number" name="htm" class="form-control form-input-custom" value="{{ $wisata->htm }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label-custom">RESERVASI</label>
                                <input type="text" name="reservasi" class="form-control form-input-custom" value="{{ $wisata->reservasi }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">JENIS WISATA</label>
                            <select name="jenis_wisata" class="form-select form-input-custom">
                                <option value="">Pilih jenis</option>
                                <option value="Wisata Alam" {{ $wisata->jenis_wisata == 'Wisata Alam' ? 'selected' : '' }}>Wisata Alam</option>
                                <option value="Wisata Budaya" {{ $wisata->jenis_wisata == 'Wisata Budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                                <option value="Wisata Edukasi" {{ $wisata->jenis_wisata == 'Wisata Edukasi' ? 'selected' : '' }}>Wisata Edukasi</option>
                                <option value="Wisata Kuliner" {{ $wisata->jenis_wisata == 'Wisata Kuliner' ? 'selected' : '' }}>Wisata Kuliner</option>
                                <option value="Wisata Sejarah" {{ $wisata->jenis_wisata == 'Wisata Sejarah' ? 'selected' : '' }}>Wisata Sejarah</option>
                                <option value="Wisata Buatan" {{ $wisata->jenis_wisata == 'Wisata Buatan' ? 'selected' : '' }}>Wisata Buatan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">DESKRIPSI</label>
                            <textarea name="deskripsi" class="form-control form-input-custom" rows="3">{{ $wisata->deskripsi }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">KOORDINAT (Lat, Long)</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="latitude" class="form-control form-input-custom" value="{{ $wisata->latitude }}" placeholder="Latitude">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="longitude" class="form-control form-input-custom" value="{{ $wisata->longitude }}" placeholder="Longitude">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label-custom">FOTO UTAMA</label>
                                <input type="file" name="foto" class="form-control form-input-custom" accept="image/*">
                                @if($wisata->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $wisata->foto) }}" style="max-width: 120px; border-radius: 6px;">
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">GALERI (Opsional)</label>
                            <input type="file" name="galeri[]" class="form-control form-input-custom" accept="image/*" multiple>
                        </div>
                    </div>

                    <div class="modal-footer modal-footer-form">
                        <button type="button" class="btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal-save">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>