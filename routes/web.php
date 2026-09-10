<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// 1. IMPORT CONTROLLER FRONTEND (PUBLIK)
// ==========================================
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KecamatanController;

// ==========================================
// 2. IMPORT CONTROLLER BACKEND (ADMIN)
// ==========================================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES (Tampilan untuk Masyarakat Umum)
|--------------------------------------------------------------------------
*/

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');

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
| BACKEND ADMIN ROUTES (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Admin (dengan nama route 'admin.dashboard')
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Dashboard biasa (untuk backward compatibility)
    Route::get('/dashboard', function() {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
    
    // Group dengan prefix '/admin' dan nama route 'admin.'
    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Admin (alias)
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // CRUD Berita
        Route::resource('berita', AdminBeritaController::class);
        
        // CRUD Desa
        Route::resource('desa', AdminDesaController::class);
        
        // CRUD Kecamatan
        Route::resource('kecamatan', AdminKecamatanController::class);
        
    });
});