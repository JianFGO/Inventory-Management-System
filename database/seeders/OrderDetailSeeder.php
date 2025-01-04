<?php

namespace Database\Seeders;

use App\Models\OrderDetails;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default order details to be seeded into database
        $orderDetails = [
            // Orders Details for Sheffield
            ['order_id' => 1, 'category_id' => 1,'product_id' => 1, 'order_quantity' => '70', 'unit_price' => '0.80'],
            ['order_id' => 1, 'category_id' => 2,'product_id' => 4, 'order_quantity' => '100', 'unit_price' => '0.50'],

            ['order_id' => 2, 'category_id' => 3,'product_id' => 6, 'order_quantity' => '300', 'unit_price' => '0.85'],

            ['order_id' => 3, 'category_id' => 4,'product_id' => 8, 'order_quantity' => '100', 'unit_price' => '0.75'],
            ['order_id' => 3, 'category_id' => 5,'product_id' => 10, 'order_quantity' => '120', 'unit_price' => '1.10'],
            ['order_id' => 3, 'category_id' => 1,'product_id' => 2, 'order_quantity' => '140', 'unit_price' => '1.50'],


            // //Order Details for Manchester
            ['order_id' => 4, 'category_id' => 5,'product_id' => 11, 'order_quantity' => '170', 'unit_price' => '1.30'],
            ['order_id' => 4, 'category_id' => 3,'product_id' => 7, 'order_quantity' => '80', 'unit_price' => '1.05'],
            ['order_id' => 4, 'category_id' => 2,'product_id' => 5, 'order_quantity' => '400', 'unit_price' => '0.30'],

            ['order_id' => 5, 'category_id' => 1,'product_id' => 3, 'order_quantity' => '175', 'unit_price' => '1.00'],
            ['order_id' => 5, 'category_id' => 2,'product_id' => 4, 'order_quantity' => '200', 'unit_price' => '0.50'],
            ['order_id' => 5, 'category_id' => 4,'product_id' => 9, 'order_quantity' => '125', 'unit_price' => '1.60'],

            ['order_id' => 6, 'category_id' => 5,'product_id' => 10, 'order_quantity' => '300', 'unit_price' => '1.10'],

            // //Order Details for London
            ['order_id' => 7, 'category_id' => 2,'product_id' => 5, 'order_quantity' => '400', 'unit_price' => '0.30'],
            ['order_id' => 7, 'category_id' => 4,'product_id' => 8, 'order_quantity' => '480', 'unit_price' => '0.75'],

            ['order_id' => 8, 'category_id' => 1,'product_id' => 1, 'order_quantity' => '275', 'unit_price' => '0.80'],
            ['order_id' => 8, 'category_id' => 3,'product_id' => 6, 'order_quantity' => '300', 'unit_price' => '0.85'],

            ['order_id' => 9, 'category_id' => 5,'product_id' => 11, 'order_quantity' => '250', 'unit_price' => '1.30'],

        ];

        // Loop and insert each orderdetail into database
        foreach ($orderDetails as $orderDetail) {
            OrderDetails::create($orderDetail);
        }
    }
}
