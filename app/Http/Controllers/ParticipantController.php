<?php

namespace App\Http\Controllers;
use DB;
use Hash;
use App\Company;
use App\Unity;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InscriptionExport;
use App\Imports\InscriptionImport;


class ParticipantController extends Controller
{
    use AuthorizesRequests,DispatchesJobs,ValidatesRequests;

    function __construct(){
        $this->middleware('permission:participant-list');
        $this->middleware('permission:participant-create',['only'=>['create','store']]);
        $this->middleware('permission:participant-edit',['only'=>['edit','update']]);
        $this->middleware('permission:participant-delete',['only'=>['destroy']]);
    }

    public function index(Request $request)
    {

        $data = User::select('users.id', 'users.type_document', 'users.document', 'users.name', 'users.last_name', 'users.position', 'users.area',
            'users.state', 'users.management',
            'companies.name as company', 'unities.name as unity',  'users.email')
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('unities', 'unities.id', '=', 'users.unity_id')
            ->where('model_has_roles.role_id', 2)
            ->orderBy('id','DESC')->get();

        return view('participants.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function export()
    {
        return Excel::download(new InscriptionExport,'inscription.xlsx');
    }

    public function import(Request $request)
    {
        $file = $request->file('file_up');
        Excel::import(new InscriptionImport, $file);
        return back()->with('success', 'Se actualizaron las datos del participante');
    }

    public function create()
    {
        $company =Company::pluck('name','id');
        $unity = Unity::pluck('name','id');
        $roles = Role::where('id','=',2)
            ->pluck('name','id');

        return view('participants.create',compact('roles','company','unity'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'document' => 'required|min:8|alpha_num',
            'name' => 'required',
            'last_name' => 'required',
        ]);

        $input = $request->all();
        $input['email'] = $request->document.'p@mail.com';
        // $input['password'] = Hash::make($input['password']);
        $input['password'] = Hash::make($input['document']);

        $user = User::create($input);

        $user->assignRole('participante');

        return redirect()->route('participants.index')
            ->with('Mensaje','El participante '. $request->name .' ' .$request->last_name. ' fue registrado correctamente.');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('participants.show',compact('user'));
    }

    public function edit($id)
    {
        $company =Company::pluck('name','id');
        $unity = Unity::pluck('name','id');
        $user = User::find($id);
        $roles = Role::where('id','=',2) ->pluck('name','id');
        $userRole = $user->roles->pluck('name','name')->all();

        return view('participants.edit',compact('user','roles','company','unity'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'document' => 'required|min:8|alpha_num',
            'name' => 'required',
            'last_name' => 'required',
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }


        $user = User::find($id);

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();


        $user->assignRole('participante');

        $user->assignRole('participante');


        return redirect()->route('participants.index')
            ->with('Mensaje','El participante '. $request->name .' ' .$request->last_name. ' fue actualizado correctamente.');
    }



    public function destroy($id)
    {
        /*User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('Mensaje','User deleted successfully');*/
    }
}
