<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Models;

use Illuminate\Database\Eloquent\Builder;

/**
 * Dimimo\AdminMailer\Models\LaratablesCustomers
 *
 * @property int                                                                                       $id
 * @property string                                                                                    $uuid
 * @property string                                                                                    $name
 * @property string                                                                                    $email
 * @property int|null                                                                                  $mailer_list_id
 * @property string|null                                                                               $real_name
 * @property \Illuminate\Support\Carbon|null                                                           $unsubscribed_at
 * @property int                                                                                       $accepts_mail
 * @property int                                                                                       $reads_mail
 * @property string|null                                                                               $url
 * @property string|null                                                                               $wikipedia
 * @property string|null                                                                               $facebook
 * @property int|null                                                                                  $user_id
 * @property int|null                                                                                  $site_id
 * @property int|null                                                                                  $service_id
 * @property int|null                                                                                  $city_id
 * @property \Illuminate\Support\Carbon|null                                                           $created_at
 * @property \Illuminate\Support\Carbon|null                                                           $updated_at
 * @property \Illuminate\Support\Carbon|null                                                           $deleted_at
 * @property-read \App\Models\City|null                                                                $city
 * @property-read MailerListModel|null                                      $list
 * @property-read \Illuminate\Database\Eloquent\Collection|MailerLogModel[] $logs
 * @property-read int|null                                                                             $logs_count
 * @property-read \App\Models\ServiceCategory|null                                                     $service
 * @property-read \App\Models\Site|null                                                                $site
 * @property-read \App\Models\User|null                                                                $user
 * @method static Builder|LaratablesCustomers newModelQuery()
 * @method static Builder|LaratablesCustomers newQuery()
 * @method static Builder|LaratablesCustomers query()
 * @method static Builder|LaratablesCustomers whereAcceptsMail($value)
 * @method static Builder|LaratablesCustomers whereCityId($value)
 * @method static Builder|LaratablesCustomers whereCreatedAt($value)
 * @method static Builder|LaratablesCustomers whereDeletedAt($value)
 * @method static Builder|LaratablesCustomers whereEmail($value)
 * @method static Builder|LaratablesCustomers whereFacebook($value)
 * @method static Builder|LaratablesCustomers whereId($value)
 * @method static Builder|LaratablesCustomers whereMailerListId($value)
 * @method static Builder|LaratablesCustomers whereName($value)
 * @method static Builder|LaratablesCustomers whereReadsMail($value)
 * @method static Builder|LaratablesCustomers whereRealName($value)
 * @method static Builder|LaratablesCustomers whereServiceId($value)
 * @method static Builder|LaratablesCustomers whereSiteId($value)
 * @method static Builder|LaratablesCustomers whereUnsubscribedAt($value)
 * @method static Builder|LaratablesCustomers whereUpdatedAt($value)
 * @method static Builder|LaratablesCustomers whereUrl($value)
 * @method static Builder|LaratablesCustomers whereUserId($value)
 * @method static Builder|LaratablesCustomers whereUuid($value)
 * @method static Builder|LaratablesCustomers whereWikipedia($value)
 * @mixin \Eloquent
 */
class LaratablesCustomers extends MailerCustomerModel
{
    //https://github.com/freshbitsweb/laratables

    public static function laratablesQueryConditions(LaratablesCustomers $query)
    {
        $query = $query
            ->selectRaw('
            mailer_customers.id,
            mailer_customers.name AS customer_name,
            mailer_customers.email,
            mailer_customers.mailer_list_id,
            mailer_customers.accepts_mail,
            mailer_customers.reads_mail,
            mailer_customers.url,
            mailer_customers.city_id,
            mailer_customers.deleted_at,
            cities.name AS city_name')
            ->with(['city', 'list'])
            ->join('cities', 'mailer_customers.city_id', '=', 'cities.id');
        if (request('mailer_list_id'))
        {
            return $query->whereIn('mailer_list_id', request('mailer_list_id'));
        }
        return $query;
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel  $customer
     *
     * @return string
     * @throws \Throwable
     */
    public static function laratablesCustomerName($customer)
    {
        return view('admin-mailer::customers.includes._name', compact('customer'))->render();
    }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param Builder  $query
     * @param string search term
     * @return Builder
     */
    public static function laratablesSearchCustomerName(Builder $query, $searchValue)
    {
        return $query->orWhere('mailer_customers.name', 'like', "%{$searchValue}%");
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel  $customer
     *
     * @return string
     * @throws \Throwable
     */
    public static function laratablesEmail($customer)
    {
        return view('admin-mailer::customers.includes._email', compact('customer'))->render();
    }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param Builder  $query
     * @param string search term
     * @return Builder
     */
    public static function laratablesSearchEmail(Builder $query, $searchValue)
    {
        return $query->orWhere('mailer_customers.email', 'like', "%{$searchValue}%");
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel  $customer
     *
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
     * @param MailerCustomerModel  $customer
     *
     * @return string|null
     * @throws \Throwable
     */
    public static function laratablesCityName(MailerCustomerModel $customer)
    {
        /*if ($customer->city)
        {
            return $customer->city->name;
        }
        return '';*/
        return $customer->city->name;
    }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param Builder  $query
     * @param string search term
     *
     * @return Builder
     */
    public static function laratablesSearchCityName(Builder $query, $searchValue)
    {
        return $query->orWhere('cities.name', 'like', "%{$searchValue}%");
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param MailerCustomerModel  $customer
     *
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
     * @param MailerCustomerModel  $customer
     *
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
     * @param MailerCustomerModel  $customer
     *
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
     * @param MailerCustomerModel  $customer
     *
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
        return 'customer_name';
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['customer_name', 'city_name'];
    }
}