<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        $course=DB::table('courses as cu')
        ->select('cu.id','cu.name','cu.hours','type_courses.name as nametype_course','cu.validity','cu.grade_min','cu.type_validity')
        ->join('type_courses','type_courses.id','=','cu.type_course_id')
        ->where('cu.state','=',0)
        
        ->get();
        return view('courses.index',compact('course'));

    }

    public function create()
    {
        return view('courses.create');
    }
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'name' => 'required',
        ]);
        $course = new Course;
        $course->type_course_id = $request->type_course_id;
        $course->name = $request->name;
        $course->hours = $request->hours;
        $course->grade_min = $request->grade_min;
        $course->validity = $request->validity;   
        $course->type_validity = $request->type_validity;
        $course->price = null;
        $course->state = 0;    
        $course->save();
        return redirect()->route('courses.index')->with('success','El curso fue registrado');

    }

    public function show(Course $course)
    {
        return view('courses.show',compact('course'));
    }

    
    public function edit(Course $course)
    {        
         return view('courses.edit',compact('course'));
    }

    
    public function update(Request $request, $id)
    {
        
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
