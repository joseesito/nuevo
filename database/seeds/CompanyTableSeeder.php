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
        \App\Company::create([
            'ruc'=>'20100147514',
            'name' =>'SOUTHERN PERU COPPER CORPORATION SUCURSAL DEL PERU',
            'address' =>'Av. Caminos del Inca Nro. 171 Chacarilla del Estanque Santiago de Surco Lima, Perú',
            'phone' =>'922570393'
        ]);

    }
}
