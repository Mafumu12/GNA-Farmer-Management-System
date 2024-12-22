<?php

namespace App\Services;

use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Artisan;
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
    public function validateModuleStructure( $moduleName)
    {
        try {
            $modulePath = base_path("Modules/{$moduleName}");
            $requiredFiles = [
                'module.json',
                'Providers',
                'Database/Migrations',
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
        try {
            $modulePath = base_path("Modules/{$moduleName}");

            if (!file_exists($modulePath . '/module.json')) {
                throw new Exception("module.json file not found in '{$moduleName}' module.");
            }

            // Load module.json
            $moduleConfig = json_decode(file_get_contents($modulePath . '/module.json'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception("Error parsing module.json for '{$moduleName}': " . json_last_error_msg());
            }

            // Register service providers
            foreach ($moduleConfig['providers'] as $provider) {
                if (class_exists($provider)) {
                    app()->register($provider);
                } else {
                    Log::warning("Service provider '{$provider}' does not exist for module '{$moduleName}'.");
                }
            }

            // Run migrations
            $migrationPath = $modulePath . '/Database/Migrations';
            if (is_dir($migrationPath)) {
                Artisan::call('migrate', [
                    '--path' => "Modules/{$moduleName}/Database/Migrations",
                    '--force' => true,
                ]);
            } else {
                Log::warning("No migrations found for module '{$moduleName}'.");
            }

            Log::info("Module '{$moduleName}' registered and installed successfully.");
        } catch (Exception $e) {
            Log::error("Error installing module '{$moduleName}': " . $e->getMessage());
        }
    }
}
