<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Service;

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
];

$added = 0;
$skipped = 0;

foreach ($services as $serviceData) {
    $existingService = Service::where('slug', $serviceData['slug'])
        ->orWhere('service_id', $serviceData['service_id'])
        ->first();
    
    if (!$existingService) {
        Service::create($serviceData);
        echo "✓ Added: {$serviceData['name']}\n";
        $added++;
    } else {
        echo "⊘ Skipped: {$serviceData['name']} (already exists)\n";
        $skipped++;
    }
}

echo "\nCompleted! Added: {$added}, Skipped: {$skipped}\n";
