<?php

namespace App\Console\Commands;

use App\Models\Module;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new module with the specified name';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        try {
            $name = $this->argument('name');

            $modulePath = base_path("Modules/{$name}");

            // Define the directories
            $directories = [
                "{$modulePath}/Controllers",
                "{$modulePath}/Models",
                "{$modulePath}/Views",
                "{$modulePath}/Routes",
                "{$modulePath}/Migrations",
            ];

            // Create the directories
            foreach ($directories as $dir) {
                if (!File::exists($dir)) {
                    File::makeDirectory($dir, 0755, true);
                }
            }

            // Create a default controller
            $controllerTemplate = "<?php\n\nnamespace Modules\\{$name}\\Controllers;\n\nuse App\Http\Controllers\Controller;\n\nclass {$name}Controller extends Controller\n{\n    public function index()\n    {\n        return view('{$name}::index');\n    }\n}";
            File::put("{$modulePath}/Controllers/{$name}Controller.php", $controllerTemplate);

            // Create a default route file
            $routeTemplate = "<?php\n\nuse Illuminate\Support\Facades\Route;\nuse Modules\\{$name}\\Controllers\\{$name}Controller;\n\nRoute::get('/{$name}', [{$name}Controller::class, 'index']);";
            File::put("{$modulePath}/Routes/web.php", $routeTemplate);

            // Create a default view file
            $viewTemplate = "<h1>Welcome to the {$name} module!</h1>";
            File::put("{$modulePath}/Views/index.blade.php", $viewTemplate);



            Module::create([
                'name' => $name,
                'active' => true, // Set the module as active by default
            ]);
        } catch (\Exception $e) {
            $this->error("An error occurred: " . $e->getMessage());
        }
    }
}
