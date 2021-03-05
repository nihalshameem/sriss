<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Permissions\HasPermissionsTrait;

class Role extends Authenticatable
{
    use HasFactory;

 	use HasPermissionsTrait;


    public function permissions() {

	   return $this->belongsToMany(Permission::class,'roles_permissions');
	       
	}

	public function users() {

	   return $this->belongsToMany(User::class,'users_roles');
	       
	}
}
