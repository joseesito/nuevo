<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InscriptionUser extends Model
{
    protected $table = 'inscription_user';

    protected $fillable = [
        'inscription_id', 'user_id', 'assistance',
        'grade_min', 'grade', 'company_id', 'unity_id',
        'user_created', 'user_modified', 'user_deleted'
    ];
}
