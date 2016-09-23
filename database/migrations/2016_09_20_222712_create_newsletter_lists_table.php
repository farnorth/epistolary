<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsletterListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('newsletter_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique()->index();
            $table->text('description')->nullable();
            $table->boolean('requires_opt_in')->default(true);
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
        Schema::drop('newsletter_lists');
    }
}
