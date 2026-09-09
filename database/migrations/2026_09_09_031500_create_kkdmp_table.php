<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kkdmp', function (Blueprint $table) {
            $table->id();
            $table->string('judul_dokumen', 200);
            $table->foreignId('desa_id')->constrained('desa')->onDelete('cascade');
            $table->year('tahun')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_url', 255)->nullable();
            $table->enum('status', ['Draft', 'Published', 'Archived'])->default('Draft');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kkdmp');
    }
};