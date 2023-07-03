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
        // Create some sample career steps
        DB::table([
            'u_id' => 1, // Replace with the desired user ID
            'occup_id' => 1, // Replace with the desired occupation ID
            'spec_id' => 1, // Replace with the desired specialization ID
            'step_number' => 1,
            'qualification' => 'Bachelor\'s Degree',
        ]);

        DB::table([
            'u_id' => 1, // Replace with the desired user ID
            'occup_id' => 1, // Replace with the desired occupation ID
            'spec_id' => 1, // Replace with the desired specialization ID
            'step_number' => 2,
            'qualification' => 'Master\'s Degree',
        ]);
    }
}
