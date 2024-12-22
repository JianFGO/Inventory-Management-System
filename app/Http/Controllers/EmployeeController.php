<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Employees;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employees::all();
        $page_title = 'Users';
        return view('employee.index', compact('employees', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        $page_title = 'Add User';
        return view('employee.create', compact('branches','page_title'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate request to make sure the fields are provided in correct data type
        $request->validate([
            'full_name'=>'required|string',            
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',        
            'role' => 'required',
            'branch_id' => 'required',
        ]);

         // Create new employee
         Employees::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
            'branch_id' => $request->branch_id
        ]);

        // Redirect to employee homepage
        return redirect()->route('employees.index');
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
        // Find employee by ID or throw error if not found
        $employee = Employees::findOrFail($id);
        $branches = Branch::all();
        $page_title = 'Edit User';
        return view('employee.edit', compact('employee','branches','page_title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employees::findOrFail($id);
        $request->validate([
            'full_name'=>'required|string',            
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',        
            'role' => 'required',
            'branch_id' => 'required',
        ]);

        // Update changes made to employee with validated input
         $employee->update([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => $request->password,
            'role' => $request->role,
            'branch_id' => $request->branch_id
        ]);

        // Redirect to employee homepage
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employees::findOrFail($id);

        // Delete employee from database
        $employee->delete();

        // Redirect to previous page
        return back();
    }
}
