<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        // Allow viewing products for all users
        $this->middleware('custom_permission:view products')->only('index');

        // Restrict access for adding, editing, and deleting products to only admin and manager
        $this->middleware('custom_permission:manage products')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $page_title = "Products";
        return view('product.index', compact('products', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $branches = Branch::all();
        $page_title = "Add Product";
        return view('product.create', compact('categories', 'branches', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request to make sure the fields are provided in correct data type
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'branch_id' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        // Create new product
        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'branch_id' => $request->branch_id,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        // Redirect to product homepage
        return redirect()->route('product.index')->with('success', "Product '{$product->name}' successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_title = 'Edit Product';

        // Find product by ID or throw error if not found
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $branches = Branch::all();

        return view('product.edit', compact('product', 'categories', 'branches', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required',
            'branch_id' => 'required',
            'price' => 'required',
            'quantity' => 'required'
        ]);

        // Update product with validated input
        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'branch_id' => $request->branch_id,
            'price' => $request->price,
            'quantity' => $request->quantity
        ]);

        // Redirect to product homepage
        return redirect()->route('product.index')->with('success', "Product '{$product->name}' successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete product from database
        $product->delete();

        // Redirect to previous page
        return back()->with('success', "Product '{$product->name}' successfully deleted.");
    }
}
