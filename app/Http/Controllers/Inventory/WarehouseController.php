<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\warehouseDataTable;
use App\Models\{warehouse,
 User   
};

class WarehouseController extends Controller
{
    public function index(warehouseDataTable $datatable)
    {
        $managers = User::whereHasRole('inventory')->get();
        return $datatable->render('inventory.warehouse',compact('managers'));
    }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager_id'=>'required',
            'description' => 'required|string|max:255',
        ]);

        // Create new user
        $warehouse = warehouse::create([
            'name' => $validated['name'],
            'location' => $validated['location'],
            'manager_id' => $validated['manager_id'],
            'description'=> $validated['description'],
        ]);
        // Return response
        return response()->json(['message' => 'Warehouse created successfully', 'data' => $warehouse], 201);
    }
    public function edit($id)
    {
        $warehouse = warehouse::find($id);
        return response()->json(['warehouse' => $warehouse], 201);
    }

    public function update(Request $request, $id)
    {
        // Find user by ID
        $warehouse = warehouse::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager_id'=>'required',
            'description' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);

        // Update user attributes
        $warehouse->name = $validated['name'];
        $warehouse->location = $validated['location'];
        $warehouse->manager_id = $validated['manager_id'];
        $warehouse->description = $validated['description'];
        $warehouse->is_active = $validated['status'];
        // Update password only if provided
        $warehouse->save();
        return response()->json(['message' => 'Warehouse updated successfully'], 200);
    }


}
