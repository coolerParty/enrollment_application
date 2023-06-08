<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yrs = [
            ['school_yr' => 2023, 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach($yrs as $yr){
            SchoolYear::create($yr);
        }
    }
}
