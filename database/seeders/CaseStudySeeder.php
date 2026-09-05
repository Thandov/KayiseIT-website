<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseStudy;

class CaseStudySeeder extends Seeder
{
    public function run()
    {
        $caseStudies = [
            [
                'title' => 'Web Development for MyGigGuide.co.za',
                'headline' => 'MyGigGuide got a site that could handle real traffic',
                'client_name' => 'MyGigGuide',
                'sector' => 'Web',
                'year' => '2024',
                'duration' => '12 weeks',
                'problem' => 'The old site was built for a brochure, not for people posting and applying for gigs. It broke on phones, and the team was still moving applications around by email.',
                'solution' => 'We rebuilt the site in Laravel: accounts, gig listings, search, and a simple admin so staff could manage posts without calling a developer. Mobile was the default, not an afterthought.',
                'results' => 'Sign-ups picked up in the first quarter after launch, and most visits now come from phones.',
                'results_list' => [
                    ['text' => 'Registrations roughly doubled in three months'],
                    ['text' => 'About 85% of traffic is on mobile'],
                    ['text' => 'Uptime held above 99.5% after go-live'],
                ],
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Custom LMS WordPress Plugin for NDS Academy',
                'headline' => 'NDS Academy stopped stitching courses together by hand',
                'client_name' => 'NDS Academy',
                'sector' => 'Training',
                'year' => '2024',
                'problem' => 'Off-the-shelf LMS plugins did not match how NDS runs courses: enrolment, assignments, and certificates all lived in different places.',
                'solution' => 'We wrote a WordPress plugin for their actual workflow — courses, progress, submissions, and certificates — and fitted it to the theme they already had.',
                'results' => 'The first intake ran on the new plugin instead of spreadsheets.',
                'results_list' => [
                    ['text' => '500+ students enrolled in the first month'],
                    ['text' => 'Certificates generated automatically, saving about 40 hours a month'],
                    ['text' => 'Instructors can see progress without exporting CSVs'],
                ],
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Network Infrastructure Setup at Child Welfare Nelspruit',
                'headline' => 'Child Welfare Nelspruit got a network that stayed up',
                'client_name' => 'Child Welfare Nelspruit',
                'sector' => 'Infrastructure',
                'year' => '2023',
                'problem' => 'Offices were on ageing kit. Links dropped, files were hard to share, and remote staff had no safe way in.',
                'solution' => 'We put in a proper LAN, firewall, VPN, and shared file access, then tested failover before staff moved over.',
                'results' => 'Outages stopped being a weekly event. Support tickets for “the internet is down” fell.',
                'results_list' => [
                    ['text' => 'Uptime sat at 99.9% after cutover'],
                    ['text' => '50+ staff on VPN without sharing passwords'],
                    ['text' => 'No security incidents recorded since go-live'],
                ],
                'is_featured' => false,
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Youth Training Program in Partnership with Unisa Enterprise and NYDA',
                'headline' => '300 youth finished a digital skills programme on time',
                'client_name' => 'Unisa Enterprise & NYDA',
                'sector' => 'Skills',
                'year' => '2023',
                'problem' => 'The partners had the learners. They did not have a way to register 300 people, run labs, and issue certificates without drowning in paper.',
                'solution' => 'We stood up the training platform, the lab machines, and the assessments, then stayed on site for the intake.',
                'results' => 'The cohort completed. Most went on to work or further study.',
                'results_list' => [
                    ['text' => '300 youth trained and certified'],
                    ['text' => '92% completed the programme'],
                    ['text' => '75% moved into work or further study'],
                ],
                'is_featured' => false,
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Website Revamp and Digital Presence Growth for a Local Business',
                'headline' => 'A slow brochure site started bringing in enquiries',
                'client_name' => 'Local Business Client',
                'sector' => 'Web',
                'year' => '2026',
                'problem' => 'Pages took too long on a phone. Contact details were buried, and Google barely saw the business.',
                'solution' => 'We rebuilt the public pages, cleaned the copy, and pointed the contact paths at one form and one number.',
                'results' => 'The site is usable on a phone. Enquiries come through the form instead of Facebook DMs.',
                'results_list' => [
                    ['text' => 'Pages load faster on mobile'],
                    ['text' => 'More organic visits after the SEO pass'],
                    ['text' => 'Direct enquiries up through the contact form'],
                ],
                'is_featured' => false,
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
