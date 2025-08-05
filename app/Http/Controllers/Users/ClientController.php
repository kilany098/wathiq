<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\DataTables\clientDataTable;
use Illuminate\Http\Request;
use App\Models\{
    client,
};

class ClientController extends Controller
{
    public function index(clientDataTable $datatable)
    {
        return $datatable->render('user.client');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'tax_number' => 'required_if:type,company|nullable|string|max:50',
            'type' => 'required|in:individual,company',
        ]);

        // Create new user
        $client = client::create($validated);
        // Return response
        return response()->json(['message' => 'Client created successfully', 'data' => $client], 201);
    }

    public function edit($id)
    {
        $client = client::find($id);
        return response()->json(['client' => $client], 201);
    }


    public function update(Request $request, $id)
    {
        // Find user by ID
        $client = client::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'tax_number' => 'required_if:type,company|nullable|string|max:50',
            'type' => 'required|in:individual,company',
        ]);

        // Update user attributes
        $client->update($validated);
        return response()->json(['message' => 'Client updated successfully'], 200);
    }

    public function delete($id)
    {
        $client = client::find($id);
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 201);
    }
}
