<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Notifications;

use Dimimo\AdminMailer\Events\SendMail;
use Dimimo\AdminMailer\Events\TestMail;
use Dimimo\AdminMailer\Listeners\SendCustomerMail;
use Dimimo\AdminMailer\Listeners\SendTestMail;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class EventHandler
 *
 * @package Dimimo\AdminMailer
 */
class EventHandler
{
    /** @var Repository */
    protected $config;

    /**
     * EventHandler constructor.
     *
     * @param Repository  $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * @param Dispatcher  $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(TestMail::class, SendTestMail::class);
        $events->listen(SendMail::class, SendCustomerMail::class);
    }
}