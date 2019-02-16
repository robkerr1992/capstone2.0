<?php

use Faker\Generator as Faker;

$factory->define(\App\Event::class, function (Faker $faker) {
    return [
        'title' => $faker->catchPhrase,
        'date' => $faker->dateTimeInInterval('now', '+ 10 days'),
        'content' => $faker->catchPhrase,
        'created_by' => mt_rand(1, \App\User::all()->count()),
        'bar_id' => mt_rand(1, \App\Bar::all()->count()),
    ];
});
