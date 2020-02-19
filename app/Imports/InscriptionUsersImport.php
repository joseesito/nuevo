<?php

namespace App\Imports;

use App\Company;
use App\InscriptionUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InscriptionUsersImport implements OnEachRow, WithHeadingRow
{
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     */

    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        // recuperamos toda la fila
        $row      = $row->toArray();

        // recuperamos al facilitador
        $fac = Auth::user();

        // inicializamos la variables inscription_user
        $user_id = null;
        $inscription_id = $this->id;

        // inicializamos la variables creacion de usuarios
        $company_id = null;
        $unity_id = $fac->unity_id;
        $user_created = $fac->id;

        // verificar si existe la empresa
        $company = Company::where('ruc', $row['ruc']);

        if ($company->exists()) {
            $company_id = $company->first()->id;
        }

        // verificamos si exsite el participante
        $participant = User::join('model_has_roles','users.id','=','model_has_roles.model_id')
            ->where('users.document', $row['dnidocumento'])
            ->where('model_has_roles.role_id', 2);
        if ($participant->exists()) {
            // remplazamos la variable $user_id por el valor
            $user_id = $participant->first()->id;
        } else {
            if ($company->exists()){
                // creamos el usuario y le asignamos el rol 2(participante) y actulizamos la variable $user_id
                $user = User::create([
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
                $mensaje = 'La empresa con ruc ' .$row['ruc'].' y nombre'. $row['empresa'].' no existe';
                return redirect()->back()->with('Mensaje2',$mensaje);
            }
        }


        if (strlen(trim($row['dnidocumento'])) < 8 || trim($row['dnidocumento']) == '' ) {

            return redirect()->back()->with('Mensaje2','El documento del usuario :  '. $row['nombres'].'  debe tener por lo menos 8 dijitos');

        }

        // ------ a ver con el tiempo sobre la crecion del usuario y modificcion dle usuario

        if ($company->exists()) {
            
            
            InscriptionUser::updateOrCreate(
                [
                    'user_id' => $user_id,
                    'inscription_id' => $inscription_id,
                ],
                [
                    'grade_min' => 14,
                    'grade' => $row['nota'],
                    'type' => 0,
                    'company_id' => $company_id,
                    'unity_id' => $unity_id,
                    'user_modified' => $user_created,
                ]
            );
        }else {
            $mensaje = 'La empresa con ruc ' .$row['ruc'].' y nombre'. $row['empresa'].' no existe';
            return redirect()->back()->with('Mensaje2',$mensaje);
        }
    }
}
