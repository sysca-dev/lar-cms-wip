<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('title');
          $table->dateTime('start_time');
          $table->integer('length')->nullable()->unsigned();
          $table->longText('description')->nullable();
          $table->longText('twitch_url')->nullable();
          $table->integer('hub_id')->nullable()->unsigned();
          $table->longText('image')->nullable();
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
        Schema::drop('events');
    }
}
