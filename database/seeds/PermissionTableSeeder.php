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

        DB::table('permissions')->insert([
            'name'=>'user_inscription-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'user_inscription-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'user_inscription-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'user_inscription-delete',
        ]);
        DB::table('permissions')->insert([
            'name'=>'location-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'location-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'location-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'location-delete',
        ]);

         /* permisos typo facilitador */
         DB::table('permissions')->insert([
            'name'=>'facilitador-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'facilitador-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'facilitador-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'facilitador-delete'
        ]);
        
         /* permisos typo participante */
         DB::table('permissions')->insert([
            'name'=>'participant-list',
        ]);
        DB::table('permissions')->insert([
            'name'=>'participant-create',
        ]);
        DB::table('permissions')->insert([
            'name'=>'participant-edit',
        ]);
        DB::table('permissions')->insert([
            'name'=>'participant-delete'
        ]);

//---
         DB::table('model_has_roles')->insert([

            'model_type'=>'App\User',
            'role_id'=>'1',
            'model_id'=>'1',
            //root
        ]);

        DB::table('model_has_roles')->insert([
            
            'model_type'=>'App\User',
            'role_id'=>'2',
            'model_id'=>'2',
            //participante
        ]);

        DB::table('model_has_roles')->insert([
            
            'model_type'=>'App\User',
            'role_id'=>'3',
            'model_id'=>'3',
            //coordinador
        ]);
        DB::table('model_has_roles')->insert([
            
            'model_type'=>'App\User',
            'role_id'=>'4',
            'model_id'=>'4',
            //facilitador
        ]);
        DB::table('model_has_roles')->insert([
            
            'model_type'=>'App\User',
            'role_id'=>'5',
            'model_id'=>'5',
            //contratista
        ]);

//--
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
        
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'25',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'26',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'27',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'28',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'29',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'30',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'31',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'32',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'33',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'34',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'35',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'36',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'37',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'38',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'39',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'40',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'41',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'42',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'43',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'44',
            'role_id'=>'1'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'17',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'18',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'19',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'20',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'21',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'22',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'23',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'24',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'5',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'6',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'7',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'8',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'13',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'14',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'15',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'16',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'33',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'34',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'35',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'36',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'9',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'10',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'11',
            'role_id'=>'3'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'12',
            'role_id'=>'3'
        ]);
        //--
       
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'41',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'42',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'43',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'44',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'25',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'26',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'27',
            'role_id'=>'4'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'28',
            'role_id'=>'4'
        ]);
        
        
        //
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'41',
            'role_id'=>'2'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'42',
            'role_id'=>'2'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'43',
            'role_id'=>'2'
        ]);
        DB::table('role_has_permissions')->insert([
            'permission_id'=>'44',
            'role_id'=>'2'
        ]);
        
            
        }
}
