<?php

use Faker\Generator as Faker;

$factory->define(\App\Hopper::class, function (Faker $faker) {
    return [
        'hopper_id' => mt_rand(1, \App\User::all()->count()),
        'gameplan_id' => mt_rand(1, \App\Gameplan::all()->count()),
    ];
});
