<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\transactionDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\{transaction,
    stock,
    items,
    warehouse
};

class TransactionController extends Controller
{
     public function index(transactionDataTable $datatable)
    {
        $warehouses=warehouse::all();
        $items=items::all();
        return $datatable->render('inventory.transaction',compact('items','warehouses'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'item_id' => 'required|exists:items,id',
        'warehouse_id' => 'required|exists:warehouses,id',
        'warehouse_to' => 'required_if:transaction_type,transfer|nullable|exists:warehouses,id',
        'transaction_type' => 'required|in:in,out,transfer,adjustment',
        'quantity' => 'required|numeric|min:1',
        'related_order_id' => 'nullable',
        'notes' => 'nullable|string|max:255',
    ]);

    $validated['created_by'] = Auth::id();

    // Use database transaction for atomicity
    return DB::transaction(function () use ($validated) {
        // Get or create stock record (quantity=0 only if new)
        $stock = Stock::firstOrCreate(
            ['item_id' => $validated['item_id'], 'warehouse_id' => $validated['warehouse_id']],
            ['quantity' => 0]
        );

        // Handle transaction types
        switch ($validated['transaction_type']) {
            case 'in':
                $stock->increment('quantity', $validated['quantity']);
                break;

            case 'out':
                if ($stock->quantity < $validated['quantity']) {
                    return response()->json([
                        'message' => 'Insufficient stock for this transaction',
                        'available_quantity' => $stock->quantity
                    ], 422); // HTTP 422 = Unprocessable Entity
                }
                $stock->decrement('quantity', $validated['quantity']);
                break;

            case 'transfer':
                if ($stock->quantity < $validated['quantity']) {
                    return response()->json([
                        'message' => 'Insufficient stock for transfer',
                        'available_quantity' => $stock->quantity
                    ], 422);
                }

                // Deduct from source warehouse
                $stock->decrement('quantity', $validated['quantity']);

                // Add to destination warehouse
                $destinationStock = Stock::firstOrCreate(
                    ['item_id' => $validated['item_id'], 'warehouse_id' => $validated['warehouse_to']],
                    ['quantity' => 0]
                );
                $destinationStock->increment('quantity', $validated['quantity']);
                break;

            case 'adjustment':
                $stock->update(['quantity' => $validated['quantity']]);
                break;
        }

        // Create the primary transaction record
        $transaction = Transaction::create([
            'item_id' => $validated['item_id'],
            'warehouse_id' => $validated['warehouse_id'],
            'transaction_type' => $validated['transaction_type'],
            'quantity' => $validated['quantity'],
            'related_order_id' => $validated['related_order_id'],
            'created_by' => $validated['created_by'],
            'notes' => $validated['notes'],
        ]);

        // For transfers, create the inbound transaction record
        if ($validated['transaction_type'] === 'transfer') {
            Transaction::create([
                'item_id' => $validated['item_id'],
                'warehouse_id' => $validated['warehouse_to'],
                'transaction_type' => 'in',
                'quantity' => $validated['quantity'],
                'related_order_id' => $validated['related_order_id'],
                'created_by' => $validated['created_by'],
                'notes' => 'Transfer from Warehouse #' . $validated['warehouse_id'],
            ]);
        }

        return response()->json([
            'message' => 'Transaction completed successfully',
            'data' => $transaction
        ], 201); // HTTP 201 = Created
    });
}


}
