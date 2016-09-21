<?php

namespace Pilaster\Newsletters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 *
 * @property int $id
 * @property int $newsletter_id
 * @property int $subscriber_id
 * @property string $description
 * @property boolean $opted_in
 * @property \Carbon\Carbon $opted_in_at
 * @property boolean $unsubscribed
 * @property \Carbon\Carbon $unsubscribed_at
 * @property int $unsubscribed_by
 * @property \Illuminate\Database\Eloquent\Model $newsletter
 * @property \Illuminate\Database\Eloquent\Model $subscriber
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Subscription extends Model
{
    protected $table = 'newsletter_susbcriptions';

    protected $dates = ['opted_in_at', 'unsubscribed_at'];

    protected $casts = [
        'newsletter_id' => 'integer',
        'subscriber_id' => 'integer',
        'unsubscribed_by' => 'integer',
        'unsubscribed' => 'boolean',
        'opted_in' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCurrent($query)
    {
        return $query->where('unsubscribed', false);
    }
}