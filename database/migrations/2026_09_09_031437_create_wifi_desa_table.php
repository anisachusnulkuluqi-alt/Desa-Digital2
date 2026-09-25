<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wifi_desa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_id')->nullable();
            $table->string('nama_ssid');
            $table->string('fasilitator')->nullable();
            $table->text('alamat')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('wifi_desa');
    }
};