<?php

namespace App\Providers;

use App\Models\Module;
use Illuminate\Support\Facades\Log;
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
        $modulePath = base_path('Modules');

        if (!is_dir($modulePath)) {
            Log::error('Modules directory not found.');
            return;
        }

        $modules = Module::where('is_active', true)->get(); // Fetch only active modules

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
            }
        }
    }
}
