<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Services\ZipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


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
        try {
            // Validate the uploaded file
            $request->validate([
                'module' => 'required|file|mimes:zip',
            ]);

            $file = $request->file('module');
            $moduleName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // Define the extraction path
            $extractPath = base_path('Modules/');


            if (!$this->zipService->extractZip($file->getPathname(), $extractPath)) {
                Log::error('Failed to extract ZIP file', ['zipPath' => $file->getPathname(), 'extractPath' => $extractPath]);
                return response()->json(['error' => 'Failed to extract module zip file.'], 500);
            }


            $this->createModuleFiles($moduleName);

            return response()->json(['message' => 'Module installed successfully.'], 200);

        } catch (\Exception $e) {

            Log::error('An unexpected error occurred during module upload.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }

    }

    /**
     * Create the module files if the structure is correct.
     */
    protected function createModuleFiles($moduleName)
    {
        try {
            $modulePath = base_path('Modules/' . $moduleName);


            if (!File::exists($modulePath . '/Controllers') || !File::exists($modulePath . '/Routes')) {
                Log::error('Invalid module structure for ' . $moduleName);
                return response()->json(['error' => 'Module structure is invalid.'], 500);
            }


            Module::create([
                'name' => $moduleName,
                'active' => true,
            ]);

        } catch (\Exception $e) {

            Log::error('An error occurred while creating module files.', [
                'moduleName' => $moduleName,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }


    }
}
