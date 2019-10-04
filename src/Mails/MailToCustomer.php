<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Mails;

use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Dimimo\AdminMailer\Models\MailerLogModel as Log;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TestMailToAdmin
 * @package Dimimo\AdminMailer\Http\Mails
 */
class MailToCustomer extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string $subject
     */
    public $subject;
    /**
     * @var Customer $customer
     */
    public $customer;
    /**
     * @var Email $email
     */
    public $email;

    /**
     * @var Log $log
     */
    public $log;

    /**
     * Create a new message instance.
     *
     * @param Customer $customer
     * @param Email $email
     * @param Log $log
     */
    public function __construct(Customer $customer, Email $email, Log $log)
    {
        $this->customer = $customer;
        $this->email = $email;
        $this->log = $log;
        $this->subject = "[PuertoParrot.com] " . $this->email->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin-mailer::dispatch.send-customer');
    }
}
