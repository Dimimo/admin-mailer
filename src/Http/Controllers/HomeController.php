<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use Dimimo\AdminMailer\Models\MailerCustomerModel;

/**
 * Class HomeController
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