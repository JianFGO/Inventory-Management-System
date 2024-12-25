<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed database table with default data
        // Seed first
        // $this->call([PermissionSeeder::class]);

        // Seed second (comment out permission seeder call)
        // $this->call([CategorySeeder::class]);
        // $this->call([BranchSeeder::class]);
        $this->call([UserSeeder::class]);
        // $this->call([RoleSeeder::class]);
        $this->call([AssignRolesToExistingUsersSeeder::class]);
        // $this->call([ProductSeeder::class]);
    }
}
