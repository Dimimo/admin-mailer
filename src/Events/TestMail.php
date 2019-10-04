<?php

namespace Dimimo\AdminMailer\Events;

use App\Models\User;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TestMail
 * @package Dimimo\AdminMailer\Events
 */
class TestMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @var Email $email
     */
    public $email;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Email $email
     */
    public function __construct(User $user, Email $email)
    {
        $this->user = $user;
        $this->email = $email;
    }
}