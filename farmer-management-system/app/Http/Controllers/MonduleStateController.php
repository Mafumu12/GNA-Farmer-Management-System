<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class MonduleStateController extends Controller
{
    /**
     * Toggle the activation status of a module.
     */
    public function toggleActivation($moduleName)
    {
        try {
            $module = Module::where('name', $moduleName)->first();

            if (!$module) {
                return response()->json(['error' => 'Module not found'], 404);
            }

            $module->is_active = !$module->is_active; // Toggle the status
            $module->save();

            return response()->json([
                'message' => $module->is_active ? 'Module activated' : 'Module deactivated',
            ]);
        } catch (\Exception $e) {
            Log::error('Error toggling module activation: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to toggle module activation'], 500);
        }
    }

    /**
     * Get all modules with their statuses.
     */
    public function getModules(Request $request)
    {
        try {
            $modules = Module::all();

            if ($request->wantsJson()) {
                return response()->json($modules);
            }

            return Inertia::render('FarmerManagementSystem/Modules/ModuleManagement', [
                'modules' => $modules,
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching modules: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch modules'], 500);
        }
    }

    /**
     * Delete a module by its name.
     */
    public function deleteModule($moduleName, Request $request)
    {
        try {
            $module = Module::where('name', $moduleName)->first();

            if (!$module) {
                return response()->json(['error' => 'Module not found'], 404);
            }

            $modulePath = base_path('Modules/' . $moduleName);

            // Delete module files
            if (File::exists($modulePath)) {
                if (!File::deleteDirectory($modulePath)) {
                    Log::error("Failed to delete module files for: $moduleName");
                    return response()->json(['error' => 'Failed to delete module files'], 500);
                }
            } else {
                return response()->json(['error' => 'Module files not found'], 404);
            }

            // Optionally clean related database tables
            if ($request->input('clean_db', false)) {
                try {
                    // Implement logic to clean related tables, if needed
                    // Example: DB::table('some_related_table')->where('module_id', $module->id)->delete();
                } catch (\Exception $e) {
                    Log::error("Error cleaning related tables for module: $moduleName - " . $e->getMessage());
                    return response()->json(['error' => 'Failed to clean related database entries'], 500);
                }
            }

            // Remove the module from the database
            $module->delete();

            return response()->json(['message' => 'Module deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting module: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete module'], 500);
        }
    }
}
