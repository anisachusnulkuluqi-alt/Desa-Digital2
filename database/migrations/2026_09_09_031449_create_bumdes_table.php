<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bumdes', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bumdes', 150);
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->string('jenis_usaha', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->year('tahun_berdiri')->nullable();
            $table->enum('status', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bumdes');
    }
};