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
            'description' => 'Our company specializes in creating contemporary and adaptable websites. You can view our available packages listed below.',
            'price' => 0.00,
            'icon' => 'web.png',
            'service_id' => 'S001',
        ],
        [
            'name' => 'App Development',
            'description' => 'We develop morden and compatable applications for mobiles and tablets. Check out our packages below.',
            'price' => 0.00,
            'icon' => 'app.png',
            'service_id' => 'S002',
        ],
        [
            'name' => 'Tech Support',
            'description' => 'We offer support to companies and customers when they have problems using tech equipment, software, and/or services.',
            'price' => 0.00,
            'icon' => 'tech.png',
            'service_id' => 'S003',
        ],
        [
            'name' => '4IR Skills Training',
            'description' => 'We provide 4th Industrial Revolution skills training programmes',
            'price' => 0.00,
            'icon' => '4ir.png',
            'service_id' => 'S004',
        ],
        [
            'name' => 'IT Integration Solution',
            'description' => 'We enhance productivity and collect data completely to allow for exact business analyses. Thus, we ensure your company’s competitiveness. IT integration interlinks your system components in a way that will make your IT structure work seamlessly.',
            'price' => 0.00,
            'icon' => 'inter.png',
            'service_id' => 'S005',
        ],
        [
            'name' => 'IT Outsourcing',
            'description' => 'We outsource our services to businesses to effectively deliver IT-enabled business process, application service and infrastructure solutions for business outcomes.',
            'price' => 0.00,
            'icon' => 'out.png',
            'service_id' => 'S006',
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
