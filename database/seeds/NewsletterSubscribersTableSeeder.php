<?php

use Illuminate\Database\Seeder;

class NewsletterSubscribersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lists = \Pilaster\Epistolary\MailingList::all();
        if ($lists->isEmpty()) {
            $lists = factory(\Pilaster\Epistolary\MailingList::class, 5)->create();
        }

        factory(\Pilaster\Epistolary\Subscriber::class, 50)->create()->each(function ($subscriber)  use ($lists) {
            factory(\Pilaster\Epistolary\Subscription::class, 2)->create(['subscriber_id' => $subscriber->id]);
        });
    }
}
