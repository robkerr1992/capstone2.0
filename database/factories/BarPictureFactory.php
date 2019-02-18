<?php

use Faker\Generator as Faker;

$factory->define(\App\Picture::class, function (Faker $faker) {
    return [
        'bar_id' => 25,
        'pic_url' => '/img/bar.jpg'
    ];
});
