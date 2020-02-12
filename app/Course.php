<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'type_course_id','name','hours','state', 'validity', 'grade_min'
    ];
    
    protected $hidden = [
        'created_at','updated_at'
    ];
}
