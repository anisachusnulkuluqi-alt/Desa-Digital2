<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMobileResponsiveTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pages_contain_mobile_responsive_elements(): void
    {
        $admin = User::factory()->create([
            'email_verified_at' => now(),
            'role' => User::ROLE_ADMIN,
        ]);

        $routesToTest = [
            'dashboard',
            'admin.wisata.index',
            'admin.survei.index',
            'admin.kontributor.index',
            'admin.tempat.index',
            'admin.bumdes.index',
        ];

        foreach ($routesToTest as $routeName) {
            $response = $this->actingAs($admin)->get(route($routeName));

            $response->assertOk()
                ->assertSee('name="viewport"', false)
                ->assertSee('id="adminSidebarCloseBtn"', false)
                ->assertSee('id="adminSidebarBackdrop"', false)
                ->assertSee('admin-sidebar-mobile-open', false)
                ->assertSee('sidebar-backdrop', false)
                ->assertSee('admin-mobile-toggle', false)
                ->assertSee('js/admin-sidebar-toggle.js', false);
        }
    }

    public function test_admin_sidebar_toggle_script_contains_mobile_handlers(): void
    {
        $scriptPath = public_path('js/admin-sidebar-toggle.js');
        $this->assertFileExists($scriptPath);

        $scriptContent = file_get_contents($scriptPath);
        $this->assertStringContainsString('adminMobileSidebarToggle', $scriptContent);
        $this->assertStringContainsString('adminSidebarCloseBtn', $scriptContent);
        $this->assertStringContainsString('adminSidebarBackdrop', $scriptContent);
        $this->assertStringContainsString('admin-sidebar-mobile-open', $scriptContent);
    }
}

