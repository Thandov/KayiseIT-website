<?php

namespace Tests\Feature\Api\V1;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\InternshipProgram;
use App\Models\Role;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiV1Test extends TestCase
{
    public function test_health_returns_ok(): void
    {
        $this->getJson('/api/v1/health')
            ->assertOk()
            ->assertJsonPath('status', 'ok')
            ->assertJsonPath('version', 'v1');
    }

    public function test_public_lists_return_paginated_data(): void
    {
        foreach (['/api/v1/services', '/api/v1/blogs', '/api/v1/programs', '/api/v1/case-studies'] as $path) {
            $this->getJson($path)
                ->assertOk()
                ->assertJsonStructure(['data', 'links', 'meta']);
        }
    }

    public function test_user_requires_authentication(): void
    {
        $this->getJson('/api/v1/user')
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Unauthenticated.');
    }

    public function test_authenticated_user_receives_safe_profile_only(): void
    {
        $user = User::factory()->create([
            'id_number' => '9001015800088',
            'cv_path' => 'private/cv.pdf',
        ]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/v1/user');

        $response->assertOk()
            ->assertJsonPath('data.id', $user->id)
            ->assertJsonPath('data.email', $user->email)
            ->assertJsonMissing(['id_number' => '9001015800088'])
            ->assertJsonMissingPath('data.cv_path')
            ->assertJsonMissingPath('data.password');
    }

    public function test_missing_public_resources_return_404(): void
    {
        $this->getJson('/api/v1/blogs/999999999')->assertNotFound();
        $this->getJson('/api/v1/programs/999999999')->assertNotFound();
        $this->getJson('/api/v1/case-studies/does-not-exist-slug-xyz')->assertNotFound();
        $this->getJson('/api/v1/services/does-not-exist-slug-xyz')->assertNotFound();
    }

    public function test_inactive_program_is_hidden(): void
    {
        $program = InternshipProgram::query()->orderBy('id')->first();

        if (! $program) {
            $this->markTestSkipped('No programs in database');
        }

        $wasActive = (bool) $program->is_active;
        $program->forceFill(['is_active' => false])->save();

        try {
            $this->getJson('/api/v1/programs/'.$program->id)->assertNotFound();
        } finally {
            $program->forceFill(['is_active' => $wasActive])->save();
        }
    }

    public function test_inactive_case_study_is_hidden(): void
    {
        $caseStudy = CaseStudy::query()->create([
            'title' => 'API Test Draft Case Study',
            'slug' => 'api-test-draft-case-study-'.uniqid(),
            'is_active' => false,
            'is_featured' => false,
            'order' => 0,
        ]);

        try {
            $this->getJson('/api/v1/case-studies/'.$caseStudy->slug)->assertNotFound();
        } finally {
            $caseStudy->delete();
        }
    }

    public function test_blog_show_includes_content_when_present(): void
    {
        $blog = Blog::query()->orderBy('id')->first();

        if (! $blog) {
            $this->markTestSkipped('No blogs in database');
        }

        $this->getJson('/api/v1/blogs/'.$blog->id)
            ->assertOk()
            ->assertJsonPath('data.id', $blog->id)
            ->assertJsonStructure(['data' => ['id', 'title', 'content', 'cover_url']]);
    }

    public function test_private_catalog_requires_authentication(): void
    {
        foreach (['/api/v1/staff', '/api/v1/clients', '/api/v1/announcements', '/api/v1/invoices', '/api/v1/quotations'] as $path) {
            $this->getJson($path)->assertUnauthorized();
        }
    }

    public function test_admin_can_list_private_resources(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Admin', 'description' => 'Admin']
        );
        $user = User::factory()->create();
        $user->attachRole($role);

        Sanctum::actingAs($user);

        foreach (['/api/v1/staff', '/api/v1/announcements', '/api/v1/invoices', '/api/v1/quotations'] as $path) {
            $this->getJson($path)
                ->assertOk()
                ->assertJsonStructure(['data', 'links', 'meta']);
        }

        // Admin passes canAccessClients via isDashboardAdmin
        $this->getJson('/api/v1/clients')
            ->assertOk()
            ->assertJsonStructure(['data', 'links', 'meta']);
    }

    public function test_staff_list_omits_sensitive_fields(): void
    {
        $role = Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Admin', 'description' => 'Admin']
        );
        $user = User::factory()->create();
        $user->attachRole($role);
        Sanctum::actingAs($user);

        $response = $this->getJson('/api/v1/staff');
        $response->assertOk();

        $first = $response->json('data.0');
        if ($first === null) {
            $this->markTestSkipped('No staff rows in database');
        }

        $this->assertArrayNotHasKey('ID_number', $first);
        $this->assertArrayNotHasKey('id_number', $first);
        $this->assertArrayNotHasKey('personal_email', $first);
        $this->assertArrayNotHasKey('cv_path', $first);
        $this->assertArrayNotHasKey('id_copy_path', $first);
    }
}
