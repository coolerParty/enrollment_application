<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrs = [
            ['user_id' => 1, 'firstname'=>'Arnold',     'lastname'=>'Washington',   'gpa'=>0, 'scholar'=> false,    'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 2, 'firstname'=>'John',       'lastname'=>'Wick',         'gpa'=>0, 'scholar'=> false,    'created_at' => now(), 'updated_at' => now()],
            ['user_id' => 3, 'firstname'=>'Richard',    'lastname'=>'Cooper',       'gpa'=>0, 'scholar'=> false,    'created_at' => now(), 'updated_at' => now()],
        ];

        foreach($arrs as $ar){
            Profile::create($ar);
        }
    }
}
