<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Permissions\HasPermissionsTrait;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    use HasPermissionsTrait;

     /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'Member_Id',

        'name',

        'email',

        'password',

        'mobile_number',
    ];

  

    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [
        'password', 'remember_token','api_token',
    ];

public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

