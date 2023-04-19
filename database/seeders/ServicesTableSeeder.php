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
            'description' => 'We develop morden and compatable websites. Check out our packages below.',
            'price' => 9.99,
            'icon' => '1677056958_staticcccc.png',
            'service_id' => 'S001',
        ],
        [
            'name' => 'Office Automation',
            'description' => 'We help business to automate their offices as the wolrd is going Auto',
            'price' => 19.99,
            'icon' => '1677147743_service.jpg',
            'service_id' => 'S002',
        ],
        [
            'name' => 'Software Development',
            'description' => 'We develop morden and compatable applications for mobiles and tablets. Check out our packages below.',
            'price' => 29.99,
            'icon' => '1675270999_Software Development.png',
            'service_id' => 'S003',
        ],
    ];

    foreach ($services as $service) {
        $newService = new Service();
        $newService->name = $service['name'];
        $newService->description = $service['description'];
        $newService->price = $service['price'];
        $newService->icon = $service['icon'];
        $newService->service_id = $service['service_id'];
        $newService->save();
    }
}

}
