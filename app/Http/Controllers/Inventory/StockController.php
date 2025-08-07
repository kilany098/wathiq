<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\StockDataTable;

class StockController extends Controller
{
      public function index(StockDataTable $datatable)
    {
        return $datatable->render('inventory.stock');
    }
}
