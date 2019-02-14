<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoppersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoppers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('gameplan_id')->unsigned();
            $table->integer('hopper_id')->unsigned();
            $table->timestamps();
            $table->foreign('gameplan_id')->references('id')->on('gameplans');
            $table->foreign('hopper_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hoppers');
    }
}
