<?php

namespace App\Http\Controllers;

use App\Company;
use App\Unity;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class ParticipantController extends Controller
{
    function __construct(){
        $this->middleware('permission:user-list');
        $this->middleware('permission:user-create',['only'=>['create','store']]);
        $this->middleware('permission:user-edit',['only'=>['edit','update']]);
        $this->middleware('permission:user-delete',['only'=>['destroy']]);
    }

    public function index(Request $request)
    {
        $data = User::select('users.id', 'users.document', 'users.name', 'users.last_name', 'users.position', 'users.area',
            'users.state',
            'companies.name as company', 'unities.name as unity',  'users.email')
            ->join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->join('unities', 'unities.id', '=', 'users.unity_id')
            ->where('model_has_roles.role_id', 2)
            ->orderBy('id','DESC')->paginate(20);

        return view('participants.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $company =Company::pluck('name','id');
        $unity = Unity::pluck('name','id');
        $roles = Role::where('id','=',4)
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
        $roles = Role::where('id','=',4) ->pluck('name','id');
        $userRole = $user->roles->pluck('name','name')->all();

        return view('participants.edit',compact('user','roles','userRole','company','unity'));
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
