<?php

namespace App\Imports;

use App\Models\Desa;
use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\ToArray;

class DesaImportSederhana implements ToArray
{
    public function array(array $array)
    {
        \Log::info('=== START IMPORT SEDERHANA ===');
        \Log::info('Total rows: ' . count($array));

        $inserted = 0;
        $skipped = 0;
        $errors = [];
        $lastKecamatan = '';

        foreach ($array as $index => $row) {
            try {
                // Skip header row (row 0)
                if ($index === 0) {
                    \Log::info('Header row: ' . json_encode($row));
                    continue;
                }

                // Row structure: [0] => NAMA KECAMATAN, [1] => DESA, [2] => KODE
                $namaKecamatan = trim($row[0] ?? '');
                $namaDesa = trim($row[1] ?? '');
                $kodeDesa = trim($row[2] ?? '');

                // Log first 10 rows
                if ($index <= 10) {
                    \Log::info("Row {$index}: Kecamatan='{$namaKecamatan}', Desa='{$namaDesa}', Kode='{$kodeDesa}'");
                }

                // If kecamatan exists, save it
                if (!empty($namaKecamatan)) {
                    $lastKecamatan = $namaKecamatan;
                }

                // Skip if no desa name
                if (empty($namaDesa)) {
                    $skipped++;
                    continue;
                }

                // Use last kecamatan if empty
                if (empty($namaKecamatan)) {
                    $namaKecamatan = $lastKecamatan;
                }

                // Find kecamatan
                $kecamatan = Kecamatan::where('nama_kecamatan', $namaKecamatan)->first();

                if (!$kecamatan) {
                    $errors[] = "Row {$index}: Kecamatan '{$namaKecamatan}' not found";
                    $skipped++;
                    continue;
                }

                // Check if desa exists
                $existingDesa = Desa::where('nama_desa', $namaDesa)
                    ->where('kecamatan_id', $kecamatan->id)
                    ->first();

                if ($existingDesa) {
                    $skipped++;
                    continue;
                }

                // Create desa
                Desa::create([
                    'nama_desa' => $namaDesa,
                    'kecamatan_id' => $kecamatan->id,
                    'kode_desa' => $kodeDesa ?: null,
                    'jenis' => 'Desa',
                ]);

                $inserted++;

            } catch (\Exception $e) {
                $errors[] = "Row {$index}: " . $e->getMessage();
                $skipped++;
            }
        }

        \Log::info("=== END IMPORT ===");
        \Log::info("Inserted: {$inserted}, Skipped: {$skipped}");

        session()->flash('import_stats', [
            'inserted' => $inserted,
            'skipped' => $skipped,
            'errors' => $errors,
        ]);
    }
}