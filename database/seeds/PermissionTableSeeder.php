<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=PermissionTableSeeder

     * @return void
     */
    public function run()
    {
        /* permisos para roles */
        DB::table('permissions')->insert([
            'name'=>'role-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'role-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'role-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'role-delete',
        ]);

        /*permisos de cursos*/

        DB::table('permissions')->insert([
            'name'=>'course-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'course-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'course-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'course-delete',
        ]);

        /* permisos usuarios */
        DB::table('permissions')->insert([
            'name'=>'user-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'user-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'user-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'user-delete',
        ]);

        /* permisos company */
        DB::table('permissions')->insert([
            'name'=>'company-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'company-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'company-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'company-delete',
        ]);

        /* permisos unity */
        DB::table('permissions')->insert([
            'name'=>'unity-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'unity-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'unity-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'unity-delete',
        ]);

        /* permisos typo course */
        DB::table('permissions')->insert([
            'name'=>'type_course-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'type_course-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'type_course-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'type_course-delete'
        ]);

        /* permisos para inscribir */

        DB::table('permissions')->insert([
            'name'=>'inscription-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'inscription-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'inscription-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'inscription-delete',
        ]);

         DB::table('model_has_roles')->insert([

            'model_type'=>'App\User',
            'role_id'=>'1',
            'model_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'1',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'2',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'3',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'4',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'5',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'6',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'7',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'8',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'9',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'10',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'11',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'12',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'13',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'14',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'15',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'16',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'17',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'18',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'19',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'20',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'21',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'22',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'23',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'24',
            'role_id'=>'1'
        ]);

        }
}
