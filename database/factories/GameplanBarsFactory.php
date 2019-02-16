<?php

use Faker\Generator as Faker;

$factory->define(\App\GameplanBar::class, function (Faker $faker) {
    return [
        'bar_id' => mt_rand(1, \App\Bar::all()->count()),
        'gameplan_id' => mt_rand(1, \App\Gameplan::all()->count()),
    ];
});
