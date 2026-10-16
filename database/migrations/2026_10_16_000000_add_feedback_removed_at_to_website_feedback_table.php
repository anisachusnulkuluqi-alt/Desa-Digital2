<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('website_feedback', function (Blueprint $table): void {
            $table->timestamp('feedback_removed_at')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('website_feedback', function (Blueprint $table): void {
            $table->dropColumn('feedback_removed_at');
        });
    }
};
