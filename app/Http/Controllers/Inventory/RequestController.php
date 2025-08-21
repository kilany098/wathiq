<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\requestDataTable;
use App\Models\{
    request as requestModel,  
    transaction,
    stock,
    tech_item
};


class RequestController extends Controller
{
 public function index(requestDataTable $datatable)
    {
        return $datatable->forStatus('pending')->render('inventory.request');
    }

public function accept($id)
    {
        $request = requestModel::findOrFail($id);
        $stock = stock::where('item_id', $request->item_id)
                    ->where('warehouse_id', $request->warehouse_id)
                    ->first(); 

        // Check if stock record exists
        if (!$stock) {
            return redirect()->back()
                ->with('error', 'No stock record found for this item and warehouse combination.')
                ->withErrors(['quantity' => 'No stock record found for this item and warehouse combination.']);
        }

        // Check if sufficient stock is available
        if ($request->quantity > $stock->quantity) {
            return redirect()->back()
                ->with('error', 'Insufficient stock.')
                ->withErrors(['quantity' => "Insufficient stock. Available quantity: {$stock->quantity}"])
                ->with('available_quantity', $stock->quantity);
        }

        // Start database transaction to ensure data consistency
        \DB::beginTransaction();
        
        try {
            // Update request status
            $request->update([
                'status' => 'accepted'
            ]);

            // Create transaction record
            transaction::create([
                'item_id' => $request->item_id,
                'warehouse_id' => $request->warehouse_id,
                'transaction_type' => 'out',
                'quantity' => $request->quantity,
                'related_order_id' => $request->related_order_id,
                'created_by' => $request->created_by,
                'notes' => $request->notes,
            ]);

            // Update or create tech item record
            $tech_item = tech_item::where('item_id', $request->item_id)
                                ->where('user_id', $request->created_by)
                                ->first(); 
                                
            if (!$tech_item) {
                tech_item::create([
                    'item_id' => $request->item_id,
                    'user_id' => $request->created_by,
                    'quantity' => $request->quantity,
                ]);
            } else {
                $tech_item->update([
                    'quantity' => $tech_item->quantity + $request->quantity,
                ]);
            }   

            // Update stock quantity
            $stock->update([
                'quantity' => $stock->quantity - $request->quantity,
            ]);

            // Commit the transaction
            \DB::commit();

            return redirect()->back()
                ->with('success', 'Request accepted successfully! Stock and transaction records updated.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            \DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'An error occurred while processing your request: ' . $e->getMessage());
        }
    }

    public function decline($id)
    {
        $request = requestModel::findOrFail($id);
        
        $request->update([
            'status' => 'refused'
        ]);
        
        return redirect()->back()
            ->with('success', 'Request declined successfully.');
    }


}
