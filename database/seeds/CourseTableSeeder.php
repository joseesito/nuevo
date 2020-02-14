<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'type_course_id'=> 1,
            'name'=> 'IPERC',
            'hours'=> '4',
            'grade_min'=> '14',
            'validity' => '1',
            'type_validity'=> '3',
        ]);

        Course::create([
            'type_course_id'=> 1,
            'name'=> 'LIDERAZGO Y MOTIVACIÓN. SEGURIDAD BASADA EN EL COMPORTAMIENTO',
            'hours'=> '4',
            'grade_min'=> '14',
            'validity' => '1',
            'type_validity'=> '3',
        ]);

    }
}
