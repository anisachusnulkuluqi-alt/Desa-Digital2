<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;

class DesaGeoJsonSeeder extends Seeder
{
    public function run(): void
    {
        $desaCollection = $this->readCollection('desa.geojson');
        $kecamatanCollection = $this->readCollection('kecamatan.geojson');

        $namaKecamatanByCode = [];
        foreach ($kecamatanCollection['features'] as $feature) {
            $properties = $feature['properties'] ?? [];
            $kodeKecamatan = $this->kodeKecamatan($properties);
            $namaKecamatan = trim((string) ($properties['nm_kecamatan'] ?? ''));

            if ($kodeKecamatan === '' || $namaKecamatan === '') {
                throw new RuntimeException('Kode atau nama kecamatan tidak valid di kecamatan.geojson.');
            }

            $namaKecamatanByCode[$kodeKecamatan] = $namaKecamatan;
        }

        $kecamatanByName = Kecamatan::query()->get()->keyBy('nama_kecamatan');
        $processed = 0;

        DB::transaction(function () use ($desaCollection, $namaKecamatanByCode, $kecamatanByName, &$processed): void {
            foreach ($desaCollection['features'] as $feature) {
                $properties = $feature['properties'] ?? [];
                $namaDesa = trim((string) ($properties['nm_kelurahan'] ?? ''));
                $kodeKecamatan = $this->kodeKecamatan($properties);
                $kodeDesa = $kodeKecamatan . trim((string) ($properties['kd_kelurahan'] ?? ''));
                $namaKecamatan = $namaKecamatanByCode[$kodeKecamatan] ?? null;
                $kecamatan = $namaKecamatan !== null ? $kecamatanByName->get($namaKecamatan) : null;

                if ($namaDesa === '' || $kodeDesa === '' || !$kecamatan) {
                    throw new RuntimeException('Properti desa tidak valid atau kecamatannya tidak ditemukan di desa.geojson.');
                }

                Desa::updateOrCreate(
                    ['kode_desa' => $kodeDesa],
                    [
                        'nama_desa' => $namaDesa,
                        'kecamatan_id' => $kecamatan->id,
                        'jenis' => trim((string) ($properties['jenis'] ?? 'Desa')) ?: 'Desa',
                    ]
                );
                $processed++;
            }
        });

        $this->command?->info("desa.geojson: {$processed} desa masuk/perbarui di tabel desa.");
    }

    private function readCollection(string $fileName): array
    {
        $filePath = public_path("geojson/{$fileName}");
        if (!is_file($filePath)) {
            throw new RuntimeException("File GeoJSON tidak ditemukan: {$fileName}");
        }

        try {
            $collection = json_decode(file_get_contents($filePath), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException("GeoJSON tidak valid: {$fileName}", previous: $exception);
        }

        if (($collection['type'] ?? null) !== 'FeatureCollection' || !is_array($collection['features'] ?? null)) {
            throw new RuntimeException("File {$fileName} bukan FeatureCollection yang valid.");
        }

        return $collection;
    }

    private function kodeKecamatan(array $properties): string
    {
        return trim((string) ($properties['kd_propinsi'] ?? ''))
            . trim((string) ($properties['kd_dati2'] ?? ''))
            . trim((string) ($properties['kd_kecamatan'] ?? ''));
    }
}