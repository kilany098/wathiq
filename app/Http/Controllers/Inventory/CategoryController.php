<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\categoryDataTable;
use App\Models\{category
    
};

class CategoryController extends Controller
{
     public function index(categoryDataTable $datatable)
    {
        return $datatable->render('inventory.category');
    }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Create new user
        $category = category::create([
            'name' => $validated['name'],
            'description'=> $validated['description'],
        ]);
        // Return response
        return response()->json(['message' => 'Category created successfully', 'data' => $category], 201);
    }
    public function edit($id)
    {
        $category = category::find($id);
        return response()->json(['category' => $category], 201);
    }

    public function update(Request $request, $id)
    {
        // Find user by ID
        $category = category::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Update user attributes
        $category->name = $validated['name'];
        $category->description = $validated['description'];
        // Update password only if provided
        $category->save();
        return response()->json(['message' => 'Category updated successfully'], 200);
    }

public function delete($id)
    {
        $category = category::find($id);
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully',], 200);
    }

}
