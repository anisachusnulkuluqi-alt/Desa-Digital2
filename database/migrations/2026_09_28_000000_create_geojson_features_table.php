<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geojson_features', function (Blueprint $table) {
            $table->id();
            $table->string('source_file', 120);
            $table->string('feature_id', 191)->nullable();
            $table->char('feature_key', 64);
            $table->string('geometry_type', 32)->nullable();
            $table->json('geometry')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();

            $table->unique(['source_file', 'feature_key']);
            $table->index(['source_file', 'geometry_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('geojson_features');
    }
};