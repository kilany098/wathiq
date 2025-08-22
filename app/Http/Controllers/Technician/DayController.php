<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\dailyDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    work_order,
    tech_item,
    report,
    used_item
};

class DayController extends Controller
{
    public function index(dailyDataTable $datatable)
    {
        $currentDate = now()->toDateString(); // Gets today's date in YYYY-MM-DD format
        $userId = Auth::id();

        return $datatable->forUser($userId, $currentDate)
            ->render('technical.daily',);
    }

    public function details($id)
    {
        $order = work_order::find($id);
        $items = tech_item::where('user_id', Auth::id())->get();
        return view('technical.details', compact('order', 'items'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'date' => 'required|date',
                'order_id' => 'required|exists:work_orders,id',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:500',
                'infestation' => 'required|string|max:255',
                'intensity' => 'required|in:Low,Medium,High',
                'sprayed_places' => 'required|string',
                'signature' => 'required|string',
                'evaluation' => 'required|in:Weak,Good,Excellent',
                'remarks' => 'required|string',
                'item_id' => 'required|exists:items,id',
                'dilution' => 'required|numeric|min:0.01',
                'item_id_2' => 'nullable|exists:items,id',
                'dilution_2' => 'nullable|numeric|min:0.01',
                'item_id_3' => 'nullable|exists:items,id',
                'dilution_3' => 'nullable|numeric|min:0.01',
            ]);
            $order = work_order::find($validated['order_id']);


            $report = report::create([
                'name' => $validated['name'],
                'address' => $validated['address'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'date' => $validated['date'],
                'infestation' => $validated['infestation'],
                'intensity' => $validated['intensity'],
                'sprayed_places' => $validated['sprayed_places'],
                'order_id' => $validated['order_id'],
                'signature' => $validated['signature'],
                'evaluation' => $validated['evaluation'],
                'remarks' => $validated['remarks'],
            ]);
            $item2 = $validated['item_id_2'];
            $item3 = $validated['item_id_3'];
            $used_item = used_item::create([
                'item_id' => $validated['item_id'],
                'report_id' => $report->id,
                'dilution' => $validated['dilution'],
            ]);
            $order->update([
                'status' => 'done'
            ]);
            if ($item2) {
                $used_item2 = used_item::create([
                    'item_id' => $validated['item_id_2'],
                    'report_id' => $report->id,
                    'dilution' => $validated['dilution_2'],
                ]);
            }
            if ($item3) {
                $used_item3 = used_item::create([
                    'item_id' => $validated['item_id_3'],
                    'report_id' => $report->id,
                    'dilution' => $validated['dilution_3'],
                ]);
            }


            return redirect()->back()
                ->with('success', 'Report submitted successfully! .');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while processing your report: ' . $e->getMessage());
        }
    }
}
