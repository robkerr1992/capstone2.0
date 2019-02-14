<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameplanbarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameplanbars', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('gameplan_id')->unsigned();
            $table->integer('bar_id')->unsigned();
            $table->timestamps();
            $table->foreign('gameplan_id')->references('id')->on('gameplans');
            $table->foreign('bar_id')->references('id')->on('bars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gameplanbars');
    }
}
