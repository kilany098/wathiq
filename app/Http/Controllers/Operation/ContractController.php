<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\contractDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\{ client,
   contract,
   User
};
class ContractController extends Controller
{
    public function index(contractDataTable $datatable){
        $clients=client::where('status',1)->get();
        $operators = User::whereHasRole('operation')->get();
         return $datatable->render('operation.contract',compact('clients','operators'));
    }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required',
            'type'=>'required|in:Pest Control,Agricultural,Industrial,Other',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'visits'=>'required|numeric|min:1',
            'expected_hours'=>'required|numeric|min:1',
            'payment_terms' => 'required|in:monthly,quarterly,annual,custom',
            'terms_and_conditions' => 'nullable|string|max:255',
            'note'=>'nullable|string|max:255',
            'operated_by'=>'required',
        ]);
        $lastContract = contract::orderBy('id', 'desc')->first();
        $nextId = $lastContract ? $lastContract->id + 1 : 1;
        $validated['contract_number'] = 'Wathiq-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Create new user
        $contract = contract::create([
            'client_id' => $validated['client_id'],
            'contract_number'=> $validated['contract_number'],
            'visits' => $validated['visits'],
            'expected_hours' => $validated['expected_hours'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'payment_terms' => $validated['payment_terms'],
            'terms_and_conditions' => $validated['terms_and_conditions'],
            'note' => $validated['note'],
            'created_by'=>Auth::user()->id,
            'operated_by'=>$validated['operated_by'],
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
            'type'=>'required|in:Pest Control,Agricultural,Industrial,Other',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'visits'=>'required|numeric|min:1',
            'expected_hours'=>'required|numeric|min:1',
            'payment_terms' => 'required|in:monthly,quarterly,annual,custom',
            'terms_and_conditions' => 'required|string|max:255',
            'note'=>'nullable|string|max:255',
            'operated_by'=>'required',
        ]);

        $validated['status']='new';
        $contract->update($validated);
        
        return response()->json(['message' => 'Contract updated successfully'], 200);
    }

 public function showPdf($id)
    {
        $contract = contract::with(['client', 'operator'])->findOrFail($id);
        
        // Format dates
        $startDate = Carbon::parse($contract->start_date)->format('F j, Y');
        $endDate = Carbon::parse($contract->end_date)->format('F j, Y');
        
        // Format currency
        $totalValue = number_format($contract->total_value, 2);
        
        // Prepare data for PDF
        $data = [
            'contract' => $contract,
            'client' => $contract->client,
            'operator' => $contract->operator,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'totalValue' => $totalValue,
            'today' => now()->format('F j, Y'),
        ];
        
        // Generate PDF
        $pdf = PDF::loadView('contracts.pdf', $data);
        
        // Return for viewing in browser
        return $pdf->stream('contract-'.$contract->id.'.pdf');
        
        // Alternative: Force download
        // return $pdf->download('contract-'.$contract->id.'.pdf');
    }

 public function download($id)
    {
        // Get the contract with relationships
        $contract = contract::with(['client', 'operator'])
                    ->findOrFail($id);

        // Format data for PDF
        $data = [
            'contract' => $contract,
            'client' => $contract->client,
            'operator' => $contract->operator,
            'startDate' => Carbon::parse($contract->start_date)->format('F j, Y'),
            'endDate' => Carbon::parse($contract->end_date)->format('F j, Y'),
            'totalValue' => number_format($contract->total_value, 2),
            'today' => now()->format('F j, Y'),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('contracts.template', $data);

        // Custom filename
        $filename = 'Contract-' . $contract->id . '-' . strtoupper($contract->client->name) . '.pdf';

        // Download with custom headers
        return $pdf->download($filename, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ]);

    }




}
