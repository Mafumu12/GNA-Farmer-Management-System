<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use App\Models\Module;
use Illuminate\Http\Request;

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
    
}
