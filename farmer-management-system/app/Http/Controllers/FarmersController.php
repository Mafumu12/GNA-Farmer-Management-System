<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

use App\Models\Farmer;
use Illuminate\Http\Request;

class FarmersController extends Controller
{
    public function index(Request $request)
    {

        if ($request->wantsJson()) {
            // Return JSON if the request is an API call
            return response()->json(Farmer::all());
        }

        
        return Inertia::render('FarmerManagementSystem/Dashboard/Overview', ['farmers' => Farmer::all()],);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'location' => 'required|string|max:255',
        ]);

        $farmer = Farmer::create($validated);
        return response()->json($farmer, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:15',
            'location' => 'sometimes|required|string|max:255',
        ]);

        $farmer = Farmer::findOrFail($id);
        $farmer->update($validated);
        return response()->json($farmer);
    }

    public function destroy($id)
    {
        $farmer = Farmer::findOrFail($id);
        $farmer->delete();
        return response()->json(['message' => 'Farmer deleted successfully']);
    }
}
