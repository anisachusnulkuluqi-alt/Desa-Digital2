<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DusunController as AdminDusunController;

/*
|--------------------------------------------------------------------------
| 1. ROUTES PORTAL PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

// Beranda Utama (Landing Page)
Route::get('/', function () {
    return view('landing');
})->name('home');

// Modul Data Spasial Terpadu (Peta GIS)
Route::get('/data-spasial', function () {
    return view('data-spasial');
})->name('data.spasial');

// Alias route webgis
Route::get('/webgis', function () {
    return redirect()->route('data.spasial');
})->name('webgis');

Route::get('/website', function () {
    return view('website');
});

Route::get('/surat', function () {
    return view('surat');
});

Route::get('/epbb', function () {
    return view('epbb');
});

// 4. Modul Live Monitoring CCTV Wilayah (Murni Data Dinamis Backend)
Route::get('/cctv', function (Request $request) {
    // Ambil data langsung dari Database / Model jika sudah ada
    // Jika belum ada data atau tabel belum dibuat, kirim array kosong
    $cctvList = class_exists(\App\Models\Cctv::class)
        ? \App\Models\Cctv::all()
        : [];

    return view('cctv', compact('cctvList'));
})->name('cctv.index');

// Katalog Desa Publik
Route::get('/desa-publik', function () {
    if (view()->exists('desa-publik')) {
        return view('desa-publik');
    }
    return redirect('/#layanan-unggulan');
})->name('desa.publik');

// Halaman Informasi Publik
Route::get('/tentang', function () {
    if (view()->exists('tentang')) {
        return view('tentang');
    }
    return redirect('/#tentang-kami');
})->name('tentang');

Route::get('/kontak', function () {
    if (view()->exists('kontak')) {
        return view('kontak');
    }
    return redirect('/#hubungi-kami');
})->name('kontak');
Route::get('/kecamatan', function () {
    // Mengambil data dari tabel kecamatans (jika model sudah ada di backend)
    $kecamatans = class_exists(\App\Models\Kecamatan::class) 
        ? \App\Models\Kecamatan::with('desas')->get() 
        : collect([]);

    // Cek apakah user sedang mengklik/memilih salah satu kecamatan tertentu
    $selectedId = request('id');
    $selectedKecamatan = $kecamatans->firstWhere('id', $selectedId);

    return view('kecamatan', compact('kecamatans', 'selectedKecamatan'));
})->name('kecamatan.index');

/*
|--------------------------------------------------------------------------
| 2. ROUTES SISTEM AUTENTIKASI (LARAVEL BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3. ROUTES BACKEND ADMIN (MEMERLUKAN LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Dashboard 3 Tingkat Admin (Kompatibilitas)
    Route::get('/admin/kominfo/dashboard', [DashboardController::class, 'index'])->name('admin.kominfo.dashboard');
    Route::get('/admin/kecamatan/dashboard', [DashboardController::class, 'index'])->name('admin.kecamatan.dashboard');
    Route::get('/admin/desa/dashboard', [DashboardController::class, 'index'])->name('admin.desa.dashboard');

    // Group Route Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // ==========================================
        // A. RESOURCE CRUD (Controller Lengkap)
        // ==========================================
        Route::resource('kecamatan', AdminKecamatanController::class);
        Route::resource('desa', AdminDesaController::class);
        Route::resource('berita', AdminBeritaController::class);
        Route::resource('dusun', AdminDusunController::class);

        // ==========================================
        // B. ROUTE PLACEHOLDER (Modul Belum Ada Controller)
        // ==========================================
        
        // Kantor Desa
        Route::get('/kantor-desa', function () { 
            return view('admin.dashboard'); 
        })->name('kantor.index');
        
        // Wisata Desa
        Route::get('/wisata', function () { 
            return view('admin.dashboard'); 
        })->name('wisata.index');
        
        // Pasar Desa
        Route::get('/pasar', function () { 
            return view('admin.dashboard'); 
        })->name('pasar.index');
        
        // WiFi Desa
        Route::get('/wifi', function () { 
            return view('admin.dashboard'); 
        })->name('wifi.index');
        
        // BUMDes
        Route::get('/bumdes', function () { 
            return view('admin.dashboard'); 
        })->name('bumdes.index');
        
        // KKDMP
        Route::get('/kkdmp', function () { 
            return view('admin.dashboard'); 
        })->name('kkdmp.index');
        
        // Settings / Pengaturan
        Route::get('/settings', function () { 
            return view('admin.settings.index'); 
        })->name('settings.index');
    });

    // ==========================================
    // C. ROUTE PROFILE PENGGUNA (Fallback Aman)
    // ==========================================
    if (class_exists(ProfileController::class)) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    } else {
        Route::get('/profile', function () {
            return redirect()->route('dashboard');
        })->name('profile.edit');
        
        Route::patch('/profile', function () {
            return redirect()->route('dashboard');
        })->name('profile.update');
        
        Route::delete('/profile', function () {
            return redirect()->route('dashboard');
        })->name('profile.destroy');
    }
});