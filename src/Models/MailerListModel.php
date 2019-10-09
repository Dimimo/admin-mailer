<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Dimimo\AdminMailer\Models\MailerListModel
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerCampaignModel[] $campaigns
 * @property-read int|null $campaigns_count
 * @property-read \App\Models\City|null $city
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerCustomerModel[] $customers
 * @property-read int|null $customers_count
 * @property-read \App\Models\User $owner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerListModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerListModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerListModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerListModel withoutTrashed()
 * @mixin \Eloquent
 */
class MailerListModel extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailer_lists';

    /**
     * @var array
     */
    protected $casts = ['send_datetime' => 'datetime'];

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
    protected $with = ['city'];
    /**
     * The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [];

    /**
     * a list has many customers
     *
     * @class hasMany MailerCustomerModel
     */
    public function customers()
    {
        return $this->hasMany(MailerCustomerModel::class, 'mailer_list_id', 'id');
    }

    /**
     * a list belongs to many a campaigns
     *
     * @class belongsToMany MailerCampaignModel
     */
    public function campaigns()
    {
        return $this->belongsToMany(
            MailerCampaignModel::class,
            'mailer_campaign_mailer_list',
            'mailer_list_id',
            'mailer_campaign_id'
        );
    }

    /**
     * a list belongs to an administrator
     *
     * @class belongsTo App\Models\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * a list belongs to a city
     *
     * @class belongsTo App\Models\City
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
