<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseStudy;

class CaseStudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $caseStudies = [
            [
                'title' => 'Web Development for MyGigGuide.co.za',
                'client_name' => 'MyGigGuide',
                'year' => '2024',
                'problem' => 'MyGigGuide needed a modern, user-friendly platform to connect gig workers with opportunities. Their existing website was outdated, lacked mobile responsiveness, and couldn\'t handle the growing user base. The platform needed to support job postings, user profiles, and seamless communication between employers and gig workers.',
                'solution' => 'KAYISE IT developed a comprehensive web platform using modern technologies including Laravel backend and responsive frontend design. We implemented user authentication, job posting and search functionality, real-time messaging, and a robust admin dashboard. The platform was optimized for mobile devices and included features like profile management, application tracking, and rating systems.',
                'results' => 'The new platform transformed MyGigGuide\'s online presence and user engagement.',
                'results_list' => [
                    ['text' => '<strong>200%</strong> increase in user registrations within 3 months'],
                    ['text' => 'Fully responsive design with <strong>85%</strong> mobile traffic'],
                    ['text' => '<strong>99.5%</strong> uptime with improved site performance'],
                    ['text' => 'Seamless user experience with <strong>4.8/5</strong> average user rating'],
                ],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Custom LMS WordPress Plugin for NDS Academy',
                'client_name' => 'NDS Academy',
                'year' => '2024',
                'problem' => 'NDS Academy required a custom Learning Management System (LMS) integrated into their WordPress site. Existing LMS plugins didn\'t meet their specific needs for course management, student progress tracking, and certification. They needed a solution that could handle multiple courses, assignments, quizzes, and provide detailed analytics for instructors.',
                'solution' => 'KAYISE IT built a custom WordPress plugin tailored to NDS Academy\'s requirements. The plugin included course creation and management, student enrollment, progress tracking, assignment submission, automated grading, certificate generation, and comprehensive reporting. We integrated it seamlessly with their existing WordPress theme and ensured it was scalable for future growth.',
                'results' => 'The custom LMS plugin revolutionized NDS Academy\'s online learning capabilities.',
                'results_list' => [
                    ['text' => '<strong>500+</strong> students enrolled within first month'],
                    ['text' => '<strong>95%</strong> course completion rate improvement'],
                    ['text' => 'Automated certificate generation saving <strong>40 hours</strong> per month'],
                    ['text' => 'Comprehensive analytics dashboard for real-time insights'],
                ],
                'is_featured' => true,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Network Infrastructure Setup at Child Welfare Nelspruit',
                'client_name' => 'Child Welfare Nelspruit',
                'year' => '2023',
                'problem' => 'Child Welfare Nelspruit had outdated network infrastructure that was unreliable and insecure. Multiple office locations needed to be connected, staff required secure access to shared resources, and the system needed to support remote work capabilities. Frequent network outages were disrupting critical operations and data security was a major concern.',
                'solution' => 'KAYISE IT designed and implemented a complete network infrastructure solution including secure LAN setup, VPN configuration for remote access, firewall implementation, and centralized file sharing. We configured network switches, routers, and wireless access points to ensure reliable connectivity across all locations. Security measures included encrypted connections, access controls, and regular backup systems.',
                'results' => 'The new network infrastructure significantly improved operations and security.',
                'results_list' => [
                    ['text' => '<strong>99.9%</strong> network uptime achieved'],
                    ['text' => 'Secure remote access for <strong>50+</strong> staff members'],
                    ['text' => '<strong>Zero</strong> security incidents since implementation'],
                    ['text' => '<strong>60%</strong> reduction in IT support tickets'],
                ],
                'is_featured' => true,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Youth Training Program in Partnership with Unisa Enterprise and NYDA',
                'client_name' => 'Unisa Enterprise & NYDA',
                'year' => '2023',
                'problem' => 'Unisa Enterprise and NYDA needed to train 300 youth in digital skills but lacked the technical infrastructure and training platform to deliver the program effectively. They required a scalable solution that could handle large-scale training, track student progress, provide certifications, and support both online and in-person learning components.',
                'solution' => 'KAYISE IT developed a comprehensive training management system and provided technical support for the program. We created a custom platform for course delivery, student registration, progress tracking, and certification. Additionally, we set up training labs with necessary hardware and software, provided technical support throughout the program, and developed assessment tools to measure learning outcomes.',
                'results' => 'The training program successfully equipped 300 youth with valuable digital skills.',
                'results_list' => [
                    ['text' => '<strong>300</strong> youth successfully trained and certified'],
                    ['text' => '<strong>92%</strong> program completion rate'],
                    ['text' => '<strong>75%</strong> of graduates secured employment or further education'],
                    ['text' => 'Scalable platform ready for future training cohorts'],
                ],
                'is_featured' => true,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Website Revamp and Digital Presence Growth for a Local Business',
                'client_name' => 'Local Business Client',
                'year' => '2026',
                'problem' => 'The client had an outdated website with slow loading speed, weak mobile usability, and limited visibility on search engines. Their digital identity was inconsistent across channels, resulting in low online engagement and missed opportunities for lead generation.',
                'solution' => 'KAYISE IT redesigned and optimized the website with a modern responsive interface, improved navigation, and performance enhancements. We strengthened on-page SEO, refined service messaging, and aligned social media and contact pathways to present one consistent and professional digital presence.',
                'results' => 'The client experienced stronger online performance and a measurable uplift in visibility and engagement within the first few months.',
                'results_list' => [
                    ['text' => 'Faster page load times and improved mobile user experience across key pages'],
                    ['text' => 'Increased organic traffic and stronger engagement from website visitors'],
                    ['text' => 'Higher volume of direct inquiries through contact forms and call-to-action channels'],
                    ['text' => 'Client testimonial: "KAYISE IT transformed our online presence completely. Our new website is professional, fast, and easy for our customers to use."'],
                ],
                'is_featured' => true,
                'is_active' => true,
                'order' => 5,
            ],
        ];

        foreach ($caseStudies as $caseStudy) {
            CaseStudy::updateOrCreate(
                ['title' => $caseStudy['title']],
                $caseStudy
            );
        }
    }
}
