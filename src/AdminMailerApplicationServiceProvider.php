<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AdminMailerApplicationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->authorization();
    }

    /**
     * Configure the Telescope authorization services.
     *
     * @return void
     */
    protected function authorization()
    {
        $this->gate();

        AdminMailer::auth(function (Request $request)
        {
            return app()->environment('local') ||
                Gate::check('admin-mailer', [$request->user()]);
        });
    }

    /**
     * Register the AdminMailer gate.
     *
     * This gate determines who can access Telescope in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('admin-mailer', function ($user)
        {
            return in_array($user->email, config('admin-mailer.gate.admins'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}