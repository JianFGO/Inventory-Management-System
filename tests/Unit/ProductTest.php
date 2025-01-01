<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creation of a product
     */
    public function testCreateProduct()
    {
        $category = Category::factory()->create();
        $branch = Branch::factory()->create();
        $product = Product::create([
            'name' => 'Test Product',
            'category_id' => $category->id,
            'branch_id' => $branch->id,
            'price' => 0.44,
            'quantity' => 22,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'category_id' => $category->id,
            'branch_id' => $branch->id,
            'price' => 0.44,
            'quantity' => 22,
        ]);
    }

    /**
     * Test updating a product
     */
    public function testUpdateProduct()
    {
        $product = Product::create([
            'name' => 'Not Updated Product',
            'category_id' => 1,
            'branch_id' => 3,
            'price' => 0.24,
            'quantity' => 11,
        ]);

        $product->update([
            'name' => 'Updated Product',
            'category_id' => 2,
            'branch_id' => 1,
            'price' => 0.88,
            'quantity' => 23,
        ]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'category_id' => 2,
            'branch_id' => 1,
            'price' => 0.88,
            'quantity' => 23,
        ]);
    }

    /**
     * Test deletion of a product
     */
    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $productId = $product->id;
        $product->delete();

        $this->assertDatabaseMissing('products', ['id' => $productId]);
    }

    /**
     * Test retrieval of a product from database
     */
    public function testRetrieveProduct()
    {
        $product = Product::factory()->create([
            'name' => 'Retrieve Product',
            'quantity' => 50,
        ]);

        $retrievedProduct = Product::find($product->id);

        $this->assertEquals('Retrieve Product', $retrievedProduct->name);
        $this->assertEquals(50, $retrievedProduct->quantity);
    }

    /**
     * Test product relationships to category and branch
     */
    public function testProductRelationships()
    {
        $category = Category::factory()->create([
            'name' => 'Test Category',
        ]);

        $branch = Branch::factory()->create([
            'name' => 'Test Branch',
        ]);

        $product = Product::factory()->create([
            'category_id' => $category->id,
            'branch_id' => $branch->id,
        ]);

        $this->assertEquals('Test Category', $product->category->name);
        $this->assertEquals('Test Branch', $product->branch->name);
    }
}
