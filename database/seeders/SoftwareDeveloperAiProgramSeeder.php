<?php

namespace Database\Seeders;

use App\Models\InternshipProgram;
use Illuminate\Database\Seeder;

class SoftwareDeveloperAiProgramSeeder extends Seeder
{
    public function run(): void
    {
        $name = 'Software Developer AI';

        $program = InternshipProgram::firstOrNew(['name' => $name]);

        $program->fill([
            'program_type' => 'Short Program',
            'description' => 'Software Developer AI introduces learners to practical software development with artificial intelligence tools and workflows. Build coding confidence, explore AI-assisted development, and register your interest while we prepare the official intake.',
            'duration' => '6 months',
            'recruitment_start_date' => now()->toDateString(),
            'recruitment_end_date' => now()->addMonths(6)->toDateString(),
            'number_needed' => 30,
            'has_stipend' => false,
            'stipend_amount' => null,
            'stipend_currency' => 'ZAR',
            'has_accreditation' => false,
            'accreditation_details' => null,
            'youth_beneficiaries' => true,
            'requirements' => 'Interest in software development and technology. Basic computer literacy. Willingness to learn AI-assisted coding practices. Formal entry requirements will be confirmed when the programme launches.',
            'is_active' => true,
            'allows_enquiry' => true,
        ]);

        $program->save();

        $this->command?->info("{$name} is active with Enquire mode ON (collecting interest).");
    }
}
