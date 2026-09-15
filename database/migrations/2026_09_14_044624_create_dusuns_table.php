<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dusuns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dusun');
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->string('kepala_dusun')->nullable();
            $table->integer('jumlah_rt')->default(0);
            $table->integer('jumlah_rw')->default(0);
            $table->integer('jumlah_kk')->default(0);
            $table->integer('jumlah_penduduk')->default(0);
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dusuns');
    }
};