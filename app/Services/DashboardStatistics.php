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

        $masterCategories = Kategori::query()
            ->orderBy('nama')
            ->get(['id', 'nama']);

        $statistics = $this->counts();
        $baseCategories = [
            ['name' => 'wifi', 'label' => 'Titik WiFi', 'count' => $statistics['totalWifiDesa'], 'is_core' => true, 'aliases' => ['wifi', 'titik wifi', 'wifi desa']],
            ['name' => 'website_desa', 'label' => 'Website Desa', 'count' => $statistics['totalWebsite'], 'is_core' => true, 'aliases' => ['website', 'website desa']],
            ['name' => 'wisata', 'label' => 'Wisata Desa', 'count' => $statistics['totalWisata'], 'is_core' => true, 'aliases' => ['wisata', 'wisata desa']],
            ['name' => 'balai_desa', 'label' => 'Balai Desa', 'count' => $statistics['totalKantorDesa'], 'is_core' => true, 'aliases' => ['balai desa', 'kantor desa', 'kantor']],
            ['name' => 'pasar', 'label' => 'Pasar Rakyat', 'count' => $statistics['totalPasar'], 'is_core' => true, 'aliases' => ['pasar', 'pasar rakyat', 'pasar desa']],
            ['name' => 'bumdes', 'label' => 'Unit BUMDes', 'count' => $statistics['totalBumdes'], 'is_core' => true, 'aliases' => ['bumdes', 'unit bumdes']],
            ['name' => 'kkdmp', 'label' => 'Dokumen KKDMP', 'count' => $statistics['totalKkdmp'], 'is_core' => true, 'aliases' => ['kkdmp', 'dokumen kkdmp']],
            ['name' => 'kecamatan', 'label' => 'Kecamatan', 'count' => $statistics['totalKecamatan'], 'is_core' => true, 'aliases' => ['kecamatan']],
        ];

        $baseAliases = [];
        foreach ($baseCategories as &$baseCategory) {
            foreach ($baseCategory['aliases'] as $alias) {
                $baseAliases[$alias] = true;
            }

            $masterCategory = $masterCategories->first(
                fn (Kategori $kategori): bool => in_array(
                    $this->normalizeCategoryName($kategori->nama),
                    $baseCategory['aliases'],
                    true
                )
            );

            if ($masterCategory) {
                $baseCategory['count'] = (int) $countsByCategory->get(
                    strtolower(trim($masterCategory->nama)),
                    0
                );
            }

            unset($baseCategory['aliases']);
        }
        unset($baseCategory);

        $additionalCategories = $masterCategories
            ->reject(fn (Kategori $kategori): bool => isset($baseAliases[$this->normalizeCategoryName($kategori->nama)]))
            ->map(fn (Kategori $kategori): array => [
                'name' => $kategori->nama,
                'label' => ucwords(str_replace(['_', '-'], ' ', $kategori->nama)),
                'count' => (int) $countsByCategory->get(strtolower(trim($kategori->nama)), 0),
                'is_core' => false,
            ])
            ->all();

        return array_merge($baseCategories, $additionalCategories);
    }

    private function normalizeCategoryName(string $name): string
    {
        return preg_replace('/[\s_-]+/', ' ', strtolower(trim($name))) ?? strtolower(trim($name));
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
        ], $this->visitorCounts(), $this->surveyCounts());
    }

    public function surveyCounts(): array
    {
        if (!Schema::hasTable('website_feedback')) {
            return [
                'totalSurvei' => 0,
                'avgRatingSurvei' => 0,
                'persentaseKepuasan' => 0,
                'surveiHariIni' => 0,
            ];
        }

        try {
            $totalSurvei = DB::table('website_feedback')->count();
            $avgRating = $totalSurvei > 0
                ? round((float) DB::table('website_feedback')->avg('rating'), 1)
                : 0;
            $puasCount = DB::table('website_feedback')->whereIn('rating', [4, 5])->count();
            $persentaseKepuasan = $totalSurvei > 0
                ? round(($puasCount / $totalSurvei) * 100)
                : 0;
            $surveiHariIni = DB::table('website_feedback')
                ->whereDate('created_at', now()->toDateString())
                ->count();

            return [
                'totalSurvei' => $totalSurvei,
                'avgRatingSurvei' => $avgRating,
                'persentaseKepuasan' => $persentaseKepuasan,
                'surveiHariIni' => $surveiHariIni,
            ];
        } catch (\Exception $exception) {
            return [
                'totalSurvei' => 0,
                'avgRatingSurvei' => 0,
                'persentaseKepuasan' => 0,
                'surveiHariIni' => 0,
            ];
        }
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
