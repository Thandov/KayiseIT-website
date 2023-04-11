<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\SubService;

class SubServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $subservices = [
        [
            'name' => 'One Pager Website',
            'price' => 9.99,
            'icon' => 'cast.svg',
            'service_id' => 'S001',
            'subserv_id' => 'subserv001',
        ],
        [
            'name' => 'Standard Website',
            'price' => 19.99,
            'icon' => 'columns.svg',
            'service_id' => 'S001',
            'subserv_id' => 'subserv002',
        ],
        [
            'name' => 'Commerce Website',
            'price' => 29.99,
            'icon' => 'globe.svg',
            'service_id' => 'S001',
            'subserv_id' => 'subserv003',
        ],
        [
            'name' => 'Wi-fi Installation',
            'price' => 9.99,
            'icon' => 'command.svg',
            'service_id' => 'S002',
            'subserv_id' => 'subserv004',
        ],
        [
            'name' => 'Printer Installation',
            'price' => 19.99,
            'icon' => 'hard-drive.svg',
            'service_id' => 'S002',
            'subserv_id' => 'subserv005',
        ],
        [
            'name' => 'Computer Setup',
            'price' => 29.99,
            'icon' => 'layers.svg',
            'service_id' => 'S002',
            'subserv_id' => 'subserv006',
        ],
        [
            'name' => 'Basic Software',
            'price' => 9.99,
            'icon' => 'monitor.svg',
            'service_id' => 'S003',
            'subserv_id' => 'subserv007',
        ],
        [
            'name' => 'Commerce Software',
            'price' => 19.99,
            'icon' => 'terminal.svg',
            'service_id' => 'S003',
            'subserv_id' => 'subserv008',
        ],
    ];

    foreach ($subservices as $subservice) {

        $subService = new SubService();
        $subService->service_id = $subservice['service_id'];
        $subService->name = $subservice['name'];
        $subService->icon = $subservice['icon'];
        $subService->price = $subservice['price'];
        $subService->subserv_id = $subservice['subserv_id'];
        $subService->save();
    }
}
}
