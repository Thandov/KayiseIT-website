<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'KIT Accounting',
                'slug' => 'kit-accounting',
                'description' => 'Comprehensive accounting software for businesses of all sizes',
                'status' => 'available',
                'icon_color' => 'green',
                'features' => [
                    'Invoice Management & Tracking',
                    'Financial Reporting & Analytics',
                    'Expense Tracking',
                ],
                'cta_text' => 'Learn More',
                'cta_route' => 'contact',
                'show_on_frontend' => true,
                'display_order' => 1,
            ],
            [
                'name' => 'QR Code Generator',
                'slug' => 'qr-code-generator',
                'description' => 'Generate QR codes for various business needs and applications',
                'status' => 'available',
                'icon_color' => 'blue',
                'features' => [
                    'Multiple QR Code Types',
                    'Customizable Design & Colors',
                    'High-Quality Export Options',
                ],
                'cta_text' => 'Generate QR Code',
                'cta_route' => 'qr-code-generator',
                'show_on_frontend' => true,
                'display_order' => 2,
            ],
            [
                'name' => 'Asset Management',
                'slug' => 'asset-management',
                'description' => 'Track and manage company assets efficiently',
                'status' => 'coming_soon',
                'icon_color' => 'purple',
                'features' => null,
                'cta_text' => 'Learn More',
                'cta_route' => 'contact',
                'show_on_frontend' => false,
                'display_order' => 3,
            ],
            [
                'name' => 'Project Management',
                'slug' => 'project-management',
                'description' => 'Streamline project workflows and collaboration',
                'status' => 'coming_soon',
                'icon_color' => 'indigo',
                'features' => null,
                'cta_text' => 'Learn More',
                'cta_route' => 'contact',
                'show_on_frontend' => false,
                'display_order' => 4,
            ],
            [
                'name' => 'Document Management',
                'slug' => 'document-management',
                'description' => 'Organize and manage documents securely',
                'status' => 'coming_soon',
                'icon_color' => 'teal',
                'features' => null,
                'cta_text' => 'Learn More',
                'cta_route' => 'contact',
                'show_on_frontend' => false,
                'display_order' => 5,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['slug' => $product['slug']],
                $product
            );
        }
    }
}
