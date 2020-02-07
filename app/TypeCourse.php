<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

use Illuminate\Database\Eloquent\SoftDeletes;

class TypeCourse extends Model
{
    protected $dates = ['delete_at'];

    protected $fillable = [
        'name','state'
    ];
    
    protected $hidden = [
        'created_at','updated_at'
    ];
}
