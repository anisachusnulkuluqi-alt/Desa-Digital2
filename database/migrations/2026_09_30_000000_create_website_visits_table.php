<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_visits', function (Blueprint $table): void {
            $table->id();
            $table->char('visitor_hash', 64);
            $table->date('visited_on');
            $table->timestamps();
            $table->unique(['visitor_hash', 'visited_on']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_visits');
    }
};