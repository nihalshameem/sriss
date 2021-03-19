<?php 
namespace App\Permissions;

use App\Models\Permission;
use App\Models\Role;
use DB;

trait HasPermissionsTrait {

   public function givePermissionsTo(... $permissions) {

    $permissions = $this->getAllPermissions($permissions);
    if($permissions === null) {
      return $this;
    }
    $this->permissions()->saveMany($permissions);
    return $this;
  }

  public function withdrawPermissionsTo( ... $permissions ) {

    $permissions = $this->getAllPermissions($permissions);
    $this->permissions()->detach($permissions);
    return $this;

  }

  public function refreshPermissions( ... $permissions ) {

    $this->permissions()->detach();
    return $this->givePermissionsTo($permissions);
  }

  public function hasPermissionTo($permission) {

    return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
  }

   public function hasPermissionViaRole($permission): bool
    {
        return $this->hasRole($permission->roles);
    }



  public function hasPermissionThroughRole($permission) {

    foreach ($permission->roles as $role){
      if($this->roles->contains($role)) {
        return true;
      }
    }
    return false;
  }

  public function hasRole( ... $roles ) {

    foreach ($roles as $role) {
      if ($this->roles->contains('slug', $role)) {
        return true;
      }
    }
    return false;
  }

  public function roles() {

    return $this->belongsToMany(Role::class,'users_roles');

  }
  public function permissions() {

    return $this->belongsToMany(Permission::class,'roles_permissions','role_id');

  }
  
  public function hasPermission($permission,$role) 
  {
    $permission = Permission::where('slug',$permission)->first();
    return (bool) DB::table('roles_permissions')->where('role_id',$role)->where('permission_id',$permission['id'])->count();
  }

  protected function getAllPermissions(array $permissions) {

    return Permission::whereIn('slug',$permissions)->get();
    
  }
   public function hasPermissions($permissions,$role) 
  {
    $permission = Permission::whereIn('slug',$permissions)->pluck('id');
    return (bool) DB::table('roles_permissions')->where('role_id',$role)->count();
  }

}
?>