<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Listeners;

use App\Models\User;
use Dimimo\AdminMailer\Events\TestMail;
use Dimimo\AdminMailer\Mails\TestMailToAdmin;
use Dimimo\AdminMailer\Models\MailerLogModel as Logger;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use Mail;

/**
 * Class ArticleCreatedEmailUser
 *
 * @package App\Listeners
 */
class SendTestMail implements ShouldQueue
{
    private $admin;

    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->admin = User::find(config('app.standard_user'));
    }

    /**
     * Handle the event.
     *
     * @param TestMail  $event
     *
     * @return void
     */
    public function handle(TestMail $event)
    {
        $event = $this->replacements($event);
        Mail::to($event->user)->send(new TestMailToAdmin($event->user, $event->email, new Logger(['uuid' => Str::uuid()
            ->getHex()])));
        //Todo: unset this on production
        //Mail::to($this->admin)->send(new TestMailToAdmin($event->user, $event->email));
    }

    private function replacements($event)
    {
        $search = ['**name**', '**realname**', '**email**',];
        $replace = [$this->admin->username, $this->admin->name, $this->admin->email];
        $event->email->title = str_replace($search, $replace, $event->email->title);
        $event->email->body = str_replace($search, $replace, $event->email->body);

        return $event;
    }

    /**
     *
     */
    public function __destruct()
    {
        //
    }
}