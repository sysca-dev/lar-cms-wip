<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forums', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('category_id')->unsigned()->index();
          $table->integer('forum_id')->unsigned()->nullable();
          $table->string('title');
          $table->string('description')->nullable();
          $table->integer('order');
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
        Schema::drop('forums');
    }
}
