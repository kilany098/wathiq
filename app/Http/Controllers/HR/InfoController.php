<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\employee_infoDataTable;

class InfoController extends Controller
{
    public function index(employee_infoDataTable $datatable)
    {

        return $datatable->render('HR.contract');
    }
}
