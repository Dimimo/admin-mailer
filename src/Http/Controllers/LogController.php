<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use Dimimo\AdminMailer\Models\MailerLogModel as Logging;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin-mailer::logs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
