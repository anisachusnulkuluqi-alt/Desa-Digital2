<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        foreach ($this->categoryTables() as $tableName) {
            if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, 'tempat_id')) {
                continue;
            }

            if (! Schema::hasColumn($tableName, 'nama_lokasi')) {
                Schema::table($tableName, function (Blueprint $table): void {
                    $table->string('nama_lokasi')->nullable();
                });
            }

            $locations = DB::table($tableName)
                ->join('tempat', 'tempat.id', '=', $tableName.'.tempat_id')
                ->get([$tableName.'.tempat_id', 'tempat.nama as nama_lokasi']);

            foreach ($locations as $location) {
                DB::table($tableName)
                    ->where('tempat_id', $location->tempat_id)
                    ->update(['nama_lokasi' => $location->nama_lokasi]);
            }
        }
    }

    public function down(): void
    {
        foreach ($this->categoryTables() as $tableName) {
            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'nama_lokasi')) {
                Schema::table($tableName, function (Blueprint $table): void {
                    $table->dropColumn('nama_lokasi');
                });
            }
        }
    }

    private function categoryTables(): array
    {
        if (! Schema::hasTable('kategoris')) {
            return [];
        }

        return DB::table('kategoris')
            ->get(['id', 'nama'])
            ->map(function (object $kategori): string {
                $slug = Str::slug($kategori->nama, '_') ?: 'kategori_'.$kategori->id;
                $tableName = 'lokasi_'.$slug;

                if (strlen($tableName) > 64) {
                    $tableName = substr($tableName, 0, 55).'_'.substr(hash('sha256', $tableName), 0, 8);
                }

                return $tableName;
            })
            ->unique()
            ->values()
            ->all();
    }
};
