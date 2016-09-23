<?php

use Illuminate\Database\Seeder;

class NewsletterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(NewsletterListsTableSeeder::class);
        $this->call(NewsletterCampaignsTableSeeder::class);
        $this->call(NewsletterSubscribersTableSeeder::class);
    }
}
