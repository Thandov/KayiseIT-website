<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use Illuminate\Support\Facades\Storage;
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
        ];

        // Process each partner
        foreach ($partners as $partnerData) {
            // Check if partner already exists
            $existingPartner = Partner::where('name', $partnerData['name'])->first();
            
            if ($existingPartner) {
                $this->command->warn("Partner already exists: {$partnerData['name']}");
                
                // Update logo if it doesn't exist or is broken
                $sourcePath = $publicPath . '/' . $partnerData['logo_file'];
                if (File::exists($sourcePath)) {
                    // Delete old logo if exists
                    if ($existingPartner->logo_path) {
                        Storage::disk('public')->delete($existingPartner->logo_path);
                    }
                    
                    // Read file content and store it using Storage facade (same as controller logic)
                    $fileContent = File::get($sourcePath);
                    $logoPath = 'partners/' . $partnerData['logo_file'];
                    
                    // Store the file using Storage facade
                    Storage::disk('public')->put($logoPath, $fileContent);
                    
                    $existingPartner->logo_path = $logoPath;
                    $existingPartner->save();
                    $this->command->info("Updated logo for: {$partnerData['name']}");
                }
                continue;
            }
            
            // Upload logo file using Storage facade (same as controller logic)
            $sourcePath = $publicPath . '/' . $partnerData['logo_file'];
            
            if (!File::exists($sourcePath)) {
                $this->command->error("Logo file not found: {$sourcePath}");
                continue;
            }
            
            // Read file content and store it using Storage facade (same as controller logic)
            $fileContent = File::get($sourcePath);
            $logoPath = 'partners/' . $partnerData['logo_file'];
            
            // Store the file using Storage facade
            Storage::disk('public')->put($logoPath, $fileContent);
            
            // Set the logo path
            $partnerData['logo_path'] = $logoPath;
            
            // Remove logo_file from data before creating
            unset($partnerData['logo_file']);
            
            // Create partner
            Partner::create($partnerData);
            $this->command->info("Created partner: {$partnerData['name']} with logo: {$logoPath}");
        }

        $this->command->info('Partners seeding completed!');
    }
}
