<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssignRolesToExistingUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersWithRoles = [
            ['email' => 'adel@gmail.com', 'role' => 'Admin'],
            ['email' => 'helen@gmail.com', 'role' => 'Admin'],
            ['email' => 'altan@gmail.com', 'role' => 'Admin'],
            ['email' => 'mannie@gmail.com', 'role' => 'Manager'],
            ['email' => 'sue@gmail.com', 'role' => 'Manager'],
            ['email' => 'taska@gmail.com', 'role' => 'Manager'],
            ['email' => 'sal@gmail.com', 'role' => 'Sales Clerk'],
            ['email' => 'bill@gmail.com', 'role' => 'Sales Clerk'],
            ['email' => 'penny@gmail.com', 'role' => 'Sales Clerk'],
        ];

        foreach ($usersWithRoles as $userData) {
            $user = User::where('email', $userData['email'])->first();

            if ($user) {
                $user->assignRole($userData['role']);
                $this->command->info("Assigned '{$userData['role']}' to {$user->email}.");
            } else {
                $this->command->error("User with email {$userData['email']} not found.");
            }
        }
    }
}
