<?php

namespace App\Services;

use Nwidart\Modules\Facades\Module;
 
use Illuminate\Support\Facades\Log;
use Exception;

class ModuleService
{
    /**
     * Get a list of new modules in the Modules directory.
     *
     * @return array
     */
    public function getNewModules()
    {
        try {
            $registeredModules = array_keys(Module::all());
            $moduleDirectories = array_filter(glob(base_path('Modules/*')), 'is_dir');

            $newModules = [];

            foreach ($moduleDirectories as $modulePath) {
                $moduleName = basename($modulePath);
                Log::info('modules array ', ['moduleName' => $moduleName]);
                if (!in_array($moduleName, $registeredModules) && file_exists($modulePath . '/module.json')) {
                    $newModules[] = $moduleName;
                }
            }

            return $newModules;
        } catch (Exception $e) {
            Log::error("Error fetching new modules: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Validate the structure of a module.
     *
     * @param string $moduleName
     * @return bool
     */
    public function validateModuleStructure($moduleName)
    {
        try {
            $modulePath = base_path("Modules/{$moduleName}");
            Log::info('module path', ['modulePath' => $modulePath]);
            $requiredFiles = [
                'module.json',
                'app/Providers',
                'database/migrations',
            ];

            foreach ($requiredFiles as $file) {
                if (!file_exists($modulePath . '/' . $file)) {
                    Log::warning("Missing required file or directory '{$file}' in module '{$moduleName}'.");
                    return false;
                }
            }

            return true;
        } catch (Exception $e) {
            Log::error("Error validating module structure for '{$moduleName}': " . $e->getMessage());
            return false;
        }
    }

    /**
     * Register and install a module.
     *
     * @param string $moduleName
     * @return void
     */

    public function registerAndInstallModule($moduleName)
    {
         
    }


}


 



