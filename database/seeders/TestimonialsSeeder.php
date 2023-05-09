<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    $testimonials = [
        [
            'icon' => 'thaps.jpg',
            'name' => 'Maluka Thapelo',
            'ratings' => '5',
            'testimony' => 'Great customer service and even better delivery. I was relly happy with the quality of their work.
                           They are the best at what they do.',
        ],
        [
            'icon' => 'lebo.jpg',
            'name' => 'john Murray',
            'ratings' => '4',
            'testimony' => 'I recommend Kayise IT to everyone for IT solutions and needs.They have a dedicated team that knows
                            what they are doing.',
        ],
        [
            'icon' => 'lele.jpg',
            'name' => 'Malele Tsepi',
            'ratings' => '5',
            'testimony' => 'It was way easier starting my business with the help of Kayise IT with their IT solutions and
                            great marketing skills',
        ],
    ];

    foreach ($testimonials as $testimonial) {

        $Testimonials = new Testimonial();
        $Testimonials->icon = $testimonial['icon'];
        $Testimonials->name = $testimonial['name'];
        $Testimonials->testimony = $testimonial['testimony'];
        $Testimonials->ratings = $testimonial['ratings'];
        $Testimonials->save();
    }
    }
}
