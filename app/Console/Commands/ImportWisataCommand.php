<?php

namespace App\Console\Commands;

use App\Models\Wisata;
use Illuminate\Console\Command;

class ImportWisataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wisata:import {--file= : Path ke file wisata.json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Impor atau sinkronkan data wisata dari file wisata.json ke tabel lokasi_wisata';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $file = $this->option('file');

        try {
            $this->info('Memulai impor data wisata...');
            $count = Wisata::importFromJson($file);
            $this->info("Sukses! Sebanyak {$count} data wisata berhasil diimpor ke tabel lokasi_wisata.");
            return self::SUCCESS;
        } catch (\Throwable $e) {
            $this->error('Gagal mengimpor data: ' . $e->getMessage());
            return self::FAILURE;
        }
    }
}

