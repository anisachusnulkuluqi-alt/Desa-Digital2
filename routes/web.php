<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\WisataController as AdminWisataController;

/*
|--------------------------------------------------------------------------
| 1. ROUTES PORTAL PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/data-spasial', function () {
    return view('data-spasial');
})->name('data.spasial');

Route::get('/webgis', function () {
    return redirect()->route('data.spasial');
})->name('webgis');

Route::get('/desa-publik', function () {
    if (view()->exists('desa-publik')) {
        return view('desa-publik');
    }
    return redirect('/#layanan-unggulan');
})->name('desa.publik');

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


/*
|--------------------------------------------------------------------------
| 2. ROUTES SISTEM AUTENTIKASI (LARAVEL BREEZE/JETSTREAM)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3. ROUTES BACKEND ADMIN (MEMERLUKAN LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama (Default)
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Dashboard Spesifik Peran
    Route::get('/admin/kominfo/dashboard', [DashboardController::class, 'index'])->name('admin.kominfo.dashboard');
    Route::get('/admin/kecamatan/dashboard', [DashboardController::class, 'index'])->name('admin.kecamatan.dashboard');
    Route::get('/admin/desa/dashboard', [DashboardController::class, 'index'])->name('admin.desa.dashboard');

    // Group Route Admin dengan Prefix 'admin' dan Name 'admin.'
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // ==========================================
        // A. RESOURCE CRUD (Controller Lengkap)
        // ==========================================
        
        // 1. Kecamatan
        Route::resource('kecamatan', AdminKecamatanController::class);
        Route::post('kecamatan/import', [AdminKecamatanController::class, 'import'])->name('kecamatan.import');
        Route::get('kecamatan/download-template', [AdminKecamatanController::class, 'downloadTemplate'])->name('kecamatan.download-template');
        
        // 2. Desa
        Route::resource('desa', AdminDesaController::class);
        // ✅ DIPERBAIKI: Name hanya 'desa.import' (bukan 'admin.desa.import')
        // Karena sudah di dalam group 'admin.', jadi nama lengkapnya otomatis 'admin.desa.import'
        Route::post('desa/import', [AdminDesaController::class, 'import'])->name('desa.import');
        Route::get('desa/download-template', [AdminDesaController::class, 'downloadTemplate'])->name('desa.download-template');
        
        // 3. Wisata
        Route::resource('wisata', AdminWisataController::class)->parameters([
            'wisata' => 'wisata'
        ]);

        // ==========================================
        // B. ROUTE PLACEHOLDER (Modul Belum Ada Controller)
        // ==========================================
        Route::get('/kantor-desa', function () { return view('admin.dashboard'); })->name('kantor.index');
        Route::get('/pasar', function () { return view('admin.dashboard'); })->name('pasar.index');
        Route::get('/wifi', function () { return view('admin.dashboard'); })->name('wifi.index');
        Route::get('/bumdes', function () { return view('admin.dashboard'); })->name('bumdes.index');
        Route::get('/kkdmp', function () { return view('admin.dashboard'); })->name('kkdmp.index');
        Route::get('/settings', function () { return view('admin.settings.index'); })->name('settings.index');
    });

    // ==========================================
    // C. ROUTE PROFILE PENGGUNA
    // ==========================================
    if (class_exists(ProfileController::class)) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    } else {
        Route::get('/profile', function () { return redirect()->route('dashboard'); })->name('profile.edit');
        Route::patch('/profile', function () { return redirect()->route('dashboard'); })->name('profile.update');
        Route::delete('/profile', function () { return redirect()->route('dashboard'); })->name('profile.destroy');
    }
});