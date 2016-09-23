<?php

namespace Pilaster\Newsletters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscriber
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $newsletters
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Subscriber extends Model
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
    protected $table = 'newsletter_subscribers';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function newsletters()
    {
        return $this->belongsToMany(MailingList::class, 'newsletter_subscriptions', 'list_id')
            ->withPivot(['unsubscribed', 'unsubscribed_at', 'unsubscribed_by'])
            ->withTimestamps();
    }

    /**
     * Update the subscriber's subscriptions.
     *
     * @param $subscriptions
     */
    public function updateSubscriptions($subscriptions)
    {
        collect($subscriptions)->each(function (Subscription $subscription) {
            $this->subscriptions()->save($subscription);
        });
    }
}
