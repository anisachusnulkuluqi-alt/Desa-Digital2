<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const COLUMNS = [
        'website' => 255,
        'youtube' => 255,
        'instagram' => 255,
        'facebook' => 255,
        'tiktok' => 255,
        'whatsapp' => 50,
    ];

    public function up(): void
    {
        $missingColumns = array_filter(
            array_keys(self::COLUMNS),
            fn (string $column): bool => ! Schema::hasColumn('desa', $column)
        );

        if ($missingColumns === []) {
            return;
        }

        Schema::table('desa', function (Blueprint $table) use ($missingColumns): void {
            foreach ($missingColumns as $column) {
                $table->string($column, self::COLUMNS[$column])->nullable();
            }
        });
    }

    public function down(): void
    {
        $existingColumns = array_filter(
            array_keys(self::COLUMNS),
            fn (string $column): bool => Schema::hasColumn('desa', $column)
        );

        if ($existingColumns === []) {
            return;
        }

        Schema::table('desa', function (Blueprint $table) use ($existingColumns): void {
            $table->dropColumn($existingColumns);
        });
    }
};