<?php

namespace App\Exports;
use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InscriptionExport implements FromCollection,WithHeadings
{

    public function headings(): array
    {
        return[
            'Documento',
            'Apellidos Completos',
            'Nombre',
            'Nombre_Compañia',
            'Cargo',
            'Unidad',
            'Area',
            'Administracion',
            'Ruc',
        ];
    }
    public function collection(){   
        $data = DB::table('users')->select('users.document','users.last_name','users.name', 'companies.name as company', 'users.position',
        'unities.name as unity','users.area','users.management','companies.ruc as ruc')
        ->join('model_has_roles','users.id','=','model_has_roles.model_id')
        ->join('companies', 'companies.id', '=', 'users.company_id')
        ->join('unities', 'unities.id', '=', 'users.unity_id')
        ->where('model_has_roles.role_id', 2)->get();     

        return $data;
    }
    
   
}
