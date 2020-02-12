<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'name'=>'Lima',
           
        ]);
        DB::table('locations')->insert([
            'name'=>'Junin',
           
        ]);
    }
}
