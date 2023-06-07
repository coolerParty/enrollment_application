<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create permissions
			$permissions = [
				'dashboard-access',
				'role-create',
				'role-edit',
				'role-show',
				'role-delete',
				'permission-create',
				'permission-edit',
				'permission-show',
				'permission-delete',
                'subject-create',
				'subject-edit',
				'subject-show',
				'subject-delete',
                'school-year-create',
				'school-year-edit',
				'school-year-show',
				'school-year-delete',
                'course-year-create',
				'course-year-edit',
				'course-year-show',
				'course-year-delete',

			];

			foreach($permissions as $permission){
				Permission::create([
					'guard_name' => 'web',
					'name' => $permission
				]);
			}



			// gets all permissinos via Gate::before rule; see AuthServiceProvider
			Role::create(['name'=>'super-admin']);



			// Admin Normal Role Start
			$roleAdmin = Role::create(['guard_name' => 'web', 'name' => 'admin']);

			$adminPermissions = [
				'dashboard-access',
				'role-create',
				'role-edit',
				'role-show',
				'role-delete',
				'permission-show',
                'subject-create',
				'subject-edit',
				'subject-show',
				'subject-delete',
                'school-year-create',
				'school-year-edit',
				'school-year-show',
				'school-year-delete',
                'course-year-create',
				'course-year-edit',
				'course-year-show',
				'course-year-delete',
			];

			foreach($adminPermissions as $permission){
				$roleAdmin->givePermissionTo($permission);
			}
			// Admin Normal Role End



    }
}
