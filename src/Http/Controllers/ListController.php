<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use App\Models\City;
use Dimimo\AdminMailer\Http\Requests\ListRequest;
use Dimimo\AdminMailer\Models\MailerListModel as MailerList;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = MailerList::with(['campaigns' => function(BelongsToMany $q) {
            return $q->orderBy('name');
        }])->withCount(['campaigns', 'customers'])->orderBy('name')->get();

        return view('admin-mailer::lists.index', compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list = new MailerList();

        return view('admin-mailer::lists.create', compact('list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ListRequest $request)
    {
        $list = new MailerList($request->validated());
        $list->city_id = City::getCityFromAutoComplete($list->city_id);
        $list->save();

        return redirect()
            ->route('admin-mailer.lists.show', [$list->id])
            ->with('success', $list->name . " is saved in the database");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $list = MailerList::with(['campaigns' => function(BelongsToMany $q) {
        return $q->orderBy('name');
    }])->withCount(['campaigns', 'customers'])->findOrFail($id);

        return view('admin-mailer::lists.show', compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $list = MailerList::findOrFail($id);
        $list->city_id ? $list->city_id = City::getCityName($list->city_id) : null;

        return view('admin-mailer::lists.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ListRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ListRequest $request, $id)
    {
        $list = MailerList::findOrFail($id);
        $data = $request->validated();
        $data['city_id'] = City::getCityFromAutoComplete($data['city_id']);
        $list->update($data);

        return redirect()
            ->route('admin-mailer.lists.show', [$list->id])
            ->with('success', $list->name . " is update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $list = MailerList::findOrFail($id);
        if ($list->customers()->count() > 0) {
            return redirect()->back()->with('warning', "The list {$list->name} can't be deleted because there are still customers inside");
        }
        $list->delete();

        return redirect()->route('admin-mailer.lists.index')->with('success', "The list <strong>{$list->name}</strong> has been deleted");
    }
}
