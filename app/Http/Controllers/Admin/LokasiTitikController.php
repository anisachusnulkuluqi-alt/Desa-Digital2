<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LokasiTitikController extends Controller
{
    private const CATEGORIES = [
        'wifi' => ['label' => 'WiFi Desa', 'table' => 'lokasi_wifi', 'route' => 'wifi'],
        'kantor' => ['label' => 'Kantor Desa', 'table' => 'lokasi_kantor', 'route' => 'kantor'],
        'pasar' => ['label' => 'Pasar Desa', 'table' => 'lokasi_pasar', 'route' => 'pasar'],
        'wisata' => ['label' => 'Wisata Desa', 'table' => 'lokasi_wisata', 'route' => 'wisata'],
        'bumdes' => ['label' => 'BUMDes', 'table' => 'lokasi_bumdes', 'route' => 'bumdes'],
        'kkdmp' => ['label' => 'KKDMP', 'table' => 'lokasi_kkdmp', 'route' => 'kkdmp'],
    ];

    public function index(Request $request)
    {
        $category = $this->category($request);
        $query = DB::table($category['table']);

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($builder) use ($search): void {
                $builder->where('nama_lokasi', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $locations = $query->orderBy('nama_lokasi')->paginate(20)->withQueryString();
        $routePrefix = 'admin.'.$category['route'];

        return view('admin.lokasi.index', [
            'category' => $category,
            'categories' => self::CATEGORIES,
            'locations' => $locations,
            'totalLocations' => DB::table($category['table'])->count(),
            'storeUrl' => route($routePrefix.'.store'),
            'updateUrlTemplate' => route($routePrefix.'.update', ['id' => '__ID__']),
            'deleteUrlTemplate' => route($routePrefix.'.destroy', ['id' => '__ID__']),
        ]);
    }

    public function store(Request $request)
    {
        $category = $this->category($request);
        $data = $this->validatedLocation($request);
        $now = now();

        DB::table($category['table'])->insert([
            'feature_key' => hash('sha256', (string) Str::uuid()),
            'nama_lokasi' => $data['nama_lokasi'],
            'alamat' => $data['alamat'] ?? null,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'properties' => $data['properties'] ?? null,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('admin.'.$category['route'].'.index')
            ->with('success', 'Titik lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $category = $this->category($request);
        $data = $this->validatedLocation($request);
        $location = DB::table($category['table'])->where('id', $id)->first();
        abort_if($location === null, 404);

        DB::table($category['table'])->where('id', $id)->update([
            'nama_lokasi' => $data['nama_lokasi'],
            'alamat' => $data['alamat'] ?? null,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'properties' => $data['properties'] ?? null,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.'.$category['route'].'.index')
            ->with('success', 'Titik lokasi berhasil diperbarui.');
    }

    public function destroy(Request $request, int $id)
    {
        $category = $this->category($request);
        $deleted = DB::table($category['table'])->where('id', $id)->delete();
        abort_if($deleted === 0, 404);

        return redirect()->route('admin.'.$category['route'].'.index')
            ->with('success', 'Titik lokasi berhasil dihapus.');
    }

    private function category(Request $request): array
    {
        $key = $request->route('kategori');
        abort_unless(is_string($key) && isset(self::CATEGORIES[$key]), 404);

        return self::CATEGORIES[$key];
    }

    private function validatedLocation(Request $request): array
    {
        return $request->validate([
            'nama_lokasi' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string', 'max:5000'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'properties' => ['nullable', 'json'],
        ]);
    }
}