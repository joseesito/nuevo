<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Unity;

class UnityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unity::insert([
            'name'=>'Toquepala',
            'address' =>'empresa@ighgroup.com',
        ]);
        Unity::insert([
             'name' =>'Quajome',
             'address' =>'empresa@ighgroup.com',
        ]);
        Unity::insert([
            'name' =>'Ilo',
            'address' =>'empresa@ighgroup.com'
       ]);

        Unity::insert([
            'name' =>'All',
            'address' =>'Av la aencalada'
        ]);
    }
}
