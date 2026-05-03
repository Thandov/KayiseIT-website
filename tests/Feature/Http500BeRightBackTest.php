<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use RuntimeException;
use Tests\TestCase;

class Http500BeRightBackTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->get('_testing/trigger-500', function () {
            throw new RuntimeException('intentional test exception');
        });
    }

    public function test_guest_sees_be_right_back_html_on_500(): void
    {
        $response = $this->get('/_testing/trigger-500');

        $response->assertStatus(500);
        $response->assertSee('id="brb-public-page"', false);
        $response->assertSee('Be right back', false);
    }

    public function test_authenticated_admin_sees_framework_error_not_brb_page(): void
    {
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'Admin',
            'description' => 'Admin',
        ]);
        $user = User::factory()->create();
        $user->attachRole($role);

        $response = $this->actingAs($user)->get('/_testing/trigger-500');

        $response->assertStatus(500);
        $response->assertDontSee('id="brb-public-page"', false);
    }

    public function test_json_request_does_not_receive_brb_html(): void
    {
        $response = $this->getJson('/_testing/trigger-500');

        $response->assertStatus(500);
        $this->assertStringContainsString('application/json', $response->headers->get('Content-Type'));
        $this->assertStringNotContainsString('brb-public-page', $response->getContent());
    }
}
