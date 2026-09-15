<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - Portal Desa Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f1f5f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .settings-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            text-align: center;
        }
        .settings-icon {
            width: 80px; height: 80px;
            background: linear-gradient(135deg, #64748b, #475569);
            border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            color: white; font-size: 36px;
        }
        .settings-card h2 { font-size: 22px; font-weight: 700; color: #0f172a; margin-bottom: 10px; }
        .settings-card p { color: #64748b; font-size: 14px; margin-bottom: 24px; }
        .btn-back {
            background: linear-gradient(135deg, #0ea5e9, #0284c7);
            color: white;
            padding: 10px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-back:hover { color: white; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="settings-card">
        <div class="settings-icon">
            <i class="bi bi-gear-fill"></i>
        </div>
        <h2>Pengaturan Sistem</h2>
        <p>Modul pengaturan sedang dalam pengembangan. Fitur ini akan segera tersedia.</p>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
</body>
</html>