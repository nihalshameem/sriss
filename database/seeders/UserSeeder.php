<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\MemberIdConfig;
use Carbon\Carbon;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dev_permission = Permission::where('slug','About-Us')->first();
        $dev_role = new Role();
        $dev_role->slug = 'Super-Admin';
        $dev_role->name = 'Super Admin';
        $dev_role->save();
        $dev_role->permissions()->attach($dev_permission);

        $createTasks = new Permission();
        $createTasks->slug = 'About-Us';
        $createTasks->name = 'About Us';
        $createTasks->save();
        $createTasks->roles()->attach($dev_role);
        $dev_role = Role::where('slug','Super-Admin')->first();
        $dev_perm = Permission::where('slug','About-Us')->first();
        
        $developer = new User();
        $developer->name = 'sadmin';
        $developer->email = 'sadmin@gmail.com';
        $developer->password = \Hash::make('admin@123');
        $developer->Mobile_No = '123567890';
        $developer->Role = 'SuperAdmin';
        $developer->save();
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_perm);

    }
}
