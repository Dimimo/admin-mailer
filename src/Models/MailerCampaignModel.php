<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Dimimo\AdminMailer\Models\MailerCampaignModel
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerEmailModel[] $emails
 * @property-read int|null $emails_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerListModel[] $lists
 * @property-read int|null $lists_count
 * @property-read \App\Models\User $owner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel withoutTrashed()
 * @mixin \Eloquent
 */
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
        return $this->belongsToMany(MailerListModel::class, 'mailer_campaign_mailer_list');
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
