<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\WisataDesa;
use App\Models\Bumdes;
use App\Models\WifiDesa;
use App\Models\PasarDesa;
use App\Models\Kkdmp;
use App\Models\Dusun;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Bypass auth di environment local
     */
    public function __construct()
    {
        if (app()->environment('local')) {
            // Auto login jika belum login
            if (!auth()->check()) {
                $user = \App\Models\User::first();
                if (!$user) {
                    $user = \App\Models\User::create([
                        'name' => 'Administrator',
                        'email' => 'admin@desadigital.test',
                        'password' => bcrypt('password123'),
                    ]);
                }
                auth()->login($user);
            }
        }
    }

    public function index()
    {
        $totalKecamatan = Kecamatan::count();
        $totalDesa = Desa::count();
        $totalDusun = Dusun::count();
        $totalWisata = WisataDesa::count();
        $totalPasar = PasarDesa::count();
        $totalWifi = WifiDesa::count();
        $totalBumdes = Bumdes::count();
        $totalKkdmp = Kkdmp::count();

        return view('admin.dashboard', compact(
            'totalKecamatan',
            'totalDesa',
            'totalDusun',
            'totalWisata',
            'totalPasar',
            'totalWifi',
            'totalBumdes',
            'totalKkdmp'
        ));
    }
}