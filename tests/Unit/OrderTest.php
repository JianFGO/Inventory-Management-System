<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Branch;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creation of an order
     */
    public function testCreateOrder()
    {
        $category = Category::factory()->create();
        $branch = Branch::factory()->create();
        $product = Product::factory()->create();


         $order = Order::create([
            'order_no' => 'ORDTEST_001',
            'branch_id' => $branch->id,
            'paid_amount' => '150',
            'total_amount' => '175',
            'delivery_date' => '2025-01-17',
        ]);

        $orderDetail = OrderDetails::create([
            'order_id' => $order->id,
            'category_id' => $category->id,
            'product_id' => $product->id,
            'order_quantity' => '250',
            'unit_price' => '0.70'
        ]);

        $this->assertDatabaseHas('orders', [
            'order_no' => 'ORDTEST_001',
            'branch_id' => $branch->id,
            'paid_amount' => '150',
            'total_amount' => '175',
            'delivery_date' => '2025-01-17',
        ]);
        $this->assertDatabaseHas('order_details', [
            'order_id' => $order->id,
            'category_id' => $category->id,
            'product_id' => $product->id,
            'order_quantity' => '250',
            'unit_price' => '0.70'
        ]);
        
    }

    /**
     * Test updating an order
     */
    public function testUpdateOrder()
    {
        $order = Order::create([
            'order_no' => 'ORDNOUPDATE_001',
            'branch_id' => 2,
            'paid_amount' => '100',
            'total_amount' => '160',
            'delivery_date' => '2025-01-20',
        ]);

        $orderDetail = OrderDetails::create([
            'order_id' => $order->id,
            'category_id' => 2,
            'product_id' => 2,
            'order_quantity' => '200',
            'unit_price' => '0.80'
        ]);

        $order->update([
            'order_no' => 'ORDUPDATE_001',
            'branch_id' => 3,
            'paid_amount' => '90',
            'total_amount' => '135',
            'delivery_date' => '2025-01-22',
        ]);

        $orderDetail->update([
            'order_id' => $order->id,
            'category_id' => 3,
            'product_id' => 3,
            'order_quantity' => '150',
            'unit_price' => '0.90'
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'order_no' => 'ORDUPDATE_001',
            'branch_id' => 3,
            'paid_amount' => '90',
            'total_amount' => '135',
            'delivery_date' => '2025-01-22',
        ]);

        $this->assertDatabaseHas('order_details', [
            'id' => $orderDetail->id,
            'order_id' => $order->id,
            'category_id' => 3,
            'product_id' => 3,
            'order_quantity' => '150',
            'unit_price' => '0.90'
        ]);

    }

    // /**
    //  * Test deletion of an order
    //  */
    public function testDeleteOrder()
    {
        $order = Order::factory()->create();
        $orderDetail = OrderDetails::factory()->create();

        $orderId = $order->id;
        $order->delete();

        $orderDetailId = $orderDetail->id;
        $orderDetail->delete();

        $this->assertDatabaseMissing('orders', ['id' => $orderId]);
        $this->assertDatabaseMissing('order_details', ['id' => $orderDetailId]);

    }

    // /**
    //  * Test retrieval of an order from database
    //  */
    public function testRetrieveOrder()
    {
        $order = Order::factory()->create([
            'order_no' => 'ORDRETRIEVE_001',
            'total_amount' => '102',
        ]);

        $orderDetail = OrderDetails::factory()->create([
            'unit_price' => '0.85',
            'order_quantity' => '120',
        ]);

        $retrievedOrder = Order::find($order->id);
        $retrievedOrderDetail = OrderDetails::find($orderDetail->id);


        $this->assertEquals('ORDRETRIEVE_001', $retrievedOrder->order_no);
        $this->assertEquals('102', $retrievedOrder->total_amount);

        $this->assertEquals('0.85', $retrievedOrderDetail->unit_price);
        $this->assertEquals('120', $retrievedOrderDetail->order_quantity);
        
    }

    // /**
    //  * Test order relationships to category, branch and order details
    //  */
    public function testOrderRelationships()
    { 
        $branch = Branch::factory()->create([
            'name' => 'Test Branch',
        ]);
    
        $category = Category::factory()->create([
            'name' => 'Test Category',
        ]);
        $product = Product::factory()->create([
            'name' => 'Test Product',
        ]);
        $order = Order::factory()->create([
            'order_no' => 'ORDTESTRELATION_001',
            'branch_id' => $branch->id,
        ]);

        $orderDetail = OrderDetails::factory()->create([
            'category_id' => $category->id,
            'product_id' => $product->id,
            'order_id' => $order->id,

        ]);

        $this->assertEquals('Test Branch', $order->branch->name);

        $this->assertEquals('Test Category', $orderDetail->category->name);
        $this->assertEquals('Test Product', $orderDetail->product->name);
        $this->assertEquals('ORDTESTRELATION_001', $orderDetail->order->order_no);

    }
}
