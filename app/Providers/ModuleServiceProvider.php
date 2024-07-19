<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use File;

class ModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // For each of the registered modules, include their routes and Views
        $modules = config("module.modules");
     
        foreach ($modules as $module) {
            // Load the routes for each of the modules
            if (file_exists(base_path() . '/modules/' . $module . '/Routes/web.php')) {
                include base_path() . '/modules/' . $module . '/Routes/web.php';
            }

            if (file_exists(base_path() . '/modules/' . $module . '/Routes/api.php')) {
                include base_path() . '/modules/' . $module . '/Routes/api.php';
            }

            // Load the views
            if (is_dir(base_path() . '/modules/' . $module . '/Views')) {
                $this->loadViewsFrom(base_path() . '/modules/' . $module . '/Views', $module);
            }

            // Register the components
            $componentPath = base_path() . '/modules/' . $module . '/Components';
            if (is_dir($componentPath)) {
                foreach (File::allFiles($componentPath) as $file) {
                    $className = $this->getClassNameFromFile($file);
                    Blade::component($module . '-' . $className, "App\\Modules\\$module\\Components\\$className");
                }
            }
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Extract class name from file path.
     *
     * @param \SplFileInfo $file
     * @return string
     */
    private function getClassNameFromFile($file)
    {
        return str_replace('.php', '', $file->getFilename());
    }
}
