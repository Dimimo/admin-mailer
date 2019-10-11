<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use Dimimo\AdminMailer\Models\MailerLogModel as Logging;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\ImageManager;

/**
 * Class LogController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class LogController extends EntryController
{
    /**
     * Handles the email top logo
     * If a customer opens the email with view images, this event is logged
     *
     * @param Request $request
     * @return mixed
     */
    public function logo(Request $request)
    {
        // /img/logo.png?u=e9690e04d23642d8a02d6a77f255ce26
        $uuid = $request->get('u');
        $logger = Logging::where('uuid', $uuid)->with(['customer', 'email'])->first();
        if ($logger instanceof Logging)
        {
            $logger->customer()->update(['reads_mail' => '1']);
            $logger->update(['read_datetime' => Carbon::now()]);
            \Log::info("[campaign] {$logger->customer->name} ({$logger->customer->email}) reads \"{$logger->email->title}\" of the \"{$logger->email->campaign->name}\" Campaign");
        }
        $image = new ImageManager();

        return $image->make(asset(config('admin-mailer.logo_image')))->response();
    }

    /**
     * Display a listing of all emails that have been send out.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::whereDraft('0')->orderBy('send_datetime', 'desc')->get();

        return view('admin-mailer::logs.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $email_id
     * @return \Illuminate\Http\Response
     */
    public function read($email_id)
    {
        $email = Email::findOrFail($email_id);
        $logs = $email->logs()->whereNotNull('read_datetime')->get();

        return view('admin-mailer::logs.read', compact('email', 'logs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $email_id
     * @return \Illuminate\Http\Response
     */
    public function unsubscribed($email_id)
    {
        $email = Email::findOrFail($email_id);
        $customers = $email->unsubscribed->paginate();

        return view('admin-mailer::logs.unsubscribed', compact('email', 'customers'));
    }
}
