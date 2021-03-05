<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use Notifiable , HasRoles;

    protected $guard_name = 'web';

     protected $fillable = [
        'name',

        'email',

        'password',

        'Mobile_No',
    ];

    protected $table = 'drs_admins_tbl';
}
