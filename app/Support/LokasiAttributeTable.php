<?php

namespace App\Support;

use App\Models\Kategori;
use App\Models\KategoriField;
use App\Models\Tempat;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LokasiAttributeTable
{
    public static function nameForCategory(string $kategoriNama, ?int $kategoriId = null): string
    {
        $kategori = Str::slug($kategoriNama, '_') ?: 'kategori_'.($kategoriId ?? 'baru');
        $name = 'lokasi_'.$kategori;

        if (strlen($name) > 64) {
            $name = substr($name, 0, 55).'_'.substr(hash('sha256', $name), 0, 8);
        }

        return $name;
    }

    public static function name(KategoriField $field, ?string $kategoriNama = null): string
    {
        $kategoriNama ??= $field->kategori->nama;

        return self::nameForCategory($kategoriNama, $field->kategori_id);
    }

    public static function ensureCategoryFields(Kategori $kategori): void
    {
        $defaultFields = [
            'latitude' => 'number',
            'longitude' => 'number',
            'foto' => 'file',
        ];
        foreach ($defaultFields as $fieldName => $type) {
            $field = $kategori->fields()->where('nama_field', $fieldName)->first();
            if (! $field) {
                $field = $kategori->fields()->create([
                    'nama_field' => $fieldName,
                    'tipe_field' => $type,
                    'urutan' => $kategori->fields()->max('urutan') + 1,
                ]);
            }
        }

        foreach ($kategori->fields as $field) {
            self::create($field);
        }
    }

    public static function create(KategoriField $field): void
    {
        $tableName = self::name($field);
        self::ensureTable($tableName);

        if (! Schema::hasColumn($tableName, $field->nama_field)) {
            Schema::table($tableName, function (Blueprint $table) use ($field): void {
                if ($field->tipe_field === 'number' || in_array($field->nama_field, ['latitude', 'longitude'], true)) {
                    $table->decimal($field->nama_field, 20, 8)->nullable();
                } else {
                    $table->text($field->nama_field)->nullable();
                }
            });
        }

        $legacyTable = self::legacyName($field);
        if (Schema::hasTable($legacyTable)) {
            foreach (DB::table($legacyTable)->get(['tempat_id', 'nilai']) as $row) {
                self::save($field, (int) $row->tempat_id, $row->nilai);
            }
            Schema::drop($legacyTable);
        }

        $tempats = Tempat::where('kategori', $field->kategori->nama)->get(['id', 'info_tambahan']);
        foreach ($tempats as $tempat) {
            $values = $tempat->info_tambahan;
            if (is_array($values) && array_key_exists($field->nama_field, $values)) {
                self::save($field, $tempat->id, $values[$field->nama_field]);
            } elseif (in_array($field->nama_field, ['latitude', 'longitude'], true) && $tempat->{$field->nama_field} !== null) {
                self::save($field, $tempat->id, $tempat->{$field->nama_field});
            }
        }
    }

    public static function save(KategoriField $field, int $tempatId, mixed $value): void
    {
        $tableName = self::name($field);
        if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, $field->nama_field)) {
            self::create($field);
        }

        if (is_array($value)) {
            $value = json_encode($value, JSON_THROW_ON_ERROR);
        } elseif ($value !== null && ! is_scalar($value)) {
            throw new \InvalidArgumentException('Nilai atribut tempat harus berupa teks, angka, atau null.');
        }

        DB::table($tableName)->updateOrInsert(
            ['tempat_id' => $tempatId],
            [
                $field->nama_field => $value === null ? null : (string) $value,
                'updated_at' => now(),
            ]
        );
    }

    public static function delete(KategoriField $field): void
    {
        if (in_array($field->nama_field, ['latitude', 'longitude'], true)) {
            throw ValidationException::withMessages([
                'field' => 'Field latitude dan longitude wajib tersedia untuk menampilkan lokasi pada peta.',
            ]);
        }

        $tableName = self::name($field);
        $legacyTable = self::legacyName($field);
        if (Schema::hasTable($legacyTable)) {
            Schema::drop($legacyTable);
        }

        $hasOtherFields = KategoriField::where('kategori_id', $field->kategori_id)
            ->whereKeyNot($field->getKey())
            ->exists();

        if (! $hasOtherFields) {
            Schema::dropIfExists($tableName);

            return;
        }

        if (Schema::hasColumn($tableName, $field->nama_field)) {
            Schema::table($tableName, function (Blueprint $table) use ($field): void {
                $table->dropColumn($field->nama_field);
            });
        }
    }

    public static function deleteCategoryTables(Kategori $kategori): void
    {
        Schema::dropIfExists(self::nameForCategory($kategori->nama, $kategori->id));
        foreach ($kategori->fields as $field) {
            Schema::dropIfExists(self::legacyName($field));
        }
    }

    public static function renameCategoryTables(iterable $fields, string $newKategoriNama): void
    {
        $fields = is_array($fields) ? $fields : iterator_to_array($fields);
        foreach ($fields as $field) {
            self::create($field);
        }

        $renames = [];
        foreach ($fields as $field) {
            $oldTable = self::name($field);
            $newTable = self::name($field, $newKategoriNama);

            if ($oldTable === $newTable || ! Schema::hasTable($oldTable)) {
                continue;
            }

            if (Schema::hasTable($newTable)) {
                throw ValidationException::withMessages([
                    'nama' => 'Nama kategori baru bentrok dengan tabel atribut yang sudah ada.',
                ]);
            }

            $renames[$oldTable] = $newTable;
        }

        foreach ($renames as $oldTable => $newTable) {
            Schema::rename($oldTable, $newTable);
        }
    }

    public static function deleteTempatValues(Tempat $tempat): void
    {
        $kategori = Kategori::where('nama', $tempat->kategori)->first();
        if (! $kategori) {
            return;
        }

        $tableName = self::nameForCategory($kategori->nama, $kategori->id);
        if (Schema::hasTable($tableName)) {
            DB::table($tableName)->where('tempat_id', $tempat->id)->delete();
        }
    }

    private static function ensureTable(string $tableName): void
    {
        if (Schema::hasTable($tableName)) {
            return;
        }

        Schema::create($tableName, function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('tempat_id')->unique();
            $table->timestamps();
        });
    }

    private static function legacyName(KategoriField $field): string
    {
        $kategori = Str::slug($field->kategori->nama, '_') ?: 'kategori_'.$field->kategori_id;
        $attribute = Str::slug($field->nama_field, '_') ?: 'field_'.$field->id;
        $name = 'lokasi_'.$kategori.'_'.$attribute;

        if (strlen($name) > 64) {
            $name = substr($name, 0, 55).'_'.substr(hash('sha256', $name), 0, 8);
        }

        return $name;
    }
}
