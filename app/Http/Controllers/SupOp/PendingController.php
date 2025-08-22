<?php

namespace App\Http\Controllers\SupOp;

use App\Http\Controllers\Controller;
use App\DataTables\pending_orderDataTable;
use Illuminate\Http\Request;
use App\Models\{
    work_order,
};

class PendingController extends Controller
{

    public function index(pending_orderDataTable $datatable)
    {
        return $datatable->forStatus('done')->render('sup_op.pending');
    }

    public function accept($id)
    {
        $order = work_order::findOrFail($id);

        $order->update([
            'status' => 'approved'
        ]);

        return redirect()->back()
            ->with('success', 'Order approved successfully.');
    }
    public function decline($id)
    {
        $order = work_order::findOrFail($id);

        $order->update([
            'status' => 'assigned'
        ]);

        return redirect()->back()
            ->with('success', 'Order declined successfully.');
    }
}
