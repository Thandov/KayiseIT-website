<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LaratrustSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(SubServicesTableSeeder::class);
        //$this->call(OptionsTableSeeder::class);
        $this->call(TestimonialsSeeder::class);

    }
}