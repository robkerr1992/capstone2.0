<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'content' => $faker->catchPhrase,
        'created_by' => mt_rand(1, \App\User::all()->count()),
        'beer_rating' => mt_rand(1,5),
        'bar_id' => mt_rand(1, \App\Bar::all()->count()),

    ];
});
