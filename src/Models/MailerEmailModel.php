<?php

namespace Dimimo\AdminMailer\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Dimimo\AdminMailer\Models\MailerEmailModel
 *
 * @property int $id
 * @property string $title
 * @property string|null $body
 * @property int $mailer_campaign_id
 * @property int $draft
 * @property \Illuminate\Support\Carbon|null $send_datetime
 * @property int $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Dimimo\AdminMailer\Models\MailerCampaignModel $campaign
 * @property-read \Illuminate\Database\Query\Builder $unsubscribed
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerLogModel[] $logs
 * @property-read int|null $logs_count
 * @property-read \App\Models\User $owner
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel newQuery()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereDraft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereMailerCampaignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereSendDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\Dimimo\AdminMailer\Models\MailerEmailModel withoutTrashed()
 * @mixin \Eloquent
 */
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'read_datetime',
    ];
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
    protected $with = ['campaign', 'owner'];

    /**
     * Checks if all emails in a campaign has been send out
     * This is from importance if the process to send out the
     * emails had been interrupted in some way
     *
     * @return bool
     */
    public function completed() {
        return MailerLogModel::where([['mailer_email_id', '=', $this->id], ['is_send', '=', '1']])->count()
            == MailerCampaignModel::find($this->campaign->id)->all_customers_id->count();
    }

    /**
     * Returns the collection of all customers that have unsubscribed on a given emails that has been send out
     *
     * @return \Illuminate\Database\Query\Builder
     */
    public function getUnsubscribedAttribute() {
        return MailerCustomerModel
            ::join('mailer_logs', 'mailer_customers.id', '=', 'mailer_logs.mailer_customer_id')
            ->join('mailer_emails', 'mailer_logs.mailer_email_id', '=', 'mailer_emails.id')
            ->where('mailer_emails.id', '=', $this->id)
            ->where('mailer_customers.accepts_mail', '=', '0');
    }

    /**
     * a email belongsTo a campaign
     *
     * @class belongsTo MailerCampaignModel
     */
    public function campaign()
    {
        return $this->belongsTo(MailerCampaignModel::class, 'mailer_campaign_id', 'id');
    }

    /**
     * a email has many log inputs (only when send)
     *
     * @class hasMany MailerLogModel
     */
    public function logs() {
        return $this->hasMany(MailerLogModel::class, 'mailer_email_id', 'id');
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
