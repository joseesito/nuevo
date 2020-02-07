<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *php artisan db:seed --class=PermissionTableSeeder


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
           'type_course-list',
           'type_course-create',
           'type_course-edit',
           'type_course-delete',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete'
        ];


        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
