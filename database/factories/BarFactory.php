<?php

use Faker\Generator as Faker;
$image = '/img/bar.jpg';
$barsArray = [
    ['Cross-Eyed Seagull', '19141 Stone Oak Pkwy # 206, San Antonio, TX 78258', '2105453440', 'http://crosseyedseagull.clarksbars.com/', '/img/cross-eyed-seagull.jpg'],
    ['Chicago Bar', '19141 Stone Oak Pkwy # 505, San Antonio, TX 78258', '2104945558', '', $image],
    ['Social House', '19160 Stone Oak Pkwy #104, San Antonio, TX 78258', '2103630677', '', $image],
    ['Nektar Lounge', '19239 Stone Oak Pkwy #110, San Antonio, TX 78258', '2108335370', 'nektarlounge.com', $image],
    ['Copa Wine Bar', '19141 Stone Oak Pkwy Suite 704, San Antonio, TX 78258', '2104952672', 'thecopawinebar.com', $image],
    ['Garden Bistro Bar', '18360 Blanco Rd #100, San Antonio, TX 78258', '2102908484', '', $image],
    ['Kennedy\'s Public House', '19179 Blanco Rd, San Antonio, TX 78258', '2107641333', 'kennedysirishbar.com', $image],
    ['The Angry Elephant', '19314 US-281 #107, San Antonio, TX 78259', '2105453782', 'theangryelephant.com', $image],
    ['The Green Lantern', '20626 Stone Oak Pkwy #101, San Antonio, TX 78258', '2104973722', '', $image],
    ['Sinatra\'s San Antonio', '1846 North Loop 1604 W, San Antonio, TX 78248', '2104799600', '', $image],
    ['New Orleans Bar', '226 W Bitters Rd, San Antonio, TX 78216', '2104032846', '', $image],
    ['Zombies Bar and Music Venue', '4202 Thousand Oaks, San Antonio, TX 78217', '2102818306', 'zombiesliveinsa.com', $image],
    ['502 Bar', 'Embassy Oaks Shopping Center, 502 Embassy Oaks, San Antonio, TX 78216', '2102578125', '502bar.com', $image],
    ['Espana Bar de Tapas', '5638 W Hausman Rd, San Antonio, TX 78249', '2106904433', 'espanabar.com', $image],
    ['Tonic Bar', 'Northgate Village Shopping Center, 5500 Babcock Rd #117, San Antonio, TX 78240', '2108775858', 'tonicthebar.com', $image],
    ['Shenanygans', '6422 Babcock Rd, San Antonio, TX 78249', '2106901156', 'shenanygans.com', $image],
    ['Cooter Browns Saloon', '11881 Bandera Rd, San Antonio, TX 78023', '2102631852', 'cooterbrownssaloon-tx.com', $image],
    ['Doc Browns', '6511 W Loop 1604 N, San Antonio, TX 78254', '2109737090', '', $image],
    ['Stetson Bar', '7350 Tezel Rd # 108, San Antonio, TX 78250', '2105235338', '', $image],
    ['Flying Saucer', 'The Strand at Huebner Oaks, 11255 Huebner Rd #212, San Antonio, TX 78230', '2106965080', 'beerknurd.com', $image],
    ['Vegas Bar', '8826 Huebner Rd, San Antonio, TX 78240', '2106915552', '', $image],
    ['The Hangar', '8203 Broadway St, San Antonio, TX 78209', '2108242700', 'thehangarsa.com', $image],
    ['Rookie\'s Bar', '6402 Callaghan Rd, San Antonio, TX 78229', '2103770909', '', $image],
    ['MAX\'s Wine Dive', 'Quarry Village, 340 E Basse Rd #101, San Antonio, TX 78209', '2104449547', 'maxswinedive.com', $image],

];

foreach ($barsArray as $key => $data) {

//}
    $bar = App\Bar::create([
        'name' => $data[0],
        'address' => $data[1],
        'phone' => $data[2],
        'website' => $data[3],
        'beer_rating' => mt_rand(1,5),
    ]);
    $barpicture = App\Picture::create([
        'bar_id' => $bar->id,
        'pic_url' => $data[4]

    ]);
    $barpicture = App\Feature::create([
        'bar_id' => $bar->id,
        'smoking' => mt_rand(0,1),
        'food' => mt_rand(0,1),
        'pet_friendly' => mt_rand(0,1),
        'live_music' => mt_rand(0,1),
        'tvs' => mt_rand(0,1),
        '18+' => mt_rand(0,1),
        'patio' => mt_rand(0,1),
        'pool' => mt_rand(0,1),
        'darts' => mt_rand(0,1),
        'games' => mt_rand(0,1),
    ]);
}
$factory->define(App\Bar::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'address' => $faker->streetAddress,
        'phone' => 2105556666,
        'website' => $faker->domainName,
    ];
});
//    $bar->save();

//    $barpicture->save();


