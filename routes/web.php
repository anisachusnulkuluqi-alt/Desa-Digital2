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

Route::get('/website', function () {
    return view('website');
})->name('website');

Route::get('/surat', function () {
    if (view()->exists('surat')) return view('surat');
    return view('surat-desa');
})->name('surat');

Route::get('/cctv', function () {
    if (view()->exists('cctv')) return view('cctv');
    return view('monitoring-cctv');
})->name('cctv');

Route::get('/epbb', function () {
    if (view()->exists('epbb')) return view('epbb');
    return view('e-pbb');
})->name('epbb');


/*
|--------------------------------------------------------------------------
| 2. ROUTES SISTEM AUTENTIKASI
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| 3. ROUTES BACKEND ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/admin/kominfo/dashboard', [DashboardController::class, 'index'])->name('admin.kominfo.dashboard');
    Route::get('/admin/kecamatan/dashboard', [DashboardController::class, 'index'])->name('admin.kecamatan.dashboard');
    Route::get('/admin/desa/dashboard', [DashboardController::class, 'index'])->name('admin.desa.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        
        // Kecamatan
        Route::resource('kecamatan', AdminKecamatanController::class);
        Route::post('kecamatan/import', [AdminKecamatanController::class, 'import'])->name('kecamatan.import');
        Route::get('kecamatan/download-template', [AdminKecamatanController::class, 'downloadTemplate'])->name('kecamatan.download-template');
        
        // Desa
        Route::resource('desa', AdminDesaController::class);
        Route::get('desa/{desa}/detail', [AdminDesaController::class, 'showDetail'])->name('desa.detail');
        Route::post('desa/import', [AdminDesaController::class, 'import'])->name('desa.import');
        Route::get('desa/download-template', [AdminDesaController::class, 'downloadTemplate'])->name('desa.download-template');
        
        // Wisata
        Route::resource('wisata', AdminWisataController::class)->parameters([
            'wisata' => 'wisata'
        ]);

        // Placeholder
        Route::get('/kantor-desa', function () { return view('admin.dashboard'); })->name('kantor.index');
        Route::get('/pasar', function () { return view('admin.dashboard'); })->name('pasar.index');
        Route::get('/wifi', function () { return view('admin.dashboard'); })->name('wifi.index');
        Route::get('/bumdes', function () { return view('admin.dashboard'); })->name('bumdes.index');
        Route::get('/kkdmp', function () { return view('admin.dashboard'); })->name('kkdmp.index');
        Route::get('/settings', function () { return view('admin.settings.index'); })->name('settings.index');
        Route::get('/surat', function () { return view('admin.dashboard'); })->name('surat.index');
        Route::get('/cctv', function () { return view('admin.dashboard'); })->name('cctv.index');
        Route::get('/e-pbb', function () { return view('admin.dashboard'); })->name('e-pbb.index');
    });

    // Profile
    if (class_exists(ProfileController::class)) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/show', [ProfileController::class, 'edit'])->name('profile.show'); // ✅ DIPERBAIKI: Menambahkan route show
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    } else {
        Route::get('/profile', function () { return redirect()->route('dashboard'); })->name('profile.edit');
        Route::get('/profile/show', function () { return redirect()->route('dashboard'); })->name('profile.show'); // ✅ DIPERBAIKI: Fallback route show
        Route::patch('/profile', function () { return redirect()->route('dashboard'); })->name('profile.update');
        Route::delete('/profile', function () { return redirect()->route('dashboard'); })->name('profile.destroy');
    }
});