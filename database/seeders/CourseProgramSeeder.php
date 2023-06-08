<?php

namespace Database\Seeders;

use App\Models\CourseProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrs = [
            ['school_year_id' => 1, 'subject_id'=>5,'course_id' => 1, 'active'=> true, 'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>2,'course_id' => 1, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>3,'course_id' => 1, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>4,'course_id' => 1, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],

            ['school_year_id' => 1, 'subject_id'=>1,'course_id' => 2, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>5,'course_id' => 2, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>6,'course_id' => 2, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],

            ['school_year_id' => 1, 'subject_id'=>1,'course_id' => 3, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>2,'course_id' => 3, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
            ['school_year_id' => 1, 'subject_id'=>3,'course_id' => 3, 'active'=> true,  'created_at' => now(), 'updated_at' => now()],
        ];

        foreach($arrs as $ar){
            CourseProgram::create($ar);
        }
    }
}
