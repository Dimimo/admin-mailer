<?php

namespace Dimimo\AdminMailer\Http\Traits;

use Dimimo\AdminMailer\Models\MailerListModel as MailerList;

/**
 * Trait ListTrait
 * @package Dimimo\AdminMailer\Http\Traits
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