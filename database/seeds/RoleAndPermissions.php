<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // create role
        $superAdmin = Role::updateOrCreate(['name' => 'admin']);
        $editor = Role::updateOrCreate(['name' => 'editor']);
        // create permissions
        Permission::create(['name' => 'kelola user']);
        Permission::create(['name' => 'edit berita']);
        Permission::create(['name' => 'delete berita']);

        /* Assign Permission */
        $superAdmin->syncPermissions(Permission::all());
        $editor->syncPermissions([
            'edit berita',
        ]);
    }
}
