<?php

namespace Pilaster\Epistolary;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Campaign
 *
 * @property int $id
 * @property int $list_id
 * @property string $name
 * @property string $subject
 * @property string $description
 * @property array $attachments
 * @property boolean $is_scheduled
 * @property \Carbon\Carbon $scheduled_for
 * @property boolean $is_sent
 * @property \Carbon\Carbon $sent_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Campaign extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'newsletter_campaigns';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['scheduled_for', 'sent_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'list_id' => 'integer',
        'is_scheduled' => 'boolean',
        'is_sent' => 'boolean',
        'attachments' => 'json',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mailingList()
    {
        return $this->belongsTo(MailingList::class, 'list_id');
    }

    /**
     * Add uploaded attachment (file names) to the Campaign.
     *
     * @param array|string $attachments
     * @return $this
     */
    public function addAttachments($attachments)
    {
        $this->attachments = (array) $attachments;

        return $this;
    }

    public function attachmentPath($attachment = null)
    {
        return sprintf('%s/%s', config('epistolary.attachments.storage'), $attachment);
    }

    public function send()
    {
        $this->mailingList->sendCampaign($this);
    }
}
