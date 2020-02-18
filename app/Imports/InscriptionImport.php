<?php

namespace App\Imports;

use App\User;
use App\Unity;
use App\Company;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;

class InscriptionImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    // $data = DB::table('users')->select('users.id', 'users.document', 'users.name', 'users.last_name', 'users.position', 'users.area',
    //    'users.management','companies.name as company', 'unities.name as unity',  'users.email')
    
    
    
    
    
    public function model(array $row)
    {
        
    dd($row[5]);
        //$company=Company::where
    $unity = DB::table('unities as unity')
    ->select('unity.id','unity.name')
    ->where($row[5],'=','unity.name')
    ->get();

    
    $unity= Unity::where($row[5],'=','unities.name')
                ->pluck('name','id');
               
    $company= Company::where($row[8],'=','ruc')
                ->pluck('name','id','ruc');    


        return new User([

            'id' => $row[0],
            'last_name' => $row[1],
            'name' => $row[2],
            'Company_id.name' => $row[3],
            'position' => $row[4],
            'unity_id.name' => $row[5],
            'area' => $row[6],
            'management' => $row[7],
            'company_id.ruc' => $row[8],
        ]);
    }
}
