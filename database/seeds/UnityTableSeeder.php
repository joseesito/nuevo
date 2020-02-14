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
        Unity::create([
            'name'=>'TOQUEPALA',
            'address' =>'Unidad minera',
        ]);
        Unity::create([
             'name' =>'CUAJONE',
             'address' =>'Unidad minera',
        ]);
        Unity::create([
            'name' =>'ILO',
            'address' =>'Unidad minera'
       ]);

        Unity::create([
            'name' =>'All',
            'address' =>'Av la aencalada'
        ]);
    }
}
