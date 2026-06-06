<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('modules')->exists()) {
            return;
        }

        DB::table('modules')->insert([
            [
                'title' => 'Systems Development NQF Level 5',
                'slug' => 'systems-development-nqf-5',
                'nqf_level' => 5,
                'duration_months' => 18,
                'description' => 'QCTO-aligned occupational certificate preparing learners for software development roles.',
                'registration_url' => '/contact',
                'accreditation_body' => 'QCTO',
                'accreditation_status' => 'accredited',
                'accreditation_number' => 'QCTO-SAMPLE-001',
                'accreditation_expires_at' => now()->addYears(2)->toDateString(),
                'is_registration_open' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'End User Computing NQF Level 3',
                'slug' => 'end-user-computing-nqf-3',
                'nqf_level' => 3,
                'duration_months' => 12,
                'description' => 'Foundational ICT skills programme for school leavers and career changers.',
                'registration_url' => '/contact',
                'accreditation_body' => 'MICT_SETA',
                'accreditation_status' => 'pending',
                'accreditation_number' => null,
                'accreditation_expires_at' => null,
                'is_registration_open' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
