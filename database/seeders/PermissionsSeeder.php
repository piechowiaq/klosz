<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class PermissionsSeeder extends Seeder
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

        // create permissions
        Permission::create(['name' => 'view users', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'create users', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'edit users', 'guard_name' => 'sanctum']);
        Permission::create(['name' => 'delete users', 'guard_name' => 'sanctum']);
    }
}
