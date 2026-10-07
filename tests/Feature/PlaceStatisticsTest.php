<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Tempat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlaceStatisticsTest extends TestCase
{
    use RefreshDatabase;

    public function test_statistics_show_existing_summary_tiles_when_master_has_no_categories(): void
    {
        $this->getJson(route('place-statistics'))
            ->assertOk()
            ->assertJsonCount(8, 'categories')
            ->assertJsonPath('categories.0.name', 'wifi')
            ->assertJsonPath('categories.0.label', 'Titik WiFi')
            ->assertJsonPath('categories.0.count', 0);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Titik WiFi')
            ->assertSee('data-core="true"', false)
            ->assertSee('id="stats-carousel-prev"', false)
            ->assertSee('id="stats-carousel-next"', false);
    }

    public function test_homepage_shows_public_services_before_live_place_statistics(): void
    {
        $kategori = Kategori::create(['nama' => 'wisata desa']);
        Tempat::create([
            'nama' => 'Pantai Boom',
            'kategori' => $kategori->nama,
        ]);

        $response = $this->get(route('home'))->assertOk();
        $content = $response->getContent();

        $this->assertLessThan(
            strpos($content, 'id="statistik-wilayah"'),
            strpos($content, 'id="layanan-digital"')
        );
        $response->assertSee('data-category="wisata"', false)
            ->assertSee('data-count="1"', false);
    }

    public function test_place_statistics_endpoint_reflects_master_categories_and_place_changes(): void
    {
        $kategori = Kategori::create(['nama' => 'wisata']);
        $this->getJson(route('place-statistics'))
            ->assertOk()
            ->assertJsonCount(8, 'categories')
            ->assertJsonPath('categories.2.name', 'wisata')
            ->assertJsonPath('categories.2.count', 0)
            ->assertJsonPath('categories.2.is_core', true);

        Tempat::create([
            'nama' => 'Pantai Boom',
            'kategori' => $kategori->nama,
        ]);
        Tempat::create([
            'nama' => 'Pantai Boom Lama',
            'kategori' => ' WISATA ',
        ]);

        $newKategori = Kategori::create(['nama' => 'masjid']);
        Tempat::create([
            'nama' => 'Masjid Al Ikhlas',
            'kategori' => $newKategori->nama,
        ]);

        $this->getJson(route('place-statistics'))
            ->assertOk()
            ->assertJsonCount(9, 'categories')
            ->assertJsonPath('categories.2.name', 'wisata')
            ->assertJsonPath('categories.2.count', 2)
            ->assertJsonPath('categories.2.is_core', true)
            ->assertJsonPath('categories.8.name', 'masjid')
            ->assertJsonPath('categories.8.count', 1)
            ->assertJsonPath('categories.8.is_core', false);
    }
}
