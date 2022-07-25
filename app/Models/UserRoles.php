<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Permissions\HasPermissionsTrait;

class UserRoles extends Authenticatable
{
    use HasFactory;

    use HasPermissionsTrait;


     protected $fillable = [
        'user_id','role_id'
    ];
    
 	protected $table = 'users_roles';

 	 public function users()
    {
        return $this->belongsTo(User::class,'user_id','id');   
    }
}
