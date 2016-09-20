<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('newsletter_id')->index();
            $table->unsignedInteger('subscriber_id')->index();
            $table->boolean('unsubscribed')->default(false);
            $table->timestamp('unsubscribed_at')->nullable();
            $table->unsignedInteger('unsubscribed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('newsletter_subscriptions');
    }
}
