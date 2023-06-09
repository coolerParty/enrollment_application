<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@admin.com',
            'password' => bcrypt('1234567890')
        ]);
        $adminUser->assignRole('super-admin');

        $adminUser = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('1234567890')
        ]);
        $adminUser->assignRole('admin');

        $student = User::factory()->create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('1234567890')
        ]);
    }
}
