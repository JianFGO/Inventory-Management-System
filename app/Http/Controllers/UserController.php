<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $page_title = 'Users';
        return view('user.index', compact('users', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        $page_title = 'Add User';
        return view('user.create', compact('branches', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request to make sure the fields are provided in correct data type
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'branch_id' => 'required',
        ]);

        // Create new user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            'branch_id' => $request->branch_id
        ]);

        // Redirect to user homepage
        return redirect()->route('user.index');
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
        // Find user by ID or throw error if not found
        $user = User::findOrFail($id);
        $branches = Branch::all();
        $page_title = 'Edit User';
        $roles = ['Admin', 'Manager', 'Sales Clerk'];
        return view('user.edit', compact('user', 'branches', 'roles', 'page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'role' => 'required',
            'branch_id' => 'required',
        ]);

        // Update changes made to user with validated input
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'branch_id' => $request->branch_id
        ]);

        // Redirect to user homepage
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Delete user from database
        $user->delete();

        // Redirect to previous page
        return back();
    }
}
