<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wisata_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->string('desa')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('htm')->nullable();
            $table->string('reservasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('foto')->nullable();
            $table->string('alt')->nullable();
            $table->string('jenis_wisata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata_desa');
    }
};