<?php

namespace Tests\Feature\Admin;

use App\Models\SurveiKepuasan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SurveiKepuasanTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_public_survey_page(): void
    {
        $response = $this->get(route('survei.public'));

        $response->assertOk()
            ->assertSee('Survei Kepuasan Masyarakat')
            ->assertSee('Kirim Penilaian Survei');
    }

    public function test_public_user_can_submit_satisfaction_survey(): void
    {
        $payload = [
            'rating' => 5,
            'nama' => 'Ahmad Dahlan',
            'pekerjaan' => 'Masyarakat Desa',
            'message' => 'Layanan website desa sangat membantu dan mudah dipahami.',
        ];

        $response = $this->post(route('survei.submit'), $payload);

        $response->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('website_feedback', [
            'rating' => 5,
            'nama' => 'Ahmad Dahlan',
            'pekerjaan' => 'Masyarakat Desa',
            'message' => 'Layanan website desa sangat membantu dan mudah dipahami.',
        ]);
    }

    public function test_public_user_can_submit_via_json_api(): void
    {
        $payload = [
            'rating' => 4,
            'nama' => 'Siti Nurhaliza',
            'pekerjaan' => 'Pelajar / Mahasiswa',
            'message' => 'Fitur peta sangat informatif.',
        ];

        $response = $this->postJson(route('website-feedback.store'), $payload);

        $response->assertCreated()
            ->assertJsonStructure(['message']);

        $this->assertDatabaseHas('website_feedback', [
            'rating' => 4,
            'nama' => 'Siti Nurhaliza',
            'pekerjaan' => 'Pelajar / Mahasiswa',
        ]);
    }

    public function test_admin_can_view_survei_kepuasan_page_with_data_and_stats(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        SurveiKepuasan::create([
            'visitor_hash' => 'hash123',
            'rating' => 5,
            'nama' => 'Budi Santoso',
            'pekerjaan' => 'Masyarakat Desa',
            'message' => 'Sangat memuaskan pelayanannya.',
        ]);

        SurveiKepuasan::create([
            'visitor_hash' => 'hash456',
            'rating' => 4,
            'nama' => 'Citra Dewi',
            'pekerjaan' => 'Perangkat Desa',
            'message' => 'Website cepat dan responsif.',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.survei.index'));

        $response->assertOk()
            ->assertSee('Survei Kepuasan')
            ->assertSee('Budi Santoso')
            ->assertSee('Citra Dewi')
            ->assertSee('Spasial (Master)');
    }

    public function test_admin_can_filter_survei_by_rating_and_search(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        SurveiKepuasan::create([
            'visitor_hash' => 'h1',
            'rating' => 1,
            'nama' => 'Joko',
            'pekerjaan' => 'Umum',
            'message' => 'Loading lambat saat buka web.',
        ]);

        SurveiKepuasan::create([
            'visitor_hash' => 'h2',
            'rating' => 5,
            'nama' => 'Bambang',
            'pekerjaan' => 'Masyarakat Desa',
            'message' => 'Bagus sekali informasinya.',
        ]);

        // Filter rating 1
        $responseRating = $this->actingAs($admin)->get(route('admin.survei.index', ['rating' => 1]));
        $responseRating->assertOk()
            ->assertSee('Joko')
            ->assertDontSee('Bambang');

        // Search Joko
        $responseSearch = $this->actingAs($admin)->get(route('admin.survei.index', ['search' => 'lambat']));
        $responseSearch->assertOk()
            ->assertSee('Joko')
            ->assertDontSee('Bambang');
    }

    public function test_admin_can_delete_survei(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $survei = SurveiKepuasan::create([
            'visitor_hash' => 'hash_spam',
            'rating' => 1,
            'nama' => 'Spammer',
            'message' => 'Spam content',
        ]);

        $response = $this->actingAs($admin)->delete(route('admin.survei.destroy', $survei->id));

        $response->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('website_feedback', [
            'id' => $survei->id,
        ]);
    }

    public function test_admin_can_export_survei_csv(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        SurveiKepuasan::create([
            'visitor_hash' => 'hash_csv',
            'rating' => 5,
            'nama' => 'Responden Ekspor',
            'message' => 'Pesan untuk diekspor',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.survei.export'));

        $response->assertOk()
            ->assertHeader('Content-Type', 'text/csv; charset=UTF-8');

        $content = $response->streamedContent();
        $this->assertStringContainsString('Responden Ekspor', $content);
        $this->assertStringContainsString('Pesan untuk diekspor', $content);
    }

    public function test_unauthenticated_user_cannot_access_admin_survei(): void
    {
        $response = $this->get(route('admin.survei.index'));
        $response->assertRedirect(route('login'));
    }
}
