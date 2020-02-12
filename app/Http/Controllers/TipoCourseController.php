<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\TypeCourse;
use DB;


class TipoCourseController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:type_course-list');
        $this->middleware('permission:type_course-create',['only' => ['create','store']]);
        $this->middleware('permission:type_course-edit',['only' =>['edit','update']]);
        $this->middleware('permission:type_course-delete',['only' =>['destroy']]);

    }
    public function index(Request $request)
    {
        $type_course = DB::table('type_courses')
        ->where('state','=',0)
        ->get();

        return view('type_courses.index',compact('type_course'));
    }

    public function create()
    {

         return view('type_courses.create');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);

        TypeCourse::create($request->all());

        return redirect()->route('type_courses.index')
                        ->with('success','Curso creado successfully');
    }

    public function show(TypeCourse $type_course){
        return view('type_courses.show',compact('type_course'));
    }

    public function edit(TypeCourse $type_course)
    {
        return view('type_courses.edit',compact('type_course'));
    }


    public function update(Request $request, $id)
    {


        request()->validate([
            'name' => 'required',

        ]);
        $type_course = TypeCourse::find($id);
        $type_course->name= $request->name;
        $type_course->save();

        return redirect()->route('type_courses.index')->with('success','El tipo de curso fue actualizado');
    }


    public function destroy(Request $request, $id)
    {

        $course = TypeCourse::find($id);
        $cours = DB::table('type_courses')
        ->where('id','=',$id)
        ->where('state','=','0')
        ->count();

        if($cours==1){
            TypeCourse:: where('id','=',$id)->update(['state'=> '1']);
            return redirect()->route('type_courses.index')
                        ->with('success','Product deleted successfully');

        }else{
            return redirect()->back()->with('Mensaje2','Tipo Curso inexistente!');
        }

    }
}
