<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'middle_name' => 'nullable',
            'last_name' => 'required',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required',
            'age' => 'required|integer',
            'sex' => 'required',
            'address' => 'required',
            'job_title' => 'required',
            'department' => 'required',
            'status' => 'required',
            'date_of_service' => 'required|date',
            'salary' => 'required|numeric',
        ]);
        return Employee::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Employee::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $validated = $request->validate([
            'first_name' => 'sometimes|required',
            'middle_name' => 'nullable',
            'last_name' => 'sometimes|required',
            'date_of_birth' => 'sometimes|required|date',
            'place_of_birth' => 'sometimes|required',
            'age' => 'sometimes|required|integer',
            'sex' => 'sometimes|required',
            'address' => 'sometimes|required',
            'job_title' => 'sometimes|required',
            'department' => 'sometimes|required',
            'status' => 'sometimes|required',
            'date_of_service' => 'sometimes|required|date',
            'salary' => 'sometimes|required|numeric',
        ]);
        $employee->update($validated);
        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json(['message' => 'Employee deleted successfully']);
    }
}
