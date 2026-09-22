<?php

namespace App\Imports;

use App\Models\Desa;
use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class DesaImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $inserted = 0;
        $skipped = 0;
        $errors = [];
        $lastKecamatan = '';

        \Log::info('=== START IMPORT DESA ===');
        \Log::info('Total rows: ' . count($rows));

        foreach ($rows as $index => $row) {
            try {
                $data = $row->toArray();

                // Log first 3 rows untuk debugging
                if ($index < 3) {
                    \Log::info("Row {$index} RAW DATA: " . json_encode($data));
                    \Log::info("Row {$index} AVAILABLE KEYS: " . implode(', ', array_keys($data)));
                }

                // Ambil nilai dengan handle semua kemungkinan nama kolom
                // Header Excel: "NAMA KECAMATAN", "D E S A", "K O D E"
                // Laravel Excel mengubahnya menjadi: "nama_kecamatan", "d_e_s_a", "k_o_d_e"
                $namaKecamatan = $this->getValue($data, [
                    'nama_kecamatan', 'nama_kecamatan', 'kecamatan',
                    'NAMA_KECAMATAN', 'NAMA KECAMATAN'
                ]);

                $namaDesa = $this->getValue($data, [
                    'd_e_s_a', 'desa', 'nama_desa', 'nama desa',
                    'D_E_S_A', 'DESA', 'D E S A'
                ]);

                $kodeDesa = $this->getValue($data, [
                    'k_o_d_e', 'kode', 'kode_desa', 'kode desa',
                    'K_O_D_E', 'KODE', 'K O D E'
                ]);

                $namaKecamatan = trim($namaKecamatan);
                $namaDesa = trim($namaDesa);
                $kodeDesa = trim($kodeDesa);

                if ($index < 5) {
                    \Log::info("Row {$index}: Kecamatan='{$namaKecamatan}', Desa='{$namaDesa}', Kode='{$kodeDesa}'");
                }

                // Simpan kecamatan terakhir
                if (!empty($namaKecamatan)) {
                    $lastKecamatan = $namaKecamatan;
                }

                // Skip jika tidak ada nama desa
                if (empty($namaDesa)) {
                    if ($index < 10) {
                        \Log::warning("Row {$index}: SKIP - Desa kosong");
                    }
                    $skipped++;
                    continue;
                }

                // Gunakan kecamatan terakhir
                if (empty($namaKecamatan)) {
                    $namaKecamatan = $lastKecamatan;
                }

                // Cari kecamatan
                $kecamatan = Kecamatan::where('nama_kecamatan', $namaKecamatan)->first();
                
                if (!$kecamatan) {
                    $kecamatan = Kecamatan::whereRaw('LOWER(nama_kecamatan) = ?', [strtolower($namaKecamatan)])->first();
                }

                if (!$kecamatan) {
                    $errors[] = "Row " . ($index + 2) . ": Kecamatan '{$namaKecamatan}' not found";
                    \Log::error("Row {$index}: Kecamatan '{$namaKecamatan}' NOT FOUND");
                    $skipped++;
                    continue;
                }

                \Log::info("Row {$index}: Found kecamatan '{$kecamatan->nama_kecamatan}' (ID: {$kecamatan->id})");

                // Cek duplikat
                $existingDesa = Desa::where('nama_desa', $namaDesa)
                    ->where('kecamatan_id', $kecamatan->id)
                    ->first();

                if ($existingDesa) {
                    \Log::info("Row {$index}: Desa already exists");
                    $skipped++;
                    continue;
                }

                // ✅ PENTING: Isi SEMUA kolom yang wajib (NOT NULL)
                // Berdasarkan struktur database:
                // - nama_desa (NOT NULL)
                // - status (NOT NULL, default 'aktif')
                // - kecamatan_id (NOT NULL)
                // - kode_desa (NOT NULL)
                Desa::create([
                    'nama_desa' => $namaDesa,
                    'status' => 'aktif',  // ✅ WAJIB! Kolom ini NOT NULL
                    'kecamatan_id' => $kecamatan->id,
                    'kode_desa' => $kodeDesa ?: '0000000000',  // ✅ WAJIB! Kolom ini NOT NULL
                    'luas_wilayah' => null,
                    'jumlah_penduduk' => null,
                    'jumlah_kk' => null,
                ]);

                $inserted++;
                \Log::info("Row {$index}: ✓ Created desa '{$namaDesa}'");

            } catch (\Exception $e) {
                $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                \Log::error("Row {$index} ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString());
                $skipped++;
            }
        }

        \Log::info("=== END IMPORT ===");
        \Log::info("✓ Inserted: {$inserted}, Skipped: {$skipped}");
        if (!empty($errors)) {
            \Log::info("Errors: " . implode('; ', array_slice($errors, 0, 10)));
        }

        session()->flash('import_stats', [
            'inserted' => $inserted,
            'skipped' => $skipped,
            'errors' => $errors,
        ]);
    }

    private function getValue($data, $keys)
    {
        foreach ($keys as $key) {
            if (isset($data[$key]) && $data[$key] !== null && $data[$key] !== '') {
                return $data[$key];
            }
        }
        return '';
    }

    public function headingRow(): int
    {
        return 1;
    }
}