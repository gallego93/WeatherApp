<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        Permission::create(['name' => 'dashboard.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'profile.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'users.index'])->assignRole($admin);
        Permission::create(['name' => 'users.create'])->assignRole($admin);
        Permission::create(['name' => 'users.edit'])->assignRole($admin);
        Permission::create(['name' => 'users.delete'])->assignRole($admin);
        Permission::create(['name' => 'users.show'])->assignRole($admin);
        Permission::create(['name' => 'roles.index'])->assignRole($admin);
        Permission::create(['name' => 'roles.create'])->assignRole($admin);
        Permission::create(['name' => 'roles.edit'])->assignRole($admin);
        Permission::create(['name' => 'roles.delete'])->assignRole($admin);
        Permission::create(['name' => 'roles.show'])->assignRole($admin);
        Permission::create(['name' => 'permissions.index'])->assignRole($admin);
        Permission::create(['name' => 'permissions.create'])->assignRole($admin);
        Permission::create(['name' => 'permissions.edit'])->assignRole($admin);
        Permission::create(['name' => 'permissions.delete'])->assignRole($admin);
        Permission::create(['name' => 'permissions.show'])->assignRole($admin);
        Permission::create(['name' => 'weathers.index'])->syncRoles($admin, $user);
        Permission::create(['name' => 'weathers.create'])->syncRoles($admin, $user);
        Permission::create(['name' => 'weathers.edit'])->syncRoles($admin, $user);
        Permission::create(['name' => 'weathers.delete'])->syncRoles($admin, $user);
        Permission::create(['name' => 'weathers.show'])->syncRoles($admin, $user);
    }
}
