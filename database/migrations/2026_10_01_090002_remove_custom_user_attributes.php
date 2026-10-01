<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('users', 'custom_attributes')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('custom_attributes');
            });
        }

        Schema::dropIfExists('user_attribute_definitions');
    }

    public function down(): void
    {
        if (! Schema::hasTable('user_attribute_definitions')) {
            Schema::create('user_attribute_definitions', function (Blueprint $table) {
                $table->id();
                $table->string('label', 100);
                $table->string('key', 100)->unique();
                $table->string('type', 20);
                $table->boolean('is_required')->default(false);
                $table->json('options')->nullable();
                $table->timestamps();
            });
        }

        if (! Schema::hasColumn('users', 'custom_attributes')) {
            Schema::table('users', function (Blueprint $table) {
                $table->json('custom_attributes')->nullable();
            });
        }
    }
};