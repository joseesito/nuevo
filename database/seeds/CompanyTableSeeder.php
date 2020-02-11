<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompanyTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'ruc'=>'78945612345',
            'name' =>'Company',
            'address' =>'Company@ighgroup.com',
            'phone' =>'922570393'
        ]);


    }
}
