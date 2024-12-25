<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        // Allow viewing categories for all users
        $this->middleware('custom_permission:view categories')->only('index');

        // Restrict access for adding, editing, and deleting categories to only admin and manager
        $this->middleware('custom_permission:manage categories')->only('create', 'store', 'edit', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $page_title = "Categories";
        return view('category.index', compact('categories', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = 'Add Category';
        return view('category.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request to make sure the name field is provided and is a string
        $request->validate([
            'name' => 'required|string'
        ]);

        // Create new category
        $category = Category::create([
            'name' => $request->name
        ]);

        // Redirect to category homepage
        return redirect()->route('category.index')->with('success', "Category '{$category->name}' successfully created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_title = 'Edit Category';

        // Find category by ID or throw error if not found
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string'
        ]);

        // Update category name with validated input
        $category->update([
            'name' => $request->name
        ]);

        // Redirect to category homepage
        return redirect()->route('category.index')->with('success', "Category '{$category->name}' successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Delete category from database
        $category->delete();

        // Redirect to previous page
        return back()->with('success', "Category '{$category->name}' successfully deleted.");
    }
}
