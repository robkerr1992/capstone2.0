<?php

use Illuminate\Support\Facades\Schema;
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
			$table->integer('bar_id')->unsigned();
			$table->foreign('bar_id')->references('id')->on('bars');
			$table->string('title');
			$table->string('date');
			$table->string('content');
			$table->string('event_pic')->default('https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg')->nullable();
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
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
