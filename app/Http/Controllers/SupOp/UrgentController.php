<?php

namespace App\Http\Controllers\SupOp;

use App\Http\Controllers\Controller;
use App\DataTables\urgent_orderDataTable;
use Illuminate\Http\Request;
use App\Models\{
    client,
    visit_schedule,
    work_order
};

class UrgentController extends Controller
{
     public function index(urgent_orderDataTable $datatable){

    return $datatable->forStatus('urgent')->render('sup_op.urgent');
   }

   /*
 public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required',
            'branch_id' => 'required',
            'visit_price'=> 'required|numeric|min:0',
            'expected_hours' => 'required|numeric|min:0',
            'month'
            
            'title' => 'required|string|max:255',
            'description' => 'required|in:custom,low,medium,high,urgent',
            'start_date' => 'nullable|date|after_or_equal:today',
            'end_date' => 'nullable|date|after:due_date',
            'assigned_id'
            'completion_notes' => 'nullable|string|max:255',
        ]);

$schedule=visit_schedule::create([
    'contract_id'=>$validated['contract_id'],
    'branch_id'=>$validated['branch_id'],
    'visit_price'=>$validated['visit_price'],
    'expected_hours'=>$validated['expected_hours'],
    'month'=>$validated['month'],
    'visits_count'=>0,
]);

$order=work_order::create([
  'schedule_id'=>$schedule->id,
  'title'=>  
  'description'=>
  'priority'=>'urgent',
  'start_date'=>
  'end_date'=>
  'assigned_id'=>
  'completion_notes'=>
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

    public function getWorker($id){
 $workers=User::whereHas('workers',function($q)use($id){
    $q->where('order_id',$id);
 });

        return response()->json(['workers' => $workers], 201);  
    }
*/
}
