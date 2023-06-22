<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'admin']);
        $permissions = [
            [
                'prefix' => 'user',
                'name' => 'view user'
            ],
            [
                'prefix' => 'user',
                'name' => 'add user'
            ],
            [
                'prefix' => 'user',
                'name' => 'edit user'
            ],
            [
                'prefix' => 'user',
                'name' => 'delete user'
            ],
            [
                'prefix' => 'role',
                'name' => 'view role'
            ],
            [
                'prefix' => 'role',
                'name' => 'add role'
            ],
            [
                'prefix' => 'role',
                'name' => 'edit role'
            ],
            [
                'prefix' => 'role',
                'name' => 'delete role'
            ],
            [
                'prefix' => 'permission',
                'name' => 'view permission'
            ],
            [
                'prefix' => 'permission',
                'name' => 'add permission'
            ],
            [
                'prefix' => 'permission',
                'name' => 'edit permission'
            ],
            [
                'prefix' => 'permission',
                'name' => 'delete permission'
            ],
        ];
        foreach($permissions as $item){
            Permission::create($item);
        }
        $role->syncPermissions(Permission::all());
        $user = User::first();
        $user->assignRole($role);
        Role::create(['name' => 'user']);

    }
}
