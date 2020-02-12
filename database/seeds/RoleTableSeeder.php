<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name'=>'root'
        ]);
        DB::table('roles')->insert([
            'name'=>'participante' 
        ]);
        DB::table('roles')->insert([
            'name'=>'Coordinador' 
        ]);
        DB::table('roles')->insert([
            'name'=>'Facilitador' 
        ]);
        DB::table('roles')->insert([
            'name'=>'Contratista' 
        ]);
            
    }
}
