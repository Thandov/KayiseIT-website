<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;

class AnnouncementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if announcements already exist to avoid duplicates
        $existingCount = Announcement::count();
        
        if ($existingCount > 0) {
            $this->command->info("Announcements already exist in database. Skipping seed.");
            return;
        }

        $announcements = [
            [
                'title' => 'New Internship Program Launched',
                'message' => "We're launching new internship programs - Apply now!",
                'description' => 'We are excited to announce new internship opportunities for 2024. Apply now and kickstart your IT career!',
                'link' => url('/opportunities'),
                'badge' => 'New',
                'image' => null,
                'is_active' => true,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'title' => 'Software Development Services Update',
                'message' => 'Check out our latest software development services',
                'description' => 'Enhanced our software development capabilities with the latest technologies. Contact us for enterprise solutions.',
                'link' => url('/services'),
                'badge' => 'Update',
                'image' => null,
                'is_active' => true,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'title' => 'TVET Placements Available',
                'message' => 'Openings for TVET students in various IT specializations',
                'description' => 'Openings for TVET students in various IT specializations. Limited spots available - apply soon!',
                'link' => url('/opportunities'),
                'badge' => 'Opportunity',
                'image' => null,
                'is_active' => true,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'title' => 'Website Development Services',
                'message' => 'Professional website development services now available',
                'description' => 'Professional website development services now available. Get your business online today!',
                'link' => url('/services'),
                'badge' => 'Service',
                'image' => null,
                'is_active' => true,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'title' => 'IT Consulting Available',
                'message' => 'Expert IT consulting services to help transform your business',
                'description' => 'Expert IT consulting services to help transform your business digitally. Schedule a consultation today.',
                'link' => url('/contact'),
                'badge' => 'Consulting',
                'image' => null,
                'is_active' => true,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'title' => 'Career Development Programs',
                'message' => 'Join our career development programs and enhance your IT skills',
                'description' => 'Join our career development programs and enhance your IT skills with hands-on training.',
                'link' => url('/career-mapping'),
                'badge' => 'Training',
                'image' => null,
                'is_active' => true,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
        ];

        foreach ($announcements as $announcement) {
            Announcement::create($announcement);
        }

        $this->command->info('Successfully seeded ' . count($announcements) . ' announcements.');
    }
}

