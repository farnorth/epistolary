<?php

namespace Pilaster\Newsletters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscription
 *
 * @property string $id
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
    use Uuids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'newsletter_susbcriptions';

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
    protected $dates = ['opted_in_at', 'unsubscribed_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
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
}
