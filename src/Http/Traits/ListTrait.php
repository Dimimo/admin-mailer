<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Http\Traits;

use Dimimo\AdminMailer\Models\MailerListModel as MailerList;

/**
 * Trait ListTrait
 *
 * @package Dimimo\AdminMailer
 */
trait ListTrait
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private function getLists()
    {
        return MailerList::orderBy('name')->get();
    }
}