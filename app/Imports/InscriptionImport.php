<?php

namespace App\Imports;

use App\Company;
use App\Unity;
use App\Inscription;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InscriptionImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {

        $rowIndex = $row->getIndex();
        // recuperamos toda la fila
        $row      = $row->toArray();

        // recuperamos al facilitador
        $fac = Auth::user();


        // inicializamos la variables inscription_user
        $user_id = null;
        

        // inicializamos la variables creacion de usuarios
        $company_id = null;
        $unity_id = $fac->unity_id;
        $user_created = $fac->id;

        // verificar si existe la empresa
       
        $company = Company::where('ruc', $row['ruc']);
        
        $unities = Unity::where('name',$row['unidad_minera']); 
            
        if ($company->exists()) {
            $company_id = $company->first()->id;
        }
       
        // verificamos si exsite el participante
        $participant = User::join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->where('users.document', $row['dnidocumento'])
            ->where('model_has_roles.role_id', 2);

        if (strlen(trim($row['dnidocumento'])) < 8 || trim($row['dnidocumento']) == '' ) {
           
                return redirect()->back()->with('Mensaje2','El documento del usuario :  '. $row['nombres'].'  debe tener por lo menos 8 dijitos');
                
                
        }
            
        if ($participant->exists()) {
            // remplazamos la variable $user_id por el valor
            $user_id = $participant->first()->id;
        }
        
        
           
        if ($company->exists() && $unities->exists()){
                // creamos el usuario y le asignamos el rol 2(participante) y actulizamos la variable $user_id
                
                $user = User::updateOrCreate(
                    
                    [
                        'id' => $user_id,
                    ],
                    
                [
                    
                    'company_id' => $company_id,
                    'unity_id' => $unity_id,
                    'document' => trim($row['dnidocumento']),
                    'type_document' => 1,
                    'last_name' => $row['apellidos'],
                    'name' => $row['nombres'],
                    'position' => $row['cargo'],
                    'area' => $row['area'],
                    'management' => $row['gerencia'],
                    'email' => $row['dnidocumento'].'ex@mail.com',
                    'user_created' => $user_created,
                ]);
                
                $user->assignRole('participante');
                $user_id = $user->id;
                
            }
            else {
                if(! $unities->exists()){
                    $mensaje = 'La Unidad  con nombre ' .$row['unidad_minera'].' no existe';
                }elseif(! $company->exists()){
                    $mensaje = 'La empresa  con Ruc ' .$row['ruc'].' y nombre'. $row['empresa'].' no existe';
                }else{
                    $mensaje = 'La empresa  con Ruc ' .$row['ruc'].' y nombre'. $row['empresa'].
                    ' no existe'.'La Unidad  con nombre ' .$row['unidad_minera'].' no existe';
                }
               
                return redirect()->back()->with('Mensaje2',$mensaje);              
            }
        
        
        
     /*   if (trim($row['tipo_documento'])!=='DNI' || trim($row['tipo_documento']) !== 'PASAPORTE' ) {
           
            return redirect()->back()->with('Mensaje2','El Tipo de documento del usuario :  '. $row['nombres'].'  debe tener por ser DNI o PASAPORTE');
            
        }
        */    
// ------ a ver con el tiempo sobre la crecion del usuario y modificcion dle usuario
      
    
       if($company->exists() && $unities->exists()) {
            
       User::updateOrCreate(
                [
                   
                    'id' => $user_id,
                ],
                [  
                    'type_document' => 1,
                    'company_id' => $company_id,
                    'unity_id' => $unity_id,
                    'user_modified' => $user_created,
                ]
            );
        }else {
            if(! $unities->exists()){
                $mensaje = 'La Unidad  con nombre ' .$row['unidad_minera'].' no existe';
            }elseif(! $company->exists()){
                $mensaje = 'La empresa  con Ruc ' .$row['ruc'].' y nombre'. $row['empresa'].' no existe';
            }else{
                $mensaje = 'La empresa  con Ruc ' .$row['ruc'].' y nombre'. $row['empresa'].
                ' no existe'.'La Unidad  con nombre ' .$row['unidad_minera'].' no existe';
            }
           
            return redirect()->back()->with('Mensaje2',$mensaje);
        }
    
    }
    
}
