<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;

class WebsiteDesaSeeder extends Seeder
{
    private const FIELDS = [
        'website' => 255,
        'youtube' => 255,
        'instagram' => 255,
        'facebook' => 255,
        'tiktok' => 255,
        'whatsapp' => 50,
    ];

    public function run(): void
    {
        $path = database_path('seeders/data/json/data-desa.json');
        if (!is_file($path) || !is_readable($path)) {
            throw new RuntimeException('File data website desa tidak ditemukan atau tidak dapat dibaca.');
        }

        try {
            $records = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException('File data website desa bukan JSON yang valid.', 0, $exception);
        }

        if (!is_array($records)) {
            throw new RuntimeException('Format file data website desa tidak valid.');
        }

        $villageData = [];
        foreach ($records as $index => $record) {
            if (!is_array($record)) {
                throw new RuntimeException('Data desa pada baris '.($index + 1).' tidak valid.');
            }

            $kodeDesa = trim((string) ($record['kode_desa'] ?? ''));
            if ($kodeDesa === '') {
                continue;
            }

            $data = [];
            foreach (self::FIELDS as $field => $maxLength) {
                $value = $record[$field] ?? '';
                if (!is_scalar($value)) {
                    throw new RuntimeException("Nilai {$field} tidak valid pada kode desa {$kodeDesa}.");
                }

                $value = trim((string) $value);
                if ($value === '') {
                    continue;
                }

                if ($field === 'website' && !preg_match('/^https?:\/\//i', $value)) {
                    $value = 'https://'.$value;
                }

                if (strlen($value) > $maxLength) {
                    throw new RuntimeException("Nilai {$field} terlalu panjang untuk kode desa {$kodeDesa}.");
                }

                $data[$field] = $value;
            }

            if ($data === []) {
                continue;
            }

            if (isset($villageData[$kodeDesa])) {
                throw new RuntimeException("Kode desa duplikat pada file data website desa: {$kodeDesa}.");
            }

            $villageData[$kodeDesa] = $data;
        }

        $updatedCount = 0;
        DB::transaction(function () use ($villageData, &$updatedCount): void {
            foreach ($villageData as $kodeDesa => $fields) {
                foreach ($fields as $field => $value) {
                    $updatedCount += DB::table('desa')
                        ->where('kode_desa', $kodeDesa)
                        ->whereRaw("TRIM(COALESCE({$field}, '')) = ''")
                        ->update([
                            $field => $value,
                            'updated_at' => now(),
                        ]);
                }
            }
        });

        $this->command?->info("Data website dan sosial media desa yang berhasil diisi: {$updatedCount}.");
    }
}
