<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\contractDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\{ client,
   contract
};
class ContractController extends Controller
{
    public function index(contractDataTable $datatable){
        $clients=client::all();
         return $datatable->render('operation.contract',compact('clients'));
    }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'contract_number' => 'required|string|max:50|regex:/^[A-Z0-9\-_]+$/i|unique:contracts,contract_number',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'total_value' => 'required|numeric|min:1',
            'payment_terms' => 'required|in:monthly,quarterly,annual,custom',
            'terms_and_conditions' => 'required|string|max:255',
        ]);


        // Create new user
        $contract = contract::create([
            'client_id' => $validated['client_id'],
            'contract_number'=> $validated['contract_number'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_value' => $validated['total_value'],
            'payment_terms' => $validated['payment_terms'],
            'terms_and_conditions' => $validated['terms_and_conditions'],
            'created_by'=>Auth::user()->id,

        ]);
        // Return response
        return response()->json(['message' => 'Contract created successfully', 'data' => $contract], 201);
    }
    public function edit($id)
    {
        $contract = contract::find($id);
        return response()->json(['contract' => $contract], 201);
    }

 public function update(Request $request, $id)
    {
        // Find user by ID
        $contract = contract::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'client_id' => 'required',
            'contract_number' => 'required|string|max:50|regex:/^[A-Z0-9\-_]+$/i',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'total_value' => 'required|numeric|min:1',
            'payment_terms' => 'required|in:monthly,quarterly,annual,custom',
            'terms_and_conditions' => 'required|string|max:255',
            'status'=>'required|in:draft,active,expired,terminated',
        ]);

        
        $contract->update($validated);
        
        return response()->json(['message' => 'Contract updated successfully'], 200);
    }

}
