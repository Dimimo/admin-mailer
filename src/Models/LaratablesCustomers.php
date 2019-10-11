<?php


namespace Dimimo\AdminMailer\Models;

/**
 * Dimimo\AdminMailer\Models\LaratablesCustomers
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $email
 * @property int|null $mailer_list_id
 * @property string|null $real_name
 * @property int $accepts_mail
 * @property int $reads_mail
 * @property string|null $url
 * @property string|null $wikipedia
 * @property string|null $facebook
 * @property int|null $user_id
 * @property int|null $site_id
 * @property int|null $service_id
 * @property int|null $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\City|null $city
 * @property-read \Dimimo\AdminMailer\Models\MailerListModel|null $list
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerLogModel[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\ServiceCategory|null $service
 * @property-read \App\Models\Site|null $site
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereAcceptsMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereMailerListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereReadsMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\LaratablesCustomers whereWikipedia($value)
 * @mixin \Eloquent
 */
class LaratablesCustomers extends MailerCustomerModel
{
    //https://github.com/freshbitsweb/laratables

    public static function laratablesQueryConditions($query) {
        if (request('mailer_list_id')) {
            return $query->whereIn('mailer_list_id', request('mailer_list_id'));
        }
        return $query;
    }

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