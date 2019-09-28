<?php

namespace Dimimo\AdminMailer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailerLogModel extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailer_logs';
    /**
     * @var array
     */
    protected $casts = ['real_datetime' => 'datetime'];
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
     * a log belongsTo a customer
     *
     * @class belongsTo MailerCustomerModel
     */
    public function customer()
    {
        return $this->belongsTo(MailerCustomerModel::class);
    }

    /**
     * a log belongsTo an email
     *
     * @class belongsTo MailerEmailModel
     */
    public function email()
    {
        return $this->belongsTo(MailerEmailModel::class);
    }
}
