<?php

namespace Dimimo\AdminMailer\Models;

class LaratablesCustomers extends MailerCustomerModel {
    /**
     * Join roles to base customers table.
     * Assumes roles -> users is a one-to-many relationship
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    /*public static function laratablesQueryConditions($q)
    {
        return $q->select(['name as customer_name'])
            ->join('cities', 'cities.id', '=', 'mailer_customers.city_id')
            ->select(['cities.name as city_name']);
    }*/

    /*public static function laratablesCustomCustomerName($customer) {
        return $customer->name;
    }*/

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesName($customer)
    {
        return view('admin-mailer::customers.includes._name', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string|null
     * @throws \Throwable
     */
    public static function laratablesEmail($customer)
    {
        return view('admin-mailer::customers.includes._email', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesListName($customer)
    {
        return view('admin-mailer::customers.includes._list', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string|null
     * @throws \Throwable
     */
    public static function laratablesCustomCityName($customer)
    {
        if ($customer->city) {
            return $customer->city->name;
        }
        return null;
    }

    /**
     * Eager load media items of the role for displaying in the datatables.
     *
     * @return callable
     */
    /*public static function laratablesCityRelationQuery()
    {
        return function ($query) {
            $query->with('city');
        };
    }*/

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesAcceptsMail($customer)
    {
        return view('admin-mailer::customers.includes._accepts_mail', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesReadsMail($customer)
    {
        return view('admin-mailer::customers.includes._reads_mail', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesUrl($customer)
    {
        return view('admin-mailer::customers.includes._url', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesCustomAction($customer)
    {
        return view('admin-mailer::customers.includes._action', compact('customer'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel $customer
     * @return string
     * @throws \Throwable
     */
    public static function laratablesCustomUrl($customer)
    {
        return view('admin-mailer::customers.includes._url', compact('customer'))->render();
    }

    /**
     * Returns the data attribute for row id of the user.
     *
     * @return array
     */
    /*public function laratablesRowData()
    {
        return [
            'id' => $this->id,
        ];
    }*/

    /**
     * first_name column should be used for sorting when name column is selected in Datatables.
     *
     * @return string
     */
    public static function laratablesOrderName()
    {
        return 'name';
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    /*public static function laratablesAdditionalColumns()
    {
        return [];
    }*/
}