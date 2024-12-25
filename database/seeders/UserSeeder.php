<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Users to be seeded into database
        $users = [
            // Admins
            [
                'name' => 'Adel Mint',
                'email' => 'adel@gmail.com',
                'password' => Hash::make('Password1'),
                'branch_id' => 1,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Helen Back',
                'email' => 'helen@gmail.com',
                'password' => Hash::make('Password2'),
                'branch_id' => 2,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Altan Right',
                'email' => 'altan@gmail.com',
                'password' => Hash::make('Password3'),
                'branch_id' => 3,
                'email_verified_at' => now()
            ],

            // Managers
            [
                'name' => 'Mannie Carter',
                'email' => 'mannie@gmail.com',
                'password' => Hash::make('Password1'),
                'branch_id' => 2,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Sue Pervisor',
                'email' => 'sue@gmail.com',
                'password' => Hash::make('Password2'),
                'branch_id' => 1,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Taska Signer',
                'email' => 'taska@gmail.com',
                'password' => Hash::make('Password3'),
                'branch_id' => 3,
                'email_verified_at' => now()
            ],

            // Sales clerks
            [
                'name' => 'Sal Clarkson',
                'email' => 'sal@gmail.com',
                'password' => Hash::make('Password1'),
                'branch_id' => 3,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Bill Board',
                'email' => 'bill@gmail.com',
                'password' => Hash::make('Password2'),
                'branch_id' => 1,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Penny Counter',
                'email' => 'penny@gmail.com',
                'password' => Hash::make('Password3'),
                'branch_id' => 2,
                'email_verified_at' => now()
            ],
        ];

        // Loop and insert each user into database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
