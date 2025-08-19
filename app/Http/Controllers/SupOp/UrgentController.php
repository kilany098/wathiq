<?php

namespace App\Http\Controllers\SupOp;

use App\Http\Controllers\Controller;
use App\DataTables\urgent_orderDataTable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\{
    contract,
    branch,
    client,
    User,
    visit_schedule,
    work_order
};

class UrgentController extends Controller
{
     public function index(urgent_orderDataTable $datatable){
    $technicians = User::whereHasRole('technician')->get();
    $clients=client::where('status',1)->get();
    return $datatable->forPriority('urgent')->render('sup_op.urgent',compact('clients','technicians'));
   }


public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'client_id'=> 'required',
            'contract_id' => 'required',
            'branch_id' => 'required',
            'visit_price'=> 'required|numeric|min:0',
            'expected_hours' => 'required|numeric|min:0',
            'month'=> 'required|numeric|min:1|max:12',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|after_or_equal:today',
            'end_date' => 'required|after:start_date',
            'assigned_id' =>'required',
            'completion_notes' => 'nullable|string|max:255',
        ]);
$validated['start_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->start_date);
$validated['end_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->end_date);
        
$currentYear = now()->year;
 $monthDate = Carbon::create($currentYear, $validated['month'], 1)->format('Y-m-d');


        $schedule = visit_schedule::create([
            'contract_id' => $validated['contract_id'],
            'branch_id' => $validated['branch_id'],
            'visit_price' => $validated['visit_price'],
            'expected_hours' => $validated['expected_hours'],
            'month' => $monthDate,
            'visits_count' => 0,
        ]);

        $lastOrder = work_order::orderBy('id', 'desc')->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
        $validated['order_number'] = 'Order-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        $order = work_order::create([
            'order_number' => $validated['order_number'],
            'schedule_id' => $schedule->id,
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => 'urgent',
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'assigned_id' => $validated['assigned_id'],
            'completion_notes' => $validated['completion_notes'],
        ]);

        return response()->json(['message' => 'Urgent order created successfully', 'data' => $order], 201);

    } catch (\Exception $e) {
        \Log::error('Error creating urgent order: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while creating the urgent order. Please try again.'. $e->getMessage()], 500);
    }
}

 public function edit($id)
    {
        $work_order = work_order::find($id);
        return response()->json(['work_order' => $work_order], 201);
    }

    public function getWorker($id){
 $workers=User::whereHas('workers',function($q)use($id){
    $q->where('order_id',$id);
 });

        return response()->json(['workers' => $workers], 201);  
    }


public function getContract(Request $request){
    return contract::where('client_id', $request->client_id)
    ->where('status','active')
        ->get(['id', 'contract_number']);
 }


public function getBranch(Request $request){
    return branch::where('client_id', $request->client_id)
    ->where('status',1)
        ->get(['id', 'name']);
 }

}
