<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\tech_itemDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    items,
    work_order,
    stock,
    request as RequestModel,
};
class InventoryController extends Controller
{
      public function index(tech_itemDataTable $datatable)
    {
        $userId = Auth::id();
    $items=items::all();
    $userId = Auth::id();
    $orders=work_order::where('assigned_id', $userId)->get();
    return $datatable->forUser($userId)
                    ->render('technical.myInventory',compact('items','orders'));
    }

public function getWarehouse(Request $request)
{
    return stock::where('item_id', $request->item_id)
        ->with('warehouse:id,name') // Eager load warehouse relationship with only id and name
        ->get()
        ->map(function($stock) {
            return [
                'id' => $stock->warehouse_id,
                'name' => $stock->warehouse->name,
            ];
        });
}

public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'item_id' => 'required',
            'warehouse_id' => 'required',
            'quantity' => 'required|numeric|min:0.01',
            'related_order_id' => 'nullable',
            'notes' => 'nullable|string|max:255',
        ]);  

        $validated['created_by'] = Auth::user()->id;
        
        $stock = stock::where('item_id', $request->item_id)
            ->where('warehouse_id', $request->warehouse_id)
            ->first(); // Corrected line: use first() instead of firstOrFail()

        if (!$stock) {
            return response()->json([
                'success' => false,
                'message' => 'No stock record found for this item and warehouse combination.',
                'errors' => ['quantity' => 'No stock record found for this item and warehouse combination.']
            ], 422);
        }

        if ($validated['quantity'] > $stock->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock.',
                'errors' => ['quantity' => "Insufficient stock. Available quantity: {$stock->quantity}"],
                'available_quantity' => $stock->quantity
            ], 422);
        }

        RequestModel::create([
             'item_id' => $request->item_id,
            'warehouse_id' => $request->warehouse_id,
            'quantity' => $request->quantity,
            'related_order_id' => $request->related_order_id,
            'notes' => $request->notes,
            'created_by' =>Auth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Request created successfully',
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Server error: ' . $e->getMessage()
        ], 500);
    }
}


}
