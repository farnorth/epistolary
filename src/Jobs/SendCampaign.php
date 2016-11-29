<?php

namespace Pilaster\Epistolary\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pilaster\Epistolary\Campaign;
use Pilaster\Epistolary\Events\CampaignSent;

class SendCampaign extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $campaign;

    /**
     * Create a new job instance.
     *
     * @param \Pilaster\Epistolary\Campaign $campaign
     */
    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @param \Illuminate\Contracts\Mail\Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
        $recipients = $this->getMessageRecipients();

        if (count($recipients) > 0) {
            // Send it!
            $mailer->send('epistolary::emails.default', ['campaign' => $this->campaign],
                function (Message $message) use ($recipients) {
                    $message->bcc($recipients);
                    $message->subject($this->campaign->subject);
                    $this->setMessageSender($message);
                    $this->setMessageAttachments($message);
                    $this->setMessageTags($message);
                });
        }

        $this->campaign->markAsSent();

        event(new CampaignSent($this->campaign));
    }

    /**
     * Get an array of subscribers for the Message::to() method.
     *
     * @return array
     */
    private function getMessageRecipients()
    {
        return $this->campaign->mailingList->getCurrentSubscriptions()->reject(function ($subscription) {
            return empty($subscription->subscriber);
        })->flatMap(function ($subscription) {
            $subscriber = $subscription->subscriber;
            return [$subscriber->email => trim($subscriber->first_name.' '.$subscriber->last_name)];
        })->toArray();
    }

    /**
     * Assign the message "from" parameter.
     *
     * @param \Illuminate\Mail\Message $message
     */
    private function setMessageSender(Message $message)
    {
        if ($this->campaign->mailingList->from_email) {
            $message->from($this->campaign->mailingList->from_email, $this->campaign->mailingList->from_name);
        }
    }

    /**
     * Assign message attachments.
     *
     * @param \Illuminate\Mail\Message $message
     */
    private function setMessageAttachments(Message $message)
    {
        collect($this->campaign->attachments)->each(function ($attachment) use ($message) {
            $message->attach($this->campaign->attachmentPath($attachment));
        });
    }

    /**
     * Tag the message
     * @param Message $message
     */
    private function setMessageTags(Message $message)
    {
        if (config('mail.driver') === 'mailgun') {
            $headers = $message->getHeaders();
            $headers->addTextHeader('X-Mailgun-Tag', $this->campaign->mailingList->slug);
            $headers->addTextHeader('X-Mailgun-Tag', str_slug($this->campaign->name));
        }
    }
}
