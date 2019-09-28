<?php

namespace Dimimo\AdminMailer;

use Illuminate\Support\ServiceProvider;

/**
 * Class AdminMailerServiceProvider
 * @package Dimimo\AdminMailer
 */
class AdminMailerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin-mailer');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
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
        // Register the service the package provides.
        $this->app->singleton('admin-mailer', function () {
            return new AdminMailer();
        });
        $this->app->alias('AdminMailer', 'Dimimo\AdminMailer\AdminMailer');
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
