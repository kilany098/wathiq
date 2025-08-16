<?php

namespace App\Http\Controllers\SupOp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\work_orderDataTable;
use Carbon\Carbon;
use App\Models\{
    visit_schedule,
    User,
    work_order
};

class AssignController extends Controller
{
    public function index(work_orderDataTable $datatable,$id){
        $schedule=visit_schedule::find($id);
        $technicians = User::whereHasRole('technician')->get();
        $month = \Carbon\Carbon::parse($schedule->month);
        
        return $datatable->forSchedule($id)->render('Sup_Op.assign',compact('schedule','technicians','month'));
    }

public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id'=>'required',
            'title' => 'required|string|max:255',
            'description'=> 'required|string|max:255',
            'start_date' => 'required|after_or_equal:today',
            'end_date' => 'required|after:start_date',
            'assigned_id'=>'required',
        ]);
$validated['start_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->start_date);
$validated['end_date'] = Carbon::createFromFormat('Y-m-d\TH:i', $request->end_date);
 // Check for employee scheduling conflict
    $employeeConflict = work_order::where('assigned_id', $validated['assigned_id'])
        ->where(function($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhere(function($q) use ($validated) {
                      $q->where('start_date', '<=', $validated['start_date'])
                        ->where('end_date', '>=', $validated['end_date']);
                  });
        })
        ->exists();

    if ($employeeConflict) {
        return response()->json([
            'message' => 'The selected employee already has another work order during this time period'
        ], 422);
    }

    // Check for schedule conflict
    $scheduleConflict = work_order::where('schedule_id', $validated['schedule_id'])
        ->where(function($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                  ->orWhere(function($q) use ($validated) {
                      $q->where('start_date', '<=', $validated['start_date'])
                        ->where('end_date', '>=', $validated['end_date']);
                  });
        })
        ->exists();

    if ($scheduleConflict) {
        return response()->json([
            'message' => 'The selected schedule already has another work order during this time period'
        ], 422);
    }

$sch=visit_schedule::find($validated['schedule_id']);
$sch->update([
'visits_count'=>$sch->visits_count-1,
]);
$count=$sch->vists_count;
        $lastOrder = work_order::orderBy('id', 'desc')->first();
        $nextId = $lastOrder ? $lastOrder->id + 1 : 1;
        $validated['order_number'] = 'Order-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Create new user
        $order = work_order::create([
            'schedule_id' => $validated['schedule_id'],
            'order_number'=> $validated['order_number'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'assigned_id' => $validated['assigned_id'],
        ]);
        // Return response
        return response()->json(['message' => 'Work order created successfully', 'count' => $count], 201);
    }



}
