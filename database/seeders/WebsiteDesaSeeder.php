<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;
use RuntimeException;

class WebsiteDesaSeeder extends Seeder
{
    public function run(): void
    {
        $path = public_path('json/data-desa.json');
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

        $websites = [];
        foreach ($records as $index => $record) {
            if (!is_array($record)) {
                throw new RuntimeException('Data desa pada baris '.($index + 1).' tidak valid.');
            }

            $kodeDesa = trim((string) ($record['kode_desa'] ?? ''));
            $website = trim((string) ($record['website'] ?? ''));
            if ($kodeDesa === '' || $website === '') {
                continue;
            }

            if (isset($websites[$kodeDesa])) {
                throw new RuntimeException("Kode desa duplikat pada file data website: {$kodeDesa}.");
            }

            $website = preg_match('/^https?:\/\//i', $website) ? $website : 'https://'.$website;
            if (strlen($website) > 255) {
                throw new RuntimeException("Alamat website terlalu panjang untuk kode desa {$kodeDesa}.");
            }

            $websites[$kodeDesa] = $website;
        }

        $updatedCount = 0;
        DB::transaction(function () use ($websites, &$updatedCount): void {
            foreach ($websites as $kodeDesa => $website) {
                $updatedCount += DB::table('desa')
                    ->where('kode_desa', $kodeDesa)
                    ->whereRaw("TRIM(COALESCE(website, '')) = ''")
                    ->update([
                        'website' => $website,
                        'updated_at' => now(),
                    ]);
            }
        });

        $this->command?->info("Website desa yang berhasil diisi: {$updatedCount}.");
    }
}
