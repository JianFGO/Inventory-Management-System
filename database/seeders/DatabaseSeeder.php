<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

// Seed database table with default data
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // SEED FIRST (comment out other seeder calls) - otherwise there may be error with permissions not seeding
        $this->call([PermissionSeeder::class]);

        // SEED SECOND (comment out permission seeder call)
        $this->call([CategorySeeder::class]);
        $this->call([BranchSeeder::class]);
        $this->call([UserSeeder::class]);
        $this->call([RoleSeeder::class]);
        $this->call([AssignRolesToExistingUsersSeeder::class]);
        $this->call([ProductSeeder::class]);
    }
}
