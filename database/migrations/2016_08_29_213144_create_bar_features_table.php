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
            $table->boolean('smoking')->default(0);
            $table->boolean('food')->default(0);
            $table->boolean('pet_friendly')->default(0);
//            $table->boolean('bikes');
            $table->boolean('live_music')->default(0);
//            $table->boolean('reservations');
            $table->boolean('tvs')->default(0);
            $table->boolean('18+')->default(0);
//            $table->boolean('kids');
            $table->boolean('patio')->default(0);
            $table->boolean('pool')->default(0);
            $table->boolean('darts')->default(0);
            $table->boolean('games')->default(0);
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
