<?php

namespace Pilaster\Console;

use Illuminate\Console\Command;

class SendScheduledEmailsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'newsletter:send-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send all the scheduled emails.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // TODO: Implement send scheduled emails
    }
}
