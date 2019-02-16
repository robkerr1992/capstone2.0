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
        factory(App\Bar::class, 1)->create();
    }
}
