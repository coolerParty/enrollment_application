<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrs = [
            ['sub_code' => 'Eng 1', 'sub_name'=>'English 1', 'created_at' => now(), 'updated_at' => now()],
            ['sub_code' => 'Eng 2', 'sub_name'=>'English 2', 'created_at' => now(), 'updated_at' => now()],
            ['sub_code' => 'Math 1', 'sub_name'=>'Algebra', 'created_at' => now(), 'updated_at' => now()],
            ['sub_code' => 'Math 2', 'sub_name'=>'Calculus', 'created_at' => now(), 'updated_at' => now()],
            ['sub_code' => 'Programming 1', 'sub_name'=>'Java', 'created_at' => now(), 'updated_at' => now()],
            ['sub_code' => 'Programming 2', 'sub_name'=>'Python', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach($arrs as $ar){
            Subject::create($ar);
        }
    }
}
