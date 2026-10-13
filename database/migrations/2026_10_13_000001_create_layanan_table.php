<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 120);
            $table->string('link', 2048);
            $table->timestamps();
        });

        $now = now();
        DB::table('layanan')->insert([
            ['nama' => 'Website Desa', 'link' => '/website', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Data Spasial', 'link' => '/data-spasial', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'Surat Desa', 'link' => 'https://apmd.tubankab.go.id/', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'CCTV', 'link' => 'https://cctv.tubankab.go.id/', 'created_at' => $now, 'updated_at' => $now],
            ['nama' => 'e-PBB', 'link' => 'https://pbb.tubankab.go.id/', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
