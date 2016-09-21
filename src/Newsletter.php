<?php

namespace Pilaster\Newsletters;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Newsletter
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property boolean $requires_opt_in
 * @property \Illuminate\Database\Eloquent\Collection $campaigns
 * @property \Illuminate\Database\Eloquent\Collection $subscriptions
 * @property \Illuminate\Database\Eloquent\Collection $subscribers
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Newsletter extends Model
{
    protected $casts = [
        'requires_opt_in' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function subscribers()
    {
        return $this->hasManyThrough(Subscriber::class, Subscription::class);
    }

    /**
     * Get all the currently subscribed members of this newsletter. This
     * excludes unsubscribed members (obviously), and if required,
     * members who have not opted in.
     *
     * @return mixed
     */
    public function getCurrentSubscribers()
    {
        $query = $this->subscriptions()->where('unsubscribed', false);

        if ($this->requires_opt_in) {
            $query->where('opted_in', true);
        }

        return $query->with('subscribers')
            ->get()
            ->subscribers;
    }
}
