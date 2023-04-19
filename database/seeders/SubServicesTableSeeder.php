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
            'name' => 'WordPress One Page',
            'price' => 1000.00,
            'icon' => 'columns.svg',
            'service_id' => 'S001',
            'subserv_id' => 'subserv001',
        ],
        [
            'name' => 'WordPress Standard',
            'price' => 1000.00,
            'icon' => 'layout.svg',
            'service_id' => 'S001',
            'subserv_id' => 'subserv002',
        ],
        [
            'name' => 'App Development',
            'price' => 1000.00,
            'icon' => 'layers.svg',
            'service_id' => 'S002',
            'subserv_id' => 'subserv003',
        ],
        [
            'name' => 'Tech Support',
            'price' => 1000.00,
            'icon' => 'monitor.svg',
            'service_id' => 'S003',
            'subserv_id' => 'subserv004',
        ],
        [
            'name' => 'Coding',
            'price' => 1000.00,
            'icon' => 'terminal.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv005',
        ],
        [
            'name' => 'Robotics',
            'price' => 1000.00,
            'icon' => 'cpu.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv006',
        ],
        [
            'name' => 'Cyber Security For SMEs',
            'price' => 1000.00,
            'icon' => 'lock.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv007',
        ],
        [
            'name' => 'Video Conferencing Cross-Platform',
            'price' => 1000.00,
            'icon' => 'video.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv008',
        ],
        [
            'name' => 'Microsoft PowerPoint Advanced',
            'price' => 1000.00,
            'icon' => 'icons8-microsoft-powerpoint.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv009',
        ],
        [
            'name' => 'Microsoft Word Advanced',
            'price' => 1000.00,
            'icon' => 'icons8-microsoft-word.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv010',
        ],
        [
            'name' => 'Microsoft Excel Advanced',
            'price' => 1000.00,
            'icon' => 'icons8-microsoft-excel.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv011',
        ],
        [
            'name' => 'Microsoft Office Hybrid',
            'price' => 1000.00,
            'icon' => 'icons8-office-365.svg',
            'service_id' => 'S004',
            'subserv_id' => 'subserv012',
        ],
        [
            'name' => 'IT Integration Solution',
            'price' => 1000.00,
            'icon' => 'command.svg',
            'service_id' => 'S005',
            'subserv_id' => 'subserv013',
        ],
        [
            'name' => 'IT Outsourcing',
            'price' => 1000.0,
            'icon' => 'cast.svg',
            'service_id' => 'S006',
            'subserv_id' => 'subserv014',
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
