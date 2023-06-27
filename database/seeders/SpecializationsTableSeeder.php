<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         // Create some sample specializations
         DB::table([
            'occup_id' => 1, // Replace with the desired occupation ID
            'u_id' => 1, // Replace with the desired user ID
            'specialization_name' => 'Frontend Developer',
        ]);

        DB::table([
            'occup_id' => 1, // Replace with the desired occupation ID
            'u_id' => 1, // Replace with the desired user ID
            'specialization_name' => 'Backend Developer',
        ]);
    }
}
