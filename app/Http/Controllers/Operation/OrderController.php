<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\work_orderDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\{ client,
   contract,
   User,
   work_order
};

class OrderController extends Controller
{
   public function index(work_orderDataTable $datatable){
        $contracts=contract::all();
        $users = User::whereHasRole('technician')->get();
         return $datatable->render('operation.work_order',compact('contracts','users'));
    }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|max:50|regex:/^[A-Z0-9\-_]+$/i|unique:work_orders,order_number',
            'contract_id' => 'nullable',
            'assigned_to' => 'required',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'priority' => 'required|in:custom,low,medium,high,urgent',
            'due_date' => 'nullable|date|after_or_equal:today',
            'completed_at' => 'nullable|date|after:due_date',
            'completion_notes' => 'nullable|string|max:255',
        ]);


        // Create new user
        $work_order = work_order::create($validated);
        // Return response
        return response()->json(['message' => 'Work order created successfully', 'data' => $work_order], 201);
    }

 public function edit($id)
    {
        $work_order = work_order::find($id);
        return response()->json(['work_order' => $work_order], 201);
    }


}
