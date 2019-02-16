<?php

use Faker\Generator as Faker;

$factory->define(\App\Gameplan::class, function (Faker $faker) {

    return [
        'title' => $faker->catchPhrase,
        'date' => $faker->date('Y-m-d', '+ 1 year' ),
        'time' => $faker->time('H:i:s'),
        'description' => $faker->catchPhrase,
        'author_id' => mt_rand(1, \App\User::all()->count()),
    ];
});
