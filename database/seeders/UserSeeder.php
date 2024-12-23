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
            [
                'name' => 'Adel Mint',
                'email' => 'adel@gmail.com',
                'password' => Hash::make('Password1'),
                'branch_id' => 1,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Mannie Carter',
                'email' => 'mannie@gmail.com',
                'password' => Hash::make('Password1'),
                'branch_id' => 2,
                'email_verified_at' => now()
            ],
            [
                'name' => 'Sal Clarkson',
                'email' => 'sal@gmail.com',
                'password' => Hash::make('Password1'),
                'branch_id' => 3,
                'email_verified_at' => now()
            ],
        ];

        // Loop and insert each causer into database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
