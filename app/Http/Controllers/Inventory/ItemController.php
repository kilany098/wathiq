<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\itemDataTable;
use App\Models\{category,
items    
};

class ItemController extends Controller
{
    public function index(itemDataTable $datatable)
    {
        $categories=category::all();
        return $datatable->render('inventory.item',compact('categories'));
    }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
            'quantity'=>'required|numeric|min:1',
        ]);

        // Create new user
        $item = items::create([
            'code'=> $validated['code'],
            'name' => $validated['name'],
            'description'=> $validated['description'],
            'category_id'=> $validated['category_id'],
            'quantity'=>$validated['quantity'],
        ]);
        // Return response
        return response()->json(['message' => 'Item created successfully', 'data' => $item], 201);
    }
    public function edit($id)
    {
        $item = items::find($id);
        return response()->json(['item' => $item], 201);
    }

    public function update(Request $request, $id)
    {
        // Find user by ID
        $item = items::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required',
            'quantity'=>'required|numeric|min:1',
        ]);

        // Update user attributes
        $item->code = $validated['code'];
        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->category_id = $validated['category_id'];
        $item->quantity = $validated['quantity'];
        // Update password only if provided
        $item->save();
        return response()->json(['message' => 'Item updated successfully'], 200);
    }

public function delete($id)
    {
        $item = items::find($id);
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully',], 200);
    }
}
