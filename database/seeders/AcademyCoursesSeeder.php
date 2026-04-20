<?php

namespace Database\Seeders;

use App\Models\AcademyCourse;
use Illuminate\Database\Seeder;

class AcademyCoursesSeeder extends Seeder
{
    /**
     * Default Training & Skills courses (same content as the public page).
     */
    public function run(): void
    {
        $rows = [
            [
                'title' => 'ICT Skills Training',
                'description' => 'A practical course that develops computer literacy, internet skills, and digital communication. Ideal for learners who need strong technology foundations for study and work readiness.',
                'category' => 'Digital Foundations',
                'icon_key' => 'monitor',
                'display_order' => 1,
            ],
            [
                'title' => 'Build a Drone Course',
                'description' => 'Learners assemble and test drones while understanding core STEM concepts, including electronics and systems thinking. This course promotes hands-on problem-solving and innovation.',
                'category' => 'STEM + Hands-On',
                'icon_key' => 'drone_hex',
                'display_order' => 2,
            ],
            [
                'title' => 'Microsoft Office Training',
                'description' => 'Structured training in Word, Excel, PowerPoint, and Outlook to improve academic and workplace performance. Learners gain practical document, data, and presentation skills.',
                'category' => 'Office Productivity',
                'icon_key' => 'document',
                'display_order' => 3,
            ],
            [
                'title' => 'Computer Productivity',
                'description' => 'Focuses on digital efficiency, file management, collaboration tools, and workflow habits that help learners and staff work smarter and complete tasks faster.',
                'category' => 'Workflow Skills',
                'icon_key' => 'bars',
                'display_order' => 4,
            ],
            [
                'title' => 'Cyber Security Training',
                'description' => 'Builds awareness of digital threats and teaches practical online safety, password protection, and data security practices for classrooms, offices, and institutions.',
                'category' => 'Cyber Awareness',
                'icon_key' => 'shield',
                'display_order' => 5,
            ],
            [
                'title' => 'Entrepreneurship Training',
                'description' => 'Introduces learners to business thinking, opportunity identification, and practical startup skills. Supports youth empowerment and enterprise development in local communities.',
                'category' => 'Business Readiness',
                'icon_key' => 'plus',
                'display_order' => 6,
            ],
        ];

        foreach ($rows as $row) {
            AcademyCourse::updateOrCreate(
                ['title' => $row['title']],
                array_merge($row, ['show_on_frontend' => true])
            );
        }
    }
}
