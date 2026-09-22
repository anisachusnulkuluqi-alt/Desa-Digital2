<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\WisataController as AdminWisataController;
use App\Http\Controllers\ProfileController; // Pastikan ini ada

/*
|--------------------------------------------------------------------------
| 1. ROUTES PORTAL PUBLIK (TANPA LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('landing'); })->name('home');
Route::get('/data-spasial', function () { return view('data-spasial'); })->name('data.spasial');
Route::get('/webgis', function () { return redirect()->route('data.spasial'); })->name('webgis');
Route::get('/desa-publik', function () { return view()->exists('desa-publik') ? view('desa-publik') : redirect('/#layanan-unggulan'); })->name('desa.publik');
Route::get('/tentang', function () { return view()->exists('tentang') ? view('tentang') : redirect('/#tentang-kami'); })->name('tentang');
Route::get('/kontak', function () { return view()->exists('kontak') ? view('kontak') : redirect('/#hubungi-kami'); })->name('kontak');

Route::get('/website', function () { return view('website'); })->name('website');
Route::get('/surat-desa', function () { return view('surat-desa'); })->name('surat-desa');
Route::get('/cctv', function () { return view('cctv'); })->name('cctv');
Route::get('/e-pbb', function () { return view('e-pbb'); })->name('e-pbb');


/*
|--------------------------------------------------------------------------
| 2. ROUTES SISTEM AUTENTIKASI (LOGIN, REGISTER, LOGOUT - DARI BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3. ROUTES BACKEND ADMIN (MEMERLUKAN LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Dashboard Spesifik Peran
    Route::get('/admin/kominfo/dashboard', [DashboardController::class, 'index'])->name('admin.kominfo.dashboard');
    Route::get('/admin/kecamatan/dashboard', [DashboardController::class, 'index'])->name('admin.kecamatan.dashboard');
    Route::get('/admin/desa/dashboard', [DashboardController::class, 'index'])->name('admin.desa.dashboard');

    // Group Route Admin dengan Prefix 'admin'
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // A. RESOURCE CRUD
        Route::resource('kecamatan', AdminKecamatanController::class);
        Route::post('kecamatan/import', [AdminKecamatanController::class, 'import'])->name('kecamatan.import');
        Route::get('kecamatan/download-template', [AdminKecamatanController::class, 'downloadTemplate'])->name('kecamatan.download-template');
        
        Route::resource('desa', AdminDesaController::class);
        Route::post('desa/import', [AdminDesaController::class, 'import'])->name('desa.import');
        Route::get('desa/download-template', [AdminDesaController::class, 'downloadTemplate'])->name('desa.download-template');
        
        Route::resource('wisata', AdminWisataController::class)->parameters(['wisata' => 'wisata']);

        // B. ROUTE PLACEHOLDER
        Route::get('/kantor-desa', function () { return view('admin.dashboard'); })->name('kantor.index');
        Route::get('/pasar', function () { return view('admin.dashboard'); })->name('pasar.index');
        Route::get('/wifi', function () { return view('admin.dashboard'); })->name('wifi.index');
        Route::get('/bumdes', function () { return view('admin.dashboard'); })->name('bumdes.index');
        Route::get('/kkdmp', function () { return view('admin.dashboard'); })->name('kkdmp.index');
        Route::get('/settings', function () { return view('admin.settings.index'); })->name('settings.index');
        
        Route::get('/surat-desa', function () { return view('admin.surat-desa'); })->name('surat-desa.index');
        Route::get('/cctv', function () { return view('admin.cctv'); })->name('cctv.index');
        Route::get('/e-pbb', function () { return view('admin.e-pbb'); })->name('e-pbb.index');
    });

    // ==========================================
    // C. ROUTE PROFILE & LOGOUT (DIPERBAIKI)
    // ==========================================
    
    // 1. Lihat Profil (Halaman tampilan profil)
    Route::get('/profile', function () {
        return view('profile.show', ['user' => auth()->user()]);
    })->name('profile.show');

    // 2. Edit Profil (Bawaan Laravel Breeze)
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CATATAN: Route Logout (POST /logout) sudah otomatis terdaftar 
    // di dalam file require __DIR__.'/auth.php'; jadi tidak perlu ditulis ulang di sini.
});