<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $totalDesa = Desa::count();
        $totalKecamatan = Kecamatan::count();
        $totalWisata = $this->safeCount('lokasi_wisata');
        $totalPasar = $this->safeCount('lokasi_pasar');
        $totalKantorDesa = $this->safeCount('lokasi_kantor');
        $totalWifiDesa = $this->safeCount('lokasi_wifi');
        $totalBumdes = $this->safeCount('lokasi_bumdes');
        $totalKkdmp = $this->safeCount('lokasi_kkdmp');

        return view('admin.dashboard', compact(
            'totalDesa',
            'totalKecamatan',
            'totalWisata',
            'totalPasar',
            'totalKantorDesa',
            'totalWifiDesa',
            'totalBumdes',
            'totalKkdmp'
        ));
    }

    private function safeCount($tableName)
    {
        try {
            if (Schema::hasTable($tableName)) {
                return DB::table($tableName)->count();
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
}