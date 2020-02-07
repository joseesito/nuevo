<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    protected $fillable = [
        'name', 'email', 'password','company_id','unity_id','type_document','document','last_name',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
     * fACILITADOR
     */
    public function inscriptions()
    {
        return $this->hasMany('App\Inscription');
    }

    public function unity()
    {
        return $this->belongsTo('App/Unity');
    }

    public function company()
    {
        return $this->belongsTo('App/Company');
    }

    /*
     * PARTCIPNTES
     */
    public function userInscriptions()
    {
        return $this->belongsToMany(Inscription::class)->withTimestamps();
    }
}
