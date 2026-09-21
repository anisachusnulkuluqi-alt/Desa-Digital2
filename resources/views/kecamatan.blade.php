<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum Distrik Kecamatan - Kabupaten Tuban</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --brand-navy: #09111e;
            --brand-navy-light: #0f1c30;
            --primary-blue: #1d4ed8;
            --accent-cyan: #0284c7;
            --accent-cyan-glow: #38bdf8;
            --royal-indigo: #4338ca;
            --text-dark: #0f172a;
            --text-gray: #64748b;
            --border-ui: #e2e8f0;
            --bg-soft: #f8fafc;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body { background: var(--bg-soft); color: var(--text-dark); }

        /* Topbar Header */
        .top-nav {
            background: var(--brand-navy);
            padding: 16px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }
        .brand-link { display: flex; align-items: center; gap: 12px; text-decoration: none; color: white; }
        .brand-link h3 { font-size: 1.1rem; font-weight: 800; }
        .brand-link span { font-size: 0.68rem; color: var(--accent-cyan-glow); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

        .btn-kembali {
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.84rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }
        .btn-kembali:hover { color: var(--accent-cyan-glow); }

        /* Banner Forum */
        .page-banner {
            background: linear-gradient(145deg, #09111e 0%, #0d1e38 55%, #1e1b4b 100%);
            padding: 60px 7% 75px 7%;
            color: white;
            text-align: center;
            position: relative;
        }
        .badge-pill {
            background: rgba(99, 102, 241, 0.18);
            color: #a5b4fc;
            border: 1px solid rgba(129, 140, 248, 0.35);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-bottom: 14px;
        }
        .page-banner h1 { font-size: 2.3rem; font-weight: 900; letter-spacing: -0.02em; }
        .page-banner p { color: #94a3b8; font-size: 0.92rem; max-width: 640px; margin: 10px auto 26px auto; line-height: 1.6; }

        .search-container {
            max-width: 520px;
            margin: 0 auto;
            display: flex;
            background: white;
            border-radius: 50px;
            padding: 6px 8px 6px 18px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }
        .search-container input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 0.88rem;
            color: #0f172a;
        }
        .search-container button {
            background: var(--royal-indigo);
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.82rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .search-container button:hover { background: #3730a3; }

        /* Container & Grid Kecamatan */
        .content-wrap {
            max-width: 1240px;
            margin: -35px auto 80px auto;
            padding: 0 20px;
        }

        .kecamatan-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .card-kec {
            background: white;
            border: 1.5px solid var(--border-ui);
            border-radius: 16px;
            padding: 24px 22px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }
        .card-kec::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #0ea5e9);
        }
        .card-kec:hover {
            transform: translateY(-4px);
            border-color: #818cf8;
            box-shadow: 0 16px 30px -4px rgba(79, 70, 229, 0.12);
        }

        .card-kec-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
        .card-kec-top h4 { font-size: 1.15rem; font-weight: 800; color: var(--text-dark); }
        .badge-kode {
            background: #ede9fe;
            color: #6366f1;
            font-size: 0.7rem;
            font-weight: 800;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .meta-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            background: var(--bg-soft);
            padding: 12px;
            border-radius: 10px;
            margin: 16px 0;
        }
        .meta-stats small { font-size: 0.68rem; color: var(--text-gray); display: block; font-weight: 700; text-transform: uppercase; }
        .meta-stats strong { font-size: 0.92rem; color: var(--text-dark); font-weight: 800; }

        .btn-masuk-forum {
            background: #0f172a;
            color: white;
            text-decoration: none;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            font-size: 0.82rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .btn-masuk-forum:hover { background: var(--royal-indigo); }

        @media(max-width: 960px) { .kecamatan-grid { grid-template-columns: repeat(2, 1fr); } }
        @media(max-width: 600px) { .kecamatan-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>

    <header class="top-nav">
        <a href="{{ url('/') }}" class="brand-link">
            <i class="fa-solid fa-building-columns" style="color: #a5b4fc; font-size: 1.3rem;"></i>
            <div>
                <h3>Forum Kecamatan</h3>
                <span>Kabupaten Tuban</span>
            </div>
        </a>
        <a href="{{ url('/') }}" class="btn-kembali">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
        </a>
    </header>

    <section class="page-banner">
        <span class="badge-pill"><i class="fa-solid fa-layer-group"></i> DISTRIK WILAYAH ADMINISTRATIF</span>
        <h1>Forum Wilayah 20 Kecamatan</h1>
        <p>Pusat koordinasi kewilayahan terpadu, pemantauan data kependudukan desa, dan pembinaan administrasi pemerintahan distrik Kabupaten Tuban.</p>

        <form class="search-container" action="{{ url('/kecamatan') }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kecamatan (cth: Jenu, Rengel, Semanding)...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i> Telusuri</button>
        </form>
    </section>

    <main class="content-wrap">
        <div class="kecamatan-grid">
            @if(isset($kecamatans) && count($kecamatans) > 0)
                @foreach($kecamatans as $kec)
                    <div class="card-kec">
                        <div>
                            <div class="card-kec-top">
                                <h4>Kecamatan {{ $kec->nama ?? $kec->nama_kecamatan ?? 'Kecamatan' }}</h4>
                                <span class="badge-kode">35.23.{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <p style="font-size: 0.82rem; color: var(--text-gray); line-height: 1.5;">
                                {{ Str::limit($kec->deskripsi ?? 'Pusat koordinasi distrik terpadu untuk monitoring dan pembinaan administrasi desa.', 90) }}
                            </p>
                            
                            <div class="meta-stats">
                                <div>
                                    <small>Jumlah Desa</small>
                                    <strong>{{ $kec->desas_count ?? rand(14, 20) }} Desa</strong>
                                </div>
                                <div>
                                    <small>Integrasi</small>
                                    <strong style="color: #10b981;">Online Siaga</strong>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('/desa?kecamatan=' . ($kec->nama ?? $kec->nama_kecamatan)) }}" class="btn-masuk-forum">
                            Buka Daftar Desa <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            @else
                <!-- Mock Data Otomatis 20 Kecamatan Resmi Tuban jika database belum di-seeding -->
                @php
                    $daftarKecamatanTuban = [
                        'Tuban', 'Jenu', 'Merakurak', 'Semanding', 'Palang', 'Widang', 
                        'Rengel', 'Soko', 'Plumpang', 'Kerek', 'Montong', 'Singgahan', 
                        'Senori', 'Bangilan', 'Jatirogo', 'Kenduruan', 'Bancar', 'Tambakboyo', 
                        'Grabagan', 'Parengan'
                    ];
                @endphp

                @foreach($daftarKecamatanTuban as $idx => $namaKec)
                    <div class="card-kec">
                        <div>
                            <div class="card-kec-top">
                                <h4>Kecamatan {{ $namaKec }}</h4>
                                <span class="badge-kode">35.23.{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <p style="font-size: 0.82rem; color: var(--text-gray); line-height: 1.5;">
                                Menghubungkan seluruh aparatur desa, transparansi data demografi, dan percepatan ekosistem digitalisasi.
                            </p>
                            
                            <div class="meta-stats">
                                <div>
                                    <small>Cakupan Desa</small>
                                    <strong>{{ rand(12, 22) }} Balai</strong>
                                </div>
                                <div>
                                    <small>Status Distrik</small>
                                    <strong style="color: #10b981;">Aktif Terpadu</strong>
                                </div>
                            </div>
                        </div>

                        <a href="{{ url('/desa?kecamatan=' . $namaKec) }}" class="btn-masuk-forum">
                            Masuk Forum Distrik <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </main>

</body>
</html>