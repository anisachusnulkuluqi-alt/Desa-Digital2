<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            'lokasi_wifi',
            'lokasi_kantor',
            'lokasi_pasar',
            'lokasi_wisata',
            'lokasi_bumdes',
            'lokasi_kkdmp',
        ] as $tableName) {
            Schema::create($tableName, function (Blueprint $table): void {
                $table->id();
                $table->string('feature_id', 191)->nullable();
                $table->char('feature_key', 64)->unique();
                $table->string('nama_lokasi')->nullable();
                $table->text('alamat')->nullable();
                $table->double('latitude')->nullable();
                $table->double('longitude')->nullable();
                $table->json('properties')->nullable();
                $table->timestamps();

                $table->index(['latitude', 'longitude']);
            });
        }
    }

    public function down(): void
    {
        foreach ([
            'lokasi_kkdmp',
            'lokasi_bumdes',
            'lokasi_wisata',
            'lokasi_pasar',
            'lokasi_kantor',
            'lokasi_wifi',
        ] as $tableName) {
            Schema::dropIfExists($tableName);
        }
    }
};