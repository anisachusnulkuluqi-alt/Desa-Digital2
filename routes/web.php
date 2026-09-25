<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesaController as AdminDesaController;
use App\Http\Controllers\Admin\KecamatanController as AdminKecamatanController;
use App\Http\Controllers\Admin\WisataController as AdminWisataController;
use App\Http\Controllers\Admin\PasarController;

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

/* --- MODUL SURAT DESA --- */
Route::get('/surat', function () {
    if (view()->exists('surat')) return view('surat');
    return view('surat-desa');
})->name('surat.index');

Route::post('/surat/kirim', function (Request $request) {
    $validated = $request->validate([
        'nik'           => 'required|digits:16',
        'nama_lengkap'  => 'required|string|max:150',
        'no_wa'         => 'required|string|max:20',
        'kecamatan'     => 'required|string',
        'desa'          => 'required|string',
        'jenis_surat'   => 'required|string',
        'keperluan'     => 'required|string',
        'berkas_syarat' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:3072',
    ]);

    $nomorResi = 'SRT-' . date('Ymd') . '-' . strtoupper(Str::random(4));

    if (class_exists(\App\Models\SuratPermohonan::class)) {
        $path = $request->hasFile('berkas_syarat') 
            ? $request->file('berkas_syarat')->store('berkas_surat', 'public') 
            : null;

        \App\Models\SuratPermohonan::create(array_merge($validated, [
            'nomor_resi'    => $nomorResi,
            'berkas_syarat' => $path,
            'status'        => 'Menunggu',
        ]));
    }

    return back()->with('success', "Permohonan berhasil dikirim! Simpan Nomor Resi Anda: {$nomorResi}");
})->name('surat.kirim');

Route::get('/surat/lacak', function (Request $request) {
    $resi = $request->query('resi');
    $data = null;

    if (class_exists(\App\Models\SuratPermohonan::class)) {
        $data = \App\Models\SuratPermohonan::where('nomor_resi', $resi)->first();
    }

    return response()->json([
        'found' => (bool)$data,
        'data'  => $data
    ]);
})->name('surat.lacak');


/* --- MODUL CCTV --- */
Route::get('/cctv', function () {
    $cctvList = [];
    if (class_exists(\App\Models\Cctv::class)) {
        $cctvList = \App\Models\Cctv::all();
    }
    
    if (view()->exists('cctv')) return view('cctv', compact('cctvList'));
    return view('monitoring-cctv', compact('cctvList'));
})->name('cctv.index');


/* --- MODUL e-PBB --- */
Route::get('/epbb', function () {
    if (view()->exists('epbb')) return view('epbb');
    return view('e-pbb');
})->name('epbb.index');

