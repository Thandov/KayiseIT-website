<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Subservice;

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
            'name' => 'WordPress One Page',
            'price' => 1000.00,
            'icon' => 'wordpress.png',
            'service_id' => 'S001',
            'subserv_id' => 'subserv001',
        ],
        [
            'name' => 'WordPress Standard',
            'price' => 1000.00,
            'icon' => 'wordpress.png',
            'service_id' => 'S001',
            'subserv_id' => 'subserv002',
        ],
        [
            'name' => 'App Development',
            'price' => 1000.00,
            'icon' => 'app.png',
            'service_id' => 'S002',
            'subserv_id' => 'subserv003',
        ],
        [
            'name' => 'Tech Support',
            'price' => 1000.00,
            'icon' => 'tech.png',
            'service_id' => 'S003',
            'subserv_id' => 'subserv004',
        ],
        [
            'name' => 'Coding',
            'price' => 1000.00,
            'icon' => 'coding.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv005',
        ],
        [
            'name' => 'Robotics',
            'price' => 1000.00,
            'icon' => 'robot.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv006',
        ],
        [
            'name' => 'Cyber Security For SMEs',
            'price' => 1000.00,
            'icon' => 'cyber.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv007',
        ],
        [
            'name' => 'Video Conferencing Cross-Platform',
            'price' => 1000.00,
            'icon' => 'vid.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv008',
        ],
        [
            'name' => 'Microsoft PowerPoint Advanced',
            'price' => 1000.00,
            'icon' => 'power.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv009',
        ],
        [
            'name' => 'Microsoft Word Advanced',
            'price' => 1000.00,
            'icon' => 'word.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv010',
        ],
        [
            'name' => 'Microsoft Excel Advanced',
            'price' => 1000.00,
            'icon' => 'excel.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv011',
        ],
        [
            'name' => 'Microsoft Office Hybrid',
            'price' => 1000.00,
            'icon' => 'office.png',
            'service_id' => 'S004',
            'subserv_id' => 'subserv012',
        ],
        [
            'name' => 'IT Integration Solution',
            'price' => 1000.00,
            'icon' => 'inter.png',
            'service_id' => 'S005',
            'subserv_id' => 'subserv013',
        ],
        [
            'name' => 'IT Outsourcing',
            'price' => 1000.0,
            'icon' => 'out.png',
            'service_id' => 'S006',
            'subserv_id' => 'subserv014',
        ],
    ];

    foreach ($subservices as $subservice) {

        $subService = new Subservice();
        $subService->service_id = $subservice['service_id'];
        $subService->name = $subservice['name'];
        $subService->icon = $subservice['icon'];
        $subService->price = $subservice['price'];
        $subService->subserv_id = $subservice['subserv_id'];
        $subService->save();
    }
}
}
