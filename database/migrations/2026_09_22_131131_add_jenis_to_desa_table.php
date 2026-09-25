<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('desa', function (Blueprint $table) {
            $table->string('jenis', 20)->default('Desa')->after('kecamatan_id');
        });
    }

    public function down()
    {
        Schema::table('desa', function (Blueprint $table) {
            $table->dropColumn('jenis');
        });
    }
};