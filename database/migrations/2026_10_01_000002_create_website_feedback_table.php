<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_feedback', function (Blueprint $table): void {
            $table->id();
            $table->char('visitor_hash', 64)->index();
            $table->unsignedTinyInteger('rating');
            $table->string('message', 500)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_feedback');
    }
};