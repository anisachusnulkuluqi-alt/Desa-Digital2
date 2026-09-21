<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Layanan PBB-P2 - BPKPAD Kabupaten Tuban</title>

    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-violet: #7c3aed;
            --primary-violet-dark: #6d28d9;
            --primary-violet-light: #ede9fe;
            --emerald: #10b981;
            --amber: #f59e0b;
            --rose: #f43f5e;
            --dark-header: #475569;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --bg-body: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }

        /* 1. TOP NAVBAR */
        .main-navbar {
            background: var(--dark-header);
            padding: 14px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .navbar-brand-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }
        .brand-logo-img {
            height: 38px;
            width: auto;
            max-width: 140px;
            object-fit: contain;
        }
        .nav-links-menu {
            display: flex;
            align-items: center;
            gap: 22px;
            list-style: none;
        }
        .nav-links-menu a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            transition: opacity 0.2s;
        }
        .nav-links-menu a:hover { opacity: 0.8; }
        .btn-nav-login {
            background: var(--primary-violet);
            color: #ffffff !important;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 800;
            cursor: pointer;
            border: none;
        }
        .btn-nav-login:hover { background: var(--primary-violet-dark); }

        /* 2. HERO SECTION */
        .epbb-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 60%, #4c1d95 100%);
            color: #ffffff;
            padding: 70px 7% 95px 7%;
            text-align: center;
            position: relative;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(124, 58, 237, 0.25);
            border: 1px solid rgba(167, 139, 250, 0.4);
            color: #c4b5fd;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 18px;
        }
        .epbb-hero h1 {
            font-size: 2.8rem;
            font-weight: 900;
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 12px;
        }
        .epbb-hero h1 span { color: #a78bfa; }
        .epbb-hero p {
            font-size: 1.05rem;
            color: #cbd5e1;
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* 3. MAIN CONTAINER & MODUL CEK NOP */
        .main-container {
            max-width: 1240px;
            margin: -50px auto 70px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        .search-nop-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.1);
            border: 1px solid var(--border-soft);
            margin-bottom: 45px;
        }
        .search-nop-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .search-nop-title i {
            font-size: 1.6rem;
            color: var(--primary-violet);
        }
        .search-nop-title h3 {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .search-nop-title p {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        .nop-form-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 14px;
        }
        .nop-input-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }
        .nop-input-group label {
            font-size: 0.76rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-dark);
        }
        .nop-input-group input, .nop-input-group select {
            border: 1.5px solid var(--border-soft);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.9rem;
            font-weight: 600;
            outline: none;
            transition: all 0.2s;
        }
        .nop-input-group input:focus, .nop-input-group select:focus {
            border-color: var(--primary-violet);
            box-shadow: 0 0 10px rgba(124, 58, 237, 0.15);
        }
        .btn-search-pbb {
            background: var(--primary-violet);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 800;
            cursor: pointer;
            height: 48px;
            align-self: flex-end;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }
        .btn-search-pbb:hover { background: var(--primary-violet-dark); }

        /* Box Hasil Pencarian */
        .bill-result-box {
            display: none;
            margin-top: 24px;
            padding: 22px;
            border-radius: 14px;
            background: #fdf4ff;
            border: 1.5px dashed #c084fc;
        }
        .bill-details-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-top: 14px;
        }
        .bill-item small {
            font-size: 0.72rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            display: block;
        }
        .bill-item strong {
            font-size: 0.92rem;
            color: var(--text-dark);
        }

        /* 4. ALUR & JENIS LAYANAN */
        .section-header {
            text-align: center;
            max-width: 650px;
            margin: 0 auto 35px auto;
        }
        .section-header h2 {
            font-size: 1.8rem;
            font-weight: 900;
            color: var(--text-dark);
            margin-bottom: 6px;
        }
        .section-header p {
            font-size: 0.88rem;
            color: var(--text-muted);
        }

        .flow-cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }
        .flow-card {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 24px 20px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .step-number {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--primary-violet-light);
            color: var(--primary-violet);
            font-weight: 800;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .flow-card h4 {
            font-size: 1rem;
            font-weight: 800;
            color: var(--text-dark);
        }
        .flow-card p {
            font-size: 0.8rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* 6 Kartu Jenis Pelayanan */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 50px;
        }
        .service-box {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.25s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .service-box:hover {
            transform: translateY(-4px);
            border-color: var(--primary-violet);
            box-shadow: 0 12px 24px rgba(124, 58, 237, 0.08);
        }
        .service-icon-circle {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: var(--primary-violet-light);
            color: var(--primary-violet);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 14px;
        }
        .service-box h4 {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 6px;
        }
        .service-box p {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin-bottom: 18px;
        }
        .btn-req-service {
            background: #f8fafc;
            border: 1.5px solid var(--border-soft);
            color: var(--primary-violet);
            padding: 10px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
            width: 100%;
        }
        .service-box:hover .btn-req-service {
            background: var(--primary-violet);
            color: #ffffff;
            border-color: transparent;
        }

        /* 5. KANAL PEMBAYARAN */
        .payment-channels-strip {
            background: #ffffff;
            border: 1px solid var(--border-soft);
            border-radius: 18px;
            padding: 26px;
            text-align: center;
        }
        .payment-channels-strip h4 {
            font-size: 0.95rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 16px;
        }
        .payment-logos-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .payment-badge {
            background: #f1f5f9;
            padding: 8px 18px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 800;
            color: #334155;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* 6. MODAL DIALOG DINAMIS */
        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(4px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-card-box {
            background: #ffffff;
            width: 100%;
            max-width: 600px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.25);
            animation: zoomIn 0.2s ease-out;
        }
        @keyframes zoomIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        .modal-header-pbb {
            background: #f8fafc;
            padding: 20px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-body-pbb {
            padding: 24px;
            max-height: 75vh;
            overflow-y: auto;
        }
        .form-row-pbb {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
        }
        .form-row-pbb label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--text-dark);
        }
        .form-row-pbb input, .form-row-pbb select, .form-row-pbb textarea {
            width: 100%;
            padding: 10px 14px;
            border-radius: 10px;
            border: 1.5px solid var(--border-soft);
            font-size: 0.86rem;
            outline: none;
        }
        .form-row-pbb input:focus, .form-row-pbb select:focus, .form-row-pbb textarea:focus {
            border-color: var(--primary-violet);
        }

        @media (max-width: 1024px) {
            .flow-cards-grid { grid-template-columns: repeat(2, 1fr); }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .nop-form-row { grid-template-columns: 1fr; }
            .btn-search-pbb { width: 100%; }
            .services-grid { grid-template-columns: 1fr; }
            .flow-cards-grid { grid-template-columns: 1fr; }
            .bill-details-grid { grid-template-columns: 1fr 1fr; }
            .nav-links-menu { display: none; }
        }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="main-navbar">
        <a href="{{ url('/') }}" class="navbar-brand-wrap">
            <img src="{{ asset('images/desa-digital.png') }}" 
                 alt="Logo Desa Digital" 
                 class="brand-logo-img"
                 onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png'">
            <span style="font-size: 1.22rem; font-weight: 800; color: #ffffff;">Desa<span style="color: #38bdf8;">Digital</span></span>
        </a>

        <ul class="nav-links-menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="#cek-tagihan">Cek NOP</a></li>
            <li><a href="#alur-layanan">Alur Pelayanan</a></li>
            <li><a href="#jenis-layanan">Jenis Layanan</a></li>
            <li><a href="{{ url('/#lokasi-kami') }}">Bantuan</a></li>
            <li><button type="button" class="btn-nav-login" onclick="openLoginModal()"><i class="fa-solid fa-arrow-right-to-bracket"></i> Masuk Akun</button></li>
        </ul>
    </header>

    <!-- Hero Section -->
    <section class="epbb-hero">
        <div class="hero-badge">
            <i class="fa-solid fa-shield-halved"></i> BPKPAD PEMERINTAH KABUPATEN TUBAN
        </div>
        <h1>Aplikasi E-Layanan <span>PBB-P2</span></h1>
        <p>Inovasi pelayanan terpadu pajak bumi dan bangunan perdesaan & perkotaan. Cek tagihan NOP mandiri, ajukan permohonan data, dan bayar pajak daerah tanpa antre.</p>
    </section>

    <!-- Main Content -->
    <main class="main-container">

        <!-- Modul Cek Tagihan NOP -->
        <div class="search-nop-card" id="cek-tagihan">
            <div class="search-nop-title">
                <i class="fa-solid fa-receipt"></i>
                <div>
                    <h3>Cek Status & Riwayat Tagihan SPPT PBB</h3>
                    <p>Masukkan 18 digit Nomor Objek Pajak (NOP) sesuai yang tertera pada lembar SPPT PBB Anda.</p>
                </div>
            </div>

            <form onsubmit="handleCheckNOP(event)">
                <div class="nop-form-row">
                    <div class="nop-input-group">
                        <label>Nomor Objek Pajak (NOP)</label>
                        <input type="number" id="inputNOP" required placeholder="Contoh: 352304000100200010">
                    </div>
                    <div class="nop-input-group">
                        <label>Tahun Pajak</label>
                        <select id="selectTahun">
                            <option value="2026">Tahun 2026</option>
                            <option value="2025">Tahun 2025</option>
                            <option value="2024">Tahun 2024</option>
                            <option value="2023">Tahun 2023</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-search-pbb">
                        <i class="fa-solid fa-magnifying-glass"></i> Cek Tagihan
                    </button>
                </div>
            </form>

            <!-- Box Hasil Cek NOP -->
            <div class="bill-result-box" id="billResult">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f0abfc; padding-bottom: 10px;">
                    <strong style="color: var(--primary-violet);"><i class="fa-solid fa-circle-check"></i> Objek Pajak Terverifikasi</strong>
                    <span style="background: #dcfce7; color: #15803d; font-size: 0.75rem; font-weight: 800; padding: 4px 10px; border-radius: 20px;">LUNAS / TERBIT</span>
                </div>
                <div class="bill-details-grid">
                    <div class="bill-item">
                        <small>Nama Wajib Pajak</small>
                        <strong id="resNama">-</strong>
                    </div>
                    <div class="bill-item">
                        <small>Letak Objek Pajak</small>
                        <strong id="resAlamat">-</strong>
                    </div>
                    <div class="bill-item">
                        <small>Luas Bumi / Bangunan</small>
                        <strong id="resLuas">-</strong>
                    </div>
                    <div class="bill-item">
                        <small>Total Ketetapan PBB</small>
                        <strong id="resTotal" style="color: #7c3aed; font-size: 1.05rem;">-</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alur Pelayanan Pajak -->
        <div class="section-header" id="alur-layanan">
            <h2>Alur Pelayanan E-PBB</h2>
            <p>Empat tahapan praktis pengajuan data dan pelunasan PBB-P2 warga Kabupaten Tuban.</p>
        </div>

        <div class="flow-cards-grid">
            <div class="flow-card">
                <div class="step-number">01</div>
                <h4>Pendaftaran Akun</h4>
                <p>Masyarakat atau perangkat desa mendaftarkan akun menggunakan NIK KTP dan nomor WhatsApp aktif.</p>
            </div>
            <div class="flow-card">
                <div class="step-number">02</div>
                <h4>Pilih Jenis Layanan</h4>
                <p>Pilih permohonan mutasi objek, pendaftaran baru, pembetulan nama/luas, atau cetak salinan SPPT.</p>
            </div>
            <div class="flow-card">
                <div class="step-number">03</div>
                <h4>Verifikasi Berkas</h4>
                <p>Petugas BPKPAD memverifikasi dokumen persyaratan dan data spasial tanah secara digital.</p>
            </div>
            <div class="flow-card">
                <div class="step-number">04</div>
                <h4>Penerbitan & Pembayaran</h4>
                <p>Dokumen SPPT digital terbit resmi dan siap dilunasi melalui QRIS, Bank Jatim, agen laku pandai, atau Pos.</p>
            </div>
        </div>

        <!-- 6 Jenis Pelayanan BPKPAD Tuban -->
        <div class="section-header" id="jenis-layanan">
            <h2>Jenis Pelayanan PBB-P2</h2>
            <p>Pilih format permohonan administrasi data objek dan subjek pajak sesuai keperluan Anda.</p>
        </div>

        <div class="services-grid">
            <!-- 1. Pendaftaran Baru -->
            <div class="service-box">
                <div>
                    <div class="service-icon-circle"><i class="fa-solid fa-file-circle-plus"></i></div>
                    <h4>Pendaftaran Objek Baru</h4>
                    <p>Pendaftaran tanah atau bangunan yang belum pernah terdata atau belum memiliki NOP di BPKPAD.</p>
                </div>
                <button type="button" class="btn-req-service" onclick="openLayananModal('Pendaftaran Objek Baru', 'Isi data bidang tanah atau bangunan yang belum pernah terdaftar NOP.')">
                    <span>Buka Formulir Baru</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 2. Mutasi Objek -->
            <div class="service-box">
                <div>
                    <div class="service-icon-circle"><i class="fa-solid fa-arrows-split-up-and-left"></i></div>
                    <h4>Mutasi Penuh / Pecah</h4>
                    <p>Peralihan hak kepemilikan tanah akibat jual beli, waris, hibah, ataupun pembagian kavling bidang tanah.</p>
                </div>
                <button type="button" class="btn-req-service" onclick="openLayananModal('Mutasi Penuh / Pecah', 'Pengajuan balik nama SPPT atau pemecahan luasan tanah.')">
                    <span>Buka Formulir Mutasi</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 3. Pembetulan SPPT -->
            <div class="service-box">
                <div>
                    <div class="service-icon-circle"><i class="fa-solid fa-pen-to-square"></i></div>
                    <h4>Pembetulan SPPT</h4>
                    <p>Koreksi kesalahan penulisan nama wajib pajak, alamat objek, luas tanah, atau kekeliruan kelas bangunan.</p>
                </div>
                <button type="button" class="btn-req-service" onclick="openLayananModal('Pembetulan SPPT PBB', 'Koreksi salah ketik nama, luas bumi, alamat, atau penetapan kelas tanah.')">
                    <span>Buka Formulir Pembetulan</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 4. Salinan SPPT -->
            <div class="service-box">
                <div>
                    <div class="service-icon-circle"><i class="fa-solid fa-copy"></i></div>
                    <h4>Salinan SPPT PBB</h4>
                    <p>Penerbitan cetak ulang surat pemberitahuan pajak terutang akibat lembaran asli rusak atau hilang.</p>
                </div>
                <button type="button" class="btn-req-service" onclick="openLayananModal('Salinan SPPT PBB', 'Pengajuan cetak ulang lembaran fisik SPPT yang hilang atau rusak.')">
                    <span>Buka Formulir Salinan</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 5. Pembatalan NOP -->
            <div class="service-box">
                <div>
                    <div class="service-icon-circle"><i class="fa-solid fa-ban"></i></div>
                    <h4>Pembatalan NOP</h4>
                    <p>Penghapusan objek pajak ganda (duplikasi data) atau objek yang beralih fungsi menjadi fasilitas umum.</p>
                </div>
                <button type="button" class="btn-req-service" onclick="openLayananModal('Pembatalan NOP', 'Pengajuan penghapusan nomor objek pajak ganda atau fasilitas umum.')">
                    <span>Buka Formulir Pembatalan</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>

            <!-- 6. Keringanan Pajak -->
            <div class="service-box">
                <div>
                    <div class="service-icon-circle"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                    <h4>Keringanan / Pengurangan</h4>
                    <p>Permohonan keringanan beban pajak terutang khusus bagi wajib pajak orang pribadi tertentu atau veteran.</p>
                </div>
                <button type="button" class="btn-req-service" onclick="openLayananModal('Keringanan / Pengurangan Pajak', 'Permohonan reduksi atau potongan beban pembayaran PBB terutang.')">
                    <span>Buka Formulir Keringanan</span> <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>

        <!-- Jalur Kanal Pembayaran -->
        <div class="payment-channels-strip">
            <h4>Kanal Resmi Pembayaran PBB-P2 Kabupaten Tuban</h4>
            <div class="payment-logos-row">
                <span class="payment-badge"><i class="fa-solid fa-qrcode" style="color: var(--primary-violet);"></i> QRIS All Payment</span>
                <span class="payment-badge"><i class="fa-solid fa-building-columns" style="color: #0284c7;"></i> Bank Jatim</span>
                <span class="payment-badge"><i class="fa-solid fa-store" style="color: #ea580c;"></i> Indomaret / Alfamart</span>
                <span class="payment-badge"><i class="fa-solid fa-envelope" style="color: #f59e0b;"></i> Kantor Pos Indonesia</span>
                <span class="payment-badge"><i class="fa-solid fa-mobile-screen" style="color: #10b981;"></i> Mobile Banking & Tokopedia</span>
            </div>
        </div>

    </main>

    <!-- Modal Formulir Permohonan Layanan PBB -->
    <div class="modal-backdrop" id="modalLayananPBB" onclick="closeModalOutside(event)">
        <div class="modal-card-box">
            <div class="modal-header-pbb">
                <div>
                    <h3 id="modalTitlePBB">Formulir Permohonan</h3>
                    <small id="modalDescPBB" style="color:#64748b; font-size:0.78rem;"></small>
                </div>
                <button type="button" onclick="closeLayananModal()" style="background:none; border:none; font-size:1.4rem; color:#94a3b8; cursor:pointer;">&times;</button>
            </div>

            <div class="modal-body-pbb">
                <form id="formLayananPBB" onsubmit="submitFormPBB(event)">
                    <div class="form-row-pbb">
                        <label>Jenis Layanan Terpilih</label>
                        <input type="text" id="inputNamaLayanan" readonly style="background:#f1f5f9; font-weight:800; color:#7c3aed;">
                    </div>

                    <div class="form-row-pbb" id="fieldNOPWrap">
                        <label>Nomor Objek Pajak (NOP) yang Diajukan</label>
                        <input type="number" id="inputNOPForm" placeholder="Masukkan 18 Digit NOP">
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                        <div class="form-row-pbb">
                            <label>NIK Pemohon / Kuasa</label>
                            <input type="number" required placeholder="3523xxxxxxxxxxxx">
                        </div>
                        <div class="form-row-pbb">
                            <label>Nama Lengkap Pemohon</label>
                            <input type="text" required placeholder="Sesuai KTP">
                        </div>
                    </div>

                    <div class="form-row-pbb">
                        <label>Unggah Dokumen Lampiran (KTP, Sertifikat / Akta Jual Beli / Surat Desa)</label>
                        <input type="file" required style="padding:8px 12px; font-size:0.8rem;">
                    </div>

                    <div class="form-row-pbb">
                        <label>Uraian Alasan Permohonan</label>
                        <textarea rows="3" required placeholder="Jelaskan kebutuhan pengajuan berkas ini secara rinci..."></textarea>
                    </div>

                    <button type="submit" style="width:100%; background:var(--primary-violet); color:#ffffff; border:none; padding:12px; border-radius:10px; font-weight:800; cursor:pointer; font-size:0.88rem; margin-top:8px;">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan ke BPKPAD Tuban
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Login Akun Wajib Pajak -->
    <div class="modal-backdrop" id="modalLogin" onclick="closeLoginModalOutside(event)">
        <div class="modal-card-box" style="max-width:420px;">
            <div class="modal-header-pbb">
                <h3 style="font-size:1.1rem; font-weight:800;">Masuk Akun Wajib Pajak</h3>
                <button type="button" onclick="closeLoginModal()" style="background:none; border:none; font-size:1.4rem; color:#94a3b8; cursor:pointer;">&times;</button>
            </div>
            <div class="modal-body-pbb">
                <form onsubmit="handleLoginSubmit(event)">
                    <div class="form-row-pbb">
                        <label>NIK / Username</label>
                        <input type="text" required placeholder="Masukkan NIK Anda">
                    </div>
                    <div class="form-row-pbb">
                        <label>Kata Sandi</label>
                        <input type="password" required placeholder="••••••••">
                    </div>
                    <button type="submit" style="width:100%; background:var(--primary-violet); color:#ffffff; border:none; padding:12px; border-radius:10px; font-weight:800; cursor:pointer; margin-top:10px;">
                        Masuk Sistem PBB
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script Fungsional -->
    <script>
        function handleCheckNOP(e) {
            e.preventDefault();
            const nop = document.getElementById('inputNOP').value.trim();
            const tahun = document.getElementById('selectTahun').value;

            if (nop.length < 10) {
                alert('Silakan masukkan format NOP yang valid.');
                return;
            }

            document.getElementById('resNama').innerText = 'WAJIB PAJAK MANDIRI';
            document.getElementById('resAlamat').innerText = 'Kec. Tuban, Kab. Tuban';
            document.getElementById('resLuas').innerText = 'Bumi: 240 m² | Bangunan: 110 m²';
            document.getElementById('resTotal').innerText = 'Rp 145.000 (Tahun ' + tahun + ')';

            document.getElementById('billResult').style.display = 'block';
        }

        function openLayananModal(judul, deskripsi) {
            document.getElementById('inputNamaLayanan').value = judul;
            document.getElementById('modalTitlePBB').innerText = `Formulir ${judul}`;
            document.getElementById('modalDescPBB').innerText = deskripsi;

            const fieldNOP = document.getElementById('fieldNOPWrap');
            if (judul === 'Pendaftaran Objek Baru') {
                fieldNOP.style.display = 'none';
                document.getElementById('inputNOPForm').removeAttribute('required');
            } else {
                fieldNOP.style.display = 'flex';
                document.getElementById('inputNOPForm').setAttribute('required', 'required');
            }

            document.getElementById('modalLayananPBB').style.display = 'flex';
        }

        function closeLayananModal() {
            document.getElementById('modalLayananPBB').style.display = 'none';
        }

        function closeModalOutside(e) {
            if (e.target.id === 'modalLayananPBB') closeLayananModal();
        }

        function submitFormPBB(e) {
            e.preventDefault();
            const layanan = document.getElementById('inputNamaLayanan').value;
            const tiket = 'BPKPAD-' + Math.floor(100000 + Math.random() * 900000);
            alert(`Permohonan [${layanan}] berhasil diajukan!\nNomor Tiket Berkas: ${tiket}\nTim teknis BPKPAD Tuban akan meninjau dokumen Anda.`);
            closeLayananModal();
        }

        function openLoginModal() {
            document.getElementById('modalLogin').style.display = 'flex';
        }

        function closeLoginModal() {
            document.getElementById('modalLogin').style.display = 'none';
        }

        function closeLoginModalOutside(e) {
            if (e.target.id === 'modalLogin') closeLoginModal();
        }

        function handleLoginSubmit(e) {
            e.preventDefault();
            alert('Autentikasi akun berhasil! Anda kini dapat mengelola seluruh SPPT terdaftar.');
            closeLoginModal();
        }
    </script>
</body>
</html>