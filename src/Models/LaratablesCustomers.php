<?php


namespace Dimimo\AdminMailer\Models;

/**
 * Class LaratablesCustomers
 * @package Dimimo\AdminMailer\Models
 */
class LaratablesCustomers extends MailerCustomerModel
{
    //https://github.com/freshbitsweb/laratables

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
     * @return string
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
        return '';
    }

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
    public static function laratablesAdditionalColumns()
    {
        return ['city_id'];
    }
}