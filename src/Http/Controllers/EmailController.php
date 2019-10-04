<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Dimimo\AdminMailer\Events\TestMail;
use Dimimo\AdminMailer\Http\Requests\EmailRequest;
use Dimimo\AdminMailer\Models\MailerCampaignModel as Campaign;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;

/**
 * Class EmailController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::with('campaign')->orderBy('title')->get();

        return view('admin-mailer::emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $email = new Email();
        $campaigns = Campaign::orderBy('name')->get();

        return view('admin-mailer::emails.create', compact('email', 'campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EmailRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmailRequest $request)
    {
        $email = new Email($request->validated());
        $email->created_by = Auth::id();
        $email->save();

        return redirect()
            ->route('admin-mailer.emails.show', [$email->id])
            ->with('success', "A draft version of <strong>" . $email->title . "</strong> is saved in the database.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $email = Email::with('campaign')->findOrFail($id);

        return view('admin-mailer::emails.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $email = Email::with('campaign')->findOrFail($id);
        if ($email->send_datetime) {
            $message = "The email <strong>{$email->title}</strong> can't be updated because it has been send out already!";
            $message .= "Use the copy function instead.";
            return redirect()
                ->back()
                ->with('warning', $message);
        }
        $campaigns = Campaign::orderBy('name')->get();

        return view('admin-mailer::emails.edit', compact('email', 'campaigns'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EmailRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailRequest $request, $id)
    {
        $email = Email::findOrFail($id);
        $email->update($request->validated());

        return redirect()
            ->route('admin-mailer.emails.show', [$email->id])
            ->with('success', "The email <strong>" . $email->title . "</strong> is updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $email = Email::findOrFail($id);
        if ($email->send_datetime) {
            return redirect()
                ->back()
                ->with('warning', "The email <strong>{$email->title}</strong> can't be deleted because it has been send out already!");
        }
        $email->delete();

        return redirect()
            ->route('admin-mailer.emails.index')
            ->with('success', "The email <strong>{$email->title}</strong> has been deleted.");
    }

    /**
     * Copy the body of a selected email to create a new email
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function copyEmail($id)
    {
        $email = Email::select('body')->find($id)->toArray();
        $email = new Email($email);
        $campaigns = Campaign::orderBy('name')->get();

        return view('admin-mailer::emails.create', compact('email', 'campaigns'));
    }

    /**
     * Send a test mail to yourself for testing the outcome of the body
     * This is an AJAX request with JSON reply
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendTest($id)
    {
        event(new TestMail(
                User::find(Auth::id()),
                Email::findOrFail($id))
        );

        return response()->json(['type' => 'success', 'message' => 'A test email has been send out']);
    }
}
