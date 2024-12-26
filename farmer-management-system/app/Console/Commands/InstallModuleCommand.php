<?php

namespace App\Console\Commands;

use App\Services\ModuleService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InstallModuleCommand extends Command
{
    // Updated signature to accept the 'name' argument
    protected $signature = 'modules:install-new {name}';  // Add the 'name' argument here

    /**
     * The console command description.
     */
    protected $description = 'Install new modules added to the Modules directory.';

    protected $moduleService;

    /**
     * Constructor to inject the ModuleService.
     */
    public function __construct(ModuleService $moduleService)
    {
        parent::__construct();
        $this->moduleService = $moduleService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get the module name from the argument
        $moduleName = $this->argument('name');  // Use the 'name' argument

        if ($this->moduleService->validateModuleStructure($moduleName)) {
            $this->info("Installing module: {$moduleName}");
            Log::info("Installing module: {$moduleName}");
            try {
                $this->moduleService->registerAndInstallModule($moduleName);
                $this->info("Module '{$moduleName}' installed successfully.");
            } catch (\Exception $e) {
                $this->error("Failed to install module '{$moduleName}': " . $e->getMessage());
            }
        } else {
            $this->warn("Invalid module structure for: {$moduleName}. Skipping...");
        }

        $this->info("Module installation process completed.");
    }
}
