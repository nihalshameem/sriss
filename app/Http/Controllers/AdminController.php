<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\User;
use App\Models\Admin;
use App\Models\UserPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Session;
use App\Models\UserRoles;

class AdminController extends Controller
{

    /*************** Web Application ************************/
   

    public function List()
    {
    	$permissions = Permission::get();
        $Roles = Role::get();
    	$Members = UserRoles::with('users')->orderby('user_id','desc')->get();
    	return view('roles.list',compact('permissions','Members','Roles'));
    }

    /*User Operations */

    public function ShowUser()
    {
        $Roles = Role::get();
        $Member = Member::get();
        return view('roles.adduser',compact('Member','Roles'));
    }

    public function EditUser($UserId)
    {
        $User = User::where('id',$UserId)->first();
        $Role = Role::get();
        $Roles = DB::table('users_roles')->where('user_id',$UserId)->first();
        return view('roles.user_edit',compact('Role','Roles'))->with([
            'User'   => $User,
        ]);
    }

    public function UpdateUser(Request $request)
    {
        $User = User::find($request->Id);
        $User->name = $request->name;
        $User->email = $request->email;
        $User->mobile_number = $request->mobile_number;
        $User->save();
        $Roleupdate = DB::table('users_roles')->where('user_id',$request->Id)->update(['role_id'=> $request->roles]);
        return redirect()->route('list.admin'); 
       
    }

    public function UserSearch(Request $request)
    {
     
         $members = Member::where('Mobile_NO','LIKE','%'.$request->UserSearch."%")->orWhere('Email_Id','LIKE','%'.$request->UserSearch."%")->orWhere('Member_Id','LIKE','%'.$request->UserSearch."%")->get();

         $users = User::where('mobile_number','LIKE','%'.$request->UserSearch."%")->orWhere('email','LIKE','%'.$request->UserSearch."%")->orWhere('Member_Id','LIKE','%'.$request->UserSearch."%")->get();
          
           return response()->json($users);
            
        
    }

    public function AssignUser(Request $request)
    {
        $Role = Role::where('id',$request->roles)->first();

        $user = User::where('id',$request->id)->update(['Role'=>$Role->slug]);   

        $dev_role = Role::where('slug',$Role->slug)->first();

        $users = User::where('name',$request->membername)->first(); 

        $users->roles()->attach($dev_role);   

        $Roleupdate = DB::table('users_roles')->where('user_id',$users->Id)->update(['role_id'=> $request->roles]);  

        return redirect()->route('list.admin'); 

    }

    public function RemoveRole(Request $request)
    {
        $Role = UserRoles::where('user_id',$request->RoleId)->first();
        $Roles = DB::table('roles_permissions')->where('role_id',$Role->role_id)->delete();
        $UserRoles = UserRoles::where('user_id',$request->RoleId)->delete();
        echo json_encode($request->RoleId);
    }
   
    /*Role Operations */

    public function AddRoles(Request $request)
    {
        $Role = new Role();
        $Role->name = $request->role;
        $Role->slug = $request->role;
        $Role->save();
        return redirect(route('list.admin'));
    }

    public function EditRole($RoleId)
    {
        
         $Role = Role::where("id",$RoleId)->first();
            return view('roles.role_edit')->with([
            'Role'   => $Role,
            
        ]);
    }

    public function UpdateRole(Request $request)
    {
        
        $Role = Role::find($request->Id);
        $Role->name = $request->name;
        $Role->save();
        return redirect(route('list.admin'))->withInput(['tab'=>'statedivision-tabs']);
    }

    public function DeleteRole(Request $request)
    {
        $Roles = UserRoles::where('role_id',$request->RoleId)->delete();
        $Roles = DB::table('roles_permissions')->where('role_id',$request->RoleId)->delete();
        $Roles = Role::where('id',$request->RoleId)->delete();
        echo json_encode($request->RoleId);
    }

    /*Permission Operation*/

    public function AddPermission(Request $request)
    {
        $Permission = new Permission();
        $Permission->name = $request->permission;
        $Permission->save();
        return redirect(route('list.admin'));
    }

     public function EditPermission($PermissionId)
    {
        
         $Permission = Permission::where("id",$PermissionId)->first();
            return view('roles.permission_edit')->with([
            'Permission'   => $Permission,
            
        ]);
    }

    public function UpdatePermission(Request $request)
    {
        
        $Permission = Permission::find($request->Id);
        $Permission->name = $request->name;
        $Permission->slug = $request->name;
        $Permission->save();
        return redirect(route('list.admin'))->withInput(['tab'=>'custom-tabs-three-profile']);
    }

    public function DeletePermission(Request $request)
    {

        $Permission = UserPermission::where('permission_id',$request->permissionId)->delete();
        $Permission = DB::table('roles_permissions')->where('permission_id',$request->permissionId)->delete();
        $Permission = Permission::where('id',$request->permissionId)->delete();
        echo json_encode($request->permissionId);
    }

    /*User Privileges Operations */

    public function EditPrivilleges($PrivillegeId)
    {
        $user = User::where('name',Session::get('name'))->first();
        $Roles = Role::where('id',$PrivillegeId)->first();
        $permissions = Permission::get();
        $role_permissions = DB::table('roles_permissions')->where('role_id',$PrivillegeId)->get();

        $role_permissionspluck = DB::table('roles_permissions')->where('role_id',$PrivillegeId)->pluck('permission_id');

         return view('roles.edit_privileges',compact('Roles','permissions','role_permissions','role_permissionspluck'));
    }


    public function UpdatePrivileges(Request $request)
    {

               $Roledelete = DB::table('roles_permissions')->where('role_id',$request->role_id)->delete();
               
           
        foreach ($request->permission as $key=>$cost) {

            UserPermission::create([
                'role_id' => $request->role_id[$key],
                'permission_id' => $cost,
            ]);
        }


         return redirect(route('list.admin'));

        
    }

 

    

}
