<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarouselSeeder extends Seeder
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
            'title' => 'We Specialize In',
            'middletxt' => 'Software Development',
            'btmtxt' => 'Tailored I.T Solutions For Your Needs',
            'image' => '../images/carousel/cara1.png',
        ],
        [
            'title' => 'We Specialize In',
            'middletxt' => 'Web Development',
            'btmtxt' => 'Tailored I.T Solutions For Your Needs',
            'image' => '../images/carousel/cara2.png',
        ],
        [
            'title' => 'We Specialize In',
            'middletxt' => 'Tech Support',
            'btmtxt' => 'Tailored I.T Solutions For Your Needs',
            'image' => '../images/carousel/cara3.png',
        ],
        [
            'title' => 'We Specialize In',
            'middletxt' => '4IR Skills Training',
            'btmtxt' => 'Tailored I.T Solutions For Your Needs',
            'image' => '../images/carousel/cara4.png',
        ],
        [
            'title' => 'We Specialize In',
            'middletxt' => 'Office Automation',
            'btmtxt' => 'Tailored For Your I.T Needs',
            'image' => '../images/carousel/cara2.png',
        ],
    ];

    DB::table('carousels')->insert($data);

    }
}
