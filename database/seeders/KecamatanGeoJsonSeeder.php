<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;

class KecamatanGeoJsonSeeder extends Seeder
{
    public function run(): void
    {
        $filePath = public_path('geojson/kecamatan.geojson');
        if (!is_file($filePath)) {
            throw new RuntimeException('File GeoJSON tidak ditemukan: kecamatan.geojson');
        }

        try {
            $collection = json_decode(file_get_contents($filePath), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('GeoJSON tidak valid: kecamatan.geojson', previous: $exception);
        }

        if (($collection['type'] ?? null) !== 'FeatureCollection' || !is_array($collection['features'] ?? null)) {
            throw new RuntimeException('File kecamatan.geojson bukan FeatureCollection yang valid.');
        }

        $processed = 0;

        DB::transaction(function () use ($collection, &$processed): void {
            foreach ($collection['features'] as $feature) {
                $properties = $feature['properties'] ?? [];
                $namaKecamatan = trim((string) ($properties['nm_kecamatan'] ?? ''));

                if ($namaKecamatan === '') {
                    throw new RuntimeException('Nama kecamatan tidak ditemukan di kecamatan.geojson.');
                }

                Kecamatan::updateOrCreate(['nama_kecamatan' => $namaKecamatan]);
                $processed++;
            }
        });

        $this->command?->info("kecamatan.geojson: {$processed} kecamatan masuk/perbarui di tabel kecamatan.");
    }
}