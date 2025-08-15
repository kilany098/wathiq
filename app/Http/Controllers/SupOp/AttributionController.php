<?php

namespace App\Http\Controllers\SupOp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\visit_scheduleDataTable;

class AttributionController extends Controller
{
    public function index(visit_scheduleDataTable $datatable){
    return $datatable->render('Sup_Op.attribution');
    }
}
