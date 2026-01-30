<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'icon' => 'gundo.jpg',
                'name' => 'Mudau Gundo',
                'ratings' => '5',
                'testimony' => 'Great customer service and even better delivery. I was relly happy with the quality of their work.
                           They are the best at what they do.',
            ],
            [
                'icon' => 'Tshepiso.jpg',
                'name' => 'Tshepiso Pitsi',
                'ratings' => '4',
                'testimony' => 'I recommend Kayise IT to everyone for IT solutions and needs.They have a dedicated team that knows
                            what they are doing.',
            ],
            [
                'icon' => 'Mduduzi.jpg',
                'name' => 'Mduduzi Magagula',
                'ratings' => '5',
                'testimony' => 'It was way easier starting my business with the help of Kayise IT with their IT solutions and
                            great marketing skills',
            ],
        ];

        DB::table('testimonials')->insert($data);
    }
}
