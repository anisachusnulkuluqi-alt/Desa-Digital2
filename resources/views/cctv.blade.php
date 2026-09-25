<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live CCTV Wilayah - Desa Digital Kabupaten Tuban</title>
    <link rel="icon" type="image/png" href="<?= asset('images/desa-digital.png'); ?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --rose: #e11d48;
            --rose-dark: #be123c;
            --rose-light: #ffe4e6;
            --emerald: #10b981;
            --primary-blue: #0284c7;
            --dark-header: #475569;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-soft: #e2e8f0;
            --bg-body: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--bg-body); color: var(--text-dark); min-height: 100vh; overflow-x: hidden; }

        /* Header Navbar */
        .site-header {
            background: rgba(51, 65, 85, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 12px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        .brand-link { display: flex; align-items: center; gap: 12px; text-decoration: none; }
        .brand-logo-img { height: 38px; width: auto; max-width: 140px; object-fit: contain; display: block; }
        .brand-text-logo { font-size: 1.35rem; font-weight: 800; color: #ffffff; letter-spacing: -0.01em; display: flex; align-items: center; }
        .brand-text-logo span { color: #38bdf8; margin-left: 2px; }
        .nav-menu { display: flex; align-items: center; gap: 22px; list-style: none; }
        .nav-menu a { color: #e2e8f0; text-decoration: none; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.6px; position: relative; padding: 6px 0; transition: color 0.2s ease; }
        .nav-menu a:hover { color: #ffffff; }
        .nav-menu a.active { color: #38bdf8; }
        .nav-menu a.active::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: #38bdf8; border-radius: 2px; }
        .search-pill-nav { display: flex; align-items: center; background: rgba(255, 255, 255, 0.12); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 30px; padding: 5px 14px; width: 190px; transition: all 0.25s ease; }
        .search-pill-nav:focus-within { width: 230px; background: rgba(255, 255, 255, 0.2); border-color: #38bdf8; }
        .search-pill-nav input { background: transparent; border: none; outline: none; color: #ffffff; font-size: 0.8rem; width: 100%; }
        .search-pill-nav input::placeholder { color: rgba(255, 255, 255, 0.6); }
        .search-pill-nav button { background: transparent; border: none; color: rgba(255, 255, 255, 0.7); cursor: pointer; font-size: 0.8rem; }

        /* Hero Banner */
        .cctv-hero {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #881337 100%);
            color: #ffffff;
            padding: 60px 7% 80px 7%;
            text-align: center;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(225, 29, 72, 0.25);
            border: 1px solid rgba(244, 63, 94, 0.4);
            color: #fda4af;
            padding: 6px 18px;
            border-radius: 30px;
            font-size: 0.74rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 16px;
        }
        .cctv-hero h1 { font-size: 2.6rem; font-weight: 900; margin-bottom: 10px; letter-spacing: -0.02em; }
        .cctv-hero p { font-size: 1rem; color: #cbd5e1; max-width: 650px; margin: 0 auto; line-height: 1.6; }

        /* Wadah Konten Utama */
        .main-container {
            max-width: 1240px;
            margin: -40px auto 60px auto;
            padding: 0 20px;
            position: relative;
            z-index: 10;
        }

        /* Bilah Filter & Tombol Switch Opsi */
        .filter-strip {
            background: #ffffff;
            border-radius: 16px;
            padding: 16px 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            box-shadow: 0 10px 30px rgba(15,23,42,0.06);
            border: 1px solid var(--border-soft);
            margin-bottom: 30px;
            flex-wrap: wrap;
        }
        .search-cctv {
            flex: 1;
            min-width: 260px;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1.5px solid var(--border-soft);
            border-radius: 10px;
            padding: 8px 14px;
        }
        .search-cctv input { border: none; outline: none; width: 100%; font-size: 0.85rem; font-weight: 600; }

        /* Tombol Pilihan Tampilan Sederhana */
        .view-options-box {
            display: flex;
            background: #f1f5f9;
            padding: 4px;
            border-radius: 10px;
            gap: 4px;
        }
        .btn-view-opt {
            border: none;
            background: transparent;
            color: #64748b;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 0.78rem;
            font-weight: 800;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-view-opt.active {
            background: #ffffff;
            color: var(--rose);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        /* OPSI A: GRID KARTU (DEFAULT) */
        .cctv-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .cctv-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid var(--border-soft);
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.02);
            transition: all 0.25s;
            display: flex;
            flex-direction: column;
        }
        .cctv-card:hover {
            transform: translateY(-5px);
            border-color: var(--rose);
            box-shadow: 0 16px 30px rgba(225, 29, 72, 0.12);
        }
        .cctv-screen {
            height: 190px;
            background: #020617;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #475569;
            overflow: hidden;
        }
        .cctv-screen iframe { width: 100%; height: 100%; border: none; }
        .live-tag {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(225, 29, 72, 0.9);
            color: #ffffff;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.68rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 6px;
            z-index: 2;
        }
        .live-dot {
            width: 7px;
            height: 7px;
            background: #ffffff;
            border-radius: 50%;
        }
        .category-tag {
            position: absolute;
            top: 12px;
            right: 12px;
            background: rgba(15, 23, 42, 0.7);
            color: #ffffff;
            backdrop-filter: blur(4px);
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.68rem;
            font-weight: 700;
            z-index: 2;
        }
        .cctv-body {
            padding: 20px 18px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .cctv-body h4 { font-size: 1.05rem; font-weight: 800; color: var(--text-dark); margin-bottom: 4px; }
        .cctv-body small { display: block; color: var(--rose); font-weight: 700; font-size: 0.75rem; margin-bottom: 6px; }
        .cctv-body p { font-size: 0.8rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 16px; }
        .btn-stream {
            background: #f8fafc;
            border: 1px solid var(--border-soft);
            color: var(--text-dark);
            padding: 10px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 700;
            text-align: center;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s;
        }
        .cctv-card:hover .btn-stream { background: var(--rose); color: #ffffff; border-color: transparent; }

        /* OPSI B: TABEL DATA LIST */
        .cctv-table-wrapper {
            display: none;
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid var(--border-soft);
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.03);
            padding: 10px;
        }
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.84rem;
            text-align: left;
        }
        .data-table th {
            background: #f8fafc;
            padding: 12px 16px;
            font-weight: 800;
            color: #475569;
            border-bottom: 1.5px solid var(--border-soft);
            text-transform: uppercase;
            font-size: 0.72rem;
        }
        .data-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
        }
        .data-table tr:hover td { background: #fdf2f8; }

        /* Modal Player Layar Penuh */
        .modal-player-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 23, 0.85);
            backdrop-filter: blur(8px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .modal-player-box {
            background: #0f172a;
            width: 100%;
            max-width: 850px;
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #334155;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
        }
        .modal-player-header {
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #1e293b;
            color: #ffffff;
        }
        .btn-close-player { background: transparent; border: none; font-size: 1.4rem; color: #94a3b8; cursor: pointer; }
        .modal-player-screen {
            position: relative;
            min-height: 440px;
            background: #000000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-player-screen iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }

        @media (max-width: 992px) { .cctv-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) { .cctv-grid { grid-template-columns: 1fr; } .nav-menu { display: none; } }
    </style>
</head>
<body>

    <!-- Header Navbar -->
    <header class="site-header">
        <a href="<?= url('/'); ?>" class="brand-link">
            <img src="<?= asset('images/desa-digital.png'); ?>" class="brand-logo-img" alt="Logo Desa Digital" onerror="this.onerror=null; this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png'">
            <div class="brand-text-logo">Desa<span>Digital</span></div>
        </a>
        <ul class="nav-menu">
            <li><a href="<?= url('/'); ?>">BERANDA</a></li>
            <li><a href="<?= url('/website'); ?>">WEBSITE DESA</a></li>
            <li><a href="<?= url('/data-spasial'); ?>">DATA SPASIAL</a></li>
            <li><a href="<?= url('/cctv'); ?>" class="active">CCTV TUBAN</a></li>
            <li><a href="<?= url('/surat'); ?>">SURAT MANDIRI</a></li>
            <li><a href="<?= url('/epbb'); ?>">E-PBB</a></li>
        </ul>

        <form class="search-pill-nav" action="<?= url('/website'); ?>" method="GET">
            <input type="text" name="search" placeholder="Cari kecamatan...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </header>

    <!-- Hero Banner -->
    <section class="cctv-hero">
        <div class="hero-badge"><i class="fa-solid fa-video"></i> Monitoring Wilayah Real-Time</div>
        <h1>Pantauan CCTV Kabupaten Tuban</h1>
        <p>Sistem terpadu pemantau arus lalu lintas, pusat keramaian, dan fasilitas umum di lingkungan Pemerintah Kabupaten Tuban.</p>
    </section>

    <!-- Main Content -->
    <main class="main-container">
        
        <?php 
            $items = !empty($cctvList) ? (is_array($cctvList) ? $cctvList : $cctvList->all()) : [];
            $totalCount = count($items);
        ?>

        <!-- Filter Bar & Pilihan Opsi Tampilan -->
        <div class="filter-strip">
            <div class="search-cctv">
                <i class="fa-solid fa-magnifying-glass" style="color: var(--text-muted);"></i>
                <input type="text" id="filterInput" placeholder="Cari nama lokasi atau kecamatan..." oninput="filterDataCctv(this.value)">
            </div>

            <!-- Switcher Opsi Tampilan -->
            <div class="view-options-box">
                <button type="button" class="btn-view-opt active" id="btnOptGrid" onclick="setOpsiTampilan('grid')">
                    <i class="fa-solid fa-table-cells-large"></i> Grid Kartu
                </button>
                <button type="button" class="btn-view-opt" id="btnOptTable" onclick="setOpsiTampilan('table')">
                    <i class="fa-solid fa-list-ul"></i> Data List
                </button>
                <!-- Pilihan Peta Langsung Membuka Peta WebGIS Asli Tuban yang Sudah Berfungsi -->
                <a href="<?= url('/data-spasial'); ?>" class="btn-view-opt" title="Buka di Peta WebGIS Tuban">
                    <i class="fa-solid fa-map-location-dot"></i> Peta Spasial
                </a>
            </div>
        </div>

        <!-- 1. TAMPILAN GRID KARTU -->
        <div class="cctv-grid" id="viewModeGrid">
            <?php if ($totalCount > 0): ?>
                <?php foreach ($items as $cctv): ?>
                    <?php
                        $nama = is_array($cctv) ? ($cctv['nama_lokasi'] ?? '') : ($cctv->nama_lokasi ?? '');
                        $kec = is_array($cctv) ? ($cctv['kecamatan'] ?? '') : ($cctv->kecamatan ?? '');
                        $kategori = is_array($cctv) ? ($cctv['kategori'] ?? 'Publik') : ($cctv->kategori ?? 'Publik');
                        $status = is_array($cctv) ? ($cctv['status'] ?? 'Online') : ($cctv->status ?? 'Online');
                        $streamUrl = is_array($cctv) ? ($cctv['stream_url'] ?? '') : ($cctv->stream_url ?? '');
                        $desk = is_array($cctv) ? ($cctv['deskripsi'] ?? '') : ($cctv->deskripsi ?? '');
                    ?>
                    <div class="cctv-card" data-search="<?= strtolower($nama . ' ' . $kec); ?>">
                        <div class="cctv-screen">
                            <?php if (strtolower((string)$status) === 'online'): ?>
                                <span class="live-tag"><span class="live-dot"></span> LIVE</span>
                            <?php else: ?>
                                <span class="live-tag" style="background: #eab308;">OFFLINE</span>
                            <?php endif; ?>
                            <span class="category-tag"><?= htmlspecialchars((string)$kategori); ?></span>

                            <?php if (!empty($streamUrl)): ?>
                                <iframe src="<?= htmlspecialchars((string)$streamUrl); ?>?autoplay=0&mute=1" allowfullscreen></iframe>
                            <?php else: ?>
                                <div style="text-align: center;">
                                    <i class="fa-solid fa-video" style="font-size: 2.2rem; color: #64748b; margin-bottom: 6px;"></i>
                                    <div style="font-size: 0.72rem; color: #94a3b8; font-weight: 700;">STREAM READY</div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="cctv-body">
                            <div>
                                <small><i class="fa-solid fa-location-dot"></i> Kec. <?= htmlspecialchars((string)$kec); ?></small>
                                <h4><?= htmlspecialchars((string)$nama); ?></h4>
                                <p><?= htmlspecialchars((string)$desk); ?></p>
                            </div>
                            <button type="button" class="btn-stream" onclick="openPlayerModal('<?= addslashes((string)$nama); ?>', '<?= addslashes((string)$streamUrl); ?>')">
                                <i class="fa-solid fa-expand"></i> Buka Layar Penuh
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 50px 20px; background: #ffffff; border-radius: 16px; border: 1px solid var(--border-soft);">
                    <i class="fa-solid fa-video-slash" style="font-size: 2.8rem; color: #94a3b8; margin-bottom: 14px;"></i>
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #1e293b; margin-bottom: 6px;">Belum Ada Kamera Terdaftar</h3>
                    <p style="font-size: 0.85rem; color: #64748b;">Silakan tambahkan data titik CCTV melalui dashboard back-end Anda.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- 2. TAMPILAN DATA LIST (TABEL) -->
        <div class="cctv-table-wrapper" id="viewModeTable">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Kategori</th>
                        <th>Nama Lokasi</th>
                        <th>Kecamatan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBodyList">
                    <?php if ($totalCount > 0): ?>
                        <?php foreach ($items as $cctv): ?>
                            <?php
                                $nama = is_array($cctv) ? ($cctv['nama_lokasi'] ?? '') : ($cctv->nama_lokasi ?? '');
                                $kec = is_array($cctv) ? ($cctv['kecamatan'] ?? '') : ($cctv->kecamatan ?? '');
                                $kategori = is_array($cctv) ? ($cctv['kategori'] ?? 'Publik') : ($cctv->kategori ?? 'Publik');
                                $status = is_array($cctv) ? ($cctv['status'] ?? 'Online') : ($cctv->status ?? 'Online');
                                $streamUrl = is_array($cctv) ? ($cctv['stream_url'] ?? '') : ($cctv->stream_url ?? '');
                                $desk = is_array($cctv) ? ($cctv['deskripsi'] ?? '') : ($cctv->deskripsi ?? '');
                                $isOnline = (strtolower((string)$status) === 'online' || strtolower((string)$status) === 'aktif');
                            ?>
                            <tr data-search="<?= strtolower($nama . ' ' . $kec); ?>">
                                <td>
                                    <span style="display: inline-flex; align-items: center; gap: 6px; font-weight: 800; font-size: 0.75rem; color: <?= $isOnline ? '#16a34a' : '#eab308'; ?>;">
                                        <span style="width: 7px; height: 7px; border-radius: 50%; background: currentColor;"></span>
                                        <?= $isOnline ? 'ONLINE' : 'OFFLINE'; ?>
                                    </span>
                                </td>
                                <td><span style="background: #f1f5f9; padding: 4px 8px; border-radius: 6px; font-size: 0.72rem; font-weight: 700;"><?= htmlspecialchars((string)$kategori); ?></span></td>
                                <td><strong><?= htmlspecialchars((string)$nama); ?></strong></td>
                                <td>Kec. <?= htmlspecialchars((string)$kec); ?></td>
                                <td><?= htmlspecialchars((string)$desk); ?></td>
                                <td>
                                    <button type="button" style="background: var(--rose); color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 0.74rem; font-weight: 700; cursor: pointer;" onclick="openPlayerModal('<?= addslashes((string)$nama); ?>', '<?= addslashes((string)$streamUrl); ?>')">
                                        <i class="fa-solid fa-play"></i> Pantau
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center; padding: 30px; color: #94a3b8;">Tidak ada data kamera.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

    <!-- Modal Player Pop-up -->
    <div class="modal-player-backdrop" id="playerModal" onclick="closePlayerModalOutside(event)">
        <div class="modal-player-box">
            <div class="modal-player-header">
                <h3 id="playerTitle" style="font-size: 1rem; font-weight: 800;"><i class="fa-solid fa-circle-dot" style="color: var(--rose);"></i> Siaran Kamera</h3>
                <button type="button" class="btn-close-player" onclick="closePlayerModal()">&times;</button>
            </div>
            <div class="modal-player-screen" id="playerScreenBox"></div>
        </div>
    </div>

    <!-- Script Sederhana Tanpa Library Berat / LaTeX -->
    <script>
        function setOpsiTampilan(mode) {
            const viewGrid = document.getElementById('viewModeGrid');
            const viewTable = document.getElementById('viewModeTable');
            const btnGrid = document.getElementById('btnOptGrid');
            const btnTable = document.getElementById('btnOptTable');

            if (mode === 'grid') {
                btnGrid.classList.add('active');
                btnTable.classList.remove('active');
                viewGrid.style.display = 'grid';
                viewTable.style.display = 'none';
            } else if (mode === 'table') {
                btnTable.classList.add('active');
                btnGrid.classList.remove('active');
                viewGrid.style.display = 'none';
                viewTable.style.display = 'block';
            }
        }

        function filterDataCctv(query) {
            const q = query.toLowerCase();
            
            document.querySelectorAll('.cctv-card').forEach(card => {
                const text = card.getAttribute('data-search') || '';
                card.style.display = text.includes(q) ? 'flex' : 'none';
            });

            document.querySelectorAll('#tableBodyList tr').forEach(row => {
                const text = row.getAttribute('data-search') || '';
                row.style.display = text.includes(q) ? '' : 'none';
            });
        }

        function openPlayerModal(nama, streamUrl) {
            document.getElementById('playerTitle').innerHTML = '<i class="fa-solid fa-video" style="color: var(--rose);"></i> ' + nama;
            const box = document.getElementById('playerScreenBox');
            
            if (streamUrl && streamUrl.trim() !== '') {
                box.innerHTML = '<iframe src="' + streamUrl + '?autoplay=1&mute=0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
            } else {
                box.innerHTML = '<div style="text-align: center; color: #94a3b8;"><i class="fa-solid fa-video" style="font-size: 3rem; margin-bottom: 12px; color: var(--rose);"></i><h4 style="color: #ffffff; font-size: 1.1rem; margin-bottom: 4px;">Koneksi Kamera Lokal Siap</h4><p style="font-size: 0.85rem;">Siaran stream RTSP / HLS aktif untuk ' + nama + '.</p></div>';
            }

            document.getElementById('playerModal').style.display = 'flex';
        }

        function closePlayerModal() {
            document.getElementById('playerModal').style.display = 'none';
            document.getElementById('playerScreenBox').innerHTML = '';
        }

        function closePlayerModalOutside(e) {
            if (e.target.id === 'playerModal') closePlayerModal();
        }
    </script>
</body>
</html>