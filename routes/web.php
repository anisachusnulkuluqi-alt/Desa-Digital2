<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\DesaController;
use App\Http\Controllers\DusunController;
use App\Http\Controllers\WisataDesaController;
use App\Http\Controllers\PasarDesaController;
use App\Http\Controllers\WifiDesaController;
use App\Http\Controllers\BumdesController;
use App\Http\Controllers\KkdmpController;
use Illuminate\Support\Facades\Route;

// Landing Page (tidak perlu login)
Route::get('/', function () {
    return view('landing');
})->name('home');

// Authentication routes (dari Laravel Breeze)
require __DIR__.'/auth.php';

// Dashboard & CRUD (HARUS LOGIN)
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // CRUD Kecamatan
    Route::resource('kecamatan', KecamatanController::class);
    
    // CRUD Desa
    Route::resource('desa', DesaController::class);
    
    // CRUD Dusun
    Route::resource('dusun', DusunController::class);
    
    // CRUD Wisata Desa
    Route::resource('wisata', WisataDesaController::class);
    
    // CRUD Pasar Desa
    Route::resource('pasar', PasarDesaController::class);
    
    // CRUD WiFi Desa
    Route::resource('wifi', WifiDesaController::class);
    
    // CRUD BUMDes
    Route::resource('bumdes', BumdesController::class);
    
    // CRUD KKDMP
    Route::resource('kkdmp', KkdmpController::class);
});