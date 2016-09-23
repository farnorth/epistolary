<?php

namespace Pilaster\Newsletters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Subscription
 *
 * @property string $id
 * @property int $list_id
 * @property string $subscriber_id
 * @property string $description
 * @property boolean $opted_in
 * @property \Carbon\Carbon $opted_in_at
 * @property \Illuminate\Database\Eloquent\Model $newsletter
 * @property \Illuminate\Database\Eloquent\Model $subscriber
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Subscription extends Model
{
    use Uuids, SoftDeletes;

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
    protected $table = 'newsletter_subscriptions';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'deleted_at', 'updated_at', 'created_at'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['opted_in_at', 'deleted_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'list_id' => 'integer',
        'opted_in' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function newsletter()
    {
        return $this->belongsTo(MailingList::class, 'list_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class);
    }
}
