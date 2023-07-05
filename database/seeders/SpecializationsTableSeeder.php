<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Software Developer
        $data = [
            [
                'occup_id' => 1,
                'spec_id' => 1,
                'specialization_name' => 'Software Architect',
            ],

            [
                'occup_id' => 1,
                'spec_id' => 2,
                'specialization_name' => 'Information Architect Software',
            ],

            [
                'occup_id' => 1,
                'spec_id' => 3,
                'specialization_name' => 'Software Designer',
            ],

            [
                'occup_id' => 1,
                'spec_id' => 4,
                'specialization_name' => 'Software Engineer',
            ],

            [
                'occup_id' => 1,
                'spec_id' => 5,
                'specialization_name' => 'ICT Risk Specialist',
            ],
            // Computer Network and Systems
            [
                'occup_id' => 2,
                'spec_id' => 6,
                'specialization_name' => 'Computer Systems/Service Engineer',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 7,
                'specialization_name' => 'Systems Integrator',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 8,
                'specialization_name' => 'Computer Systems Integrator',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 9,
                'specialization_name' => 'Network Engineer',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 10,
                'specialization_name' => 'Communications Analyst (Computers)',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 11,
                'specialization_name' => 'Systems Engineer',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 12,
                'specialization_name' => 'Network Support Engineer',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 13,
                'specialization_name' => 'ICT Customer Support Officer',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 14,
                'specialization_name' => 'Network Programmer/Analyst',
            ],

            [
                'occup_id' => 2,
                'spec_id' => 15,
                'specialization_name' => 'Computer Network Engineer',
            ],
            // ICT Systems Analyst
            [
                'occup_id' => 3,
                'spec_id' => 16,
                'specialization_name' => 'Computer Analyst',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 17,
                'specialization_name' => 'ICT Systems Contractor',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 18,
                'specialization_name' => 'ICT Systems Coordinator',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 19,
                'specialization_name' => 'Capacity Planner Computing',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 20,
                'specialization_name' => 'LAN/WAN Consultant/Specialist',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 21,
                'specialization_name' => 'ICT Systems Architect',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 22,
                'specialization_name' => 'Systems Programmer',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 23,
                'specialization_name' => 'Internet Consultant/Specialist',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 24,
                'specialization_name' => 'ICT Systems Consultant',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 25,
                'specialization_name' => 'ICT Business Systems Analyst',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 26,
                'specialization_name' => 'ICT Systems Specialist',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 27,
                'specialization_name' => 'ICT Systems Advisor',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 28,
                'specialization_name' => 'ICT Systems Designer',
            ],

            [
                'occup_id' => 3,
                'spec_id' => 29,
                'specialization_name' => 'ICT Systems Strategist',
            ],
            // Management Consultant (Business Analyst)   
            [
                'occup_id' => 4,
                'spec_id' => 30,
                'specialization_name' => 'Management Consulting Specialist',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 31,
                'specialization_name' => 'Superannuation Transitions Specialist ',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 32,
                'specialization_name' => 'Technology Development Coordinator',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 33,
                'specialization_name' => 'Operations Analyst',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 34,
                'specialization_name' => 'Services Solutions Project Manager',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 35,
                'specialization_name' => 'Small Business Consultant/Mentor',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 36,
                'specialization_name' => 'Capital Expenditure Analyst',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 37,
                'specialization_name' => 'Commercial Analyst',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 38,
                'specialization_name' => 'Corporate Planner',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 39,
                'specialization_name' => 'Farm Management Consultant',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 40,
                'specialization_name' => 'Business Coach',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 41,
                'specialization_name' => 'Financial Systems Advisor',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 42,
                'specialization_name' => 'Resource Development Analyst',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 43,
                'specialization_name' => 'Purchase Advisor',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 44,
                'specialization_name' => 'Business Support Project Manager',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 45,
                'specialization_name' => 'Strategic Developer/Facilitator',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 46,
                'specialization_name' => 'Business Consultant',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 47,
                'specialization_name' => 'Management Reporting Analyst',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 48,
                'specialization_name' => 'Business Turnaround Management Consultant',
            ],

            [
                'occup_id' => 4,
                'spec_id' => 49,
                'specialization_name' => 'E-commerce Programme Manager',
            ],

            [
                'occup_id' => 5,
                'spec_id' => 50,
                'specialization_name' => 'Internet Security Architect/Engineer/Consultant',
            ],

            [
                'occup_id' => 5,
                'spec_id' => 51,
                'specialization_name' => 'Security Administrator',
            ],
            
            [
                'occup_id' => 5,
                'spec_id' => 52,
                'specialization_name' => 'ICT Security Architect',
            ],
            
            [
                'occup_id' => 5,
                'spec_id' => 53,
                'specialization_name' => 'Database Security Expert',
            ],
            
            [
                'occup_id' => 5,
                'spec_id' => 54,
                'specialization_name' => 'Information Technology Security Manager',
            ],
            
            [
                'occup_id' => 6,
                'spec_id' => 55,
                'specialization_name' => 'Digital Media Specialist',
            ],
            
            [
                'occup_id' => 6,
                'spec_id' => 56,
                'specialization_name' => 'Multimedia Developer',
            ],
            
            [
                'occup_id' => 6,
                'spec_id' => 57,
                'specialization_name' => 'Graphical Programmer',
            ],
            
            [
                'occup_id' => 6,
                'spec_id' => 58,
                'specialization_name' => 'Computer Games Programmer',
            ],
            
            [
                'occup_id' => 6,
                'spec_id' => 59,
                'specialization_name' => 'Multimedia Programmer',
            ],
            
            [
                'occup_id' => 6,
                'spec_id' => 60,
                'specialization_name' => 'Animation Programmer',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 61,
                'specialization_name' => 'Software Configuration/Licensing Specialist',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 62,
                'specialization_name' => 'Designer(Hardware - Digital/Software)',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 63,
                'specialization_name' => 'Architect (Aplications/Call Center/Computing/Desktop/E-commerse)',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 64,
                'specialization_name' => 'Education Systems Coordinator',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 65,
                'specialization_name' => 'Computing (Development/Field) Engineer',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 66,
                'specialization_name' => 'Cross Enterprise Integrator',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 67,
                'specialization_name' => 'Engineer (Applications/Content/IT/Software/Systems/WAN)',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 68,
                'specialization_name' => 'Architect (Enterprise/Internet/IT/Network/Software/Unix/Web)',
            ],
            
            [
                'occup_id' => 7,
                'spec_id' => 69,
                'specialization_name' => 'Database Designer',
            ],
            
            [
                'occup_id' => 8,
                'spec_id' => 70,
                'specialization_name' => 'ICT Developer',
            ],
            
            [
                'occup_id' => 8,
                'spec_id' => 71,
                'specialization_name' => 'ICT Programmer',
            ],
            
            [
                'occup_id' => 8,
                'spec_id' => 72,
                'specialization_name' => 'Applications Developer',
            ],
            
            [
                'occup_id' => 9,
                'spec_id' => 73,
                'specialization_name' => 'ICT/IT/Computer Service Manager',
            ],
            
            [
                'occup_id' => 9,
                'spec_id' => 74,
                'specialization_name' => 'ICT/IT/Computer Marketing Executive',
            ],
            
            [
                'occup_id' => 9,
                'spec_id' => 75,
                'specialization_name' => 'ICT/IT/Computer Support Manager',
            ],
            
            [
                'occup_id' => 9,
                'spec_id' => 76,
                'specialization_name' => 'Hardware Developer Manager',
            ],
            
            [
                'occup_id' => 9,
                'spec_id' => 77,
                'specialization_name' => 'ICT Project Director',
            ],
            
            [
                'occup_id' => 9,
                'spec_id' => 78,
                'specialization_name' => 'ICT/IT/Computer Operations Manager',
            ],
            
            [
                'occup_id' => 10,
                'spec_id' => 79,
                'specialization_name' => 'Computer Consultant',
            ],
            
            [
                'occup_id' => 10,
                'spec_id' => 80,
                'specialization_name' => 'Computer Software Support Consultant',
            ],
            
            [
                'occup_id' => 10,
                'spec_id' => 81,
                'specialization_name' => 'Computer Systems Consultant',
            ],
        ];
        DB::table('specializations')->insert($data);
    }
}
