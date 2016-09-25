<?php

use Illuminate\Database\Seeder;

class NewsletterCampaignsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\Pilaster\Epistolary\Campaign::class, 25)->create();
    }
}
