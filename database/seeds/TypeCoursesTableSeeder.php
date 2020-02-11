<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_courses')->insert([
            'name'=>'Prevencion de riesgos'
        ]);
      
    }
}
