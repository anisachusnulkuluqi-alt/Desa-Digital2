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
                $builder->where('nama_lokasi', 'like', "%{$search}%");

                foreach (['nama_desa', 'desa', 'Desa', 'kelurahan', 'desa_kelur'] as $property) {
                    $builder->orWhereRaw(
                        "JSON_UNQUOTE(JSON_EXTRACT(properties, '$.{$property}')) LIKE ?",
                        ["%{$search}%"]
                    );
                }
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
        $data = $this->validatedLocation($request, $category['route']);
        $now = now();
        $propertiesData = json_decode($data['properties'] ?? '{}', true) ?: [];

        if ($category['route'] === 'wifi') {
            $propertiesData['nama_desa'] = $data['desa'];
            $propertiesData['fasilitator'] = $data['fasilitator'];
        }

        if ($category['route'] === 'bumdes') {
            $propertiesData['jenis_usaha'] = $data['jenis_usaha'];
            $propertiesData['nama_ketua'] = $data['nama_ketua'];
        }

        if ($category['route'] === 'kkdmp') {
            $propertiesData['nama'] = $data['nama_lokasi'];
            $propertiesData['desa_kelur'] = $data['desa_kelur'];
            $propertiesData['jenis'] = $data['jenis'];
            $propertiesData['ketua'] = $data['nama_ketua'];
            $propertiesData['no_ahu'] = $data['no_ahu'];
        }

        if ($category['route'] === 'kantor') {
            $propertiesData['link_maps'] = $data['link_maps'] ?? null;
        }

        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->store($category['route'], 'public');
            $propertiesData['foto'] = asset('storage/'.$photoPath);
        }
        $properties = $propertiesData === []
            ? null
            : json_encode($propertiesData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        DB::table($category['table'])->insert([
            'feature_key' => hash('sha256', (string) Str::uuid()),
            'nama_lokasi' => $data['nama_lokasi'],
            'alamat' => $data['alamat'] ?? null,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'properties' => $properties,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return redirect()->route('admin.'.$category['route'].'.index')
            ->with('success', 'Titik lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $category = $this->category($request);
        $data = $this->validatedLocation($request, $category['route']);
        $location = DB::table($category['table'])->where('id', $id)->first();
        abort_if($location === null, 404);
        $existingProperties = json_decode($location->properties ?? '{}', true) ?: [];
        $submittedProperties = json_decode($data['properties'] ?? '{}', true) ?: [];
        $propertiesData = array_merge($existingProperties, $submittedProperties);

        if ($category['route'] === 'wifi') {
            unset($propertiesData['fasilitato']);
            $propertiesData['nama_desa'] = $data['desa'];
            $propertiesData['fasilitator'] = $data['fasilitator'];
        }

        if ($category['route'] === 'bumdes') {
            unset($propertiesData['jenis_usah']);
            $propertiesData['jenis_usaha'] = $data['jenis_usaha'];
            $propertiesData['nama_ketua'] = $data['nama_ketua'];
        }

        if ($category['route'] === 'kkdmp') {
            $propertiesData['nama'] = $data['nama_lokasi'];
            $propertiesData['desa_kelur'] = $data['desa_kelur'];
            $propertiesData['jenis'] = $data['jenis'];
            $propertiesData['ketua'] = $data['nama_ketua'];
            $propertiesData['no_ahu'] = $data['no_ahu'];
        }

        if ($category['route'] === 'kantor') {
            $propertiesData['link_maps'] = $data['link_maps'] ?? null;
        }

        if ($request->hasFile('foto')) {
            $photoPath = $request->file('foto')->store($category['route'], 'public');
            $propertiesData['foto'] = asset('storage/'.$photoPath);
        }
        $properties = $propertiesData === []
            ? null
            : json_encode($propertiesData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        DB::table($category['table'])->where('id', $id)->update([
            'nama_lokasi' => $data['nama_lokasi'],
            'alamat' => $data['alamat'] ?? null,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'properties' => $properties,
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

    private function validatedLocation(Request $request, string $categoryRoute): array
    {
        $rules = [
            'nama_lokasi' => ['required', 'string', 'max:255'],
            'alamat' => ['nullable', 'string', 'max:5000'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'properties' => ['nullable', 'json'],
        ];

        if (in_array($categoryRoute, ['pasar', 'kantor', 'wifi', 'bumdes', 'kkdmp'], true)) {
            $rules['foto'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];
        }

        if ($categoryRoute === 'wifi') {
            $rules['desa'] = ['required', 'string', 'max:255'];
            $rules['fasilitator'] = ['required', 'in:pemerintah_desa,pemerintah_kabupaten'];
        }

        if ($categoryRoute === 'kantor') {
            $rules['link_maps'] = ['nullable', 'url', 'max:1000'];
        }

        if ($categoryRoute === 'bumdes') {
            $rules['jenis_usaha'] = ['required', 'string', 'max:5000'];
            $rules['nama_ketua'] = ['required', 'string', 'max:255'];
        }

        if ($categoryRoute === 'kkdmp') {
            $rules['desa_kelur'] = ['required', 'string', 'max:255'];
            $rules['jenis'] = ['required', 'in:desa,kelurahan'];
            $rules['nama_ketua'] = ['required', 'string', 'max:255'];
            $rules['no_ahu'] = ['required', 'string', 'max:255'];
        }

        return $request->validate($rules);
    }
}