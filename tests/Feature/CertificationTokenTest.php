<?php

namespace Tests\Feature;

use App\Models\CertificateDownload;
use App\Services\CertificateEligibilityService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CertificationTokenTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Config::set('database.default', 'sqlite');
        Config::set('database.connections.sqlite.database', ':memory:');

        foreach (array_keys(config('database.connections')) as $name) {
            DB::purge($name);
        }

        DB::reconnect();

        Schema::connection(config('database.default'))->dropAllTables();

        Artisan::call('migrate', [
            '--database' => 'sqlite',
            '--path' => 'database/migrations/2026_02_23_192223_create_certificate_downloads_table.php',
            '--force' => true,
        ]);
    }

    public function test_certification_form_page_loads(): void
    {
        $response = $this->get(route('certification.form'));

        $response->assertOk();
        $response->assertSee('Request Your Certificate', false);
    }

    public function test_success_redirects_when_token_missing(): void
    {
        $response = $this->get(route('certification.success'));

        $response->assertRedirect(route('certification.form'));
        $response->assertSessionHas('error');
    }

    public function test_success_redirects_for_unknown_token(): void
    {
        $response = $this->get(route('certification.success', ['token' => 'notavalidtokenxxxxxxxxxxxxxxxxxxxxxxxx']));

        $response->assertRedirect(route('certification.form'));
        $response->assertSessionHas('error');
    }

    public function test_success_redirects_when_token_expired(): void
    {
        CertificateDownload::create([
            'id_number' => '9001015009087',
            'name' => 'Test',
            'surname' => 'Learner',
            'email' => null,
            'storage_path' => 'certificates/output/x/Certificate_Test_Learner.pdf',
            'download_token' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
            'expires_at' => now()->subHour(),
        ]);

        $response = $this->get(route('certification.success', [
            'token' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
        ]));

        $response->assertRedirect(route('certification.form'));
        $response->assertSessionHas('error');
    }

    public function test_success_shows_page_when_token_valid(): void
    {
        CertificateDownload::create([
            'id_number' => '9001015009087',
            'name' => 'Test',
            'surname' => 'Learner',
            'email' => null,
            'storage_path' => 'certificates/output/x/Certificate_Test_Learner.pdf',
            'download_token' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
            'expires_at' => now()->addDay(),
        ]);

        $response = $this->get(route('certification.success', [
            'token' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb',
        ]));

        $response->assertOk();
        $response->assertSee('Congratulations');
        $response->assertSee(
            route('certification.download', ['token' => 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb']),
            false
        );
    }

    public function test_download_redirects_when_token_missing(): void
    {
        $response = $this->get(route('certification.download'));

        $response->assertRedirect(route('certification.form'));
        $response->assertSessionHas('error');
    }

    public function test_download_redirects_when_file_missing(): void
    {
        CertificateDownload::create([
            'id_number' => '9001015009087',
            'name' => 'Test',
            'surname' => 'Learner',
            'email' => null,
            'storage_path' => 'certificates/output/missing/Certificate_Test_Learner.pdf',
            'download_token' => 'cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc',
            'expires_at' => now()->addDay(),
        ]);

        $response = $this->get(route('certification.download', [
            'token' => 'cccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc',
        ]));

        $response->assertRedirect(route('certification.form'));
        $response->assertSessionHas('error');
    }

    public function test_submit_returns_json_when_ajax_header_present_even_without_accept_header(): void
    {
        $this->mock(CertificateEligibilityService::class, function ($mock) {
            $mock->shouldReceive('findLearnerById')
                ->once()
                ->with('0000000000000')
                ->andReturn(null);
        });

        $response = $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class)
            ->withHeaders([
                'X-Certification-Ajax' => '1',
            ])
            ->post(route('certification.submit'), [
                'id_number' => '0000000000000',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['id_number']]);
    }

    public function test_download_returns_pdf_when_valid(): void
    {
        Storage::disk('local')->makeDirectory('certificates/output/stubdir');
        Storage::disk('local')->put('certificates/output/stubdir/Certificate_Test_User.pdf', '%PDF-1.4 test certificate stub');

        CertificateDownload::create([
            'id_number' => '9001015009088',
            'name' => 'Test',
            'surname' => 'User',
            'email' => null,
            'storage_path' => 'certificates/output/stubdir/Certificate_Test_User.pdf',
            'download_token' => 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
            'expires_at' => now()->addDay(),
        ]);

        $response = $this->get(route('certification.download', [
            'token' => 'dddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddddd',
        ]));

        $response->assertOk();
        $response->assertHeader('content-type', 'application/pdf');
    }
}
