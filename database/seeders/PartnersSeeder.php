<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use Illuminate\Support\Facades\File;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Source path for logo files
        $publicPath = public_path('images/partners');
        
        // Define partners data with logo file mappings
        $partners = [
            [
                'name' => 'MICT SETA',
                'logo_file' => 'mict.png',
                'logo_path' => null, // Will be set after upload
                'description' => 'Media, Information and Communication Technologies Sector Education and Training Authority',
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Ehlanzeni TVET College',
                'logo_file' => 'Ehlanzeni.png',
                'logo_path' => null, // Will be set after upload
                'description' => 'Technical and Vocational Education and Training institution supporting skills development',
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Tarsus on Demand',
                'logo_file' => 'tarsus.png',
                'logo_path' => null, // Will be set after upload
                'description' => 'Leading technology distribution and solutions provider',
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'SCG South Africa',
                'logo_file' => 'scg.png',
                'logo_path' => null, // Will be set after upload
                'description' => 'Strategic technology and business solutions partner',
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'UMP CFERI',
                'logo_file' => 'ump-cferi.jpg',
                'logo_path' => null,
                'description' => 'University of Mpumalanga Centre for Entrepreneurship Rapid Incubator',
                'website_url' => 'https://www.ump.ac.za/Engagement/CFERI.aspx',
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        // Process each partner
        foreach ($partners as $partnerData) {
            // Check if partner already exists
            $existingPartner = Partner::where('name', $partnerData['name'])->first();
            
            if ($existingPartner) {
                $this->command->warn("Partner already exists: {$partnerData['name']}");
                
                $sourcePath = $publicPath . '/' . $partnerData['logo_file'];
                if (File::exists($sourcePath)) {
                    $logoPath = 'images/partners/' . $partnerData['logo_file'];
                    $existingPartner->logo_path = $logoPath;
                    $existingPartner->save();
                    $this->command->info("Updated logo for: {$partnerData['name']}");
                }
                continue;
            }
            
            $sourcePath = $publicPath . '/' . $partnerData['logo_file'];
            
            if (!File::exists($sourcePath)) {
                $this->command->error("Logo file not found: {$sourcePath}");
                continue;
            }
            
            $partnerData['logo_path'] = 'images/partners/' . $partnerData['logo_file'];
            
            // Remove logo_file from data before creating
            unset($partnerData['logo_file']);
            
            // Create partner
            Partner::create($partnerData);
            $this->command->info("Created partner: {$partnerData['name']} with logo: {$partnerData['logo_path']}");
        }

        $this->command->info('Partners seeding completed!');
    }
}
