<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use App\Models\City;
use Dimimo\AdminMailer\Http\Requests\CustomerRequest;
use Dimimo\AdminMailer\Http\Traits\ListTrait;
use Dimimo\AdminMailer\Models\MailerCustomerModel as MailerCustomer;
use Illuminate\Support\Str;
use Freshbitsweb\Laratables\Laratables;
use Dimimo\AdminMailer\Models\LaratablesCustomers;

/**
 * Class CustomerController
 * @package Dimimo\AdminMailer\Http\Controllers
 */
class CustomerController extends EntryController
{
    use ListTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin-mailer::customers.index');
    }

    public function tableIndex() {
        return Laratables::recordsOf(LaratablesCustomers::class);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new MailerCustomer(['uuid' => Str::uuid()->getHex(), 'accepts_mail' => '1']);
        $lists = $this->getLists();

        return view('admin-mailer::customers.create', compact('customer', 'lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = new MailerCustomer($request->validated());
        $customer->accepts_mail ?: $customer->accepts_mail = '0';
        $customer->reads_mail = '0';
        $customer->city_id = City::getCityFromAutoComplete($customer->city_id);
        $customer->save();

        return redirect()
            ->route('admin-mailer.customers.show', [$customer->id])
            ->with('success', $customer->name . " is saved in the database");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = MailerCustomer::with('city')->findOrFail($id);

        return view('admin-mailer::customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = MailerCustomer::findOrFail($id);
        $customer->city_id = City::getCityName($customer->city_id);
        $lists = $this->getLists();

        return view('admin-mailer::customers.edit', compact('customer', 'lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = MailerCustomer::findOrFail($id);
        $data = $request->validated();
        $request->get('accepts_mail') ?: $data['accepts_mail'] = 0;
        $data['city_id'] = City::getCityFromAutoComplete($data['city_id']);
        $customer->update($data);

        return redirect()
            ->route('admin-mailer.customers.show', [$customer->id])
            ->with('success', $customer->name . " is update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $customer = MailerCustomer::findOrFail($id);
        $customer->delete();
        
        return redirect()
            ->route('admin-mailer.customer.index')
            ->with('success', "The customer <strong>{$customer->name}</strong> has been deleted");
    }
}
