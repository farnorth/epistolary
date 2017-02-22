<?php

namespace Pilaster\Epistolary\Jobs;

use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Mail\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Pilaster\Epistolary\MailingList;
use Pilaster\Epistolary\Events\ListSent;

class AddListToESP extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $list;

    /**
     * Create a new job instance.
     *
     * @param \Pilaster\Epistolary\MailingList $list
     */
    public function __construct(MailingList $list)
    {
        $this->list = $list;
    }

    public function handle()
    {
        if (config('mail.driver') === 'mailgun') {
            
        }
        Mailgun::api()->post("lists", [
            'address'      => 'developers@example.com',
            'name'         => 'Developers',
            'description'  => 'Developers Mailing List',
            'access_level' => 'readonly'
        ]);

        //event(new ListSent($this->list));
    }
}
