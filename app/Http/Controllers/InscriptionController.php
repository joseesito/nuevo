<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\InscriptionUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Inscription;
use App\Location;
use App\Course;
use App\Unity;
use App\User;
use Excel;
use App\Imports\InscriptionUsersImport;
use App\Exports\InscriptionUsersExport;

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
        // recuperamos el usuario facilitador
        $user = Auth::user();
        // recuperamos toda las programaciones de la "unidad minera" que pertenece el usuario facilitador
        $inscriptions = Inscription::
        select(
            'inscriptions.id','inscriptions.name',
            'L.name as location','U.name as unity',
            'inscriptions.address',
            'inscriptions.time','inscriptions.hours',
            'inscriptions.start_date')
        ->join('unities as U','U.id','=','inscriptions.unity_id')
        ->join('locations as L','L.id','=','inscriptions.location_id')
        ->where('inscriptions.state','=',1)
        ->where('inscriptions.unity_id','=', $user->unity_id)
        ->orderBy('inscriptions.start_Date','asc')
        ->get();

        return view('inscription.index',compact('inscriptions'));
    }

    /**
     * Mostrar el formulario para la creacio nde .
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unity = Unity::pluck('name','id');

        $locations = Location::pluck('name','id');
        $courses = Course::pluck('name','id');
        $users = User::select(
            'users.id',
            DB::raw('CONCAT(users.name, " ",users.last_name) AS full_name'))
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->where('users.state', 1)
            ->where('model_has_roles.role_id', 4)
            ->pluck('full_name', 'id');
        return view('inscription.create',compact('locations','courses','users','unity'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $fields = $this->validate($request ,[
            'start_date' => 'required|date_format:d/m/Y',
            'address' => 'required',
            'slot' => 'required|min:0',
        ],
        [
            'start_date.required' => 'El campo fecha es requerido',
            'address.required' => 'Dirección es requerida',
            'slot.required' => 'Vacante requerida',
            'slot.min' => 'la vacante debe de ser mayor a 1'
        ]);

        $start_date = $request->start_date;
        $start_date = Carbon::createFromFormat('d/m/Y', $start_date);
        $fields['start_date'] = $start_date;

        $course = DB::table('courses')
        ->where('id',$request->course_id)
        ->first();

        $inscription = new Inscription;
        $inscription->course_id = $request->course_id;
        $inscription->location_id = $request->location_id;

        $inscription->unity_id = $user->unity_id;
        $inscription->slot=$request->slot;
        $inscription->user_id =$request->user_id;
        $inscription->address =$request->address;
        $inscription->time =$request->time;
        $inscription->start_date = $fields['start_date'];
        $inscription->end_date = $fields['start_date'];

        $inscription->hours=$course->hours;
        $inscription->name=$course->name;
        $inscription->grade_min=$course->grade_min;
        $inscription->price=$course->price;
        $inscription->free=$course->free;
        $inscription->module=$course->module;
        $inscription->certificate=$course->certificate;
        $inscription->validity=$course->validity;

        $inscription->save();

        return redirect()
            ->route('inscriptions.index')
            ->with('Mensaje','El curso: '. $inscription->name. ' en la hora: ' .$inscription->time. ' ' .$inscription->time.' fue registrado correctamente.');
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
        $users = User::select(
            'users.id',
            DB::raw('CONCAT(users.name, " ",users.last_name) AS full_name'))
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->where('users.state', 1)
            ->where('model_has_roles.role_id', 4)
            ->pluck('full_name', 'id');

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
        $fields = $this->validate($request ,[
            'start_date' => 'required|date_format:d/m/Y',
            'address' => 'required',
            'slot' => 'required|min:0',
        ],
        [
            'start_date.required' => 'El campo fecha es requerido',
            'address.required' => 'Dirección es requerida',
            'slot.required' => 'Vacante requerida',
            'slot.min' => 'la vacante debe de ser mayor a 1'
        ]);
        $start_date = $request->start_date;
        $start_date = Carbon::createFromFormat('d/m/Y', $start_date);
        $fields['start_date'] = $start_date;

        $user = Auth::user();
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
        $inscription->start_date = $fields['start_date'];
        $inscription->end_date = $fields['start_date'];
        $inscription->unity_id = $user->unity_id;

        $inscription->hours=$course->hours;
        $inscription->name=$course->name;
        $inscription->grade_min=$course->grade_min;
        $inscription->price=$course->price;
        $inscription->free=$course->free;
        $inscription->module=$course->module;
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

            return redirect()->back()->with('Mensaje', 'la eliminación del Curso :    '.''. $inscription->name .''.''. '  en la hora Programada: '.''. $inscription->hours.''. ' fue Realizada.');

        }else{

            return redirect()->back()->with('Mensaje2','Curso inexistente!');
        }
    }


    public function register(Inscription $inscription) {
        $user = Auth::user();

        // recuperamos la relacion de particpantes incritos en la programacion
        $Incription_users_id = DB::table('inscription_user')
            ->where('inscription_id', '=', $inscription->id)
            ->pluck('user_id')->toArray();

        $participants = User::select(
            'users.id',
            DB::raw('CONCAT(users.document," | ",users.name, " ",users.last_name," | ", companies.name, " | ", unities.name) AS full_name'))
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('unities', 'unities.id', '=', 'users.unity_id')
            ->where('users.state', 1)
            ->where('users.unity_id',$user->unity_id)
            ->whereNotIn('users.id', $Incription_users_id)
            ->where('model_has_roles.role_id', 2)
            ->get();

        return view('inscription.register',compact('inscription', 'participants'));
    }


    public function register_save(Request $request, Inscription $inscription)
    {
        $user = Auth::user();
        // Validamos de que seleccione por lo menos un participante
        $fields = request()->validate([
            'participants' => 'required',
        ]);

        // recuperamoos a los participantes
        $participants = User::whereIn('id',$request->participants);

        // Guardamos la relacion de participantes
        foreach ($participants->get() as $participant) {
            $iu = InscriptionUser::create([
                'inscription_id' => $inscription->id,
                'user_id' => $participant->id,
                'company_id' => $participant->company_id,
                'unity_id' => $participant->unity_id,
                'user_created' => $user->id,
            ]);
        }

        // Disminuimos el numero de vacantes
        $inscription->decrement('slot',$participants->count());

        return redirect()->route('inscriptions.grade', compact('inscription'))
            ->with('success', 'Se registrarón'. $participants->count(). ' participante(s');
    }

    public function grade(Inscription $inscription) {

        // Recuperamos el usuario logueado
        $user = Auth::user();

        // relacion de participantes inscritos en un determinada "$inscription"
        $participants = DB::table('inscription_user')
            ->select('inscription_user.*',
                'users.document',
                DB::raw('CONCAT(users.last_name, " ", users.name) as full_name'),
                'companies.name as company', 'unities.name as unity')
            ->join('users', 'users.id', '=', 'inscription_user.user_id')
            ->join('companies', 'companies.id', '=', 'inscription_user.company_id')
            ->join('unities', 'unities.id', '=', 'users.unity_id')
            ->where('inscription_user.inscription_id', $inscription->id)
            ->whereIn('inscription_user.state', [1,2])
        ->get();

        return view('inscription.grade',compact('inscription', 'participants'));
    }

    public function exportExcel(Inscription $inscription) {

        // nombre del archivo a descargar
        $file = $inscription->id.' '.$inscription->name.'.xlsx';
        return Excel::download(new InscriptionUsersExport($inscription->id), $file);
    }

    public function importExcel(Request $request, Inscription $inscription) {

        $file = $request->file('file_up');
        Excel::import(new InscriptionUsersImport($inscription->id), $file);
        return back()->with('success', 'Se actualizron las notas');
    }
}
