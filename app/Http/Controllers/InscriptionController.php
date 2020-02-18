<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Inscription;
use App\Location;
use App\Course;
use App\Unity;
use App\User;

class InscriptionController extends Controller
{
    function __construct(){
        $this->middleware('permission:inscription-list');
        $this->middleware('permission:inscription-create',['only'=>['create','store']]);
        $this->middleware('permission:inscription-edit',['only'=>['edit','create']]);
        $this->middleware('permission:inscription-delete',['only'=>['delete']]);
    }
    public function index()
    {
        $inscription =DB::table('inscriptions as in')
        ->select('in.id','u.name as name','in.name as namecurso','lo.name as nameLocation','uni.name','in.address','in.time','in.hours',
        'in.grade_min','in.price','in.free','in.validity','in.type_validity','in.certificate','lo.name as namelocation','in.start_date',
        'in.end_date','in.slot',
        DB::raw('COUNT(UI.id) as alumnos_matriculados'))
        ->leftjoin('inscription_user as UI',function($join){
            $join->on('UI.inscription_id','=','in.id')
            ->where('in.state','<>',0);
        })
        ->join('courses as cur','cur.id','in.course_id')
        ->join('users as u','u.id','=','in.user_id')
        ->join('unities as uni','uni.id','=','in.unity_id')
        
        ->join('locations as lo','lo.id','=','in.location_id')
        ->where('start_date','>',date('2005-00-00'))
        
        ->where('in.state','=',1)
        ->groupBy('in.id')
        ->orderBy('in.start_Date','asc')
        ->get();

        return view('inscription.index',compact('inscription'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unity = Unity::pluck('name','id');
       
        $locations = Location::pluck('name','id');
        $courses = Course::pluck('name','id');
        $users = User::pluck('name','id');
        return view('inscription.create',compact('locations','courses','users','unity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $user = Auth::user();
        
        $this->validate($request ,[
            'start_date' => 'required',
            'address' => 'required',
            'slot' => 'required|min:1',

        ],
            [
                'start_date.required' => 'El campo fecha es requerido',
                'address.required' => 'Dirección es requerida',
                'slot.required' => 'Vacante requerida',
                'slot.min' => 'la vacante debe de ser mayor a 1'
            ]);
        $course = DB::table('courses')
        ->where('id',$request->course_id)
        ->first();
        //dd('jgbjjh'); 

        $inscription = new Inscription;
        $inscription->course_id = $request->course_id;
        $inscription->location_id = $request->location_id;
        
        $inscription->unity_id = $user->unity_id;
        $inscription->slot=$request->slot;
        $inscription->user_id =$request->user_id;
        $inscription->address =$request->address;
        $inscription->time =$request->time;
        $inscription->start_date = $request->start_date;
        $inscription->end_date = $request->start_date;

        
        $inscription->hours=$course->hours;
        $inscription->name=$course->name;
        $inscription->grade_min=$course->grade_min;
        $inscription->price=$course->price;
        $inscription->free=$course->free;
        $inscription->certificate=$course->certificate;
        $inscription->validity=$course->validity;

        $inscription->save();

        return redirect()
            ->route('inscriptions.index')
            ->with('Mensaje','El curso: '. $inscription->name.
            ' en la hora: '.$inscription->time.' fue guardado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Inscription $inscription)

    {
        
        $users = Auth::user();
        $locations = Location::pluck('name','id');
        $courses = Course::pluck('name','id');
        $users = DB::table('users')
            ->select(
                DB::raw('CONCAT(name, " ",last_name) AS nombre_completo, users.id AS id')
            )
            ->where('users.state', 1)
            ->pluck('nombre_completo', 'id');
       
        return view('inscription.edit',compact('inscription','locations','courses','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
        $this->validate($request ,[
            'start_date' => 'required',
            'address' => 'required',
            'slot' => 'required|min:1',

        ],
            [
                'start_date.required' => 'El campo fecha es requerido',
                'address.required' => 'Dirección es requerida',
                'slot.required' => 'Vacante requerida',
                'slot.min' => 'la vacante debe de ser mayor a 1'
            ]);
        $users = Auth::user();
        $course =DB::table('courses')
            ->where('id',$request->course_id)
            ->first();
            
            $inscription = Inscription::find($id);
            $inscription->course_id = $request->course_id;
            $inscription->location_id = $request->location_id;
            $inscription->slot=$request->slot;
            $inscription->user_id =$request->user_id;
            $inscription->address =$request->address;
            $inscription->time =$request->time;
            $inscription->start_date = $request->start_date;
            $inscription->end_date = $request->start_date;
            $inscription->unity_id = $user->unity_id;
    
          
            $inscription->hours=$course->hours;
            $inscription->name=$course->name;
            $inscription->grade_min=$course->grade_min;
            $inscription->price=$course->price;
            $inscription->free=$course->free;
            $inscription->certificate=$course->certificate;
            $inscription->validity=$course->validity;
            
            $inscription->type_validity=$course->type_validity;
            
            $inscription->save();
    
            return redirect()
                ->route('inscriptions.index')
                ->with('Mensaje','El curso: '. $inscription->name.
                ' en la hora: '.$inscription->time.' fue guardado.');
        
    }       
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inscription =Inscription::find($id);
        $inscripti = DB::table('inscriptions')
        ->where('id','=',$id)
        ->where('state','=','1')
        ->count();

        if($inscripti==1){
            Inscription:: where('id','=',$id)->update(['state'=> '0']);
            
            return redirect()->back()->with('Mensaje', 'la eliminacion del Curso :    '.''. $inscription->name .''.''. '  en la hora Programada: '.''. $inscription->hours.''. ' fue Realizada.');
           
        }else{
           
            return redirect()->back()->with('Mensaje2','Curso inexistente!'); 
        }
    }
}
