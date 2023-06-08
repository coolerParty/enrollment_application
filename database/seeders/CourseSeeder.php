<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrs = [
            ['course_name' => 'Engineering',            'course_description'=>'BS Engineering', 'gpa' => 60, 'student_limit' => 10, 'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Information Technology', 'course_description'=>'BS IT',          'gpa' => 70, 'student_limit' => 10,  'created_at' => now(), 'updated_at' => now()],
            ['course_name' => 'Nurse',                  'course_description'=>'BS Nursing',     'gpa' => 80, 'student_limit' => 10,  'created_at' => now(), 'updated_at' => now()],
        ];

        foreach($arrs as $ar){
            Course::create($ar);
        }
    }
}
