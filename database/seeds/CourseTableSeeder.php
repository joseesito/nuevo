<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            'type_course_id'=>1,
            'name'=>'Escala laravel',
            'hours'=>'4',
            'grade_min'=>'12',
            'validity' =>'1',
            'type_validity'=>'3',
            'state'=>'0'
        ]);
        
    }
}
