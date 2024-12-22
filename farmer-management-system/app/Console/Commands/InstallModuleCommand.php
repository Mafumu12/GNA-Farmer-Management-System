<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ModuleService;

class InstallModuleCommand extends Command
{
    protected $signature = 'modules:install-new';

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
        $newModules = $this->moduleService->getNewModules();

        if (empty($newModules)) {
            $this->info("No new modules found to install.");
            return;
        }

        foreach ($newModules as $moduleName) {
            if ($this->moduleService->validateModuleStructure($moduleName)) {
                $this->info("Installing module: {$moduleName}");
                try {
                    $this->moduleService->registerAndInstallModule($moduleName);
                    $this->info("Module '{$moduleName}' installed successfully.");
                } catch (\Exception $e) {
                    $this->error("Failed to install module '{$moduleName}': " . $e->getMessage());
                }
            } else {
                $this->warn("Invalid module structure for: {$moduleName}. Skipping...");
            }
        }

        $this->info("Module installation process completed.");
    }
}
