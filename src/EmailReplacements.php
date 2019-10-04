<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer;

use Dimimo\AdminMailer\Events\SendMail;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;

/**
 * Trait EmailReplacements
 * @package Dimimo\AdminMailer
 */
trait EmailReplacements
{
    /**
     * @var Email $email
     */
    private static $email;

    /**
     * @var Customer $customer
     */
    private static $customer;

    /**
     * @var array $search
     */
    private static $search;

    /**
     * @var array $replace
     */
    private static $replace;

    /**
     * Replaces all magical fields and return the email
     *
     * @param SendMail $event
     * @return SendMail
     */
    public static function transformEmail(SendMail $event) {
        static::$email = $event->email;
        static::$customer = $event->customer;
        static::replacements();
        static::transformBody();
        static::transformTitle();

        return $event;
    }

    /**
     * Replaces all search strings with their values in the body field
     */
    private static function transformBody() {
        static::$email->body = str_replace(static::$search, static::$replace, static::$email->body);
    }

    /**
     * Replaces all search strings with their values in the title field
     */
    private static function transformTitle() {
        static::$email->title = str_replace(static::$search, static::$replace, static::$email->title);
    }

    /**
     * Prepare the replacements values
     */
    private static function replacements() {
        static::$search = config('admin-mailer.email.replacements.search');
        static::$replace = config('admin-mailer.email.replacements.replace');
        foreach (static::$replace as $k => $field) {
            if (static::$customer->$field)
            {
                static::$replace[$k] = static::$customer->$field;
            }
            else {
                static::$replace[$k] = static::$replace[0];
            }
        }
    }
}
