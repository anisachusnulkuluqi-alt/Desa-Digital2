<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $locations = $query->orderBy('nama_lokasi')->paginate(10)->withQueryString();
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
        $propertiesData['alamat'] = $data['alamat'] ?? null;
        $counterpartRoute = $this->counterpartRoute($category['route']);
        $sharedPhotoCounterparts = collect();
        $oldPhotos = [];

        if ($request->hasFile('foto') && $counterpartRoute !== null) {
            $sharedPhotoCounterparts = $this->matchingCounterparts(
                $counterpartRoute,
                $data['latitude'],
                $data['longitude']
            );

            if ($sharedPhotoCounterparts->isNotEmpty() && ! $request->has('apply_foto_kantor_wifi')) {
                return response()->json([
                    'requires_confirmation' => true,
                    'counterpart_names' => $sharedPhotoCounterparts->pluck('nama_lokasi')->filter()->values(),
                    'counterpart_category' => self::CATEGORIES[$counterpartRoute]['label'],
                ], 409);
            }
        }

        $applySharedPhoto = $request->boolean('apply_foto_kantor_wifi') && $sharedPhotoCounterparts->isNotEmpty();

        if ($category['route'] === 'wifi') {
            $propertiesData['nama_desa'] = $data['desa'];
            $propertiesData['fasilitator'] = $data['fasilitator'];
        }

        if (in_array($category['route'], ['pasar', 'kantor', 'bumdes'], true)) {
            $propertiesData['nama_desa'] = trim($data['desa']);
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
            $photoDirectory = $applySharedPhoto ? 'kantor_dan_wifi' : $category['route'];
            $photoPath = $request->file('foto')->store($photoDirectory, 'public');
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

        if ($applySharedPhoto && isset($propertiesData['foto'])) {
            foreach ($sharedPhotoCounterparts as $counterpart) {
                $counterpartProperties = json_decode($counterpart->properties ?? '{}', true) ?: [];
                $oldPhotos[] = $counterpartProperties['foto'] ?? $counterpartProperties['Foto'] ?? $counterpartProperties['image'] ?? null;
                unset($counterpartProperties['Foto'], $counterpartProperties['image']);
                $counterpartProperties['foto'] = $propertiesData['foto'];

                DB::table(self::CATEGORIES[$counterpartRoute]['table'])->where('id', $counterpart->id)->update([
                    'properties' => json_encode($counterpartProperties, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'updated_at' => now(),
                ]);
            }
            $this->deleteUnreferencedPhotos($oldPhotos);
        }

        return redirect()->route('admin.'.$category['route'].'.index')
            ->with('success', 'Titik lokasi berhasil ditambahkan.');
    }

    public function update(Request $request, int $id)
    {
        $category = $this->category($request);
        $data = $this->validatedLocation($request, $category['route']);
        $location = DB::table($category['table'])->where('id', $id)->first();
        abort_if($location === null, 404);
        $counterpartRoute = $this->counterpartRoute($category['route']);
        $sharedPhotoCounterparts = collect();
        $oldPhotos = [];

        $photoChanged = $request->hasFile('foto') || $request->boolean('remove_foto');
        if ($photoChanged && $counterpartRoute !== null) {
            $sharedPhotoCounterparts = $this->matchingCounterparts(
                $counterpartRoute,
                $data['latitude'],
                $data['longitude']
            );

            if ($sharedPhotoCounterparts->isNotEmpty() && ! $request->has('apply_foto_kantor_wifi')) {
                return response()->json([
                    'requires_confirmation' => true,
                    'counterpart_names' => $sharedPhotoCounterparts->pluck('nama_lokasi')->filter()->values(),
                    'counterpart_category' => self::CATEGORIES[$counterpartRoute]['label'],
                ], 409);
            }
        }

        $applySharedPhoto = $request->boolean('apply_foto_kantor_wifi') && $sharedPhotoCounterparts->isNotEmpty();
        $existingProperties = json_decode($location->properties ?? '{}', true) ?: [];
        $submittedProperties = json_decode($data['properties'] ?? '{}', true) ?: [];
        $propertiesData = array_merge($existingProperties, $submittedProperties);
        $propertiesData['alamat'] = $data['alamat'] ?? null;

        if ($category['route'] === 'wifi') {
            unset($propertiesData['fasilitato']);
            $propertiesData['nama_desa'] = $data['desa'];
            $propertiesData['fasilitator'] = $data['fasilitator'];
        }

        if (in_array($category['route'], ['pasar', 'kantor', 'bumdes'], true)) {
            $propertiesData['nama_desa'] = trim($data['desa']);
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

        if ($request->boolean('remove_foto')) {
            $existingPhoto = $existingProperties['foto'] ?? $existingProperties['Foto'] ?? $existingProperties['image'] ?? null;
            $oldPhotos[] = $existingPhoto;
            unset($propertiesData['foto'], $propertiesData['Foto'], $propertiesData['image']);
        }

        if ($request->hasFile('foto')) {
            $photoDirectory = $applySharedPhoto ? 'kantor_dan_wifi' : $category['route'];
            $photoPath = $request->file('foto')->store($photoDirectory, 'public');
            $propertiesData['foto'] = asset('storage/'.$photoPath);
            $oldPhotos[] = $existingProperties['foto'] ?? $existingProperties['Foto'] ?? $existingProperties['image'] ?? null;
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

        if ($applySharedPhoto) {
            foreach ($sharedPhotoCounterparts as $counterpart) {
                $counterpartProperties = json_decode($counterpart->properties ?? '{}', true) ?: [];
                $oldPhotos[] = $counterpartProperties['foto'] ?? $counterpartProperties['Foto'] ?? $counterpartProperties['image'] ?? null;

                if ($request->boolean('remove_foto')) {
                    unset($counterpartProperties['foto'], $counterpartProperties['Foto'], $counterpartProperties['image']);
                } elseif (isset($propertiesData['foto'])) {
                    unset($counterpartProperties['Foto'], $counterpartProperties['image']);
                    $counterpartProperties['foto'] = $propertiesData['foto'];
                }

                DB::table(self::CATEGORIES[$counterpartRoute]['table'])->where('id', $counterpart->id)->update([
                    'properties' => json_encode($counterpartProperties, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->deleteUnreferencedPhotos($oldPhotos);

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

    private function counterpartRoute(string $categoryRoute): ?string
    {
        return match ($categoryRoute) {
            'kantor' => 'wifi',
            'wifi' => 'kantor',
            default => null,
        };
    }

    private function matchingCounterparts(string $counterpartRoute, mixed $latitude, mixed $longitude)
    {
        return DB::table(self::CATEGORIES[$counterpartRoute]['table'])
            ->where('latitude', $latitude)
            ->where('longitude', $longitude)
            ->get();
    }

    private function deleteUnreferencedPhotos(array $photos): void
    {
        foreach (array_unique(array_filter($photos, 'is_string')) as $photo) {
            $path = parse_url($photo, PHP_URL_PATH);
            if (! is_string($path) || ! Str::contains($path, '/storage/')) {
                continue;
            }

            $storedPath = Str::after($path, '/storage/');
            $directory = Str::before($storedPath, '/');
            if (! in_array($directory, array_merge(array_keys(self::CATEGORIES), ['kantor_dan_wifi']), true)) {
                continue;
            }

            $isReferenced = false;
            foreach (self::CATEGORIES as $candidate) {
                foreach (DB::table($candidate['table'])->pluck('properties') as $properties) {
                    $values = json_decode($properties ?? '{}', true) ?: [];
                    if (in_array($photo, [$values['foto'] ?? null, $values['Foto'] ?? null, $values['image'] ?? null], true)) {
                        $isReferenced = true;
                        break 2;
                    }
                }
            }

            if (! $isReferenced) {
                Storage::disk('public')->delete($storedPath);
            }
        }
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
            $rules['remove_foto'] = ['sometimes', 'boolean'];
        }

        if (in_array($categoryRoute, ['kantor', 'wifi'], true)) {
            $rules['apply_foto_kantor_wifi'] = ['sometimes', 'boolean'];
        }

        if ($categoryRoute === 'wifi') {
            $rules['desa'] = ['required', 'string', 'max:255'];
            $rules['fasilitator'] = ['required', 'in:pemerintah_desa,pemerintah_kabupaten'];
        }

        if (in_array($categoryRoute, ['pasar', 'kantor', 'bumdes'], true)) {
            $rules['desa'] = ['required', 'string', 'max:255'];
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
