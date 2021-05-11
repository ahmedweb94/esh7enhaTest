<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions=[
            'edit setting',
            'edit static pages',
            'add driver',
            'edit driver',
            'show driver',
            'delete driver',

            'add product',
            'edit product',
            'show product',
            'delete product',

            'add region',
            'edit region',
            'show region',
            'delete region',

            'add city',
            'edit city',
            'show city',
            'delete city',

            'add category',
            'edit category',
            'show category',
            'delete category',

            'edit order',
            'show order',

            'edit users',
            'show users',

            'show contact us',

            'add admin',
            'edit admin',
            'show admin',
            'delete admin',

            'add role',
            'edit role',
            'delete role',
            'show role',
        ];
        foreach ($permissions as $p){
            \Spatie\Permission\Models\Permission::create(['name'=>$p,'guard_name'=>'admin']);
        }
        $admin=\Spatie\Permission\Models\Role::create(['name'=>'SuperAdmin','guard_name'=>'admin']);
        $admin->syncPermissions(\Spatie\Permission\Models\Permission::get());
        \App\Models\Admin::where('email','admin@admin.com')->first()->assignRole($admin->id);
    }
}
