<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Http\Middleware;

use Closure;
use Dimimo\AdminMailer\AdminMailer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class Authorize
 *
 * @package Dimimo\AdminMailer\Http\Middleware
 */
class Authorize
{
    /**
     * Handle the incoming request.
     *
     * @param Request  $request
     * @param Closure  $next
     *
     * @return Response
     */
    public function handle($request, $next)
    {
        return AdminMailer::check($request) ? $next($request) : abort(403);
    }
}