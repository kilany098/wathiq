<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\DataTables\clientDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    client,
};

class ClientController extends Controller
{
    public function index(clientDataTable $datatable)
    {
        return $datatable->render('user.client');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:15|starts_with:05,5,+9665,009665,9665',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required',
            'address' => 'required|string|max:255',
            'tax_number' => 'required_if:type,company|nullable|string|max:50',
            'type' => 'required|in:individual,company',
            'commercial_number'=>'required_if:type,company|nullable|string|regex:/^[0-9]{10}$/',
            'commercial_register'=>'required|file|mimes:pdf,jpg,png|max:5120',
            'personal_id'=>'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        if($request->hasFile('commercial_register')){
                $path = Storage::disk('public')->putFile('registration_files' , $request->file('commercial_register'));
                $validated['commercial_register'] = $path;
                
            }else{
                $validated['commercial_register'] = null; 
            }

           if($request->hasFile('personal_id')){
                $path = Storage::disk('public')->putFile('personal_id' , $request->file('personal_id'));
                $validated['personal_id'] = $path;
                
            }else{
                $validated['personal_id'] = null; 
            }


        // Create new user
        $client = client::create($validated);
        // Return response
        return response()->json(['message' => 'Client created successfully', 'data' => $client], 201);
    }

    public function edit($id)
    {
        $client = client::find($id);
        return response()->json(['client' => $client], 201);
    }


    public function update(Request $request, $id)
    {
        // Find user by ID
        $client = client::findOrFail($id);
        // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:15|starts_with:05,5,+9665,009665,9665',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required|string|max:255',
            'tax_number' => 'required_if:type,company|nullable|string|max:50',
            'type' => 'required|in:individual,company',
            'commercial_number'=>'required_if:type,company|nullable|string|regex:/^[0-9]{10}$/',
            'commercial_register'=>'nullable|file|mimes:pdf,jpg,png|max:5120',
            'personal_id'=>'nullable|file|mimes:pdf,jpg,png|max:5120',
            'status'=>'required',
        ]);

            if($request->hasFile('commercial_register')){
                if($client->commercial_register){
                    Storage::disk('public')->delete($client->commercial_register);
                }

                $path = Storage::disk('public')->putFile('registration_files' , $request->file('commercial_register'));
                $validated['commercial_register'] = $path;
            }else{
                $validated['commercial_register'] = $client->commercial_register;
            }

            if($request->hasFile('personal_id')){
                if($client->personal_id){
                    Storage::disk('public')->delete($client->personal_id);
                }

                $path = Storage::disk('public')->putFile('personal_id' , $request->file('personal_id'));
                $validated['personal_id'] = $path;
            }else{
                $validated['personal_id'] = $client->personal_id;
            }


        // Update user attributes
        $client->update($validated);
        return response()->json(['message' => 'Client updated successfully'], 200);
    }

    public function delete($id)
    {
        $client = client::find($id);
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully'], 200);
    }
}
