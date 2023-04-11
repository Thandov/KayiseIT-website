<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Options;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $options = [
        [
            'name' => 'Extra Page',
            'price' => 350,
            'unq_id' => 'subserv001',
        ],
        [
            'name' => 'Costum Form',
            'price' => 1000,
            'unq_id' => 'subserv001',
        ],
        [
            'name' => 'Hosting',
            'price' => 1000,
            'unq_id' => 'subserv001',
        ],
        [
            'name' => 'Domain Registration',
            'price' => 250,
            'unq_id' => 'subserv001',
        ],
        [
            'name' => 'Extra Page',
            'price' => 350,
            'unq_id' => 'subserv002',
        ],
        [
            'name' => 'Costum Form',
            'price' => 1000,
            'unq_id' => 'subserv002',
        ],
        [
            'name' => 'Hosting',
            'price' => 1000,
            'unq_id' => 'subserv002',
        ],
        [
            'name' => 'Domain Registration',
            'price' => 250,
            'unq_id' => 'subserv002',
        ],
        [
            'name' => 'Extra Page',
            'price' => 350,
            'unq_id' => 'subserv003',
        ],
        [
            'name' => 'Costum Form',
            'price' => 1000,
            'unq_id' => 'subserv003',
        ],
        [
            'name' => 'Hosting',
            'price' => 1000,
            'unq_id' => 'subserv003',
        ],
        [
            'name' => 'Domain Registration',
            'price' => 250,
            'unq_id' => 'subserv003',
        ],
    ];

    foreach ($options as $option) {

        $Options = new Options();
        $Options->name = $option['name'];
        $Options->price = $option['price'];
        $Options->unq_id = $option['unq_id'];
        $Options->save();
    }
}
}
