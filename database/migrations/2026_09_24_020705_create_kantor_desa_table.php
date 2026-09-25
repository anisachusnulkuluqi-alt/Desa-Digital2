<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kantor_desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kantor');
            $table->text('alamat')->nullable();
            $table->unsignedBigInteger('desa_id')->nullable();
            $table->string('telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('jam_operasional')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            
            $table->foreign('desa_id')->references('id')->on('desa')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kantor_desa');
    }
};