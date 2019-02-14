<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bar_features', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('bar_id')->unsigned();
            $table->foreign('bar_id')->references('id')->on('bars');
//            $table->integer('noise_level')->unsigned();
            $table->boolean('smoking');
            $table->boolean('food');
            $table->boolean('pet_friendly');
//            $table->boolean('bikes');
            $table->boolean('live_music');
//            $table->boolean('reservations');
            $table->boolean('tvs');
            $table->boolean('18+');
//            $table->boolean('kids');
            $table->boolean('patio');
            $table->boolean('pool');
            $table->boolean('darts');
            $table->boolean('games');
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
        Schema::drop('bar_features');
    }
}
