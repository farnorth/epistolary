<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsletterCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('list_id')->index();
            $table->string('name');
            $table->string('subject');
            $table->text('description')->nullable();
            $table->boolean('is_scheduled')->default(false);
            $table->timestamp('scheduled_for')->nullable();
            $table->boolean('is_sent')->default(false);
            $table->timestamp('sent_at')->nullable();
            $table->json('attachments')->nullable();
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
        Schema::drop('newsletter_campaigns');
    }
}
