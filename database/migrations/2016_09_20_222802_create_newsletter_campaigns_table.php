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
            $table->unsignedInteger('newsletter_id')->index();
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->timestamp('send_at')->nullable();
            $table->boolean('sent')->default(false);
            $table->timestamp('sent_at')->nullable();
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
