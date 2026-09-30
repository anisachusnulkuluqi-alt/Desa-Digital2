<?php

namespace App\Services;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardStatistics
{
    public function counts(): array
    {
        $totalDesa = Desa::count();
        $totalWebsite = Schema::hasColumn('desa', 'website')
            ? Desa::whereNotNull('website')->where('website', '<>', '')->count()
            : $totalDesa;

        return [
            'totalDesa' => $totalDesa,
            'totalWebsite' => $totalWebsite,
            'totalKecamatan' => Kecamatan::count(),
            'totalWisata' => $this->safeCount('lokasi_wisata'),
            'totalPasar' => $this->safeCount('lokasi_pasar'),
            'totalKantorDesa' => $this->safeCount('lokasi_kantor'),
            'totalWifiDesa' => $this->safeCount('lokasi_wifi'),
            'totalBumdes' => $this->safeCount('lokasi_bumdes'),
            'totalKkdmp' => $this->safeCount('lokasi_kkdmp'),
        ];
    }

    private function safeCount(string $tableName): int
    {
        try {
            return Schema::hasTable($tableName)
                ? DB::table($tableName)->count()
                : 0;
        } catch (\Exception $exception) {
            return 0;
        }
    }
}