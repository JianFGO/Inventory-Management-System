<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Manager', 'Sales Clerk'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $role = Role::findByName('Admin');
        $role->givePermissionTo(['manage users', 'manage products', 'manage categories', 'manage orders', 'view products', 'view categories']);

        $role = Role::findByName('Manager');
        $role->givePermissionTo(['manage products', 'manage categories', 'manage orders', 'view products', 'view categories']);

        $role = Role::findByName('Sales Clerk');
        $role->givePermissionTo(['view products', 'view categories']);
    }
}
