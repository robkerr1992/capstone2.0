<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'content' => $faker->sentence,
        'created_by' => function () {
            return factory(App\User::class)->create()->id;
        },
        'beer_rating' => mt_rand(1,5),
        'bar_id' => mt_rand(1, \App\Bar::all()->count()),

    ];
});
