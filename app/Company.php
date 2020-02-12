<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'ruc', 'name', 'address', 'phone',
    ];
    public function users()
    {
        return $this->hasMany('App\users');
    }
}
