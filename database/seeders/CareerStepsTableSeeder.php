<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerStepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $data = [
            // Occupation No:1 - Software Developer
            // Specialization No:1- Software Architect
            [
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 1,
                'qualification' => 'Certification',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 2,
                'qualification' => 'Diploma',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 3,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 4,
                'qualification' => 'Internship',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 5,
                'qualification' => 'MCSD Certificate',
            ],
            // Occupation No:1 - Software Developer
            // Specialization No:2 - Information Architect Software
            [
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
            // Occupation No:1 - Software Developer
            // Specialization No:3 - Software Designer
            
        ];
        DB::table('career_steps')->insert($data);
    }
}
