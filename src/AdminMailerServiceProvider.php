<?php

namespace Dimimo\AdminMailer;

use DatabaseEntriesRepository;
use Dimimo\AdminMailer\Notifications\EventHandler;
use EntriesRepository;
use Illuminate\Support\Facades\Route;

/**
 * Class AdminMailerServiceProvider
 * @package Dimimo\AdminMailer
 */
class AdminMailerServiceProvider extends AdminMailerApplicationServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('admin-mailer', config('admin-mailer.middleware', []));

        $this->registerRoutes();
        $this->registerMigrations();
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin-mailer');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        view()->share('prefix', config('admin-mailer.prefix') . '.');
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        });
        Route::group($this->webRouteConfiguration(), function() {
            $this->loadRoutesFrom(__DIR__ . '/Http/web.php');
        });
    }

    /**
     * Register the package's migrations.
     *
     * @return void
     */
    private function registerMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    /**
     * The global config for the Admin Mailer web routes
     * (relative to /admin-mailer/'
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'prefix' => config('admin-mailer.prefix'),
            'namespace' => 'Dimimo\AdminMailer\Http\Controllers',
            'middleware' => 'admin-mailer',
        ];
    }

    /**
     * The global config for the Admin Mailer web routes
     * (relative to server root)
     *
     * @return array
     */
    private function webRouteConfiguration()
    {
        return [
            'namespace' => 'Dimimo\AdminMailer\Http\Controllers',
        ];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        //Publishing the migrations
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'admin-mailer.migrations');
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/admin-mailer.php' => config_path('admin-mailer.php'),
        ], 'admin-mailer.config');
        // Publishing the view file.
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/admin-mailer'),
        ], 'admin-mailer.views');
        // Publishing the public file.
        $this->publishes([
            __DIR__ . '/../public' => public_path('vendor/admin-mailer'),
        ], 'admin-mailer.public');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin-mailer.php', 'admin-mailer');
        //register the events
        $this->app['events']->subscribe(EventHandler::class);
        // Register the service the package provides.
        $this->app->singleton('admin-mailer', function () {
            return new AdminMailer();
        });
        $this->app->alias('AdminMailer', 'Dimimo\AdminMailer\AdminMailer');

        $this->registerDatabaseDriver();
    }

    /**
     * Register the package database storage driver.
     *
     * @return void
     */
    protected function registerDatabaseDriver()
    {

        $this->app->singleton(
            EntriesRepository::class, DatabaseEntriesRepository::class
        );

        $this->app->when(DatabaseEntriesRepository::class)
            ->needs('$connection')
            ->give(config('admin-mailer.storage.database.connection'));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['admin-mailer'];
    }
}
