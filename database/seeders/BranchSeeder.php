<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Branches to be seeded into database
        $branches = [
            ['id' => 1, 'name' => 'Candy Atlas Sheffield', 'address' => '5 Park Lane S2 1OP'],
            ['id' => 2, 'name' => 'Candy Atlas Manchester', 'address' => '2 Count Road, M1 2EB'],
            ['id' => 3, 'name' => 'Candy Atlas London', 'address' => '88 Green Street L2 3WN']
        ];

        // Loop and insert each category into database
        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
