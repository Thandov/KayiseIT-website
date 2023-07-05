<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationsTableSeeder extends Seeder
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
            [
                'occup_id' => 1,
                'occupation_name' => 'Software Developer',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 2,
                'occupation_name' => 'Computer Network and Systems Engineer',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 3,
                'occupation_name' => 'ICT Systems Analyist',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 4,
                'occupation_name' => 'Management Consultant (Business Analyst)',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 5,
                'occupation_name' => 'ICT Security Specialist',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 6,
                'occupation_name' => 'Multi-media Specialist',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 7,
                'occupation_name' => 'Programmer Analyist',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 8,
                'occupation_name' => 'Developer Programmer',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 9,
                'occupation_name' => 'ICT Project Manager',
                'image' => 'html-2188441__340.png',
            ],

            [
                'occup_id' => 10,
                'occupation_name' => 'ICT Sales Representative',
                'image' => 'html-2188441__340.png',
            ],
        ];
        DB::table('occupations')->insert($data);
    }
}
