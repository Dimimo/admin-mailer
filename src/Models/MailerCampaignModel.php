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
 * @property int $owner_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Dimimo\AdminMailer\Models\MailerEmailModel[] $emails
 * @property-read int|null $emails_count
 * @property-read mixed $all_customers
 * @property-read mixed $uuid_customers
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
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Dimimo\AdminMailer\Models\MailerCampaignModel whereUpdatedAt($value)
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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
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
    protected $with = ['owner'];

    /**
     * Checks if the list option is selected
     * This can be a value already in the database OR an old selection returned after a request validation fail
     *
     * @param integer $id
     * @return bool
     */
    public function optionListed($id)
    {
        if (old('lists')) {
            in_array($id, old('lists'));
        }
        return $this->lists->where('id', $id)->count() > 0;
    }

    /**
     * Checks which campaign->id is linked to this email
     * This can be a value already in the database OR an old selection returned after a request validation fail
     *
     * @param integer $id
     * @param MailerEmailModel $email
     * @return bool
     */
    public function optionEmail($id, MailerEmailModel $email)
    {
        if (old('mailer_campaign_id')) {
            return $id == old('mailer_campaign_id');
        }
        return $email->mailer_campaign_id === $id;
    }

    /**
     * Return an array of all customer uuids connected to a Campaign
     * @return \Illuminate\Support\Collection
     */
    public function getUuidCustomersAttribute()
    {
        return MailerCustomerModel
            ::join('mailer_lists', 'mailer_lists.id', '=', 'mailer_customers.mailer_list_id')
            ->join('mailer_campaign_mailer_list', 'mailer_campaign_mailer_list.mailer_list_id', '=', 'mailer_lists.id')
            ->join('mailer_campaigns', 'mailer_campaign_mailer_list.mailer_campaign_id', '=', 'mailer_campaigns.id')
            ->where('mailer_campaigns.id', '=', $this->id)
            ->where('mailer_customers.accepts_mail', '=', '1')
            ->pluck('uuid');
    }

    /**
     * Return a collection of all customers in a Campaign
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllCustomersAttribute()
    {
        $uuids = $this->uuid_customers;
        if (App()->environment() === 'local') {
            return MailerCustomerModel::whereIn('uuid', $uuids)->limit(1)->get();
        }

        return MailerCustomerModel::whereIn('uuid', $uuids)->get();
    }

    /**
     * a campaign belongs to many a lists
     *
     * @class belongsToMany MailListModel
     */
    public function lists()
    {
        return $this->belongsToMany(
            MailerListModel::class,
            'mailer_campaign_mailer_list',
            'mailer_campaign_id',
            'mailer_list_id');
    }

    /**
     * a campaign belongs has many emails
     *
     * @class hasMany MailerEmailModel
     */
    public function emails()
    {
        return $this->hasMany(MailerEmailModel::class, 'mailer_campaign_id', 'id');
    }

    /**
     * a campaign belongs to an administrator
     *
     * @class belongsTo App\Models\User
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }
}
