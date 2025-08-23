<?php

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(){
        return view('financial.chart');
    }

    public function invoice(){
        return view('financial.invoices');
    }

    public function journal(){
        return view('financial.dashboard');
    }

    public function reports(){
        return view('financial.reports');
    }

}
