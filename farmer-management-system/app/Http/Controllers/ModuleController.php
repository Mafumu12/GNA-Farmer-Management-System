<?php

namespace App\Http\Controllers;

use App\Services\ZipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

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
    // Validate the uploaded file
    $request->validate([
        'module' => 'required|file|mimes:zip',
    ]);

    $file = $request->file('module');
    //Log::info('Uploaded file', ['file' => $file]);

    // Extract module name from file
    $moduleName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    //Log::info('Module name', ['$moduleName' => $moduleName]);

    // Define the extraction path
    $extractPath = base_path('Modules');
    //Log::info('Extraction path', ['extractPath' => $extractPath]);

    // Use the ZipService to extract the ZIP file
    if (!$this->zipService->extractZip($file->getPathname(), $extractPath)) {
        Log::error('Failed to extract ZIP file', ['zipPath' => $file->getPathname(), 'extractPath' => $extractPath]);
        return response()->json(['error' => 'Failed to extract module zip file.'], 500);
    }

    // Build the path to the extracted module.json file
    $moduleJsonPath = $extractPath . DIRECTORY_SEPARATOR . $moduleName . DIRECTORY_SEPARATOR . 'module.json';
    //Log::info('module.json path', ['moduleJsonPath' => $moduleJsonPath]);

    // Check if the module.json file exists
    if (!file_exists($moduleJsonPath)) {
        Log::error('Invalid module structure. module.json not found', ['moduleJsonPath' => $moduleJsonPath]);
        return response()->json(['error' => 'Invalid module structure.'], 400);
    }

    // Install the module
    try {
        Artisan::call('modules:install-new', ['name' => $moduleName]);  // Pass the 'name' argument
        //Log::info('Module installed successfully', ['moduleName' => $moduleName]);
    } catch (\Exception $e) {
        Log::error('Failed to install module', ['moduleName' => $moduleName, 'error' => $e->getMessage()]);
        return response()->json(['error' => 'Failed to install module.'], 500);
    }

    return response()->json(['message' => 'Module installed successfully.'], 200);
}

}
