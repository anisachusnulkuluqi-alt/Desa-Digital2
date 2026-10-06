<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tempat', function (Blueprint $table) {
            $table->string('nama')->nullable()->change();
        });
    }

    public function down(): void
    {
        DB::table('tempat')->whereNull('nama')->update(['nama' => '']);

        Schema::table('tempat', function (Blueprint $table) {
            $table->string('nama')->nullable(false)->change();
        });
    }
};
