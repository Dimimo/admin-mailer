<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailerEmailModel extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailer_emails';
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
     * a email belongsTo a campaign
     *
     * @class belongsTo MailerCampaignModel
     */
    public function campaign()
    {
        return $this->belongsTo(MailerCampaignModel::class);
    }

    /**
     * an email belongs to an administrator
     *
     * @class belongsTo App\Models\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
