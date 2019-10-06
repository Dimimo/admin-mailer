<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Http\Controllers;

use Dimimo\AdminMailer\Events\SendMail;
use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

/**
 * Class MailerController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class MailerController extends EntryController
{
    /**
     * Prepare the page to send the emails
     * This page also beholds all the jquery that handles the request
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        $email = Email::with('campaign')->findOrFail($id);
        if ($email->send_datetime) {
            return redirect()
                ->route('admin-mailer.emails.index')
                ->with('warning', "The email <strong>{$email->title}</strong> can't be handled because it has already been send to the customers!");
        }
        $customers = $email->campaign->all_customers->pluck('id');

        return view('admin-mailer::mailer.send', compact('email', 'customers'));
    }

    /**
     * Ajax request to handle the sending of an email to a customer
     * It also sets the draft to send and a send_datetime value
     * These requests are looped in Jquery and NOT queued
     * As the mail is send, the tracker (mailer_logs) values are set
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sending(Request $request)
    {
        $email = Email::with('campaign')->findOrFail($request->get('email_id'));
        $customer = Customer::findOrFail($request->get('id'));
        //normally, this situation is not possible, but check anyway just in case
        //We don't want to send an email to a customer that has unsubscribed
        if (!$customer->accepts_mail) {
            return response()->json(['status' => 'warning', 'message' => "The customer {$customer->name} doesn't accept email"]);
        }
        if ($email->draft) {
            $email->update(['draft' => 0, 'send_datetime' => Carbon::now()]);
        }
        event(new SendMail($customer, $email));
        @usleep(config('admin-mailer.email.delay') * 1000);
        return response()->json(['status' => 'success', 'message' => "Email has been send to {$customer->name} ({$customer->email})"]);
    }
}
