<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //dd("boot method called");
        Vite::prefetch(concurrency: 3);
        Log::info("Boot method executed");
        $modules = Module::all();

        foreach ($modules as $module) {
            try {
                if ($this->isModuleEnabled($module)) {
                    // Register the service provider if it exists
                    $this->registerModuleServiceProvider($module);

                    // Load migrations for the module
                    $this->loadModuleMigrations($module);
                }
            } catch (\Exception $e) {
                Log::error("Error bootstrapping module '{$module->getName()}': " . $e->getMessage());
            }
        }
    }

    /**
     * Check if a module is enabled.
     */
    protected function isModuleEnabled($module): bool
    {
        $moduleConfigPath = $module->getPath() . '/module.json';

        if (file_exists($moduleConfigPath)) {
            $moduleConfig = json_decode(file_get_contents($moduleConfigPath), true);

            // Default to enabled if the `enabled` key is missing
            return $moduleConfig['enabled'] ?? true;
        }

        return false;
    }

    /**
     * Register a module's service provider.
     */
    protected function registerModuleServiceProvider($module): void
    {
        $serviceProviderClass = "Modules\\" . $module->getName() . "\\providers\\" . $module->getName() . "ServiceProvider";

        if (class_exists($serviceProviderClass)) {
            $this->app->register($serviceProviderClass);
            Log::info("Registered service provider for module: {$module->getName()} at path: {$module->getPath()}");
        } else {
            throw new \Exception("Service provider not found for module: {$module->getName()}");
        }
    }

    /**
     * Load a module's migrations.
     */
    protected function loadModuleMigrations($module): void
    {
        $migrationPath = $module->getPath() . '/database/migrations';

        if (is_dir($migrationPath)) {
            $this->loadMigrationsFrom($migrationPath);
            Log::info("Loaded migrations for module: {$module->getName()}");
        } else {
            Log::warning("No migrations found for module: {$module->getName()}");
        }
    }
}
