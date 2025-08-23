<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\employee_infoDataTable;
use App\Models\{
    User,
    employee_info
};

class InfoController extends Controller
{
    public function index(employee_infoDataTable $datatable)
    {
        $users=User::all();
        return $datatable->render('HR.contract',compact('users'));
    }

    public function store(Request $request){
        $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'hire_date' => 'required|date',
        'salary' => 'required|numeric|min:0',
        'emergency_contact' => 'required|string|max:255',
        'emergency_phone' => 'required|string|max:255',
        'notes' => 'required|string',
        ]);

        $lastEmployee = employee_info::orderBy('id', 'desc')->first();
        $nextId = $lastEmployee ? $lastEmployee->id + 1 : 1;
        $validated['employee_number'] = 'employee-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

 $employee = employee_info::updateOrCreate(
                [
                    'user_id' => $validated['user_id'] // Attributes to search by
                ],
                [
                    'employee_number' => $validated['employee_number'],
                    'hire_date' => $validated['hire_date'],
                    'salary' => $validated['salary'],
                    'emergency_contact'=> $validated['emergency_contact'],
                    'emergency_phone' => $validated['emergency_phone'],        
                    'notes' => $validated['notes'],
                ]
            );
        // Return response
        return response()->json(['message' => 'Contract created successfully', 'data' => $employee], 201);
    }

 public function edit($id)
    {
        $employee = employee_info::find($id);
        return response()->json(['employee' => $employee], 201);
    }

     public function update(Request $request, $id)
    {
        // Find user by ID
        $employee = employee_info::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'hire_date' => 'required|date',
            'termination_date' => 'nullable|date',
            'salary' => 'required|numeric|min:0',
            'emergency_contact' => 'required|string|max:255',
            'emergency_phone' => 'required|string|max:255',
            'notes'=> 'required|string',
        ]);

        // Update user attributes
        $employee->hire_date = $validated['hire_date'];
        $employee->termination_date = $validated['termination_date'];
        $employee->salary = $validated['salary'];
        $employee->emergency_contact = $validated['emergency_contact'];
        $employee->emergency_phone = $validated['emergency_phone'];
        $employee->notes = $validated['notes'];
        // Update password only if provided
        $employee->save();
        return response()->json(['message' => 'Employee updated successfully'], 200);
    }

}
