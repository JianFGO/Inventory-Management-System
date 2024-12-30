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
     * A basic unit test example.
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
}
