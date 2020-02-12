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
        DB::table('users')->insert([
            'company_id'=>'1',
            'type_document' =>'DNI',
            'unity_id'=>'1',
            'document'=>'12345678',
            'last_name'=> 'root',
            'name'=>'root',
            'email'=>'root@hotmail.com',
            'password'=>bcrypt('root')
            
        ]);
        DB::table('users')->insert([
            'company_id'=>'1',
            'type_document' =>'DNI',
            'unity_id'=>'1',
            'document'=>'23568978',
            'last_name'=> 'visitante',
            'name'=>'visitante',
            'email'=>'visitante@hotmail.com',
            'password'=>bcrypt('visitante')
            
        ]);
        
    }
}
