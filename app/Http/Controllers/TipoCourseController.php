<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


class TipoCourseController extends Controller
{
    
    function __construct()
    {
        $this->middleware('permission:type_course-list');
        $this->middleware('permission:type_course-create',['only' => ['create','store']]);
        $this->middleware('permission:type_course-edit',['only' =>['edit','update']]);
        $this->middleware('permission:type_course-delete',['only' =>['destroy']]);

    }

    public function create()
    {
        
    }
}
