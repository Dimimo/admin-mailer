<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
     * a list has many customers
     *
     * @class hasMany MailerCustomerModel
     */
    public function customers()
    {
        return $this->hasMany(MailerCustomerModel::class);
    }

    /**
     * a list belongs to many a campaigns
     *
     * @class belongsToMany MailerCampaignModel
     */
    public function campaigns()
    {
        return $this->belongsToMany(MailerCampaignModel::class, 'mailer_campaign_mailer_list');
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
