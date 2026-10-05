<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Services\DashboardStatistics;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index(DashboardStatistics $statistics)
    {
        return view('admin.dashboard', $statistics->counts());
    }

    public function searchSuggestions(Request $request)
    {
        $term = trim($request->string('q')->toString());

        if ($term === '' || mb_strlen($term) > 80) {
            return response()->json([]);
        }

        $menus = [
            ['title' => 'Beranda', 'type' => 'Menu', 'url' => route('dashboard')],
            ['title' => 'Kecamatan', 'type' => 'Menu', 'url' => route('admin.kecamatan.index')],
            ['title' => 'Desa', 'type' => 'Menu', 'url' => route('admin.desa.index')],
            ['title' => 'Wisata Desa', 'type' => 'Menu', 'url' => route('admin.wisata.index')],
            ['title' => 'Pasar Desa', 'type' => 'Menu', 'url' => route('admin.pasar.index')],
            ['title' => 'Kantor Desa', 'type' => 'Menu', 'url' => route('admin.kantor.index')],
            ['title' => 'WiFi Desa', 'type' => 'Menu', 'url' => route('admin.wifi.index')],
            ['title' => 'BUMDes', 'type' => 'Menu', 'url' => route('admin.bumdes.index')],
            ['title' => 'KKDMP', 'type' => 'Menu', 'url' => route('admin.kkdmp.index')],
            ['title' => 'Tempat', 'type' => 'Menu', 'url' => route('admin.tempat.index')],
        ];

        if ($request->user()->isAdmin()) {
            $menus[] = ['title' => 'Kontributor', 'type' => 'Menu', 'url' => route('admin.kontributor.index')];
        }

        $menuSuggestions = collect($menus)
            ->filter(fn (array $menu): bool => Str::contains(Str::lower($menu['title']), Str::lower($term)));

        $desaSuggestions = Desa::query()
            ->where('nama_desa', 'like', '%'.$term.'%')
            ->orderBy('nama_desa')
            ->limit(4)
            ->get(['nama_desa'])
            ->map(fn (Desa $desa): array => [
                'title' => $desa->nama_desa,
                'type' => 'Desa',
                'url' => route('admin.desa.index', ['search' => $desa->nama_desa]),
            ]);

        $kecamatanSuggestions = Kecamatan::query()
            ->where('nama_kecamatan', 'like', '%'.$term.'%')
            ->orderBy('nama_kecamatan')
            ->limit(4)
            ->get(['nama_kecamatan'])
            ->map(fn (Kecamatan $kecamatan): array => [
                'title' => $kecamatan->nama_kecamatan,
                'type' => 'Kecamatan',
                'url' => route('admin.kecamatan.index', ['search' => $kecamatan->nama_kecamatan]),
            ]);

        return response()->json(
            $menuSuggestions
                ->concat($desaSuggestions)
                ->concat($kecamatanSuggestions)
                ->take(8)
                ->values()
        )->header('Cache-Control', 'no-store, private');
    }
}