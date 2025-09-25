<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create([
            'title' => 'Software Developer',
            'description' => 'Develop web applications using Laravel.',
            'responsibilities' => 'Write clean code, collaborate with team.',
            'skills' => 'PHP, Laravel, MySQL',
            'qualifications' => '2+ years experience, degree preferred',
            'salary_min' => 50000,
            'salary_max' => 70000,
            'benefits' => 'Health insurance, remote work',
            'location' => 'Remote',
            'work_type' => 'remote',
            'deadline' => '2025-10-23',
            'employer_id' => 2, // Employer User ID (from DatabaseSeeder)
            'approved' => false,
        ]);

        Job::create([
            'title' => 'Graphic Designer',
            'description' => 'Create visual designs for marketing.',
            'responsibilities' => 'Design graphics, meet deadlines.',
            'skills' => 'Adobe Photoshop, Illustrator',
            'qualifications' => '1+ year experience',
            'salary_min' => 40000,
            'salary_max' => 60000,
            'benefits' => 'Flexible hours',
            'location' => 'New York',
            'work_type' => 'on-site',
            'deadline' => '2025-10-20',
            'employer_id' => 2,
            'approved' => false,
        ]);
    }
}