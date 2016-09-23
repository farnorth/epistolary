<?php

namespace Pilaster\Newsletters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;

/**
 * Class Newsletter
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $from_email
 * @property string $from_name
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
     * @param string $list_slug
     * @return MailingList
     */
    public static function getBySlug($list_slug)
    {
        return static::where('slug', $list_slug)->first();
    }

    /**
     * Get a list by its ID or slug.
     *
     * @param int|string $list
     * @return \Pilaster\Newsletters\MailingList
     */
    public static function getList($list)
    {
        if (is_numeric($list)) {
            return static::find($list);
        }

        return static::getBySlug($list);
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
     * Send a campaign to its subscribers.
     *
     * @param \Pilaster\Newsletters\Campaign $campaign
     * @return bool
     */
    public function sendCampaign(Campaign $campaign)
    {
        $to = $this->getMessageToList();

        if (empty($to)) {
            return false;
        }

        Mail::send('newsletters::emails.default', ['campaign' => $campaign], function (Message $message) use ($to, $campaign) {
            $message->to($to);
            if ($this->from_email) {
                $message->from($this->from_email, $this->from_name);
            }
            $message->subject($campaign->subject);
            foreach ($campaign->attachments as $attachment) {
                $message->attach($campaign->attachmentPath($attachment));
            }
        });

        return true;
    }

    /**
     * Get an array of subscribers for the Message::to() method.
     *
     * @return array
     */
    public function getMessageToList()
    {
        return $this->getCurrentSubscriptions()->reject(function ($subscription) {
            return empty($subscription->subscriber);
        })->flatMap(function ($subscription) {
            $subscriber = $subscription->subscriber;
            return [$subscriber->email => trim($subscriber->first_name.' '.$subscriber->last_name)];
        })->toArray();
    }

    /**
     * Get all the currently subscribed members of this list. This
     * excludes unsubscribed members (obviously), and if required,
     * members who have not opted in.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCurrentSubscriptions()
    {
        $query = $this->subscriptions();

        if ($this->requires_opt_in) {
            $query->where('opted_in', true);
        }

        return $query->with('subscriber')->get();
    }
}
