<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\dailyDataTable;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    work_order
};

class DayController extends Controller
{
    public function index(dailyDataTable $datatable)
    {
        $currentDate = now()->toDateString(); // Gets today's date in YYYY-MM-DD format
        $userId = Auth::id();
        
        return $datatable->forUser($userId, $currentDate)
                        ->render('technical.daily');
    }

public function details($id){
    $order=work_order::find($id);
    return view('technical.details',compact('order'));
}

}
