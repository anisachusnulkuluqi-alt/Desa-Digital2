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
        $totalWisata = $this->safeCount('wisata_desa');
        $totalPasar = $this->safeCount('pasar_desa');
        $totalKantorDesa = $this->safeCount('kantor_desa');
        $totalWifiDesa = $this->safeCount('wifi_desa');
        $totalBumdes = $this->safeCount('bumdes');
        $totalKkdmp = $this->safeCount('kkdmp');

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