<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\City;
use App\Models\ServiceCategory;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MailerCustomerModel
 * @package Dimimo\AdminMailer\Models
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
        return $this->belongsTo(MailListModel::class);
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
        return $this->hasMany(MailerLogModel::class);
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
