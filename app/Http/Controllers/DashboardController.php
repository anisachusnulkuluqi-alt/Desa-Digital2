<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\WisataDesa;
use App\Models\PasarDesa;
use App\Models\WifiDesa;
use App\Models\Bumdes;
use App\Models\Kkdmp;
use App\Models\Dusun;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total data untuk statistik dashboard
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();
        $totalDusun = Dusun::count();
        $totalWisata = WisataDesa::count();
        $totalPasar = PasarDesa::count();
        $totalWifi = WifiDesa::count();
        $totalBumdes = Bumdes::count();
        $totalKkdmp = Kkdmp::count();

        // Ambil data terbaru untuk ditampilkan di dashboard
        $desaTerbaru = Desa::with('kecamatan')->latest()->take(6)->get();
        $wisataTerbaru = WisataDesa::with('desa')->latest()->take(6)->get();

        return view('dashboard', compact(
            'totalKecamatan',
            'totalDesa',
            'totalDusun',
            'totalWisata',
            'totalPasar',
            'totalWifi',
            'totalBumdes',
            'totalKkdmp',
            'desaTerbaru',
            'wisataTerbaru'
        ));
    }
}