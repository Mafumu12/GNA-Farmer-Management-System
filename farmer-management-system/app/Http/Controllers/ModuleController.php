<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Services\ZipService;

class ModuleController extends Controller
{
    protected $zipService;

    /**
     * Constructor to inject dependencies.
     */
    public function __construct(ZipService $zipService)
    {
        $this->zipService = $zipService;
    }

    /**
     * Handle module upload and installation.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'module' => 'required|file|mimes:zip',
        ]);

        $file = $request->file('module');
        $moduleName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extractPath = base_path('Modules/' . $moduleName);

        // Use the ZipService to extract the ZIP file
        if (!$this->zipService->extractZip($file->getPathname(), $extractPath)) {
            return response()->json(['error' => 'Failed to extract module zip file.'], 500);
        }

        // Check if the module was extracted correctly
        if (!file_exists($extractPath . '/module.json')) {
            return response()->json(['error' => 'Invalid module structure.'], 400);
        }

        // Install the module
        Artisan::call('module:install', ['name' => $moduleName]);

        return response()->json(['message' => 'Module installed successfully.'], 200);
    }
}
