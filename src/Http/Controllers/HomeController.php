<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Http\Controllers;

/**
 * Class HomeController
 *
 * @package Dimimo\AdminMailer
 */
class HomeController extends EntryController
{
    public function index()
    {
        return view('admin-mailer::index');
    }
}