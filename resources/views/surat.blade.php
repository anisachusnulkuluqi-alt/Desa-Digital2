<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Layanan Surat Mandiri - Desa Digital Kabupaten Tuban</title>

    <!-- Google Fonts & Font Awesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --primary-light: #e0f2fe;
            --amber: #f59e0b;
            --amber-dark: #d97706;
            --emerald: #10b981;
            --rose: #e11d48;
            --bg-body: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }

        /* Header Navbar */
        .site-header {
            background: #475569;
            padding: 14px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .brand-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .brand-logo-img {
            height: 38px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
        }
        .nav-menu {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }
        .nav-menu a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: opacity 0.2s;
        }
        .nav-menu a:hover { opacity: 0.8; }

        /* Hero Banner */
        .surat-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0369a1 100%);
            color: #ffffff;
            padding: 60px 7% 75px 7%;
            text-align: center;
            position: relative;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(245, 158, 11, 0.2);
            border: 1px solid rgba(245, 158, 11, 0.4);
            color: #fbbf24;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }
        .surat-hero h1 {
            font-size: 2.6rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            margin-bottom: 12px;
        }
        .surat-hero p {
            font-size: 1.05rem;
            color: #cbd5e1;
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Flash Message Alert */
        .alert-banner {
            max-width: 1240px;
            margin: 20px auto 0 auto;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
        .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }

        /* Container & Cards Grid */
        .content-wrap {
            max-width: 1240px;
            margin: -35px auto 60px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        /* Tracking Bar */
        .tracking-bar {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 22px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
            border: 1px solid var(--border-soft);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 40px;
            flex-wrap: wrap;
        }
        .tracking-title {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .tracking-title i {
            font-size: 1.4rem;
            color: var(--amber-dark);
        }
        .tracking-title div h4 {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .tracking-title div p {
            font-size: 0.78rem;
            color: var(--text-muted);
        }
        .tracking-input-group {
            display: flex;
            gap: 8px;
            flex: 1;
            max-width: 440px;
        }
        .tracking-input-group input {
            flex: 1;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.84rem;
            font-weight: 600;
            outline: none;
        }
        .tracking-input-group input:focus { border-color: var(--primary); }
        .btn-track {
            background: var(--text-dark);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-track:hover { background: var(--primary); }

        /* Grid Katalog Surat */
        .section-title {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .surat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
            margin-bottom: 50px;
        }

        .surat-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1.5px solid var(--border-soft);
            padding: 26px 22px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .surat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: var(--card-accent, #0284c7);
        }
        .surat-card:hover {
            transform: translateY(-5px);
            border-color: var(--card-accent, #0284c7);
            box-shadow: 0 16px 30px rgba(0,0,0,0.08);
        }

        .card-top {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }
        .card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: var(--icon-bg, #e0f2fe);
            color: var(--card-accent, #0284c7);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            flex-shrink: 0;
        }
        .card-top h3 {
            font-size: 1.08rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .surat-card p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 22px;
        }
        .btn-apply {
            width: 100%;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            color: var(--text-dark);
            padding: 11px;
            border-radius: 10px;
            font-size: 0.84rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .surat-card:hover .btn-apply {
            background: var(--card-accent, #0284c7);
            color: #ffffff;
            border-color: transparent;
        }

        /* Modal Overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(5px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-content {
            background: #ffffff;
            border-radius: 20px;
            width: 100%;
            max-width: 620px;
            overflow: hidden;
            box-shadow: 0 24px 50px rgba(0,0,0,0.25);
            animation: zoomIn 0.2s ease-out;
        }
        @keyframes zoomIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .modal-header {
            background: #f8fafc;
            padding: 18px 24px;
            border-bottom: 1px solid var(--border-soft);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h3 { font-size: 1.15rem; font-weight: 800; color: var(--text-dark); }
        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.3rem;
            color: #94a3b8;
            cursor: pointer;
        }
        .modal-body {
            padding: 24px;
            max-height: 75vh;
            overflow-y: auto;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }
        .form-group label {
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        .form-group input, .form-group select, .form-group textarea {
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.85rem;
            outline: none;
            transition: border-color 0.2s;
        }
        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: var(--primary);
        }
        .btn-submit {
            width: 100%;
            background: var(--primary);
            color: #ffffff;
            border: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 0.88rem;
            font-weight: 800;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-submit:hover { background: var(--primary-dark); }

        /* Modal Tracking Box */
        .tracking-result-box {
            display: none;
            margin-top: 16px;
            padding: 16px;
            border-radius: 12px;
            background: #f8fafc;
            border: 1px solid var(--border-soft);
        }

        /* Responsive */
        @media (max-width: 960px) { .surat-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .surat-grid { grid-template-columns: 1fr; }
            .tracking-bar { flex-direction: column; align-items: stretch; }
            .tracking-input-group { max-width: 100%; }
            .nav-menu { display: none; }
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="site-header">
        <a href="<?= url('/'); ?>" class="brand-link">
            <img src="<?= asset('images/desa-digital.png'); ?>" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-img"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png'">
            <span style="font-size: 1.25rem; font-weight: 800; color: #ffffff;">Desa<span style="color: #38bdf8;">Digital</span></span>
        </a>

        <ul class="nav-menu">
            <li><a href="<?= url('/'); ?>">Beranda</a></li>
            <li><a href="<?= url('/website'); ?>">Website Desa</a></li>
            <li><a href="<?= url('/data-spasial'); ?>">Peta Spasial</a></li>
            <li><a href="<?= url('/cctv'); ?>">CCTV Tuban</a></li>
            <li><a href="<?= url('/epbb'); ?>">e-PBB</a></li>
        </ul>
    </header>

    <!-- Flash Message Notification -->
    <?php if (session('success')): ?>
        <div class="alert-banner alert-success">
            <i class="fa-solid fa-circle-check" style="font-size: 1.3rem;"></i>
            <div><?= session('success'); ?></div>
        </div>
    <?php endif; ?>

    <?php if ($errors->any()): ?>
        <div class="alert-banner alert-error">
            <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.3rem;"></i>
            <div>
                <?php foreach ($errors->all() as$err): ?>
                    <div>• <?= $err; ?></div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Hero Banner -->
    <section class="surat-hero">
        <div class="hero-badge">
            <i class="fa-solid fa-signature"></i> Pelayanan Administrasi Mandiri Kabupaten Tuban
        </div>
        <h1>Portal Layanan Surat Desa</h1>
        <p>Ajukan permohonan surat administrasi kependudukan Anda secara online langsung ke balai desa tanpa perlu mengantre lama.</p>
    </section>

    <!-- Main Content -->
    <main class="content-wrap">
        
        <!-- Bar Cek Status Berkas -->
        <div class="tracking-bar">
            <div class="tracking-title">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <div>
                    <h4>Lacak Status Pengajuan Surat</h4>
                    <p>Masukkan nomor resi resmi Anda untuk melihat proses verifikasi pihak desa.</p>
                </div>
            </div>
            <div class="tracking-input-group">
                <input type="text" id="trackInput" placeholder="Contoh: SRT-202609-XXXX">
                <button type="button" class="btn-track" onclick="trackStatus()">Cek Resi</button>
            </div>
        </div>

        <!-- Pilihan Surat Kependudukan -->
        <h2 class="section-title">
            <i class="fa-solid fa-folder-open" style="color: var(--amber);"></i>
            Katalog Permohonan Surat Online
        </h2>

        <div class="surat-grid">
            
            <!-- 1. Surat Keterangan Usaha -->
            <div class="surat-card" style="--card-accent: #f59e0b; --icon-bg: #fef3c7;">
                <div>
                    <div class="card-top">
                        <div class="card-icon"><i class="fa-solid fa-store"></i></div>
                        <h3>Surat Keterangan Usaha (SKU)</h3>
                    </div>
                    <p>Bukti legalitas kepemilikan usaha lokal warga untuk pengajuan pinjaman perbankan, KUR, atau verifikasi mitra dagang.</p>
                </div>
                <button type="button" class="btn-apply" onclick="openApplyModal('Surat Keterangan Usaha (SKU)')">
                    <span>Ajukan Sekarang</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 2. Surat Domisili -->
            <div class="surat-card" style="--card-accent: #0284c7; --icon-bg: #e0f2fe;">
                <div>
                    <div class="card-top">
                        <div class="card-icon"><i class="fa-solid fa-house-user"></i></div>
                        <h3>Surat Keterangan Domisili</h3>
                    </div>
                    <p>Surat keterangan bukti tempat tinggal warga sementara atau tetap untuk keperluan pendaftaran kerja dan urusan hukum.</p>
                </div>
                <button type="button" class="btn-apply" onclick="openApplyModal('Surat Keterangan Domisili')">
                    <span>Ajukan Sekarang</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 3. Surat Pengantar SKCK -->
            <div class="surat-card" style="--card-accent: #10b981; --icon-bg: #d1fae5;">
                <div>
                    <div class="card-top">
                        <div class="card-icon"><i class="fa-solid fa-shield-halved"></i></div>
                        <h3>Pengantar SKCK</h3>
                    </div>
                    <p>Surat pengantar resmi dari desa untuk melengkapi berkas penerbitan Catatan Kepolisian di Polsek / Polres Tuban.</p>
                </div>
                <button type="button" class="btn-apply" onclick="openApplyModal('Pengantar SKCK')">
                    <span>Ajukan Sekarang</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 4. Keterangan Tidak Mampu -->
            <div class="surat-card" style="--card-accent: #f43f5e; --icon-bg: #ffe4e6;">
                <div>
                    <div class="card-top">
                        <div class="card-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <h3>Surat Tidak Mampu (SKTM)</h3>
                    </div>
                    <p>Surat verifikasi kelayakan bantuan sosial, beasiswa pendidikan siswa/mahasiswa, dan keringanan biaya perawatan medis.</p>
                </div>
                <button type="button" class="btn-apply" onclick="openApplyModal('Surat Tidak Mampu (SKTM)')">
                    <span>Ajukan Sekarang</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 5. Pengantar Akta Kelahiran -->
            <div class="surat-card" style="--card-accent: #8b5cf6; --icon-bg: #ede9fe;">
                <div>
                    <div class="card-top">
                        <div class="card-icon"><i class="fa-solid fa-baby"></i></div>
                        <h3>Pengantar Akta Kelahiran</h3>
                    </div>
                    <p>Dokumen awal pengantar dari pihak kelurahan/desa guna penerbitan akta kelahiran baru pada Dinas Dukcapil Tuban.</p>
                </div>
                <button type="button" class="btn-apply" onclick="openApplyModal('Pengantar Akta Kelahiran')">
                    <span>Ajukan Sekarang</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 6. Surat Kematian -->
            <div class="surat-card" style="--card-accent: #475569; --icon-bg: #f1f5f9;">
                <div>
                    <div class="card-top">
                        <div class="card-icon"><i class="fa-solid fa-ribbon"></i></div>
                        <h3>Surat Keterangan Kematian</h3>
                    </div>
                    <p>Penerbitan surat akta kematian warga untuk perapian administrasi kartu keluarga, perbankan, dan dokumen waris.</p>
                </div>
                <button type="button" class="btn-apply" onclick="openApplyModal('Surat Keterangan Kematian')">
                    <span>Ajukan Sekarang</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

        </div>
    </main>

    <!-- Modal Form Pengajuan Berkas -->
    <div class="modal-overlay" id="formModal" onclick="closeModalOutside(event)">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalSuratTitle">Formulir Pengajuan Surat</h3>
                <button type="button" class="btn-close" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <form action="<?= route('surat.kirim'); ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>

                    <div class="form-group">
                        <label>Jenis Surat</label>
                        <input type="text" name="jenis_surat" id="inputJenisSurat" readonly style="background: #f8fafc; font-weight: 700; color: var(--primary);">
                    </div>

                    <div class="form-group">
                        <label>Nomor Induk Kependudukan (NIK 16 Digit)</label>
                        <input type="text" name="nik" maxlength="16" minlength="16" required placeholder="Contoh: 3523xxxxxxxxxxxx" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap (Sesuai KTP)</label>
                        <input type="text" name="nama_lengkap" required placeholder="Masukkan nama lengkap pemohon">
                    </div>

                    <div class="form-group">
                        <label>Nomor WhatsApp Aktif</label>
                        <input type="text" name="no_wa" required placeholder="Contoh: 081234567890" oninput="this.value=this.value.replace(/[^0-9+]/g,'')">
                    </div>

                    <div class="form-group">
                        <label>Kecamatan di Kabupaten Tuban</label>
                        <select name="kecamatan" required>
                            <option value="">-- Pilih Kecamatan --</option>
                            <option value="Bancar">Kecamatan Bancar</option>
                            <option value="Bangilan">Kecamatan Bangilan</option>
                            <option value="Grabagan">Kecamatan Grabagan</option>
                            <option value="Jatirogo">Kecamatan Jatirogo</option>
                            <option value="Jenu">Kecamatan Jenu</option>
                            <option value="Kenduruan">Kecamatan Kenduruan</option>
                            <option value="Kerek">Kecamatan Kerek</option>
                            <option value="Merakurak">Kecamatan Merakurak</option>
                            <option value="Montong">Kecamatan Montong</option>
                            <option value="Palang">Kecamatan Palang</option>
                            <option value="Parengan">Kecamatan Parengan</option>
                            <option value="Plumpang">Kecamatan Plumpang</option>
                            <option value="Rengel">Kecamatan Rengel</option>
                            <option value="Semanding">Kecamatan Semanding</option>
                            <option value="Senori">Kecamatan Senori</option>
                            <option value="Singgahan">Kecamatan Singgahan</option>
                            <option value="Soko">Kecamatan Soko</option>
                            <option value="Tambakboyo">Kecamatan Tambakboyo</option>
                            <option value="Tuban">Kecamatan Tuban</option>
                            <option value="Widang">Kecamatan Widang</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Nama Desa / Kelurahan</label>
                        <input type="text" name="desa" required placeholder="Contoh: Desa Sugiharjo / Kelurahan Latsari">
                    </div>

                    <div class="form-group">
                        <label>Keperluan Permohonan</label>
                        <textarea name="keperluan" rows="3" required placeholder="Jelaskan kebutuhan pengajuan surat ini secara ringkas..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Lampiran Berkas Pendukung (KTP/KK dalam format PDF, JPG, PNG - Maks 3MB)</label>
                        <input type="file" name="berkas_syarat" accept=".pdf,.jpg,.jpeg,.png">
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan Surat
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Status Pelacakan Resi -->
    <div class="modal-overlay" id="trackingModal" onclick="closeModalOutside(event)">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">
                <h3>Hasil Pelacakan Surat</h3>
                <button type="button" class="btn-close" onclick="closeTrackingModal()">&times;</button>
            </div>
            <div class="modal-body" id="trackingModalBody">
                <!-- Konten dinamis dari AJAX -->
            </div>
        </div>
    </div>

    <!-- Script Interaktif -->
    <script>
        function openApplyModal(namaSurat) {
            document.getElementById('inputJenisSurat').value = namaSurat;
            document.getElementById('modalSuratTitle').innerText = 'Pengajuan ' + namaSurat;
            document.getElementById('formModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('formModal').style.display = 'none';
        }

        function closeTrackingModal() {
            document.getElementById('trackingModal').style.display = 'none';
        }

        function closeModalOutside(e) {
            if (e.target.id === 'formModal') closeModal();
            if (e.target.id === 'trackingModal') closeTrackingModal();
        }

        function trackStatus() {
            const input = document.getElementById('trackInput').value.trim();
            if (!input) {
                alert('Silakan masukkan nomor resi terlebih dahulu.');
                return;
            }

            const body = document.getElementById('trackingModalBody');
            body.innerHTML = '<div style="text-align:center; padding: 20px;"><i class="fa-solid fa-spinner fa-spin" style="font-size:2rem; color:var(--primary);"></i><p style="margin-top:10px;">Mengecek data di server desa...</p></div>';
            document.getElementById('trackingModal').style.display = 'flex';

            fetch("<?= url('/surat/lacak'); ?>?resi=" + encodeURIComponent(input))
                .then(res => res.json())
                .then(res => {
                    if (res.found && res.data) {
                        const d = res.data;
                        let statusColor = '#f59e0b';
                        if (d.status === 'Selesai') statusColor = '#10b981';
                        if (d.status === 'Ditolak') statusColor = '#e11d48';

                        body.innerHTML = `
                            <div style="font-size: 0.88rem;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 12px;">
                                    <span style="font-weight:800; color:#475569;">NOMOR RESI:</span>
                                    <span style="font-weight:800; color:var(--primary);">${d.nomor_resi}</span>
                                </div>
                                <div style="background:#f8fafc; border:1px solid var(--border-soft); border-radius:12px; padding:14px; margin-bottom:14px;">
                                    <div style="margin-bottom:6px;"><strong>Nama:</strong> ${d.nama_lengkap}</div>
                                    <div style="margin-bottom:6px;"><strong>Surat:</strong> ${d.jenis_surat}</div>
                                    <div style="margin-bottom:6px;"><strong>Lokasi:</strong> Kec. ${d.kecamatan}, Desa ${d.desa}</div>
                                    <div><strong>Status Saat Ini:</strong> 
                                        <span style="background:${statusColor}; color:white; padding:3px 10px; border-radius:12px; font-weight:800; font-size:0.75rem;">
                                            ${d.status}
                                        </span>
                                    </div>
                                </div>
                                <p style="font-size:0.8rem; color:#64748b; line-height:1.4;">
                                    ${d.catatan_petugas || 'Berkas Anda telah diterima sistem dan sedang dalam antrean verifikasi petugas kantor desa.'}
                                </p>
                            </div>
                        `;
                    } else {
                        body.innerHTML = `
                            <div style="text-align:center; padding:16px;">
                                <i class="fa-solid fa-circle-question" style="font-size:2.5rem; color:#f59e0b; margin-bottom:10px;"></i>
                                <h4 style="margin-bottom:6px;">Resi Tidak Ditemukan</h4>
                                <p style="font-size:0.82rem; color:#64748b;">Nomor resi <strong>"${input}"</strong> belum terdaftar di sistem. Pastikan nomor yang dimasukkan sudah sesuai.</p>
                            </div>
                        `;
                    }
                })
                .catch(err => {
                    body.innerHTML = '<p style="color:#e11d48; text-align:center;">Gagal menghubungi server. Periksa koneksi lokal Anda.</p>';
                });
        }
    </script>
</body>
</html>