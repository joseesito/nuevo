<?php
namespace App\Http\Controllers;
use App\Company;
use App\Unity;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;


class FacilitadorController extends Controller
{
    function __construct(){
            $this->middleware('permission:facilitador-list');
            $this->middleware('permission:facilitador-create',['only'=>['create','store']]);
            $this->middleware('permission:facilitador-edit',['only'=>['edit','update']]);
            $this->middleware('permission:facilitador-delete',['only'=>['destroy']]);
        }
    
        public function index(Request $request)
        {
            $data = User::join('model_has_roles','users.id','=','model_has_roles.model_id')
                ->where('model_has_roles.role_id', 4)
                ->orderBy('id','DESC')->paginate(5);
    
            return view('facilitadors.index',compact('data'))
                ->with('i', ($request->input('page', 1) - 1) * 5);
        }
    
        public function create()
        {
            $company =Company::pluck('name','id');
            $unity = Unity::pluck('name','id');
            $roles = Role::where('id','=',4)
                ->pluck('name','id');
    
            return view('facilitadors.create',compact('roles','company','unity'));
        }
    
    
        public function store(Request $request)
        {
            
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                //'roles' => 'required'
            ]);
    
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
    
            $user = User::create($input);
                
            $user->assignRole('Facilitador');
    
            return redirect()->route('facilitadors.index')
                ->with('Mensaje','El participante fue creado correctamente');
        }
    
        public function show($id)
        {
            $user =DB::table('users as us')
                ->select('us.id as id','us.name as nameuser','us.last_name as lastname','us.email as email',
                'us.document as document','us.state','compa.name as companyname','uni.name as unityname')
                ->join('companies as compa','compa.id','us.company_id')
                ->join('unities as uni','uni.id','us.unity_id')
                ->where('us.id','=',$id)
                ->get()->first();
            return view('facilitadors.show',compact('user'));
        }
    
        public function edit($id)
        {
            
            $company =Company::pluck('name','id');
            $unity = Unity::pluck('name','id');
            $user = User::find($id);
            $roles = Role::where('name','=','Facilitador')
            ->pluck('name','id');
            
            return view('facilitadors.edit',compact('user','roles','company','unity'));
        }
    
        public function update(Request $request, $id)
        {
            
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'same:confirm-password',
                
            ]);
    
            $input = $request->all();
            if(!empty($input['password'])){
                $input['password'] = Hash::make($input['password']);
            }else{
                $input = array_except($input,array('password'));
            }
    
            $user = User::find($id);
            
            $user->update($input);
            //DB::table('model_has_roles')->where('model_id',$id)->delete();

            $user->assignRole('Facilitador');
            //$user->removeRole('participante');
    
            return redirect()->route('facilitadors.index')
                ->with('Mensaje','Facilitador updated successfully');
        }
    
    
    
        public function destroy($id)
        {
            $user =User::find($id);
            $use = DB::table('users')
            ->where('id','=',$id)
            ->where('state','=','1')
            ->count();

        if($use==1){
            User:: where('id','=',$id)->update(['state'=> '0']);
            
            return redirect()->back()->with('Mensaje', 'la eliminacion del Facilitador :    '.''. $user->name .''.''. '  con el documento: '.''. $user->document.''. ' fue Realizada.');
           
        }else{
           
            return redirect()->back()->with('Mensaje2','Curso inexistente!'); 
        }
        }
}
    