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
        DB::table('occupations')->insert([
            'occupation_name' => 'Software Development',
            'image' => 'html-2188441__340.png',
        ]);

        DB::table('occupations')->insert([
            'occupation_name' => 'Systems Analyist',
            'image' => 'html-2188441__340.png',
        ]);

        // Add more test data for occupations table if needed
    }
}
