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
use Dimimo\AdminMailer\Models\MailerLogModel as Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class MailerController
 *
 * @package Dimimo\AdminMailer
 */
class MailerController extends EntryController
{
    /**
     * Prepare the page to send the emails
     * This page also beholds all the jquery that handles the request
     *
     * @param $id
     *
     * @return \Illuminate\Http\Response
     */
    public function send($id)
    {
        $email = Email::with('campaign')->findOrFail($id);
        if ($email->completed())
        {
            return redirect()
                ->route('admin-mailer.emails.index')
                ->with('warning', "The email <strong>{$email->title}</strong> can't be handled because it has already been send to the customers!");
        }
        $customers = $email->campaign->all_customers_id;
        $already_send = $email->attendedCustomers();
        $customers = $customers->diff($already_send); //show only those customer_ids not yet send out
        $customers = $customers->values(); //reset the keys
        $already_send = count($already_send);

        return view('admin-mailer::mailer.send', compact('email', 'customers', 'already_send'));
    }

    /**
     * Ajax request to handle the sending of an email to a customer
     * It also sets the draft to send and a send_datetime value
     * These requests are looped in Jquery and NOT queued
     * As the mail is send, the tracker (mailer_logs) values are set
     *
     * @param Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function sending(Request $request)
    {
        $email = Email::with('campaign')->findOrFail($request->get('email_id'));
        $customer = Customer::findOrFail($request->get('id'));
        //We don't send an email to a customer that has unsubscribed
        //But we do create a bogus entry to keep the stats clean (the unsubscribe problem)
        if (!$customer->accepts_mail)
        {
            $this->addBogusEntry($email, $customer);
            return response()->json([
                'status'  => 'warning',
                'message' => "The customer {$customer->name} doesn't accept email. Don't worry. Proceeding..."
            ]);
        }
        if ($email->draft)
        {
            $email->update(['draft' => 0, 'send_datetime' => Carbon::now()]);
        }
        if ($this->checkEntry($email, $customer))
        {
            return response()
                ->json([
                    'status'   => 'warning',
                    'message'  => "The email to <strong>{$customer->name}</strong> was already send. All is ok. proceeding...",
                    'email_id' => $email->id,
                ]);
        }
        event(new SendMail($customer, $email));
        @usleep(config('admin-mailer.email.delay') * 1000);
        if ($customer->city)
        {
            $message = ' in ' . $customer->city->name;
        } else
        {
            $message = '';
        }
        return response()->json([
            'status'   => 'success',
            'message'  => "Send to <strong>{$customer->name}</strong>{$message}",
            'email_id' => $email->id,
        ]);
    }

    /**
     * Check if the entry already exists and has been send.
     * True = it is already send
     * False = not send (no entry in the Log)
     *         or it exists in the DB but got not send by the event listener
     *
     * @param Email     $email
     * @param Customer  $customer
     *
     * @return integer
     * @throws \Exception
     */
    private function checkEntry(Email $email, Customer $customer)
    {
        $log = Log::where([
            ['mailer_customer_id', '=', $customer->id],
            ['mailer_email_id', '=', $email->id]
        ])->first();
        if (!$log)
        {
            return false;
        }
        if ($log->is_send == 1)
        {
            return true;
        }
        //simply delete the log entry, the listener will create a new input
        $log->delete();

        return false;
    }

    /**
     * Add a bogus entry for unsubscribed customers
     * This is to make the statistics possible (the unsubscribe problem)
     *
     * @param Email     $email
     * @param Customer  $customer
     *
     * @return void
     */
    private function addBogusEntry(Email $email, Customer $customer)
    {
        (new Log([
            'mailer_customer_id' => $customer->id,
            'mailer_email_id'    => $email->id,
            'uuid'               => Str::uuid()->getHex(),
            'is_send'            => '1']))->save();
    }
}
