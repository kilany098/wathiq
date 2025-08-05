<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\userDataTable;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
    Role
};

class UserController extends Controller
{
    public function index(userDataTable $datatable)
    {
        $roles = Role::all();
        return $datatable->render('user.users', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'role' => 'required|in:superadmin,admin,operation,inventory,hr,accountant,technician',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => 'pending',
            'password' => Hash::make($validated['password']),
        ]);
        $user->addRole($validated['role']);
        // Return response
        return response()->json(['message' => 'User created successfully', 'data' => $user], 201);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json(['user' => $user], 201);
    }


    public function update(Request $request, $id)
    {
        // Find user by ID
        $user = User::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email'],
            'phone' => 'required|string|max:15',
            'status' => 'required|in:0,1',
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|string'
        ]);

        // Update user attributes
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->phone = $validated['phone'];
        $user->is_active = $validated['status'];
        // Update password only if provided
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        if (!empty($validated['role'])) {
            $user->removeRole($user->roles->first()->name);
            $user->addRole($validated['role']);
        }
        $user->save();
        return response()->json(['message' => 'User updated successfully'], 200);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->removeRole($user->roles->first()->name);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 201);
    }
}
