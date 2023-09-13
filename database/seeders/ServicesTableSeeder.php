<?php

namespace Database\Seeders;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $services = [
        [
            'name' => 'Web Development',
            'slug' => 'web_development',
            'description' => 'Our company specializes in creating contemporary and adaptable websites. You can view our available packages listed below.',
            'price' => 0.00,
            'icon' => 'web.png',
            'service_id' => 'S001',
        ],
        [
            'name' => 'Tech Support',
            'slug' => 'tech_support',
            'description' => 'We offer support to companies and customers when they have problems using tech equipment, software, and/or services.',
            'price' => 0.00,
            'icon' => 'tech.png',
            'service_id' => 'S003',
        ],
        [
            'name' => '4IR Skills Training',
            'slug' => '4ir_skills_training',
            'description' => 'We provide 4th Industrial Revolution skills training programmes',
            'price' => 0.00,
            'icon' => '4ir.png',
            'service_id' => 'S004',
        ],
    ];

    foreach ($services as $service) {
        $newService = new Service();
        $newService->name = $service['name'];
        $newService->slug = $service['slug'];
        $newService->description = $service['description'];
        $newService->price = $service['price'];
        $newService->icon = $service['icon'];
        $newService->service_id = $service['service_id'];
        $newService->save();
    }
}

}
