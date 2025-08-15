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
    ]);

    DB::beginTransaction();
    
    try {
        $totalContractValue = 0;
        $branchVisitTotals = [];
        
        foreach ($request->schedules as $branchId => $monthsData) {
            // Get the branch to access visit_price
            $branch = branch::findOrFail($branchId);
            $branchTotalVisits = 0;
            
            foreach ($monthsData as $month => $visitsCount) {
                // Skip the branch_id key and validate month format
                if ($month === 'branch_id' || !preg_match('/^\d{4}-\d{2}$/', $month)) {
                    continue;
                }

                $visitsCount = (int)$visitsCount;
                $monthDate = $month . '-01';
                
                // Save the visit schedule
                visit_schedule::updateOrCreate(
                    [
                        'branch_id' => $branchId,
                        'month' => $monthDate,
                        'contract_id' => $validated['contract_id'],
                    ],
                    [
                        'visits_count' => $visitsCount,
                    ]
                );
                
                // Calculate branch total visits
                $branchTotalVisits += $visitsCount;
            }
            
            // Calculate branch total value (visits * price)
            $branchTotalValue = $branchTotalVisits * $branch->visit_price;
            $totalContractValue += $branchTotalValue;
            
            // Store branch totals if needed
            $branchVisitTotals[$branchId] = [
                'visits' => $branchTotalVisits,
                'value' => $branchTotalValue
            ];
        }

        // Update contract with total value and status
        Contract::find($validated['contract_id'])->update([
            'status' => 'active',
            'total_value' => $totalContractValue,
            // Add any other fields you want to update
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
