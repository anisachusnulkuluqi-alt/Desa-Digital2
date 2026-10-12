<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('lokasi_wisata', function (Blueprint $table): void {
            if (!Schema::hasColumn('lokasi_wisata', 'desa')) {
                $table->string('desa')->nullable()->after('nama_lokasi');
            }
            if (!Schema::hasColumn('lokasi_wisata', 'jenis_wisata')) {
                $table->string('jenis_wisata')->nullable()->after('desa');
            }
            if (!Schema::hasColumn('lokasi_wisata', 'jam_operasional')) {
                $table->string('jam_operasional')->nullable()->after('jenis_wisata');
            }
            if (!Schema::hasColumn('lokasi_wisata', 'htm')) {
                $table->string('htm')->nullable()->after('jam_operasional');
            }
            if (!Schema::hasColumn('lokasi_wisata', 'reservasi')) {
                $table->string('reservasi')->nullable()->after('htm');
            }
            if (!Schema::hasColumn('lokasi_wisata', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('reservasi');
            }
            if (!Schema::hasColumn('lokasi_wisata', 'foto')) {
                $table->text('foto')->nullable()->after('deskripsi');
            }
        });

        // Migrasikan data yang ada di kolom JSON properties ke kolom fisik baru
        $records = DB::table('lokasi_wisata')->get();
        foreach ($records as $row) {
            $props = [];
            if (!empty($row->properties)) {
                $props = is_string($row->properties) ? json_decode($row->properties, true) : (array) $row->properties;
            }

            if (is_array($props) && !empty($props)) {
                $updates = [];

                if (empty($row->desa)) {
                    $updates['desa'] = $props['desa'] ?? $props['Desa'] ?? $props['nama_desa'] ?? null;
                }
                if (empty($row->jenis_wisata)) {
                    $updates['jenis_wisata'] = $props['jenis_wisata'] ?? $props['jenis'] ?? $props['Jenis'] ?? null;
                }
                if (empty($row->jam_operasional)) {
                    $rawJam = $props['jam_operasional'] ?? $props['jam_operas'] ?? $props['Jam'] ?? $props['Jam Operasional'] ?? null;
                    if ($rawJam !== null) {
                        $rawJam = str_replace(["\x96", "\u{0096}", "\u{2013}", "\u{2014}", 'â€“', 'â€”', '–', '—'], ' - ', (string) $rawJam);
                        $rawJam = preg_replace('/\s+-\s+/', ' - ', $rawJam);
                    }
                    $updates['jam_operasional'] = $rawJam;
                }
                if (empty($row->htm)) {
                    $updates['htm'] = isset($props['htm']) ? (string) $props['htm'] : ($props['HTM'] ?? $props['Harga'] ?? null);
                }
                if (empty($row->reservasi)) {
                    $updates['reservasi'] = $props['reservasi'] ?? $props['Reservasi'] ?? $props['kontak'] ?? null;
                }
                if (empty($row->deskripsi)) {
                    $updates['deskripsi'] = $props['deskripsi'] ?? $props['Deskripsi'] ?? null;
                }
                if (empty($row->foto)) {
                    $updates['foto'] = $props['foto'] ?? $props['Foto'] ?? $props['image'] ?? null;
                }

                $filteredUpdates = array_filter($updates, fn ($val) => $val !== null);
                if (!empty($filteredUpdates)) {
                    DB::table('lokasi_wisata')->where('id', $row->id)->update($filteredUpdates);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lokasi_wisata', function (Blueprint $table): void {
            $columns = [
                'desa',
                'jenis_wisata',
                'jam_operasional',
                'htm',
                'reservasi',
                'deskripsi',
                'foto',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('lokasi_wisata', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
