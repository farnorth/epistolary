<?php

namespace Pilaster\Epistolary;

use Carbon\Carbon;
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
 * @property int $sent_count
 * @property MailingList $mailingList
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
        'sent_count' => 'integer',
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
     * Set the name attributes, and ensure it is not a duplicate.
     *
     * @param string $value
     */
    public function setNameAttribute($value)
    {
        if (!isset($this->attributes['name']) || $this->attributes['name'] != $value) {
            $this->attributes['name'] = $this->getNonDuplicateName($value);
        }
    }

    /**
     * Get a name that is not a duplicate of an existing name.
     *
     * @param string $name
     * @return string
     */
    public function getNonDuplicateName($name)
    {
        $exists = self::nameExists($name);

        while ($exists) {
            preg_match('/^(?P<name>.+?)(?P<copy>\s+copy\s+(?P<num>\d+))?$/i', $name, $matches);
            $num = isset($matches['num']) ? $matches['num']+1 : 1;
            $name = sprintf('%s copy %d', $matches['name'], $num);
            $exists = self::nameExists($name);
        }

        return $name;
    }

    /**
     * Determine whether or not a name already exists.
     *
     * @param string $name
     * @return mixed
     */
    public static function nameExists($name)
    {
        return static::where('name', $name)->exists();
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

    /**
     * Get the full attachment path, optionally including the file name.
     *
     * @param string $attachment
     * @return string
     */
    public function attachmentPath($attachment = null)
    {
        return sprintf('%s/%s', config('epistolary.attachments.storage'), $attachment);
    }

    /**
     * Mark a campaign as sent.
     */
    public function markAsSent()
    {
        $this->is_sent = true;
        $this->sent_at = Carbon::now();
        $this->sent_count = $this->mailingList->getCurrentSubscriptions()->count();
        $this->save();
    }
}
