<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subservice;
use App\Models\Options;
use Illuminate\Support\Facades\DB;

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
                'slug' => 'wordpress_one_page',
                'price' => 1000.00,
                'icon' => 'wordpress.png',
                'service_id' => 'S001',
                'subserv_id' => 'subserv001',
            ],
            [
                'name' => 'WordPress Standard',
                'slug' => 'wordpress_standard',
                'price' => 1000.00,
                'icon' => 'wordpress.png',
                'service_id' => 'S001',
                'subserv_id' => 'subserv002',
            ],
            [
                'name' => 'Tech Support',
                'slug' => 'tech_support',
                'price' => 1000.00,
                'icon' => 'tech.png',
                'service_id' => 'S003',
                'subserv_id' => 'subserv004',
            ],
            [
                'name' => 'Coding',
                'slug' => 'coding',
                'price' => 1000.00,
                'icon' => 'coding.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv005',
            ],
            [
                'name' => 'Robotics',
                'slug' => 'robotics',
                'price' => 1000.00,
                'icon' => 'robot.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv006',
            ],
            [
                'name' => 'Cyber Security For SMEs',
                'slug' => 'cyber_security_for_smes',
                'price' => 1000.00,
                'icon' => 'cyber.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv007',
            ],
            [
                'name' => 'Microsoft PowerPoint Advanced',
                'slug' => 'microsoft_powerpoint_advanced',
                'price' => 1000.00,
                'icon' => 'power.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv009',
            ],
            [
                'name' => 'Microsoft Word Advanced',
                'slug' => 'microsoft_word_advanced',
                'price' => 1000.00,
                'icon' => 'word.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv010',
            ],
            [
                'name' => 'Microsoft Excel Advanced',
                'slug' => 'microsoft_excel_advanced',
                'price' => 1000.00,
                'icon' => 'excel.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv011',
            ],
            [
                'name' => 'Microsoft Office Hybrid',
                'slug' => 'microsoft_office_hybrid',
                'price' => 1000.00,
                'icon' => 'office.png',
                'service_id' => 'S004',
                'subserv_id' => 'subserv012',
            ],
            [
                'name' => 'IT Integration Solution',
                'slug' => 'it_integration_solution',
                'price' => 1000.00,
                'icon' => 'inter.png',
                'service_id' => 'S005',
                'subserv_id' => 'subserv013',
            ],
            [
                'name' => 'IT Outsourcing',
                'slug' => 'it_outsourcing',
                'price' => 1000.00,
                'icon' => 'out.png',
                'service_id' => 'S006',
                'subserv_id' => 'subserv014',
            ],
            [
                'name' => 'Company Profile Design',
                'slug' => 'company_profile_design',
                'price' => 1000.00,
                'icon' => 'comp.png',
                'service_id' => 'S007',
                'subserv_id' => 'subserv015',
            ],
            [
                'name' => 'Logo Design',
                'slug' => 'logo design',
                'price' => 500.00,
                'icon' => 'log.png',
                'service_id' => 'S008',
                'subserv_id' => 'subserv016',
            ],
        ];

        foreach ($subservices as $subservice) {

            $subService = new Subservice();
            $subService->service_id = $subservice['service_id'];
            $subService->name = $subservice['name'];
            $subService->slug = $subservice['slug'];
            $subService->icon = $subservice['icon'];
            $subService->price = $subservice['price'];
            $subService->subserv_id = $subservice['subserv_id'];
            $subService->save();
        }
        $options = [
            ['SUB2345', 'subserv001', 'Graphics Design', 1, 750],
            ['SUB4568', 'subserv001', 'Photo Outsourcing', 1, 500],
            ['SUB5462', 'subserv001', 'Custom Form', 1, 1000],
        ];
        foreach ($options as $option) {
            DB::table('options')->insert([
                'unq_id' => $option[0],
                'subservice_id' => $option[1],
                'name' => $option[2],
                'quantified' => $option[3],
                'price' => $option[4],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
