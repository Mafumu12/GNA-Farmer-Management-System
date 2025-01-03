<?php

namespace App\Http\Controllers;

 

use Inertia\Inertia;
use App\Models\Farmer;
use Modules\LoanManagement\Models\Loan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FarmersController extends Controller
{
    public function index(Request $request)
{
    try {
        // Fetch all farmers
        $farmers = Farmer::all();
        $moduleExists = class_exists(Loan::class);

        // Check if the Loan class exists before trying to use it
       


        if($moduleExists) {
            $loans = Loan::with('farmer')->get();
        }else
        {
            $loans = [];
        }

        // Handle JSON API requests
        if ($request->wantsJson()) {
            return response()->json([
                'farmers' => $farmers,
                'loans' => $loans,
                'moduleExists'=>$moduleExists
            ]);
        }

        // Render Inertia view with the fetched data
        return Inertia::render('FarmerManagementSystem/Dashboard/Overview', [
            'farmers' => $farmers,
            'loans' => $loans,
        ]);
    } catch (\Exception $e) {
        // Log the error for debugging purposes
        Log::error("Error fetching farmers or loans: " . $e->getMessage());

        // Handle the exception gracefully
        return Inertia::render('FarmerManagementSystem/Dashboard/Overview', [
            'farmers' => $farmers, // Ensure farmers are still displayed
            'loans' => [],         // Default to an empty array for loans
        ])->with(['error' => 'An error occurred while fetching data.']);
    }
}

    


    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'location' => 'required|string|max:255',
            ]);
    
            $farmer = Farmer::create($validated);
    
            // Return a response with a success message and the farmer data
            return response()->json([
                'message' => 'Farmer registered successfully', 
                'farmer' => $farmer
            ], 201);  // Successful creation
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred while storing the farmer.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred while storing the farmer.'], 500);
        }
    }
    

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'first_name' => 'sometimes|required|string|max:255',
                'last_name' => 'sometimes|required|string|max:255',
                'phone_number' => 'sometimes|required|string|max:15',
                'location' => 'sometimes|required|string|max:255',
            ]);

            // Find the farmer or throw an error if not found
            $farmer = Farmer::findOrFail($id);
            $farmer->update($validated);

            return response()->json($farmer);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Farmer not found.'], 404);   
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred while updating the farmer.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred while updating the farmer.'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Find the farmer or throw an error if not found
            $farmer = Farmer::findOrFail($id);
            $farmer->delete();

            return response()->json(['message' => 'Farmer deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Farmer not found.'], 404);  
        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error occurred while deleting the farmer.'], 500);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An unexpected error occurred while deleting the farmer.'], 500);
        }
    }
}
