<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Survei Kepuasan Masyarakat - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 50%, #0f172a 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #1e293b;
            padding: 30px 16px;
        }

        .survey-container {
            max-width: 680px;
            width: 100%;
            margin: auto;
        }

        .survey-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35);
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .survey-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #2563eb, #38bdf8, #10b981);
        }

        .brand-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #0f172a;
        }
        .brand-logo img {
            width: 44px;
            height: 44px;
            object-fit: contain;
        }
        .brand-text h4 {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            color: #1e3a8a;
        }
        .brand-text small {
            font-size: 11px;
            color: #64748b;
        }

        .btn-back-home {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            background: #f1f5f9;
            text-decoration: none;
            transition: all 0.2s;
        }
        .btn-back-home:hover { background: #e2e8f0; color: #1e3a8a; }

        .survey-title-area {
            text-align: center;
            margin-bottom: 32px;
        }
        .survey-eyebrow {
            display: inline-block;
            background: #eff6ff;
            color: #2563eb;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        .survey-title-area h1 {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .survey-title-area p {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
            margin: 0;
        }

        /* Rating Options */
        .rating-group-label {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .rating-cards-row {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
            margin-bottom: 24px;
        }
        .rating-radio { display: none; }
        .rating-card-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 14px 6px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #f8fafc;
            text-align: center;
            user-select: none;
        }
        .rating-card-label .emoji {
            font-size: 28px;
            margin-bottom: 6px;
            transition: transform 0.2s ease;
        }
        .rating-card-label .text-label {
            font-size: 11.5px;
            font-weight: 700;
            color: #475569;
        }
        .rating-card-label .stars-count {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .rating-card-label:hover {
            border-color: #93c5fd;
            background: #eff6ff;
            transform: translateY(-2px);
        }
        .rating-card-label:hover .emoji {
            transform: scale(1.15);
        }

        .rating-radio:checked + .rating-card-label {
            border-color: #2563eb;
            background: #eff6ff;
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.18);
        }
        .rating-radio:checked + .rating-card-label .emoji {
            transform: scale(1.2);
        }
        .rating-radio:checked + .rating-card-label .text-label {
            color: #1d4ed8;
            font-weight: 800;
        }

        /* Form Fields */
        .form-group-custom {
            margin-bottom: 20px;
        }
        .form-label-custom {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }
        .form-label-custom .optional {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 400;
        }
        .form-input-custom, .form-select-custom, .form-textarea-custom {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }
        .form-input-custom:focus, .form-select-custom:focus, .form-textarea-custom:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }
        .form-textarea-custom {
            resize: vertical;
            min-height: 95px;
        }

        .btn-submit-survey {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            color: white;
            border: none;
            font-size: 14px;
            font-weight: 800;
            letter-spacing: 0.3px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.25s;
            box-shadow: 0 6px 16px rgba(30, 58, 138, 0.25);
        }
        .btn-submit-survey:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(30, 58, 138, 0.35);
        }

        .survey-success-card {
            text-align: center;
            padding: 20px 0;
        }
        .success-icon-box {
            width: 72px;
            height: 72px;
            background: #dcfce7;
            color: #16a34a;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 20px;
        }

        .footer-note {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.6);
        }

        @media (max-width: 576px) {
            .survey-card { padding: 24px 18px; }
            .rating-cards-row { grid-template-columns: repeat(5, 1fr); gap: 6px; }
            .rating-card-label { padding: 10px 4px; }
            .rating-card-label .emoji { font-size: 22px; }
            .rating-card-label .text-label { font-size: 9.5px; }
            .rating-card-label .stars-count { display: none; }
            .survey-title-area h1 { font-size: 20px; }
        }
    </style>
