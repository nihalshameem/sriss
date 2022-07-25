<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        $permissions = [

           'AboutUs',

           'Compliance',

           'News Letter',

           'Language',

           'App Image',

           'App Icon',

           'Member DeAct',

           'Member Search',

           'Notifications',

           'Polls'

        ];

     

        foreach ($permissions as $permission) {

             Permission::create(['name' => $permission]);

        }

    }
}
