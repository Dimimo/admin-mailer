<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Http\Controllers;

use Dimimo\AdminMailer\Models\MailerCustomerModel;

/**
 * Class HomeController
 *
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class HomeController extends EntryController
{
    public function index()
    {
        $users = MailerCustomerModel::all();
        return view('admin-mailer::index', compact('users'));
    }
}