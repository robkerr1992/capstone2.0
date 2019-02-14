<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameplans', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('author_id')->unsigned();
            $table->date('date');
            $table->string('title');
            $table->string('description');
            $table->time('time');
            $table->timestamps();
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('gameplans');
    }
}
