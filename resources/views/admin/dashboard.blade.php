@extends('layouts.admin')

@section('title', 'Dashboard - Portal Desa Digital')

@section('content')
<!-- Welcome Section -->
<div class="welcome-section">
    <div class="welcome-badge">
        <i class="bi bi-stars"></i>
        LAYANAN ADMINISTRASI DESA
    </div>
    <h1>Selamat Datang di Portal Desa Digital</h1>
    <p>Satu wadah digitalisasi data, potensi, dan administrasi kemasyarakatan Kabupaten Tuban</p>
</div>

<!-- Menu Cards Grid -->
<div class="menu-grid">
    <!-- Card 1: Desa (UTAMA) -->
    <a href="{{ route('admin.desa.index') }}" class="menu-card active">
        <div class="menu-icon">
            <i class="bi bi-geo-alt-fill"></i>
        </div>
        <div class="menu-info">
            <h5>DESA <span class="badge-utama">UTAMA</span></h5>
            <p>Profil umum, data geografis, sejarah, dan struktur kepengurusan desa.</p>
        </div>
    </a>
    
    <!-- Card 2: Dusun -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-house-door"></i>
        </div>
        <div class="menu-info">
            <h5>DUSUN</h5>
            <p>Data kewilayahan dusun, rukun tetangga (RT), dan data demografi lokal.</p>
        </div>
    </a>
    
    <!-- Card 3: Kecamatan -->
    <a href="{{ route('admin.kecamatan.index') }}" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-building"></i>
        </div>
        <div class="menu-info">
            <h5>KECAMATAN</h5>
            <p>Informasi terintegrasi dengan distrik wilayah administratif Tuban.</p>
        </div>
    </a>
    
    <!-- Card 4: Wisata Desa -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-map"></i>
        </div>
        <div class="menu-info">
            <h5>WISATA DESA</h5>
            <p>Eksplorasi potensi pariwisata daerah, kebudayaan, dan cagar alam.</p>
        </div>
    </a>
    
    <!-- Card 5: Pasar Desa -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-shop"></i>
        </div>
        <div class="menu-info">
            <h5>PASAR DESA</h5>
            <p>Daftar pasar rakyat, komoditas utama, pelaku usaha mikro (UMKM).</p>
        </div>
    </a>
    
    <!-- Card 6: Kantor Desa -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-briefcase"></i>
        </div>
        <div class="menu-info">
            <h5>KANTOR DESA</h5>
            <p>Sistem layanan administrasi surat menyurat dan perizinan terpadu.</p>
        </div>
    </a>
    
    <!-- Card 7: WiFi Desa -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-wifi"></i>
        </div>
        <div class="menu-info">
            <h5>WIFI DESA</h5>
            <p>Pemantauan akses internet publik gratis dan jaringan desa digital.</p>
        </div>
    </a>
    
    <!-- Card 8: BUMDES -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-briefcase-fill"></i>
        </div>
        <div class="menu-info">
            <h5>BUMDES</h5>
            <p>Manajemen unit usaha bersama, keuangan, dan aset milik desa.</p>
        </div>
    </a>
    
    <!-- Card 9: KKDMP -->
    <a href="#" class="menu-card">
        <div class="menu-icon">
            <i class="bi bi-clipboard-data"></i>
        </div>
        <div class="menu-info">
            <h5>KKDMP</h5>
            <p>Rencana Pembangunan Jangka Menengah dan dokumen strategis desa.</p>
        </div>
    </a>
</div>
@endsection