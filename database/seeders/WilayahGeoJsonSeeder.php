<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;

class WilayahGeoJsonSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatanFeatures = $this->readFeatures('kecamatan.geojson');
        $desaFeatures = $this->readFeatures('desa.geojson');
        $now = now();

        DB::transaction(function () use ($kecamatanFeatures, $desaFeatures, $now): void {
            $kecamatanIds = [];

            foreach ($kecamatanFeatures as $feature) {
                $properties = $this->properties($feature, 'kecamatan.geojson');
                $kodeKecamatan = $this->requiredCode($properties, 'kd_kecamatan', 3);
                $namaKecamatan = trim((string) ($properties['nm_kecamatan'] ?? ''));

                if ($namaKecamatan === '') {
                    throw new RuntimeException('Nama kecamatan kosong pada GeoJSON.');
                }

                $kecamatan = DB::table('kecamatan')
                    ->where('nama_kecamatan', $namaKecamatan)
                    ->first(['id']);

                $kecamatanId = $kecamatan?->id ?? DB::table('kecamatan')->insertGetId([
                    'nama_kecamatan' => $namaKecamatan,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                $kecamatanIds[$kodeKecamatan] = $kecamatanId;
            }

            foreach ($desaFeatures as $feature) {
                $properties = $this->properties($feature, 'desa.geojson');
                $kodeKecamatan = $this->requiredCode($properties, 'kd_kecamatan', 2);
                $kodeKecamatanSeeder = str_pad($kodeKecamatan, 3, '0', STR_PAD_LEFT);
                $kodeDesa = $this->requiredCode($properties, 'kd_kelurahan', 3);
                $namaDesa = trim((string) ($properties['nm_kelurahan'] ?? ''));

                if ($namaDesa === '') {
                    throw new RuntimeException('Nama desa/kelurahan kosong pada GeoJSON.');
                }

                if (!isset($kecamatanIds[$kodeKecamatanSeeder])) {
                    throw new RuntimeException("Kecamatan {$kodeKecamatan} tidak ditemukan untuk {$namaDesa}.");
                }

                $kodeProvinsi = $this->requiredCode($properties, 'kd_propinsi', 2);
                $kodeKabupaten = $this->requiredCode($properties, 'kd_dati2', 2);
                $kodeWilayahDesa = $kodeProvinsi.$kodeKabupaten.$kodeKecamatan.$kodeDesa;
                $kodeWilayahDesaLama = $kodeProvinsi.$kodeKabupaten.$kodeKecamatanSeeder.$kodeDesa;
                $existing = DB::table('desa')
                    ->whereIn('kode_desa', [$kodeWilayahDesa, $kodeWilayahDesaLama])
                    ->first(['id']);
                $data = [
                    'nama_desa' => $namaDesa,
                    'kecamatan_id' => $kecamatanIds[$kodeKecamatanSeeder],
                    'kode_desa' => $kodeWilayahDesa,
                    'updated_at' => $now,
                ];

                if ($existing) {
                    DB::table('desa')->where('id', $existing->id)->update($data);
                } else {
                    DB::table('desa')->insert($data + [
                        'jenis' => 'Desa',
                        'status' => 'aktif',
                        'created_at' => $now,
                    ]);
                }
            }
        });

        $this->command?->info('Wilayah dimuat: '.count($kecamatanFeatures).' kecamatan dan '.count($desaFeatures).' desa/kelurahan.');
    }

    private function readFeatures(string $fileName): array
    {
        $path = public_path("geojson/{$fileName}");
        if (!is_file($path)) {
            throw new RuntimeException("File GeoJSON tidak ditemukan: {$fileName}");
        }

        try {
            $collection = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException("GeoJSON tidak valid: {$fileName}", 0, $exception);
        }

        if (($collection['type'] ?? null) !== 'FeatureCollection' || !is_array($collection['features'] ?? null)) {
            throw new RuntimeException("File bukan GeoJSON FeatureCollection yang valid: {$fileName}");
        }

        return $collection['features'];
    }

    private function properties(mixed $feature, string $fileName): array
    {
        $properties = is_array($feature) ? ($feature['properties'] ?? null) : null;
        if (!is_array($properties)) {
            throw new RuntimeException("Properti fitur tidak valid pada {$fileName}.");
        }

        return $properties;
    }

    private function requiredCode(array $properties, string $key, int $length): string
    {
        $value = $properties[$key] ?? null;
        if (!is_scalar($value) || !preg_match('/^\d+$/', (string) $value)) {
            throw new RuntimeException("Kode wilayah {$key} tidak valid pada GeoJSON.");
        }

        return str_pad((string) $value, $length, '0', STR_PAD_LEFT);
    }
}