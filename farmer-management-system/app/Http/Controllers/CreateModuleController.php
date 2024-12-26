<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class CreateModuleController extends Controller
{
    public function create(Request $request)
    {
        // Validate the module name
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $moduleName = $request->input('name');

        try {
            // Call the Artisan command to create the module
            Artisan::call('app:make-module', [
                'name' => $moduleName
            ]);

            // Respond with success message
            return response()->json([
                'message' => "Module '{$moduleName}' created successfully!",
            ]);
        } catch (\Exception $e) {
            Log::error("Error creating module: {$moduleName}", ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'An error occurred while creating the module.',
            ], 500);
        }
    }
}
