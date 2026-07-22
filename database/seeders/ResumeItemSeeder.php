<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResumeItem;

class ResumeItemSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Experiences
        ResumeItem::create([
            'type' => 'experience',
            'title' => 'Medical Laboratory Manager',
            'subtitle' => 'Kaafi hospital',
            'date_range' => 'Sep 2025 - Present',
            'description' => 'Medical Laboratory Manager responsibilities.',
            'sort_order' => 10,
        ]);

        ResumeItem::create([
            'type' => 'experience',
            'title' => 'Medical Laboratory Manager & Lab Specialist',
            'subtitle' => 'Modern Medical & Fertility Center',
            'date_range' => 'Aug 2023 - May 2025',
            'description' => 'In my previous role as Laboratory Manager at a fertility center, I managed the entire laboratory while performing a wide range of diagnostic tests. My responsibilities included conducting specialized fertility tests such as semen analysis, fertility hormone evaluations, and advanced pregnancy testing. I ensured the highest standards of accuracy and quality control in the lab, while also overseeing day-to-day operations and supporting patient care through detailed test results.',
            'sort_order' => 20,
        ]);

        ResumeItem::create([
            'type' => 'experience',
            'title' => 'Internal Practical Supervisor & Lecturer',
            'subtitle' => 'Citycot University College',
            'date_range' => 'Sep 2024 - Jan 2025',
            'description' => 'As a faculty member in medical laboratory sciences, I supervise and train students in practical, hands-on applications across a wide range of lab topics. I guide students through real-world laboratory procedures, helping them develop essential technical skills and critical thinking. In addition to teaching various subjects, I actively contribute to academic research, conducting and publishing research papers under the university’s name. I am passionate about motivating and mentoring students, encouraging their engagement in research and driving them toward academic and professional success, while ensuring they effectively integrate theoretical knowledge with practical experience.',
            'sort_order' => 30,
        ]);

        ResumeItem::create([
            'type' => 'experience',
            'title' => 'Internal Practical Supervisor & Lecturer',
            'subtitle' => 'University of Bosaso',
            'date_range' => 'Jan 2021 - Aug 2024',
            'description' => 'In my role as a faculty member in medical laboratory sciences, I was responsible for supervising and training students in practical applications across various medical lab topics. I guided students through real-world laboratory procedures, helping them develop essential technical skills and critical thinking. Additionally, I taught a range of subjects related to medical laboratory science, ensuring students could effectively connect theoretical knowledge with practical experience.',
            'sort_order' => 40,
        ]);

        ResumeItem::create([
            'type' => 'experience',
            'title' => 'Medical Laboratory Technologist',
            'subtitle' => 'Alrayan Specialized Laboratory',
            'date_range' => 'Jun 2019 - Nov 2020',
            'description' => 'During my tenure at Alrayan Specialized Laboratory in Sudan, I was responsible for performing a wide range of diagnostic tests, ensuring quality control, conducting machine checkups, and preparing detailed reports. The lab operated with fully automated devices and specialized in advanced immunology, clinical chemistry, hematology, and routine lab services. I also gained expertise in various diagnostic techniques, including ELISA, immunoblotting, immunoassays, and hematological procedures, contributing to accurate diagnoses and efficient lab operations.',
            'sort_order' => 50,
        ]);

        ResumeItem::create([
            'type' => 'experience',
            'title' => 'Medical laboratory Specialist',
            'subtitle' => 'National Health Insurance Fund SUDAN',
            'date_range' => 'Jul 2015 - May 2018',
            'description' => 'As Co-Manager of the Central Diagnostic Laboratory, I played a pivotal role in overseeing laboratory operations and ensuring the smooth functioning of a high-tech diagnostic environment. The lab was equipped with advanced devices from renowned brands, including the TOSOH Immunoassay Analyzer, Mindray CBC Analyzer, and Biosystems A15 Chemistry Analyzer, among others. I was responsible for managing the performance and maintenance of these instruments, ensuring accurate and timely diagnostics, while optimizing lab efficiency and adhering to the highest standards of quality control.',
            'sort_order' => 60,
        ]);

        // 2. Systemic Education (user specified: high diploma, msc qualifying, bsc)
        ResumeItem::create([
            'type' => 'systemic_education',
            'title' => 'Diploma, Clinical/Medical Laboratory Science/Research and Allied Professions',
            'subtitle' => 'Westeren Nile College',
            'date_range' => 'Sep 2024 - Sep 2025',
            'description' => 'High diploma in medical lab science.',
            'sort_order' => 70,
        ]);

        ResumeItem::create([
            'type' => 'systemic_education',
            'title' => 'MSC QUALIFYING YEAR, Clinical Laboratory Science',
            'subtitle' => 'University of Khartoum',
            'date_range' => '2016 - 2017',
            'description' => 'This is one year after completing Bachelor degree which qualifies me to start master Studies.',
            'sort_order' => 80,
        ]);

        ResumeItem::create([
            'type' => 'systemic_education',
            'title' => 'Bachelor\'s degree, Medical Laboratory Science',
            'subtitle' => 'National University - Sudan',
            'date_range' => '2011 - 2015',
            'description' => 'BSC from national university sudan.',
            'sort_order' => 90,
        ]);

        // 3. Courses (user specified: "all the others except moh uae and sudan medical professions")
        ResumeItem::create([
            'type' => 'course',
            'title' => 'Introduction to Statistics',
            'subtitle' => 'Stanford University',
            'date_range' => 'Mar 2024 - Jun 2024',
            'sort_order' => 100,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Bioinformatics Long course, Medical Informatics',
            'subtitle' => 'Peking University',
            'date_range' => 'Feb 2024 - Jul 2024',
            'sort_order' => 110,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Diploma , Data Analytics',
            'subtitle' => 'Coursera',
            'date_range' => '2021 - 2022',
            'description' => 'Data Analytics CAREER New career shift that focuses on using python and excel and SQL and other languages to collect, process, Analyze Data.',
            'sort_order' => 120,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'McKinsey.org Forward Program',
            'subtitle' => 'McKinsey & Company',
            'date_range' => 'Jul 2025',
            'sort_order' => 130,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Teaching in University Science Laboratories',
            'subtitle' => 'University of Amsterdam',
            'date_range' => 'Jul 2025',
            'sort_order' => 140,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Data Science Methodology',
            'subtitle' => 'IBM',
            'date_range' => 'Jun 2025',
            'sort_order' => 150,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Tools for Data Science',
            'subtitle' => 'IBM',
            'date_range' => 'May 2025',
            'sort_order' => 160,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Data Science Orientation & What is Data Science?',
            'subtitle' => 'IBM & Coursera',
            'date_range' => 'Dec 2024',
            'sort_order' => 170,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Python for Genomic Data Science',
            'subtitle' => 'The Johns Hopkins University',
            'date_range' => 'Oct 2024',
            'sort_order' => 180,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Getting Started with Front-End and Web Development',
            'subtitle' => 'IBM',
            'date_range' => 'May 2024',
            'sort_order' => 190,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Prepare Data for Exploration & Ask Questions',
            'subtitle' => 'Google',
            'date_range' => '2024',
            'sort_order' => 200,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Introduction to Genomic Technologies',
            'subtitle' => 'John Hopkins University',
            'date_range' => 'May 2024',
            'sort_order' => 210,
        ]);

        ResumeItem::create([
            'type' => 'course',
            'title' => 'Foundations: Data, Data, Everywhere',
            'subtitle' => 'Google',
            'date_range' => 'Feb 2022',
            'sort_order' => 220,
        ]);

        // 4. Licenses
        ResumeItem::create([
            'type' => 'license',
            'title' => 'MOH Liscence Certificate',
            'subtitle' => 'Ministry of Health and Prevention - UAE',
            'date_range' => 'Aug 2022 - Aug 2027',
            'sort_order' => 230,
        ]);

        ResumeItem::create([
            'type' => 'license',
            'title' => 'Sudan Medical Professions Council License',
            'subtitle' => 'Sudan Medical Professions Council',
            'date_range' => 'Present',
            'sort_order' => 240,
        ]);
    }
}
