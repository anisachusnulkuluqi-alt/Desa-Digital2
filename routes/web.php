<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROUTES PORTAL DESA DIGITAL KABUPATEN TUBAN
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

// Alias route webgis (agar tautan lama tetap aman jika diklik)
Route::get('/webgis', function () {
    return redirect()->route('data.spasial');
});

// 3. Katalog Desa / Direktori Data Desa
Route::get('/desa', function () {
    // Jika belum ada file desa.blade.php khusus, sementara diarahkan ke landing page seksi layanan
    if (view()->exists('desa')) {
        return view('desa');
    }
    return redirect('/#layanan-unggulan');
})->name('desa.index');

// 4. Autentikasi & Akun Petugas
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// 5. Halaman Informasi Publik
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