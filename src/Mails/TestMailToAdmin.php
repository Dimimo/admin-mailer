<?php

namespace Dimimo\AdminMailer\Mails;

use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TestMailToAdmin
 * @package Dimimo\AdminMailer\Http\Mails
 */
class TestMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var string $subject
     */
    public $subject;
    /**
     * @var User $user
     */
    public $user;
    /**
     * @var Email $email
     */
    public $email;

    /**
     * Create a new message instance.
     *
     * @param User  $user
     * @param Email $email
     */
    public function __construct(User $user, Email $email)
    {
        $this->user  = $user;
        $this->email = $email;
        $this->subject = "Admin test : " . $this->email->title;
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
