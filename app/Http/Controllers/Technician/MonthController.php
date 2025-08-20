<?php

namespace App\Http\Controllers\Technician;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\monthlyDataTable;
use Illuminate\Support\Facades\Auth;

class MonthController extends Controller
{
    public function index(monthlyDataTable $datatable)
    {
       
        $currentMonth = now()->month;
    $userId = Auth::id();
    
    return $datatable->forUser($userId, $currentMonth)
                    ->render('technical.monthly');
    }
}
