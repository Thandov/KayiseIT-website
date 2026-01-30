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
        $this->call(OccupationsTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(CareerStepsTableSeeder::class);
        $this->call(AdminUserSeeder::class);
        $this->call(CarouselSeeder::class);

    }
}