<?php

namespace Dimimo\AdminMailer;

use Closure;
use Illuminate\Http\Request;

/**
 * Trait AuthorizesRequests
 * @package Dimimo\AdminMailer
 */
trait AuthorizesRequests
{
    /**
     * The callback that should be used to authenticate Telescope users.
     *
     * @var Closure
     */
    public static $authUsing;

    /**
     * Register the Telescope authentication callback.
     *
     * @param Closure $callback
     * @return static
     */
    public static function auth($callback)
    {
        static::$authUsing = $callback;

        return new static;
    }

    /**
     * Determine if the given request can access the Telescope dashboard.
     *
     * @param Request $request
     * @return bool
     */
    public static function check($request)
    {
        return (static::$authUsing ?: function () {
            return app()->environment('local');
        })($request);
    }
}
