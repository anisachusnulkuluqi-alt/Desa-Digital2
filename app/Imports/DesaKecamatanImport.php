<?php

namespace App\Imports;

use App\Models\Kecamatan;
use App\Models\Desa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DesaKecamatanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Ambil data dari kolom Excel
        $namaKecamatan = isset($row['nama_kecamatan']) ? trim($row['nama_kecamatan']) : '';
        $namaDesa = isset($row['desa']) ? trim($row['desa']) : '';
        $kodeDesa = isset($row['kode']) ? trim($row['kode']) : '';

        // Skip baris jika nama kecamatan kosong
        if (empty($namaKecamatan)) {
            return null;
        }

        // Cari atau buat Kecamatan
        $kecamatan = Kecamatan::firstOrCreate(
            ['nama_kecamatan' => $namaKecamatan]
        );

        // Jika ada nama desa, cari atau buat Desa
        if (!empty($namaDesa)) {
            return Desa::firstOrCreate(
                [
                    'nama_desa' => $namaDesa,
                    'kecamatan_id' => $kecamatan->id,
                ],
                [
                    'kode_desa' => $kodeDesa ?: null,
                ]
            );
        }

        return null;
    }

    public function headingRow(): int
    {
        return 1;
    }
}