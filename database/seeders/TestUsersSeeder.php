<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Aisha',
                'last_name' => 'Uwimana',
                'name' => 'Aisha Uwimana',
                'email' => 'aisha.uwimana@example.com',
                'password' => Hash::make('password123'),
                'title' => 'Dr.',
                'highest_qualification' => 'Doctorate (PhD or equivalent doctoral degree)',
                'institution' => 'University of Rwanda',
                'job_title' => 'Senior Lecturer in Computer Science',
                'country' => 'Rwanda',
                'bio' => 'Dr. Aisha Uwimana is a passionate computer scientist with over 10 years of experience in artificial intelligence and machine learning research. She specializes in natural language processing applications for African languages and has published extensively in top-tier conferences. Her work focuses on developing AI solutions that address local challenges in education and healthcare across the SADC region.',
                'keywords' => 'artificial intelligence, machine learning, natural language processing, computer science, African languages, educational technology, healthcare AI',
                'areas_of_interest' => ['Research collaboration', 'Academic supervision', 'Teaching', 'SDG-related work'],
                'isced_codes' => ['06 – ICT', '05 – Natural Sciences, Mathematics and Statistics', '01 – Education'],
                'registration_step' => 3,
            ],
            [
                'first_name' => 'James',
                'last_name' => 'Ochieng',
                'name' => 'James Ochieng',
                'email' => 'james.ochieng@example.com',
                'password' => Hash::make('password123'),
                'title' => 'Prof.',
                'highest_qualification' => 'Doctorate (PhD or equivalent doctoral degree)',
                'institution' => 'University of Nairobi',
                'job_title' => 'Professor of Agricultural Data Science',
                'country' => 'Kenya',
                'bio' => 'Professor James Ochieng is a renowned agricultural data scientist and climate researcher with 15 years of experience. He leads multiple international research projects on climate-smart agriculture and food security in East Africa. His interdisciplinary approach combines advanced data analytics with traditional agricultural knowledge to develop sustainable farming solutions for smallholder farmers.',
                'keywords' => 'agricultural data science, climate change, food security, sustainable agriculture, precision farming, remote sensing, climate modeling, smallholder farming',
                'areas_of_interest' => ['Research collaboration', 'Academic supervision', 'Grant writing', 'Community engagement', 'SDG-related work'],
                'isced_codes' => ['08 – Agriculture, Forestry, Fisheries and Veterinary', '05 – Natural Sciences, Mathematics and Statistics', '06 – ICT'],
                'registration_step' => 3,
            ],
            [
                'first_name' => 'Fatima',
                'last_name' => 'Hassan',
                'name' => 'Fatima Hassan',
                'email' => 'fatima.hassan@example.com',
                'password' => Hash::make('password123'),
                'title' => 'Dr.',
                'highest_qualification' => 'Doctorate (PhD or equivalent doctoral degree)',
                'institution' => 'University of Cape Town',
                'job_title' => 'Associate Professor of Public Health',
                'country' => 'South Africa',
                'bio' => 'Dr. Fatima Hassan is a dedicated public health researcher specializing in epidemiology and health system strengthening in sub-Saharan Africa. She has extensive experience in designing and implementing large-scale health interventions, particularly in maternal and child health. Her research has influenced health policy across multiple SADC countries and contributed to significant improvements in health outcomes.',
                'keywords' => 'public health, epidemiology, health systems, maternal health, child health, health policy, global health, infectious diseases, health equity',
                'areas_of_interest' => ['Research collaboration', 'Academic supervision', 'Community engagement', 'SDG-related work', 'Mentoring'],
                'isced_codes' => ['09 – Health and Welfare', '05 – Natural Sciences, Mathematics and Statistics', '03 – Social Sciences, Journalism and Information'],
                'registration_step' => 3,
            ],
            [
                'first_name' => 'Michael',
                'last_name' => 'Banda',
                'name' => 'Michael Banda',
                'email' => 'michael.banda@example.com',
                'password' => Hash::make('password123'),
                'title' => 'Dr.',
                'highest_qualification' => 'Doctorate (PhD or equivalent doctoral degree)',
                'institution' => 'University of Zambia',
                'job_title' => 'Senior Lecturer in Economics and Development Studies',
                'country' => 'Zambia',
                'bio' => 'Dr. Michael Banda is an accomplished economist specializing in development economics and financial inclusion in Southern Africa. His research focuses on microfinance, entrepreneurship development, and economic empowerment of marginalized communities. He has worked extensively with governments and NGOs across the SADC region to design evidence-based economic policies that promote inclusive growth and poverty reduction.',
                'keywords' => 'development economics, financial inclusion, microfinance, entrepreneurship, economic policy, poverty reduction, inclusive growth, economic empowerment, SADC economics',
                'areas_of_interest' => ['Research collaboration', 'Academic supervision', 'Teaching', 'Community engagement', 'Grant writing'],
                'isced_codes' => ['04 – Business, Administration and Law', '03 – Social Sciences, Journalism and Information', '06 – ICT'],
                'registration_step' => 3,
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
