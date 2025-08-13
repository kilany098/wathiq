<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\DataTables\BranchDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    city,
    zone,
    client,
    branch
};

class BranchController extends Controller
{
    public function index(BranchDataTable $datatable,$id)
    {
        $client=client::find($id);
        $cities=city::all();
        $zones=zone::all();
        return $datatable->forClient($id)->render('user.branch',compact('cities','zones','client'));
    }

 public function getZones(Request $request){
    return zone::where('city_id', $request->city_id)
        ->get(['id', 'name']);
 }

 public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'=>'required',
            'manager_name' => 'required|string|max:255',
            'manager_phone' => 'required|string|max:15|starts_with:05,5,+9665,009665,9665',
            'city_id' => 'required|exists:cities,id',
            'zone_id' => 'required',
            'map_link' => 'required|url|max:255',
        ]);
        // Create new user
        $branch = branch::create($validated);
        // Return response
        return response()->json(['message' => 'Branch created successfully', 'data' => $branch], 201);
    }

}
