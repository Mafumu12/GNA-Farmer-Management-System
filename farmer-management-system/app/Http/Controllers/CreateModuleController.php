<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Exception; // Add this to catch general exceptions

class CreateModuleController extends Controller
{
    public function create(Request $request)
    {
        // Validate the module name
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $moduleName = $request->input('name');

        Log::info('modulename', ['module controller' => $moduleName]);
         
        try {
            // Call the Artisan command to create the module
            Log::info('Running in environment', ['env' => env('APP_ENV')]);

            Artisan::call('app:make-module' , ['name' => $moduleName]);

            // Log the output of the Artisan command
            Log::info('Artisan command output', ['output' => Artisan::output()]);

            // Respond with success message
            return response()->json([
                'message' => "Module '{$moduleName}' created successfully!",
            ]);

        } catch (Exception $e) {
            // Log the exception details
            Log::error('Error occurred while creating module', [
                'error_message' => $e->getMessage(),
                'module_name' => $moduleName,
                'stack_trace' => $e->getTraceAsString(),
            ]);

            // Respond with an error message
            return response()->json([
                'message' => 'An error occurred while creating the module. Please try again later.',
                'error' => $e->getMessage(),
            ], 500); // Send a 500 server error response
        }
    }
}
