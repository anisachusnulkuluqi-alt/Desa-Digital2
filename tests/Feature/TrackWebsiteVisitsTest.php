<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TrackWebsiteVisitsTest extends TestCase
{
    use RefreshDatabase;

    public function test_first_visit_records_one_visit(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertCookie('website_visitor_id');

        $this->assertEquals(1, DB::table('website_visits')->count());
    }

    public function test_multiple_page_visits_by_same_user_still_only_counts_as_one(): void
    {
        // 1st visit
        $response1 = $this->get('/');
        $response1->assertOk();
        $cookieValue = $response1->getCookie('website_visitor_id')->getValue();

        $this->assertEquals(1, DB::table('website_visits')->count());

        // 2nd visit to another page with the same cookie
        $response2 = $this->withCookie('website_visitor_id', $cookieValue)->get('/data-spasial');
        $response2->assertOk();

        // Count must still be 1!
        $this->assertEquals(1, DB::table('website_visits')->count());

        // 3rd visit back to home
        $response3 = $this->withCookie('website_visitor_id', $cookieValue)->get('/');
        $response3->assertOk();

        // Count must still be 1!
        $this->assertEquals(1, DB::table('website_visits')->count());
    }

    public function test_different_visitors_are_counted_separately(): void
    {
        // User 1
        $this->withCookie('website_visitor_id', 'visitor_user_one_1111111111111111111111111111111111111111111111111111111111111111')
            ->get('/');

        // User 2
        $this->withCookie('website_visitor_id', 'visitor_user_two_2222222222222222222222222222222222222222222222222222222222222222')
            ->get('/');

        $this->assertEquals(2, DB::table('website_visits')->count());
    }

    public function test_accessibility_menu_is_rendered_in_floating_tools(): void
    {
        $response = $this->get('/');
        $response->assertOk();

        // Check accessibility toggle button
        $response->assertSee('id="accessibility-toggle"', false);
        $response->assertSee('fa-universal-access', false);

        // Check accessibility panel and options
        $response->assertSee('id="accessibility-panel"', false);
        $response->assertSee('Aksesibilitas', false);
        $response->assertSee('data-access-font="sm"', false);
        $response->assertSee('data-access-font="normal"', false);
        $response->assertSee('data-access-font="lg"', false);
        $response->assertSee('data-access-font="xl"', false);
        $response->assertSee('data-access-contrast="high"', false);
        $response->assertSee('data-access-contrast="grayscale"', false);
        $response->assertSee('data-access-cb="normal"', false);
        $response->assertSee('data-access-cb="deuteranopia"', false);
        $response->assertSee('data-access-cb="protanopia"', false);
        $response->assertSee('data-access-cb="tritanopia"', false);
        $response->assertSee('id="access-filter-protanopia"', false);
        $response->assertSee('id="access-filter-deuteranopia"', false);
        $response->assertSee('id="access-filter-tritanopia"', false);
        $response->assertSee('id="access-toggle-dyslexic"', false);
        $response->assertSee('id="access-toggle-underline"', false);
        $response->assertSee('id="accessibility-reset"', false);
    }
}

