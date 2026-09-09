<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wifi_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lokasi', 150);
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('kecepatan_mbps')->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wifi_desa');
    }
};