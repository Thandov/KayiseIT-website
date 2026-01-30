<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareerStepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        $data = [
            // Occupation No:1 - Software Developer
            // Specialization No:1- Software Architect
            [
                
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 1,
                'step_number' => 5,
                'qualification' => 'Scrum Certification',
            ],
            // Occupation No:1 - Software Developer
            // Specialization No:2 - Information Architect Software
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 5,
                'qualification' => 'Scrum Certification',
            ],
            // Occupation No:1 - Software Developer
            // Specialization No:3 - Software Designer
            [
                
                'occup_id' => 1,
                'spec_id' => 3,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 3,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 3,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 3,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 3,
                'step_number' => 5,
                'qualification' => 'Scrum Certification',
            ],
            // Occupation No:1 - Software Developer
            // Specialization No:4 - Software Engineer 
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 2,
                'step_number' => 5,
                'qualification' => 'Scrum Certification',
            ],
            // Occupation No:1 - Software Developer
            // Specialization No:5 - ICT Risk Specialist 
            [
                
                'occup_id' => 1,
                'spec_id' => 5,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 1,
                'spec_id' => 5,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 5,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 5,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
            [
                'occup_id' => 1,
                'spec_id' => 5,
                'step_number' => 5,
                'qualification' => 'Scrum Certification',
            ],
            // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:6 - Computer Systems/Service Engineer 
            [
                
                'occup_id' => 2,
                'spec_id' => 6,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 6,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 6,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 6,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 6,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:7 - Systems Integrator 
            [
                
                'occup_id' => 2,
                'spec_id' => 7,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 7,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 7,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 7,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 7,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:8 - Computer Systems Integrator 
            [
                
                'occup_id' => 2,
                'spec_id' => 8,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 8,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 8,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 8,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 8,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:9 - Network Engineer 
            [
                
                'occup_id' => 2,
                'spec_id' => 9,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 9,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 9,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 9,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 9,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:10 - Communications Analyst (Computers) 
            [
                
                'occup_id' => 2,
                'spec_id' => 10,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 10,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 10,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 10,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 10,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:11 - Systems Engineer 
            [
                
                'occup_id' => 2,
                'spec_id' => 11,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 11,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 11,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 11,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 11,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:12 - Network Support Engineer 
            [
                
                'occup_id' => 2,
                'spec_id' => 12,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 12,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 12,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 12,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 12,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:13 - ICT Customer Support Officer 
            [
                
                'occup_id' => 2,
                'spec_id' => 13,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 13,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 13,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 13,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 13,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:14 - Network Programmer/Analyst 
            [
                
                'occup_id' => 2,
                'spec_id' => 14,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 14,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 14,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 14,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 14,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
             // Occupation No:2 - Computer Network and Systems Engineer
            // Specialization No:15 - Computer Network Engineer 
            [
                
                'occup_id' => 2,
                'spec_id' => 15,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 15,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 15,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 15,
                'step_number' => 4,
                'qualification' => 'CISCO Certification',
            ],
            [
                
                'occup_id' => 2,
                'spec_id' => 15,
                'step_number' => 5,
                'qualification' => 'CompTIA Network+ Certification',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:16 - Computer Analyst 
            [
                
                'occup_id' => 3,
                'spec_id' => 16,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 16,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 16,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 16,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 16,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 16,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:17 - ICT Systems Contractor 
            [
                
                'occup_id' => 3,
                'spec_id' => 17,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 17,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 17,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 17,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 17,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 17,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:18 - ICT Systems Coordinator 
            [
                
                'occup_id' => 3,
                'spec_id' => 18,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 18,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 18,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 18,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 18,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 18,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:19 - Capacity Planner Computing 
            [
                
                'occup_id' => 3,
                'spec_id' => 19,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 19,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 19,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 19,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 19,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 19,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:20 - LAN/WAN Consultant/Specialist 
            [
                
                'occup_id' => 3,
                'spec_id' => 20,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 20,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 20,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 20,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 20,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 20,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:21 - ICT Systems Architect 
            [
                
                'occup_id' => 3,
                'spec_id' => 21,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 21,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 21,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 21,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 21,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 21,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:22 - Systems Programmer 
            [
                
                'occup_id' => 3,
                'spec_id' => 22,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 22,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 22,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 22,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 22,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 22,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:23 - Internet Consultant/Specialist 
            [
                
                'occup_id' => 3,
                'spec_id' => 23,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 23,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 23,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 23,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 23,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 23,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:24 - ICT Systems Consultant 
            [
                
                'occup_id' => 3,
                'spec_id' => 24,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 24,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 24,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 24,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 24,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 24,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:25 - ICT Business Systems Analyst 
            [
                
                'occup_id' => 3,
                'spec_id' => 25,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 25,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 25,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 25,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 25,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 25,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:26 - ICT Systems Specialist 
            [
                
                'occup_id' => 3,
                'spec_id' => 26,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 26,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 26,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 26,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 26,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 26,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:27 - ICT Systems Advisor 
            [
                
                'occup_id' => 3,
                'spec_id' => 27,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 27,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 27,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 27,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 27,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 27,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:28 - ICT Systems Designer 
            [
                
                'occup_id' => 3,
                'spec_id' => 28,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 28,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 28,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 28,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 28,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 28,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:3 - ICT Systems Analyist
            // Specialization No:29 - ICT Systems Strategist 
            [
                
                'occup_id' => 3,
                'spec_id' => 29,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 29,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 29,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 29,
                'step_number' => 4,
                'qualification' => 'MCSA Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 29,
                'step_number' => 5,
                'qualification' => 'MCSE Certification',
            ],
            [
                
                'occup_id' => 3,
                'spec_id' => 29,
                'step_number' => 6,
                'qualification' => 'Work Intergrated Learning',
            ],
            // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:30 - Management Consulting Specialist 
            [
                
                'occup_id' => 4,
                'spec_id' => 30,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 30,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 30,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 30,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:31 - Superannuation Transitions Specialist 
            [
                
                'occup_id' => 4,
                'spec_id' => 31,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 31,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 31,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 31,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:32 - Technology Development Coordinator 
            [
                
                'occup_id' => 4,
                'spec_id' => 32,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 32,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 32,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 32,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:33 - Operations Analyst 
            [
                
                'occup_id' => 4,
                'spec_id' => 33,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 33,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 33,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 33,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:34 - Services Solutions Project Manager 
            [
                
                'occup_id' => 4,
                'spec_id' => 34,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 34,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 34,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 34,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:35 - Small Business Consultant/Mentor 
            [
                
                'occup_id' => 4,
                'spec_id' => 35,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 35,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 35,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 35,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:36 - Capital Expenditure Analyst 
            [
                
                'occup_id' => 4,
                'spec_id' => 36,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 36,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 36,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 36,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:37 - Commercial Analyst 
            [
                
                'occup_id' => 4,
                'spec_id' => 37,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 37,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 37,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 37,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:38 - Corporate Planner 
            [
                
                'occup_id' => 4,
                'spec_id' => 38,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 38,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 38,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 38,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:39 - Farm Management Consultant 
            [
                
                'occup_id' => 4,
                'spec_id' => 39,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 39,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 39,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 39,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:40 - Business Coach 
            [
                
                'occup_id' => 4,
                'spec_id' => 40,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 40,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 40,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 40,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:41 - Financial Systems Advisor 
            [
                
                'occup_id' => 4,
                'spec_id' => 41,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 41,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 41,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 41,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:42 - Resource Development Analyst 
            [
                
                'occup_id' => 4,
                'spec_id' => 42,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 42,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 42,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 42,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:43 - Purchase Advisor 
            [
                
                'occup_id' => 4,
                'spec_id' => 43,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 43,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 43,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 43,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:44 - Business Support Project Manager 
            [
                
                'occup_id' => 4,
                'spec_id' => 44,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 44,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 44,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 44,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:45 - Strategic Developer/Facilitator 
            [
                
                'occup_id' => 4,
                'spec_id' => 45,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 45,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 45,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 45,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:46 - Business Consultant 
            [
                
                'occup_id' => 4,
                'spec_id' => 46,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 46,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 46,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 46,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:47 - Management Reporting Analyst 
            [
                
                'occup_id' => 4,
                'spec_id' => 47,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 47,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 47,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 47,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:48 - Business Turnaround Management Consultant 
            [
                
                'occup_id' => 4,
                'spec_id' => 48,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 48,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 48,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 48,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:4 - Management Consultant (Business Analyst)
            // Specialization No:49 - E-commerce Programme Manager 
            [
                
                'occup_id' => 4,
                'spec_id' => 49,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 49,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 49,
                'step_number' => 3,
                'qualification' => 'IIBA Certification Business Analysis Body of Knowledge',
            ],
            [
                
                'occup_id' => 4,
                'spec_id' => 49,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
              // Occupation No:5 - ICT Security Specialist
            // Specialization No:50 - Internet Security Architect/Engineer/Consultant 
            [
                
                'occup_id' => 5,
                'spec_id' => 50,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 50,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 50,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 50,
                'step_number' => 4,
                'qualification' => 'CompTIA Security+ Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 50,
                'step_number' => 5,
                'qualification' => 'CISSP Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 50,
                'step_number' => 6,
                'qualification' => 'Work Integrated Learning',
            ],
              // Occupation No:5 - ICT Security Specialist
            // Specialization No:51 - Security Administrator 
            [
                
                'occup_id' => 5,
                'spec_id' => 51,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 51,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 51,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 51,
                'step_number' => 4,
                'qualification' => 'CompTIA Security+ Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 51,
                'step_number' => 5,
                'qualification' => 'CISSP Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 51,
                'step_number' => 6,
                'qualification' => 'Work Integrated Learning',
            ],
              // Occupation No:5 - ICT Security Specialist
            // Specialization No:52 - ICT Security Architect 
            [
                
                'occup_id' => 5,
                'spec_id' => 52,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 52,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 52,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 52,
                'step_number' => 4,
                'qualification' => 'CompTIA Security+ Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 52,
                'step_number' => 5,
                'qualification' => 'CISSP Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 52,
                'step_number' => 6,
                'qualification' => 'Work Integrated Learning',
            ],
              // Occupation No:5 - ICT Security Specialist
            // Specialization No:53 - Database Security Expert 
            [
                
                'occup_id' => 5,
                'spec_id' => 53,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 53,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 53,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 53,
                'step_number' => 4,
                'qualification' => 'CompTIA Security+ Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 53,
                'step_number' => 5,
                'qualification' => 'CISSP Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 53,
                'step_number' => 6,
                'qualification' => 'Work Integrated Learning',
            ],
              // Occupation No:5 - ICT Security Specialist
            // Specialization No:54 - Information Technology Security Manager 
            [
                
                'occup_id' => 5,
                'spec_id' => 54,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 54,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 54,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 54,
                'step_number' => 4,
                'qualification' => 'CompTIA Security+ Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 54,
                'step_number' => 5,
                'qualification' => 'CISSP Certification',
            ],
            [
                
                'occup_id' => 5,
                'spec_id' => 54,
                'step_number' => 6,
                'qualification' => 'Work Integrated Learning',
            ],
              // Occupation No:6 - Multi-media Specialist
            // Specialization No:55 - Digital Media Specialist 
            [
                
                'occup_id' => 6,
                'spec_id' => 55,
                'step_number' => 1,
                'qualification' => 'Degree/ Diploma/ National Certificate',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 55,
                'step_number' => 2,
                'qualification' => 'Work Integrated Learning',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 55,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 55,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 55,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
             // Occupation No:6 - Multi-media Specialist
            // Specialization No:56 - Multimedia Developer 
            [
                
                'occup_id' => 6,
                'spec_id' => 56,
                'step_number' => 1,
                'qualification' => 'Degree/ Diploma/ National Certificate',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 56,
                'step_number' => 2,
                'qualification' => 'Work Integrated Learning',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 56,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 56,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 56,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
             // Occupation No:6 - Multi-media Specialist
            // Specialization No:57 - Graphical Programmer 
            [
                
                'occup_id' => 6,
                'spec_id' => 57,
                'step_number' => 1,
                'qualification' => 'Degree/ Diploma/ National Certificate',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 57,
                'step_number' => 2,
                'qualification' => 'Work Integrated Learning',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 57,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 57,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 57,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
             // Occupation No:6 - Multi-media Specialist
            // Specialization No:58 - Computer Games Programmer 
            [
                
                'occup_id' => 6,
                'spec_id' => 58,
                'step_number' => 1,
                'qualification' => 'Degree/ Diploma/ National Certificate',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 58,
                'step_number' => 2,
                'qualification' => 'Work Integrated Learning',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 58,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 58,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 58,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
             // Occupation No:6 - Multi-media Specialist
            // Specialization No:59 - Multimedia Programmer 
            [
                
                'occup_id' => 6,
                'spec_id' => 59,
                'step_number' => 1,
                'qualification' => 'Degree/ Diploma/ National Certificate',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 59,
                'step_number' => 2,
                'qualification' => 'Work Integrated Learning',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 59,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 59,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 59,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
             // Occupation No:6 - Multi-media Specialist
            // Specialization No:60 - Animation Programmer 
            [
                
                'occup_id' => 6,
                'spec_id' => 60,
                'step_number' => 1,
                'qualification' => 'Degree/ Diploma/ National Certificate',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 60,
                'step_number' => 2,
                'qualification' => 'Work Integrated Learning',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 60,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 60,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 6,
                'spec_id' => 60,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:61 - Software Configuration/Licensing Specialist 
            [
                
                'occup_id' => 7,
                'spec_id' => 61,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 61,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 61,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 61,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:62 - Designer(Hardware - Digital/Software) 
            [
                
                'occup_id' => 7,
                'spec_id' => 62,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 62,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 62,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 62,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:63 - Architect (Aplications/Call Center/Computing/Desktop/E-commerse) 
            [
                
                'occup_id' => 7,
                'spec_id' => 63,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 63,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 63,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 63,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:64 - Education Systems Coordinator 
            [
                
                'occup_id' => 7,
                'spec_id' => 64,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 64,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 64,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 64,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:65 - Computing (Development/Field) Engineer 
            [
                
                'occup_id' => 7,
                'spec_id' => 65,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 65,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 65,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 65,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:66 - Cross Enterprise Integrator 
            [
                
                'occup_id' => 7,
                'spec_id' => 66,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 66,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 66,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 66,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:67 - Engineer (Applications/Content/IT/Software/Systems/WAN) 
            [
                
                'occup_id' => 7,
                'spec_id' => 67,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 67,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 67,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 67,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:68 - Architect (Enterprise/Internet/IT/Network/Software/Unix/Web) 
            [
                
                'occup_id' => 7,
                'spec_id' => 68,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 68,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 68,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 68,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:7 - Programmer Analyist
            // Specialization No:69 - Database Designer 
            [
                
                'occup_id' => 7,
                'spec_id' => 69,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 69,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 69,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 7,
                'spec_id' => 69,
                'step_number' => 4,
                'qualification' => 'Work Integrated Learning',
            ],
             // Occupation No:8 - Developer Programmer
            // Specialization No:70 - ICT Developer 
            [
                
                'occup_id' => 8,
                'spec_id' => 70,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 70,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 70,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 70,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
             // Occupation No:8 - Developer Programmer
            // Specialization No:71 - ICT Programmer 
            [
                
                'occup_id' => 8,
                'spec_id' => 71,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 71,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 71,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 71,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
             // Occupation No:8 - Developer Programmer
            // Specialization No:72 - Applications Developer 
            [
                
                'occup_id' => 8,
                'spec_id' => 72,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 72,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 72,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 8,
                'spec_id' => 72,
                'step_number' => 4,
                'qualification' => 'MCSD Certification',
            ],
             // Occupation No:9 - ICT Project Manager
            // Specialization No:73 - ICT/IT/Computer Service Manager 
            [
                
                'occup_id' => 9,
                'spec_id' => 73,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 73,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 73,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 73,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 73,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 73,
                'step_number' => 6,
                'qualification' => 'PRINCE2 Certification',
            ],
             // Occupation No:9 - ICT Project Manager
            // Specialization No:74 - ICT/IT/Computer Marketing Executive 
            [
                
                'occup_id' => 9,
                'spec_id' => 74,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 74,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 74,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 74,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 74,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 74,
                'step_number' => 6,
                'qualification' => 'PRINCE2 Certification',
            ],
             // Occupation No:9 - ICT Project Manager
            // Specialization No:75 - ICT/IT/Computer Support Manager 
            [
                
                'occup_id' => 9,
                'spec_id' => 75,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 75,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 75,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 75,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 75,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 75,
                'step_number' => 6,
                'qualification' => 'PRINCE2 Certification',
            ],
             // Occupation No:9 - ICT Project Manager
            // Specialization No:76 - Hardware Developer Manager 
            [
                
                'occup_id' => 9,
                'spec_id' => 76,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 76,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 76,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 76,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 76,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 76,
                'step_number' => 6,
                'qualification' => 'PRINCE2 Certification',
            ],
             // Occupation No:9 - ICT Project Manager
            // Specialization No:77 - ICT Project Director 
            [
                
                'occup_id' => 9,
                'spec_id' => 77,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 77,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 77,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 77,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 77,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 77,
                'step_number' => 6,
                'qualification' => 'PRINCE2 Certification',
            ],
             // Occupation No:9 - ICT Project Manager
            // Specialization No:78 - ICT/IT/Computer Operations Manager 
            [
                
                'occup_id' => 9,
                'spec_id' => 78,
                'step_number' => 1,
                'qualification' => 'Diploma',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 78,
                'step_number' => 2,
                'qualification' => 'Bachelor\'s Degree',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 78,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 78,
                'step_number' => 4,
                'qualification' => 'Learnership',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 78,
                'step_number' => 5,
                'qualification' => 'Skills Programme',
            ],
            [
                
                'occup_id' => 9,
                'spec_id' => 78,
                'step_number' => 6,
                'qualification' => 'PRINCE2 Certification',
            ],
             // Occupation No:10 - ICT Sales Representative
            // Specialization No:79 - Computer Consultant 
            [
                
                'occup_id' => 10,
                'spec_id' => 79,
                'step_number' => 1,
                'qualification' => 'Bursary (National Certificate)',
            ],
            [
                
                'occup_id' => 10,
                'spec_id' => 79,
                'step_number' => 2,
                'qualification' => 'Short Programme',
            ],
            [
                'occup_id' => 10,
                'spec_id' => 79,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
             // Occupation No:10 - ICT Sales Representative
            // Specialization No:80 - Computer Software Support Consultant 
            [
                'occup_id' => 10,
                'spec_id' => 80,
                'step_number' => 1,
                'qualification' => 'Bursary (National Certificate)',
            ],
            [
                'occup_id' => 10,
                'spec_id' => 80,
                'step_number' => 2,
                'qualification' => 'Short Programme',
            ],
            [
                'occup_id' => 10,
                'spec_id' => 80,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
             // Occupation No:10 - ICT Sales Representative
            // Specialization No:79 - Computer Systems Consultant 
            [
                'occup_id' => 10,
                'spec_id' => 81,
                'step_number' => 1,
                'qualification' => 'Bursary (National Certificate)',
            ],
            [
                'occup_id' => 10,
                'spec_id' => 81,
                'step_number' => 2,
                'qualification' => 'Short Programme',
            ],
            [
                'occup_id' => 10,
                'spec_id' => 81,
                'step_number' => 3,
                'qualification' => 'Internship',
            ],
            
        ];
        DB::table('career_steps')->insert($data);
    }
}
