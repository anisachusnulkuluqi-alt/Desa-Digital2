<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;
use Throwable;

class LokasiTitikSeeder extends Seeder
{
    private const LAYERS = [
        'wifi.geojson' => ['table' => 'lokasi_wifi', 'name' => 'nama_ssid'],
        'kantor.geojson' => ['table' => 'lokasi_kantor', 'name' => 'nama_ssid'],
        'pasar.geojson' => ['table' => 'lokasi_pasar', 'name' => 'nama_pasar'],
        'wisata.geojson' => ['table' => 'lokasi_wisata', 'name' => 'nama_wisat'],
        'bumdes.geojson' => ['table' => 'lokasi_bumdes', 'name' => 'nama'],
        'kkdmp.geojson' => ['table' => 'lokasi_kkdmp', 'name' => 'nama'],
    ];

    public function run(): void
    {
        foreach (self::LAYERS as $fileName => $layer) {
            $filePath = public_path("geojson/{$fileName}");
            if (!is_file($filePath)) {
                throw new RuntimeException("File GeoJSON tidak ditemukan: {$fileName}");
            }

            try {
                $collection = json_decode(
                    file_get_contents($filePath),
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );
            } catch (JsonException $exception) {
                throw new RuntimeException("GeoJSON tidak valid: {$fileName}", previous: $exception);
            }

            if (($collection['type'] ?? null) !== 'FeatureCollection' || !is_array($collection['features'] ?? null)) {
                throw new RuntimeException("File bukan GeoJSON FeatureCollection yang valid: {$fileName}");
            }

            $processed = 0;

            try {
                DB::transaction(function () use ($collection, $fileName, $layer, &$processed): void {
                    foreach (array_chunk($collection['features'], 100) as $features) {
                        $rows = [];
                        $timestamp = now();

                        foreach ($features as $feature) {
                            if (!is_array($feature) || ($feature['type'] ?? null) !== 'Feature') {
                                throw new RuntimeException("Fitur GeoJSON tidak valid di {$fileName}");
                            }

                            $properties = $feature['properties'] ?? [];
                            $geometry = $feature['geometry'] ?? null;
                            $coordinates = $geometry['coordinates'] ?? null;

                            if (($geometry['type'] ?? null) !== 'Point' || !is_array($coordinates) || count($coordinates) < 2) {
                                throw new RuntimeException("Fitur {$fileName} harus memiliki geometri Point");
                            }

                            [$longitude, $latitude] = $coordinates;
                            if (!is_numeric($latitude) || !is_numeric($longitude)) {
                                throw new RuntimeException("Koordinat fitur tidak valid di {$fileName}");
                            }

                            $rawId = $feature['id'] ?? ($properties['FID'] ?? null);
                            $featureId = is_scalar($rawId) ? (string) $rawId : null;
                            $encodedFeature = json_encode(
                                $feature,
                                JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION
                            );

                            $rows[] = [
                                'feature_id' => $featureId,
                                'feature_key' => hash('sha256', $featureId === null ? $encodedFeature : "id:{$featureId}"),
                                'nama_lokasi' => isset($properties[$layer['name']])
                                    ? (string) $properties[$layer['name']]
                                    : null,
                                'alamat' => isset($properties['alamat']) ? (string) $properties['alamat'] : null,
                                'latitude' => (float) $latitude,
                                'longitude' => (float) $longitude,
                                'properties' => json_encode(
                                    $properties,
                                    JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRESERVE_ZERO_FRACTION
                                ),
                                'created_at' => $timestamp,
                                'updated_at' => $timestamp,
                            ];
                        }

                        if ($rows !== []) {
                            DB::table($layer['table'])->upsert(
                                $rows,
                                ['feature_key'],
                                ['feature_id', 'nama_lokasi', 'alamat', 'latitude', 'longitude', 'properties', 'updated_at']
                            );
                            $processed += count($rows);
                        }
                    }
                });
            } catch (Throwable $exception) {
                throw new RuntimeException("Gagal mengimpor {$fileName}: {$exception->getMessage()}", previous: $exception);
            }

            $this->command?->info("{$fileName}: {$processed} fitur masuk ke {$layer['table']}.");
        }
    }
}