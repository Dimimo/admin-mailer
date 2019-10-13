<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Events;

use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class TestMail
 *
 * @package Dimimo\AdminMailer\Events
 */
class SendMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Customer $customer
     */
    public $customer;

    /**
     * @var Email $email
     */
    public $email;

    /**
     * Create a new event instance.
     *
     * @param Customer  $customer
     * @param Email     $email
     */
    public function __construct(Customer $customer, Email $email)
    {
        $this->customer = $customer;
        $this->email = $email;
    }
}