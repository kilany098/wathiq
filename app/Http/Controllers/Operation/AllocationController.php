<?php

namespace App\Http\Controllers\Operation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\{ client,
   contract,
   User,
   visit_schedule,
   branch
};

class AllocationController extends Controller
{
  
public function index($id){
    $contract = Contract::findOrFail($id);
    $branches=$contract->client->branches;
    $months = $this->getContractMonths($contract->start_date, $contract->end_date);
    return view('operation.allocation',compact('contract','branches','months'));
}


public function store(Request $request)
{
    $validated = $request->validate([
        'contract_id' => 'required|exists:contracts,id',
        'schedules' => 'required|array',
        'schedules.*' => 'required|array',
        'schedules.*.visit_price' => 'required|numeric|min:0',
        'schedules.*.hours_per_visit' => 'required|numeric|min:0',
    ]);

    DB::beginTransaction();
    
    try {
        $totalContractValue = 0;
        $totalExpectedHours = 0;
        $totalVisits = 0;
        
        foreach ($request->schedules as $branchId => $scheduleData) {
            $branchTotalVisits = 0;
            $branchTotalValue = 0;
            $branchTotalHours = 0;
            
            foreach ($scheduleData as $key => $value) {
                // Process only month fields (YYYY-MM format)
                if (preg_match('/^\d{4}-\d{2}$/', $key)) {
                    $visitsCount = (int)$value;
                    $monthDate = $key . '-01';
                    $visitPrice = (float)$scheduleData['visit_price'];
                    $hoursPerVisit = (float)$scheduleData['hours_per_visit'];
                    
                    // Save to visit_schedule table
                    visit_schedule::updateOrCreate(
                        [
                            'branch_id' => $branchId,
                            'month' => $monthDate,
                            'contract_id' => $validated['contract_id'],
                        ],
                        [
                            'visits_count' => $visitsCount,
                            'visit_price' => $visitPrice,
                            'expected_hours' => $hoursPerVisit,
                        ]
                    );
                    
                    $branchTotalVisits += $visitsCount;
                    $branchTotalValue += $visitsCount * $visitPrice;
                    $branchTotalHours += $visitsCount * $hoursPerVisit;
                }
            }
            
            $totalVisits += $branchTotalVisits;
            $totalContractValue += $branchTotalValue;
            $totalExpectedHours += $branchTotalHours;
        }

        // Update contract with totals
        Contract::find($validated['contract_id'])->update([
            'status' => 'active',
            'total_value' => $totalContractValue,
        ]);

        DB::commit();
        
        return redirect()->route('contract.index')
            ->with('success', 'Visit schedules created successfully!');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Schedule creation failed: " . $e->getMessage());
        
        return back()->with('error', 'Failed to save schedules: ' . $e->getMessage())
                     ->withInput();
    }
}




private function getContractMonths($startDate, $endDate)
{
    $months = [];
    $current = Carbon::parse($startDate)->startOfMonth();
    $end = Carbon::parse($endDate)->startOfMonth();
    
    while ($current <= $end) {
        $months[] = $current->format('Y-m');
        $current->addMonth();
    }
    
    return $months;
}


}
