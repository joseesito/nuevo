<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
        'course_id','location_id','start_date','end_date','address','time','slot',
        'state', 'user_id', 'name', 'price', 'hours',
    ];
    protected $hidden = [
        'created_at','updated_at'
    ];

    protected $dates = [
      'start_date', 'end_date',
    ];

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

    public function getAddressAttribute($value)
    {
        return strtoupper($value);
    }

    public function getStartDateAttribute($value) {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
