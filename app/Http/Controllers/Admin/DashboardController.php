<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Wisata; // Pastikan model ini ada
use App\Models\Pasar; // Pastikan model ini ada
use App\Models\KantorDesa; // Pastikan model ini ada
use App\Models\WifiDesa; // Pastikan model ini ada
use App\Models\Bumdes; // Pastikan model ini ada
use App\Models\Kkdmp; // Pastikan model ini ada
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data dari setiap tabel
        $totalDesa = Desa::count();
        $totalKecamatan = Kecamatan::count();
        $totalWisata = \App\Models\Wisata::count();
        $totalPasar = \App\Models\Pasar::count();
        $totalKantorDesa = \App\Models\KantorDesa::count();
        $totalWifiDesa = \App\Models\WifiDesa::count();
        $totalBumdes = \App\Models\Bumdes::count();
        $totalKkdmp = \App\Models\Kkdmp::count();

        // Hitung perubahan (opsional - untuk trend)
        $desaChange = Desa::whereBetween('created_at', [now()->startOfMonth(), now()])->count();
        $kecamatanChange = Kecamatan::whereBetween('created_at', [now()->startOfMonth(), now()])->count();

        return view('admin.dashboard', compact(
            'totalDesa',
            'totalKecamatan',
            'totalWisata',
            'totalPasar',
            'totalKantorDesa',
            'totalWifiDesa',
            'totalBumdes',
            'totalKkdmp',
            'desaChange',
            'kecamatanChange'
        ));
    }
}