<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Http\Controllers;

use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;
use Illuminate\Http\Request;

/**
 * Class SubscribeController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class SubscribeController extends EntryController
{
    /**
     * Handle an unsubscription request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function unsubscribe(Request $request) {
        $uuid = $request->get('u');
        $customer = Customer::where('uuid', $uuid)->first();
        $customer->update(['accepts_mail' => '0']);

        return view('admin-mailer::unsubscribed', compact('customer'));
    }

    /**
     * Handle a subscription request
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function subscribe(Request $request) {
        $uuid = $request->get('u');
        $customer = Customer::where('uuid', $uuid)->first();
        $customer->update(['accepts_mail' => '1']);

        return view('admin-mailer::subscribed', compact('customer'));
    }
}
