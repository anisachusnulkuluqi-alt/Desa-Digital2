<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;

/*
|--------------------------------------------------------------------------
| ROUTES PORTAL PUBLIK DESA DIGITAL KABUPATEN TUBAN
|--------------------------------------------------------------------------
*/

// 1. Beranda Utama (Landing Page)
Route::get('/', function () {
    return view('landing');
})->name('home');

// 2. Modul Data Spasial Terpadu (Peta GIS Ekosistem Desa)
Route::get('/data-spasial', function () {
    return view('data-spasial');
})->name('data.spasial');

// Alias route webgis
Route::get('/webgis', function () {
    return redirect()->route('data.spasial');
});

// 3. Katalog Desa Publik
Route::get('/desa', function () {
    if (view()->exists('desa')) {
        return view('desa');
    }
    return redirect('/#layanan-unggulan');
})->name('desa.index');

// 4. Halaman Informasi Publik
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
| ROUTES BACKEND ADMIN & USER TERAUTENTIKASI (MEMERLUKAN LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Gerbang Pengalihan Dashboard Sesuai Role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'kominfo') {
            return redirect()->route('admin.kominfo.dashboard');
        } elseif ($user->role === 'kecamatan') {
            return redirect()->route('admin.kecamatan.dashboard');
        } else {
            return redirect()->route('admin.desa.dashboard');
        }
    })->name('dashboard');

    // Dashboard 3 Tingkat Admin
    Route::get('/admin/kominfo/dashboard', [DashboardController::class, 'index'])
        ->name('admin.kominfo.dashboard');

    Route::get('/admin/kecamatan/dashboard', [DashboardController::class, 'index'])
        ->name('admin.kecamatan.dashboard');

    Route::get('/admin/desa/dashboard', [DashboardController::class, 'index'])
        ->name('admin.desa.dashboard');

    // CRUD Resource Backend (Desa & Kecamatan)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('desa', AdminDesaController::class);
        Route::resource('kecamatan', AdminKecamatanController::class);
    });

    // Route Profile (Mengatasi Error: Route [profile.edit] not defined)
    if (class_exists(ProfileController::class)) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    } else {
        Route::get('/profile', function () {
            if (view()->exists('profile.edit')) {
                return view('profile.edit', ['user' => auth()->user()]);
            }
            return redirect()->route('dashboard');
        })->name('profile.edit');
    }
});


/*
|--------------------------------------------------------------------------
| ROUTES SISTEM AUTENTIKASI (LARAVEL BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';