<?php

use Illuminate\Database\Seeder;
use Geocoder\Provider\GoogleMaps;
use Ivory\HttpAdapter\Guzzle6HttpAdapter;

class BarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(App\Bar::class, 100)->create();
        $barsArray = [
            ['Cross-Eyed Seagull','19141 Stone Oak Pkwy # 206, San Antonio, TX 78258','2105453440','http://crosseyedseagull.clarksbars.com/', 'https://b.zmtcdn.com/data/reviews_photos/57a/07aae71082d890b9ac64ea10512e157a.jpg'],
            ['Chicago Bar','19141 Stone Oak Pkwy # 505, San Antonio, TX 78258','2104945558','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Social House','19160 Stone Oak Pkwy #104, San Antonio, TX 78258','2103630677','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Nektar Lounge','19239 Stone Oak Pkwy #110, San Antonio, TX 78258','2108335370','nektarlounge.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Copa Wine Bar','19141 Stone Oak Pkwy Suite 704, San Antonio, TX 78258','2104952672','thecopawinebar.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Garden Bistro Bar','18360 Blanco Rd #100, San Antonio, TX 78258','2102908484','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Kennedy\'s Public House','19179 Blanco Rd, San Antonio, TX 78258','2107641333','kennedysirishbar.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['The Angry Elephant','19314 US-281 #107, San Antonio, TX 78259','2105453782','theangryelephant.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['The Green Lantern','20626 Stone Oak Pkwy #101, San Antonio, TX 78258','2104973722','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Sinatra\'s San Antonio','1846 North Loop 1604 W, San Antonio, TX 78248','2104799600','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['New Orleans Bar','226 W Bitters Rd, San Antonio, TX 78216','2104032846','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Zombies Bar and Music Venue','4202 Thousand Oaks, San Antonio, TX 78217','2102818306','zombiesliveinsa.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['502 Bar','Embassy Oaks Shopping Center, 502 Embassy Oaks, San Antonio, TX 78216','2102578125','502bar.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Espana Bar de Tapas','5638 W Hausman Rd, San Antonio, TX 78249','2106904433','espanabar.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Tonic Bar','Northgate Village Shopping Center, 5500 Babcock Rd #117, San Antonio, TX 78240','2108775858','tonicthebar.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Shenanygans','6422 Babcock Rd, San Antonio, TX 78249','2106901156','shenanygans.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Cooter Browns Saloon','11881 Bandera Rd, San Antonio, TX 78023','2102631852','cooterbrownssaloon-tx.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Doc Browns','6511 W Loop 1604 N, San Antonio, TX 78254','2109737090','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Stetson Bar','7350 Tezel Rd # 108, San Antonio, TX 78250','2105235338','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Flying Saucer','The Strand at Huebner Oaks, 11255 Huebner Rd #212, San Antonio, TX 78230','2106965080','beerknurd.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Vegas Bar','8826 Huebner Rd, San Antonio, TX 78240','2106915552','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['The Hangar','8203 Broadway St, San Antonio, TX 78209','2108242700','thehangarsa.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['Rookie\'s Bar','6402 Callaghan Rd, San Antonio, TX 78229','2103770909','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
            ['MAX\'s Wine Dive','Quarry Village, 340 E Basse Rd #101, San Antonio, TX 78209','2104449547','maxswinedive.com','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
//            ['','','','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
//            ['','','','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
//            ['','','','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
//            ['','','','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],
//            ['','','','','https://s-media-cache-ak0.pinimg.com/564x/29/59/75/295975b49585969c6f7ebd474c162a07.jpg'],

        ];
        foreach ($barsArray as $key => $data){
            $bar = App\Bar::create([
//                'area' => $data[0],
                'name' => $data[0],
                'address' => $data[1],
                'phone' => $data[2],
                'website' => $data[3],
            ]);
//            $adapter  = new Guzzle6HttpAdapter();
//            $geocoder = new GoogleMaps($adapter);
//            $latlong = $geocoder->geocode($bar->address)->first();
//            $bar->latitude = $latlong->getLatitude();
//            $bar->longitude = $latlong->getLongitude();
            $bar->save();
            $barpicture = App\Picture::create([
                'bar_id' => $bar->id,
                'pic_url' => $data[4]

            ]);
            $barpicture->save();
        }

    }
}
