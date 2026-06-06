<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareerMappingEnrichmentSeeder extends Seeder
{
    public function run(): void
    {
        $this->enrichOccupations();
        $this->fixOccupationTypos();
        $this->fixSpecializationTypos();
        $this->removeNonIctSpecializations();
        $this->fixCareerStepData();
        $this->enrichLaunchCareerSteps();
    }

    private function enrichOccupations(): void
    {
        $occupations = [
            1 => [
                'slug' => 'software-developer',
                'description' => 'Build apps, websites, and software that millions of people use every day.',
                'day_in_life' => 'You write code, fix bugs, and ship features with a team.',
                'entry_salary_min' => 180000,
                'entry_salary_max' => 350000,
                'display_order' => 1,
                'is_published' => true,
            ],
            2 => [
                'slug' => 'network-systems-engineer',
                'description' => 'Keep computers and networks connected, fast, and secure.',
                'day_in_life' => 'You set up servers, fix network issues, and protect systems.',
                'entry_salary_min' => 160000,
                'entry_salary_max' => 320000,
                'display_order' => 2,
                'is_published' => true,
            ],
            3 => [
                'slug' => 'ict-systems-analyst',
                'description' => 'Bridge business needs and technology solutions.',
                'day_in_life' => 'You analyse problems and design systems that work for real users.',
                'entry_salary_min' => 170000,
                'entry_salary_max' => 340000,
                'display_order' => 3,
                'is_published' => true,
            ],
            4 => [
                'slug' => 'management-consultant-business-analyst',
                'description' => 'Help organisations improve how they use technology and data.',
                'day_in_life' => 'You study processes and recommend smarter digital solutions.',
                'entry_salary_min' => 150000,
                'entry_salary_max' => 300000,
                'display_order' => 99,
                'is_published' => false,
            ],
            5 => [
                'slug' => 'ict-security-specialist',
                'description' => 'Protect companies from hackers and cyber threats.',
                'day_in_life' => 'You monitor systems, test security, and stop attacks before they spread.',
                'entry_salary_min' => 200000,
                'entry_salary_max' => 400000,
                'display_order' => 4,
                'is_published' => true,
            ],
            6 => [
                'slug' => 'multimedia-specialist',
                'description' => 'Create games, animations, and digital media experiences.',
                'day_in_life' => 'You design visuals, code interactive content, and tell stories digitally.',
                'entry_salary_min' => 140000,
                'entry_salary_max' => 280000,
                'display_order' => 5,
                'is_published' => true,
            ],
            7 => [
                'slug' => 'programmer-analyst',
                'description' => 'Analyse requirements and turn them into working software.',
                'day_in_life' => 'You plan solutions, write code, and support business systems.',
                'entry_salary_min' => 170000,
                'entry_salary_max' => 330000,
                'display_order' => 6,
                'is_published' => true,
            ],
            8 => [
                'slug' => 'developer-programmer',
                'description' => 'Code applications from mobile apps to enterprise software.',
                'day_in_life' => 'You build features, test code, and deploy updates.',
                'entry_salary_min' => 180000,
                'entry_salary_max' => 360000,
                'display_order' => 7,
                'is_published' => true,
            ],
            9 => [
                'slug' => 'ict-project-manager',
                'description' => 'Lead tech projects on time and within budget.',
                'day_in_life' => 'You coordinate teams, track progress, and deliver ICT projects.',
                'entry_salary_min' => 220000,
                'entry_salary_max' => 450000,
                'display_order' => 8,
                'is_published' => true,
            ],
            10 => [
                'slug' => 'ict-sales-representative',
                'description' => 'Help businesses choose the right technology products and services.',
                'day_in_life' => 'You meet clients, demo solutions, and close tech deals.',
                'entry_salary_min' => 120000,
                'entry_salary_max' => 280000,
                'display_order' => 9,
                'is_published' => true,
            ],
        ];

        foreach ($occupations as $occupId => $data) {
            DB::table('occupations')->where('occup_id', $occupId)->update($data);
        }
    }

    private function fixOccupationTypos(): void
    {
        DB::table('occupations')->where('occup_id', 3)->update([
            'occupation_name' => 'ICT Systems Analyst',
        ]);
        DB::table('occupations')->where('occup_id', 7)->update([
            'occupation_name' => 'Programmer Analyst',
        ]);
    }

    private function fixSpecializationTypos(): void
    {
        $replacements = [
            'Architect (Aplications/Call Center/Computing/Desktop/E-commerse)' => 'Architect (Applications/Call Center/Computing/Desktop/E-commerce)',
            'Superannuation Transitions Specialist ' => 'Superannuation Transitions Specialist',
        ];

        foreach ($replacements as $from => $to) {
            DB::table('specializations')->where('specialization_name', $from)->update([
                'specialization_name' => $to,
            ]);
        }
    }

    private function removeNonIctSpecializations(): void
    {
        $nonIctNames = [
            'Farm Management Consultant',
            'Business Coach',
            'Purchase Advisor',
            'Superannuation Transitions Specialist',
            'Capital Expenditure Analyst',
            'Corporate Planner',
            'Commercial Analyst',
            'Resource Development Analyst',
            'Strategic Developer/Facilitator',
            'Business Turnaround Management Consultant',
            'Small Business Consultant/Mentor',
            'Services Solutions Project Manager',
            'Business Support Project Manager',
        ];

        $specIds = DB::table('specializations')
            ->where('occup_id', 4)
            ->whereIn('specialization_name', $nonIctNames)
            ->pluck('spec_id');

        if ($specIds->isNotEmpty()) {
            DB::table('career_steps')->whereIn('spec_id', $specIds)->delete();
            DB::table('specializations')->whereIn('spec_id', $specIds)->delete();
        }
    }

    private function fixCareerStepData(): void
    {
        DB::table('career_steps')
            ->where('qualification', 'like', '%Intergrated%')
            ->update([
                'qualification' => DB::raw("REPLACE(qualification, 'Intergrated', 'Integrated')"),
            ]);

        if (!DB::table('career_steps')->where('spec_id', 4)->exists()) {
            $engineerSteps = DB::table('career_steps')
                ->where('occup_id', 1)
                ->where('spec_id', 2)
                ->orderBy('step_number')
                ->get();

            if ($engineerSteps->count() > 5) {
                $extra = $engineerSteps->slice(5);
                foreach ($extra as $step) {
                    DB::table('career_steps')->where('steps_id', $step->steps_id)->update(['spec_id' => 4]);
                }
            } else {
                foreach ([
                    ['step_number' => 1, 'qualification' => 'Diploma'],
                    ['step_number' => 2, 'qualification' => 'Bachelor\'s Degree'],
                    ['step_number' => 3, 'qualification' => 'Internship'],
                    ['step_number' => 4, 'qualification' => 'MCSD Certification'],
                    ['step_number' => 5, 'qualification' => 'Scrum Certification'],
                ] as $row) {
                    DB::table('career_steps')->insert(array_merge($row, [
                        'occup_id' => 1,
                        'spec_id' => 4,
                        'u_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]));
                }
            }
        }

        DB::table('career_steps')
            ->where('occup_id', 1)
            ->where('spec_id', 4)
            ->whereNull('title')
            ->orderBy('step_number')
            ->get()
            ->each(function ($step, $index) {
                $titles = [
                    1 => 'Get a Diploma in IT',
                    2 => 'Earn a Bachelor\'s Degree',
                    3 => 'Complete an Internship',
                    4 => 'Get MCSD Certification',
                    5 => 'Get Scrum Certification',
                ];
                $n = (int) $step->step_number;
                DB::table('career_steps')->where('steps_id', $step->steps_id)->update([
                    'title' => $titles[$n] ?? $step->qualification,
                    'summary' => 'A key step toward becoming a Software Engineer.',
                    'nqf_level' => match ($n) {
                        1 => 6,
                        2 => 7,
                        default => null,
                    },
                    'duration' => match ($n) {
                        1, 2 => '2-3 years',
                        3 => '6-12 months',
                        default => '3-6 months',
                    },
                    'typical_cost' => match ($n) {
                        1, 2 => 'R0 with NSFAS at public institutions',
                        default => 'Varies by provider',
                    },
                    'prerequisites' => json_encode(['Matric with Maths or Maths Lit']),
                    'next_action' => match ($n) {
                        1 => 'Apply at your nearest TVET or university before intake closes.',
                        2 => 'Research NSFAS and bursary deadlines for your chosen institution.',
                        3 => 'Search internship programmes on company websites and LinkedIn.',
                        default => 'Research accredited certification providers.',
                    },
                ]);
            });
    }

    private function enrichLaunchCareerSteps(): void
    {
        $softwareArchitectSteps = DB::table('career_steps')
            ->where('spec_id', 1)
            ->orderBy('step_number')
            ->get();

        $templates = [
            1 => ['title' => 'Get a Diploma in IT', 'nqf_level' => 6, 'duration' => '2-3 years'],
            2 => ['title' => 'Earn a Bachelor\'s Degree', 'nqf_level' => 7, 'duration' => '3-4 years'],
            3 => ['title' => 'Complete an Internship', 'duration' => '6-12 months'],
            4 => ['title' => 'Get MCSD Certification', 'duration' => '3-6 months'],
            5 => ['title' => 'Get Scrum Certification', 'duration' => '1-2 months'],
        ];

        foreach ($softwareArchitectSteps as $step) {
            $n = (int) $step->step_number;
            $tpl = $templates[$n] ?? [];
            DB::table('career_steps')->where('steps_id', $step->steps_id)->update(array_merge([
                'title' => $tpl['title'] ?? $step->qualification,
                'summary' => 'Build skills step by step toward a Software Architect role.',
                'typical_cost' => in_array($n, [1, 2], true) ? 'R0 with NSFAS at public institutions' : 'Varies by provider',
                'prerequisites' => json_encode(['Matric with Maths or Maths Lit']),
                'next_action' => 'Start researching providers and application deadlines this month.',
            ], $tpl));
        }
    }
}
