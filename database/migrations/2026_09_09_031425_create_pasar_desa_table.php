<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasar_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pasar', 150);
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->text('alamat')->nullable();
            $table->string('hari_operasional', 100)->nullable();
            $table->text('komoditas_utama')->nullable();
            $table->integer('jumlah_pedagang')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasar_desa');
    }
};