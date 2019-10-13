<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Listeners;

use Dimimo\AdminMailer\AdminMailer;
use Dimimo\AdminMailer\Events\SendMail;
use Dimimo\AdminMailer\Mails\MailToCustomer;
use Dimimo\AdminMailer\Models\MailerLogModel as Log;
use Illuminate\Support\Str;
use Mail;

/**
 * Class ArticleCreatedEmailUser
 *
 * @package App\Listeners
 */
class SendCustomerMail
{
    /**
     * @var Log $log
     */
    public $log;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SendMail  $event
     *
     * @return void
     */
    public function handle(SendMail $event)
    {
        $event = AdminMailer::transformEmail($event);
        $this->newLogEntry($event);
        if (App()->environment() === 'production')
        {
            Mail::to($event->customer)->send(new MailToCustomer($event->customer, $event->email, $this->log));
        }
        $this->log->update(['is_send' => '1']);
    }

    /**
     * Create a log input in the mailer_logs table
     *
     * @param SendMail  $event
     */
    private function newLogEntry(SendMail $event)
    {
        $this->log = new Log([
            'mailer_customer_id' => $event->customer->id,
            'mailer_email_id'    => $event->email->id,
            'uuid'               => Str::uuid()->getHex(),
            'is_send'            => '0']);
        $this->log->save();
    }

    /**
     * Garbage collection
     */
    public function __destruct()
    {
        //
    }
}