<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fungsi ini dijalankan saat kita execute "php artisan migrate"
     */
    public function up(): void
    {
        // Perintah untuk membuat tabel 'kecamatan'
        Schema::create('kecamatan', function (Blueprint $table) {
            $table->id(); // Kolom id (primary key, auto increment)
            $table->string('nama_kecamatan', 100); // Kolom nama_kecamatan, max 100 karakter
            $table->string('kode_wilayah', 20)->unique(); // Kolom kode_wilayah, harus unik
            $table->timestamps(); // Kolom created_at dan updated_at (otomatis)
        });
    }

    /**
     * Reverse the migrations.
     * Fungsi ini dijalankan saat kita execute "php artisan migrate:rollback"
     */
    public function down(): void
    {
        // Perintah untuk menghapus tabel 'kecamatan'
        Schema::dropIfExists('kecamatan');
    }
};