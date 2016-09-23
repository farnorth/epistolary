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
            $table->uuid('id')->primary();
            $table->unsignedInteger('list_id')->index();
            $table->uuid('subscriber_id')->index();
            $table->boolean('opted_in')->default(false);
            $table->timestamp('opted_in_at')->nullable();
            $table->softDeletes();
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
