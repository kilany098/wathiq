<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    report
};

class DashboardController extends Controller
{
    public function index()
    {
        $completed=count(report::all());
        return view('dashboard',compact('completed'));
    }
}
