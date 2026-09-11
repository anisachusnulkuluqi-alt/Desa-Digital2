<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| IMPORT CONTROLLERS
|--------------------------------------------------------------------------
*/

// Frontend Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KecamatanController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Publik - Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Layanan
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');

// Berita & Acara (Publik)
Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

// Kecamatan (Publik)
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/{slug}', [KecamatanController::class, 'show'])->name('kecamatan.show');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login, Register, Lupa Password)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| PROFILE ROUTES (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| BACKEND ADMIN ROUTES (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Admin (URL: /dashboard)
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Admin Panel dengan prefix '/admin'
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin (URL: /admin)
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // CRUD Berita
        Route::resource('berita', AdminBeritaController::class);
        
        // CRUD Desa
        Route::resource('desa', AdminDesaController::class);
        
        // CRUD Kecamatan
        Route::resource('kecamatan', AdminKecamatanController::class);
        
        // ==========================================
        // PLACEHOLDER UNTUK FITUR MASA DEPAN
        // (Hapus tanda komentar // saat controllernya sudah dibuat)
        // ==========================================
        // Route::resource('dusun', AdminDusunController::class);
        // Route::resource('wisata', AdminWisataController::class);
        // Route::resource('pasar', AdminPasarController::class);
        // Route::resource('wifi', AdminWifiController::class);
        // Route::resource('bumdes', AdminBumdesController::class);
        // Route::resource('kkdmp', AdminKkdmpController::class);
        // Route::resource('kantor', AdminKantorController::class);
        
    });
});