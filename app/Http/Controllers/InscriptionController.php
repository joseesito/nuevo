<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Inscription;

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
        ->select('in.id','u.name as name','uni.name','in.address','in.time','in.name as name','in.hours',
        'in.grade_min','in.price','in.free','in.validity','in.type_validity','in.certificate','lo.name as namelocation','in.start_date',
        'in.end_date','in.slot',
        DB::raw('COUNT(UI.id) as alumnos_matriculados'))
        ->leftjoin('inscription_user as UI',function($join){
            $join->on('UI.id_inscriptions','=','in.id')
            ->where('UI.state','<>',0);
        })
        ->join('users as u','u.id','=','in.user_id')
        ->join('unities as uni','uni.id','=','in.unity_id')
        
        ->join('locations as lo','lo.id','=','in.location_id')
        ->where('start_date','>',date('2020-01-01'))
        
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
        $user = Auth::user();
        $locations = Location::pluck('name','id');
        $users = DB::table('users')
            ->select(
                DB::raw('CONCAT(name, " ", firstlastname) AS full_name, users.id as id')
            )
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            
            ->whereNotIn('users.id', [12753, 2683, 4141, 14078, 1097, 14179, 14180, 7053]) // administrativo
     
            ->where('users.state','=',1);
        return view('inscription.create',compact('locations','courses','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request ,[
            'startdate'=> 'required',
            'address' => 'required',
            'slots'=> 'required'

        ],
        
        [
            'startdate.required' =>'el campo es obligatorio',
            'address.required' => 'El campo es obligatorio',
            'slot.required' => 'El campo vacantes es obligatorio',

        ]);

        $course = DB::table('courses')
        ->where('id',$request->id_course)
        ->get();

        $inscription = new Inscription;
        $inscription->location_id = $request->location_id;
        $inscription->unity_id = $request->unity_id;
        $inscription->user_id =$request->id;
        $inscription->address =$request->address;
        $inscription->start_date =$request->start_date;
        $inscription->end_date =$request->end_date;
        $inscription->time =$request->time;
        $inscription->slot=$request->slot;
        $inscription->name=$request->name;
        $inscription->hours=$request->hours;
        $inscription->validity=$request->validity;
        $inscription->type_validity=$request->type_validity;
        $inscription->save();

            




        return redirect()
            ->route('inscription.index')
            ->with('success','El curso: '. $inscription->name.
            ' en la fecha: '.$fecha.' fue guardado.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
