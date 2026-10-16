<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Layanan;
use App\Models\SurveiKepuasan;
use App\Models\Tempat;
use App\Models\User;
use App\Models\Wisata;
use App\Services\DashboardStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(DashboardStatistics $statistics)
    {
        $counts = $statistics->counts();
        $recentSurveis = class_exists(SurveiKepuasan::class) && Schema::hasTable('website_feedback')
            ? SurveiKepuasan::whereNull('feedback_removed_at')->latest('created_at')->take(5)->get()
            : collect();

        return view('admin.dashboard', array_merge($counts, [
            'recentSurveis' => $recentSurveis,
        ]));
    }

    /**
     * Search suggestions API for real-time dashboard search dropdown.
     */
    public function searchSuggestions(Request $request)
    {
        $term = trim($request->string('q')->toString());
        if ($term === '') {
            $term = trim($request->string('search')->toString());
        }

        if ($term === '' || mb_strlen($term) > 80) {
            return response()->json([]);
        }

        $grouped = $this->queryAllEntities($term, $request->user(), 4);

        // Keep menus, desa, and kecamatan prioritized for compatibility with existing tests
        $suggestions = collect($grouped['Menu'] ?? [])
            ->concat($grouped['Desa'] ?? [])
            ->concat($grouped['Kecamatan'] ?? [])
            ->concat($grouped['Atribut & Kategori'] ?? [])
            ->concat($grouped['Wisata Desa'] ?? [])
            ->concat($grouped['Pasar Desa'] ?? [])
            ->concat($grouped['Kantor Desa'] ?? [])
            ->concat($grouped['WiFi Desa'] ?? [])
            ->concat($grouped['BUMDes'] ?? [])
            ->concat($grouped['KKDMP'] ?? [])
            ->concat($grouped['Data Spasial'] ?? [])
            ->concat($grouped['Layanan'] ?? [])
            ->concat($grouped['Survei Kepuasan'] ?? [])
            ->concat($grouped['User'] ?? [])
            ->take(15)
            ->values();

        return response()->json($suggestions)
            ->header('Cache-Control', 'no-store, private');
    }

    /**
     * Dedicated admin search results page when submitting the search box.
     */
    public function search(Request $request)
    {
        $searchTerm = trim($request->string('q')->toString());
        if ($searchTerm === '') {
            $searchTerm = trim($request->string('search')->toString());
        }

        if ($searchTerm === '') {
            return redirect()->route('dashboard');
        }

        $groupedResults = $this->queryAllEntities($searchTerm, $request->user(), 20);

        // Filter out empty groups
        $groupedResults = array_filter($groupedResults, fn ($group) => !empty($group));

        $totalResults = array_sum(array_map('count', $groupedResults));

        return view('admin.search', [
            'searchTerm' => $searchTerm,
            'groupedResults' => $groupedResults,
            'totalResults' => $totalResults,
        ]);
    }

    /**
     * Core multi-attribute search across all entities and modules.
     */
    private function queryAllEntities(string $term, ?User $user, int $limitPerType = 5): array
    {
        $results = [];

        // 1. Menu
        $menus = [
            ['title' => 'Beranda', 'type' => 'Menu', 'url' => route('dashboard'), 'icon' => 'bi-house-fill'],
            ['title' => 'Kecamatan', 'type' => 'Menu', 'url' => route('admin.kecamatan.index'), 'icon' => 'bi-geo-alt-fill'],
            ['title' => 'Desa', 'type' => 'Menu', 'url' => route('admin.desa.index'), 'icon' => 'bi-houses-fill'],
            ['title' => 'Wisata Desa', 'type' => 'Menu', 'url' => route('admin.wisata.index'), 'icon' => 'bi-image-fill'],
            ['title' => 'Pasar Desa', 'type' => 'Menu', 'url' => route('admin.pasar.index'), 'icon' => 'bi-shop'],
            ['title' => 'Kantor Desa', 'type' => 'Menu', 'url' => route('admin.kantor.index'), 'icon' => 'bi-building'],
            ['title' => 'WiFi Desa', 'type' => 'Menu', 'url' => route('admin.wifi.index'), 'icon' => 'bi-wifi'],
            ['title' => 'BUMDes', 'type' => 'Menu', 'url' => route('admin.bumdes.index'), 'icon' => 'bi-briefcase-fill'],
            ['title' => 'KKDMP', 'type' => 'Menu', 'url' => route('admin.kkdmp.index'), 'icon' => 'bi-people-fill'],
            ['title' => 'Spasial (Master)', 'type' => 'Menu', 'url' => route('admin.tempat.index'), 'icon' => 'bi-pin-map-fill'],
            ['title' => 'Tempat', 'type' => 'Menu', 'url' => route('admin.tempat.index'), 'icon' => 'bi-pin-map-fill'],
            ['title' => 'Layanan (Master)', 'type' => 'Menu', 'url' => route('admin.layanan.index'), 'icon' => 'bi-grid-fill'],
            ['title' => 'Survei Kepuasan', 'type' => 'Menu', 'url' => route('admin.survei.index'), 'icon' => 'bi-chat-heart-fill'],
            ['title' => 'Pengaturan', 'type' => 'Menu', 'url' => route('admin.settings.index'), 'icon' => 'bi-gear-fill'],
        ];

        if ($user && method_exists($user, 'isAdmin') && $user->isAdmin()) {
            $menus[] = ['title' => 'User', 'type' => 'Menu', 'url' => route('admin.kontributor.index'), 'icon' => 'bi-person-fill'];
            $menus[] = ['title' => 'Kontributor', 'type' => 'Menu', 'url' => route('admin.kontributor.index'), 'icon' => 'bi-person-fill'];
        }

        $results['Menu'] = collect($menus)
            ->filter(fn (array $menu): bool => Str::contains(Str::lower($menu['title']), Str::lower($term)))
            ->take($limitPerType)
            ->values()
            ->all();

        // 2. Desa
        $results['Desa'] = Desa::query()
            ->with('kecamatan')
            ->where(function ($q) use ($term) {
                $q->where('nama_desa', 'like', '%'.$term.'%')
                  ->orWhere('kode_desa', 'like', '%'.$term.'%')
                  ->orWhere('jenis', 'like', '%'.$term.'%')
                  ->orWhere('status', 'like', '%'.$term.'%')
                  ->orWhere('alamat_kantor', 'like', '%'.$term.'%')
                  ->orWhereHas('kecamatan', function ($sub) use ($term) {
                      $sub->where('nama_kecamatan', 'like', '%'.$term.'%');
                  });
            })
            ->orderBy('nama_desa')
            ->limit($limitPerType)
            ->get()
            ->map(fn (Desa $desa): array => [
                'title' => $desa->nama_desa,
                'type' => 'Desa',
                'description' => 'Kec. ' . ($desa->kecamatan?->nama_kecamatan ?? '-') . ($desa->kode_desa ? ' • Kode: ' . $desa->kode_desa : ''),
                'url' => route('admin.desa.index', ['search' => $desa->nama_desa]),
                'icon' => 'bi-houses-fill',
            ])
            ->all();

        // 3. Kecamatan
        $results['Kecamatan'] = Kecamatan::query()
            ->where(function ($q) use ($term) {
                $q->where('nama_kecamatan', 'like', '%'.$term.'%');
                if (Schema::hasColumn('kecamatan', 'kode_kecamatan')) {
                    $q->orWhere('kode_kecamatan', 'like', '%'.$term.'%');
                }
                if (Schema::hasColumn('kecamatan', 'kode_wilayah')) {
                    $q->orWhere('kode_wilayah', 'like', '%'.$term.'%');
                }
            })
            ->orderBy('nama_kecamatan')
            ->limit($limitPerType)
            ->get()
            ->map(fn (Kecamatan $kecamatan): array => [
                'title' => $kecamatan->nama_kecamatan,
                'type' => 'Kecamatan',
                'description' => 'Kode: ' . ($kecamatan->kode_kecamatan ?? $kecamatan->kode_wilayah ?? '-'),
                'url' => route('admin.kecamatan.index', ['search' => $kecamatan->nama_kecamatan]),
                'icon' => 'bi-geo-alt-fill',
            ])
            ->all();

        // 4. Kategori / Atribut Spasial
        $kategoriTabel = Kategori::pluck('nama')->filter();
        $kategoriTempat = Tempat::select('kategori')->distinct()->pluck('kategori')->filter();
        $allKategori = $kategoriTabel->merge($kategoriTempat)->unique()->values();

        $results['Atribut & Kategori'] = $allKategori
            ->filter(fn ($kat) => Str::contains(Str::lower($kat), Str::lower($term)))
            ->take($limitPerType)
            ->map(fn ($kat) => [
                'title' => ucfirst($kat),
                'type' => 'Atribut (Kategori)',
                'description' => 'Kategori spasial ' . ucfirst($kat),
                'url' => route('admin.tempat.kategori.detail', $kat),
                'icon' => 'bi-tags-fill',
            ])
            ->values()
            ->all();

        // 5. Wisata Desa
        if (Schema::hasTable('lokasi_wisata')) {
            $results['Wisata Desa'] = Wisata::query()
                ->where(function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%'.$term.'%')
                      ->orWhere('desa', 'like', '%'.$term.'%')
                      ->orWhere('jenis_wisata', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('deskripsi', 'like', '%'.$term.'%')
                      ->orWhere('jam_operasional', 'like', '%'.$term.'%')
                      ->orWhere('htm', 'like', '%'.$term.'%')
                      ->orWhere('reservasi', 'like', '%'.$term.'%')
                      ->orWhere('properties', 'like', '%'.$term.'%');
                })
                ->orderBy('nama_lokasi')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($wisata) => [
                    'title' => $wisata->nama_lokasi,
                    'type' => 'Wisata Desa',
                    'description' => trim(($wisata->desa ? 'Desa ' . $wisata->desa . ' • ' : '') . ($wisata->jenis_wisata ?: $wisata->alamat ?: 'Objek Wisata')),
                    'url' => route('admin.wisata.index', ['search' => $wisata->nama_lokasi]),
                    'icon' => 'bi-image-fill',
                ])
                ->all();
        }

        // 6. Pasar Desa
        if (Schema::hasTable('lokasi_pasar')) {
            $results['Pasar Desa'] = DB::table('lokasi_pasar')
                ->where(function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('properties', 'like', '%'.$term.'%');
                })
                ->orderBy('nama_lokasi')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($item) => [
                    'title' => $item->nama_lokasi,
                    'type' => 'Pasar Desa',
                    'description' => $item->alamat ?: 'Pasar Desa di Kabupaten Tuban',
                    'url' => route('admin.pasar.index', ['search' => $item->nama_lokasi]),
                    'icon' => 'bi-shop',
                ])
                ->all();
        }

        // 7. Kantor Desa
        if (Schema::hasTable('lokasi_kantor')) {
            $results['Kantor Desa'] = DB::table('lokasi_kantor')
                ->where(function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('properties', 'like', '%'.$term.'%');
                })
                ->orderBy('nama_lokasi')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($item) => [
                    'title' => $item->nama_lokasi,
                    'type' => 'Kantor Desa',
                    'description' => $item->alamat ?: 'Kantor Pemerintahan Desa',
                    'url' => route('admin.kantor.index', ['search' => $item->nama_lokasi]),
                    'icon' => 'bi-building',
                ])
                ->all();
        }

        // 8. WiFi Desa
        if (Schema::hasTable('lokasi_wifi')) {
            $results['WiFi Desa'] = DB::table('lokasi_wifi')
                ->where(function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('properties', 'like', '%'.$term.'%');
                })
                ->orderBy('nama_lokasi')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($item) => [
                    'title' => $item->nama_lokasi,
                    'type' => 'WiFi Desa',
                    'description' => $item->alamat ?: 'Titik Akses Internet Desa',
                    'url' => route('admin.wifi.index', ['search' => $item->nama_lokasi]),
                    'icon' => 'bi-wifi',
                ])
                ->all();
        }

        // 9. BUMDes
        if (Schema::hasTable('lokasi_bumdes')) {
            $results['BUMDes'] = DB::table('lokasi_bumdes')
                ->where(function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('properties', 'like', '%'.$term.'%');
                })
                ->orderBy('nama_lokasi')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($item) => [
                    'title' => $item->nama_lokasi,
                    'type' => 'BUMDes',
                    'description' => $item->alamat ?: 'Badan Usaha Milik Desa',
                    'url' => route('admin.bumdes.index', ['search' => $item->nama_lokasi]),
                    'icon' => 'bi-briefcase-fill',
                ])
                ->all();
        }

        // 10. KKDMP
        if (Schema::hasTable('lokasi_kkdmp')) {
            $results['KKDMP'] = DB::table('lokasi_kkdmp')
                ->where(function ($q) use ($term) {
                    $q->where('nama_lokasi', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('properties', 'like', '%'.$term.'%');
                })
                ->orderBy('nama_lokasi')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($item) => [
                    'title' => $item->nama_lokasi,
                    'type' => 'KKDMP',
                    'description' => $item->alamat ?: 'Kelompok KKDMP',
                    'url' => route('admin.kkdmp.index', ['search' => $item->nama_lokasi]),
                    'icon' => 'bi-people-fill',
                ])
                ->all();
        }

        // 11. Tempat / Spasial
        if (Schema::hasTable('tempat')) {
            $results['Data Spasial'] = Tempat::query()
                ->where(function ($q) use ($term) {
                    $q->where('nama', 'like', '%'.$term.'%')
                      ->orWhere('kategori', 'like', '%'.$term.'%')
                      ->orWhere('desa', 'like', '%'.$term.'%')
                      ->orWhere('alamat', 'like', '%'.$term.'%')
                      ->orWhere('deskripsi', 'like', '%'.$term.'%')
                      ->orWhere('info_tambahan', 'like', '%'.$term.'%');
                })
                ->orderBy('nama')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($tempat) => [
                    'title' => $tempat->nama,
                    'type' => 'Spasial (' . ucfirst($tempat->kategori ?: 'Tempat') . ')',
                    'description' => trim(($tempat->desa ? 'Desa ' . $tempat->desa . ' • ' : '') . ($tempat->alamat ?: ucfirst($tempat->kategori))),
                    'url' => route('admin.tempat.kategori.detail', $tempat->kategori ?: 'lainnya'),
                    'icon' => 'bi-pin-map-fill',
                ])
                ->all();
        }

        // 12. Layanan
        if (Schema::hasTable('layanan')) {
            $results['Layanan'] = Layanan::query()
                ->where(function ($q) use ($term) {
                    $q->where('nama', 'like', '%'.$term.'%')
                      ->orWhere('link', 'like', '%'.$term.'%');
                })
                ->limit($limitPerType)
                ->get()
                ->map(fn ($layanan) => [
                    'title' => $layanan->nama,
                    'type' => 'Layanan',
                    'description' => $layanan->link ?: 'Layanan Publik Digital',
                    'url' => route('admin.layanan.index'),
                    'icon' => 'bi-grid-fill',
                ])
                ->all();
        }

        // 13. Survei Kepuasan
        if (Schema::hasTable('website_feedback')) {
            $results['Survei Kepuasan'] = DB::table('website_feedback')
                ->whereNull('feedback_removed_at')
                ->where(function ($q) use ($term) {
                    $q->where('nama', 'like', '%'.$term.'%')
                      ->orWhere('message', 'like', '%'.$term.'%')
                      ->orWhere('pekerjaan', 'like', '%'.$term.'%')
                      ->orWhere('rating', 'like', '%'.$term.'%');
                })
                ->orderByDesc('id')
                ->limit($limitPerType)
                ->get()
                ->map(fn ($survei) => [
                    'title' => ($survei->nama ?: 'Anonim') . ' (' . ($survei->rating ?? 5) . '★)',
                    'type' => 'Survei Kepuasan',
                    'description' => Str::limit($survei->message ?? '', 60),
                    'url' => route('admin.survei.index', ['search' => $survei->nama]),
                    'icon' => 'bi-chat-heart-fill',
                ])
                ->all();
        }

        // 14. User / Kontributor
        if ($user && method_exists($user, 'isAdmin') && $user->isAdmin()) {
            $results['User'] = User::query()
                ->where(function ($q) use ($term) {
                    $q->where('name', 'like', '%'.$term.'%')
                      ->orWhere('email', 'like', '%'.$term.'%')
                      ->orWhere('role', 'like', '%'.$term.'%');
                })
                ->limit($limitPerType)
                ->get()
                ->map(fn ($usr) => [
                    'title' => $usr->name,
                    'type' => 'User',
                    'description' => $usr->email . ' (' . ucfirst($usr->role) . ')',
                    'url' => route('admin.kontributor.index', ['search' => $usr->name]),
                    'icon' => 'bi-person-fill',
                ])
                ->all();
        }

        return $results;
    }
}