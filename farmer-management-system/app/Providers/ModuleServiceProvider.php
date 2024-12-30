<?php

namespace App\Providers;

use App\Models\Module;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // You can register any dependencies or bindings here if needed
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {

            if (app()->runningInConsole()) {
                return;
            }
            $modulePath = base_path('Modules');

            if (!is_dir($modulePath)) {
                Log::error('Modules directory not found.');
                return;
            }

            // Check if the 'modules' table exists
            if (!Schema::hasTable('modules')) {
                Log::warning('Modules table does not exist.');
                return;
            }

            $modules = Module::where('is_active', 1)->get(); // Fetch only active modules

            foreach ($modules as $module) {
                $moduleDir = $modulePath . '/' . $module->name;

                // Skip if module directory doesn't exist
                if (!is_dir($moduleDir)) {
                    Log::warning("Skipping non-existing module: $module->name");
                    continue;
                }

                // Load module routes
                $routePath = $moduleDir . '/Routes/web.php';
                if (file_exists($routePath)) {
                    $this->loadRoutesFrom($routePath);
                    Log::info("Routes loaded for module: $module->name");
                }

                // Load module views
                $viewPath = $moduleDir . '/Views';
                if (is_dir($viewPath)) {
                    $this->loadViewsFrom($viewPath, $module->name);
                    Log::info("Views loaded for module: $module->name");
                }

                // Load module migrations
                $migrationPath = $moduleDir . '/Migrations';
                if (is_dir($migrationPath)) {
                    $this->loadMigrationsFrom($migrationPath);
                    Log::info("Migrations loaded for module: $module->name");

                    Artisan::call('migrate', [
                        '--path' => str_replace(base_path() . '/', '', $migrationPath),
                        '--force' => true,
                    ]);
                    Log::info("Migrations executed for module: $module->name");
                }
            }

        } catch (\Exception $e) {
            // Catch and log unexpected errors
            Log::error('An error occurred during module initialization.', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}
