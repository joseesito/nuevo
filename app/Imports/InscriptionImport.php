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

        // inicializamos la variables user
        $user_id = null;

        // inicializamos la variables creacion de usuarios
        $company_id = null;
        $unity_id = null;
        $user_created = $fac->id;
        $type_document = 0;

        // verificar si existe la empresa
        $company = Company::where('ruc', trim($row['ruc']));

        // verificar si existe la Unidad Minera
        $unity = Unity::where('name',trim($row['unidad_minera']));

        if ($company->exists()) {
            $company_id = $company->first()->id;
        }

        if (strlen(trim($row['dnidocumento'])) < 8 || trim($row['dnidocumento']) == '' ) {
            return redirect()->back()->with('Mensaje2','El documento del usuario :  '. $row['nombres'].'  debe tener por lo menos 8 dijitos');
        }

        if (strtoupper(trim($row['tipo_documento'])) == 'DNI' ||  strtoupper(trim($row['tipo_documento'])) == 'PASAPORTE') {
            if (trim($row['tipo_documento']) == 'DNI') {
                $type_document = 1;
            } else {
                $type_document = 2;
            }
        } else {
            return redirect()->back()->with('Mensaje2','El tipo documento del usuario :  '. $row['nombres'].'  debe de  ser DNI o PASAPORTE');
        }

        if($unity->exists()) {
            $unity_id = $unity->first()->id;

            // verificamos si exsite el participante
            $participant = User::join('model_has_roles','users.id','=','model_has_roles.model_id')
                ->where('users.document', $row['dnidocumento'])
                ->where('model_has_roles.role_id', 2);

            if ($participant->exists()) {
                $participant->update([
                    'type_document' => $type_document,
                    'name' => $row['nombres'],
                    'last_name' => $row['apellidos'],
                    'position' => $row['cargo'],
                    'area' => $row['area'],
                    'management' => $row['gerencia'],
                    'company_id' => $company_id,
                    'unity_id' => $unity_id,
                    'send_email' => $row['correo_envio'],
                    'user_modified' => $user_created,
                ]);

            } else {
                $part = User::create([
                    'type_document' => $type_document,
                    'document' => $row['dnidocumento'],
                    'name' => $row['nombres'],
                    'last_name' => $row['apellidos'],
                    'email' => $row['dnidocumento'].'exp@mail.com',
                    'position' => $row['cargo'],
                    'area' => $row['area'],
                    'management' => $row['gerencia'],
                    'company_id' => $company_id,
                    'send_email' => $row['correo_envio'],
                    'unity_id' => $unity_id,
                    'user_created' => $user_created,
                ]);
                $part->assignRole('participante');
            }
        } else {
            $mensaje = 'La Unidad  con nombre ' .$row['unidad_minera'].' no existe';
            return redirect()->back()->with('Mensaje2',$mensaje);
        }
    }
}
