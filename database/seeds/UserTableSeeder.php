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

    }
}
