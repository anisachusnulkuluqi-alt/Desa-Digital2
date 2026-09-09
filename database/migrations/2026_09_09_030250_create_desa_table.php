<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa', 100);
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->onDelete('cascade');
            $table->string('kode_desa', 20)->unique();
            $table->decimal('luas_wilayah', 10, 2)->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->integer('jumlah_kk')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('alamat_kantor')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('email', 100)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('foto_url', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};