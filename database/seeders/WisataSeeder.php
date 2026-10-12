<?php

namespace Database\Seeders;

use App\Models\Wisata;
use Illuminate\Database\Seeder;

class WisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = Wisata::importFromJson();
        $this->command?->info("Berhasil mengimpor {$count} data wisata dari wisata.json ke tabel lokasi_wisata.");
    }
}

