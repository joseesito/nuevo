<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'company_id'=>'1',
            'type_document' =>'1',
            'unity_id'=>'1',
            'document'=>'12345678',
            'last_name'=> 'root',
            'name'=>'root',
            'email'=>'root@hotmail.com',
            'password'=>bcrypt('root')

        ]);

        \App\User::create([
            'company_id'=>'1',
            'type_document' =>'1',
            'unity_id'=>'1',
            'document'=>'46185127',
            'name'=>'HENRRY JOEL',
            'last_name'=> 'SAIRITUPAC ARONES',
            'position'=> 'ANALISTA PROGRADOR',
            'area'=> 'TECNOLOGIA DE LA INFORMACION',
            'management'=> 'TI',
            'email'=>'henrry.saa@gmail.com',
            'password'=>bcrypt('123456')
        ]);

        \App\User::create([
            'company_id'=>'1',
            'type_document' =>'1',
            'unity_id'=>'1',
            'document'=>'73999783',
            'name'=>'NEIRA OLIGUERIA',
            'last_name'=> 'MALPARTIDA MAIZ',
            'email'=>'neira.malpartida@ighgroup.com',
            'password'=>bcrypt('123456')
        ]);
        \App\User::create([
            'company_id'=>'1',
            'type_document' =>'1',
            'unity_id'=>'2',
            'document'=>'46869815',
            'name'=>'JENY',
            'last_name'=> 'CHOCCA INGA',
            'email'=>'jenny.chocca@ighgroup.com',
            'password'=>bcrypt('123456')
        ]);
        \App\User::create([
            'company_id'=>'1',
            'type_document' =>'1',
            'unity_id'=>'3',
            'document'=>'46185127',
            'name'=>'ALEXIS JOSE',
            'last_name'=> 'LOPEZ DELGADO',
            'email'=>'alexis.lopez@ighgroup.com',
            'password'=>bcrypt('123456')
        ]);
    }
}
