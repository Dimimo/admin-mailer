<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use Auth;
use Dimimo\AdminMailer\Http\Requests\CampaignRequest;
use Dimimo\AdminMailer\Http\Traits\ListTrait;
use Dimimo\AdminMailer\Models\MailerCampaignModel as Campaign;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CampaignController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class CampaignController extends EntryController
{
    use ListTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::with('lists')->withCount(['emails', 'lists'])->orderByDesc('updated_at')->get();

        return view('admin-mailer::campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $campaign = new Campaign();
        $lists = $this->getLists();

        return view('admin-mailer::campaigns.create', compact('campaign', 'lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CampaignRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CampaignRequest $request)
    {
        $campaign = new Campaign($request->validated());
        $campaign->owner_id = Auth::id();
        $campaign->save();
        $this->_syncLists($campaign);

        return redirect()
            ->route('admin-mailer.campaigns.show', [$campaign->id])
            ->with('success', $campaign->name . " is saved in the database");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::with(['lists', 'emails'])->withCount(['emails', 'lists'])->findOrFail($id);

        return view('admin-mailer::campaigns.show', compact('campaign', 'selectLists'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $campaign = Campaign::with('lists')->findOrFail($id);
        $lists = $this->getLists();

        return view('admin-mailer::campaigns.edit', compact('campaign', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CampaignRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CampaignRequest $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $campaign->update($request->validated());
        $this->_syncLists($campaign);

        return redirect()
            ->route('admin-mailer.campaigns.show', [$campaign->id])
            ->with('success', $campaign->name . " is updated");
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
        $campaign = Campaign::findOrFail($id);
        if ($campaign->emails()->count() > 0) {
            return redirect()
                ->back()
                ->with('warning', "The campaign {$campaign->name} can not be deleted because it has emails");
        }
        $campaign->lists()->detach();
        $campaign->forceDelete();

        return redirect()
            ->route('admin-mailer.campaigns.index')
            ->with('success', $campaign->name . " is deleted");
    }

    /**
     * Show the Campaigns and their connected lists
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listsView()
    {
        $campaigns = Campaign::withCount(['emails', 'lists'])->with(['lists' => function (BelongsToMany $q) {
            return $q->orderBy('name');
        }])->orderBy('name')->get();
        $lists = $this->getLists();

        return view('admin-mailer::campaigns.lists', compact('campaigns', 'lists'));
    }

    /**
     * Show all the emails connected to a Campaign
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function emails($id) {
        $campaign = Campaign::with(['emails' => function(HasMany $q) {
            return $q->orderBy('updated_at', 'asc');
        }])->findOrFail($id);
        $emails = $campaign->emails;

        return view('admin-mailer::campaigns.emails', compact('campaign', 'emails'));
}

    /**
     * Show all customers connected to a Campaign
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customers($id) {
        $campaign = Campaign::findOrFail($id);
        $query = json_encode(['mailer_list_id' => $campaign->lists()->get()->pluck('id')->toArray()]);

        return view('admin-mailer::campaigns.customers', compact('campaign', 'query'));
    }

    /**
     * Sync the lists (many to many) to the current Campaign
     *
     * @param Campaign $campaign
     * @return void
     */
    private function _syncLists(Campaign $campaign)
    {
        if ($lists = array_unique(request()->get('lists'))) {
            $campaign->lists()->sync($lists);
        } else {
            $campaign->lists()->detach();
        }
    }
}
