<?php

namespace Dimimo\AdminMailer\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use Dimimo\AdminMailer\Http\Requests\CustomerRequest;
use Dimimo\AdminMailer\Models\MailerCustomerModel as Customer;
use Dimimo\AdminMailer\Models\MailerListModel as MailerList;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('admin-mailer::customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = new Customer(['uuid' => Str::uuid()->getHex()]);
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
        $customer = new Customer($request->validated());
        $customer->accepts_mail ?: $customer->accepts_mail = '0';
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
        $customer = Customer::findOrFail($id);

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
        $customer = Customer::findOrFail($id);
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
        $customer = Customer::findOrFail($id);
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
     */
    public function destroy($id)
    {
        //
    }

    private function getLists()
    {
        return MailerList::orderBy('name')->get();
    }
}