Route::post('/epbb/kirim', function (Request $request) {
    $validated = $request->validate([
        'nama_pemohon'       => 'required|string|max:150',
        'nik_pemohon'        => 'required|digits:16',
        'no_telp'            => 'required|string|max:20',
        'kecamatan_op'       => 'required|string',
        'desa_op'            => 'required|string',
        'jenis_pelayanan'    => 'required|string',
        'alamat_objek_pajak' => 'required|string',
        'nop'                => 'nullable|string|max:25',
        'lampiran_berkas'    => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
    ]);

    $nomorTiket = 'PBB-' . date('Ymd') . '-' . strtoupper(Str::random(4));

    if (class_exists(\App\Models\EpbbPermohonan::class)) {
        $path = $request->hasFile('lampiran_berkas') 
            ? $request->file('lampiran_berkas')->store('berkas_pbb', 'public') 
            : null;

        \App\Models\EpbbPermohonan::create(array_merge($validated, [
            'nomor_tiket'     => $nomorTiket,
            'lampiran_berkas' => $path,
            'status'          => 'Verifikasi Berkas',
        ]));
    }

    return back()->with('success', "Permohonan e-PBB terkirim! Simpan Nomor Tiket Anda: {$nomorTiket}");
})->name('epbb.kirim');


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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/kominfo/dashboard', [DashboardController::class, 'index'])->name('admin.kominfo.dashboard');
    Route::get('/admin/kecamatan/dashboard', [DashboardController::class, 'index'])->name('admin.kecamatan.dashboard');
    Route::get('/admin/desa/dashboard', [DashboardController::class, 'index'])->name('admin.desa.dashboard');

    // ==========================================
    // SEMUA ROUTE ADMIN DI DALAM PREFIX INI
    // ==========================================
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
        
        // ========================================
        // ✅ WISATA DESA (DIPERBAIKI: name tanpa 'admin.' karena sudah ada prefix 'admin.')
        // ========================================
        Route::get('/wisata', [AdminWisataController::class, 'index'])->name('wisata.index');
        Route::post('/wisata', [AdminWisataController::class, 'store'])->name('wisata.store');
        Route::put('/wisata/{wisata}', [AdminWisataController::class, 'update'])->name('wisata.update');
        Route::delete('/wisata/{wisata}', [AdminWisataController::class, 'destroy'])->name('wisata.destroy');
        
        // ==========================================
        // LAYANAN & MODUL INTERNAL
        // ==========================================
        
        // ✅ PASAR DESA
        Route::resource('pasar', PasarController::class);

        // Kantor Desa
        Route::get('/kantor-desa', [App\Http\Controllers\Admin\KantorDesaController::class, 'index'])->name('kantor.index');
        Route::post('/kantor-desa', [App\Http\Controllers\Admin\KantorDesaController::class, 'store'])->name('kantor.store');
        Route::put('/kantor-desa/{kantor}', [App\Http\Controllers\Admin\KantorDesaController::class, 'update'])->name('kantor.update');
        Route::delete('/kantor-desa/{kantor}', [App\Http\Controllers\Admin\KantorDesaController::class, 'destroy'])->name('kantor.destroy');

        // WiFi Desa
        Route::get('/wifi', [App\Http\Controllers\Admin\WifiController::class, 'index'])->name('wifi.index');
        Route::post('/wifi', [App\Http\Controllers\Admin\WifiController::class, 'store'])->name('wifi.store');
        Route::put('/wifi/{wifi}', [App\Http\Controllers\Admin\WifiController::class, 'update'])->name('wifi.update');
        Route::delete('/wifi/{wifi}', [App\Http\Controllers\Admin\WifiController::class, 'destroy'])->name('wifi.destroy');

        // BUMDes
        Route::get('/bumdes', [App\Http\Controllers\Admin\BumdesController::class, 'index'])->name('bumdes.index');
        Route::post('/bumdes', [App\Http\Controllers\Admin\BumdesController::class, 'store'])->name('bumdes.store');
        Route::put('/bumdes/{bumdes}', [App\Http\Controllers\Admin\BumdesController::class, 'update'])->name('bumdes.update');
        Route::delete('/bumdes/{bumdes}', [App\Http\Controllers\Admin\BumdesController::class, 'destroy'])->name('bumdes.destroy');

        // KKDMP
        Route::get('/kkdmp', [App\Http\Controllers\Admin\KkdmpController::class, 'index'])->name('kkdmp.index');
        Route::post('/kkdmp', [App\Http\Controllers\Admin\KkdmpController::class, 'store'])->name('kkdmp.store');
        Route::put('/kkdmp/{kkdmp}', [App\Http\Controllers\Admin\KkdmpController::class, 'update'])->name('kkdmp.update');
        Route::delete('/kkdmp/{kkdmp}', [App\Http\Controllers\Admin\KkdmpController::class, 'destroy'])->name('kkdmp.destroy');

        // Settings
        Route::get('/settings', function () { 
            return view('admin.settings.index'); 
        })->name('settings.index');

        // Surat (Admin)
        Route::get('/surat', function () { 
            return view('admin.surat.index'); 
        })->name('surat.index');

        // CCTV (Admin)
        Route::get('/cctv', function () { 
            return view('admin.cctv.index'); 
        })->name('cctv.index');

        // e-PBB (Admin)
        Route::get('/e-pbb', function () { 
            return view('admin.epbb.index'); 
        })->name('e-pbb.index');

    }); // ← AKHIRI prefix('admin') DI SINI

    // Profile
    if (class_exists(ProfileController::class)) {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/show', [ProfileController::class, 'edit'])->name('profile.show');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    } else {
        Route::get('/profile', function () { return redirect()->route('dashboard'); })->name('profile.edit');
        Route::get('/profile/show', function () { return redirect()->route('dashboard'); })->name('profile.show');
        Route::patch('/profile', function () { return redirect()->route('dashboard'); })->name('profile.update');
        Route::delete('/profile', function () { return redirect()->route('dashboard'); })->name('profile.destroy');
    }
});