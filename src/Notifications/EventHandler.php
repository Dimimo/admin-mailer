<?php

namespace Dimimo\AdminMailer\Notifications;

use Dimimo\AdminMailer\Events\SendMail;
use Dimimo\AdminMailer\Events\TestMail;
use Dimimo\AdminMailer\Listeners\SendCustomerMail;
use Dimimo\AdminMailer\Listeners\SendTestMail;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;

class EventHandler
{
    /** @var \Illuminate\Contracts\Config\Repository */
    protected $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function subscribe(Dispatcher $events)
    {
        $events->listen(TestMail::class, SendTestMail::class);
        $events->listen(SendMail::class, SendCustomerMail::class);
    }
}