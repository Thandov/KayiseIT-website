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
            'name' => 'Software Development',
            'slug' => 'software_development',
            'description' => 'Custom software solutions tailored to your business needs. We develop enterprise applications, APIs, and integration solutions that drive efficiency and growth.',
            'price' => 0.00,
            'icon' => 'software.svg',
            'service_id' => 'S001',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'Web Development',
            'slug' => 'web_development',
            'description' => 'Our company specializes in creating contemporary and adaptable websites. You can view our available packages listed below.',
            'price' => 0.00,
            'icon' => 'web.svg',
            'service_id' => 'S002',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'IT Consulting',
            'slug' => 'it_consulting',
            'description' => 'Strategic IT consulting services to help your business optimize technology infrastructure, plan digital transformation, and maximize operational efficiency.',
            'price' => 0.00,
            'icon' => 'tele.svg',
            'service_id' => 'S003',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'Tech Support',
            'slug' => 'tech_support',
            'description' => 'We offer support to companies and customers when they have problems using tech equipment, software, and/or services.',
            'price' => 0.00,
            'icon' => 'tech.svg',
            'service_id' => 'S004',
            'service_type' => 'dynamic',
        ],
        [
            'name' => '4IR Skills Training',
            'slug' => '4ir_skills_training',
            'description' => 'We provide 4th Industrial Revolution skills training programmes',
            'price' => 0.00,
            'icon' => '4ir.svg',
            'service_id' => 'S005',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'Cloud Hosting Services',
            'slug' => 'cloud_hosting_services',
            'description' => 'Comprehensive cloud hosting solutions on Microsoft Azure, Amazon AWS, and other leading platforms. We help you migrate, manage, and optimize your cloud infrastructure.',
            'price' => 0.00,
            'icon' => 'saas.svg',
            'service_id' => 'S006',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'Data Backup & Recovery',
            'slug' => 'data_backup_recovery',
            'description' => 'Professional data backup, recovery, and cleaning services. We protect your critical data with automated backups and provide fast recovery solutions when disaster strikes.',
            'price' => 0.00,
            'icon' => 'brand.svg',
            'service_id' => 'S007',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'Networking',
            'slug' => 'networking',
            'description' => 'Complete networking solutions including network design, installation, configuration, and maintenance. We ensure reliable connectivity and optimal performance for your business.',
            'price' => 0.00,
            'icon' => 'tele.svg',
            'service_id' => 'S008',
            'service_type' => 'dynamic',
        ],
        [
            'name' => 'Automation Transformation',
            'slug' => 'automation_transformation',
            'description' => 'End-to-end business process automation and digital transformation services. We help organizations streamline workflows, reduce manual effort, and integrate intelligent automation across operations — from RPA and AI-assisted workflows to full enterprise digital transformation strategies.',
            'price' => 0.00,
            'icon' => 'software.svg',
            'service_id' => 'S009',
            'service_type' => 'dynamic',
        ],
    ];

    foreach ($services as $service) {
        // Check if service already exists
        $existingService = Service::where('slug', $service['slug'])->orWhere('service_id', $service['service_id'])->first();
        
        if (!$existingService) {
            $newService = new Service();
            $newService->name = $service['name'];
            $newService->slug = $service['slug'];
            $newService->description = $service['description'];
            $newService->price = $service['price'];
            $newService->icon = $service['icon'];
            $newService->service_id = $service['service_id'];
            $newService->service_type = $service['service_type'] ?? 'dynamic';
            $newService->save();
        }
    }
}

}
