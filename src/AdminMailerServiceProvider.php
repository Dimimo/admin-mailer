<?php

namespace Dimimo\AdminMailer;

use Illuminate\Support\ServiceProvider;

class AdminMailerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dimimo');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'dimimo');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole())
        {
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
        $this->publishes([__DIR__ . '/../config/admin-mailer.php' => config_path('admin-mailer.php'),
                         ], 'admin-mailer.config');
        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/dimimo'),
        ], 'admin-mailer.views');*/ // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/dimimo'),
        ], 'admin-mailer.views');*/ // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/dimimo'),
        ], 'admin-mailer.views');*/ // Registering package commands.
        // $this->commands([]);
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
        $this->app->singleton('admin-mailer', function ($app)
        {
            return new AdminMailer();
        });
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
