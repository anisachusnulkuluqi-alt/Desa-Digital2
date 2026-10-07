<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Support\LokasiAttributeTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SpatialLocationController extends Controller
{
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
        $palette = [
            ['#0f766e', '#ccfbf1'],
            ['#7c3aed', '#ede9fe'],
            ['#be123c', '#ffe4e6'],
            ['#a16207', '#fef3c7'],
            ['#0369a1', '#e0f2fe'],
            ['#4d7c0f', '#ecfccb'],
        ];

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
            [$color, $background] = $palette[count($spatialCategories) % count($palette)];
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

        $rows = DB::table($category['table'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('id')
            ->get($columns);

        $features = $rows->map(function ($row) use ($category): array {
            $properties = json_decode($row->properties ?? '{}', true);
            $properties = is_array($properties) ? $properties : [];
            $properties[$category['name_property']] = $row->nama_lokasi;

            $address = property_exists($row, 'alamat') ? trim((string) $row->alamat) : '';
            foreach (['alamat', 'Alamat', 'address', 'Address'] as $addressKey) {
                if ($address !== '') {
                    break;
                }
                $address = trim((string) ($properties[$addressKey] ?? ''));
            }

            $properties['alamat'] = $address;

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
