<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Website Desa / Kelurahan - Kabupaten Tuban</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-dark-header: #475569;
            --bg-body: #ffffff;
            --card-bg: #f1f5f9;
            --card-hover: #e2e8f0;
            --border-card: #e2e8f0;
            --text-dark: #1e293b;
            --primary-blue: #0284c7;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background-color: var(--bg-body); color: var(--text-dark); min-height: 100vh; }

        .site-header {
            background: #475569;
            padding: 16px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #ffffff;
            font-size: 1.3rem;
            font-weight: 800;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 24px;
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

        .search-nav {
            position: relative;
            display: flex;
            align-items: center;
        }

        .search-nav input {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 6px 36px 6px 14px;
            color: #ffffff;
            outline: none;
            font-size: 0.82rem;
            width: 180px;
        }
        .search-nav input::placeholder { color: rgba(255, 255, 255, 0.7); }
        .search-nav i {
            position: absolute;
            right: 12px;
            color: #ffffff;
            font-size: 0.8rem;
        }

        .content-container {
            max-width: 1300px;
            margin: 40px auto 60px auto;
            padding: 0 30px;
        }

        .main-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 35px;
        }

        .kecamatan-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
        }

        .kecamatan-card {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .kecamatan-card:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
            border-color: #cbd5e1;
            box-shadow: 0 6px 14px rgba(0,0,0,0.06);
        }

        .logo-tuban-badge {
            width: 34px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .kecamatan-card span {
            font-size: 0.88rem;
            font-weight: 700;
            color: #1e293b;
        }

        .modal-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            z-index: 2000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-box {
            background: #ffffff;
            width: 100%;
            max-width: 650px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
            animation: popIn 0.2s ease-out;
        }

        @keyframes popIn {
            from { transform: scale(0.95); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .modal-header {
            background: #f8fafc;
            padding: 18px 24px;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand-logo-img {
         height: 38px;
            width: auto;
            max-width: 140px;
         object-fit: contain;
        display: block;
         }

        .modal-header h3 { font-size: 1.15rem; font-weight: 800; color: var(--text-dark); }
        .btn-close-modal {
            background: transparent;
            border: none;
            font-size: 1.2rem;
            color: #64748b;
            cursor: pointer;
        }

        .modal-body {
            padding: 20px 24px;
            max-height: 400px;
            overflow-y: auto;
        }

        .desa-list-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .desa-btn-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            color: #1e293b;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.2s;
        }

        .desa-btn-item:hover {
            background: #e0f2fe;
            border-color: var(--primary-blue);
            color: var(--primary-blue);
        }

        @media (max-width: 1200px) { .kecamatan-grid { grid-template-columns: repeat(4, 1fr); } }
        @media (max-width: 900px) {
            .kecamatan-grid { grid-template-columns: repeat(3, 1fr); }
            .nav-menu { display: none; }
        }
        @media (max-width: 600px) {
            .kecamatan-grid { grid-template-columns: repeat(2, 1fr); }
            .desa-list-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <header class="site-header">
        <a href="{{ url('/') }}" class="brand-link">
            <i class="fa-solid fa-shapes" style="color: #38bdf8;"></i>
            <span>DesaDigital</span>
        </a>
        <ul class="nav-menu">
            <li><a href="{{ url('/') }}">Beranda</a></li>
            <li><a href="{{ url('/#tentang-kami') }}">Tentang Kami</a></li>
            <li><a href="{{ url('/#layanan-digital') }}">Layanan</a></li>
            <li><a href="{{ url('/#lokasi-kami') }}">Hubungi Kami</a></li>
        </ul>
        <div class="search-nav">
            <input type="text" id="liveSearchKec" placeholder="Cari kecamatan..." oninput="filterKecamatan(this.value)">
            <i class="fa-solid fa-magnifying-glass"></i>
        </div>
    </header>

    <div class="content-container">
        <h1 class="main-title">Data Website Desa / Kelurahan</h1>

        <div class="kecamatan-grid" id="gridKecamatan">
            <!-- 20 Kecamatan Kabupaten Tuban -->
            <div class="kecamatan-card" onclick="openDesaModal('Bancar')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Bancar</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Bangilan')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Bangilan</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Grabagan')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Grabagan</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Jatirogo')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Jatirogo</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Jenu')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Jenu</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Kenduruan')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Kenduruan</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Kerek')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Kerek</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Merakurak')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Merakurak</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Montong')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Montong</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Palang')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Palang</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Parengan')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Parengan</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Plumpang')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Plumpang</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Rengel')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Rengel</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Semanding')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Semanding</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Senori')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Senori</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Singgahan')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Singgahan</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Soko')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Soko</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Tambakboyo')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Tambakboyo</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Tuban')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Tuban</span>
            </div>
            <div class="kecamatan-card" onclick="openDesaModal('Widang')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Lambang_Kabupaten_Tuban.png/400px-Lambang_Kabupaten_Tuban.png" class="logo-tuban-badge" alt="Tuban">
                <span>Widang</span>
            </div>
        </div>
    </div>

    <!-- Modal Pop-up Daftar Desa -->
    <div class="modal-backdrop" id="desaModal" onclick="closeDesaModal(event)">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="modalKecamatanTitle">Daftar Desa / Kelurahan</h3>
                <button type="button" class="btn-close-modal" onclick="document.getElementById('desaModal').style.display='none'">&times;</button>
            </div>
            <div class="modal-body">
                <div class="desa-list-grid" id="modalDesaList"></div>
            </div>
        </div>
    </div>

    <script>
        const daftarDesa = {
            'Bancar': ['Boncong', 'Bogorejo', 'Bancar', 'Bulu', 'Jatisari', 'Ngujuran', 'Margosuko', 'Sukoharjo', 'Sumberan'],
            'Merakurak': ['Tuwiri Wetan', 'Tuwiri Kulon', 'Sambonggede', 'Mandirejo', 'Sumberejo', 'Kaponan', 'Tahulu', 'Seno'],
            'Kenduruan': ['Tawaran', 'Sidohasri', 'Jombok', 'Sokogunung', 'Jamprong', 'Bendonglateng'],
            'Tuban': ['Kutorejo', 'Kebonsari', 'Kingking', 'Baturetno', 'Ronggomulyo', 'Sidomulyo', 'Sugiharjo', 'Kembangbilo'],
            'Jatirogo': ['Wotsogo', 'Sadang', 'Paseyan', 'Dingil', 'Bader', 'Ketodan', 'Sugihan'],
            'Jenu': ['Beji', 'Jenu', 'Remen', 'Tasikharjo', 'Sugihwaras', 'Rawasan', 'Mentoso'],
            'Palang': ['Palang', 'Karangagung', 'Kradenan', 'Tasikmadu', 'Gesikharjo', 'Panyuran'],
            'Semanding': ['Bektiharjo', 'Prunggahan Kulon', 'Prunggahan Wetan', 'Gedongombo', 'Semanding', 'Karang'],
            'Rengel': ['Rengel', 'Campurejo', 'Kanorejo', 'Karisrejo', 'Maibit', 'Pekuwon', 'Sawahan'],
            'Singgahan': ['Mulyoagung', 'Tingkis', 'Tanggir', 'Laju Lor', 'Laju Kidul', 'Mergoasri'],
            'Grabagan': ['Grabagan', 'Dahor', 'Dermawuharjo', 'Gesikan', 'Menyunyur', 'Ngandong', 'Ngarum'],
            'Kerek': ['Jarorejo', 'Kasiman', 'Kedungrejo', 'Margomulyo', 'Padasan', 'Temayang', 'Trantang'],
            'Montong': ['Montongsekar', 'Maindu', 'Manjung', 'Pakel', 'Pucangan', 'Talangkembar', 'Tanggangsar'],
            'Parengan': ['Parangbatu', 'Cengkong', 'Dagangan', 'Kumpulrejo', 'Mergoasri', 'Mojomalang', 'Selogarlang'],
            'Plumpang': ['Plumpang', 'Bandungrejo', 'Kecil', 'Kedungsoko', 'Klotok', 'Magersari', 'Penidon'],
            'Senori': ['Sendang', 'Banyu-urip', 'Kaligede', 'Mediyunan', 'Rayung', 'Sidoharjo', 'Wonorejo'],
            'Soko': ['Sokosari', 'Bangunrejo', 'Gladsari', 'Jati', 'Kendalgayam', 'Menilo', 'Pandanagung'],
            'Tambakboyo': ['Tambakboyo', 'Belikanget', 'Cokrowati', 'Dasin', 'Dikir', 'Gadirejo', 'Klutuk'],
            'Widang': ['Widang', 'Banjar', 'Bunut', 'Kompak', 'Minohorejo', 'Mrutuk', 'Ngadipuro', 'Simorejo']
        };

        function openDesaModal(namaKecamatan) {
            const modal = document.getElementById('desaModal');
            const title = document.getElementById('modalKecamatanTitle');
            const listContainer = document.getElementById('modalDesaList');

            title.innerText = `Desa / Kelurahan di Kec. ${namaKecamatan}`;
            listContainer.innerHTML = '';

            const desaArray = daftarDesa[namaKecamatan] || [
                `Desa ${namaKecamatan} 1`, `Desa ${namaKecamatan} 2`, `Desa ${namaKecamatan} 3`, `Desa ${namaKecamatan} 4`
            ];

            desaArray.forEach(desa => {
                const slug = desa.toLowerCase().replace(/\s+/g, '');
                const a = document.createElement('a');
                a.href = `https://${slug}.desa.id`;
                a.target = '_blank';
                a.className = 'desa-btn-item';
                a.innerHTML = `<span>${desa}</span> <i class="fa-solid fa-arrow-up-right-from-square" style="font-size:0.75rem;"></i>`;
                listContainer.appendChild(a);
            });

            modal.style.display = 'flex';
        }

        function closeDesaModal(e) {
            if (e.target.id === 'desaModal') {
                document.getElementById('desaModal').style.display = 'none';
            }
        }

        function filterKecamatan(val) {
            const query = val.toLowerCase();
            const cards = document.querySelectorAll('.kecamatan-card');
            cards.forEach(card => {
                const name = card.querySelector('span').innerText.toLowerCase();
                card.style.display = name.includes(query) ? 'flex' : 'none';
            });
        }
    </script>
</body>
</html>