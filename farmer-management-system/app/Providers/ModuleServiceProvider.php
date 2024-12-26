<?php

namespace App\Providers;

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

        $modules = scandir($modulePath);

        foreach ($modules as $module) {
            // Skip "." and ".." directory references
            if ($module === '.' || $module === '..') {
                continue;
            }

            $moduleDir = $modulePath . '/' . $module;

            if (!is_dir($moduleDir)) {
                Log::warning("Skipping non-directory entry: $module");
                continue;
            }

            // Load module routes
            $routePath = $moduleDir . '/Routes/web.php';
            if (file_exists($routePath)) {
                $this->loadRoutesFrom($routePath);
                Log::info("Routes loaded for module: $module");
            }

            // Load module views
            $viewPath = $moduleDir . '/Views';
            if (is_dir($viewPath)) {
                $this->loadViewsFrom($viewPath, $module);
                Log::info("Views loaded for module: $module");
            }

            // Load module migrations
            $migrationPath = $moduleDir . '/Migrations';
            if (is_dir($migrationPath)) {
                $this->loadMigrationsFrom($migrationPath);
                Log::info("Migrations loaded for module: $module");
            }
        }
    }
}
