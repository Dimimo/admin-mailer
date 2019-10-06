<?php

namespace Dimimo\AdminMailer\Mails;

use App\Models\User;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;
use Dimimo\AdminMailer\Models\MailerLogModel as Logger;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

/**
 * Class TestMailToAdmin
 * @package Dimimo\AdminMailer\Http\Mails
 */
class TestMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string $title
     */
    public $title;
    /**
     * @var User $user
     */
    public $user;
    /**
     * @var Email $email
     */

    public $email;

    /**
     * @var Customer $customer
     */
    public $customer;
    /**
     * @var Logger $log
     */
    public $log;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Email $email
     * @param Logger $log
     */
    public function __construct(User $user, Email $email, Logger $log)
    {
        $this->user = $user;
        $this->email = $email;
        $this->log = $log;
        $this->customer = new Customer(['uuid' => Str::uuid()->getHex()]);
        $this->title = "Admin test : " . $this->email->title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin-mailer::dispatch.send-test');
    }
}
