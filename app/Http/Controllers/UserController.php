<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Company;
use App\Unity;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class UserController extends Controller
{
    function __construct(){
        $this->middleware('permission:course-list');
        $this->middleware('permission:course-create',['only'=>['create','store']]);
        $this->middleware('permission:course-edit',['only'=>['edit','update']]);
        $this->middleware('permission:course-delete',['only'=>['destroy']]);
    }
    //listarrr
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    
    public function create()
    {
        $company =Company::pluck('name','id');
        $unity = Unity::pluck('name','id');
        $roles = Role::where('id','=',4)
        ->pluck('name','id');
       

       
        
        return view('users.create',compact('roles','company','unity'));
    }


    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);


        $user = User::create($input);
        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')
                        ->with('Mensaje','User created successfully');
    }


    
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }


    
    public function edit($id)
    {
        $company =Company::pluck('name','id');
        $unity = Unity::pluck('name','id');
        $user = User::find($id);
        $roles = Role::where('id','=',4) ->pluck('name','id');
        $userRole = $user->roles->pluck('name','name')->all();
        
        return view('users.edit',compact('user','roles','userRole','company','unity'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
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


        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
                        ->with('Mensaje','User updated successfully');
    }


    
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('Mensaje','User deleted successfully');
    }
}