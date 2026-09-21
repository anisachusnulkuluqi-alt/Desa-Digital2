<?php

namespace App\Imports;

use App\Models\Kecamatan;
use App\Models\Desa;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class KecamatanImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $importedKecamatan = 0;
        $importedDesa = 0;
        $skippedKecamatan = 0;
        $skippedDesa = 0;

        foreach ($rows as $index => $row) {
            // Skip baris pertama (header)
            if ($index === 0) {
                continue;
            }

            // Ambil data dari setiap kolom - handle berbagai kemungkinan nama kolom
            $namaKecamatan = isset($row['nama_kecamatan']) ? trim($row['nama_kecamatan']) : '';
            
            // Coba berbagai kemungkinan nama kolom untuk desa
            $namaDesa = isset($row['desa']) ? trim($row['desa']) : '';
            if (empty($namaDesa) && isset($row['nama_desa'])) {
                $namaDesa = trim($row['nama_desa']);
            }
            
            // Coba berbagai kemungkinan nama kolom untuk kode
            $kodeDesa = isset($row['kode']) ? trim($row['kode']) : '';
            if (empty($kodeDesa) && isset($row['kode_desa'])) {
                $kodeDesa = trim($row['kode_desa']);
            }

            // Skip baris yang kosong
            if (empty($namaKecamatan)) {
                continue;
            }

            // Cari atau buat kecamatan
            $kecamatan = Kecamatan::where('nama_kecamatan', $namaKecamatan)->first();
            
            if (!$kecamatan) {
                $kecamatan = Kecamatan::create([
                    'nama_kecamatan' => $namaKecamatan,
                ]);
                $importedKecamatan++;
            } else {
                $skippedKecamatan++;
            }

            // Import Desa (HANYA jika ada nama desa)
            if (!empty($namaDesa)) {
                // Cek apakah desa sudah ada untuk kecamatan ini
                $desaExists = Desa::where('nama_desa', $namaDesa)
                    ->where('kecamatan_id', $kecamatan->id)
                    ->first();

                if (!$desaExists) {
                    Desa::create([
                        'nama_desa' => $namaDesa,
                        'kecamatan_id' => $kecamatan->id,
                        'kode_desa' => $kodeDesa ?: null,
                    ]);
                    $importedDesa++;
                } else {
                    $skippedDesa++;
                }
            }
        }

        // Simpan statistik di session
        session()->flash('import_stats', [
            'kecamatan_baru' => $importedKecamatan,
            'kecamatan_skip' => $skippedKecamatan,
            'desa_baru' => $importedDesa,
            'desa_skip' => $skippedDesa,
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}