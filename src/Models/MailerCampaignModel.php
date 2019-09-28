<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailerCampaignModel extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailer_campaigns';
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
     * a campaign belongs to many a lists
     *
     * @class belongsToMany MailListModel
     */
    public function lists()
    {
        return $this->belongsToMany(MailListModel::class, 'mailer_campaign_mailer_list');
    }

    /**
     * a campaign belongs has many emails
     *
     * @class hasMany MailerEmailModel
     */
    public function emails()
    {
        return $this->hasMany(MailerEmailModel::class);
    }

    /**
     * a campaign belongs to an administrator
     *
     * @class belongsTo App\Models\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
