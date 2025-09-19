<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
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
            'user_name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone_number' => 'required',
            'profile_photo' => 'nullable',
            'user_type' => 'required',
        ]);
        $validated['password'] = bcrypt($validated['password']);
        return User::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'first_name' => 'sometimes|required',
            'middle_name' => 'nullable',
            'last_name' => 'sometimes|required',
            'user_name' => 'sometimes|required|unique:users,user_name,' . $id,
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|min:8',
            'phone_number' => 'nullable',
            'profile_photo' => 'nullable',
            'user_type' => 'required',
        ]);
        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }
        $user->update($validated);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }

    /**
     * Display a listing of the resources by multiple IDs.
     */
    public function multiple(Request $request)
    {
        $ids = $request->query('ids');
        if (!$ids) {
            return response()->json(['error' => 'No IDs provided'], 400);
        }
        $idArray = array_map('intval', explode(',', $ids));
        $users = User::whereIn('id', $idArray)->get();
        return response()->json($users);
    }
}
