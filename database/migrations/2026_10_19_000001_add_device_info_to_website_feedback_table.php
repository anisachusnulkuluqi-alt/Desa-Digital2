<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('website_feedback', function (Blueprint $table): void {
            $table->string('device', 100)->nullable()->after('pekerjaan');
            $table->string('browser', 50)->nullable()->after('device');
            $table->string('user_agent', 500)->nullable()->after('browser');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_feedback', function (Blueprint $table): void {
            $table->dropColumn(['device', 'browser', 'user_agent']);
        });
    }
};

