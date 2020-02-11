<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unities')->insert([
            'name'=>'Minsur',
            'address' =>'empresa@ighgroup.com',
            
        ]);
        DB::table('unities')->insert([
             'name' =>'Southern',
             'address' =>'empresa@ighgroup.com',
        ]);  
        DB::table('unities')->insert([
            'name' =>'UnidadMinera',
            'address' =>'empresa@ighgroup.com'
       ]);    
             
            
          
        
    }
}
