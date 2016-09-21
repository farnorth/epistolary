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
class MailingList extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'newsletter_lists';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id', 'updated_at', 'created_at'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'requires_opt_in' => 'boolean',
    ];

    /**
     * Get a newsletter by its slug.
     *
     * @param string $newsletter_slug
     * @return Newsletter
     */
    public static function getBySlug($newsletter_slug)
    {
        return static::where('slug', $newsletter_slug)->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function campaigns()
    {
        return $this->hasMany(Campaign::class, 'list_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'list_id');
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
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCurrentSubscribers()
    {
        $query = $this->subscriptions();

        if ($this->requires_opt_in) {
            $query->where('opted_in', true);
        }

        return $query->with('subscribers')
            ->get()
            ->subscribers;
    }
}
