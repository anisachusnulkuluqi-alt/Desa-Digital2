<?php

namespace Tests\Feature\Admin;

use App\Models\Kategori;
use App\Models\KategoriField;
use App\Models\Tempat;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TempatCustomFieldsTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_popup_can_load_add_and_remove_custom_fields(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $kategori = Kategori::create(['nama' => 'tempat ibadah umat islam']);

        $this->actingAs($admin)
            ->getJson(route('admin.tempat.kategori.fields.json', ['kategori' => $kategori->nama]))
            ->assertOk()
            ->assertJsonPath('success', true)
            ->assertJsonPath('kategori_id', $kategori->id)
            ->assertJsonPath('fields', []);

        $this->postJson(route('admin.tempat.field.store'), [
            'kategori_id' => $kategori->id,
            'nama_field' => 'nama_pengurus',
            'tipe_field' => 'text',
        ])->assertOk()->assertJsonPath('success', true);

        $field = KategoriField::where('kategori_id', $kategori->id)->firstOrFail();
        $this->getJson(route('admin.tempat.kategori.fields.json', ['kategori' => $kategori->nama]))
            ->assertOk()
            ->assertJsonPath('fields.0.id', $field->id)
            ->assertJsonPath('fields.0.nama_field', 'nama_pengurus');

        $this->deleteJson(route('admin.tempat.field.destroy', ['id' => $field->id]))
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseMissing('kategori_fields', ['id' => $field->id]);
    }

    public function test_legacy_category_url_redirects_to_master_and_opens_that_category(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        Kategori::create(['nama' => 'tempat ibadah umat islam']);

        $this->actingAs($admin)
            ->get(route('admin.tempat.kategori', ['kategori' => 'tempat ibadah umat islam']))
            ->assertRedirect(route('admin.tempat.index', ['open_kategori' => 'tempat ibadah umat islam']));
    }

    public function test_category_management_page_has_no_default_data_fields(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $kategori = Kategori::create(['nama' => 'arsip']);
        KategoriField::create([
            'kategori_id' => $kategori->id,
            'nama_field' => 'kode_dokumen',
            'tipe_field' => 'text',
            'urutan' => 1,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.tempat.index'))
            ->assertOk()
            ->assertSee('name="nama_field"', false)
            ->assertSee('openKategoriPopup(kategoriToOpen)', false)
            ->assertDontSee('name="desa"', false)
            ->assertDontSee('name="alamat"', false)
            ->assertDontSee('name="latitude"', false)
            ->assertDontSee('name="longitude"', false)
            ->assertDontSee('name="deskripsi"', false)
            ->assertDontSee('name="namaDataBaru"', false);
    }

    public function test_data_is_saved_using_only_the_categories_configured_fields(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        $kategori = Kategori::create(['nama' => 'arsip']);
        KategoriField::create([
            'kategori_id' => $kategori->id,
            'nama_field' => 'kode_dokumen',
            'tipe_field' => 'text',
            'urutan' => 1,
        ]);

        $this->actingAs($admin)
            ->postJson(route('admin.tempat.data.store'), [
                'kategori' => 'arsip',
                'fields' => ['kode_dokumen' => 'DOC-001'],
                'desa' => 'Tidak disimpan',
            ])
            ->assertOk()
            ->assertJsonPath('success', true);

        $tempat = Tempat::firstOrFail();
        $this->assertNull($tempat->nama);
        $this->assertSame(['kode_dokumen' => 'DOC-001'], $tempat->info_tambahan);
    }

    public function test_data_cannot_be_saved_until_custom_fields_are_configured(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);
        Kategori::create(['nama' => 'kosong']);

        $this->actingAs($admin)
            ->postJson(route('admin.tempat.data.store'), ['kategori' => 'kosong'])
            ->assertUnprocessable()
            ->assertJsonPath('success', false);

        $this->assertDatabaseCount('tempat', 0);
    }
}