</head>
<body>

    <div class="survey-container">
        <div class="survey-card">
            <div class="brand-header">
                <a href="{{ url('/') }}" class="brand-logo">
                    <img src="{{ asset('images/desa-digital.png') }}" alt="Logo Desa Digital">
                    <div class="brand-text">
                        <h4>Desa Digital</h4>
                        <small>Pemerintah Daerah</small>
                    </div>
                </a>
                <a href="{{ url('/') }}" class="btn-back-home">
                    <i class="bi bi-arrow-left"></i> Beranda
                </a>
            </div>

            @if(session('success'))
            <div class="survey-success-card">
                <div class="success-icon-box">
                    <i class="bi bi-check2"></i>
                </div>
                <h3 style="font-size: 22px; font-weight: 800; color: #0f172a; margin-bottom: 10px;">Terima Kasih!</h3>
                <p style="color: #64748b; font-size: 14px; max-width: 480px; margin: 0 auto 24px;">
                    {{ session('success') }} Masukan berharga Anda sangat membantu kami dalam mengembangkan website Desa Digital menjadi lebih baik dan bermanfaat bagi masyarakat luas.
                </p>
                <div style="display: flex; gap: 12px; justify-content: center;">
                    <a href="{{ route('survei.public') }}" class="btn-back-home" style="padding: 10px 20px;">
                        <i class="bi bi-arrow-clockwise"></i> Isi Survei Lagi
                    </a>
                    <a href="{{ url('/') }}" class="btn-back-home" style="padding: 10px 20px; background: #2563eb; color: white;">
                        <i class="bi bi-house-door"></i> Kembali ke Website
                    </a>
                </div>
            </div>
            @else

            <div class="survey-title-area">
                <span class="survey-eyebrow"><i class="bi bi-patch-check-fill me-1"></i> Partisipasi Publik</span>
                <h1>Survei Kepuasan Masyarakat</h1>
                <p>Bagaimana kepuasan Anda dalam mengakses informasi, data statistik, peta spasial, dan layanan pada Portal Desa Digital?</p>
            </div>

            <form method="POST" action="{{ route('survei.submit') }}">
                @csrf

                <!-- PILIH NILAI KEPUASAN -->
                <div class="form-group-custom">
                    <label class="rating-group-label">
                        <i class="bi bi-star-fill text-warning"></i>
                        Pilih Tingkat Kepuasan Anda: <span class="text-danger">*</span>
                    </label>
                    <div class="rating-cards-row">
                        <div>
                            <input type="radio" name="rating" id="rating1" value="1" class="rating-radio" required>
                            <label for="rating1" class="rating-card-label">
                                <span class="emoji">😞</span>
                                <span class="text-label">Kurang</span>
                                <span class="stars-count">⭐ 1</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="rating" id="rating2" value="2" class="rating-radio">
                            <label for="rating2" class="rating-card-label">
                                <span class="emoji">😐</span>
                                <span class="text-label">Cukup</span>
                                <span class="stars-count">⭐ 2</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="rating" id="rating3" value="3" class="rating-radio">
                            <label for="rating3" class="rating-card-label">
                                <span class="emoji">😊</span>
                                <span class="text-label">Baik</span>
                                <span class="stars-count">⭐ 3</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="rating" id="rating4" value="4" class="rating-radio" checked>
                            <label for="rating4" class="rating-card-label">
                                <span class="emoji">😃</span>
                                <span class="text-label">Puas</span>
                                <span class="stars-count">⭐ 4</span>
                            </label>
                        </div>
                        <div>
                            <input type="radio" name="rating" id="rating5" value="5" class="rating-radio">
                            <label for="rating5" class="rating-card-label">
                                <span class="emoji">🤩</span>
                                <span class="text-label">Hebat</span>
                                <span class="stars-count">⭐ 5</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- NAMA LENGKAP -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="nama">
                        Nama Lengkap <span class="optional">(Opsional)</span>
                    </label>
                    <input
                        type="text"
                        name="nama"
                        id="nama"
                        class="form-input-custom"
                        placeholder="Contoh: Budi Santoso"
                        maxlength="100"
                    >
                </div>

                <!-- KATEGORI / PROFESI -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="pekerjaan">
                        Kategori Pengunjung / Profesi <span class="optional">(Opsional)</span>
                    </label>
                    <select name="pekerjaan" id="pekerjaan" class="form-select-custom">
                        <option value="">-- Pilih Kategori Pengunjung --</option>
                        <option value="Masyarakat Desa">Masyarakat / Warga Desa</option>
                        <option value="Perangkat Desa / Kecamatan">Perangkat Desa / Staf Kecamatan</option>
                        <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa / Akademisi</option>
                        <option value="Pelaku Usaha / BUMDes">Pelaku Usaha / Pengelola BUMDes</option>
                        <option value="Pegawai Swasta / BUMN">Pegawai Swasta / BUMN / Wiraswasta</option>
                        <option value="Masyarakat Umum">Masyarakat Umum Lainnya</option>
                    </select>
                </div>

                <!-- KRITIK & SARAN -->
                <div class="form-group-custom">
                    <label class="form-label-custom" for="message">
                        Kritik, Saran & Masukan <span class="optional">(Opsional)</span>
                    </label>
                    <textarea
                        name="message"
                        id="message"
                        class="form-textarea-custom"
                        placeholder="Tuliskan pengalaman, kendala, atau saran pengembangan fitur untuk Desa Digital..."
                        maxlength="500"
                    ></textarea>
                </div>

                <button type="submit" class="btn-submit-survey">
                    <i class="bi bi-send-fill"></i> Kirim Penilaian Survei
                </button>
            </form>
            @endif
        </div>

        <div class="footer-note">
            &copy; {{ date('Y') }} Portal Desa Digital. Seluruh masukan survei dirahasiakan dan digunakan untuk perbaikan layanan publik.
        </div>
    </div>

</body>
</html>

