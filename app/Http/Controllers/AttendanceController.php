<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Attendance::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'time_in_AM' => 'required|date_format:g:i:A',
            'time_out_AM' => 'required|date_format:g:i:A',
            'time_in_PM' => 'required|date_format:g:i:A',
            'time_out_PM' => 'required|date_format:g:i:A',
            'status' => 'required|string',
        ]);
        return Attendance::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Attendance::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $validated = $request->validate([
            'time_in_AM' => 'sometimes|required|date_format:g:i:A',
            'time_out_AM' => 'sometimes|required|date_format:g:i:A',
            'time_in_PM' => 'sometimes|required|date_format:g:i:A',
            'time_out_PM' => 'sometimes|required|date_format:g:i:A',
            'status' => 'sometimes|required|string',
        ]);
        $attendance->update($validated);
        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return response()->json(['message' => 'Attendance record deleted successfully']);
    }
}
