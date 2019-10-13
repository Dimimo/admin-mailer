<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Models;

use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Dimimo\AdminMailer\Models\MailerCustomerModel
 *
 * @property int                                                                                       $id
 * @property string                                                                                    $uuid
 * @property string                                                                                    $name
 * @property string                                                                                    $email
 * @property int|null                                                                                  $mailer_list_id
 * @property string|null                                                                               $real_name
 * @property int                                                                                       $accepts_mail
 * @property int                                                                                       $reads_mail
 * @property string|null                                                                               $url
 * @property string|null                                                                               $wikipedia
 * @property string|null                                                                               $facebook
 * @property int|null                                                                                  $user_id
 * @property int|null                                                       $site_id
 * @property int|null                                                       $service_id
 * @property int|null                                                       $city_id
 * @property \Illuminate\Support\Carbon|null                                $created_at
 * @property \Illuminate\Support\Carbon|null                                $updated_at
 * @property \Illuminate\Support\Carbon|null                                $deleted_at
 * @property-read City|null                                                 $city
 * @property-read MailerListModel|null                                      $list
 * @property-read \Illuminate\Database\Eloquent\Collection|MailerLogModel[] $logs
 * @property-read int|null                                                  $logs_count
 * @property-read ServiceCategory|null                                      $service
 * @property-read Site|null                                                 $site
 * @property-read User|null                                                 $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|MailerCustomerModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereAcceptsMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereMailerListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereReadsMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MailerCustomerModel whereWikipedia($value)
 * @method static \Illuminate\Database\Query\Builder|MailerCustomerModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|MailerCustomerModel withoutTrashed()
 * @mixin \Eloquent
 */
class MailerCustomerModel extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailer_customers';
    /**
     * @var array
     */
    protected $casts = [];
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['list'];

    /**
     * a customer belongsTo a list
     *
     * @class belongsTo MailListModel
     */
    public function list()
    {
        return $this->belongsTo(MailerListModel::class, 'mailer_list_id', 'id');
    }

    /**
     * a customer belongs to a registered user
     *
     * @class belongsTo App\Models\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * a customer has many a logs
     *
     * @class hasMany MailLogModel
     */
    public function logs()
    {
        return $this->hasMany(MailerLogModel::class, 'mailer_customer_id', 'id');
    }

    /**
     * a customer belongs to a city
     *
     * @class belongsTo App\Models\City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * a customer belongs to a site
     *
     * @class belongsTo App\Models\Site
     */
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    /**
     * a customer belongs to a city service
     *
     * @class belongsTo App\Models\Service
     */
    public function service()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
