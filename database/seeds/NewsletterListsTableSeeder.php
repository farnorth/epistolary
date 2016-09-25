<?php

use Illuminate\Database\Seeder;

class NewsletterListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Pilaster\Epistolary\MailingList::class, 5)->create();
    }
}
