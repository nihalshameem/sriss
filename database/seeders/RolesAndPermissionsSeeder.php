<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

         public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'Dashboard']);
        Permission::create(['name' => 'Reports']);
        Permission::create(['name' => 'Location']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'ADMIN']);
        $role->givePermissionTo(['Dashboard', 'Reports']);

        // or may be done by chaining
        $role = Role::create(['name' => 'Location'])
            ->givePermissionTo('Location');

        $role->givePermissionTo(Permission::all());
    }
    
}
