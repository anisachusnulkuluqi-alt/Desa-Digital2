<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Support\KecamatanSpatialResolver;
use App\Support\LokasiAttributeTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SpatialLocationController extends Controller
{
    private const CUSTOM_CATEGORY_PALETTE = [
        ['#b63b16', '#f6e7e3'],
        ['#16b647', '#e3f6e9'],
        ['#5416b6', '#eae3f6'],
        ['#b66016', '#f6ece3'],
        ['#16b66c', '#e3f6ed'],
        ['#7816b6', '#efe3f6'],
        ['#b68516', '#f6f0e3'],
        ['#16b691', '#e3f6f2'],
        ['#9d16b6', '#f3e3f6'],
        ['#9db616', '#f3f6e3'],
        ['#1691b6', '#e3f2f6'],
        ['#b61685', '#f6e3f0'],
        ['#78b616', '#eff6e3'],
        ['#166cb6', '#e3edf6'],
        ['#b61660', '#f6e3ec'],
        ['#54b616', '#eaf6e3'],
        ['#1647b6', '#e3e9f6'],
        ['#b6163b', '#f6e3e7'],
        ['#16b623', '#e3f6e5'],
        ['#2f16b6', '#e6e3f6'],
    ];

    private const CATEGORIES = [
        'wifi' => ['table' => 'lokasi_wifi', 'name_property' => 'nama_ssid'],
        'kantor' => ['table' => 'lokasi_kantor', 'name_property' => 'nama_ssid'],
        'pasar' => ['table' => 'lokasi_pasar', 'name_property' => 'nama_pasar'],
        'wisata' => ['table' => 'lokasi_wisata', 'name_property' => 'nama_wisat'],
        'bumdes' => ['table' => 'lokasi_bumdes', 'name_property' => 'nama'],
        'kkdmp' => ['table' => 'lokasi_kkdmp', 'name_property' => 'nama'],
    ];

    public function map()
    {
        $reservedCategories = array_keys(self::CATEGORIES);
        $categories = Kategori::orderBy('nama')->get();
        $spatialCategories = [];
        $customSpatialSources = [];
        $customSpatialMeta = [];

        foreach ($categories as $category) {
            $slug = Str::slug($category->nama, '_');
            if (! $slug || in_array($slug, $reservedCategories, true)) {
                continue;
            }

            $table = LokasiAttributeTable::nameForCategory($category->nama, $category->id);
            if (! Schema::hasTable($table)
                || ! Schema::hasColumn($table, 'latitude')
                || ! Schema::hasColumn($table, 'longitude')) {
                continue;
            }

            $spatialCategories[] = [
                'slug' => $slug,
                'label' => ucfirst($category->nama),
            ];
            $customSpatialSources[$slug] = route('data.spasial.locations', ['kategori' => $slug]);
            $paletteIndex = (count($spatialCategories) - 1) % count(self::CUSTOM_CATEGORY_PALETTE);
            [$color, $background] = self::CUSTOM_CATEGORY_PALETTE[$paletteIndex];
            $customSpatialMeta[$slug] = [
                'label' => ucfirst($category->nama),
                'color' => $color,
                'bg' => $background,
                'icon' => 'fa-location-dot',
            ];
        }

        return view('data-spasial', compact('spatialCategories', 'customSpatialSources', 'customSpatialMeta'));
    }

    public function index(string $kategori)
    {
        if (! isset(self::CATEGORIES[$kategori])) {
            return $this->customCategoryFeatures($kategori);
        }

        $category = self::CATEGORIES[$kategori];
        $columns = [
            'id',
            'feature_id',
            'nama_lokasi',
            'latitude',
            'longitude',
            'properties',
        ];

        if (Schema::hasColumn($category['table'], 'alamat')) {
            $columns[] = 'alamat';
        }
        if (Schema::hasColumn($category['table'], 'desa')) {
            $columns[] = 'desa';
        }

        $rows = DB::table($category['table'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('id')
            ->get($columns);

        $features = $rows->map(function ($row) use ($category): array {
            $properties = json_decode($row->properties ?? '{}', true);
            $properties = is_array($properties) ? $properties : [];
            $properties[$category['name_property']] = $row->nama_lokasi;

            if (property_exists($row, 'desa') && !empty($row->desa) && empty($properties['desa'])) {
                $properties['desa'] = $row->desa;
            }

            $address = property_exists($row, 'alamat') ? trim((string) $row->alamat) : '';
            foreach (['alamat', 'Alamat', 'address', 'Address'] as $addressKey) {
                if ($address !== '') {
                    break;
                }
                $address = trim((string) ($properties[$addressKey] ?? ''));
            }

            $properties['alamat'] = $address;

            $kecamatan = KecamatanSpatialResolver::resolve(
                $row->longitude,
                $row->latitude,
                $properties,
                $row->nama_lokasi,
                $address
            );
            if ($kecamatan) {
                $properties['kecamatan'] = $kecamatan;
            }

            return [
                'type' => 'Feature',
                'id' => $row->feature_id ?? $row->id,
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float) $row->longitude, (float) $row->latitude],
                ],
                'properties' => $properties,
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ])->header('Cache-Control', 'no-store, private');
    }

    private function customCategoryFeatures(string $slug)
    {
        $category = Kategori::all()->first(
            fn (Kategori $candidate): bool => Str::slug($candidate->nama, '_') === $slug
        );

        abort_unless($category, 404);

        $reservedCategories = array_keys(self::CATEGORIES);
        abort_if(in_array($slug, $reservedCategories, true), 404);

        $table = LokasiAttributeTable::nameForCategory($category->nama, $category->id);
        if (! Schema::hasTable($table)
            || ! Schema::hasColumn($table, 'latitude')
            || ! Schema::hasColumn($table, 'longitude')) {
            return response()->json([
                'type' => 'FeatureCollection',
                'features' => [],
            ])->header('Cache-Control', 'no-store, private');
        }

        $rows = DB::table($table)
            ->join('tempat', 'tempat.id', '=', $table.'.tempat_id')
            ->whereNotNull($table.'.latitude')
            ->where($table.'.latitude', '<>', '')
            ->whereNotNull($table.'.longitude')
            ->where($table.'.longitude', '<>', '')
            ->orderBy($table.'.id')
            ->select($table.'.*', 'tempat.nama as nama')
            ->get();

        $features = $rows->map(function ($row): array {
            $latitude = (float) $row->latitude;
            $longitude = (float) $row->longitude;
            $properties = (array) $row;
            unset($properties['id'], $properties['tempat_id'], $properties['created_at'], $properties['updated_at']);

            $address = $properties['alamat'] ?? $properties['Alamat'] ?? $properties['address'] ?? '';
            $kecamatan = KecamatanSpatialResolver::resolve(
                $longitude,
                $latitude,
                $properties,
                $row->nama ?? null,
                $address
            );
            if ($kecamatan) {
                $properties['kecamatan'] = $kecamatan;
            }

            return [
                'type' => 'Feature',
                'id' => $row->tempat_id,
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$longitude, $latitude],
                ],
                'properties' => $properties,
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ])->header('Cache-Control', 'no-store, private');
    }
}
