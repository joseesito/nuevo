<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TypeCourse;
use App\Course;
use DB;

class CourseController extends Controller
{
    function __construct(){
        $this->middleware('permission:course-list');
        $this->middleware('permission:course-create',['only'=>['create','store']]);
        $this->middleware('permission:course-edit',['only'=>['edit','update']]);
        $this->middleware('permission:course-delete',['only'=>['destroy']]);
    }
    public function index(Request $request)
    {
        $courses = DB::table('courses')
            ->select('courses.id','courses.name','courses.hours', 'courses.type_course_id',
                'type_courses.name as name_type_course','courses.validity',
                'courses.type_validity','courses.grade_min')
            ->join('type_courses','type_courses.id','=','courses.type_course_id')
            ->get();
        return view('courses.index',compact('courses'));
    }

    public function create()
    {
        $course = new Course;
        $type_courses = TypeCourse::orderBy('name')->get();
        // $type = TypeCourse::pluck('name','id');

        return view('courses.create', compact('type_courses', 'course'));
    }

    public function store(Request $request)
    {

        $fields = request()->validate([
            'name' => 'required',
            'hours' => 'required|digits_between:1,3',
            'grade_min' => 'required|numeric|digits_between:1,2|min:14|max:20',
        ]);

        $fields['type_course_id'] = $request->type_course_id;
        $fields['validity'] = 1;
        $fields['type_validity'] = 3;

        $course = Course::create($fields);

        return redirect()->route('courses.index')
            ->with('success', 'El curso "'. $course->name .'" de '. $course->hours.' fue registrado correctamente');

    }

    public function show(Course $course)
    {
        return view('courses.show',compact('course'));
    }


    public function edit(Course $course)
    {
        $type=TypeCourse::pluck('name','id');
        return view('courses.edit', compact('course','type'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'hours' => 'required',
            'validity' => 'required',
            'type_validity' =>'required|min:1',

        ],
            [
                'name.required' => 'El campo name es requerido',
                'hours.required' => 'El campo horas es requerido',
                'validity.required' => 'El campo vigencia es requerido',
                'validity.min' => 'El campo vigencia debe ser mayor a 1'
            ]);

        $course = Course::find($id);
        $course->type_course_id = $request->type_course_id;
        $course->name = $request->name;
        $course->hours = $request->hours;
        $course->validity = $request->validity;
        $course->grade_min = $request->grade_min;
        $course->price = null;
        $course->type_validity = $request->type_validity;

        $course->save();

        return redirect()->route('courses.index')->with('success','Curso Actualizado!');
    }


    public function destroy(Request $request, $id)
    {

        $course = Course::find($id);
        $cours = DB::table('courses')
        ->where('id','=',$id)
        ->where('state','=','0')
        ->count();

        if($cours==1){
            Course:: where('id','=',$id)->update(['state'=> '1']);
            return redirect()->back()->with('Mensaje', 'la eliminacion del Curso :    '.''. $course->nameC .''.''. '  en la hora Programada: '.''. $course->hours.''. ' fue Realizada.');

        }else{

            return redirect()->back()->with('Mensaje2','Curso inexistente!');
        }
    }
}
