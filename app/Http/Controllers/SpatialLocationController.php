<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

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

    public function index(string $kategori)
    {
        abort_unless(isset(self::CATEGORIES[$kategori]), 404);

        $category = self::CATEGORIES[$kategori];
        $rows = DB::table($category['table'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderBy('id')
            ->get([
                'id',
                'feature_id',
                'nama_lokasi',
                'alamat',
                'latitude',
                'longitude',
                'properties',
            ]);

        $features = $rows->map(function ($row) use ($category): array {
            $properties = json_decode($row->properties ?? '{}', true);
            $properties = is_array($properties) ? $properties : [];
            $properties[$category['name_property']] = $row->nama_lokasi;

            if ($row->alamat !== null) {
                $properties['alamat'] = $row->alamat;
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
        ]);
    }
}