<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InternshipProgram;

class AddKayiseItInternshipProgram extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if program already exists
        $exists = InternshipProgram::where('name', 'KAYISE IT Internship program 2026 -2027')->exists();
        
        if (!$exists) {
            InternshipProgram::create([
                'name' => 'KAYISE IT Internship program 2026 -2027',
                'program_type' => 'Internship',
                'description' => 'KAYISE IT Internship program for 2026-2027. This program provides hands-on experience in IT development, software engineering, and related technologies.',
                'duration' => '12 months',
                'recruitment_start_date' => '2026-01-01',
                'recruitment_end_date' => '2027-12-31',
                'number_needed' => 50,
                'has_stipend' => true,
                'stipend_amount' => 5000.00,
                'stipend_currency' => 'ZAR',
                'has_accreditation' => false,
                'youth_beneficiaries' => true,
                'requirements' => 'Bachelor degree in IT, Computer Science, or related field. Strong programming skills and passion for technology.',
                'is_active' => true,
            ]);
            
            $this->command->info('KAYISE IT Internship program 2026 -2027 created successfully!');
        } else {
            $this->command->info('KAYISE IT Internship program 2026 -2027 already exists.');
        }
    }
}
