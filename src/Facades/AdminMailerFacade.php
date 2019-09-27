<?php

namespace Dimimo\AdminMailer\Facades;

use Illuminate\Support\Facades\Facade;

class AdminMailerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'admin-mailer';
    }
}
