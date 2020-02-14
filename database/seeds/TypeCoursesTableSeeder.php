<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\TypeCourse;

class TypeCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCourse::insert([
            'name'=>'ANEXO 6'
        ]);
    }
}
