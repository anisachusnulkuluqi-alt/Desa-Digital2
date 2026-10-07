<?php

namespace Tests\Feature\Admin;

use App\Models\Kategori;
use App\Models\Tempat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class TempatAttributeTablesTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_location_category_has_default_coordinates_and_is_available_on_the_map(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $this->actingAs($admin)
            ->postJson(route('admin.tempat.kategori.store'), ['nama' => 'desa wisata'])
            ->assertOk()
            ->assertJsonPath('table', 'lokasi_desa_wisata');

        $kategori = Kategori::where('nama', 'desa wisata')->firstOrFail();
        $this->assertSame(
            ['latitude', 'longitude', 'foto'],
            $kategori->fields()->pluck('nama_field')->all()
        );
        $this->assertTrue(Schema::hasColumn('lokasi_desa_wisata', 'latitude'));
        $this->assertTrue(Schema::hasColumn('lokasi_desa_wisata', 'longitude'));
        $this->assertTrue(Schema::hasColumn('lokasi_desa_wisata', 'foto'));
        $this->assertSame(
            'file',
            $kategori->fields()->where('nama_field', 'foto')->value('tipe_field')
        );

        $latitudeField = $kategori->fields()->where('nama_field', 'latitude')->firstOrFail();
        $this->deleteJson(route('admin.tempat.field.destroy', ['id' => $latitudeField->id]))
            ->assertUnprocessable();

        $this->postJson(route('admin.tempat.field.store'), [
            'kategori_id' => $kategori->id,
            'nama_field' => 'alamat',
            'tipe_field' => 'text',
        ])->assertOk();

        $this->postJson(route('admin.tempat.data.store'), [
            'kategori' => 'desa wisata',
            'nama' => 'Tanpa koordinat',
        ])->assertUnprocessable();
        $this->assertDatabaseCount('tempat', 0);

        Storage::fake('public');
        $this->post(route('admin.tempat.data.store'), [
            'kategori' => 'desa wisata',
            'nama' => 'Air Terjun Uji',
            'latitude' => '-6.9',
            'longitude' => '111.8',
            'alamat' => 'Desa Uji',
            'foto' => UploadedFile::fake()->image('air-terjun.jpg'),
        ], ['Accept' => 'application/json'])->assertOk()->assertJsonPath('success', true);

        $photoPath = DB::table('lokasi_desa_wisata')->value('foto');
        $this->assertNotEmpty($photoPath);
        Storage::disk('public')->assertExists($photoPath);

        $this->getJson(route('data.spasial.locations', ['kategori' => 'desa_wisata']))
            ->assertOk()
            ->assertJsonPath('features.0.properties.nama', 'Air Terjun Uji')
            ->assertJsonPath('features.0.properties.latitude', -6.9)
            ->assertJsonPath('features.0.properties.longitude', 111.8)
            ->assertJsonPath('features.0.properties.alamat', 'Desa Uji')
            ->assertJsonPath('features.0.properties.foto', $photoPath)
            ->assertJsonPath('features.0.geometry.coordinates', [111.8, -6.9]);

        $this->get(route('data.spasial'))
            ->assertOk()
            ->assertSee('chip-desa_wisata')
            ->assertSee('const customSpatialSources', false)
            ->assertSee('customSpatialMeta[type] ? customFields : []', false);
    }

    public function test_custom_attributes_create_columns_in_a_shared_category_table(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $kategori = Kategori::create(['nama' => 'p']);
        $this->actingAs($admin);

        $this->postJson(route('admin.tempat.field.store'), [
            'kategori_id' => $kategori->id,
            'nama_field' => 'kode_dokumen',
            'tipe_field' => 'text',
        ])->assertOk()
            ->assertJsonPath('table', 'lokasi_p');

        $tableName = 'lokasi_p';
        $this->assertTrue(Schema::hasTable($tableName));
        $this->assertTrue(Schema::hasColumn($tableName, 'kode_dokumen'));

        $this->postJson(route('admin.tempat.field.store'), [
            'kategori_id' => $kategori->id,
            'nama_field' => 'pemilik',
            'tipe_field' => 'text',
        ])->assertOk()->assertJsonPath('table', $tableName);
        $this->assertTrue(Schema::hasColumn($tableName, 'pemilik'));

        $this->postJson(route('admin.tempat.data.store'), [
            'kategori' => $kategori->nama,
            'nama' => 'Arsip Desa',
            'latitude' => '-6.9',
            'longitude' => '111.8',
            'kode_dokumen' => 'DOC-001',
            'pemilik' => 'Budi',
        ])->assertOk()->assertJsonPath('success', true);

        $tempat = Tempat::firstOrFail();
        $this->assertSame(
            'DOC-001',
            DB::table($tableName)->where('tempat_id', $tempat->id)->value('kode_dokumen')
        );
        $this->assertSame('Budi', DB::table($tableName)->where('tempat_id', $tempat->id)->value('pemilik'));

        $this->putJson(route('admin.tempat.update', ['id' => $tempat->id]), [
            'nama' => 'Arsip Desa Baru',
            'latitude' => '-6.8',
            'longitude' => '111.9',
            'kode_dokumen' => 'DOC-002',
            'pemilik' => 'Siti',
        ])->assertOk()->assertJsonPath('success', true);

        $this->assertSame(
            'DOC-002',
            DB::table($tableName)->where('tempat_id', $tempat->id)->value('kode_dokumen')
        );
        $this->assertSame('Siti', DB::table($tableName)->where('tempat_id', $tempat->id)->value('pemilik'));

        $this->putJson(route('admin.tempat.kategori.update', ['id' => $kategori->id]), [
            'nama' => 'p umum',
        ])->assertOk()->assertJsonPath('success', true);

        $renamedTable = 'lokasi_p_umum';
        $this->assertFalse(Schema::hasTable($tableName));
        $this->assertTrue(Schema::hasTable($renamedTable));
        $this->assertSame('p umum', $tempat->fresh()->kategori);
        $this->assertSame(
            'DOC-002',
            DB::table($renamedTable)->where('tempat_id', $tempat->id)->value('kode_dokumen')
        );

        $this->deleteJson(route('admin.tempat.destroy', ['id' => $tempat->id]))
            ->assertOk()->assertJsonPath('success', true);
        $this->assertDatabaseMissing($renamedTable, ['tempat_id' => $tempat->id]);

        $fieldId = $kategori->fields()->where('nama_field', 'pemilik')->firstOrFail()->id;
        $this->deleteJson(route('admin.tempat.field.destroy', ['id' => $fieldId]))
            ->assertOk()->assertJsonPath('success', true);
        $this->assertTrue(Schema::hasTable($renamedTable));
        $this->assertFalse(Schema::hasColumn($renamedTable, 'pemilik'));
        $this->assertTrue(Schema::hasColumn($renamedTable, 'kode_dokumen'));

        $fieldId = $kategori->fields()->where('nama_field', 'kode_dokumen')->firstOrFail()->id;
        $this->deleteJson(route('admin.tempat.field.destroy', ['id' => $fieldId]))
            ->assertOk()->assertJsonPath('success', true);
        $this->assertTrue(Schema::hasTable($renamedTable));
        $this->assertTrue(Schema::hasColumn($renamedTable, 'latitude'));
        $this->assertTrue(Schema::hasColumn($renamedTable, 'longitude'));
    }
}
