<?php

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
 * @property int $id
 * @property string $name
 * @property string $email
 * @property int|null $mailer_list_id
 * @property string|null $real_name
 * @property int|null $user_id
 * @property string $uuid
 * @property int|null $site_id
 * @property int|null $service_id
 * @property int $accepts_mail
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
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereAcceptsMail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereMailerListId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel whereUuid($value)
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerCustomerModel withoutTrashed()
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
