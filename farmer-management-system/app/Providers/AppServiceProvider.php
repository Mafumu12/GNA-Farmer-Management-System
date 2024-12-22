<?php

namespace App\Providers;

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
        Vite::prefetch(concurrency: 3);
        $modules = Module::all();

        foreach ($modules as $module) {
            if ($module->isEnabled()) {
                $serviceProvider = $module->getPath() . '/Providers/' . $module->getName() . 'ServiceProvider.php';
                if (file_exists($serviceProvider)) {
                    $this->app->register("Modules\\" . $module->getName() . "\\Providers\\" . $module->getName() . "ServiceProvider");
                }
                $migrationPath = $module->getPath() . '/Database/Migrations';
                if (is_dir($migrationPath)) {
                    $this->loadMigrationsFrom($migrationPath);
                }
            }
        }
    }
}
