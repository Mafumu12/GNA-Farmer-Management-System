<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MonduleStateController extends Controller
{
    public function toggleActivation($moduleName)
    {
        $module = Module::where('name', $moduleName)->first();

        if ($module) {
            $module->is_active = !$module->is_active; // Toggle the status
            $module->save();
            return response()->json(['message' => $module->is_active ? 'Module activated' : 'Module deactivated']);
        }

        return response()->json(['error' => 'Module not found'], 404);
    }

    /**
     * Get all modules with their statuses.
     */
    public function getModules(Request $request)
    {
        if ($request->wantsJson()) {
            // Return JSON if the request is an API call
            return response()->json(Module::all());
        }

        // Return the Inertia view for web navigation
        return Inertia::render('FarmerManagementSystem/Modules/ModuleManagement', [
            'modules' => Module::all(),
        ]);
    }



    public function deleteModule($moduleName, Request $request)
    {
        $module = Module::where('name', $moduleName)->first();

        if (!$module) {
            return response()->json(['error' => 'Module not found'], 404);
        }

        $modulePath = base_path('Modules/' . $moduleName);

        // Delete module files
        if (File::exists($modulePath)) {
            File::deleteDirectory($modulePath);
        } else {
            return response()->json(['error' => 'Module files not found'], 404);
        }

        // Optionally clean related database tables
        if ($request->input('clean_db', false)) {
            // Implement logic to clean related tables, if needed
            // Example: DB::table('some_related_table')->where('module_id', $module->id)->delete();
        }

        // Remove the module from the database
        $module->delete();

        return response()->json(['message' => 'Module deleted successfully']);
    }


}
