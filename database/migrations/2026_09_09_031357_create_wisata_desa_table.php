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
            $table->string('nama_wisata', 150);
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->string('kategori', 50)->nullable(); // Alam, Budaya, Sejarah
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_tiket', 10, 2)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('foto_url', 255)->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisata_desa');
    }
};