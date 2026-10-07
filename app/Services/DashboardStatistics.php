<?php

namespace App\Services;

use App\Models\Desa;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Tempat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DashboardStatistics
{
    public function placeCategoryCounts(): array
    {
        $countsByCategory = Tempat::query()
            ->selectRaw('LOWER(TRIM(kategori)) AS kategori_key, COUNT(*) AS records_count')
            ->whereNotNull('kategori')
            ->whereRaw("TRIM(kategori) <> ''")
            ->groupByRaw('LOWER(TRIM(kategori))')
            ->pluck('records_count', 'kategori_key');

        $categories = Kategori::query()
            ->orderBy('nama')
            ->get(['id', 'nama'])
            ->map(fn (Kategori $kategori): array => [
                'name' => $kategori->nama,
                'count' => (int) $countsByCategory->get(strtolower(trim($kategori->nama)), 0),
            ])
            ->all();

        if ($categories !== []) {
            return $categories;
        }

        $statistics = $this->counts();

        return [
            ['name' => 'wifi', 'label' => 'Titik WiFi', 'count' => $statistics['totalWifiDesa']],
            ['name' => 'website_desa', 'label' => 'Website Desa', 'count' => $statistics['totalWebsite']],
            ['name' => 'wisata', 'label' => 'Wisata Desa', 'count' => $statistics['totalWisata']],
            ['name' => 'balai_desa', 'label' => 'Balai Desa', 'count' => $statistics['totalKantorDesa']],
            ['name' => 'pasar', 'label' => 'Pasar Rakyat', 'count' => $statistics['totalPasar']],
            ['name' => 'bumdes', 'label' => 'Unit BUMDes', 'count' => $statistics['totalBumdes']],
            ['name' => 'kkdmp', 'label' => 'Dokumen KKDMP', 'count' => $statistics['totalKkdmp']],
            ['name' => 'kecamatan', 'label' => 'Kecamatan', 'count' => $statistics['totalKecamatan']],
        ];
    }

    public function counts(): array
    {
        $totalDesa = Desa::count();
        $totalWebsite = Schema::hasColumn('desa', 'website')
            ? Desa::whereNotNull('website')->where('website', '<>', '')->count()
            : $totalDesa;

        return array_merge([
            'totalDesa' => $totalDesa,
            'totalWebsite' => $totalWebsite,
            'totalKecamatan' => Kecamatan::count(),
            'totalWisata' => $this->safeCount('lokasi_wisata'),
            'totalPasar' => $this->safeCount('lokasi_pasar'),
            'totalKantorDesa' => $this->safeCount('lokasi_kantor'),
            'totalWifiDesa' => $this->safeCount('lokasi_wifi'),
            'totalBumdes' => $this->safeCount('lokasi_bumdes'),
            'totalKkdmp' => $this->safeCount('lokasi_kkdmp'),
        ], $this->visitorCounts());
    }

    public function visitorCounts(): array
    {
        return [
            'totalKunjungan' => Schema::hasTable('website_visits')
                ? DB::table('website_visits')->count()
                : 0,
            'kunjunganHariIni' => Schema::hasTable('website_visits')
                ? DB::table('website_visits')->whereDate('visited_on', now()->toDateString())->count()
                : 0,
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
