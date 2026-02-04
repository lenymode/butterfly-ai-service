<?php

namespace Modules\ACL\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ACLServiceProvider extends ServiceProvider
{
    protected string $name = 'ACL';

    protected string $nameLower = 'acl';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
        $this->registerRoutes();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands.
     */
    protected function registerCommands(): void
    {
        // Register module commands here
    }

    /**
     * Register command schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // Register command schedules here
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/' . $this->nameLower);

        $this->loadTranslationsFrom($langPath, $this->nameLower);
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([
            module_path($this->name, 'config/config.php') => config_path($this->nameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->name, 'config/config.php'),
            $this->nameLower
        );
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->nameLower);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$viewPath]), $this->nameLower);
    }

    /**
     * Register routes.
     */
    protected function registerRoutes(): void
    {
        $this->app->booted(function () {
            $this->loadRoutes();
        });
    }

    /**
     * Load routes.
     */
    protected function loadRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(module_path($this->name, 'routes/api.php'));

        Route::middleware('web')
            ->group(module_path($this->name, 'routes/web.php'));
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    /**
     * Get publishable view paths.
     */
    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('modules.paths.modules') as $path) {
            if (is_dir($path . '/' . $this->name . '/resources/views')) {
                $paths[] = $path . '/' . $this->name . '/resources/views';
            }
        }
        return $paths;
    }
}
