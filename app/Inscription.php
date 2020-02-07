<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    public function location()
    {
        return $this->belongsTo('App/Location');
    }
    public function unity()
    {
        return $this->belongsTo('App/Unity');
    }
    public function user()
    {
        return $this->belongsTo('App/User');
    }
    public function company()
    {
        return $this->belongsTo('App/Company');
    }

    public function participants()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
