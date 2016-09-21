<?php

namespace Pilaster\Newsletters\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class NewsletterServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/newsletters.php', 'newsletters');
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            $this->mapWebRoutes();
            $this->mapApiRoutes();
        }

        $this->loadViewsFrom(__DIR__.'/../../views', 'newsletters');

        if (method_exists($this, 'loadMigrationsFrom')) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        }

        $this->registerPublishes();
    }

    /**
     * Register file group publishing
     */
    private function registerPublishes()
    {
        $this->publishes([__DIR__.'/../../config/newsletters.php' => config_path('newsletters.php')], 'config');
        $this->publishes([__DIR__.'/../../database/migrations/' => database_path('migrations')], 'migrations');
        $this->publishes([__DIR__.'/../../database/factories/' => database_path('factories')], 'factories');
        $this->publishes([__DIR__.'/../../views' => resource_path('views/vendor/newsletters')], 'views');
    }

    /**
     * Map the web routes
     */
    private function mapWebRoutes()
    {
        Route::group([
            'as' => 'newsletters::',
            'prefix' => 'newsletters',
            'namespace' => 'Pilaster\Newsletters\Controllers',
            'middleware' => ['web'],
        ], function ($router) {
            require __DIR__.'/../../routes/web.php';
        });
    }

    /**
     * Map the API routes
     */
    private function mapApiRoutes()
    {
        Route::group([
            'as' => 'newsletters.api::',
            'prefix' => 'newsletters/api',
            'namespace' => 'Pilaster\Newsletters\Controllers\Api',
            'middleware' => ['auth', 'api'],
        ], function ($router) {
            require __DIR__.'/../../routes/api.php';
        });
    }
}
