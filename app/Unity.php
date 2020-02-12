<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    protected $names =[
        'name'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
