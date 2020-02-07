<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'company-list',
            'company-create',
            'company-edit',
            'company-delete',
            'unity-list',
            'unity-create',
            'unity-edit',
            'unity-delete',
        ];

        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
