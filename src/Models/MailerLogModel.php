<?php
/**
 *
 *  Copyright (c) 2019. Puerto Parrot Booklet. Written by Dimitri Mostrey for www.puertoparrot.com
 *  Contact me at admin@puertoparrot.com or dmostrey@yahoo.com
 *
 */

namespace Dimimo\AdminMailer\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * Dimimo\AdminMailer\Models\MailerLogModel
 *
 * @property int                                                 $id
 * @property string                          $uuid
 * @property int                             $mailer_customer_id
 * @property int                             $mailer_email_id
 * @property \Illuminate\Support\Carbon|null $read_datetime
 * @property int|null                        $is_send
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read MailerCustomerModel        $customer
 * @property-read MailerEmailModel           $email
 * @method static Builder|MailerLogModel newModelQuery()
 * @method static Builder|MailerLogModel newQuery()
 * @method static Builder|MailerLogModel opened()
 * @method static Builder|MailerLogModel query()
 * @method static Builder|MailerLogModel whereCreatedAt($value)
 * @method static Builder|MailerLogModel whereId($value)
 * @method static Builder|MailerLogModel whereIsSend($value)
 * @method static Builder|MailerLogModel whereMailerCustomerId($value)
 * @method static Builder|MailerLogModel whereMailerEmailId($value)
 * @method static Builder|MailerLogModel whereReadDatetime($value)
 * @method static Builder|MailerLogModel whereUpdatedAt($value)
 * @method static Builder|MailerLogModel whereUuid($value)
 * @mixin \Eloquent
 */
class MailerLogModel extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailer_logs';

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
    protected $casts = ['read_datetime' => 'datetime'];
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
     * @param $query
     *
     * @return Builder
     */
    public function scopeOpened($query)
    {
        /** @var Builder $query */
        return $query->whereNotNull('read_datetime');
    }

    /**
     * a log belongsTo a customer
     *
     * @class belongsTo MailerCustomerModel
     */
    public function customer()
    {
        return $this->belongsTo(MailerCustomerModel::class, 'mailer_customer_id', 'id');
    }

    /**
     * a log belongsTo an email
     *
     * @class belongsTo MailerEmailModel
     */
    public function email()
    {
        return $this->belongsTo(MailerEmailModel::class, 'mailer_email_id', 'id');
    }
}
