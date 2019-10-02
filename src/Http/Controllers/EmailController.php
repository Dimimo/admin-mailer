<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Dimimo\AdminMailer\Http\Requests\EmailRequest;
use Dimimo\AdminMailer\Models\MailerCampaignModel as Campaign;
use Dimimo\AdminMailer\Models\MailerEmailModel as Email;

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
        $email = Email::with(['campaign', 'owner'])->findOrFail($id);

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
     */
    public function destroy($id)
    {
        //
    }

    public function copyEmail($id)
    {
        $email = Email::select('body')->find($id)->toArray();
        $email = new Email($email);
        $campaigns = Campaign::orderBy('name')->get();

        return view('admin-mailer::emails.create', compact('email', 'campaigns'));
    }
}
