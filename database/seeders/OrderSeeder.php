<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Default orders to be seeded into database
         $orders = [
            // Orders for Sheffield            
            ['branch_id' => 1, 'order_no' => 'ORD_001', 'total_amount' => '106', 'paid_amount' => '50', 'delivery_date' => '2025-01-17'],
            ['branch_id' => 1, 'order_no' => 'ORD_002', 'total_amount' => '255', 'paid_amount' => '255', 'delivery_date' => '2025-01-22'],
            ['branch_id' => 1, 'order_no' => 'ORD_003', 'total_amount' => '417', 'paid_amount' => '100', 'delivery_date' => '2025-01-30'],

            //Orders for Manchester
            ['branch_id' => 2, 'order_no' => 'ORD_004', 'total_amount' => '475', 'paid_amount' => '250', 'delivery_date' => '2025-01-31'],
            ['branch_id' => 2, 'order_no' => 'ORD_005', 'total_amount' => '475', 'paid_amount' => '420', 'delivery_date' => '2025-02-03'],
            ['branch_id' => 2, 'order_no' => 'ORD_006', 'total_amount' => '330', 'paid_amount' => '330', 'delivery_date' => '2025-02-20'],

            //Orders for London
            ['branch_id' => 3, 'order_no' => 'ORD_007', 'total_amount' => '480', 'paid_amount' => '125', 'delivery_date' => '2025-02-27'],
            ['branch_id' => 3, 'order_no' => 'ORD_008', 'total_amount' => '475', 'paid_amount' => '250', 'delivery_date' => '2025-03-02'],
            ['branch_id' => 3, 'order_no' => 'ORD_009', 'total_amount' => '325', 'paid_amount' => '325', 'delivery_date' => '2025-03-04'],

        ];

        // Loop and insert each order into database
        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
